<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'id_survey'
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
}
