<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php include template("content","head_house"); ?>
<script language="javascript" src="<?php echo APP_PATH;?>statics/house5-style1/js/house/baojia/lpjs01.js"></script>
<script language="javascript" src="<?php echo APP_PATH;?>statics/house5-style1/js/house/baojia/lpjs02.js"></script>
<script language="javascript" src="<?php echo APP_PATH;?>statics/house5-style1/js/house/baojia/baojia.js"></script>
<!--onload-evert-e-->
<div style=" width:100%;">
  <br class="clear" />
    <!-- 区域连接开始 -->
<div id="index_nav_box">
<div class="qlink" id="index_nav">
<div class="qltitle">
<b>楼盘报价</b>
</div>
<div class="qlist">
<ul>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=54eccbbf64814416864400a816c849a1&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'54eccbbf64814416864400a816c849a1');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<li>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
<a href="javascript:;" onclick="ChangeMaodian('maodian<?php echo $reg['0'];?>', 140);"><?php echo $reg['1'];?></a>
<?php if($n>0 && $n<count($data)) { ?> | <?php } ?>
<?php $n++;}unset($n); ?>
</li>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>
</div>
<div class="qsearch">
<ul>
<form name="listfrom" action="<?php echo HOUSE_PATH;?>list.html" method="get" target="_blank">
<li class="big"></li>
<li class="qname">楼盘搜索：</li>
<li><input class="keyword" name="keyword" type="text" /></li>
<li class="qtrue"><a href="javascript:document.listfrom.submit();"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/qtrue.jpg" /></a></li>
</form>
</ul>
</div>
<span class="bline"></span>	</div>
</div>
  	<!-- 区域连接结束 -->
    <br class="clear" />
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=54eccbbf64814416864400a816c849a1&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'54eccbbf64814416864400a816c849a1');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
  <?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
  <div class="pricelist">    
  	<div class="pltitle" id="maodian<?php echo $reg['0'];?>">
<h3><?php echo $reg['1'];?>楼盘最新报价</h3>
<A style="LINE-HEIGHT: 25px; PADDING-RIGHT: 10px; FLOAT: right" href="#">回到顶部</A>
</div>

<div class="plist">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=89571b0bc0bb7ff141af34568462a26e&action=pricelist&region=%24reg%5B0%5D&catid=14&pricecatid=11&num=31&order=inputtime+DESC&cache=172800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('region'=>$reg[0],'catid'=>'14','pricecatid'=>'11','order'=>'inputtime DESC',)).'89571b0bc0bb7ff141af34568462a26e');if(!$data = tpl_cache($tag_cache_name,172800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'pricelist')) {$data = $content_tag->pricelist(array('region'=>$reg[0],'catid'=>'14','pricecatid'=>'11','order'=>'inputtime DESC','limit'=>'31',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!--报价 -->
<ul>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php if($n< 31) { ?>
<li>
<span>
<h2>
<em>·</em><a href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank" title="<?php echo $r['title'];?>"><?php echo str_cut($r['title'],24,'');?></a></h2>
<b><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?>元/M<sup>2</sup><?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?><?php } ?> <?php } else { ?>一房一价<?php } ?></b>
<strong><?php if($r[trend]=="1") { ?><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/up.gif"  /><?php } elseif ($r[trend]=="2") { ?><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/down.gif"  /><?php } else { ?><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/line.gif"  /><?php } ?></strong></span></li>
<?php } ?>
<?php $n++;}unset($n); ?>
</ul>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<ul id="show<?php echo $reg['0'];?>"></ul>
<br class="clear" />
</div>

<br class="clear" /><?php if(count($data)> 30) { ?><div class="pmore" id="onbutton<?php echo $reg['0'];?>">
<a href="javascript:;" onclick="initFloat(0, <?php echo $reg['0'];?>,  'show<?php echo $reg['0'];?>', 'onbutton<?php echo $reg['0'];?>');"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/more.png" /></a>
</div><?php } ?>  </div>   
 <?php $n++;}unset($n); ?>
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
  <br class="clear" />
  <br />

</div>
<!--onload-evert-e-->
<div class="hr10"></div>
</div>
</div>
<?php include template("content","footer"); ?>


<!--lp_duibi start-->
<div class="clzt1" id="clzt1" title="点击展开" onclick="float_display('clzt1','none');float_display('clzt2','');">&nbsp;</div>
<div class="comparison" id="clzt2" style="display:none;position:absolute;z-index:200; right:0px;">
  <div class="comp_title font2">
  <span>
<a href="javascript:void(0)" onclick="float_display('clzt2','none');"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/close.gif" /></a>
  </span>
  楼盘对比栏
  </div>
  <div class="comp_lr"  id="withitem">
  <div class="cllist1" id="itemlist">
  <ul>
  <li><!--addinto--></li>	
  </ul>
  </div>
 <div class="a1">		
