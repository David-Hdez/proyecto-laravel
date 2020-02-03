@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">                      

            <h1>Gente</h1>
            <form mehod="GET" action="{{route('user.index')}}" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>
            <hr/>        

            <!--Presentacion de imagenes del usuario-->
            @foreach($users as $user)
                <!--Info del usuario-->                    
                <div class="profile-user">                
                    @if($user->image)
                        <div class="container-avatar">                        
                            <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="avatar">
                        </div>
                    @endif                
                    <div class="user-info">
                        <h2>{{'@'.$user->nick}}</h2>
                        <h3>{{$user->name}} {{$user->surname}}</h3>
                        <p>{{'Se unió: '. \FormatTime::LongTimeFilter($user->created_at)}}</p>
                        <a class="btn btn-success" href="{{route('profile', ['id'=>$user->id])}}">Ver Perfil</a>
                    </div>
                    
                    <div class="clearfix"></div>
                    <hr/>
                </div>
            @endforeach

            <!--Paginación-->
            <div class="clearfix"></div><!--clearfix para quitar padding que se da con los estilos-->
            {{$users->links()}}
            <!--Paginación-->

        </div>        
    </div>
</div>
@endsection
