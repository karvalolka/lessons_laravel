<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends BaseController
{
    public function index(FilterRequest $request): string
    {
        $data = $request->validated();
        $query = Post::query();

        if (isset($data['category_id'])){
            $query->where('category_id', $data['category_id']);
        }
        if (isset($data['title'])){
            $query->where('title', 'like', "%{$data['title']}%");
        }
        if (isset($data['content'])){
            $query->where('content', 'like', $data['content']);
        }

        $posts = $query->get();
        dd($posts);

        //$posts = Post::paginate(10);
        //return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));

    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $this->service->update($post, $data);

        return redirect()->route('post.show', $post->id);
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
        ], [
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

        ], [
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
