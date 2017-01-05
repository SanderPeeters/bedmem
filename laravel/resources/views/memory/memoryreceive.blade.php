@extends('layouts.app')
@section('pageExclusiveCSS')
    <link href="/css/memory.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{--<div id="ajaxResponse"></div>--}}
            {{--<div id="isYourTurnText"></div>--}}
            <div class="text-center animated" id="isYourTurnAlert"></div>
            <div id="wait-message" class="text-center">Even wachten tot het spel gestart is door de andere kant.</div>
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
                    <p>Speel solo verder <a href="/solo">Klik hier</a></p>
                    <p>Of start een nieuw spel</p>
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
    <script src="/js/constants.js"></script>
    <script src="/js/texts.js"></script>
    <script>
        var pollingisActive = true;
        var pusherChannel = "private-{{$channel->channelname}}";

        // Enable pusher logging - don't include this in production
//        Pusher.logToConsole = true;

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
    <script src="/js/classList.js"></script>
    <script src="/js/memoryReceiver.js"></script>

    <script>
        var shuffled_cards_received;
        var level_received;
        var isYourTurn = false;


        channel.bind('client-start_game', function(data) {
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
            pollingisActive = true;
            pollServer();
        });
            channel.bind('client-card_clicked', function(data) {
                if(!isYourTurn) {
//                    console.log("#mg__tile_to_click-" + data.card_id);
                    $("#mg__tile_to_click-" + data.card_id).click();
                    $("#ajaxResponse").empty().append("<div>card " + data.card_id + " clicked!</div>");
                }
            });


    </script>
    <script src="/js/yourTurnLogic.js"></script>
    <script>
//        console.log("token= " + $('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //send message to tell other side that you logged in

        channel.bind('pusher:subscription_succeeded', function() {
           /* $.ajax({
                method: 'POST',
                url: '/pusher/joined',
                data: {channel: pusherChannel},
                dataType: 'json',
                success: function( msg ) {
                    $("#ajaxResponse").empty().append("<div>"+msg.response+"</div>");
                }
            })*/
            channel.trigger("client-has_joined", {'channel': pusherChannel});
            $("#ajaxResponse").empty().append("<div>channel "+pusherChannel+" joined!</div>");
        });

        function cardClicked(card_id) {
                if(isYourTurn){
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
//                            console.log(data.result.subscription_count);
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


