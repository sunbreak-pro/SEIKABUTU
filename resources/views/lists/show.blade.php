<x-app-layout>
        <h1>Todoリスト一覧</h1><br>

            <div class='todo_lists'>
            @foreach($lists as $list)
                
                <div class="text">
                    <p name ="{{ $list->id}}">{{ $list->text }}</p>
                    <p>{{ $list->created_at }}</p>
                    <img src="{{ $list->image }}" alt="画像が読み込めません。">

                    <div class="edit">
                        <a href="/lists/{{ $list->id }}/edit">[編集]</a>
                    </div>

                    <form action="/lists/{{ $list->id }}/delete" id="form_{{ $list->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteList({{ $list->id }})">削除する！</button>
                    </form>

                    <form action="lists/{{$list->id}}/archievement" id="form_{{ $list->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="submit" value="達成" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-1 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"/>
                    </form>
                    <br>
                </div>
            @endforeach
            </div>

        <div class="footer">
            <br>
            <div class="back">
                <a href="/"><button>戻る</button></a>
            </div>
        </div>
        <script>
            function deleteList(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
</x-app-layout>