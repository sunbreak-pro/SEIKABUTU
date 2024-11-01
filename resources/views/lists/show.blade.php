<x-app-layout>
        <h1>Todoリスト一覧</h1><br>

            <div class='todo_lists'>
            @foreach($lists as $list)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="text">
                                <p name ="{{ $list->id}}">{{ $list->text }}</p>
                                <p>{{ $list->created_at }}</p>
                                <img src="{{ $list->image_url }}" alt="画像が読み込めません。">

                                <div class="edit">
                                    <a href="/lists/{{ $list->id }}/edit">[編集]</a>
                                </div>

                                <form action="/lists/{{ $list->id }}/delete" id="formDelete_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteList({{ $list->id }})">削除する！</button>
                                </form>

                                <form action="{{ $list->id }}/archievement" id="formAchievement_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" onclick="postList({{ $list->id }})" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-1 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">達成！</button>
                                </form>
                                <br>
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

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`formAchievement_${id}`).submit();
                }
            }
        </script>
</x-app-layout>