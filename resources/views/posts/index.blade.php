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
    <h1>掲示板</h1>
   

    <div class='posted'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>ユーザー名：{{$list->user->name}}</p>
                        <p name="{{ $list->text }}">達成したTodo：{{ $list->text }}</p>
                        <img src="{{ $list->image_url }}" alt="画像が読み込めません。">
                        
                        @auth
                            @if($list->isLikedByAuthUser())

                                <div class="flexbox">
                                    
                                    <i class="fa-solid fa-star like-btn liked" id={{$list->id}}></i>
                                    <p class="count-num">{{$list->likes->count()}}</p>
                                </div>
                            @else
                                <div class="flexbox">
                                
                                    <i class="fa-solid fa-star like-btn" id={{$list->id}}></i>
                                    <p class="count-num">{{$list->likes->count()}}</p>
                                </div>
                            @endif
                        @endauth

                        @guest
                            <p>loginしていません</p>
                        @endguest


                        <script>
                            function setLikeButtonListeners() {
                                const likeBtns = document.querySelectorAll('.like-btn');
                                likeBtns.forEach(likeBtn => {
                                    likeBtn.addEventListener('click', async (e) => {
                                        const clickedEl = e.target;
                                        clickedEl.classList.toggle('liked');
                                        const listId = e.target.id;
                                        const res = await fetch('/lists/like', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                            },
                                            body: JSON.stringify({ list_id: listId })
                                        })
                                        .then((res) => res.json())
                                        .then((data) => {
                                            clickedEl.nextElementSibling.innerHTML = data.likesCount;
                                        })
                                        
                                        
                                        .catch(() =>alert(
                                            "処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。"))
                                    });
                                });
                            }
                            setLikeButtonListeners();
                        
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>