<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()

            ->create([

                'description' => 'Which of the following is a prose fiction text?',
                'type' => 'reading',
                'test_id' => 1,
            ]);
    }
}
