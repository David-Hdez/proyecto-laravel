<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;//use del modelo de Image
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
}
