<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcercaDe extends Model
{
    protected $table='acerca_de';


    protected $fillable = [
        'id', 'empresa','vision','mision','direccion','telefono','correo','activo',
    ];
}
