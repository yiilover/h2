define(function(require, exports, module) {
	var $ = require('jquery');
	require('../../css/esf/tip.css');
	$.fn.tip = function(sta, con, direction) {
		direction = direction ? direction : "r";
		var $t = $(this),
			tip = $t.data("tip"),
			$tip, s;
		if(!tip) {
			tip = "tip" + Math.round(Math.random() * 999999);
			$t.data("tip", tip);
		}
		if(typeof(sta) == "undefined") sta = "tip_suc";
		else sta = !sta ? "tip_err" : "tip";
		if($("#" + tip).length == 0) $("body").append('<div id="' + tip + '"><span></span><i class="tip_bt"></i><i class="tip_ft"></i></div>');
		$tip = $("#" + tip).attr("class", sta + ' ' + direction);
		$tip.find("span").html(con);
		switch(direction) {
		case "r":
			s = function() {
				var offset = $t.offset();
				$tip.css({
					left: offset.left + $t.width() + 24,
					top: offset.top
				});
			};
			break;
		case "t":
			s = function() {
				var offset = $t.offset();
				$tip.css({
					left: offset.left + $t.width() + 24,
					top: offset.top
				});
			};
			break;
		case "b":
			s = function() {
				var offset = $t.offset();
				$tip.css({
					left: offset.left + $t.width() + 24,
					top: offset.top
				});
			};
			break;
		case "l":
			s = function() {
				var offset = $t.offset();
				$tip.css({
					left: offset.left - $tip.width() - 24,
					top: offset.top
				});
			};
			break;
		}
		s();
		$(window).on("resize", s)
		return $tip.on("click", function() {
			$(this).remove();
			$(window).off("resize", s)
		});
	}
});