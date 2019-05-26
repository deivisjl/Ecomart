<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acerca_de', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa');
            $table->text('quienes_somos');
            $table->text('valores');
            $table->text('vision');
            $table->text('mision');
            $table->text('direccion');
            $table->bigInteger('telefono');
            $table->string('correo');
            $table->integer('activo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acerca_de');
    }
}
