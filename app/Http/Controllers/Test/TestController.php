<?php

namespace App\Http\Controllers\Test;

use App\Jobs\Common\SensitiveWordJob;
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
        dd(microtime());
        // return response((new JWTHandler())->makeJWT(User::find(25)));
        return response((string)(new JWTHandler())->checkJWT('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU3MjU5NDg5NSwiZXhwIjoxNTczMTk5Njk1LCJqdGkiOiI4ZTI5NmEwNjdhMzc1NjMzNzBkZWQwNWY1YTNiZjNlYyIsInVzZXJfaWQiOjI1fQ==.OGM2ZjM0ZDRlNGNjZDc0MThlNTFiMGE2ZjljN2IyMmY4NjU4YmJhODVkNmY1NTQxMDBlYmQzNWMxZDdmYWM2MA=='));
    }
}
