<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\TodoList;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post, TodoList $list){
        $query=TodoList::query();
        $query->where('post', '=', 1);
        $list =$query->get();
        return view('posts.index')->with(['lists'=> $list])->with(['post' => $post]);
    }

    public function post(TodoList $list){
        $list['post'] = 1;
        $list->save();
        return redirect('/');
    }

    public function store(Post $post, TodoList $list){
        $input = $request['list'];
        $todo_list_id = Auth::id();
        $input['todo_list_id'] = $user_id;
        return redirect('/');
    }

    public function update(PostRequest $request, Post $post){
        $input_list = $request['list'];
        $list->fill($input_list)->save();
        
        return redirect('/lists/show' . $list->id);
    }
};

