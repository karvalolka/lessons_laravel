<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\Post\Service;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(FilterRequest $request)
    {

        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return PostResource::collection($posts);
        //return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::all();
        return view('admin.post.create', compact('categories', 'tags', 'posts'));
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $post = $this->service->store($data);

        return new PostResource($post);

        //return redirect()->route('admin.post.index');
    }

    public function show(Post $post)
    {
        $posts = Post::all();
        return view('admin.post.show', compact('post', 'posts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags', 'posts'));

    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $post = $this->service->update($post, $data);
        return new PostResource($post);

        //return redirect()->route('admin.post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
