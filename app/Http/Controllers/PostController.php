<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        $tag = Tag::find(1);
        dd($post->tags);
        //return view('post.index', compact('posts'));
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

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

//    public function delete()
//    {
//        $post = Post::find(2);
//        $post->delete();
//        //dd('delete');
//
//    }

    public function restore()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        //dd('delete');

    }

    public function firstOrCreate()
    {
        $post = Post::find(1);
        $anotherPost = [
            'title' => 'some post',
            'content' => 'some 1111 content',
            'image' => 'some imageblabla',
            'likes' => 20,
            'is_published' => 0,
        ];
        $post = Post::firstOrCreate([
            'title' => 'some title of post from phpstorm',

        ], $anotherPost);
        dump($post->content);
        dd('finished');

    }

    public function updateOrCreate()
    {
        $post = Post::find(1);
        $anotherPost = [
            'title' => 'update some post',
            'content' => 'update some and content',
            'image' => 'update some imageblabla',
            'likes' => 20000,
            'is_published' => 0,
        ];
        $post = Post::updateOrCreate([
            'title' => 'some post',

        ], $anotherPost);
        dump($post->content);
        dd('finished');
    }
}
