define(function(require, exports, module) {
	var $ = require('jquery');
	$.fn.drag = function(opt, $w) {
		opt = opt ? opt : this;
		this.onselectstart = function() {
			return false
		};
		var $drag = $(opt);
		var w = $w.width() - $drag.width() - 12;
		var c = $drag.offset().top - $w.scrollTop();
		$w.bind('scroll', function() {
			$drag.css({
				top: c + $w.scrollTop()
			})
		});
		return $(this).css('cursor', 'move').mousedown(function(e) {
			var st = $w.scrollTop();
			var t = st + 4;
			var u = st + $w.height() - $drag.height() - 12;
			var x = e.pageX - $drag.fadeTo('fast', 0.6).offset().left;
			var y = e.pageY - $drag.offset().top - st;
			$(document).mousemove(function(e) {
				var cx = e.clientX - x;
				var cy = e.clientY - y;
				c = $drag.css({
					left: cx < 4 ? 4 : (cx > w ? w : cx),
					top: cy > u ? u : (cy < t ? t : cy)
				}).offset().top - $w.scrollTop();
			}).mouseup(function() {
				$drag.fadeTo('fast', 1);
				$(this).unbind('mousemove').unbind('mouseup');
			});
			return false;
		})
	}
});