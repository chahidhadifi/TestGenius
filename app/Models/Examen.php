<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
     protected $fillable = ['nom', 'date', 'duree', 'professeur_id', 'matiere_id'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class)->withPivot('valeur')->withTimestamps();
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
