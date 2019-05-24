<?php

namespace App\Http\Controllers\Auth;

use App\Rol;
use App\User;
use App\Mail\UserRecovery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;
use Illuminate\Support\Facades\Mail;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
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
    public function store(Request $request)
    {
        $rules = [
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'direccion' => 'required|string',
            'telefono' => 'nullable|numeric|min:1'
          ];            

        $this->validate($request, $rules);

        $roles = Rol::all();

        foreach ($roles as $rol){

            if(strtoupper($rol->nombre) == User::USUARIO_CORRIENTE)
            {
                $this->rolId = $rol->id;
                break;
            }
            
        }

        $usuario = new User();
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->direccion = $request->get('direccion');
        $usuario->telefono = $request->get('telefono');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->rol_id = $this->rolId;
        $usuario->token = User::generarVerificationToken();
        $usuario->save();

        Flash::success('','Se ha enviado una clave a su correo para verificar su cuenta');

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function verificar($token)
    {
        $usuario = User::where('token','=',$token)->first();

        if($usuario)
        {
            $usuario->active = 1;
            $usuario->token = User::generarVerificationToken();
            $usuario->save();

            Flash::success('','Su cuenta ha sido verificada correctamente');

            return redirect('/login');
        }
        else
        {
            return redirect('/');
        }
    }

    public function cambiar_credencial()
    {
        return view('auth.recuperar');
    }

    public function enviar_correo(Request $request)
    {
        $rules = [
            'email' => 'required|string|email'
          ];            

        $this->validate($request, $rules);

        $user = User::where('email','=',$request->get('email'))->first();

        if($user)
        {
            $user->token = User::generarVerificationToken();
            $user->save();

            retry(5,function() use ($user){

                Mail::to($user)->send(new UserRecovery($user));

            },100);

            Flash::success('','Se ha enviado una clave a su correo para recuperar su contraseña');

            return redirect('/login');
        }
        else
        {
            return redirect('/');
        }
    }

    public function recuperar($token)
    {
        $usuario = User::where('token','=',$token)->first();

        if($usuario)
        {            
            return view('auth.nueva-credencial',['usuario' => $usuario]);
        } 
        else
        {
            return redirect('/');
        }
    }

    public function renovar_credencial(Request $request)
    {
        
        $rules = [
              'usuario' => 'required|numeric|min:1',
              'password' => 'required|string|min:5|confirmed'
            ];            

        $this->validate($request, $rules);

        $usuario = User::findOrFail($request->get('usuario'));
        $usuario->token = User::generarVerificationToken();
        $usuario->password = bcrypt($request->get('password'));    
        $usuario->save();
        
        Flash::success('','Su contraseña se ha cambiado con éxito');

        return redirect('/login');
    }
}
