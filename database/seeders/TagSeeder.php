<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Mecha',
                'description' => 'Involves mechs, which are massive robots or human-controlled robotic machines',
                'category_id' => 1,
            ],
            [
                'name' => 'Slice of Life',
                'description' => 'Captures the daily lives of the characters and the drama around them',
                'category_id' => 2,
            ],
            [
                'name' => 'Mahou Shoujo',
                'description' => 'Female protagonists with magical powers',
                'category_id' => 3,
            ],
            [
                'name' => 'Isekai',
                'description' => '	Protagonist dies in the real world and gets reincarnated into a magical world/fantasy land',
                'category_id' => 2,
            ],
            [
                'name' => 'Yaoi',
                'description' => '	Romance between men',
                'category_id' => 5,
            ],
            [
                'name' => 'Yuri',
                'description' => '	Romance between women',
                'category_id' => 5,
            ],
            [
                'name' => 'Harem',
                'description' => '	The protagonist is surrounded by many female characters',
                'category_id' => 4,
            ],
            [
                'name' => 'Ecchi',
                'description' => '	Involves adult comedies and explicit content',
                'category_id' => 4,
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
