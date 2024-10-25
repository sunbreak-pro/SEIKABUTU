<x-app-layout>
    @push('scripts')
    <script src="{{ asset('js/like.js') }}"></script>
    @endpush
    <h1>掲示板</h1>

    <div class='posted'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>ユーザー名：{{$list->user->name}}</p>
                        <p name="{{ $list->text }}">達成したTodo：{{ $list->text }}</p>
                        
                        
                        <div class="like">
                            @auth
                                @if($post->isLikedByAuthUser())

                                    <div class="flexbox">
                                        <i class="fa-solid fa-star like-btn liked" id={{$post->id}}></i><p>いいね！</p>
                                        <p class="count-num">{{$post->likes->count()}}</p>
                                    </div>
                                @else
                                    <div class="flexbox">
                                        <i class="fa-solid fa-star like-btn" id={{$post->id }}></i><p>いいね！</p>
                                        <p class="count-num">{{$post->likes->count()}}</p>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        @guest
                            <p>loginしていません</p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>