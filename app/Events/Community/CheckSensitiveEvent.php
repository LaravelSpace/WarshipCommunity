<?php

namespace App\Events\Community;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckSensitiveEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string [目标类型]
     */
    public $classification;

    /**
     * @var int [目标 id]
     */
    public $targetId;

    /**
     * Create a new event instance.
     *
     * @param string $classification
     * @param int    $targetId
     */
    public function __construct(string $classification, int $targetId)
    {
        $this->classification = $classification;
        $this->targetId = $targetId;
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
