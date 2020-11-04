// 削除処理
function deletePost(e) {
    'use strict';
    if (confirm('本当に削除しますか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}
