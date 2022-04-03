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

                'module_name' => 'Analysing Non-Fiction',
                'subject_id' => 1,
                'description' => 'Exploring the types, audience, purpose and structure of non-fiction texts',

            ])

            ->create([

                'module_name' => 'Comparing Texts',
                'subject_id' => 1,
                'description' => 'Comparing involves directly linking texts through their similarities and differences. It is important to move equally between the two texts, and write about them together, not separately.',

            ])

            ->create([

                'module_name' => 'Writing',
                'subject_id' => 1,
                'description' => 'How to write the different kinds of text types including purpose, form, planning and organising ideas',

            ])

            ->create([

                'module_name' => 'Spelling, Punctuation and Grammar',
                'subject_id' => 1,
                'description' => 'An in-depth look at how spelling, punctuation and grammar affects your writing',

            ])

            ->create([

                'module_name' => 'Spoken Language',
                'subject_id' => 1,
                'description' => 'Exploring the factors that effect your spoken language such as personal presence, voice, responding and interacting',

            ])

            ->create([

                'module_name' => 'Shakespeare',
                'subject_id' => 2,
                'description' => 'In this module we will cover many of Shakespeare\'s important works',

            ])

            ->create([

                'module_name' => 'Cell Biology',
                'subject_id' => 5,
                'description' => 'A look at the workings and make up of cells such as structure and cell division',

            ])

            ->create([

                'module_name' => 'Organisation',
                'subject_id' => 5,
                'description' => 'In-depth look at the organisation of the different types of cells',

            ])

            ->create([

                'module_name' => 'Infection and Response',
                'subject_id' => 5,
                'description' => 'Exploring diseases, how they spread and how they might be treated or cured',

            ])

            ->create([

                'module_name' => 'Bioenergetics',
                'subject_id' => 5,
                'description' => 'Discovering the mechanisms behind energy creation in plants and organisms',

            ])

            ->create([

                'module_name' => 'Homeostasis and Response',
                'subject_id' => 5,
                'description' => 'Exploring the human nervous and endocrine systems, hormones, homeostasis and plant hormones',

            ])

            ->create([

                'module_name' => 'Inheritance and Evolution',
                'subject_id' => 5,
                'description' => 'Exploring the mechanics of inheritance through the genome and genes, genetic inheritance, variation and evolution',

            ])

            ->create([

                'module_name' => 'Ecology',
                'subject_id' => 5,
                'description' => 'The study of the relationships between living organisms, including humans, and their physical environment; it seeks to understand the vital connections between plants and animals and the world around them.',

            ])

            ->create([

                'module_name' => 'Practical Skills',
                'subject_id' => 5,
                'description' => 'Scientific investigations have several stages - planning, collecting data, analysing data and evaluation. It is important to understand how to carry out each stage of the investigation.',

            ])

            ->create([

                'module_name' => 'Atomic Structure',
                'subject_id' => 6,
                'description' => 'Exploring diseases, how they spread and how they might be treated or cured',

            ])

            ->create([

                'module_name' => 'Properties of Matter',
                'subject_id' => 6,
                'description' => 'Looking at bonding, structure, the 3 states of matter, compounds and metals and alloys',

            ])

            ->create([

                'module_name' => 'Quantitative Chemistry',
                'subject_id' => 6,
                'description' => 'The calculations involved in chemistry to obtain masses, concentration of solutions and percentage yield',

            ])

            ->create([

                'module_name' => 'Chemical Changes',
                'subject_id' => 6,
                'description' => 'Chemical changes occur when a substance combines with another to form a new substance, called chemical synthesis or, alternatively, chemical decomposition into two or more different substances.',

            ])

            ->create([

                'module_name' => 'Energy Exchanges',
                'subject_id' => 6,
                'description' => 'Energy exchanges occur in exothermic and endothermic reactions as well as in chemical cells such as batteries',

            ])

            ->create([

                'module_name' => 'Areas of Study',
                'subject_id' => 8,
                'description' => 'Exploring the mediums of art such as ceramics, drawing and painting',

            ])

            ->create([

                'module_name' => 'Creative Process',
                'subject_id' => 8,
                'description' => 'A look at the process involved in creating art such as inspiration, responding to stimuli, developing ideas and analysis and evaluation',

            ])

            ->create([

                'module_name' => 'Elements of Art',
                'subject_id' => 8,
                'description' => 'Looking at the elements that create a piece of art such as colour, tone and shape',

            ])

            ->create([

                'module_name' => 'Principles of Design',
                'subject_id' => 8,
                'description' => 'Looking at the basic principles of design',

            ])

            ->create([

                'module_name' => 'Business in the real world',
                'subject_id' => 9,
                'description' => 'Examining the the factors that effect businesses in the real world',

            ])

            ->create([

                'module_name' => 'Influences on Business',
                'subject_id' => 9,
                'description' => 'Examining the influences on businesses such as technology, ethical and environmental issues and legislation',

            ])

            ->create([

                'module_name' => 'Business Operations',
                'subject_id' => 9,
                'description' => 'Exploring the operations of a business',

            ])

            ->create([

                'module_name' => 'Human Resources',
                'subject_id' => 9,
                'description' => 'Businesses have many different roles and responsibilities and need staff to carry them out. The role of human resources is to identify the needs of the business and ensure that they are met.',

            ])

            ->create([

                'module_name' => 'Marketing',
                'subject_id' => 9,
                'description' => 'Identifying and understanding customer needs and the elements of the marketing mix',

            ])

            ->create([

                'module_name' => 'Finance',
                'subject_id' => 9,
                'description' => 'Identifying how finance can effect a business and its performance',

            ]);

    }
}
