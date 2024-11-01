<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Http\Requests\TodoListRequest;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class TodoListController extends Controller
{
    public function index(TodoList $list, Post $post){
        return view('posts.index')->with(['lists' => $list])->with(['post' => $post]);  
    }

    public function create(TodoList $list){
        return view('lists.create')->with(['lists' => $list]);
    }

    public function delete(TodoList $list){
        $list->delete();
        return redirect('/lists/show');
    }


    public function edit(TodoList $list){
        return view('lists.edit')->with(['list' => $list]);
    }

    public function post(TodoList $list){
        return view('lists.post')->with(['lists' => $list]);
    }

    public function show(TodoList $list){
        $query=TodoList::query();
        $query->where('archievement', '=', 0);
        $list =$query->get();
        return view('/lists/show')->with(['lists' => $list]);
    }

    public function back(TodoList $list){
        $list['archievement'] = 0;
        $list->save();
        $query=TodoList::query();
        return redirect('lists/show')->with(['lists' => $list]);
    }

    public function store(TodoList $list, TodoListRequest $request) 
    {
        $input = $request['list'];
        $user_id = Auth::id();
        $input['user_id'] = $user_id;
        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実行される
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
        }
        $input['post'] = 0;
        $input['archievement'] = 0;
        $list->fill($input)->save();
    return redirect('/lists/show');
    }

    public function update(TodoList $list, TodoListRequest $request){
        $input_list = $request['list'];
        $user_id = Auth::id();
        $input_list['user_id'] = $user_id;
        $input_list['archievement'] = 0;
        $list->fill($input_list)->save();
    return redirect('/lists/show');
    }

    public function archievement(TodoList $list, Post $post){
        $list['archievement'] = 1;
        $list->save();
        $query=TodoList::query();
        $query->where('archievement', '=', 1);
        $list =$query->get();
        return redirect('/lists/archievement')->with(['lists' => $list])->with(['post' => $post]);
    }

    public function archievement_list(TodoList $list, Post $post){
        $query=TodoList::query();
        $query->where('archievement', '=', 1);
        $list=$query->get();
        $query->where('post', '=', 0);
        $list =$query->get();
        return view('lists.archievement')->with(['lists' => $list])->with(['post' => $post]);
    }

    
}
