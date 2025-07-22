<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(?int $user_id = null)
    {
        if ($user_id === null) {
            $posts = Post::latest()->paginate(6);
        } else {
            $posts = Post::latest()->where('user_id', $user_id)->paginate(6);
        }
        return view('posts.index', compact('posts'));
    }

    public function manage()
    {
        $user_id = auth()->user()->id;


        $posts = Post::latest()->where('user_id', $user_id)->paginate(6); // Получаем посты с пагинацией
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
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        $user_id = auth()->user()->id;

        if ($request->hasFile('logo')) {
            $logo = $request->logo->store('/', 'post_logos');


            $manager = new ImageManager(new Driver());
            $logo_compressed = $manager->read('storage/images/post_logos/'.$logo);
            $logo_compressed->scale(width: 200);
            $logo_compressed->save('storage/images/post_logos/comp/'.$logo);
        } else {
            $logo = null;
        }

        Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'color' => $request['color'],
            'user_id' => $user_id,
            'logo' => $logo,
        ]);


        return redirect()->route('all_posts')->with('success', 'Пост успешно создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->personal !== 0) {
            abort(404);
        }
        return view('posts.show', compact('post'));
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
        // обновлять можно только свои посты
        if (!$post->isAuthor()) {
            abort(404);
        }


        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|min:50',
        ]);

        $post->update($request->all());


        return redirect()->route('posts.manage')->with('success', 'Пост успешно обновлён!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.manage')->with('success', 'Пост успешно удален!');
    }
}
