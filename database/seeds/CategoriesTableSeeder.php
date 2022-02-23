<?php

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['Tecnologia', 'Motori', 'Casa', 'Architettura', 'Medicina', 'Viaggi', 'Economia'];

        foreach ($categories as $category) {
            
            $newCategory = new Category();

            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category, $separator = '-');

            $newCategory->save();

        }

    }
}
