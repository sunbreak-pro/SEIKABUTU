<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\TodoList;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function todo_list()
    {
        return $this->belongsTo(TodoList::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
