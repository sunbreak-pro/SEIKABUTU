<x-app-layout>
    <style>
        /* いいね押下時の星の色 */
        .liked {
            color: orangered;
            transition: .2s;
        }

        .flexbox {
            align-items: center;
            display: flex;
        }

        .count-num {
            font-size: 20px;
            margin-left: 10px;
        }

        .fa-star {
            font-size: 30px;
        }

        /* コメントの枠の調整 */
        .comments-container {
            max-width: 600px;
            /* 必要に応じて変更 */
            width: 100%;
        }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white text-center">
                    <h1>掲示板</h1>
                </div>
            </div>
        </div>
    </div>

    <div class='posted max-w-3xl mx-auto'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="w-full mx-auto ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-center items-center py-10">
                    <div class="text-gray-900 w-full flex flex-col items-center">
                        <div class="userIcon">
                            <img
                                id="preview"
                                src="{{ isset(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/20220325_object.png') }}"
                                alt=""
                                class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                            <p>{{$list->user->name}}</p>
                        </div>
                        <p name="{{ $list->text }}">達成したTodo：{{ $list->text }}</p>
                        <p>達成期限：{{ $list->expired_at ? $list->expired_at->format('Y-m-d H:i') : '未設定' }}</p>
                        <img src="{{ $list->image_url }}" alt="画像が読み込めません。">

                        <div class="likes">
                            @auth
                            @if($list->isLikedByAuthUser())
                            <div class="flexbox">
                                <p>いいね！</p>
                                <i class="fa-solid fa-star like-btn liked" id="{{$list->id}}"></i>
                                <p class="count-num">{{$list->likes->count()}}</p>
                            </div>
                            @else
                            <div class="flexbox">
                                <p>いいね！</p>
                                <i class="fa-solid fa-star like-btn" id="{{$list->id}}"></i>
                                <p class="count-num">{{$list->likes->count()}}</p>
                            </div>
                            @endif
                            @endauth
                        </div>

                        <div class="mt-5 w-full">
                            <form action="/lists/{{ $list->id }}/comments" method="POST" class=" mx-72 ">
                                @csrf
                                <textarea name="text" rows="3" placeholder="コメントを入力" class="w-full border rounded-md p-2"></textarea>
                                <button type="submit" class="mt-2 bg-blue-500 text-white py-1 px-3 rounded">コメントを投稿</button>
                            </form>
                            <div class="comments-list mt-4 comments-container mx-auto">
                                @if ($list->comments->count() > 0)
                                <details>
                                    <summary class="cursor-pointer">コメント一覧</summary>
                                    <div class="border-4 border-black rounded-lg p-4">
                                        @foreach ($list->comments as $comment)
                                        <div class="comment border-b-2 pb-2 mb-2">
                                            <strong>{{ $comment->user->name }}</strong>
                                            <small class="block text-gray-500">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                                            <p class="mt-1">{{ $comment->text }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </details>
                                @else
                                <p class="text-gray-500 mt-4">コメントはまだありません。</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>