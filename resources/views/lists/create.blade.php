<x-app-layout>
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

                <style>
                
                {
                text-align: center;
                
                }
                </style>
            </div>
            

            <div class='create'>
                <div class ='todo_content'>
                    <input type='text' id='text' name='list[text]' placeholder='3分' value="{{ old('list.text') }}" class="color: black"/>
                    <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>

                    <div class="image">
                        <input type="file" name="image">
                    </div>
                </div>
            <input type="submit" value="作成！" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-1 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"/>
        </form>
        
    </div>
</x-app-layout>