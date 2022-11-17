<?php

namespace App\Http\Controllers;
use App\Models\PrivateMessages;
use Illuminate\Http\Request;
use App\Events\PrivateMessageEvent;
use Auth;
class MessageController extends Controller
{
    //
    public function auth()
    {
        return Auth::user();
    }

    public function index(Request $request)
    {
        // return $request->all();
        $messages = PrivateMessages::
        whereRaw("(private_messages.recived_id = $request->recived_id AND private_messages.sender_id = $request->sender_id) OR (private_messages.recived_id = $request->sender_id AND private_messages.sender_id = $request->recived_id)")
        ->get();
        return response()->json(['messages'=>$messages]);
    }

    public function sendPrivate(Request $request)
    {
        $private = new PrivateMessages;
        $private->fill($request->all());
        $private->save();
        PrivateMessageEvent::dispatch($private);
        return $private;
    }
}
