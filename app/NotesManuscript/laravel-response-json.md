# 如何让 Laravel 永远返回 Json 格式的响应

## 黑科技

在编写完全为 `API` 服务的 `Laravel` 应用时，希望所有响应都是 `JSON` 格式的

**第一步、** 编写 `BaseRequest`。

首先构建一个 `BaseRequest` 来重写 `Illuminate\Http\Request` ，修改为默认优先使用 `JSON` 响应。

**app/Http/Requests/BaseRequest.php**

```
<?php
namespace App\Http\Requests;

use Illuminate\Http\Request;
class BaseRequest extends Request
{
    public function expectsJson()
    {
        return true;
    }
    public function wantsJson()
    {
        return true;
    }
}
```

**第二步、** 替换 `BaseRequest`。

在 `public/index.php` 文件中，将 `\Illumiate\Http\Request` 替换为刚才的 `BaseRequest`

```
$response = $kernel->handle(
    $request = \App\Http\Requests\BaseRequest::capture()
);
```

现在所有的响应都是 `application/json` ，包括错误和异常。

## 中间件

**第一步、** 创建 `JsonMiddleware`。

**app/Http/Middleware/JsonMiddleware.php**

```
<?php 
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class JsonMiddleware 
{
    public function handle(Request $request, Closure $next) 
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
```

**第二步、** 添加全局中间件。

**app/Http/Kernel.php**

```
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\JsonMiddleware::class,
    ];
    ...
}
```

## 参考

- [如何让你的 Laravel API 永远返回 JSON 格式的响应？](https://laravel-china.org/wikis/16069)