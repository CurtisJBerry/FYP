<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_name' => $this->faker->realText(),
            'exam_board' => $this->faker->text(),
            'subject_level' => $this->faker->realText(),
            'description' => $this->faker->realText(),
        ];
    }
}
