<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class AnswersBigScreenSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$answersSaved = Participant::save_answers($email, $survey_id, $answers);
        // dd($this->faker->email());

        dd($this->generate_answers($this->faker->email(), null));

    }


    private function generate_participant()
    {


        $email = $this->faker->email();
        $survey_id = Survey::findByTitle("Sondage Big Screen")->id;


    }

    private function generate_answers($email, $survey_id)
    {

        $bigScreenQuestions = $this->bigScreenQuestion();

        $cb = function ($questionItem) use ($email) {
            $type = $questionItem["type"];
            $propositions = $questionItem["propositions"];
            if($questionItem["body"] == "votre adresse email") {
                $value = $email;
            } else {
                $value = $this->generate_answer_by_type($type, $propositions);
            }

            return ["question_id" => $questionItem["question_id"],"value" => $value ];
        };
        return  array_map($cb, $bigScreenQuestions);
    }


    /**
     * génération d'un tableau contenant les question de bigscreen
     */
    private function bigScreenQuestion()
    {
        // chemin d'accès à votre fichier JSON
        $file = public_path("questions.json");
        // décoder le flux JSON
        $questions = json_decode(file_get_contents($file), true);

        $cb =  function ($v) {
            $body =  $v["body"];
            $question = Question::findbyQuestionBody($body);
            $propositions = null;
            if(isset($v["propositions"])) {
                $propositions = $v["propositions"];
            }

            return ["question_id" =>  $question->id,"body" => $body,  "type" => $v["type"],"propositions" => $propositions];
        };

        return  array_map($cb, $questions);

    }

    private function generate_answer_by_type($type, $propositions)
    {

        switch ($type) {
            case 'A':
                return $this->faker->randomElement($propositions);
            case 'B':
                return $this->faker->words(5, true);
                ;
            case 'C':
                return $this->faker->numberBetween(1, 5);


        }

    }

}
