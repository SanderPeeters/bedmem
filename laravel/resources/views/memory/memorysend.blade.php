@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div id="ajaxResponse"></div>
            <div id="playerInfo">Er zijn <span id="playerCount">#</span> spelers.</div>
            <div id="isYourTurnText"></div>
            <div id="toCopyBlock" class="text-center">
                <p>Kopieer deze link en stuur hem naar de persoon met wie je wil spelen.</p>
                <input id="toCopy" value="{{url('play2/'.$channel->channelname)}}" readonly style="width:40%">
                <button class="buttonstyle" id="copyButton" data-clipboard-target="#toCopy">
                    Kopieer
                </button>
            </div>
            <div id="wait-message" class="text-center"><h4>Even wachten de andere kant is ingelogd.</h4></div>

            <div class="content">
                <div class="mem-container">
                    <div id="my-memory-game"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Oei je tegenstander heeft het spel verlaten</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Kopieer deze link en stuur hem naar de persoon met wie je wil spelen.</p>
                    <input id="toCopy" value="{{url('play2/'.$channel->channelname)}}" readonly style="width:40%">
                    <button class="buttonstyle" id="copyButton" data-clipboard-target="#toCopy">
                        Kopieer
                    </button>
                    <p>Of speel solo <a href="/solo">Klik hier</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('pageExclusiveJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.15/clipboard.min.js"></script>
    <script src="{{ URL::asset('js/constants.js') }}"></script>
    <script src="{{ URL::asset('js/texts.js') }}"></script>
    <script>
        var pollingisActive = true;
        var pusherChannel = "private-{{$channel->channelname}}";
        var isYourTurn = true;

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

        var channel = pusher.subscribe(pusherChannel);

    </script>
    <script src="{{ URL::asset('js/classList.js') }}"></script>
    <script src="{{ URL::asset('js/memorySend.js') }}"></script>
    <script>

        //copy and tooltip logic
        $('#copyButton').tooltip({
            trigger: 'click',
            placement: 'bottom'
        });

        function setTooltip(btn, message) {
            $(btn).tooltip('hide')
                .attr('data-original-title', message)
                .tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function() {
                $(btn).tooltip('hide');
            }, 1000);
        }

        // Clipboard

        var clipboard = new Clipboard('#copyButton');

        clipboard.on('success', function(e) {
            setTooltip(e.trigger, 'Gekopieerd!');
            hideTooltip(e.trigger);
        });

        clipboard.on('error', function(e) {
            setTooltip(e.trigger, 'Gefaald!');
            hideTooltip(e.trigger);
        });



        channel.bind('client-has_joined', function(data) {
            $("#my-memory-game").empty();
            $("#wait-message").empty();
            $("#toCopyBlock").remove();
            $('#playerCount').empty().append('2');
//            clipboard.destroy();
            $("#myModal").modal('hide');
            $("#ajaxResponse").empty().append("<div>Channel "+data.channel+" has 2 players</div>");
                var myMem = new Memory({
                    wrapperID : "my-memory-game",
                    cards : this.all_cards,
                    onGameStart : function() { startGame(level_to_send, cards_to_send); changePointerEventForTurn(); },
                    onGameEnd : function() { return false; }
                });
            isYourTurn = true;
            changePointerEventForTurn();
            pollingisActive = true;
            pollServer();

        });

        channel.bind('client-card_clicked', function(data) {
            if(!isYourTurn) {
                console.log("#mg__tile_to_click-" + data.card_id);
                $("#mg__tile_to_click-" + data.card_id).click();
                $("#ajaxResponse").empty().append("<div>card " + data.card_id + " clicked!</div>");
            }
        });
    </script>
    <script src="/js/yourTurnLogic.js"></script>
    <script>
        console.log("token= " + $('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function startGame(level, shuffled_cards) {
            /*$.ajax({
                method: 'POST',
                url: '/pusher/startgame',
                data: {channel: pusherChannel, level: level, shuffled_cards: shuffled_cards},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
                }
            })*/
            channel.trigger("client-start_game", {'level': level, 'shuffled_cards': shuffled_cards});
            $("#ajaxResponse").empty().append("<div>Spel is verzonden</div>");
        }

        function cardClicked(card_id) {
            if(isYourTurn){
//            $.ajax({
//                method: 'POST',
//                url: '/pusher/cardclick',
//                data: {channel: pusherChannel, card_id: card_id},
//                dataType: 'json',
//                success: function( msg ) {
//                    $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
//                }
//            });
                channel.trigger("client-card_clicked", {'card_id': card_id});
        }}
    </script>
    <script>


        function pollServer()
        {
            if (pollingisActive)
            {
                window.setTimeout(function () {
                    $.ajax({
                        url: "/pusher/channelinfo/"+pusherChannel,
                        type: "GET",
                        success: function (data) {
                            console.log(data.result.subscription_count);
                            $('#playerCount').empty().append(data.result.subscription_count);
                            if(data.result.subscription_count < 2){
                                pollingisActive = false;
                                $("#myModal").modal();
                            }
                            pollServer();
                        },
                        error: function () {
                            //ERROR HANDLING
                            pollServer();
                        }});
                }, 20000);
            }
        }
    </script>
@endsection


