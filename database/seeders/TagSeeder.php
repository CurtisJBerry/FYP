<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Tag::factory()

            ->create([

                'tag_name' => 'reading',

            ])

            ->create([

                'tag_name' => 'auditory',

            ])

            ->create([

                'tag_name' => 'visual',

            ])

            ->create([

                'tag_name' => 'kinesthetic',

            ]);


    }
}
