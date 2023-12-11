<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Participant;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class AnswersBigScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$answersSaved = Participant::save_answers($email, $survey_id, $answers);
    }


    private function generate_participant()
    {
        $faker = Factory::create();

        $email = $faker->email();
        $survey_id = Survey::findByTitle("Sondage Big Screen")->id;


    }

    private function generate_answers($email, $survey_id) {}


    private function bigScreenQuestion()
    {
        // chemin d'accès à votre fichier JSON
        $file = public_path("questions.json");
        // décoder le flux JSON
        $questions = json_decode(file_get_contents($file));

        $cb =  function ($v) {
            $title =  $v["body"];
            $propositions = $v["proposition"];
            if(!isset($propositions)) {
                $propositions = null;
            }

            return ["question_id" => "","type" => $v["type"],"proposition" => $propositions];
        } ;

        return array_map($cb, $questions);

    }

}
