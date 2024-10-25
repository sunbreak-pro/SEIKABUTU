<x-app-layout>
    <div class='todo_lists'>
        @foreach($lists as $list)
            <div class="text">
                <p name ="{{ $list->id }}">{{ $list->text }}</p>

                <form action="/lists/{{ $list->id }}/delete" id="form_{{ $list->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteList({{ $list->id }})">達成済みを取消にする</button>
                </form>
                
                <form action="lists/{{ $list->id }}/post" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" onclick="upPost({{ $list->id }})">投稿する！</button>
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