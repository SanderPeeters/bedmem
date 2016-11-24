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
                    Even wachten tot het spel send is.
                    <div id="ajaxResponse"></div>
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
    <script src="js/memorysend.js"></script>
    <script>
        var channel = "test_channel";
            (function(){
                var myMem = new Memory({
                    wrapperID : "my-memory-game",
                    cards : this.all_cards,
                    onGameStart : function() { startGame(level_to_send, cards_to_send) },
                    onGameEnd : function() { return false; }
                });
            })();
    </script>
    <script>
        console.log("token= " + $('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function startGame(level, shuffled_cards) {

            $(function() {

            });
            $.ajax({
                method: 'POST',
                url: '/pusher/startgame',
                data: {channel: channel, level: level, shuffled_cards: shuffled_cards},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").append("<div>"+msg.response+"</div>");
                }
            })
        }
        function cardClicked(card_id) {

            $(function() {

            });
            $.ajax({
                method: 'POST',
                url: '/pusher/cardclick',
                data: {channel: channel, card_id: card_id},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").append("<div>"+msg.response+"</div>");
                }
            })
        }
    </script>
@endsection


