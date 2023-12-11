<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * participants
     * récupère les particiapnts de ce sondage
     * @return HasMany
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Retourne le sondage par rapport à son titre
     *
     */
    public function findByTitle(string $title)
    {
        $results = DB::table("surveys")
        ->selectRaw("*")
        ->whereRaw('title = ?', $title)
        ->first();

        return  $results;

    }
}
