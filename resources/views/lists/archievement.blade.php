<x-app-layout>
    <h1>達成済みリスト</h1><br>

    <div class='todo_lists'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text">
                        <p>{{ $list->created_at }}</p>
                        <p name ="{{ $list->id}}">{{ $list->text }}</p>
                        <img src="{{ $list->image_url }}" alt="画像が読み込めません。">

                        <form action="/lists/{{ $list->id }}/back" id="formback_{{ $list->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="button" onclick="backList({{ $list->id }})">未達成にする</button>
                        </form>

                        </div>
                        <form name="post" action="lists/{{ $list->id }}/post" id="form_{{ $list->id }}" method="post">
                                @csrf
                                @method('PUT')
                            <button type="button" onclick="upPost({{ $list->id }})" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-1 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">投稿する！</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        
        function backList(id) {
            'use strict'

            if (confirm('達成したTodoリストを投稿しますか？\n')) {
                document.getElementById(`formback_${id}`).submit();
                
            }
        }

        
        function upPost(id) {
            'use strict'

            if (confirm('達成したTodoリストを投稿しますか？\n')) {
                document.getElementById(`form_${id}`).submit();
                
            }
        }
    </script>
</x-app-layout>