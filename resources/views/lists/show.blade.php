<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <h1><a name="title">あなただけのTodoリスト！</a></h1>
                </div>
            </div>
        </div>
    </div>

    <div class='posted max-w-3xl mx-auto'>
        @foreach($lists as $list)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 w-full ">

                        <div class="px-20">
                            <p name="{{ $list->id}}">Todo名：{{ $list->text }}</p>
                            <p>作成日：{{ $list->updated_at }}</p>
                            <p>達成期限：{{ $list->expired_at ? $list->expired_at->format('Y-m-d H:i') : '未設定' }}</p>
                            @if($list->image_url != null)
                            <img src="{{ $list->image_url }}" alt="画像がないよ！">
                            @endif
                        </div>

                        <form class="delete-position" action="/lists/{{ $list->id }}/delete" id="formDelete_{{ $list->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="w-30 bg-red-600 hover:bg-red-500 text-white rounded px-10 py-2" onclick="deleteList({{ $list -> id }})">削除はここです</button>
                        </form>

                        <div id="click">
                            <button class="w-30 bg-green-600 hover:bg-green-500 text-white rounded px-10 py-2">
                                <a href="/lists/{{ $list->id }}/edit">内容変える？</a>
                            </button>

                            <form action="/lists/{{ $list->id }}/achievement" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-30 bg-blue-600 hover:bg-blue-500 text-white rounded px-10 py-2">達成！お見事！</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button type="button" id="btn" class="mt-2 bg-white bg-opacity-30 text-yellow-500 py-1 px-3 rounded">トップに行かない？</button>

    <script>
        function deleteList(id) {
            const form = document.getElementById(`formDelete_${id}`);
            if (form) {
                if (confirm('本当に削除しますか？')) { // 削除確認ダイアログ
                    form.submit(); // フォーム送信
                }
            } else {
                console.error(`Form with id formDelete_${id} not found.`);
            }
        }

        const btn = document.getElementById("btn");

        btn.addEventListener("click", () => {
            window.scroll({
                top: 0,
                behavior: "smooth",
            });
        });
    </script>
</x-app-layout>