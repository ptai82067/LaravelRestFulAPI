<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Kiểm tra chế độ bảo trì
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Đăng ký autoloader của Composer
require __DIR__.'/../vendor/autoload.php';

// Khởi tạo ứng dụng và xử lý yêu cầu
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Request::capture());

