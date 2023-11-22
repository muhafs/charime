<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kodomomuke',
                'target' => 'Kids',
                'description' => 'The kids anime genre usually focuses on genres like adventure drama, family, and more.',
            ],
            [
                'name' => 'Shonen',
                'target' => 'Teen',
                'description' => 'The teen anime genre includes action, adventure, and drama themes but can accommodate sci-fi, mystery, sports, etc.',
            ],
            [
                'name' => 'Shoujo',
                'target' => 'Teen Girls',
                'description' => 'The teen girls anime basically revolves around romance, comedy, and drama genres, but it can cover supernatural, fantasy, and more themes.',
            ],
            [
                'name' => 'Seinen',
                'target' => 'Adult',
                'description' => 'This adult anime category usually incorporates an action and adventure storyline with graphic content like violence, erotic, horror, etc.',
            ],
            [
                'name' => 'Josei',
                'target' => 'Adult Girls',
                'description' => 'This adult females anime category revolves around romance and drama themes but is also grounded in reality.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
