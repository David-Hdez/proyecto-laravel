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

                        <div class="data-user">
                            {{ $image->user->name }} {{ $image->user->surname }} | {{'@'.$image->user->nick}}
                        </div>                        
                    </div>

                    <div class="card-body">
                        <!--@if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!-->
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
