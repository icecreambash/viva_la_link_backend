<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Business',
            'Economy'
        ];

        foreach ($categories as $category)
        {
            if(!Category::where('slug',$category)->exists())
            {
                Category::create(
                    [
                        'title' => $category,
                        'slug' => Str::lower($category),
                    ]
                );
            }
        }
    }
}
