<?php

namespace App\Http\Controllers\Test;

use App\Jobs\Common\SensitiveWordJob;
use App\Service\Common\Log\Model\LogRequest;
use App\Service\Community\Article\Model\Article;
use App\Service\User\Handler\JWTHandler;
use App\Service\User\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use ReflectionClass;

class TestController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404); // 如果不是测试环境直接返回 404 页面
        }
    }

    public function test(Request $request)
    {
        $a = null;
        $b = 1;
        $result = [
            is_string(null),
            is_numeric('0'),
            is_numeric(0),
            is_numeric('012a'),
        ];
        dd($result);
        return redirect('/');
    }
}
