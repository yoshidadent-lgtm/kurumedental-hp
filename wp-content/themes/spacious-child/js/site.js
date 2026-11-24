/* 全ページ共通の、小さなスクリプト（jQueryなし）。
   「地域の歯医者さん」の地域ページ：ボタンに、マウスを載せる（またはキーボードで移動する）と、対応する地図の絵に切り替える。 */
(function () {
  'use strict';
  var nav = document.getElementById('map_navigation');
  if (!nav) return;
  var imgs = nav.querySelectorAll('#map_image img');
  var items = nav.querySelectorAll('#area_btn_list li');
  if (!imgs.length || !items.length) return;
  function show(i) {
    for (var k = 0; k < imgs.length; k++) {
      var on = (k === i);
      imgs[k].style.display = on ? 'block' : 'none';
      imgs[k].style.opacity = '1';
      if (on) { imgs[k].classList.remove('map-fade'); void imgs[k].offsetWidth; imgs[k].classList.add('map-fade'); }
    }
    for (var j = 0; j < items.length; j++) items[j].classList.toggle('is-active', j === i);
  }
  Array.prototype.forEach.call(items, function (li, i) {
    li.addEventListener('mouseenter', function () { show(i); });
    li.addEventListener('focusin', function () { show(i); });
    li.addEventListener('touchstart', function () { show(i); }, { passive: true });
  });
  show(0);
})();
