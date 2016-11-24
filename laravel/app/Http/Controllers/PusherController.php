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
}
