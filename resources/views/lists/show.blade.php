
<x-app-layout>

        <h1>Todoリスト一覧</h1><br>
            <div class='todo_lists'>
            @foreach($lists as $list)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="p-6 text-gray-900 py-1">
                            <div class="text">
                                <p name ="{{ $list->id}}">Todo名：{{ $list->text }}</p>
                                <p>作成日：{{ $list->updated_at }}</p>
                                <img src="{{ $list->image_url }}" alt="画像が読み込めません。">

                                <style>
                                    p
                                    {
                                    text-align: left;
                                    }

                                    .click{
                                        text-align: right;
                                        position: relative; 
                                        right:10px;
                                        bottom:30px;
                                        font-size:20px;
                                    }
                                </style>

                                <div class="edit">
                                    <button><a href="/lists/{{ $list->id }}/edit">[編集]</a></buttoon>
                                </div>

                                <div class="click">

                                <form action="/lists/{{ $list->id }}/delete" id="formDelete_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteList({{ $list->id }})">削除する！</button>
                                </form>

                                <form action="{{ $list->id }}/archievement" id="formAchievement_{{ $list->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    
                                    <button type="button" onclick="postList({{ $list->id }})" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-lg px-30 py-3 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">達成する！</button>
                                
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