<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, TodoList $list){
        $comments = new Comment();
        
        $comments->user_id = Auth::id(); // 現在のユーザーのIDを設定
        $comments->todo_list_id = $list->id; // 関連するTodoListのIDを設定
        $comments->text = $request['text']; // コメントテキストを設定
        // コメントを保存
        $comments->save();
        return redirect('/');
        
        }
}