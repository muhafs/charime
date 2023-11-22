<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characters = [
            [
                'name' => 'Doraemon',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 1,
            ],
            [
                'name' => 'Ash Ketchum',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 2,
            ],
            [
                'name' => 'Naruto Uzumaki',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 3,
            ],
            [
                'name' => 'Ichigo Kurosaki',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 4,
            ],
            [
                'name' => 'Aslan Jade Callenreese',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 5,
            ],
            [
                'name' => 'Usagi Tsukino',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 6,
            ],
            [
                'name' => 'Guts',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 7,
            ],
            [
                'name' => 'Johan Wilhelm Liebert',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 8,
            ],
            [
                'name' => 'Tsukimi Kurashita',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 9,
            ],
            [
                'name' => 'Chihaya Ayase',
                'brief' => null,
                'type' => 'HERO',
                'series_id' => 10,
            ],
        ];

        foreach ($characters as $character) {
            Character::create($character);
        }
    }
}
