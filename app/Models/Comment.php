<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;


class Comment extends Model
{
    use HasFactory;

    public function todo_list()   
    {
        return $this->belongsTo(TodoList::class);
    }

    public function user()   
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'comments';
    
    protected $fillable = [
        'user_id',
        'todo_list_id',
        'text',
    ];
}
