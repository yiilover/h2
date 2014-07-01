// JavaScript Document
function goTopEx(){
        var obj=document.getElementById("goTopBtn");
        function getScrollTop(){
				//alert(document.documentElement.scrollTop);
                return document.documentElement.scrollTop+document.body.scrollTop;
            }
        function setScrollTop(value){
                document.body.scrollTop=value;
				document.documentElement.scrollTop=value;
            }    
        window.onscroll=function(){
			var leftBody = (document.body.scrollWidth - 960)/2 - 52;
			if(getScrollTop()>0){
				obj.style.display="";
				obj.style.right= leftBody + "px";
				}else{obj.style.display="none";}}
        obj.onclick=function(){
            var goTop=setInterval(scrollMove,10);
            function scrollMove(){
                    setScrollTop(getScrollTop()/1.1);
                    if(getScrollTop()<1)clearInterval(goTop);
                }
        }
    }