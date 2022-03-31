<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::factory()

            ->create([

                'module_name' => 'Analysing Fiction',
                'subject_id' => 1,
                'description' => 'Fiction is usually made up by the writer. Fiction texts could be based on the writer’s own life experiences or come from their imagination (or be a mixture of the two)',

            ])

            ->create([

                'module_name' => 'Shakespeare',
                'subject_id' => 2,
                'description' => 'In this module we will cover many of Shakespeare\'s important works',

            ]);
    }
}
