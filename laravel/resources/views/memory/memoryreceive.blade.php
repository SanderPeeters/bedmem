@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="ajaxResponse"></div>
            <div id="isYourTurnText"></div>
            <div id="wait-message">Even wachten tot het spel gestart is door de andere kant.</div>
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
    {{--<script src="js/pusherLogin.js"></script>--}}
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher(pusher_key, {
            cluster: 'eu',
            encrypted: true,
            authEndpoint: '/pusher/auth',
            auth: {
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }}
        });

        var channel = pusher.subscribe('private-test_channel');
        channel.bind('my_event', function(data) {
            alert(data.message);
        });
    </script>
    <script src="js/classList.js"></script>
    <script src="js/memoryReceiver.js"></script>

    <script>
        var shuffled_cards_received;
        var level_received;
        var isYourTurn = false;
        var channelToSend = "private-test_channel";

        channel.bind('start_game', function(data) {
            shuffled_cards_received = data.shuffled_cards;
            level_received = data.level;
            $("#my-memory-game").empty();
            $("#wait-message").empty();
            $("#ajaxResponse").empty().append("<div>Game Received!</div>");
                var myMem = new Memory({
                    wrapperID : "my-memory-game",
                    cards : this.all_cards,
                    level: this.level_received,
                    shuffledCards: this.shuffled_cards_received,
                    onGameStart : function() { changePointerEventForTurn(); },
                    onGameEnd : function() { return false; }
                });

        });
            channel.bind('client-card_clicked', function(data) {
                if(!isYourTurn) {
                    console.log("#mg__tile_to_click-" + data.card_id);
                    $("#mg__tile_to_click-" + data.card_id).click();
                    $("#ajaxResponse").empty().append("<div>card " + data.card_id + " clicked!</div>");
                }
            });


    </script>
    <script src="js/yourTurnLogic.js"></script>
    <script>
        console.log("token= " + $('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //send message to tell other side that you logged in
        $(function() { $.ajax({
            method: 'POST',
            url: '/pusher/joined',
            data: {channel: channelToSend},
            dataType: 'json',
            success: function( msg ) {
                $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
            }
        }) });

        function cardClicked(card_id) {
                if(isYourTurn){
//                $.ajax({
//                    method: 'POST',
//                    url: '/pusher/cardclick',
//                    data: {channel: channelToSend, card_id: card_id},
//                    dataType: 'json',
//                    success: function( msg ) {
//                        $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
//                    }
//                })
                    channel.trigger("client-card_clicked", {'card_id': card_id});
            }}
    </script>
@endsection


