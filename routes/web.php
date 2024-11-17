<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/users', [UserController::class, 'index']); // Lấy tất cả người dùng
Route::get('/users/{id}', [UserController::class, 'show']); // Lấy người dùng theo ID
// Route::post('/users', [UserController::class, 'store']); // Thêm người dùng mới
// Route::put('/users/{id}', [UserController::class, 'update']); // Cập nhật người dùng
// Route::delete('/users/{id}', [UserController::class, 'destroy']); // Xóa người dùng

Route::get('/', function () {
    return view('welcome');
});

