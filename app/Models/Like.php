<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TodoList;
use App\Models\User;

class Like extends Model
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
    
}
