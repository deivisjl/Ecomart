<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Inicio\InicioController@index');
Route::get('/acerca-de', 'Inicio\InicioController@acerca_de');
Route::get('/categoria/{slug}', 'Inicio\InicioController@categoria');
Route::get('/detalle-producto/{id}', 'Inicio\InicioController@detalle');

Auth::routes();

Route::get('carrito/agregar/{producto}', 'CarritoController@agregar');
Route::get('carrito/mostrar', 'CarritoController@mostrar');
Route::get('carrito/vaciar', 'CarritoController@vaciar');
Route::get('carrito/actualizar/{producto}/{cantidad?}', 'CarritoController@actualizar');
Route::get('carrito/quitar/{producto}', 'CarritoController@quitar');
Route::post('/buscar', 'CarritoController@buscar');


Route::resource('/registro', 'Auth\RegistroController');
Route::name('verificar')->get('registro/verificar/{token}','Auth\RegistroController@verificar');

// Cambiar contraseña
Route::get('/recuperar-credencial','Auth\RegistroController@cambiar_credencial');
Route::post('/recuperar-email','Auth\RegistroController@enviar_correo');
Route::name('recovery')->get('registro/recuperar/{token}','Auth\RegistroController@recuperar');
Route::post('/cambiar-credencial','Auth\RegistroController@renovar_credencial');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','confirmado']], function() {

    Route::get('/detalle-pedido','CarritoController@detalleOrden');

    Route::get('/confirmar','CarritoController@confirmar');
});

Route::group(['middleware' => ['auth','confirmado','admin']], function() {

    Route::resource('/categorias', 'Admin\Categoria\CategoriaController');

    Route::resource('/productos', 'Admin\Producto\ProductoController');

    Route::resource('/pedidos', 'Admin\Pedido\PedidoController');
    Route::get('/pedido-detalle/{pedido}', 'Admin\Pedido\PedidoController@detalle');
    Route::get('/pedido-obtener/{pedido}', 'Admin\Pedido\PedidoController@obtener');
    Route::get('/pedido-descargar', 'Admin\Pedido\PedidoController@descargar');

    //About Me
    Route::get('/mi-empresa', 'Inicio\InicioController@mi_empresa');
    Route::get('/mi-empresa-nuevo', 'Inicio\InicioController@mi_empresa_nuevo');
    Route::get('/mi-empresa/{request}', 'Inicio\InicioController@empresa_obtener');
    Route::post('/mi-empresa-guardar', 'Inicio\InicioController@mi_empresa_guardar');
    Route::get('/mi-empresa/{request}/edit', 'Inicio\InicioController@mi_empresa_editar');
    Route::put('/mi-empresa/{request}', 'Inicio\InicioController@mi_empresa_actualizar');
    Route::get('/mi-empresa-activar/{request}', 'Inicio\InicioController@mi_empresa_activar');

});