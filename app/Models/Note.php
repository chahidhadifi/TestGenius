<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'note', 'etudiant_id', 'examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

}
