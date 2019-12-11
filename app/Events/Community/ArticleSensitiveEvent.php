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

    public $classification; // article|comment

    public $id; // DB:article->id|DB:comment->id

    /**
     * Create a new event instance.
     *
     * @param string $classification
     * @param int    $id
     */
    public function __construct(string $classification, int $id)
    {
        $this->classification = $classification;
        $this->id = $id;
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
