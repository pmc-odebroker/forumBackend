<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    function register(RegisterRequest $request)
    {
        $request->validated();
        
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($data);

        $token = $user->createToken('forumApp')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password))
        {

            $token = $user->createToken('forumApp')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ], 200);
        }

        return response([
            'message' => 'Invalid credentials'
        ], 401);
    }

}
