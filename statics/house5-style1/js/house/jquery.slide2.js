

(function($){


$.slideView = {
	init : function(parameter){
		var options = {
			panelWrapper:	null,		//包裹的id
			prevButton:		null,		//往左滑动1个按钮id
			prevMore:		null,		//往左滑动3个按钮id
			nextButton:		null,		//往右滑动1个按钮id
			nextMore:		null,		//往右滑动3个按钮id
			img:		null
		};
		options = $.extend(true, options, parameter);
		os = $.extend(true, options, {
			panelWrapper:$("#" +options.panelWrapper),
			prevButton:$("#" +options.prevButton),
			prevMore:$("#" +options.prevMore),
			nextButton:$("#" +options.nextButton),
			nextMore:$("#" +options.nextMore),
			img:$(options.img),
			ul:$("#" +options.panelWrapper).children("ul"),
			li:$("#" +options.panelWrapper).find("li")
		});
		$.slideView.panelW(os);
		$.slideView.imgResize(os);
	},
	//设置宽度
	panelW : function(os){
		os.ul.css("width", os.li.length*os.li.outerWidth(true));
		os.ul.css("left", 0);
		$.slideView.isflip(os);
	},
	//是否滑动
	isflip : function(os){
		if (os.li.width() < os.ul.width()){//当小于多少个的就不执行
			os.nextButton.click(function(){
				$.slideView.flip(os, 1);
			});
			os.prevButton.click(function(){
				$.slideView.flip(os, 2);
			});
			os.nextMore.click(function(){
				$.slideView.flip(os, 3);
			});
			os.prevMore.click(function(){
				$.slideView.flip(os, 4);
			});

        }
	},
	//开始滑动
	flip : function(os, is){
		var showNum = parseInt(os.panelWrapper.width()/os.li.width()),
			liWt = os.li.outerWidth(true),
			newLeft = parseInt(os.ul.css("left"));
			//if(isNaN(newLeft))
				//newLeft = 0;
			
		if (!os.ul.is(":animated")){
			switch (is){
				case 1 :if(os.ul.width() > Math.abs(newLeft) + liWt * showNum){
					//alert(os.ul.width());
					os.ul.animate({left:newLeft-liWt}, "slow");
				}
				break;
				case 2 :if(newLeft < 0){
					os.ul.animate({left:newLeft+liWt}, "slow");
				}
				break;
				case 3 :
					if(os.ul.width() - Math.abs(newLeft) - liWt*showNum*2 >= 0){
						os.ul.animate({left:newLeft-showNum*liWt}, "slow");
					}
					else{
						os.ul.animate({left:-(os.ul.width()-liWt*showNum)}, "slow");
					}
					break;
				case 4 :
					if(Math.abs(newLeft) >= liWt*showNum){
						os.ul.animate({left:newLeft+showNum*liWt}, "slow");
					}
					else{
						os.ul.animate({left:0}, "slow");
					}
					break;
			}
		}
	},
	//调整大小比例
	imgResize : function(os){
		var _picSize = {width:os.img.width(), height:os.img.height()};
		os.img.filter(function(){
			var _imgSize = {width:0, height:0};
			var $img = $(this).children("img");
			var image = new Image();
			image.src = $img.attr("src");
			image.onload=function(){
				_imgSize = {width:image.width, height:image.height};
				$.slideView.resize($img, _picSize.width, _picSize.height, _imgSize.width, _imgSize.height);				
			}
		});
	},
	
	resize : function($img, _picW, _picH, _imgW, _imgH){
		if(_imgW > _picW || _imgH > _picH){
			var _picscale = _picW/_picH;		//图片占位符比例
			var _imgscale = _imgW/_imgH;		//实际图片比例
			var scaleW = _imgW/_picW;
			var scaleH = _imgH/_picH;
			var scale = scaleW/scaleH;
			if(_imgscale < _picscale){
				$img.css({"width":_picW*scale, "height":_picH});
			}
			else{
				$img.css({"width":_picW, "height":_picH/scale});
			}
		}else{
			$img.css({"width":_imgW, "height":_imgH});
		}
	}
};
})(jQuery)
