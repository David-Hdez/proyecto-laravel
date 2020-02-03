@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">   
            <h1>Mis imagenes favoritas</h1>
            <hr/>
            @foreach($likes as $like)
                <!--Tarjeta de la imagen-->
                @include('includes.image', ['image'=>$like->image])
            @endforeach

            <!--Paginación-->
            <div class="clearfix"></div><!--clearfix para quitar padding que se da con los estilos-->
            {{$likes->links()}}
            <!--Paginación-->
        </div>        
    </div>
</div>
@endsection