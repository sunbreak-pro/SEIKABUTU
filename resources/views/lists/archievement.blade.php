<x-app-layout>
    <div class='todo_lists'>
        @foreach($lists as $list)
            <div class="text">
                <p name ="{{ $list->id }}">{{ $list->text }}</p>

                <form action="/lists/{{ $list->id }}/delete" id="form_{{ $list->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteList({{ $list->id }})">未達成にする</button>
                </form>


                <form action="lists/{{ $list->id }}/post" method="post">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="投稿する！" onclick="upPost({{ $list->id }})" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-1 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"/>
                </form>
            </div><br>
        @endforeach
        </div>
    <script>
        function deleteList(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
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