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

    Route::get('/play1', function () {
        return view('memory.memorysend');
    });
    Route::get('/play2', function () {
        return view('memory.memoryreceive');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index');

    Route::get('/bridge', function () {
        Pusher::trigger('test_channel', 'my_event', ['message' => 'hey']);

        return view('welcome');
    });
    Route::post('pusher/startgame', 'PusherController@startGame');
    Route::post('pusher/cardclick', 'PusherController@cardClicked');
    Route::post('pusher/joined', 'PusherController@joinedChannel');


});