<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // chemin d'accès à votre fichier JSON
        $file = public_path("questions.json");
        // décoder le flux JSON
        $questions = json_decode(file_get_contents($file));
        $survey = Survey::find(1);
        foreach ($questions as $key => $question) {
            // creéation de chaque question
            $newQuestion = $survey->questions()->create([
                'question_number' => $key+1,
                'question_body' => $question->body,
                'question_type' => $question->type,
            ]);
            if (isset($question->propositions)) {
                // création des propositions s'il en existe pour chaque question
                foreach ($question->propositions as $key => $proposition) {
                    $newQuestion->propositions()->create([
                        'proposition' => $proposition
                    ]);
                }
            }
        }
        //$questions = json_decode($data);
    }
}
