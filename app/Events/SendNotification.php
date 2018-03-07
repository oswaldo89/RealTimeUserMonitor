<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class SendNotification
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($data)
    {
        $this->message = $data;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
