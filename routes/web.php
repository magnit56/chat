<?php

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\NewMessageAdded;
use Illuminate\Support\Facades\Redis;
//use Illuminate\Support\Facades\View;

//Route::get('/', function () {
    //return view('welcome');
    /*event(
        new \App\Events\TestEvent()
    );*/
//});

Route::get('/chat', function () {
    $messages = Message::all();
    return view('chat.index', compact('messages'));
});

Route::post('/chat/message', function (Request $request) {
    $message = Message::create($request->all());
    event(
        new NewMessageAdded($message)
    );
    return redirect()->back();
});

//Route::controller('chat', 'ChatController');
