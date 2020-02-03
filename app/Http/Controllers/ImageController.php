<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;//use del modelo de Image
use App\Comment;//use del modelo de Comment
use App\Like;//use del modelo de Like
use Illuminate\Http\Response;//Añadido Response

class ImageController extends Controller
{
    //
    //Constructor para que solo un  usuario logueado cargue el controlador
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){
        //Validando
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => ['required', 'image'],//mimes:jpeg,jpg,png, Formatos que se permiten            
        ]);        
        
        //Tomando los datos
        $image_path=$request->file('image_path');
        $description=$request->input('description');

        //Dando los valores al objeto
        $user=\Auth::user();
        $image=new Image();
        $image->user_id=$user->id;        
        $image->description=$description;

        //Subiendo imagen
        if ($image_path) {
            $image_path_name=time().$image_path->getClientOriginalName();//Nombrando al archivo
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path=$image_path_name;
        }

        $image->save();
        return redirect()->route('home')->with([
            'message'=>'La foto ha sido subida correctamente']);
    }

    //Devolviendo las imagenes del usuario
    public function getImage($filename){//Pasanso el nombre del archivo
        $file=Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detail($id){
        $image=Image::find($id);

        return view('image.detail', [
            'image'=>$image
        ]);
    }

    public function delete($id){
        $user=\Auth::user();
        $image=Image::find($id);
        $comments=Comment::where('image_id', $id)->get();//Borrando todos los comentarios de la imagen
        $likes=Like::where('image_id', $id)->get();//Borrando todos los likes de la imagen

        if ($user && $image && $image->user->id==$user->id) {//Borrando si es el dueño de la imagen
            //Eliminando comentarios
            if ($comments && count($comments)>=1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //Elimando likes
            if ($likes && count($likes)>=1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            //Eliminar archivos de imagenes
            Storage::disk('images')->delete($image->image_path);
            
            //Eliminar registro de imagen
            $image->delete();

            $message=array('message'=>'La imagen se borró');//Devolviendo mensaje de respuesta
        }else{
            $message=array('message'=>'La imagen no se borró');//Devolviendo mensaje de respuesta
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user=\Auth::user();
        $image=Image::find($id);

        if ($user && $image && $image->user_id==$user->id) {//Si el usuario loguedo es el dueño de la imagen
            return view('image.edit', ['image'=>$image]);
        }else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request){
        //Validando
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image',//mimes:jpeg,jpg,png, Formatos que se permiten            
        ]);  

        $image_id=$request->input('image_id');
        $description=$request->input('description');
        $image_path=$request->file('image_path');

        //Conseguir objeto imagen
        $image=Image::find($image_id);
        $image->description=$description;

        //Subiendo imagen
        if ($image_path) {
            $image_path_name=time().$image_path->getClientOriginalName();//Nombrando al archivo
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path=$image_path_name;
        }

        //Actualizando registro en BD
        $image->update();

        return redirect()->route('image.detail', ['id'=>$image_id])
            ->with(['message'=>'Se ha actualizado la imagen']);
    }
}