<label id="dui_remove"><input type="submit" value="清空" class="smb_btn2" onclick="removeAllItem();" /></label>
<label id="dui_togo"><input type="submit" value="对比" class="smb_btn4" onclick="toComparePage();" /></label>		
</div>
  </div>

  <iframe  id="topframe" style='position:absolute; visibility:inherit; top:0px; border:0px; left:0px;width:150px;z-index:-1; filter: Alpha(Opacity=0);'></iframe>
  <div class="comp_end"></div>
</div>

<script>

var Float= new Object();
Float.Browser = {

ua: window.navigator.userAgent.toLowerCase(),
ie: /msie/.test(window.navigator.userAgent.toLowerCase()),
moz: /gecko/.test(window.navigator.userAgent.toLowerCase())

};

/************************Cookie*******************************/
var CompCookie = {
setCookie : function(name, value, expires, path, domain, secure)
{
document.cookie = name + "=" + escape(value) +
((expires) ? "; expires=" + expires.toGMTString() : "") +
((path) ? "; path=" + path : "; path=/") +
((domain) ? "; domain=" + domain : "") +
((secure) ? "; secure" : "");		
},

getCookie : function(name)
{
var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));

if (arr != null)
{
return unescape(arr[2]);

}

return null;
},

clearCookie : function(name, path, domain)
{
if (CompCookie.getCookie(name))
{
 document.cookie = name + "=" +
((path) ? "; path=" + path : "; path=/") +
((domain) ? "; domain=" + domain : "") +
";expires=Fri, 02-Jan-1970 00:00:00 GMT";
}
}
};


function float_$(id)
{
return (typeof id == "object")?id:document.getElementById(id);
}

function float_display(id,display)
{
float_$(id).style.display = display;
setTopFrame();
}

//跳转至对比页面
function toComparePage()
{
var compCookie = CompCookie.getCookie("house_duibi");
if(compCookie)
{
var comps = compCookie.split("|");
var cmpstr = new Array();
var tempi = 0; 

for(var i=0;i<comps.length;i++)
{
cmpstr.push(comps[i].split(",")[1]);
tempi = tempi + 1;
}

if(tempi < 2){
alert('抱歉，至少选择2个以上的楼盘进行比较！');
return false;
}
window.open('<?php echo HOUSE_PATH;?>lp_duibi/'+cmpstr.join("_"));
        //why clear
        //CompCookie.clearCookie("wz_Houseapp_compare");
}else
    {
       // window.open('index.php');
   alert('抱歉，至少选择2个以上的楼盘进行比较！');
    }

    initCompareBar();
}

var g_comp_cookie = -1;
//初始化页面片
function initCompareBar()
{
    var compCookie = CompCookie.getCookie("house_duibi");
    if (g_comp_cookie == compCookie)
    {

        return false;
    }else
    {
        g_comp_cookie = compCookie;
    }

     if(compCookie)
{ 
//float_$("noitem").style.display="none";
//float_$("withitem").style.display="block";
float_$("itemlist").innerHTML = '';		
float_$("dui_remove").innerHTML = '<input type="submit" value="清空" class="smb_btn2" onclick="removeAllItem();" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="对比" class="smb_btn4" onclick="toComparePage();" />';	

var cookieArr = compCookie.split("|");

var itemStr = "";
itemStr+='<ul>';
for(var i=0;i<cookieArr.length;i++)
{
var serial_info = cookieArr[i].split(",");
itemStr+= '<li>';   		
itemStr+= '<span class="td_1" title="' + serial_info[0] + '">' + serial_info[0] + '</span>';
itemStr+= '<span class="td_2 linke"><a class="remove" href="javascript:removeCompareItem('+serial_info[1]+');">删除</a></span></li>';
 }

itemStr+='</ul>';
float_$("itemlist").innerHTML = itemStr;
}else
{	

float_$("itemlist").innerHTML = "";
float_$("itemlist").innerHTML = '<font style="line-height:25px; color:#ccc; overflow:hidden;">请先选择楼盘加入到对比栏<br />最多可同时对比4个楼盘</font>';
float_$("dui_remove").innerHTML = '<input type="submit" value="清空" class="smb_btn2" disabled="disabled" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="对比" class="smb_btn4" disabled="disabled" />';	


}

setTopFrame();
}
//setup topframe
function setTopFrame()
{
    if(Float.Browser.moz)
{
        float_$("topframe").style.top = "10px";
    }
    float_$("topframe").style.height=(float_$("clzt2").offsetHeight-(Float.Browser.moz?28:0))+"px";
}
//cookie设置
function addCompareItem(id,value)
{

float_$("clzt1").style.display="none";
float_$("clzt2").style.display="";
var compare = CompCookie.getCookie("house_duibi");

if(compare)
{
var newComArr = new Array();
var comArr = compare.split("|");
 		if(comArr.length>=4)
{
alert("您好,为了保证对比查看效果您最多只能选择4个楼盘参加比较");
return;
}
for(var i=0;i<comArr.length;i++)
{
if(comArr[i].split(",")[1] == id)
{
alert("对不起，您已经添加\""+comArr[i].split(",")[0]+"\"");
return;
}else
            {
                newComArr.push(comArr[i]);
            }
}
newComArr.push(value+","+id);
CompCookie.setCookie("house_duibi",newComArr.join("|"));
initCompareBar();
}else{
CompCookie.setCookie("house_duibi",value+","+id);		
 	}

initCompareBar();
}
//删除对比项
function removeCompareItem(id)
{
    initCompareBar();
var compare = CompCookie.getCookie("house_duibi");
if(compare)
{
var newComArr = new Array();
var comArr = compare.split("|");
for(var i=0;i<comArr.length;i++)
{
if(comArr[i].split(",")[1]!=id)
{
newComArr.push(comArr[i]);
}

}
CompCookie.setCookie("house_duibi",newComArr.join("|"));
initCompareBar();
}
}

