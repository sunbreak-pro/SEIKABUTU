<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full">
                    <h1 class="content">編集画面</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full ">
                    <form action="/lists/{{$list->id}}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col items-center">
                            <p>元の達成期限：{{ $list->expired_at ? $list->expired_at->format('Y-m-d H:i') : '未設定' }}</p><br>
                            <label for="expired_at">新しい達成期限（任意）:</label>
                            <input type="datetime-local" id="time" name="list[expired_at]" class="form-control" value="{{ old('expired_at') }}" />
                            <br>
                            <input type='text' name='list[text]' value="{{ $list->text }}">
                            <br>
                            <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>
                            <img src="{{ $list->image_url }}" alt="画像が読み込めません。"><br>

                            <div class="image">
                                <input type="file" class="file-select" name="image">
                            </div>
                        </div>

                        <div id="click">
                            <input class="w-30 bg-blue-600 hover:bg-blue-500 text-white rounded px-10 py-2" type="submit" value="変更内容を保存する">
                            <button class="w-30 bg-red-600 hover:bg-red-500 text-white rounded px-10 py-2"><a href='/lists/show'>やっぱりやめる</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>