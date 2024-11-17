<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

// Nếu đang chạy trên môi trường Render, thay vì sử dụng cổng mặc định 8000, hãy sử dụng cổng từ biến môi trường.
$port = getenv('PORT') ?: 8000;  // Mặc định là 8000 nếu không có biến PORT từ môi trường

// Bắt đầu xử lý yêu cầu
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Request::capture());

