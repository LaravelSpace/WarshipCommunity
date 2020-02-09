<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Service\Community\Assess\AssessService;
use Illuminate\Http\Request;

class AssessController extends ApiControllerAbstract
{
    public function getAssess(Request $request)
    {
        $userId = config('client_id');
        $classification = $request->input('classification');
        $idStr = $request->input('id_str');
        $idArr = [$idStr];
        if (strpos($idStr, ',')) {
            $idArr = explode(',', $idStr);
        }
        $result = (new AssessService())->getAssess($userId, $classification, $idArr);

        return $this->response($result);
    }

    public function starToggle(Request $request)
    {
        $userId = config('client_id');
        $classification = $request->input('classification');
        $id = $request->input('id');
        $result = (new AssessService())->starToggle($userId, $classification, $id);

        return $this->response($result);
    }

    public function bookmarkToggle(Request $request)
    {
        $userId = config('client_id');
        $classification = $request->input('classification');
        $id = $request->input('id');
        $result = (new AssessService())->bookmarkToggle($userId, $classification, $id);

        return $this->response($result);
    }
}
