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

    public $broadcastQueue = 'broadcast';

    public function __construct()
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('broadcast-user.1');
    }

    public function broadcastAs()
    {
        return 'private-user';
    }

    public function broadcastWith()
    {
        return [
            'data' => 'key'
        ];
    }
}