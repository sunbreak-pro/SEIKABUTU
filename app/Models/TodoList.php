<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\post;
use App\Models\User;

class TodoList extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $fillable = [
        'text',
        'user_id',
        'post',
        'archievement',
        'image',
    ];
}


