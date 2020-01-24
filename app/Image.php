<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    //Que tabla va a estar modificando en la bd, ya definida segun Laravel
    protected $table='images';

    //Relacion one to many
    //Un solo modelo puede tener muchos comentarios, como comentarios y likes
        
    public function comments(){//Sacando todos los comentarios asignados a la imagen
        return $this->hasMany('App\Comment');//Como parametro con que objeto se relaciona
    }

    public function likes(){
        return $this->hasMany('App\Like');//Como parametro con que objeto se relaciona
    }

    //Relacion ManyToOne
    //Muchas imagenes pertenecen a un usuario
    public function user(){
        return $this->belongsTo('App\User', 'user_id');//Dos parametros: la clase y el campo con que se relaciona
    }
}
