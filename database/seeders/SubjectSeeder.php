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
                'description' => 'GCSE English Language through the AQA exam board.'

            ])

            ->create([

                'subject_name' => 'English Literature',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE English Literature through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Maths',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Maths through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Combined Science',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Combined Science through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Biology (Single Science)',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Biology is the study of living organisms and their structure, life cycles, adaptions and environment.',

            ])

            ->create([

                'subject_name' => 'Chemistry (Single Science)',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Chemistry is the study of the composition, behaviour and properties of matter, and of the elements of the Earth and its atmosphere.',

            ])

            ->create([

                'subject_name' => 'Physics (Single Science)',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Physics  is the study of energy, forces, mechanics, waves, and the structure of atoms and the physical universe.',

            ]);
    }
}
