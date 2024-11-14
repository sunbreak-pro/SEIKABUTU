<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Comment;
use App\Http\Requests\TodoListRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class TodoListController extends Controller
{
    public function index(TodoList $list, Post $post, Comment $comment)
    {

        return view('posts.index')->with(['lists' => $list])->with(['post' => $post])->with(['comments' => $comment]);
    }

    public function create(TodoList $list)
    {
        return view('lists.create')->with(['lists' => $list]);
    }

    public function delete(TodoList $list)
    {
        $list->delete();
        return redirect('/lists/show');
    }


    public function edit(TodoList $list)
    {
        return view('lists.edit')->with(['list' => $list]);
    }

    public function post(TodoList $list)
    {
        return view('lists.post')->with(['lists' => $list]);
    }

    public function show(TodoList $list)
    {
        $query = TodoList::query();
        $id = Auth::id();
        $query->where('archievement', '=', 0)->where('user_id', '=', $id);
        $list = $query->get();
        return view('/lists.show', compact('list'))->with(['lists' => $list]);
    }

    public function back(TodoList $list)
    {
        $list['archievement'] = 0;
        $list->save();
        $query = TodoList::query();
        return redirect('lists/show')->with(['lists' => $list]);
    }

    public function store(TodoListRequest $request)
    {

        $input = $request['list'];
        $user_id = Auth::id();
        $input['user_id'] = $user_id;
        if ($request->file('image')) { //画像ファイルが送られた時だけ処理が実行される
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
        }

        $input['post'] = 0;
        $input['archievement'] = 0;

        if ($request->has('expired_at')) { // もし存在する場合のみ処理

            $input_time['expired_at'] = $request->input('expired_at');
        } else {
            $input_time['expired_at'] = null;
        }

        $todoList = new TodoList();
        $todoList->fill($input);  // fillableに`expired_at`が含まれていることを確認
        $todoList->save();
        return redirect('/lists/show');
    }

    public function update(TodoList $list, TodoListRequest $request)
    {
        $input_list = $request['list'];
        $user_id = Auth::id();
        $input_list['user_id'] = $user_id;

        $input_image = $request['list'];
        $id = Auth::id();
        if ($request->file('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_image += ['image_url' => $image_url];
        }
        TodoList::find($id)->update(['image_url' => $image_url]);

        $input_list['archievement'] = 0;
        $list->fill($input_list)->save();
        $list->fill($input_image)->save();
        return redirect('/lists/show');
    }

    public function archievement(TodoList $list, Post $post)
    {
        $list['archievement'] = 1;
        $list->save();
        $query = TodoList::query();
        $query->where('archievement', '=', 1);
        $list = $query->get();
        return redirect('/lists/archievement')->with(['lists' => $list])->with(['post' => $post]);
    }

    public function archievement_list(TodoList $list, Post $post)
    {
        $query = TodoList::query();
        $id = Auth::id();
        $query->where('archievement', '=', 1)->where('user_id', '=', $id);
        $list = $query->get();
        $query->where('post', '=', 0);
        $list = $query->get();
        return view('lists.archievement')->with(['lists' => $list])->with(['post' => $post]);
    }
}
