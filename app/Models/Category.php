<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code','name_kz','name_en'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

}
