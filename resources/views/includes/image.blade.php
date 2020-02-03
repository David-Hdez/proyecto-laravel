<!--Publicaciones, tarjeta de las imagenes-->
<div class="card pub_image">
    <!--<div class="card-header">Dashboard</div>-->
    <div class="card-header">
        @if($image->user->image)
            <div class="container-avatar">                        
                <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="avatar">
            </div>
        @endif

        <a href="{{route('profile', ['id'=>$image->user->id])}}">
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
            <!--{{var_dump($image->likes)}}-->                            

            <!--Comprobando si el usuario logueado ha dado like-->
            <?php $user_like=false; ?>
            @foreach($image->likes as $like)
                @if($like->user->id==Auth::user()->id)
                    <?php $user_like=true; ?>
                @endif
            @endforeach
            
            @if($user_like)
                <!--Atributo data para usar en la peticion AJAX-->
                <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike"><!--asset para cargar icono guardado-->
            @else
                <!--Atributo data para usar en la peticion AJAX-->
                <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like">
            @endif

            <span class="number_likes">{{count($image->likes)}}</span>
        </div>

        <div class="comments">
            <a href="{{route('image.detail', ['id'=>$image->id])}}" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
        </div>

    </div>
</div>