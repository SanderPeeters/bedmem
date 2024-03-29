<?php
use Vinkla\Pusher\Facades\Pusher;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => "web"], function() {
    Route::get('/', function () {
        return view('welcome');
    });

   /* Route::get('/play1', function () {
        return view('memory.memorysend');
    });*/
   /* Route::get('/play2', function () {
        return view('memory.memoryreceive');
    });*/

    Route::get('/creategame', 'PusherController@createGame');
    Route::get('/play1/{channelname}', 'GameController@playGame1');
    Route::get('/play2/{channelname}', 'GameController@playGame2');




    Route::get('/games', function () {
        return view('games');
    });

//    Auth::routes();

    Route::get('/home', 'HomeController@index');

//    Route::get('/bridge', function () {
//        Pusher::trigger('test_channel', 'my_event', ['message' => 'hey']);
//
//        return view('welcome');
//    });
//    Route::post('pusher/startgame', 'PusherController@startGame');
//    Route::post('pusher/cardclick', 'PusherController@cardClicked');
//    Route::post('pusher/joined', 'PusherController@joinedChannel');
    Route::post('pusher/auth', 'PusherController@authChannel');
    Route::get('pusher/channelinfo/{channelname}', 'PusherController@howManyUsersInChannel');



    Route::get('/solo', function () {
        return view('soloplay.solo');
    });

    Route::get('/spelregels', function () {
        return view('rules');
    });

});