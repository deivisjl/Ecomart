<?php

use App\Rol;
use Illuminate\Database\Seeder;

class create_rol_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        Rol::create([
            'nombre' => "Admin"
        ]);

        Rol::create([
            'nombre' => "Usuario"
        ]);
    
    }
}
