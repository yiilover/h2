define(function(require, exports, module) {
	var $=require('jquery');
	require('autab');
	$("#tab1").autab("i","li",4);
	$("#tab12,#tab13").autab("a.h4tab","table",0,0.2);
	$("#tab21,#tab22,#tab23,#tab24,#tab25").autab("a.h4tab","ul",0,0.2);
	$("#tab31").autab("a.h4tab","div.ibA",0,0.2);
	$("#tab41,#tab42").autab("a.h4tab","div.autab",0,0.2);
	$("#tab43").autab("a","div.autab",0,0.2);
	$("#tab12,#tab13,#tab21,#tab22,#tab23,#tab24,#tab25,#tab31,#tab41,#tab42").each(function(){
		var $a=$(this).find("a.more");
		if($a.length>0)
			$(this).find("a.h4tab").mouseover(function(){
				$a.attr("href",$(this).attr("href"))
			})
	})
	$("#tab43").mouseout(function(){
		$(this).find("div.autab").hide();
	})
	
	$("#city").hover(function(){
		$(this).find("div").show();
	},function(){
		$(this).find("div").hide();
	})
	$("#ullr,#ull").each(function(){
		var i=0,
			$t=$(this),
			$ul=$t.find("ul"),
			l=$ul.find("li").length,
			w=$ul.find("li").width();
		$ul.width(l*w+9);
		$(this).on("click","a.l",function(){
			i--;
			if(i==-1)
				i=l-1;
			$ul.stop(true,false).animate({left:-i*w})
		}).on("click","a.r",function(){
			i++;
			if(i==l)
				i=0;
			$ul.stop(true,false).animate({left:-i*w})
		})
	}).hover(function(){
		$(this).addClass("on")
	},function(){
		$(this).removeClass("on")
	})
	var $ztcon=$("#ztcon"),
		$zti=$("#ztControl i"),
		i=1,
		d=0;
	var ztFunc=function(){
		i++;
		i=i>=4?1:i;
		$zti.removeClass("on").eq(i).addClass("on");
		$ztcon.stop(true,false).animate({top:(1-i)*146});
	}
	var ztA=setInterval(ztFunc,4000);
	$zti.on("mouseover",function(){
		d=$(this).index();
		if(d>0&&d<4){
			i=d;
			$zti.removeClass("on").eq(i).addClass("on");
			$ztcon.stop(true,false).animate({top:(1-i)*146});
		}
	}).on("click",function(){
		if(d==0){
			i=i==1?2:i-2;
		}
		ztFunc();
	}).add($ztcon).hover(function(){
		clearInterval(ztA);
	},function(){
		ztA=setInterval(ztFunc,4000);
	})
})