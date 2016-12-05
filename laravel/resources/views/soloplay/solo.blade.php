@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="mem-container">
                        <div id="my-memory-game"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageExclusiveJS')
    <script src="js/constants.js"></script>
    <script src="js/texts.js"></script>
    <script src="js/memory.js"></script>
    <script>
        var myMem = new Memory({
            wrapperID : "my-memory-game",
            cards : this.all_cards,
            onGameStart : function() { return false },
            onGameEnd : function() { return false; }
        });
    </script>
@endsection


