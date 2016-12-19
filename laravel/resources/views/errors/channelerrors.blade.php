@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1>Oeps!</h1>
                    <h3>Er is iets mis gegaan...</h3>
                    <p>{{$errormessage}}</p>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('pageExclusiveJS')

@endsection


