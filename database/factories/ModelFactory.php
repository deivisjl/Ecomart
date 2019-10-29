<?php

use App\Producto;
use App\Categoria;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\Categoria::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
    ];
});

$factory->define(App\Producto::class, function (Faker\Generator $faker) {

	$categoria = App\Categoria::all()->random();

    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
		'precio' =>  $faker->numberBetween(10,50),
		'cantidad' => $faker->numberBetween(1,10),
		'img_url' => '/productos/92e612153eb71ffb08c0e71db217f8f82492483a.png',
		'descripcion' => $faker->paragraph(1),
		'categoria_id' => $categoria->id,
    ];
});