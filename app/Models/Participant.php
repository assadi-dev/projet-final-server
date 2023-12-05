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
     * primaryKey
     * la clé composite de participant formé par
     * l'id du sondage et email
     * @var array
     */
    protected $primaryKey = [
        'survey_id',
        'email'
    ];

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
    public function survey(): BelongsTo {
        return $this->belongsTo(Survey::class);
    }

    public function answers(): HasMany {
        return $this->hasMany(Answer::class);
    }
}