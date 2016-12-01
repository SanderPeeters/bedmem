@extends('layouts.app')

@section('content')
    <div class="container home">
        <div class="row homeimage">
            <img src="/img/poesje.png" alt="Image that represents the school playground." id="playground">
        </div>
        <div class="row hometitle">
            <h2>Speel het bekende memory spel!</h2>
            <h3>Zin om even te spelen met je vriendjes?</h3>
        </div>
        <div class="row last">
            <div class="col-md-6 explanation">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin placerat nisi id semper eleifend. Phasellus a justo at lacus ultricies luctus. Suspendisse ullamcorper quis est vel ultricies. Integer risus nunc, ultrices et tempor ut, viverra sed magna. In iaculis volutpat commodo. Fusce vel ligula malesuada, pellentesque nulla aliquet, fringilla mauris. Donec lacinia consequat dui, nec finibus nulla sodales eu. Praesent suscipit, lacus aliquet venenatis gravida, mi ex tristique ante, lacinia faucibus nunc nunc id ex. Fusce fermentum pellentesque viverra. Nunc eu dignissim elit. Duis massa dui, vehicula non nisi eu, vestibulum scelerisque metus.</p>
                <a href="{{url('/games')}}">
                    <button type="button" class="buttonstyle">
                        Ga naar de spelpagina!
                    </button>
                </a>
            </div>
            <div class="col-md-6 explanation">
                <img src="/img/attempt2.png" alt="" class="image-on-home">
            </div>
        </div>
    </div>
@endsection