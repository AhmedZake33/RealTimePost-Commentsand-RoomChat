<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $fromUser;
    public $content;
    public $toUser;
   
    public function __construct($fromUser , $content , $toUser)
    {
        //
        $this->fromUser = $fromUser;
        $this->content = $content;
        $this->toUser = $toUser;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('message.',$this->toUser);
    }

    public function broadcastWith()
    {
        return [
            'content'=>$this->content
        ];
    }
}
