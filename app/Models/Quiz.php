<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'category_id','quiz','img','deadline'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function competitedUsers()
    {
        return $this->belongsToMany(User::class,'competition')
            ->withPivot('point','user_name')
            ->withTimestamps();
    }

}
