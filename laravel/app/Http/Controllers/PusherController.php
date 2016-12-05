<?php

namespace App\Http\Controllers;
use Vinkla\Pusher\Facades\Pusher;

use Illuminate\Http\Request;

class PusherController extends Controller
{
    //the creator (teacher) of the game triggers this event and sends the 'bednetter' the correct cards and level.
    function startGame(Request $request){
        $channel = $request->input('channel');
        $level = $request->input('level');
        $shuffled_cards = $request->input('shuffled_cards');
        Pusher::trigger($channel, 'start_game', ['level' => $level, 'shuffled_cards' => $shuffled_cards]);
        return response()->json(['response' => 'Game send!']);
    }

    //Tell the correct channel which card has been clicked.
    function cardClicked(Request $request){
        $channel = $request->input('channel');
        $card_id = $request->input('card_id');
        Pusher::trigger($channel, 'card_clicked', ['card_id' => $card_id]);
        return response()->json(['response' => 'card '.$card_id.' clicked!']);
    }

    //Tell the correct channel that the bednetter has joined the channel.
    function joinedChannel(Request $request){
        $channel = $request->input('channel');
        Pusher::trigger($channel, 'has_joined', ['channel' => $channel]);
        return response()->json(['response' => 'channel '.$channel.' joined!']);
    }

    //Tell the correct channel that the bednetter has joined the channel.
    function authChannel(Request $request){
        if (true){
            $channel = $request->input('channel_name');
            $socketId = $request->input('socket_id');
//        Pusher::socket_auth($channel, $socketId);
            $response = Pusher::socket_auth($channel, $socketId);
            return $response;
        }
        else{
            return Response::make('Forbidden',403);
        }
    }
}
