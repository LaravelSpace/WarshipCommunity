<?php

namespace App\Listeners\Common;

use App\Events\Common\RequestLogEvent;
use App\Service\Common\Log\LogService;
use App\Service\Common\Log\Model\LogRequestModel;
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
        // 通过 $logData 数组的元素判断是请求日志还是响应日志
        if (isset($logData['request'])) {
            $createField = [
                'ip'         => $logData['ip'],
                'client'     => $logData['client'],
                'client_id'  => $logData['client_id'],
                'controller' => $logData['controller'],
                'action'     => $logData['action'],
                'request'    => $logKey,
                'created_at' => $logData['time']
            ];
            LogRequestModel::create($createField);
            $this->saveToFile($logKey, $logData);
        } else if (isset($logData['response'])) {
            $whereField = ['request' => $logKey];
            $updateField = [
                'response'    => $logKey,
                'consumption' => $logData['consumption'],
                'updated_at'  => $logData['time']
            ];
            LogRequestModel::where($whereField)->update($updateField);
            $this->saveToFile($logKey, $logData);
        }
    }

    /**
     * 将日志写入文件
     *
     * @param string $logKey
     * @param array  $logData
     */
    public function saveToFile(string $logKey, array $logData)
    {
        $dirPath = config('constant.file_path.log_request') . gDateNow() . '/';
        $dirPath = storage_path($dirPath);
        (new LogService())->saveToFile($dirPath, $logKey, $logData);
    }
}
