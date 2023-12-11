<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;



    /**
     * fillable
     * Les attributs de Participant renseignables
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'survey_id'
    ];

    /**
     * survey
     * récupère le sondage de ce participant
     * @return BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Creation du participant + enregistrement de ses reponses
     */
    public static function save_answers($email, $survey_id, $answers)
    {
        try {

            if(!isset($email)) {
                throw new \Exception("email non renseigné");
            }
            if(!isset($survey_id)) {
                throw new \Exception("survey_id non renseigné");
            }
            if(!isset($answers)) {
                throw new \Exception("answers non renseigné");
            }

            $answerParticipant = [];
            $participant = null;

            //creation de l'entité participant
            $participant = Participant::create(
                [
                   "email" => $email,
                   "token" => base64_encode($email),
                   "survey_id" => $survey_id
                   ]
            );

            //Sauvegardes des reponses
            foreach($answers as $answer) {
                $answer = Answer::create([
                    "value" => $answer["value"],
                    "email" => $email,
                    "survey_id" => $survey_id,
                    "question_id" => $answer["question_id"],
                ]);

                array_push($answerParticipant, $answer);

            };

            return  (object)["participants" => $participant,"answers" => $answerParticipant];

        } catch (\Throwable $th) {
            throw $th;
        }


    }

}
