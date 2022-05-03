<?php

namespace Database\Seeders;

use App\Models\SubModule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            SubjectSeeder::class,
            ModuleSeeder::class,
            TagSeeder::class,
            SubModuleSeeder::class,
            TestSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
