<?php

namespace Database\Seeders;

use App\Models\Series;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $series = [
            [
                'title' => 'Doraemon',
                'synopsis' => null,
                'category_id' => 1,
            ],
            [
                'title' => 'Pokemon',
                'synopsis' => null,
                'category_id' => 1,
            ],
            [
                'title' => 'Naruto',
                'synopsis' => null,
                'category_id' => 2,
            ],
            [
                'title' => 'Bleach',
                'synopsis' => null,
                'category_id' => 2,
            ],
            [
                'title' => 'Banana Fish',
                'synopsis' => null,
                'category_id' => 3,
            ],
            [
                'title' => 'Sailor Moon',
                'synopsis' => null,
                'category_id' => 3,
            ],
            [
                'title' => 'Berserk',
                'synopsis' => null,
                'category_id' => 4,
            ],
            [
                'title' => 'Monster',
                'synopsis' => null,
                'category_id' => 4,
            ],
            [
                'title' => 'Princess Jellyfish',
                'synopsis' => null,
                'category_id' => 5,
            ],
            [
                'title' => 'Chihayafuru',
                'synopsis' => null,
                'category_id' => 5,
            ],
        ];

        foreach ($series as $series) {
            Series::create($series);
        }
    }
}
