<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index(): string
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));

    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

   /* public function delete()
    {
        $post = Post::find(2);
        $post->delete();
        dd('delete');
    }*/
    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('delete');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function firstOrCreate()
    {

        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some imageblalba.jpg',
            'likes' => 50000,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
                'title' => 'some post'
            ],[
                'title' => 'some post',
                'content' => 'some content',
                'image' => 'some imageblalba.jpg',
                'likes' => 50000,
                'is_published' => 1,
            ]);
        dump($post->content);
        dd('end');
    }
    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'updateorcreate some post',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some imageblalba.jpg',
            'likes' => 50000,
            'is_published' => 1,
        ];
        $post = Post::updateOrCreate([
            'title' => 'some not post',

        ],[
                'title' => 'updateorcreate some post',
                'content' => 'updateorcreate some content',
                'image' => 'updateorcreate some imageblalba.jpg',
                'likes' => 50000,
                'is_published' => 1,
        ]);
        dd(222);
    }

    private function compacts(string $string)
    {
    }

}
