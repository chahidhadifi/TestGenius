<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;
     protected $fillable = ['etudiant_id', 'question_id', 'proposition_id'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function proposition()
    {
        return $this->belongsTo(Proposition::class);
    }
}
