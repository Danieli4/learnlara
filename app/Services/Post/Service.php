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

            $data['category_id'] = $this->getCategoryId($category);
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

    public function update($post, $data)
    {
        try {
            Db::beginTransaction();
            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tagIds = $this->getTagIdsWithUpdate($tags);
            $data['category_id'] = $this->getCategoryIdWithUpdate($category);
            //dd($data);

            $post->update($data);
            $post->tags()->sync($tagIds);
            Db::commit();
        } catch(\Exception $exception){
            Db::rollBack();
            return $exception->getMessage();

        }
        return $post->fresh();
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


    private function getTagIdsWithUpdate($tags)
    {
        $tagIds = [];
        //dd($tags);
        foreach ($tags as $tag) {
            if (!isset($tag['id'])) {
                //dd($tag);
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                //dd($currentTag);
                $tag = $currentTag->fresh();
                //dd($tag);

            }
            $tagIds[] = $tag->id;
            //dd($tagIds);
        }
        return $tagIds;
    }

    private function getCategoryIdWithUpdate($item)
    {
        //dd($item);
        if(!isset($item['id'])){
            $category = Category::create($item);
            //dd($category);
        }
        else{
            $category = Category::find($item['id']);

            $category->update($item);
            $category=$category->fresh();
        }

        return $category->id;
    }

    private function getCategoryId($item)
    {
        $category= !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
    }

}
