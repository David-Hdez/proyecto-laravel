<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    //
    //Constructor para que solo un  usuario logueado cargue el controlador
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Validando
        $validate = $this->validate($request, [
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string'],//mimes:jpeg,jpg,png, Formatos que se permiten            
        ]);  

        $user=\Auth::user();
        $image_id=$request->input('image_id');
        $content=$request->input('content');

        $comment=new Comment();
        $comment->user_id=$user->id;
        $comment->image_id=$image_id;
        $comment->content=$content;

        $comment->save();

        return redirect()->route('image.detail', ['id'=>$image_id])
            ->with(['message'=>'¡Se ha publicado tu comentario!']);
    }

    public function delete($id){
        //Consigue datos del usuario identificado
        $user=\Auth::user();

        //Conseguir objeto del comentario
        $comment=Comment::find($id);

        //Comprobar si es el dueño del comentario o de la publicación
        //         Si la foto pertenece al loguedo | Si la imagen publicada peretenece a loguedo
        if ($user && $user->id==$comment->user_id || $comment->image->user_id==$user->id) {
            $comment->delete();//Objeto del comentario

            return redirect()->route('image.detail', ['id'=>$comment->image->id])
                ->with(['message'=>'Comentario eliminado']);
        }else{
            return redirect()->route('image.detail', ['id'=>$comment->image->id])
                ->with(['message'=>'Comentario no se ha eliminado']);
        }
    }
}
