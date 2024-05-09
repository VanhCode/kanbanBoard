<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat()
    {
        $users = User::where("id", "<>", Auth::user()->id)->get();
        echo view('users.showAll')->with([
            'users' => $users
        ]);
    }

    public function sendMessage(Request $request) {
        // return json_encode([
        //     'data' => $request->message
        // ]);
        broadcast(new UserOnline($request->user(), $request->message));
    }
}
