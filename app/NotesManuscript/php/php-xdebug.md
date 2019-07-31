# 使用 PhpStrom+XDebug+FireFox 进行断点调试

## 安装 XDebug

如果不知道如何安装，或者不知道自己使用的 `PHP` 版本应该使用哪个版本的 `XDebug`，可以参考： [https://xdebug.org/wizard.php](https://xdebug.org/wizard.php) 。按照提示就可以完成安装了。

这里使用 `php-7.1.23` 举例。在命令行中执行 `php -i` 输出配置信息，填到页面上的文本框里去。然后点击页面下方的 `Analyse my phpinfo() output` 按钮。点击之后获得适用当前 `PHP` 版本的 `XDebug` 版本。`php-7.1.23` 使用 `php_xdebug-2.7.0-7.1-vc14-x86_64.dll` 这个版本的 `XDebug`，下载文件。

## 配置 XDebug

首先，把刚才下载下来的文件移动到 `PHP `目录下 `ext` 文件夹。然后，编辑 `php.ini` 文件，增加 `XDebug` 的配置。

下面这段代码，配置的并不全面，但是基本够用了。详细的配置请参考： [https://xdebug.org/docs/all_settings](https://xdebug.org/docs/all_settings) 。

```
[xdebug]
zend_extension = {path to php}\php-7.1.23\ext\php_xdebug-2.7.0-7.1-vc14-x86_64.dll
xdebug.remote_enable = on
xdebug.auto_trace = on
xdebug.remote_handler = dbgp
xdebug.remote_host = localhost
xdebug.remote_port = 9001
xdebug.idekey = PHPSTORM
xdebug.profiler_enable = off
xdebug.profiler_enable_trigger = off
xdebug.profiler_output_dir = C:\tmp
xdebug.profiler_output_name = cachegrind.out.%t.%p
xdebug.show_local_vars = 0
```

配置好后，重启服务器，输出 `phpinfo()`或者在命令行执行 `php -m` 检查 `XDebug` 是否生效。

## 配置 PhpStrom

1、 配置 `php`

`PhpStrom` 菜单栏 `File` => `Settings`。

![p01](.\images\php-xdebug\p01.png)
![p02](.\images\php-xdebug\p02.png)

2、配置 `XDebug`

这里的参数都是上面在 `php.ini` 中配置的。

![p03](.\images\php-xdebug\p03.png)
![p04](.\images\php-xdebug\p04.png)

3、配置服务器

`PhpStrom` 右上角 `Edit Configurations` 新建一个 `PHP Remote Debug`。

这里的参数根据具体的项目配置。

![p05](.\images\php-xdebug\p05.png)
![p06](.\images\php-xdebug\p06.png)

## FireFox 配置

在菜单栏 `附加组件`=>`扩展` 中搜索 `Xdebug-ext`，安装。然后右上角会出现一个 `Xdebug` 的图标。

## 调试

打开 `PhpStrom` 的监听，右上角有按钮，或者菜单栏 `Run` => `Start Listening for PHP Debug Connections` 。打断点，浏览器输入 Url 进行测试。

## 参考

- [在windows10环境下给PHPStorm配置xdebug断点调试功能](https://www.cnblogs.com/yxhblogs/p/6598387.html)
- [PHP调试跟踪之XDebug使用总结](https://blog.csdn.net/why_2012_gogo/article/details/51170609)
- [php开发 PHPStorm+XDebug+Firefox调试配置](https://blog.csdn.net/u010921682/article/details/79553675)