define(function(require, exports, module) {
	var $ = require('jquery');
	require('../../css/esf/alert.css');
	require('drag');
	var amrt = 0;
	return function(content, opt) {
		opt = $.extend({
			time: 999,
			title: '提示',
			width: 320,
			height: 'auto',
			btnC: 1,
			btnY: 1,
			btnYT: '确定',
			btnN: 0,
			btnNT: '取消',
			cName: '',
			iframe: 0,
			cf: function() {
				return 1
			},
			yf: function() {
				return 1
			},
			nf: function() {
				return 1
			},
			rf: function() {
				return 1
			}
		}, opt || {});
		var $w = $(window),
			$select = $("select"),
			$a;
		if(opt.cName) {
			opt.cName += " info";
			opt.width = "auto";
		}
		opt.h = function() {
			$('<div id="hbg" style="height:' + $(document).height() + 'px;"></div>').appendTo('body').fadeTo('fast', 0.6);
			$select.css("visibility", "hidden");
			return opt;
		}
		opt.s = function() {
			var str = ['<div id="alertM" class="', opt.cName, '" style="width:', opt.width, 'px;"><h5 id="alertT">'];
			if(opt.btnC) str.push('<a id="alertR" title="关闭" href="javascript:void(0)">&times;</a>');
			str.push(opt.title, '</h5><div id="alertP" style="height:', opt.height, 'px;">');
			if(opt.iframe) str.push('<iframe id="alertF" frameBorder="0" scrolling="no" width="100%" height="100%" style="border:0;width:', opt.width - 24, 'px;height:', opt.height, 'px" src="', content, '"></iframe>');
			else str.push(content);
			str.push("</div>")
			if(opt.btnY || opt.btnN) {
				str.push('<div id="alertBtns">');
				if(opt.btnY) str.push('<a id="alertY" href="javascript:void(0)">', opt.btnYT, '</a>');
				if(opt.btnN) str.push('<a id="alertN" href="javascript:void(0)">', opt.btnNT, '</a>');
				str.push('</div>');
			}
			str.push('</div>');
			$("body").append(str.join(''));
			$a = $('#alertM');
			$a.css({
				top: ($w.height() - $a.height()) / 2 + $w.scrollTop(),
				left: ($w.width() - $a.width()) / 2,
				display: "block",
				opacity: 0
			}).addClass("on").animate({
				opacity: 1
			}, function() {
				if(!isNaN(opt.time)) amrt = setTimeout(function() {
					opt.r()
				}, opt.time);
				else {
					$('#alertR').mousedown(function() {
						return false;
					});
					$('#alertT').drag('#alertM', $w);
				}
			});
			if(!opt.cName) $a.on("click", "#alertR", function() {
				if(opt.cf()) opt.r()
			}).on("click", "#alertY", function() {
				if(opt.yf()) opt.r();
			}).on("click", "#alertN", function() {
				if(opt.nf()) opt.r();
			})
			return opt;
		}
		if($('#alertM').length > 0) {
			$('#alertM').remove();
			opt.s();
		} else opt.h().s();
		if(amrt);
		clearTimeout(amrt);
		amrt = 0;
		opt.r = function() {
			$a.removeClass("on").fadeOut(function() {
				$a.remove();
			})
			$('#hbg').fadeOut(function() {
				$(this).remove();
				$select.css("visibility", "visible");
				opt.rf();
			});
			if(amrt);
			clearTimeout(amrt);
			amrt = 0;
		}
	}
});