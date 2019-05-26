<?php

namespace App\Http\Controllers\Inicio;

use App\AcercaDe;
use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('categoria')
                        ->join('producto','categoria.id','=','producto.categoria_id')
                        ->select('categoria.id','categoria.slug','categoria.nombre',DB::raw('COUNT(producto.id) as total'))
                        ->groupBy('categoria.id','categoria.slug','categoria.nombre')
                        ->get();

        $productos = Producto::all();

        return view('welcome',['categorias' => $categorias,'productos' => $productos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoria($slug)
    {
        $categorias = DB::table('categoria')
                        ->join('producto','categoria.id','=','producto.categoria_id')
                        ->select('categoria.id','categoria.slug','categoria.nombre',DB::raw('COUNT(producto.id) as total'))
                        ->groupBy('categoria.id','categoria.slug','categoria.nombre')
                        ->get();
        
        $categoria = Categoria::findBySlugOrFail($slug);

        $productos = $categoria->producto()->get();

        $productos->each(function($productos){
            $productos->categoria;
        });

        return view('welcome',['categorias' => $categorias,'productos' => $productos ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detalle($id)
    {
        $categorias = DB::table('categoria')
                        ->join('producto','categoria.id','=','producto.categoria_id')
                        ->select('categoria.id','categoria.slug','categoria.nombre',DB::raw('COUNT(producto.id) as total'))
                        ->groupBy('categoria.id','categoria.slug','categoria.nombre')
                        ->get();

        $producto = Producto::findOrFail($id);

        return view('admin.producto.product-detail',['categorias' => $categorias,'producto' => $producto]);        
    }

    public function mi_empresa()
    {
        return view('admin.empresa.index');
    }

    public function mi_empresa_nuevo()
    {
        return view('admin.empresa.create');
    }

    public function mi_empresa_guardar(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'vision' => 'required|string',
            'mision' => 'required|string',
            'telefono' => 'required|numeric|min:1',
            'email' => 'required|string|email',
            'direccion' => 'required|string',
            'quien' => 'required|string',
            'valores' => 'required|string'
        ];

        $this->validate($request, $rules);

        $empresa = new AcercaDe();
        $empresa->empresa = $request->get('nombre');
        $empresa->quienes_somos = $request->get('quien');
        $empresa->vision = $request->get('vision');
        $empresa->mision = $request->get('mision');
        $empresa->valores = $request->get('valores');
        $empresa->direccion = $request->get('direccion');
        $empresa->telefono = $request->get('telefono');
        $empresa->correo = $request->get('email');
        $empresa->save();

        Flash::success('','Registro realizado con éxito');

        return redirect('/mi-empresa');
    }

    public function mi_empresa_editar($id)
    {
        $info = AcercaDe::findOrFail($id);
        return view('admin.empresa.edit',['info'=>$info]);
    }

    public function mi_empresa_actualizar(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required|string',
            'vision' => 'required|string',
            'mision' => 'required|string',
            'telefono' => 'required|numeric|min:1',
            'email' => 'required|string|email',
            'direccion' => 'required|string',
            'quien' => 'required|string',
            'valores' => 'required|string'
        ];

        $this->validate($request, $rules);

        $empresa = AcercaDe::findOrFail($id);
        $empresa->empresa = $request->get('nombre');
        $empresa->quienes_somos = $request->get('quien');
        $empresa->vision = $request->get('vision');
        $empresa->mision = $request->get('mision');
        $empresa->valores = $request->get('valores');
        $empresa->direccion = $request->get('direccion');
        $empresa->telefono = $request->get('telefono');
        $empresa->correo = $request->get('email');
        $empresa->save();

        Flash::success('','Registro actualizado con éxito');

        return redirect('/mi-empresa');
    }

    public function mi_empresa_activar($id)
    {
        $info = AcercaDe::findOrFail($id);
        $info->activo = $info->activo == 1 ? $info->activo = 0 : $info->activo = 1;
        $info->save();
        return response()->json(['data'=>'Se ha modificado el registro con éxito'],200);
    }

    public function empresa_obtener(Request $request)
    {
        $ordenadores = array("id","empresa","vision","mision","direccion","activo");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $empresas = DB::table('acerca_de')              
                ->select('id','empresa','mision','vision','direccion','activo') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('acerca_de')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $empresas,
        );

        return response()->json($data, 200);
    }

    public function acerca_de()
    {
        $info = AcercaDe::where('activo','=',1)->first();
        return view('acerca-de',['info'=>$info]);
    }
}
