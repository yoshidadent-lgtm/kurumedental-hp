$(document).ready(function(){
  $('.bxslider').bxSlider({
    mode: 'fade',
	auto: 'true',
	pager: 'false',
	infiniteLoop: 'false',
	speed: 2000,
  });
});

$(function(){
   $('#menu img').each(function(){

      // リンク先のURLを取得
      var url = $(this).parent('a').attr('href');
      // 現在表示されているページのURLを取得し、リンク先のURLと照合
      if(location.href.match(url)) {
         // マッチすれば、「class="current"」を付加
         $(this).addClass('current');
         // マッチしなければ、「class="current"」を削除
      } else {
         $(this).removeClass('current');
      }

      // 画像名を取得
      var src = $(this).attr('src');
      // すでに画像名に「_on.」が付いていた場合、ロールオーバー処理をしない
      if (src.match('_on.')) return;

      // ロールオーバー用の画像名を取得（_onを付加）
      var src_on = src.replace(/^(.+)(\.[a-z]+)$/, '$1_on$2');
      // 画像のプリロード（先読み込み）
      $('').attr('src', src_on);

      // ハイライト用の画像名を取得（_currentを付加）
      var src_current = src.replace(/^(.+)(\.[a-z]+)$/, '$1_current$2');
      // 画像のプリロード（先読み込み）
      $('').attr('src', src_current);

      // クラス名「current」が付く場合、
      if ($(this).hasClass('current')) {
         // ハイライト処理
         $(this).attr('src', src_current);
      // クラス名「current」が付かない場合、
      }else {
         // ロールオーバー処理
         $(this).hover(
            function() { $(this).attr('src', src_on); },
            function() { $(this).attr('src', src); }
         );
      }
   });
});

		$(function(){
		    $("ul.menu li").hover(function(){
		        $(">ul:not(:animated)",this).slideDown("fast")
		    },
		    function(){
		        $(">ul",this).slideUp("fast");
		    })
		})
