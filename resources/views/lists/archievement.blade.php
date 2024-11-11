<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1>達成済みリスト</h1>
                </div>
            </div>
        </div>
    </div>
    <div class='todo_lists'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text">
                            <p name ="{{ $list->id}}">Todo名：{{ $list->text }}</p>
                            <p>作成日：{{ $list->created_at }}</p>
                            <img src="{{ $list->image_url }}" alt="画像が読み込めません。">
                                <div id="click">

                                <form action="/lists/{{ $list->id }}/back" id="formback_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="w-30 bg-red-600 hover:bg-red-500 text-white rounded px-10 py-2" onclick="backList({{ $list->id }})">未達成にする</button>
                                </form>
                                <form name="post" action="lists/{{ $list->id }}/post" id="form_{{ $list->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                    <button type="button" text-align="right" onclick="upPost({{ $list->id }})" class="w-30 bg-blue-600 hover:bg-blue-500 text-white rounded px-10 py-2">投稿する！</button>
                                </form>
                            </div>
                        </div>
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