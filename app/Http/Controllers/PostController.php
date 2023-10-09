<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\DestroyRequest;
use App\Http\Requests\Post\EditRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // option 2: authorization
        // $this->middleware('authorize', [
        //     'only' => ['edit', 'update', 'destroy'],
        //     'except' => ['index', 'show']
        // ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::published() // where('published_at', '!=', null)
            ->orderBy('created_at', 'desc')
            ->paginate();
        // $posts = Post::orderBy('created_at', 'desc')->simplePaginate();

        return view('dashboard')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedRequest = $request->validated();

        Post::create($validatedRequest);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // Post $post
    {
        $post = Post::find($id);
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(2);

        return view('post.view')
            ->with('post', $post)
            ->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditRequest $request, Post $post) // Post $post
    {
        // $post = Post::find($id);

        return view('post.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $validatedRequest = $request->validated();

        (new Post)->updatePost($post->id, $validatedRequest);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, Post $post)
    {
        // Post::find($id)->delete();
        $post->delete();

        return redirect()->route('dashboard');
    }
}
