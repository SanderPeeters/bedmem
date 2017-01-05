@extends('layouts.app')

@section('content')
    <div class="container home">
        <div class="row homeimage">
            <div class="col-md-12">
                <img src="/img/poesje.png" alt="Image that represents the school playground." id="playground">
            </div>

        </div>
        <div class="row hometitle text-center">
            <div class="col-md-12">
                <h1>Speel het bekende memory spel!</h1>
            </div>
        </div>
        <div class="row last">
            <div class="col-md-6 explanation">
                <p>Welkom op het memory platform voor Bednet gebruikers! Hier kan je je amuseren met het alom bekende memoryspel
                    waarbij je kaartjes moet omdraaien en gelijke paren moet proberen te vinden in zo weinig mogelijk zetten.
                    De keuze is aan jou, speel alleen om jouw memory-skills te verbeteren of daag een vriendje of vriendinnetje uit
                    en geniet samen van dit interactieve spel.</p>
                <p>Heb je graag nog wat meer uitleg bij het spel? Kijk dan zeker eens naar de <a href="{{ url('/spelregels') }}">spelregels</a>.</p>
                <a href="{{ url('/games') }}">
                    <button type="button" class="buttonstyle page__btn">
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