<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    //Que tabla va a estar modificando en la bd, ya definida segun Laravel
    protected $table='comments';

    //Relaciona ManyToOne    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');//Dos parametros: la clase y el campo con que se relaciona
    }

    public function image(){
        return $this->belongsTo('App\Image', 'image_id');//Dos parametros: la clase y el campo con que se relaciona
    }
}
