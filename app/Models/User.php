<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Comment;
use App\Models\TodoList;
use App\Models\Like;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function todo_lists()
    {
        return $this->hasMany(TodoList::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //フォローしているユーザー
    public function followee_id()
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id');
    }

    //フォローされているユーザー
    public function follower_id()
    {

        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
