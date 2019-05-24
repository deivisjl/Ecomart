<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio',5,2);
            $table->integer('cantidad');
            $table->integer('producto_id')->unsigned();
            $table->integer('orden_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->foreign('orden_id')->references('id')->on('orden');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_detalle');
    }
}
