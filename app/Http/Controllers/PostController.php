<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $comments = $post->comments;
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // $this->authorize('update', $post);
        $data = $request->validate([
            'description' => 'required',
            'image' => ['nullable', 'mimes:jpeg,jpg,png,gif']
        ]);

        if ($request->has('image')) {
            $image = $request['image']->store('posts', 'public');
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect('/p/' . $post->slug);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);

        Storage::delete('public/' . $post->image);
        $post->delete();
        return redirect(url('/'));
    }
}
