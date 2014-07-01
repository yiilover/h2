define(function(require, exports, module) {
	var $ = require('jquery');
	$.fn.autab = function(menu, list, time, delay) {
		return $(this).each(function() {
			var $p = $(this),
				$m = $p.find(menu),
				$l = $p.find(list),
				i = 0,
				d = delay ? delay : 0,
				t;
			$m.hover(function() {
				var $t = $(this);
				t = setTimeout(function() {
					i = $m.removeClass("on").index($t.addClass("on"));
					$l.hide().eq(i).show();
				}, d * 1000)
			}, function() {
				clearTimeout(t);
			})
			if(time > 0) {
				var l = $m.length;
				var func = function() {
						i++;
						i = i == l ? 0 : i;
						$m.removeClass("on").eq(i).addClass("on");
						$l.hide().eq(i).show();
					}
				var iv = setInterval(func, time * 1000)
				$p.hover(function() {
					clearInterval(iv);
				}, function() {
					iv = setInterval(func, time * 1000);
				})
			}
		})
	}
});