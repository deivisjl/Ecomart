<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Producto extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    
    protected $table='producto';


    protected $fillable = [
        'id','nombre','precio','slug','cantidad','img_url','descripcion','oferta','precio_oferta','categoria_id'
    ];

    public function sluggable(){
		return [
			'slug' => [
				'source' => 'nombre'
			]
		];
    }
    
    public function orden_detalle()
    {
        return $this->hasMany('App\OrdenDetalle');
    }

}


