// モーダル コンテンツを表示
$(function () {
  $('.modalopen').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn("slow");
      return false;
    });
  });
});

// モーダル 背景を表示
$(".modalopen").click(function () {
  //append･･･引数をHTMLの最後に挿入
  //[$modal-overlay]をフェードインさせる
  $("#modal-overlay").fadeIn("slow");
});

// モーダル フェードアウト
$("#modal-overlay").click(function () {
  //#modal-overlayをフェードアウトする
  $("#modal-overlay").fadeOut();
  $(".modal_inner").fadeOut();
  //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
  $("#modal-overlay").remove("slow");
  $(".modal_inner").remove("slow");
});


//Enter送信抑止
document.onkeypress = function () {
  if (event.keyCode === 13) {
    return false;
  }
}

//ドロップダウン
$(function () {
  $('.flex').click(function () { //メニューボタンタップ後の処理
    $('.menu-trigger').toggleClass('active'); //クリックした要素に「.active」要素を付与
    if ($('.menu-trigger').hasClass('active')) { //もしクリックした要素に「.active」要素があれば
      $('.gnavi').css('display', 'block');//「.gnavi」要素を表示する
    } else {                            //「.active」要素が無ければ
      $('.gnavi').css('display', 'none');//「.gnavi」要素を非表示する
    }
  });
});
