
<x-app-layout>
    <style>
        h1{
            font-size:30px;
            background:;
        }
    </style>
    <h1 class="content">編集画面</h1>
        <div class='content_edit'>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <form action="/lists/{{$list->id}}/update" method ="POST">
                                @csrf
                                @method('PUT')
                                <input type='text' name='list[text]' value="{{ $list->text }}">
                                <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>
                                <img src="{{ $list->image_url }}" alt="画像が読み込めません。">

                                <div class="image">
                                    
                                        <input type="file" name="image">
                                </div>
                                <input type="submit" value="更新">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='footer'>
            <button><a href='/lists/show'>[戻る]</a></button>
        </div>
</x-app-layout>