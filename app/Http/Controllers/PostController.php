<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index(): string
    {
        return view('posts');
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'some interesting content',
                'image' => 'imageblalba.jpg',
                'likes' => 20,
                'is_published' => 1,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'another imageblalba.jpg',
                'likes' => 50,
                'is_published' => 1,
            ]
        ];

        foreach ($postsArr as $item){
            Post::create($item);
        }

        dd('create');
    }

    public function update()
    {
        $post = Post::find(5);
        $post->update([
            'title' => 'updated',
            'content' => 'updated',
            'image' => 'updated',
            'likes' => 1000,
            'is_published' => 100,
        ]);
        dd('update');
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
