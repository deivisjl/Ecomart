<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table='orden';


    protected $fillable = [
        'id', 'total','estado','users_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function orden_detalle()
    {
        return $this->hasMany('App\OrdenDetalle');
    }
}
