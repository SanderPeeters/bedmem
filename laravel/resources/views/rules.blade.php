@extends('layouts.app')

@section('content')
    <div class="container home">
        <div class="row homeimage">
            <div class="col-md-12">
                <img src="{{asset('/img/poesje.png')}}" alt="Image that represents the school playground." id="playground">
            </div>

        </div>
        <div class="row hometitle">
            <div class="col-md-12">
                <h1 class="text-center">Hoe speel ik het spel?</h1>
            </div>
        </div>
        <div class="row last">
            <div class="col-md-6 explanation">
                <p>Hier komen eventueel de spelregels en verdere uitleg van deze website.</p>
                <p>Hier komen eventueel de spelregels en verdere uitleg van deze website.</p>
                <p>Hier komen eventueel de spelregels en verdere uitleg van deze website.</p>
                <p>Hier komen eventueel de spelregels en verdere uitleg van deze website.</p>

            </div>
            <div class="col-md-6 explanation">
                <img src="/img/attempt2.png" alt="" class="image-on-home">
            </div>
        </div>
    </div>
@endsection