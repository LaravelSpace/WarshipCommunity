<?php
/**
 * Created by PhpStorm.
 * User: Kelip
 * Date: 2020/3/7
 * Time: 14:15
 */

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AEvent implements ShouldBroadcast
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