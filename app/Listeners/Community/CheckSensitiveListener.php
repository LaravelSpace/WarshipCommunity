<?php

namespace App\Listeners\Community;

use App\Events\Community\CheckSensitiveEvent;
use App\Service\Common\SensitiveWord\SensitiveWordService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckSensitiveListener
{
    // class ArticleSensitiveListener implements ShouldQueue
    // public $queue = 'sensitive_listeners';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckSensitiveEvent $event
     * @return void
     */
    public function handle(CheckSensitiveEvent $event)
    {
        (new SensitiveWordService())->checkSensitiveByModel($event->classification, $event->targetId);
    }
}
