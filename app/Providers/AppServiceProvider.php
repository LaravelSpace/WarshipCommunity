<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'production') {
            \DB::listen(function ($query) {
                try {
                    // 监听查询
                    // 格式化查询的参数
                    foreach ($query->bindings as $i => $binding) {
                        if ($binding instanceof \DateTime) {
                            $query->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                        } else {
                            if (is_string($binding)) {
                                $query->bindings[$i] = "'$binding'";
                            }
                        }
                    }
                    // 将参数拼装到 SQL 语句
                    $sqlStr = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
                    $sqlStr = vsprintf($sqlStr, $query->bindings);

                    // 记录日志
                    // 用日期分割日志
                    $logFileName = 'sql_' . date('Y-m-d') . '.log';
                    // 拼装日志文件地址
                    $logFileUrl = storage_path('logs' . DIRECTORY_SEPARATOR . $logFileName);
                    $streamHandler = new StreamHandler($logFileUrl, Logger::INFO);
                    // 实例化日志实例
                    $logger = new Logger('SQL');
                    // 入栈, 往 Logger 的 handler stack 里压入 StreamHandler 实例
                    // 这里可以入栈多个 StreamHandler 实例，实现例如：先发日志邮件然后记录文本的操作
                    // 栈操作先入后出, 后压入的先执行
                    $logger->pushHandler($streamHandler);
                    // 日志加工程序（processor），用于给日志添加额外信息
                    $logger->pushProcessor(new WebProcessor());
                    // 记录日志，第二个参数通过使用上下文（context）可以添加额外的数据
                    // 简单的处理器（StreamHandler）只是把数组转换成字符串
                    // 复杂的处理器可以利用上下文实现一些逻辑，提升日志的可读性
                    $logger->info($sqlStr, []);
                } catch (\Exception $e) {
                    $eTrace = $e->getTrace();
                    \Log::ERROR($eTrace[0]);
                    \Log::ERROR($e->getTraceAsString());
                }
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
