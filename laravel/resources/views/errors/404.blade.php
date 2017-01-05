@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1>Oeps!</h1>
                    <h3>Deze pagina bestaat niet...</h3>
                    <p>Wil je anders naar de spelpagina gaan?</p>
                    <a href="{{ url('/games') }}">
                        <button type="button" class="buttonstyle">
                            Ga naar de spelpagina!
                        </button>
                    </a>
                </div>

            </div>
        </div>
        <br>
        <br>
        <div class="row homeimage">
            <div class="col-md-12">
                <img src="/img/poesje.png" alt="Image that represents the school playground." id="playground">
            </div>

        </div>
    </div>
@endsection


@section('pageExclusiveJS')

@endsection


