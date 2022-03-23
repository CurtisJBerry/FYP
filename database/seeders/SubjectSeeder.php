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

            ])

            ->create([

                'subject_name' => 'Art and Design',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Art and Design features a wide range of titles including Art, craft and design, Fine art, Graphic communication, Textile design, Three-dimensional design and Photography. ',

            ])

            ->create([

                'subject_name' => 'Business',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Business Studies is designed for students finishing secondary school to learn skills for running a business, such as managing money, advertising and employing staff.',

            ])

            ->create([

                'subject_name' => 'Computer Science',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Computer Science through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Design and Technology',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Design and Technology through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Digital Technology',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Digital Technology through the CCEA exam board.',

            ])

            ->create([

                'subject_name' => 'Drama',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Drama through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'French',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE French through the AQA exam board.',

            ])

            ->create([

                'subject_name' => 'Geography',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Geography is a course that studies geography in a balanced framework of physical and human themes and investigates the link between them.',

            ])

            ->create([

                'subject_name' => 'German',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE German will enable students of all abilities to develop their German language skills to their full potential, equipping them with the knowledge to communicate in a variety of contexts with confidence. ',

            ])

            ->create([

                'subject_name' => 'History',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE History covers a range of areas from the 12th Century to the Modern Day.',

            ])

            ->create([

                'subject_name' => 'Food and Nutrition',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Home Economics: Food Nutrition from the CCEA exam board.',

            ])

            ->create([

                'subject_name' => 'Hospitality',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Hospitality covers a worldwide industry requiring a wide range of skills.',

            ])

            ->create([

                'subject_name' => 'ICT',
                'exam_board' => 'WJEC',
                'subject_level' => 'GCSE',
                'description' => 'GCSE ICT allows students to identify and solve real problems by designing information and communication systems in a wide range of contexts relating to their personal interests.',

            ])

            ->create([

                'subject_name' => 'Irish',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Irish includes text, audio and quizzes designed to help you understand and use Gaeilge.',

            ])

            ->create([

                'subject_name' => 'Journalism',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Journalism covers the industry theory and radio production.',

            ])

            ->create([

                'subject_name' => 'Learning for Life and Work',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Learning for Life and Work provides students with the skills they require to think independently, make informed decisions, and take appropriate action when faced with personal, social, economic and employment issues. ',

            ])

            ->create([

                'subject_name' => 'Maths Numeracy',
                'exam_board' => 'WJEC',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Maths Numeracy features maths problems in real-world situations and demonstrates the most efficient ways to calculate the correct solution.',

            ])

            ->create([

                'subject_name' => 'Media Studies',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Media Studies encourages students to develop their creative, analytical, research, and communication skills, through exploring a range of media forms and perspectives.',

            ])

            ->create([

                'subject_name' => 'Moving Images Arts',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Moving Images Arts develops critical and creative abilities in all of the key creative areas of film production, including writing, directing, editing, producing and production design.',

            ])

            ->create([

                'subject_name' => 'Music',
                'exam_board' => 'CCEA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Music includes elements of music, music appreciation, classical orchestral music, music for dance, contemporary music and world music',

            ])

            ->create([

                'subject_name' => 'Physical Education',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Physical Education covers anatomy, training, sports psychology, health and well being and much more.',

            ])

            ->create([

                'subject_name' => 'Religious Studies',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Religious Studies covers a range of the major world religions, six contemporary ethical themes and two textual studies',

            ])

            ->create([

                'subject_name' => 'Spanish',
                'exam_board' => 'AQA',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Spanish enables students of all abilities to develop their Spanish language skills to their full potential, equipping them with the knowledge to communicate in a variety of contexts with confidence.',

            ])

            ->create([

                'subject_name' => 'Welsh Second Language',
                'exam_board' => 'WJEC',
                'subject_level' => 'GCSE',
                'description' => 'GCSE Welsh Second Language enables learners to understand and use the language for a variety of purposes and audiences.',

            ]);


    }
}
