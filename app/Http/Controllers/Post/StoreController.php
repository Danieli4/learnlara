<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);



        $post = Post::create($data);

//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                'tag_id'=>$tag,
//                'post_id'=>$post->id,
//            ]);
//        }
//        более простой метод привязки тегов к посту:
        $post->tags()->attach($tags);



        return redirect()->route('post.index');
    }

}
