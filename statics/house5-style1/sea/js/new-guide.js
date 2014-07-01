var html = '';
html += '<div class="guide-warp">';
	html += '<div class="guide">';
		html += '<div id="follow1" class="guide-img">';
			html += '<div title="继续指引" class="go-guide"></div>';
			html += '<div title="退出指引" class="exit-guide close-guide"></div>';
			html += '<div title="退出指引" class="exit-guide2 close-guide"></div>';
		html += '</div>';
		html += '<div id="follow2" class="guide-img">';
			html += '<div title="继续指引" class="go-guide"></div>';
			html += '<div title="退出指引" class="exit-guide close-guide"></div>';
			html += '<div title="退出指引" class="exit-guide2 close-guide"></div>';
		html += '</div>';
		html += '<div id="follow3" class="guide-img">';
			html += '<div title="退出指引" class="exit-guide close-guide"></div>';
			html += '<div title="关闭索引" class="exit-guide2 close-guide"></div>';
		
	html += '</div>';
html += '</div>';
document.write(html);
(function($){
	var defaults = {
		coverbgColor:"#000",//遮罩层颜色，默认黑色
		coverOpacity:0.5//遮罩层透明度
	};
	$.fn.guide= function(options){
		options = $.extend({},defaults,options);
		return this.each(function(){
			var self = $(this);
			var guideBtn = $('.new-guide');
			var exitGuide = $('.close-guide');
			var goGuide = $('.go-guide');
			var guideImg = $('.guide-img');
			var len = guideImg.length;
			var index = 0;
			self.bind('click',function(){
				window.scrollTo(0,0);
				guideBtn.hide();
				$('.guide').show();
				guideImg.eq(0).show()
				var $coverDom = "<div id=\"GTipsCover\" style=\"background:"+options.coverbgColor+";position:absolute;filter:alpha(opacity=0);opacity:0;width:100%;left:0;top:0;z-index:9999901\"><iframe src=\"about:blank\" style=\"width=100%;height:"+$(document).height()+"px;filter:alpha(opacity=0);opacity:0;scrolling=no;z-index:870610\"></iframe></div>";
				$($coverDom).appendTo("body").animate({opacity:options.coverOpacity},500);
			})
			var g = $.cookie('guidance');
			if(g == null){
				$.cookie('guidance' , '1' , {expires : 365 , domain : cookiedomain});
				window.scrollTo(0,0);
				guideBtn.hide();
				$('.guide').show();
				guideImg.eq(0).show()
				var $coverDom = "<div id=\"GTipsCover\" style=\"background:"+options.coverbgColor+";position:absolute;filter:alpha(opacity=0);opacity:0;width:100%;left:0;top:0;z-index:9999901\"><iframe src=\"about:blank\" style=\"width=100%;height:"+$(document).height()+"px;filter:alpha(opacity=0);opacity:0;scrolling=no;z-index:870610\"></iframe></div>";
				$($coverDom).appendTo("body").animate({opacity:options.coverOpacity},500);
			}
			exitGuide.bind('click',function(){
				 exit();
				 $(this).parent().hide()
			});
			goGuide.bind('click',function(){
				index ++;
				if(index == 2){
					guideImg.eq(2).show()
				}
				
				$(this).parent('.guide-img').hide().next().show()
			})
			function exit(){
				$('.guide').children().hide()
				$('.guide').hide()
				$cover = $("#GTipsCover");
				$cover.animate({opacity:"0"},500,function(){
					$(this).remove();
					guideBtn.show()
				});
				index = 0;
			}
		});
	}
})(jQuery);
$(function(){
	$('.new-guide').guide();
})