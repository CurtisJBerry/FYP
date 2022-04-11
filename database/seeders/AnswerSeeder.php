<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::factory()

            ->create([

                'question_id' => 15,
                'answer_text' => 'Poem',
                'correct' => 'n',
            ])

            ->create([

                'question_id' => 15,
                'answer_text' => 'Novel',
                'correct' => 'y',
            ])

            ->create([

                'question_id' => 15,
                'answer_text' => 'Newspaper article',
                'correct' => 'n',
            ]);


    }
}
