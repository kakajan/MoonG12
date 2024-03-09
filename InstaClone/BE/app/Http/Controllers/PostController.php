<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function like(Request $request)
    {
        $post = Post::find($request->postId);
        $likeStat = false;
        $myLike = $post->likes->where('user_id', $request->user()->id)->first();
        if ($myLike) {
            $post->usersLiked()->detach($request->user()->id);
            $likeStat = false;
        } else {
            $likeStat = true;
             $post->usersLiked()->attach($request->user()->id);
        }
        return ['status' => true, 'likeStat' => $likeStat, 'like'=>$post->usersLiked[0]->pivot];
    }
    public function unlike(Request $request)
    {
        $post = Post::find($request->postId);
        $post->usersLiked()->detach($request->user()->id);

        return true;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $likes = $post->likes;
            foreach ($likes as $like) {
                if ($like->user_id == $request->user()->id) {
                    $post->liked = true;
                } else {
                    $post->liked = false;
                }
            }
        }
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $request['user_id'] = $user->id;
        $post = Post::create($request->all());
        if ($post) {
            return response()->json(['status' => true, 'post' => $post]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function myPost(Request $request)
    {
        $user = $request->user();
        // return $user->posts;
        return response()->json(["myPosts" => $user->posts]);
    }
}
