<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

//定义框架开始时间常量
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| 检查应用程序是否正在维护
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
| 如果应用程序通过“ down”命令处于 维护/演示模式，我们将需要引入此文件，以便可以显示任何预渲染的模板而不是启动框架，这可能会导致异常。
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| 注册自动加载器
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.

| Composer为此应用程序提供了一个方便的，自动生成的类加载器。 我们只需要利用它！ 我们只需要在这里将其添加到脚本中即可，因此我们不需要手动加载类。
| 完成自动加载功能
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
