<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    /**
     * fillable
     * Les attributs de Sondage renseignables
     * @var array
     */
    protected $fillable = [
        'question_number',
        'question_body',
        'question_type',
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
}
