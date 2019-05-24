<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $table='orden_detalle';


    protected $fillable = [
        'id','precio','cantidad','producto_id','orden_id'
    ];

    public function orden()
    {
        return $this->belongsTo('App\Orden');
    }

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}


