<?php

namespace App\Http\Controllers\V1;


trait ResponseTrait
{
    public function response(array $data = [], string $status = 'success', int $code = 200, string $message = '')
    {
        $result = [
            'status'  => $status,
            'data'    => isset($data) ? $data : [],
            'message' => $message,
        ];
        $httpStatusCode = config('constant.http.status_code');
        if (in_array($code, $httpStatusCode) && $code !== 200) {
            return response()->json($result, $code);
        }
        if (400 <= $code && $code < 500) {
            return response()->json($result, 400);
        }
        if (500 <= $code && $code < 600) {
            return response()->json($result, 500);
        }
        return response()->json($result);
    }

    public function responseTrans(array $response)
    {
        $data = isset($response['data']) ? $response['data'] : [];
        if (isset($response['status']) && $response['status'] === config('constant.fail')) {
            $code = isset($response['status_code']) ? $response['status_code'] : 400;
            $message = isset($response['message']) ? $response['message'] : '';

            return $this->response($data, $response['status'], $code, $message);
        }
        return $this->response($data);
    }
}
