<?php

namespace Database\Seeders;

use App\Models\Survey;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Generator();
        Survey::create([
            'title' => "Sondage Big Screen",
            'description' => "Sondage Big Screen"
        ]);
    }
}
