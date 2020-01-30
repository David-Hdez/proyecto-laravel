<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;//Añadido Response
use Illuminate\Support\Facades\Storage;//use: para suir imagenes. utilizar los discos virtuales
use Illuminate\Support\Facades\File;//Para tomar el objeto del archivo al guardar en el disco virtual

class UserController extends Controller
{
    //
    //Constructor para que solo un  usuario logueado cargue el controlador
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }   
    
    public function update(Request $request){
        $user=\Auth::user();//Usuario identificado
        $id=$user->id;

        //Validando
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', "unique:users,nick,$id"],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$id"],
        ]);//Al validar nick y email, buscando algun otro registro diferente al id actual para que no se repita rel registro
    
        //Tomando datos del formulario
        $name=$request->input('name');
        $surname=$request->input('surname');
        $nick=$request->input('nick');
        $email=$request->input('email');

        //Actualizando valores al objeto del usuario
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->email=$email;

        //Subir la imagen de avatar del usuario
        $image_path=$request->file('image_path');
        if ($image_path) {
            $image_path_name=time().$image_path->getClientOriginalName();//Nombre del archivo original, cuando lo sube el usuario

            //Seleccionando el disco virtual, guardando la imagen
            Storage::disk('users')->put($image_path_name, File::get($image_path));//Parametros, como se guardara la imagen y el objeto del archivo a subir

            $user->image=$image_path_name;//La ruta del archivo en el campo de la BD
        }

        //Ejecutar UPDATE en BD
        $user->update();

        return redirect()->route('config')
            ->with(['message'=>'Usuario actualizado correctamente']);
    }

    //Mostrar avatar del usuario
    public function getImage($file_name){
        //Acceder al almacenamiento
        $file=Storage::disk('users')->get($file_name);

        return new Response($file, 200);//Devolviendo respuesta
    }
}
