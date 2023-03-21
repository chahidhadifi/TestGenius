<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'professeur_id'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }
}
