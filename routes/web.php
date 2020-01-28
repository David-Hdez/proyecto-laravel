<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use de la clase para acceder al namespace
//use App\Image;

Route::get('/', function () {
    //Test ORM, sacando registros de la bd
    /*$images=Image::all();

    foreach ($images as $image) {
        //var_dump($image);
        echo $image->image_path;//Como objeto
        echo '<br>';
        echo $image->description;
        echo '<br>';
        echo $image->user->name.' '.$image->user->surname;//Como objeto, objeto del usuario
        echo '<br>';        

        if (count($image->comments)>=1) {           
            echo '-Comentarios:';
            echo '<br>';

            foreach ($image->comments as $comment) {//Se laman a los metodos de la clase, ya los llama como propiedad
                echo $comment->user->name.': '.$comment->content;
                echo '<br>';
            }            
        }

        echo '<br>';
        echo 'LIKES: '. count($image->likes);
        echo '<hr>';
    }
    die();*/
    //Test ORM

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/configuracion', 'UserController@config')->name('config');

Route::post('/user/update', 'UserController@update')->name('user.update');