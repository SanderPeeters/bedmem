@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Even wachten tot het spel ontvangen is.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="content">
                <div class="container">

                    <div id="my-memory-game"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pageExclusiveJS')
    <script src="js/constants.js"></script>
    <script src="js/pusherLogin.js"></script>
    <script src="js/classList.js"></script>
    <script src="js/memoryReceiver.js"></script>
    <script>
        var shuffled_cards_received;
        var level_received;
        channel.bind('start_game', function(data) {
            shuffled_cards_received = data.shuffled_cards;
            level_received = data.level;
            (function(){
                var myMem = new Memory({
                    wrapperID : "my-memory-game",
                    cards : this.all_cards,
                    level: this.level_received,
                    shuffledCards: this.shuffled_cards_received,
                    onGameStart : function() { return false; },
                    onGameEnd : function() { return false; }
                });
            })();

        });
        channel.bind('card_clicked', function(data) {
            console.log("#mg__tile_to_click-" + data.card_id);
                $("#mg__tile_to_click-" + data.card_id).click();

        });

    </script>
@endsection


