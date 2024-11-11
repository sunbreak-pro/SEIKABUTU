<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="positioned">Todo作成</h1>

                    <form action="/lists/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class='header'>
                            <p>作成日：<time id="modified_date"></time></p>
                            
                            <script>
                                const last = new Date(document.lastModified);
                                const year = last.getFullYear();
                                const month = last.getMonth() + 1;
                                const date = last.getDate();
                                let fixedMonth = month;
                                let fixedDate = date;
                                if (month < 10) {
                                fixedMonth = "0" + month;
                                }
                                if (date < 10) {
                                fixedDate = "0" + date;
                                }
                                const viewDateText = year + "年" + month + "月" + date + "日";
                                const datetimeText = year + "-" + fixedMonth + "-" + fixedDate;
                                const target = document.getElementById('modified_date');
                                target.textContent = viewDateText;
                                target.setAttribute("datetime", datetimeText);
                            </script>
                        </div>
                        

                        <div class='create'>
                            <div class ='todo_content'>
                                <input type='text' id='text' name='list[text]' placeholder='3分' value="{{ old('list.text') }}" class="color: black"/>
                                <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>

                                <div class="image">
                                    <input type="file" name="image">
                                </div>
                            </div>
                        <input type="submit" value="作成！" id="click" class="w-20 bg-blue-600 hover:bg-blue-500 text-white rounded px-3 py-2"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>