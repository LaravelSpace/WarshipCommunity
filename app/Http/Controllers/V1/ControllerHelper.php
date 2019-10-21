<?php

namespace App\Http\Controllers\V1;


trait ControllerHelper
{
    protected $httpStatusCode = [];

    public function response(array $data = [], int $status = 200, string $message = '')
    {
        $returnData = [
            'status'  => $status,
            'message' => $message,
            'data'    => isset($data) ? $data : []
        ];

        if (!in_array($status, $this->httpStatusCode)) {
            if ($status == 200) {
                return response()->json($returnData);
            } else {
                return response()->json($returnData, $status);
            }
        } else {
            return response()->json($returnData);
        }
    }

    public function callAction($method, $parameters)
    {
        try {
            if (method_exists($this, 'beforeAction')) {
                call_user_func_array([$this, 'beforeAction'], $parameters);
            }
            $return = call_user_func_array([$this, $method], $parameters);
            if (method_exists($this, 'afterAction')) {
                call_user_func_array([$this, 'afterAction'], $parameters);
            }

            return $return;
        } catch (\Exception $e) {
            $trace = $e->getTrace();

            return $this->response(['trace' => $trace[0]], 500, $e->getMessage());
        }
    }
}
