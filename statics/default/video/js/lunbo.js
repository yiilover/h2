

(function($){
$.lunbo = {
	interval:0,
	isAuto:true,
	init : function(parameter){
		var os = {};
		$.extend(true, os, {
			fiMovie:$("#" +parameter.fiMovie),
			fiList:$("#" +parameter.fiList),
			fiTab:$("#" +parameter.fiTab),
			fiTabLi:null,
			fiTxt:$("#" +parameter.fiTxt),
			on:parameter.on,
			fiPlay:$("#" +parameter.fiPlay),
			loading:$("#" +parameter.loading)
		});
		$.lunbo.loadJson(os);
	},
	//获得json数据
	loadJson : function(os){
		$.getJSON("http://tv.xf88.com/ajax/GetJson.ashx?action=getADList", {}, function(data){
			os.fiMovie.data('R', data.rows);
			var _html = '',
			 	_tagHtml='',
				R = os.fiMovie.data('R');
			for(var i=0; i<R.length; i++){
				_html +='<a href="'+R[i].ADURL+'" target="_blank"><img lazysrc="'+R[i].ADPath+'"></a>';
				if(i==0)
				{
					_tagHtml +='<a href="javascript:;" class="curr"></a>';
				}
				else
				{
					_tagHtml +='<a href="javascript:;"></a>';
				}
			}
			os.fiList.append(_html);
			os.fiTab.append(_tagHtml);
			os.fiTabLi=os.fiTab.children('a');
			$.lunbo.cutover(os);
			$.lunbo.auto(os);
		});
	},
	//加载数据
	create : function(os, i){
		var _html,
			root = this,
			R = os.fiMovie.data('R'),
			$a = os.fiList.children();
		_html = '<h2><a href="'+R[i].ADURL+'" target="_blank">'+R[i].ADName.substr(0, 13)+'</a></h2><h3>'+R[i].Info.substr(0, 120)+'...</h3>';
		os.fiTxt.html(_html);//加载文字
		if($a.eq(i).children().attr('src')==undefined || $a.eq(i).children().attr('src')==''){			
			os.loading.show();
			var img=new Image();
			root.isAuto=false;
			img.onload=function(){
				os.loading.hide();
				$a.eq(i).children().attr('src', $a.eq(i).children().attr('lazysrc'));
				root.isAuto=true;				
			}
			img.src=$a.eq(i).children().attr('lazysrc');
		}
		$a.eq(i).show().siblings().hide();
		os.fiPlay.attr("href", R[i].ADURL);//立即播放
	},
	//事件开始
	cutover : function(os){
		var root=this;
		
		os.fiList.mouseover(function(){
			root.isAuto=false;
		})
		os.fiTab.mouseover(function(){
			root.isAuto=false;
		})
		os.fiList.mouseout(function(){
			root.isAuto=true;
		})
		
		os.fiTabLi.mouseenter(function(){
			var _index = $(this).index();
			$.lunbo.create(os, _index);
			$(this).addClass(os.on).siblings().removeClass(os.on);//选项卡
		}).eq(0).mouseenter();
	},
	//自动播放
	auto : function(os){
		var root = this;
		interval=setInterval(function(){
			if(root.isAuto)
			{
				if(os.fiTab.children(os.fiTabLi+'[class='+os.on+']').index() == os.fiTabLi.length-1){
					os.fiTabLi.eq(0).mouseenter();
				}
				else
				os.fiTab.children(os.fiTabLi+'[class='+os.on+']').next().mouseenter();
			}
		},4000);
	}
}
})(jQuery)
