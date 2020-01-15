<?php

namespace App\Listeners\Community;

use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Common\SensitiveWord\Model\SensitiveResult;
use App\Service\Common\SensitiveWord\SensitiveWordService;
use App\Service\Community\Article\Model\ArticleModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleSensitiveListener
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
     * @param  ArticleSensitiveEvent $event
     * @return void
     */
    public function handle(ArticleSensitiveEvent $event)
    {
        $classification = $event->classification;
        $id = $event->id;
        $text = $this->iGetModelText($classification, $id);
        if (is_string($text)) {
            $result = (new SensitiveWordService())->checkSensitiveWord($text);
            $this->iHandleResult($classification, $id, $result);
        }
    }

    private function iGetModelText(string $classification, int $id)
    {
        $text = '';
        switch ($classification) {
            case 'article':
                $dbModel = ArticleModel::find($id);
                if (!is_null($dbModel)) {
                    $text = $dbModel->body;
                }
                break;
        }
        return $text;
    }

    private function iHandleResult(string $classification, int $id, array $result)
    {
        $examine = 'approve';
        $examineTrans = config('field_transform.examine');
        if (count($result) > 0) {
            $examine = 'reject';
            $createField = [
                'classification' => $classification,
                'target_id'      => $id,
                'result_data'    => json_encode($result),
            ];
            SensitiveResult::create($createField);
        }
        $whereField = ['id' => $id];
        $updateField = ['examine' => $examineTrans[$examine]];
        switch ($classification) {
            case 'article':
                ArticleModel::where($whereField)->update($updateField);
                break;
        }
    }
}
