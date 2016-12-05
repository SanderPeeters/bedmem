@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div id="wait-message">Even wachten de andere kant is ingelogd.</div>
            <div id="ajaxResponse"></div>
            <div id="isYourTurnText"></div>
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
{{--
    <script src="js/pusherLogin.js"></script>
--}}
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher(pusher_key, {
            cluster: 'eu',
            encrypted: true
        });

        var channel = pusher.subscribe('test_channel1');
        channel.bind('my_event', function(data) {
            alert(data.message);
        });
    </script>
    <script src="js/classList.js"></script>
    <script src="js/memorySend.js"></script>
    <script>
        var channelToSend = "test_channel2";
        var isYourTurn = true;

        channel.bind('has_joined', function(data) {
            $("#my-memory-game").empty();
            $("#wait-message").empty();
            $("#ajaxResponse").empty().append("<div>Channel "+data.channel+" has two players</div>");
                var myMem = new Memory({
                    wrapperID : "my-memory-game",
                    cards : this.all_cards,
                    onGameStart : function() { startGame(level_to_send, cards_to_send); changePointerEventForTurn(); },
                    onGameEnd : function() { return false; }
                });

        });

        channel.bind('card_clicked', function(data) {
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
        function startGame(level, shuffled_cards) {
            $.ajax({
                method: 'POST',
                url: '/pusher/startgame',
                data: {channel: channelToSend, level: level, shuffled_cards: shuffled_cards},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
                }
            })
        }

        function cardClicked(card_id) {
            if(isYourTurn){
            $.ajax({
                method: 'POST',
                url: '/pusher/cardclick',
                data: {channel: channelToSend, card_id: card_id},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
                }
            })
        }}
    </script>
@endsection


