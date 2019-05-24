<?php

namespace App\Http\Controllers\Admin\Pedido;

use App\Orden;
use App\OrdenDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pedidos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function descargar()
    {   
        return Excel::create('Orden_producto', function($excel){

            $excel->sheet('Hoja 1', function($sheet) {
                $ordenes = DB::table('orden')
                ->join('orden_detalle','orden.id','=','orden_detalle.orden_id')
                ->join('producto','orden_detalle.producto_id','=','producto.id')
                ->join('users','orden.users_id','=','users.id')
                ->select('orden.id as orden','producto.nombre as producto','orden_detalle.precio','orden_detalle.cantidad','orden.created_at as fecha',DB::raw('CONCAT_WS(" ",users.nombres," ",users.apellidos) as nombre'),'users.email as correo')
                ->where('orden.estado','=',0)
                ->orderBy('orden.id','ASC')
                ->get();   

                $sheet->loadView('admin.pedidos.excel',['ordenes'=>$ordenes]);
        
            });

            $this->actualizar_pedidos();

        })->download('csv');
    }

    public function actualizar_pedidos()
    {
        $ordenes = Orden::where('estado','=',0)->get();

        foreach($ordenes as $item)
        {
            $item->estado = 1;
            $item->save();
        }

        return redirect()->route('pedidos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("orden.id","users.nombres","orden.total","orden.created_at");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $productos = DB::table('orden')  
                ->join('users','orden.users_id','=','users.id')             
                ->select('orden.id',DB::raw('CONCAT_WS(" ",users.nombres," ",users.apellidos) as nombre'),'orden.total',DB::raw('date_format(orden.created_at,"%d/%m/%Y") as fecha')) 
                ->where('orden.estado','=',0)
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('orden')
                ->join('users','orden.users_id','=','users.id')             
                ->where('orden.estado','=',0)
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $productos,
        );

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalle($id)
    {
        return view('admin.pedidos.detalle',['id'=>$id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function obtener(Request $request)
    {
        $ordenadores = array("orden_detalle.id","producto.nombre","orden_detalle.precio","orden_detalle.cantidad","orden_detalle.precio");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];

        $pedido = $request['buscar'][0]['id'];

        $productos = DB::table('orden_detalle')  
                ->join('producto','orden_detalle.producto_id','=','producto.id')             
                ->select('orden_detalle.id','producto.nombre as producto','orden_detalle.precio','orden_detalle.cantidad') 
                ->where('orden_detalle.orden_id','=',$pedido)
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('orden_detalle')
                ->join('producto','orden_detalle.producto_id','=','producto.id')             
                ->where('orden_detalle.orden_id','=',$pedido)
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $productos,
        );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
