import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//いいね機能
document.addEventListener('DOMContentLoaded', () => {
    // ドキュメント全体に1度だけイベントリスナーを追加
    if (!document.likeButtonListenerAdded) {  // フラグを使って重複を防ぐ
        document.addEventListener('click', async (e) => {
            // .like-btnクラスを持つ要素がクリックされた場合
            if (e.target.classList.contains('like-btn')) {
                console.log('ボタンがクリックされました'); // デバッグ用ログ
                const clickedEl = e.target;
                clickedEl.classList.toggle('liked');
                const listId = clickedEl.id;
                try {
                    const response = await fetch('/lists/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ list_id: listId })
                    });
                    const data = await response.json();
                    clickedEl.nextElementSibling.innerHTML = data.likesCount;
                } catch (error) {
                    alert("処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。");
                }
            }
        });
        // フラグを設定して二重登録を防止
        document.likeButtonListenerAdded = true;
        }
    });

//現在日を取得
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
                            

//topにいく

