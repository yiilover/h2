define(function(require, exports, module) {
	require('jquery');
	$(function() {
		var $list = $('img[data-src]');
		if ($list.length > 0) {
			$list.attr('src', 'http://house.inhe.net/static2/images/common/lazy.gif').css('background', 'url(http://house.inhe.net/static2/images/common/loading.gif) no-repeat 50% 50%');
			var $w = $(window),
				delay = 0;
			var scrollLoad = function() {
				if (delay) {
					clearTimeout(delay);
					delay = 0;
				}
				delay = setTimeout(function() {
					var h = $w.height() + $w.scrollTop();
					$list.each(function() {
						var $t = $(this);
						if ($t.offset().top < h) {
							$list = $list.not($t.attr('src', $t.attr('data-src')));
						}else
							return false;
					})
					if (!$list.length) {
						$w.off('scroll resize', scrollLoad);
						return;
					}
				}, 400)
			}
			scrollLoad();
			$w.on('scroll resize', scrollLoad);
		}
	})
});