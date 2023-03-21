<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libelle', 'est_correcte','question_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
