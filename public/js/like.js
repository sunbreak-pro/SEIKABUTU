const likeBtn = document.querySelector(".like-btn");
likeBtn.addEventListener("click", async (e) => {

    const clickedEl = e.target;
    clickedEl.classList.toggle("liked");

    const listId = e.target.id;

    const res = await fetch("/list/like", {
        //リクエストメソッドはPOST
        method: "POST",
        headers: {
            //Content-Typeでサーバーに送るデータの種類を伝える。今回はapplication/json
            "Content-Type": "application/json",
            //csrfトークンを付与
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ todo_list_id: listId }),
    })
        .then((res) => res.json())
        .then((data) => {
            clickedEl.nextElementSibling.innerHTML = data.likesCount;
        })
        .catch(() =>
            alert(
                "処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。"
            )
        );
});
