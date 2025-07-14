<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(
            User::select('id', 'name', 'email', 'created_at')->get()
        );
    }

    public function allUsers(): JsonResponse
    {
        $users = User::select('name', 'email')->get();

        return response()->json([
            'data' => $users,
        ]);
    }
}
