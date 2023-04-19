<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $login)
    {
        $u = User::where(
            [
                "login" => $login->login,
                "password" => $login->password
            ]
        )->first();

        if (!$u) {
            throw new ApiException(401, "Authentication failed");
        }

        $data = [
            "data" => [
                "user_token" => $u->generateToken()
            ]
        ];

        return response()->json($data);
    }

    public function logout()
    {
        Auth::user()->api_token = null;
        Auth::user()->save();

        $data = [
            "data" => [
                "message" => "logout"
            ]
        ];

        return response()->json($data);
    }

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function create(UserRequest $user)
    {
        $u = User::create($user->all());
        $data = [
            "data" =>
                [
                    "id" => $u->id,
                    "status" => "created"
                ]
        ];
        return response()->json($data, 201);
    }
}
