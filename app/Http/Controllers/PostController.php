<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 1)->get();
        foreach ($posts as $post) {
            dump($post->title);
        }
        dd($posts);
    }

    public function create()
    {
        $postArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'some interesting content',
                'image' => 'imageblabla',
                'likes' => '20',
                'is_published' => 0,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'another imageblabla',
                'likes' => 30,
                'is_published' => 1,
            ],

        ];

        foreach ($postArr as $post){
            Post::create($post);
        }


        dd('created');
    }

    public function update(){
        $post=Post::find(6);
        $post->update([
            'title' => 'updated',
            'content' => 'updated',
            'image' => 'updated',
            'likes' => 10,
            'is_published' => 0,

        ]);

        //dd($post->title);
    }

    public function delete(){
        $post=Post::find(2);
        $post->delete();
        //dd('delete');

    }

    public function restore(){
        $post=Post::withTrashed()->find(2);
        $post->restore();
        //dd('delete');

    }
    public function firstOrCreate(){
        $post=Post::find(1);
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
