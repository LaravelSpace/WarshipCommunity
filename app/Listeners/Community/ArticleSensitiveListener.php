<?php

namespace App\Listeners\Community;

use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Common\SensitiveWord\Model\SensitiveResult;
use App\Service\Common\SensitiveWord\Service\SensitiveWordService;
use App\Service\Community\Article\Model\Article;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleSensitiveListener implements ShouldQueue
{
    public $queue = 'sensitivelisteners';

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
     * @param  ArticleSensitiveEvent $event
     * @return void
     */
    public function handle(ArticleSensitiveEvent $event)
    {
        $id = $event->id;
        $classification = $event->classification;
        $text = $this->iGetModelText($id, $classification);
        if ($text !== null && $text !== "") {
            $resultData = (new SensitiveWordService())->checkSensitiveWord($text);
            $this->iHandleResult($id, $classification, $resultData);
        }
    }

    private function iGetModelText(int $id, string $classification)
    {
        $text = "";
        switch ($classification) {
            case "article":
                $modelData = Article::find($id);
                if ($modelData !== null) {
                    $text = $modelData->main_body;
                }
                break;
        }
        return $text;
    }

    private function iHandleResult($id, $classification, $resultData)
    {
        if (count($resultData) <= 0) {
            $examineResult = 2;
        } else {
            SensitiveResult::create([
                "target_id"      => $id,
                "classification" => $classification,
                "result_data"    => json_encode($resultData)
            ]);
            $examineResult = 3;
        }
        switch ($classification) {
            case "article":
                Article::where("id", '=', $id)->update(["examine" => $examineResult]);
                break;
        }
    }
}
