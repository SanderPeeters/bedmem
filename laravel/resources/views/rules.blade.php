@extends('layouts.app')

@section('content')
    <div class="container home">
        <div class="row hometitle">
            <div class="col-md-12">
                <h1 class="text-center">Hoe speel ik het spel?</h1>
            </div>
        </div>
        <div class="row last">
            <div class="col-md-6 explanation">
                <h2>Start een spel</h2>
                <p>
                    De persoon die het spel wil starten, gaat naar de spelpagina, kopiëert de link die hij/zij te zien krijgt en stuurt deze vervolgens door naar de medespeler.
                    De persoon aan de andere kant die de link ontvangt, klikt hier vervolgens op en het spel is begonnen. De uitdager mag beginnen.
                </p>
                <h2>Doel</h2>
                <p>Probeer zoveel mogelijk twee dezelfde kaartjes om te draaien.</p>
                <h2>Spel</h2>
                <p>
                    De uitdager begint en mag twee kaartjes omdraaien. Als deze niet gelijk zijn, worden ze automatisch terug omgedraaid en is het de beurt aan je tegenspeler.
                    De tegenspeler heeft, als alles goed verlopen is, op zijn scherm ook kunnen zien welke kaartjes er door de uitdager werden omgedraaid.
                    Wanneer er twee dezelfde kaartjes worden omgedraaid, blijven deze liggen en mag je nog eens proberen twee gelijke kaartjes te vinden. Doe dit
                    totdat alle kaartjes omgedraaid zijn. Vervolgens verschijnt er een score op je scherm en kan je kiezen of je nog eens wil spelen.
                </p>
                <h2>Tips</h2>
                <ol style="padding-left: 11px">
                    <li>Let goed op - ook als je niet aan de beurt bent. Onthoud welke kaartjes je tegenspeler omdraait en waar ze liggen.</li>
                    <li>Weet je een paar te vinden, pak dan eerst de kaart die je niet zeker weet.</li>
                    <li>Er zijn drie moeilijkheidsgraden, dus als je nog vertrouwd bent met het spel, begin dan op het gemakkelijkste niveau.</li>
                </ol>
            </div>
            <div class="col-md-6 explanation">
                <img src="/img/attempt2.png" alt="" class="image-on-home">
                <h2>FAQ</h2>
                <h3>Hoe start ik een nieuw spel?</h3>
                <p>
                    Je gaat naar de <a href="{{url('/games')}}">spelpagina</a> en kiest of je alleen wil spelen of een multiplayer spel. Kies je voor het multiplayer
                    spel, dan krijg je een link die je moet kopiëren door op de knop 'Kopiëer' te drukken. Deze link plak je dan in het chatvenster met je tegenspeler
                    en deze klikt vervolgens op deze URL. Normaal gezien krijgt de uitdager nu melding dat de tegenspeler aan het spel is toegevoegd en kan je beginnen spelen.
                </p>
                <h3>Hoe weet ik wanneer het mijn beurt is?</h3>
                <p>Wanneer het jouw beurt is, krijg je een melding die even verschijnt. Vervolgens staat er boven het spelbord of het al dan niet jouw beurt is.</p>
            </div>
        </div>
        {{--        <div class="row homeimage">
                    <div class="col-md-12">
                        <img src="{{asset('/img/poesje.png')}}" alt="Image that represents the school playground." id="playground">
                    </div>

                </div>--}}
    </div>
@endsection