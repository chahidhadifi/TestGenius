<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    
   protected $fillable = ['nom', 'prenom', 'email', 'password', 'filiere_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function examens()
    {
        return $this->belongsToMany(Examen::class)->withPivot('valeur');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
