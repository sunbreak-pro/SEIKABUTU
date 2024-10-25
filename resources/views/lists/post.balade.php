<x-app-layout>
    
        <form action="/lists/post" method="POST">
            @csrf
            <div class='header'>
                <input type="image" id="image" src="" value="画像挿入"/>

                <button type="submit">投稿！</button>
                <button type="store">保留</button>

            </div>
            <div class='todo'>
                <input type="id"/>
            </div>
        </form>
</x-app-layout>