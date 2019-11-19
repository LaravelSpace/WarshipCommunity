<?php

namespace App\Http\Controllers\V1;


trait ResponseTrait
{
    public function response(array $data = [], int $status = 200, string $message = '')
    {
        $result = [
            'status'  => $status,
            'message' => $message,
            'data'    => isset($data) ? $data : []
        ];
        $httpStatusCode = config('constant.http.status_code');
        if (in_array($status, $httpStatusCode) && $status !== 200) {
            return response()->json($result, $status);
        }
        return response()->json($result);
    }

    public function responseTrans(array $response)
    {
        $data = isset($response['data']) ? $response['data'] : [];
        if (isset($response['status']) && $response['status'] === config('constant.fail')) {
            $statusCode = isset($response['status_code']) ? $response['status_code'] : 400;
            $message = isset($response['message']) ? $response['message'] : '';

            return $this->response($data, $statusCode, $message);
        }
        return $this->response($data);
    }
}
