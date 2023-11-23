<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
