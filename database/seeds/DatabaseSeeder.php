<?php

use App\User;
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
        User::flushEventListeners();
         
        $this->call(create_rol_seeder::class);
        $this->call(create_usuario_seeder::class);
    }
}
