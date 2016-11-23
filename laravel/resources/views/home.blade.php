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
                    You are logged in!
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
    <script>const pusher_key = "{{env('PUSHER_KEY')}}";</script>
    <script src="js/pusherLogin.js"></script>
    <script src="js/classList.js"></script>
    <script src="js/memory.js"></script>
    <script>
        (function(){
            var myMem = new Memory({
                wrapperID : "my-memory-game",
                cards : [
                    {
                        id : 1,
                        img: "img/default/monsters-01.png"
                    },
                    {
                        id : 2,
                        img: "img/default/monsters-02.png"
                    },
                    {
                        id : 3,
                        img: "img/default/monsters-03.png"
                    },
                    {
                        id : 4,
                        img: "img/default/monsters-04.png"
                    },
                    {
                        id : 5,
                        img: "img/default/monsters-05.png"
                    },
                    {
                        id : 6,
                        img: "img/default/monsters-06.png"
                    },
                    {
                        id : 7,
                        img: "img/default/monsters-07.png"
                    },
                    {
                        id : 8,
                        img: "img/default/monsters-08.png"
                    },
                    {
                        id : 9,
                        img: "img/default/monsters-09.png"
                    },
                    {
                        id : 10,
                        img: "img/default/monsters-10.png"
                    },
                    {
                        id : 11,
                        img: "img/default/monsters-11.png"
                    },
                    {
                        id : 12,
                        img: "img/default/monsters-12.png"
                    },
                    {
                        id : 13,
                        img: "img/default/monsters-13.png"
                    },
                    {
                        id : 14,
                        img: "img/default/monsters-14.png"
                    },
                    {
                        id : 15,
                        img: "img/default/monsters-15.png"
                    },
                    {
                        id : 16,
                        img: "img/default/monsters-16.png"
                    }
                ],
                onGameStart : function() { return false; },
                onGameEnd : function() { return false; }
            });
        })();
    </script>
@endsection


