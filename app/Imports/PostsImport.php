<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PostsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        foreach ($collection as $item) {
            if(isset($item['0']) && $item['0']!== null){
                //dd($item['4']);
                Post::firstOrCreate(['title'=>$item[0]
                ],[
                    'title'=>$item[0],
                    'content'=>$item[1],
                    'image' => $item[2],
                    'likes'=>$item[3],
                    'is_published'=>(int)[4],
                    'category_id'=> (int)[5],

                ]);

            }

        }
    }
}
