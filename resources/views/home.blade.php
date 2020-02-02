@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Mensaje-->
            @include('includes.message')
            <!--Mensaje-->

            <!--Presentacion de imagenes del usuario-->
            @foreach($images as $image)
                <div class="card pub_image">
                    <!--<div class="card-header">Dashboard</div>-->
                    <div class="card-header">
                        @if($image->user->image)
                            <div class="container-avatar">                        
                                <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="avatar">
                            </div>
                        @endif

                        <a href="{{route('image.detail', ['id'=>$image->id])}}">
                            <div class="data-user">{{ $image->user->name }} {{ $image->user->surname }}<span class="nickname">{{' | @'.$image->user->nick}}</span></div>
                        </a>
                    </div>

                    <div class="card-body">
                        <!--@if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!-->
                        <div class="image-container">
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

                        <div class="comments">
                            <a href="" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
                        </div>

                    </div>
                </div>
            @endforeach

            <!--Paginación-->
            <div class="clearfix"></div><!--clearfix para quitar padding que se da con los estilos-->
            {{$images->links()}}
            <!--Paginación-->

        </div>        
    </div>
</div>
@endsection
