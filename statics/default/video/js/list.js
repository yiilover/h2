// JavaScript Document

(function($){
	var obj={};
	$.PlayInfo={
		init: function(parameter){
			obj.picList=$(parameter.picList);
			obj.blackList=$(parameter.blockList);
			$.PlayInfo.change(obj.picList,obj.blackList);
			$.PlayInfo.autoChange(obj.picList,obj.blackList)
		},
		change:function(picObj,blockObj){
			blockObj.mouseenter(function(){
				if(!$("#picContent").is(":animated")){
					var thisIndex=$(this).index();
					$("#picContent").width(picObj.length*686);
					$("#picContent").animate({left:-thisIndex*682},800);
				}
			});
		},
		autoChange:function(picObj,blockObj){
			var chooseIndex=0;
			var paly=0;
			playFun();
			function playFun(){
				paly=setInterval(function(){
					blockObj.eq(chooseIndex).mouseenter();
						if(chooseIndex<blockObj.length-1){
							chooseIndex++;
							blockObj.eq(chooseIndex-1).addClass("on").siblings().removeClass();
						}
						else{
							blockObj.eq(blockObj.length-1).addClass("on").siblings().removeClass();
							chooseIndex=0;
						}
					},2000);
			}
			blockObj.mouseover(function(){
				var thisblock=$(this).index();
				blockObj.eq(thisblock).addClass("on").siblings().removeClass();
				clearInterval(paly);
			});
			blockObj.mouseout(function(){
				var thisblock=$(this).index();
				chooseIndex=thisblock;
				playFun();
			});
		}
}
})(jQuery)

$(function() {

    switch (orderType) {
        case 0:
            $(".order a").eq(0).addClass("hover").siblings().removeClass("hover");
            break
        case 1:
            $(".order a").eq(1).addClass("hover").siblings().removeClass("hover");
            break
        case 2:
            $(".order a").eq(2).addClass("hover").siblings().removeClass("hover");
            break
        default:
            break;
    }

    switch (showSet) {
        case "c":
            $(".rankStyle .bg .showSet a").eq(0).removeClass("rowC");
            $(".rankStyle .bg .showSet a").eq(1).removeClass("pic").addClass("picC");
            $(".videoList ul").eq(0).show().siblings().hide();
            break
        case "r":
            $(".rankStyle .bg .showSet a").eq(1).removeClass("picC");
            $(".rankStyle .bg .showSet a").eq(0).removeClass("row").addClass("rowC");
            $(".videoList ul").eq(1).show().siblings().hide();
            break
        default:
            break
    }


//    var content = $(".videoList ul");
//    var showIcon = $(".rankStyle .bg .showSet a");
//    showIcon.click(function() {
//        var bIndex = showIcon.index(this);
//        if (bIndex == 0) {
//            showIcon.eq(bIndex).addClass("picC");
//            showIcon.eq(bIndex + 1).removeClass("rowC").addClass("row");
//        }
//        else {
//            showIcon.eq(bIndex).addClass("rowC");
//            showIcon.eq(bIndex - 1).removeClass("picC").addClass("pic");
//        }
//        content.eq(showIcon.index(this)).show().siblings().hide();
//    })
})