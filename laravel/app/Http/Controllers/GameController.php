<?php

namespace App\Http\Controllers;


use App\Pusherchannel;

class GameController extends Controller
{
    //play game for the creator.
    function playGame1($channelname){
        $channel =  Pusherchannel::where('channelname', $channelname)->first();

        if ($channel === null) {
//            return response()->json(['error' => 'channel does not exists']);
            return view('errors.channelerrors')->with('errormessage', 'Dit spel kanaal bestaat niet.');

        }
        else{
            $date = new \DateTime($channel->created_at);
            $date->add(new \DateInterval('PT1H'));
            if ($date < new \DateTime('now')){
                $channel->delete();
//                return response()->json(['error' => 'channel has expired']);
                return view('errors.channelerrors')->with('errormessage', 'Dit spel kanaal is verlopen, je moet er een nieuwe aanmaken.');

            }
            else{
//                return response()->json(['first' => $date, 'second' => new \DateTime('now')]);
                return view('memory.memorysend')->with('channel', $channel);
            }

        }
    }

    //play game for the receiver.
    function playGame2($channelname){
        $channel =  Pusherchannel::where('channelname', $channelname)->first();

        if ($channel === null) {
//            return response()->json(['error' => 'channel does not exists']);
            return view('errors.channelerrors')->with('errormessage', 'Dit spel kanaal bestaat niet.');        }
        else{
            $date = new \DateTime($channel->created_at);
            $date->add(new \DateInterval('PT1H'));
            if ($date < new \DateTime('now')){
                $channel->delete();
//                return response()->json(['error' => 'channel has expired']);
                return view('errors.channelerrors')->with('errormessage', 'Dit spel kanaal is verlopen, je moet er een nieuwe aanmaken.');            }
            else{
                return view('memory.memoryreceive')->with('channel', $channel);
            }

        }
    }
}
