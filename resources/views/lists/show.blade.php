
<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Todoリスト一覧</h1>
                </div>
            </div>
        </div>
    </div>

    <div class='todo_lists'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 text-gray-900 py-5">
                        <div class="text">
                            
                            <p name ="{{ $list->id}}">Todo名：{{ $list->text }}</p>
                            <p>作成日：{{ $list->updated_at }}</p>
                            <img style="left:100px" src="{{ $list->image_url }}" alt="画像が読み込めません。">

                            <div id="click">
                                <button class="w-20 bg-green-600 hover:bg-green-500 text-white rounded px-3 py-2">
                                    <a href="/lists/{{ $list->id }}/edit">編集!</a>
                                </button>
                                
                                <form action="/lists/{{ $list->id }}/delete" id="formDelete_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="w-30 bg-red-600 hover:bg-red-500 text-white rounded px-10 py-2" onclick="deleteList({{ $list->id }})">削除する！</button>
                                </form>

                                <form action="{{ $list->id }}/archievement" id="formAchievement_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" onclick="postList({{ $list->id }})" class="w-30 bg-blue-600 hover:bg-blue-500 text-white rounded px-10 py-2">達成する！</button>
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
        function deleteList(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`formDelete_${id}`).submit();
            }
        }

        function postList(id) {
            'use strict'

            if (confirm('達成します、よろしいですか？')) {
                document.getElementById(`formAchievement_${id}`).submit();
            }
        }
    </script>
</x-app-layout>