<?php

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try {
            Db::beginTransaction();
            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $data['category_id']= $this->getCategoryId($category);

            $tagIds = $this->getTagIds($tags);

//            PostTag::firstOrCreate([
//                'tag_id'=>$tag,
//                'post_id'=>$post->id,
//            ]);
//        }
//        более простой метод привязки тегов к посту:
            $post = Post::create($data);
            $post->tags()->attach($tagIds);
            Db::commit();

        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();

        }


        return $post;
    }

    private function getTagIds($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {

            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    private function getCategoryId($item)
    {
        $category= !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
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
