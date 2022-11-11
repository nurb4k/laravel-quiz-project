<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['text_question','quiz_id'];

    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
