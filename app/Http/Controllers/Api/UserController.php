<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return response()->json($users); // Trả về dữ liệu dưới dạng JSON
    }
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user); // Trả về dữ liệu người dùng dưới dạng JSON
        }

        return response()->json(['message' => 'User not found'], 404); // Trả về lỗi nếu không tìm thấy
    }
}
