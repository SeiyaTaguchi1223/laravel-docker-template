$(function() {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  //あらかじめHTML内にセットされているCSRFトークンを取得(base.blade.phpの6行目)

  $(".todo-status-button").change(function () {//todo-status-buttonというクラスが振られたタグに変更があった時に続く処理が実行(index.blade.phpの17行目)
    const content = $(this).val();
    //変更されたチェックボックスのタグのvalue属性の値を取得してcontentに代入し
    const url = $(this).parent(".todo-status-form").attr("action");//$(this)は変更されたチェックボックスのタグを表している
    /*変更されたチェックボックスのタグの親要素(index,blade.phpの16行目)にあたる「todo-status-form」というクラスが付けられた要素を取得し、
    そのaction属性の値を取得してurlに代入*/

    $.ajax(//非同期通信をするための記述
      url,
      {
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken }
      }
      /*$ajax()という非同期通信をするための関数を使って、
      先ほど取得したurl(8行目)にCSRFトークンをリクエストヘッダ（headers）に持たせてPOST通信をする
      これがweb.phpの21行目ルートに送られる*/
    )
    .done(function(data) {
      console.log(data);
      if (data.is_completed) {//TodoController@completeメソッドの返り値がtrueかfalseのどちらかの条件分岐を行う
        window.alert('「' + content + '」のToDoを完了にしました。');
      } else {
        window.alert('「' + content + '」のToDoの完了を取り消しました。');
      }
    })
    .fail(function() {
      window.alert('通信に失敗しました。');
    });
  });
});