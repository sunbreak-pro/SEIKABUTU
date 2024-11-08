<?php

namespace App\Http\Controllers;


use App\Models\TodoList;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $listId){
        $request->validate(['commet.text' => 'required|string']);

        Comment::create([
            'user_id' => auth()->id(),
            'todo_list_id' => $listId,
            'text' => $request->text,
        ]);

        return redirect('/')->with('message', 'コメントが追加されました！');
        }
        
        public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return redirect('/');
    }
}