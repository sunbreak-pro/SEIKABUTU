<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
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
                    <div class="p-6 text-gray-900 w-full ">

                        <div class="flex flex-col items-center">
                            <p name="{{ $list->id}}">Todo名：{{ $list->text }}</p>
                            <p>作成日：{{ $list->created_at }}</p>
                            <p>達成期限：{{ $list->expired_at ? $list->expired_at->format('Y-m-d H:i') : '未設定' }}</p>
                            <img src="{{ $list->image_url }}" alt="画像が読み込めません。">
                        </div>

                        <div id="click">
                            <form action="/lists/{{ $list->id }}/back" id="formback_{{ $list->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-30 bg-red-600 hover:bg-red-500 text-white rounded px-10 py-2" onclick="backList({{ $list->id }})">未達成にする</button>
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
        @endforeach
    </div>

    <script>
        function upPost(id) {
            'use strict'

            if (confirm('達成したTodoリストを投稿しますか？\n')) {
                document.getElementById(`form_${id}`).submit();

            }
        }
    </script>
</x-app-layout>