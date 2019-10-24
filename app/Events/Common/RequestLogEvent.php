<?php

namespace App\Events\Common;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $logKey;

    public $logData;

    /**
     * Create a new event instance.
     *
     * @param string $logKey
     * @param array  $logData
     */
    public function __construct(string $logKey, array $logData)
    {
        $this->logKey = $logKey;
        $this->logData = $logData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
