<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Participant;
use App\Models\Question;
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
        dd($this->bigScreenQuestion());


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
            $title =  $v->body;
            $question = Question::findbyQuestionBody($title);
            $propositions = null;
            if(isset($v->propositions)) {
                $propositions = $v->propositions;
            }

            return ["question_id" =>  $question->id,"title" => $title,  "type" => $v->type,"propositions" => $propositions];
        };

        return array_map($cb, $questions);

    }

}
