<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    /**
     * fillable
     * Les attributs de Answer renseignables
     * @var array
     */
    protected $fillable = [
        'value',
        'question_id',
        'survey_id',
        'email'
    ];

    /**
     * question
     * retourne la question liée à cette réponse
     * @return BelongsTo
     */
    public function question(): BelongsTo {
        return $this->belongsTo(Question::class);
    }

    /**
     * participant
     * retourne le participant qui a donné cette réponse
     * @return BelongsTo
     */
    public function participant(): BelongsTo {
        return $this->belongsTo(Participant::class);
    }
}
