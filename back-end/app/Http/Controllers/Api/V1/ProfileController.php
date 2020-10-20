<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Post;
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
                "user" => $request->user()->load(["posts"])
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
}
