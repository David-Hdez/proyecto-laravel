@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card"><!--Implementado clases de Bootstrap-->
                <div class="card-header">Subir nueva imagen</div>
            
                <div class="card-body">
                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                <input id="image_path" type="file" name="image_path" class="form-control" required>
                                <!--En caso de error del fomulario, tomandolo-->
                                <!--@error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                <!--@if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}TEST</strong>
                                    </span>
                                @endif-->
                                @if ($errors->any() && $errors->has('image_path'))                                    
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)                                                
                                                <li>{{ $error }}</li>                                                    
                                            @endforeach
                                        </ul>
                                    </div>                                    
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea rows="4" cols="50" id="description" type="text" name="description" class="form-control" required></textarea>                                
                                <!--En caso de error del fomulario, tomandolo-->
                                <!--@error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                @if ($errors->any() && $errors->has('description'))                                    
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>                                                
                                            @endforeach
                                        </ul>
                                    </div>                                    
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Subir imagen"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection