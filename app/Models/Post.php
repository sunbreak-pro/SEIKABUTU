<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class Post extends Model
{
    use HasFactory;

    public function todo_list()
    {
        return $this->belongsTo(TodoList::class);
    }

protected $fillable = [
    'text',
    'todo_list_id',
];
}

