<?php

use App\User;
use App\Producto;
use App\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantidadCategorias = 10;
        $cantidadProductos = 30;

        User::flushEventListeners();
         
        $this->call(create_rol_seeder::class);
        $this->call(create_usuario_seeder::class);

        factory(Categoria::class, $cantidadCategorias)->create();
        factory(Producto::class, $cantidadProductos)->create();
    }
}
