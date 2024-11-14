<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1>Todo作成</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full ">

                    <div class="flex flex-col items-center">
                        <form action="/lists/store" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class='header'>
                                <p>作成日：<time id="modified_date"></time></p>
                            </div>
                            <div class="expired">
                                <label for="expired_at">達成期限（任意）:</label>
                                <input type="datetime-local" id="time" name="list[expired_at]" class="form-control" value="{{ old('expired_at') }}" />
                            </div><br>

                            <div class='todo_content'>
                                <h5>Todo内容:</h5>
                                <textarea type='text' id='text' name='list[text]' value="{{ old('list.text') }}" placeholder='例）三分間だけ、掃除する' class="color: black"></textarea>
                                <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>

                                <div class="image">
                                    <label>任意の画像（任意）:</label>
                                    <input type="file" class="file-select" name="image">
                                </div>
                            </div>

                            <div id="click">
                                <input type="submit" value="作成！" id="click" class="w-20 bg-blue-600 hover:bg-blue-500 text-white rounded px-3 py-2" />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>