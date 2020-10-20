<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", "email", "max:255", "exists:users,email"],
            "password" => ["required", "min:8", "max:255"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        if (!$token = $this->auth->attempt($request->only(["email", "password"]))) {
            return response()->json([
                "success" => false,
                "msg" => "User not found"
            ], 422);
        }
        return response()->json([
            "success" => true,
            "data" => $request->user(),
            "token" => $token
        ], 200);
    }
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "string", "min:3", "max:30"],
            "email" => ["required", "email", "max:255", "unique:users,email"],
            "password" => ["required", "min:8", "max:255"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $this->auth->attempt($request->only(["email", "password"]));

        return response()->json([
            "success" => true,
            "data" => $user,
            "token" => $token
        ], 200);
    }

    public function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => ["required", "email", "max:255", "exists:users,email"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        Password::sendResetLink($validator->validated());

        return response()->json([
            "success" => true,
            "msg" => "success"
        ], 200);
    }
}
