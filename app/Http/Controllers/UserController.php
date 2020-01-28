<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
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

        //Ejecutar UPDATE en BD
        $user->update();

        return redirect()->route('config')
            ->with(['message'=>'Usuario actualizado correctamente']);
    }
}
