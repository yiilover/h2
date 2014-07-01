function showfceng(id,n){
 if(n==1){
   document.getElementById(id).style.display="block";
    $('.zzcLayer').css({display:"block"});
 }else{ 
   document.getElementById(id).style.display="none";
    $('.zzcLayer').css({display:"none"});
   }
}

function fsduanxin()
{
var value=document.getElementById('phones').value;
if(/^13\d{9}$/g.test(value)||(/^15[0-35-9]\d{8}$/g.test(value))||   
(/^18[05-9]\d{8}$/g.test(value))){      
}else{   
  	alert('手机号码不能为空');  // 提示窗口 显示的内容
	document.getElementById('phones').focus(); // 鼠标光标移到标题输入框
	return; // 返回不让提交
 
}

$.post("../make2012/senddx.php",{phone:value,content:document.getElementById('dxmsgs').value,lpid:document.getElementById('lpids').value},function(data){
    alert(data);
	showfceng('dxfsc',0);
});

 
}

function floattuangou(){
  var cname=document.getElementById('cnames').value;
   if ( cname.length < 2 )
	{
	alert("请输入正确的姓名.");
	return false;
	}
  var tel=document.getElementById('tels').value;
   if(/^13\d{9}$/g.test(tel)||(/^15[0-35-9]\d{8}$/g.test(tel))||(/^18[0-9]\d{8}$/g.test(tel))){       
   }else{  
    alert("请输入正确的号码.");
	return false; 
   }
   
   var sexstr="男";
   if(document.getElementById('sexs2').checked)  sexstr="女";
   
    $.post("/index.php?s=formguide/index/show_js",{name:cname,sex:sexstr,phone:tel,content:document.getElementById('contents').value,cid:document.getElementById('relation').value,subject:document.getElementById('subject').value,price:document.getElementById('price').value,region:document.getElementById('region').value,regionid:document.getElementById('regionid').value},function(data){
        alert(data);	
		if(data.indexOf("成功")>-1){
		  document.getElementById('cnames').value="";
		  document.getElementById('tels').value="";
		  document.getElementById('contents').value="";
		  showfceng("tgbmc",0);
		}  
   });
}

function floattiwen(){
  var cname=document.getElementById('cnametws').value;
   if ( cname.length < 2 )
	{
	alert("请输入正确的昵称.");
	return false;
	}
	
   var tel=document.getElementById('titletws').value;
   if(/^13\d{9}$/g.test(tel)||(/^15[0-35-9]\d{8}$/g.test(tel))||(/^18[0-9]\d{8}$/g.test(tel))){       
   }else{  
    alert("请输入正确的号码.");
	return false; 
   }

   var content=document.getElementById('contenttws').value;
   if ( content.length == 0 )
	{
	alert("内容不能为空.");
	return false;
	}
	
   $.post("/index.php?s=content/index/lp_post_js",{cname:cname,tel:tel,content:content,cid:document.getElementById('lpids').value,subject:document.getElementById('subject').value,region:document.getElementById('region').value,regionid:document.getElementById('regionid').value},function(data){
        alert(data);	
		if(data.indexOf("成功")>-1){
		  document.getElementById('cnametws').value="";
		  document.getElementById('titletws').value="";
		  document.getElementById('contenttws').value="";
		  showfceng("zxzxc",0);
		}  
   });
   
}
/**
楼盘小导航浮动；2013-07-06 
**/
window.onscroll=function()
{
var nav_box=document.getElementById('index_nav_box');
var nav=document.getElementById('menu');
var thetop=document.documentElement.scrollTop+document.body.scrollTop;
var to_top=getTop(nav_box);
if(thetop>=to_top)
{
if(nav.className=='fixed_top')
return false;nav.className='mB10 fixed_top';
}
else
{
if(nav.className=='mB10')
return false;nav.className='mB10';
}
}
function getTop(el)
{
var offset=el.offsetTop;
if(el.offsetParent!=null)
{
offset+=getTop(el.offsetParent);
}
return offset;
}
