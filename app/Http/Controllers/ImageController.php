<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Apps\Image;//use del modelo de Image

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
            'description' => ['required'],
            'image_path' => ['required|image'],//mimes: Formatos que se permiten            
        ]);
        
        //Tomando los datos
        $image_path=$request->file('image_path');
        $description=$request->input('description');

        //Dando los valores al objeto
    }
}
