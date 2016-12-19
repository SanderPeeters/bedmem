<?php

namespace App\Http\Controllers;
use App\Pusherchannel;
use Vinkla\Pusher\Facades\Pusher;

use Illuminate\Http\Request;

class PusherController extends Controller
{

    //start a room with a unique pusher channel to play.
    function createGame(Request $request){
        $channel = new Pusherchannel();
        $channel->channelname = $this->readable_random_string(8);

        if ($channel->save()){
            return redirect('play1/'.$channel->channelname);
        }
        else{
            return view('errors.channelerrors')->with('errormessage', 'Er kon geen spel kanaal aangemaakt worden. Probeer nog eens opnieuw en als de fout blijft neem je best even contact op met een administrator');
        }
//        return response()->json(['pusherchannel' => $channel]);
//        return redirect()->route('play1', ['channelname' => $channel->channelname]);
    }


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

    //Authorize private channel client-events.
    function authChannel(Request $request){
        if (true){
            $channel = $request->input('channel_name');
            $socketId = $request->input('socket_id');
//        Pusher::socket_auth($channel, $socketId);
            //creates a unique authentication string for use with front-end pusher js library
            $response = Pusher::socket_auth($channel, $socketId);
            return $response;
        }
        else{
            return Response::make('Forbidden',403);
        }
    }

    //Tell the correct channel that the bednetter has joined the channel.
    function howManyUsersInChannel($channelname){
        $response = Pusher::get('/channels/'.$channelname, array('info' => 'subscription_count'));
        return $response;
    }



    function readable_random_string($length = 6)
    {
        $string     = '';
        $vowels     = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );
        // Seed it
        srand((double) microtime() * 1000000);
        $max = $length/2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }
}
