<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;//use modelo

class LikeController extends Controller
{
    //
    //Constructor para que solo un usuario logueado cargue el controlador
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user=\Auth::user();//Tomando el usuario identificado

        $likes=Like::where('user_id', $user->id)->orderBy('id', 'DESC')
            ->paginate(5);

        return view('like.index', [
            'likes'=>$likes
        ]);
    }

    public function like($image_id){
        //Datos del usario y la imagen
        $user=\Auth::user();

        //Condicion para ver si ya existe el like
        $isset_like=Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like==0) {
            $like=new Like();
            $like->user_id=$user->id;
            $like->image_id=(int)$image_id;

            $like->save();

            //return json, ya que esta funcion sera por ajax
            return response()->json([
                'like'=>$like
            ]);
        }else{
            return response()->json([
                'message'=>'Ya existe el like'
            ]);
        }
    }

    public function dislike($image_id){
        //Datos del usario y la imagen
        $user=\Auth::user();

        //Condicion para ver si ya existe el like
        $like=Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {
            //Eliminar like            
            $like->delete();

            //return json, ya que esta funcion sera por ajax
            return response()->json([
                'like'=>$like,
                'message'=>'Has dado dislike'
            ]);
        }else{
            return response()->json([
                'message'=>'No existe el like'
            ]);
        }
    }    
}
