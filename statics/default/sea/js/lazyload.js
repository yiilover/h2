define(function(require, exports, module) {
	var $ = require('jquery');
	$(function() {
		var $list = $('img[data-src]');
		if($list.length > 0) {
			$list.attr('src', 'http://www.house5.cn/statics/default/img/lazy.gif').css('background', 'url(http://www.house5.cn/statics/default/img/loading.gif) no-repeat 50% 50%');
			var $w = $(window),
				delay = 0;
			var scrollLoad = function() {
					if(delay) clearTimeout(delay);
					setTimeout(function() {
						var h = $w.height() + $w.scrollTop();
						$list.each(function() {
							var $t = $(this);
							if($t.offset().top < h) {
								$list = $list.not($t.attr('src', $t.attr('data-src')));
							}
						})
					}, 400)
				}
			scrollLoad();
			$(window).on('scroll resize', scrollLoad);
		}
	})
});