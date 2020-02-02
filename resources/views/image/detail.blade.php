@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!--Mensaje-->
            @include('includes.message')
            <!--Mensaje-->
            
            <div class="card pub_image pub_image_detail">                
                <div class="card-header">
                    @if($image->user->image)
                        <div class="container-avatar">                        
                            <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="avatar">
                        </div>
                    @endif

                    <div class="data-user">{{ $image->user->name }} {{ $image->user->surname }}<span class="nickname">{{' | @'.$image->user->nick}}</span></div>
                </div>

                <div class="card-body">                    
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}">
                    </div>                        

                    <div class="description">
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        <span class="nickname date">{{' | '. \FormatTime::LongTimeFilter($image->created_at)}}</span>
                        <p>{{$image->description}}</p>
                    </div>

                    <div class="likes">
                        <img src="{{asset('img/heart-black.png')}}"><!--asset para cargar icono guardado-->
                    </div>
                    <div class="clearfix"></div><!--Limpiando los floats establecidos, esta clase es predeterminada de Bootstrap-->
                    <div class="comments">
                        <h2>Comentarios ({{count($image->comments)}})</h2>
                        <hr>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea class="form-control" name="content" required></textarea>
                            </p>
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </form>
                    </div>

                </div>
            </div>                        

        </div>        
    </div>
</div>
@endsection