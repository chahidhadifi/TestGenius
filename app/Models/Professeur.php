<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom'];

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }
}