<?php

namespace Database\Seeders;

use App\Models\SubModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubModule::factory()

            ->create([

                'submodule_name' => 'Fiction Text Types',
                'module_id' => 1,
                'description' => 'Fiction is usually made up by the writer. Fiction texts could be based on the writer’s own life experiences or come from their imagination (or be a mixture of the two).',

            ])

            ->create([

                'submodule_name' => 'Setting',
                'module_id' => 1,
                'description' => 'The setting of a text includes the location and time when events take place. Setting can play a crucial part in establishing atmosphere and reflecting themes and character within a text.',

            ])

            ->create([

                'submodule_name' => 'Themes',
                'module_id' => 1,
                'description' => 'Themes are the main ideas or meaning that run through a text and may be shown directly or indirectly. When working out themes it helps to look closely at the language choice, setting and characters.',

            ])

            ->create([

                'submodule_name' => 'Characterisation and narrative voice',
                'module_id' => 1,
                'description' => 'Characterisation is when a writer creates fictional characters for a narrative.',

            ])

            ->create([

                'submodule_name' => 'Language and structure',
                'module_id' => 1,
                'description' => 'Language (words and phrases) and structure (the order of ideas in a text) are the methods used by writers to create effective characters, setting, narratives and themes.',

            ])

            ->create([

                'submodule_name' => 'Annotating texts',
                'module_id' => 1,
                'description' => 'Annotating is when you add notes or comments to a text; this could also include underlining or circling individual words or phrases.',

            ])

            ->create([

                'submodule_name' => 'Responding to a fiction text',
                'module_id' => 1,
                'description' => 'When responding to a fiction text you will be asked to focus on a particular area, picking out specific details or responding more fully with a close analysis.',

            ]);
    }
}
