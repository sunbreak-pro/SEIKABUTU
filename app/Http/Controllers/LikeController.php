<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Like;

use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function likeList(Request $request)
    {
        $user_id = \Auth::id();
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $list_id = $request->list_id;
        //自身がいいね済みなのか判定します
        $alreadyLiked = Like::where('user_id', $user_id)->where('todo_list_id', $list_id)->first();

        
        if (!$alreadyLiked) {
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $like = new Like();
            $like->todo_list_id = $list_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            Like::where('todo_list_id', $list_id)->where('user_id', $user_id)->delete();
        }
        
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $list = TodoList::where('id', $list_id)->first();
        $likesCount = $list->likes->count();

        $param = [
            'likesCount' =>  $likesCount,
        ];
        
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);
    }
}
