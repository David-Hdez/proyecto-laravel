@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">   
            <!--Info del usuario-->                    
            <div class="profile-user">                
                @if($user->image)
                    <div class="container-avatar">                        
                        <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="avatar">
                    </div>
                @endif                
                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name}} {{$user->surname}}</h2>
                    <p>{{'Se unió: '. \FormatTime::LongTimeFilter($user->created_at)}}</p>
                </div>
                
                <div class="clearfix"></div>
                <hr/>
            </div>
            
            <div class="clearfix"></div>

            <!--Presentacion de imagenes del usuario-->
            @foreach($user->images as $image)
                <!--Tarjeta de la imagen-->
                <!--Pasando variable al include-->
                @include('includes.image', ['image'=>$image])
            @endforeach           
        </div>        
    </div>
</div>
@endsection