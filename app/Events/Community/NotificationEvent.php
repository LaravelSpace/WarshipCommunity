<?php

namespace App\Events\Community;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        // dd(2);
    }

    public function broadcastOn()
    {
        return new Channel('test-event');
    }

    public function broadcastWith()
    {
        return [
            'data' => 'key'
        ];
    }
}