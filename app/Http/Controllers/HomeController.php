<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageReceived;
use App\Events\SendMessages;
use App\Events\SendNotification;
use App\Models\Message;
use Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('getMessages','sendMessage','auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // NewMessageReceived::dispatch(1,'1',2);
        return view('home');
    }

    public function message(Request $request)
    {
        
        // NewMessageReceived::dispatch(
        //     Auth::user()->id,
        //     $request->content,
        //     $request->ToUser    
        // );
        return back();
    }

    public function user(Request $request,User $user)
    {
        NewMessageReceived::dispatch(
            Auth::user()->id,
            'this is content',
            $user->id   
        );
        return view('user')->with('user',$user);
    }

    public function notification(Request $request , $notification)
    {
        SendNotification::dispatch($notification);
        return $notification;
    }

    public function sendMessages(Request $request , $message)
    {
        SendMessages::dispatch($message);
        $message = Message::create([
            'message' => $message,
            'user_id' => Auth::id(),
        ]);

        return $message;
    }

    public function getMessages(Request $request )
    {
        $messages = Message::all();
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'message' => $request->message,
            'user_id' =>  1,
        ]);

        SendMessages::dispatch($message);
    }

    public function private(Request $request , User $sender ,User $recived)
    {        
        return view('private')->with(['recived'=>$recived,'sender'=>$sender,'Auth'=>Auth::user()]);
    }

    public function token()
    {
        $user = Auth::user();
        $token = $user->createToken('test');
        return ['token' => $token->plainTextToken];
    }
}
