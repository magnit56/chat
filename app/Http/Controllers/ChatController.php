<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        return view('chat.index');
    }

    public function postMessage(Request $request) {
        Message::create($request->all());
        return redirect()->back();
    }
}
