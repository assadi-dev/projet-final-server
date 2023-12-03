<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    /**
     * fillable
     * Les attributs de Question renseignables
     * @var array
     */
    protected $fillable = [
        'question_number',
        'question_body',
        'question_type',
        'required',
        'is_email',
        'survey_id'
    ];

    /**
     * survey
     * Récupère l'objet sondage lié à une question
     * @return BelongsTo
     */
    public function survey(): BelongsTo{
        return $this->belongsTo(Survey::class);
    }

    /**
     * propositions
     * récupère les propositions liées à une question
     * @return HasMany
     */
    public function propositions(): HasMany{
        return $this->hasMany(Proposition::class);
    }

    /**
     * answers
     * récupère toutes les réponses liées à cette question
     * @return HasMany
     */
    public function answers(): HasMany{
        return $this->hasMany(Answer::class);
    }

    /**
     * answer
     * récupère la réponse liée à un participant donné et à cette question
     * @param  mixed $param
     * @return HasOne
     */
    public function answer(Participant $param): HasOne{
        return $this->hasOne(Answer::where('survey_id', $param->survey_id)
                                    ->where('email', $param->email)
                                    ->where('question_id', $this->id)->get());
    } // reste à tester si valable
}
