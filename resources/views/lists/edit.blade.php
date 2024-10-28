<!DOCTYPE html>
<html lang="ja">
    <head>
        <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo_Edit</title>
    </head>
    <h1 class="content">編集画面</h1>
        <div class='content_edit'>
        
            <form action="/lists/{{$list->id}}/update" method ="POST">
                @csrf
                @method('PUT')
                <input type='text' name='list[text]' value="{{ $list->text }}">
                <p class="text_error" style="color:red">{{ $errors->first('list.text') }}</p>
                <input type="submit" value="更新">
            </form>
        </div>
        <div class='footer'>
            <button><a href='/lists/show'>[戻る]</a></button>
        </div>
    </body>
</html>