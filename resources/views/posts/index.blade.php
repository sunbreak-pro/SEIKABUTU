<x-app-layout>
    <style>
        /* いいね押下時の星の色 */
        .liked{
            color:orangered;
            transition:.2s;
        }
        .flexbox{
            align-items: center;
            display: flex;
        }
        .count-num{
            font-size: 20px;
            margin-left: 10px;
        }
        .fa-star{
            font-size: 30px;
        }

    </style>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>掲示板</h1>
                </div>
            </div>
        </div>
    </div>

    <div class='posted'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <p>ユーザー名：{{$list->user->name}}</p>
                        <p name="{{ $list->text }}">達成したTodo：{{ $list->text }}</p>
                        <img src="{{ $list->image_url }}" alt="画像が読み込めません。">
                        
                        <div class="comments-section">
                            <h4>コメント一覧</h4>

                            <form action="/lists/{{ $list->id }}/comments" method="POST">
                                @csrf
                                <textarea name="text" rows="3" placeholder="コメントを入力"></textarea>
                                <button type="submit">コメントを投稿</button>
                            </form>

                            <div class="comments-list">
                            @if ($list->comments->count() > 0)
                                @foreach ($list->comments as $comment)
                                    
                                    <div class="comment">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small>{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                    
                                @endforeach
                                @else
                                        <p>コメントはまだありません。</p>
                                @endif
                            </div>
                        </div><br>
                        
                        <div class="likes">
                            @auth
                                @if($list->isLikedByAuthUser())

                                    <div class="flexbox">
                                    <p>いいね！</p>
                                        <i class="fa-solid fa-star like-btn liked" id={{$list->id}}></i>
                                        <p class="count-num">{{$list->likes->count()}}</p>
                                    </div>
                                @else
                                    <div class="flexbox">
                                    <p>いいね！</p>
                                        <i class="fa-solid fa-star like-btn" id={{$list->id}}></i>
                                        
                                        <p class="count-num">{{$list->likes->count()}}</p>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                            // ドキュメント全体に1度だけイベントリスナーを追加
                            if (!document.likeButtonListenerAdded) {  // フラグを使って重複を防ぐ
                                document.addEventListener('click', async (e) => {
                                    // .like-btnクラスを持つ要素がクリックされた場合
                                    if (e.target.classList.contains('like-btn')) {
                                        console.log('ボタンがクリックされました'); // デバッグ用ログ
                                        const clickedEl = e.target;
                                        clickedEl.classList.toggle('liked');
                                        const listId = clickedEl.id;
                                        try {
                                            const response = await fetch('/lists/like', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                },
                                                body: JSON.stringify({ list_id: listId })
                                            });
                                            const data = await response.json();
                                            clickedEl.nextElementSibling.innerHTML = data.likesCount;
                                        } catch (error) {
                                            alert("処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。");
                                        }
                                    }
                                });
                                // フラグを設定して二重登録を防止
                                document.likeButtonListenerAdded = true;
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>