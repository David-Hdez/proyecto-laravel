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
                <!--Tarjeta de la imagen-->
                <!--Pasando variable al include-->
                @include('includes.image', ['image'=>$image])
            @endforeach

            <!--Paginación-->
            <div class="clearfix"></div><!--clearfix para quitar padding que se da con los estilos-->
            {{$images->links()}}
            <!--Paginación-->

        </div>        
    </div>
</div>
@endsection
