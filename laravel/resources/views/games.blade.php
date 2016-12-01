@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 explanation">
                <h2>Speel samen met je vrienden!</h2>
                <p>
                    De lessen even beu? Gewoon zin om even een gezelschapsspelletje te spelen met je vriend(in)?
                    Daag hem of haar dan uit op onze digitale speelplaats voor een spelletje Memory en
                    probeer meer paren te vrienden dan je klasgenoot!
                </p>

                <a href="{{url('/play1')}}">
                    <button type="button" class="buttonstyle">
                        Start een nieuw spel!
                    </button>
                </a>
            </div>
            <div class="col-sm-6 nopadding">
                <img src="/img/boot.png" alt="A cat lying in a boat." id="playground">
            </div>
        </div>
        <div class="row last">
            <div class="col-sm-6 nopadding">
                <img src="/img/boot.png" alt="A cat lying in a boat." id="playground">
            </div>
            <div class="col-sm-6 explanation">
                <h2>Zin om even alleen te spelen?</h2>
                <p>
                    Wil jij de beste worden in het memory spel? Oefen je skills achter de rug van je vrienden dankzij de single player?
                </p>
                <a href="{{url('/solo')}}">
                    <button type="button" class="buttonstyle">
                        Oefen jouw memory skills!
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection