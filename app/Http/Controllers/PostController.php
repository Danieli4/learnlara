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
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create()

    {
        $categories = Category::all();
        return view('post.create', compact('categories'));

    }

    public function store()

    {

        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id'=>'',
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
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
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
