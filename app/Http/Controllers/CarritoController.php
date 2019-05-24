<?php

namespace App\Http\Controllers;

use App\User;
use App\Orden;
use App\Producto;
use App\OrdenDetalle;
use App\Mail\PedidoCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use HepplerDotNet\FlashToastr\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CarritoController extends Controller
{
    public function __construct()
	{
		if(!\Session::has('carrito')) \Session::put('carrito', array());
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar($slug)
    {
        $producto = Producto::findBySlug($slug);
        $carrito = \Session::get('carrito');
        $producto->cantidad = 1;
		$carrito[$producto->slug] = $producto;
		\Session::put('carrito', $carrito);
		return redirect('carrito/mostrar');
        
    }

    public function mostrar()
    {
        $carrito = \Session::get('carrito');        
		$total = $this->total();
		return view('carrito.show',['carrito' => $carrito,'total' => $total]);
	}

    public function quitar($slug)
    {
        $producto = Producto::findBySlug($slug);
        $carrito = \Session::get('carrito');
		unset($carrito[$producto->slug]);
		\Session::put('carrito', $carrito);
		return redirect('carrito/mostrar');
    }
    public function vaciar()
    {
        \Session::forget('carrito');
		return redirect('carrito/mostrar');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function total()
	{
		$carrito = \Session::get('carrito');
		$total = 0;
        foreach($carrito as $item)
        {
			$total += $item->precio * $item->cantidad;
		}
		return $total;
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualizar($slug,$cantidad)
    {
        $producto = Producto::findBySlug($slug);
        $carrito = \Session::get('carrito');
		$carrito[$producto->slug]->cantidad = $cantidad;
		\Session::put('carrito', $carrito);
		return redirect('carrito/mostrar');
    }

    public function buscar(Request $request)
    {
        $criterio =  $request->get('nombre');
        $categorias = DB::table('categoria')
        ->join('producto','categoria.id','=','producto.categoria_id')
        ->select('categoria.id','categoria.slug','categoria.nombre',DB::raw('COUNT(producto.id) as total'))
        ->groupBy('categoria.id','categoria.slug','categoria.nombre')
        ->get();

        $productos = Producto::where('nombre', 'LIKE', '%' . $criterio . '%')->get();

        return view('welcome',['categorias' => $categorias,'productos' => $productos ]);
    }

    public function detalleOrden()
    {
        if(count(\Session::get('carrito')) <= 0) return redirect('/');
		$carrito = \Session::get('carrito');
		$total = $this->total();
        return view('carrito.order-detail',['carrito' => $carrito, 'total' => $total]);
    }
    
    public function confirmar()
    {
        if(count(\Session::get('carrito')) <= 0) return redirect('/');
        $carrito = \Session::get('carrito');
        $total = $this->total();

        try
        {
            DB::beginTransaction();

            $orden = new Orden();
            $orden->total = $total;
            $orden->users_id = Auth::user()->id;
            $orden->save();
            
            foreach($carrito as $item)
            {
                $detalle = new OrdenDetalle();
                $detalle->precio = $item->precio;
                $detalle->cantidad = $item->cantidad;
                $detalle->producto_id = $item->id;
                $detalle->orden_id = $orden->id;
                $detalle->save();
            }

            DB::commit();
            \Session::forget('carrito');

            $this->enviar_correo();

            Flash::success('','Su orden de compra fue enviada con éxito');
            return redirect('/');
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            Flash::error('',$e->getMessage());
            return redirect('/carrito/mostrar');
        }
    }

    public function enviar_correo()
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user)
        {

            retry(5,function() use ($user){

                Mail::to($user)->send(new PedidoCreated($user));

            },100);

            return;
        }
    }
}
