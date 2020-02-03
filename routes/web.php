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

Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

Route::get('/subir-imagen', 'ImageController@create')->name('image.create');

Route::post('/image/save', 'ImageController@save')->name('image.save');

Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');

Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');

Route::post('/comment/save', 'CommentController@save')->name('comment.save');

Route::get('/comment/detele/{id}', 'CommentController@delete')->name('comment.delete');

Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');

Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');

Route::get('/likes', 'LikeController@index')->name('likes');

Route::get('/perfil/{id}', 'UserController@profile')->name('profile');

Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');

Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');

Route::post('/image/update', 'ImageController@update')->name('image.update');