<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'img',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quizzies()
    {
        return $this->hasMany(Quiz::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function competitedQuizzies()
    {
        return $this->belongsToMany(Quiz::class,'competition')
            ->withPivot('point','user_name')
            ->withTimestamps();
    }

}
