<?php

namespace App\Events\Community;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleSensitiveEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id; // article_id

    public $classification; // article

    /**
     * Create a new event instance.
     *
     * @param int    $id
     * @param string $classification
     */
    public function __construct(int $id, string $classification)
    {
        $this->id = $id;
        $this->classification = $classification;
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
