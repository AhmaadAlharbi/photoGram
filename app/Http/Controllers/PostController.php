<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'description' => 'required', // Ensure the 'description' field is present and not empty
            'image' => ['required', 'mimes:jpeg,jpg,png,gif'] // Ensure the 'image' field is present and has an allowed file type
        ]);

        // Store the uploaded image in the 'public/posts' directory and update the 'image' field in $data
        $image = $request['image']->store('posts', 'public');
        $data['image'] = $image;

        // Generate a random slug for the post
        $data['slug'] = Str::random(10);

        // Create a new post associated with the authenticated user
        auth()->user()->posts()->create($data);

        // Redirect back to the previous page after successful post creation
        return redirect()->back();
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
}
