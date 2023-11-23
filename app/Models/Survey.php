<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    /**
     * fillable
     * Les attributs de Sondage renseignables
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * questions
     * Récupère les les questions liées à un sondage
     * @return HasMany
     */
    public function questions(): HasMany {
        return $this->hasMany(Question::class);
    }
}
