define(function(require, exports, module) {
	var $ = require('jquery');
	var $t = $("#topBar div.fl"),
		$f = $t.find("form");
	$("#topBarPanl").hover(function() {
		$(this).find("div").show()
	}, function() {
		$(this).find("div").hide()
	})
	if($f.length > 0) {
		function focus($t) {
			$t.css("borderColor", "#f00").focus();
			setTimeout(function() {
				$t.css("borderColor", "#ddd");
			}, 200)
			setTimeout(function() {
				$t.css("borderColor", "#f00");
			}, 400)
			setTimeout(function() {
				$t.css("borderColor", "#ddd");
			}, 600)
			setTimeout(function() {
				$t.css("borderColor", "#f00");
			}, 800)
		}
		var $un = $t.find("input:text").removeAttr("required");
		var $pa = $t.find("input:password").removeAttr("required");
		$un.on("keyup", function() {
			if($un.val() != "") $un.css("borderColor", "#ddd");
		})
		$pa.on("keyup", function() {
			if($pa.val() != "") $pa.css("borderColor", "#ddd");
		})
		$f.on("submit", function() {
			if($un.val() == "") {
				focus($un);
				return false;
			}
			if($pa.val() == "") {
				focus($pa);
				return false;
			}
		})
	}
});