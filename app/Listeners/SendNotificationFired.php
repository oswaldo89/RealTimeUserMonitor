<?php

namespace App\Listeners;

use App\Events\SendNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LRedis;

class SendNotificationFired
{

    public function __construct()
    {
        //
    }

    public function handle(SendNotification $event)
    {
        $redis = LRedis::connection();
        $redis->publish( $event->message['channel'] , json_encode( $event->message) );
    }
}
