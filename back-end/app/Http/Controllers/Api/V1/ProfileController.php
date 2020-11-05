<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Post;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class ProfileController extends Controller
{
    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function profile(Request $request)
    {
        return response()->json([
            "success" => true,
            "data" => [
                "user" => auth()->user()->load(["posts"]),
                'avatar' => [
                    'original' => auth()->user()->avatar,
                    'thumb' => auth()->user()->avatar_thumb
                ],

            ]
        ], 200);
    }


    public function allPosts(Request $request)
    {
        $posts = Post::latest()->with("user")->paginate(10);
        return response()->json([
            "success" => true,
            "data" => $posts
        ], 200);
    }


    public function logout(Request $request)
    {
        $this->auth->invalidate();
        return response()->json([
            "success" => true,
            "msg" => "logged out successfuly"
        ], 200);
    }

    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "avatar" => ["required", "string"],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        $avatar = auth()->user()->addMediaFromBase64($request->avatar)
            ->usingName("avatar")
            ->usingFileName(Uuid::uuid() . ".png")
            ->toMediaCollection("avatar");

        return response()->json([
            "success" => true,
            "data" => [
                "original" => $avatar->getFullUrl(),
                'thumb' => $avatar->getFullUrl('thumb')
            ]
        ], 200);
    }
}
