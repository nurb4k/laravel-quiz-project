<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['text_answer','question_id','isTrue','link_picture'];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
