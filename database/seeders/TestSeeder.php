<?php

namespace Database\Seeders;

use App\Models\Test;
use Database\Factories\TestFactory;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::factory()

            ->create([

                'test_name' => 'Fiction Text Types',
                'submodule_id' => 1,
            ]);

    }
}
