<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {

        $tags = $data['tags'];
        unset($data['tags']);

//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                'tag_id'=>$tag,
//                'post_id'=>$post->id,
//            ]);
//        }
//        более простой метод привязки тегов к посту:
        $post = Post::create($data);
        $post->tags()->attach($tags);
        return $post;
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return $post->fresh();
    }

}
