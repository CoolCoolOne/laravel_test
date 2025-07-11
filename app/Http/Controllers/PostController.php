<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6); // Получаем посты с пагинацией
        return view('posts.index', compact('posts'));
    }

    public function manage()
    {
        $user_id = auth()->user()->id;


        $posts = Post::latest()->where('user_id',$user_id)->paginate(6); // Получаем посты с пагинацией
        return view('posts.manage', compact('posts'));
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


        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|min:50',
        ]);

        $user_id = auth()->user()->id;


        Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'user_id' => $user_id,
        ]);


        return redirect()->route('all_posts')->with('success', 'Пост успешно создан!');
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
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->all()); // Обновляем пост

        return redirect()->route('posts.index')->with('success', 'Пост успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete(); // Удаляем пост

        return redirect()->route('posts.index')->with('success', 'Пост успешно удален!');
    }
}
