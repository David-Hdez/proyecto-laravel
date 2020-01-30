@if(Auth::user()->image)<!--Comprobando si existe avatar del usuario-->
    <div class="container-avatar">
        <!--<img src="{{ url('/user/avatar/'.Auth::user()->image) }}">-->
        <img src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" class="avatar">
    </div>
@endif    