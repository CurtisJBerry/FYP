<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory()

            ->create([

                'subject_name' => 'English Language',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE English Language through the AQA exam board'

            ])

            ->create([

                'subject_name' => 'English Literature',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE English Literature through the AQA exam board',

            ]);
    }
}