//删除所有项
function removeAllItem()
{
CompCookie.clearCookie("house_duibi");
initCompareBar();
}

//最小高度，一级导航有关
var MIN_TOP = 220;
//浮动自身的宽度
var CLZT_WIDTH1 = 29;
var CLZT_WIDTH2 = 224;

function scrolldiv()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");

    var scr_top = document.documentElement.scrollTop || document.body.scrollTop;
    var client_h = document.documentElement.clientHeight||document.body.clientHeight;
    var top = scr_top + (client_h/2 - 95);
    //当前高度
    var cur_top = parseInt(clzt1.style.top);
    if (top - cur_top > 4 || top - cur_top < -4)
    {
        top = Math.ceil(0.2 * (top - cur_top)) + cur_top;
    }

    if (top < MIN_TOP)
    {
        top = MIN_TOP;
    }

    //clzt1.style.top = top + 90 +"px";
    //clzt2.style.top = top + 90 +"px";
clzt1.style.top = top + 0 + "px";
    clzt2.style.top = top + 0 + "px";
}
//底部滚动条
function scroll_bot()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
    var scr_left = document.documentElement.scrollLeft || document.body.scrollLeft;
    var client_w = document.documentElement.clientWidth||document.body.clientWidth;

    var left1 = scr_left + client_w - CLZT_WIDTH1;
    if (left1 > 0)
    {
        //clzt1.style.left = left1 + 90 + "px";
clzt1.style.right = 0 + "px";
    }
    var left2 = scr_left + client_w - CLZT_WIDTH2;
    if (left2 > 0)
    {
        //clzt2.style.left = left2 + 90 + "px";
clzt2.style.right = 0 + "px";
    }
}

//固定位置
function fixed_div()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
var top = document.documentElement.clientHeight||document.body.clientHeight;
    var scr_top = document.documentElement.scrollTop || document.body.scrollTop;

clzt1.style.position="fixed";
clzt1.style.right=0;
    top = (top/2-95);

    if (scr_top + top < MIN_TOP)
    {
        top = MIN_TOP - scr_top;
    }

clzt1.style.top = top + 90+"px";
    clzt2.style.position="fixed";
clzt2.style.right=0;
clzt2.style.top = top + 90+"px";
}

//相应鼠标滚轮
function mousewhell_cancel(tar) {clearInterval(tar);};
function mousewhell_go() {
    //setTimeout(scrolldiv,10);
var _detector = setInterval(scrolldiv,10);
setTimeout('mousewhell_cancel(' + _detector + ')',1000);
};


//初始化相关设置
function init_comp_bar()
{
    if (document.attachEvent&&window.ActiveXObject&&!window.XMLHttpRequest)
    {
        window.attachEvent("onload",scrolldiv);
        document.attachEvent("onmousewheel",mousewhell_go);
        window.attachEvent("onresize",function()<?php echo scrolldiv(),scroll_bot();?>);
        window.attachEvent("onscroll",function()<?php echo scrolldiv(),scroll_bot();?>);
    };
    if (document.attachEvent&&window.ActiveXObject&&window.XMLHttpRequest)
    {
    window.attachEvent("onload",fixed_div);
    window.attachEvent("onresize",fixed_div);
    window.attachEvent("onscroll",fixed_div);
    };
    if (document.addEventListener)
    {
        window.addEventListener("load",fixed_div,true);
        window.addEventListener("resize",fixed_div,true);
        window.addEventListener("scroll",fixed_div,true);
    };

    //定时更新cookie内容
    setInterval(initCompareBar,2000);
}

//初始化对比篮内容
initCompareBar();
//初始化位置
init_comp_bar();
</script>
<!--lp_duibi end-->


<!-- 返回顶部 -->
<!--a href="#"><div class="rTop" id="rTop"></div></a>
<script>
 window.onscroll=function(){
  if(document.body.scrollTop||document.documentElement.scrollTop>0){
   document.getElementById('rTop').style.display="block"
   }else{
    document.getElementById('rTop').style.display="none"
    }
  
  
  }
</script-->



</body>
</html>