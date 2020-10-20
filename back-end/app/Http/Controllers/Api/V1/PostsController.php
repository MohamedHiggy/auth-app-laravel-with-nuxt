<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "success" => true,
            "data" => auth()->user()->posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "min:10", "max:600"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        $post = auth()->user()->posts()->create($validator->validated());

        return response()->json([
            "success" => true,
            "data" => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            "success" => true,
            "data" => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id!=auth()->id()){
            return response()->json([
                "success" => false,
                "msg" => "you can not update this msg"
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "min:10", "max:600"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        $post->update($validator->validated());

        return response()->json([
            "success" => true,
            "data" => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id!=auth()->id()){
            return response()->json([
                "success" => false,
                "msg" => "you can not delete this msg"
            ], 403);
        }
        $post->delete();
        return response()->json([
            "success" => true,
            "msg" => "you deleted this msg"
        ], 200);
    }
}
