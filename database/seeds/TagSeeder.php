<?php

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['auto', 'moto', 'computer', 'smartphone', 'casa'];

        foreach ( $tags as $tag ) {
            $newTag = new Tag();

            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, $separator = '-');

            $newTag->save();
        }
    }
}
