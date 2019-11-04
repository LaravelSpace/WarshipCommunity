<?php

namespace App\Listeners\Common;

use App\Events\Common\RequestLogEvent;
use App\Service\Common\Log\Model\LogRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mockery\Exception;

class RequestLogListener
{
    // class RequestLogListener implements ShouldQueue
    // public $queue = 'request_log_listener';

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
     * @param  RequestLogEvent $event
     * @return void
     */
    public function handle(RequestLogEvent $event)
    {
        $logKey = $event->logKey;
        $logData = $event->logData;

        if (isset($logData['request'])) {
            $createField = [
                'ip'         => $logData['ip'],
                'client'  => $logData['client'],
                'uri'        => $logData['uri'],
                'request'    => $logKey,
                'created_at' => $logData['time']
            ];
            LogRequest::create($createField);
            $this->saveToFile($logKey, $logData);
        } else if (isset($logData['response'])) {
            $whereField = ['request' => $logKey];
            $updateField = [
                'response'   => $logKey,
                'updated_at' => $logData['time']
            ];
            LogRequest::where($whereField)->update($updateField);
            $this->saveToFile($logKey, $logData);
        }
    }

    public function saveToFile(string $fileName, array $logData)
    {
        $dateToday = dateToday();
        $dirPath = "/tmp/OH_LOG/{$dateToday}/";
        $fileName = str_replace('.log', '', $fileName);
        $logPath = $dirPath . $fileName . '.log';
        try {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $text = "\nTIME IS:" . timeNow() . "\n" . json_encode($logData) . "\n";
            file_put_contents($logPath, $text, FILE_APPEND);
        } catch (\Exception $e) {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
            file_put_contents($logPath, $text, FILE_APPEND);
        }
    }
}
