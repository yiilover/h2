<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php include template("content","head_house"); ?>
<!--导航 end -->
<div class="cArea">
<div class="qq_title qq_title02">
<div class="a1 linko">业主QQ群搜索</div>
</div>
<div class="listconsearch">
  <div class="get" id="get">
 <div  class="getLine"> 
<strong>区域：</strong> 
<?php
	$parentid = intval($_GET['r']);
	$page = intval($_GET['p']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	$where = "qqqun<>''";
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
		$arrchildid = get_arrchildid('3360',$parentid);
		$where.=" and `region` in ($arrchildid)";
	}
	if(!empty($keyword))
	{
		$keyword1 = iconv('gbk', 'utf-8', $keyword);//rewrite 只支持UTF-8编码的中文
		$lst.= "-k".htmlentities(urlencode($keyword1));
		$where.=" and `title` like '%$keyword%'";
	}
	if(!empty($k))
	{
		$keyword = iconv('utf-8','gbk' , $k);
		$lst.= "-k".htmlentities(urlencode($k));
		$where.=" and `title` like '%$keyword%'";
	}
?>
<?php if(!empty($parentid)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>qqqun<?php echo deal_str2($lst);?>-p1.html">不限</a>
</span>	
<ul>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=54eccbbf64814416864400a816c849a1&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'54eccbbf64814416864400a816c849a1');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
<li>
<?php if(!empty($parentid) && $parentid==$reg[0]) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>qqqun-r<?php echo $reg['0'];?><?php echo deal_str2($lst,'r');?>.html"><?php echo $reg['1'];?></a>
</div>					
</li>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
</div>
<div class="wenlist">
<?php
if (!empty($parentid))
{
	$rp = 'r'.$parentid;
}
else
{
	$rp = 'p1';
}
?>
<ul><form method="get" name="search" action="<?php echo HOUSE_PATH;?>qqqun-<?php echo $rp;?>.html"  autocomplete="off"><li>楼盘名：</li>				
<li>
<input name="keyword" id="singleBirdRemote" type="text" class="inputwen" value=""/>					
</li>
<li><input type="submit" value="" class="smb_btn9" /></li>
</form>
</ul>
</div>
</div>
<div class="display_com_end"></div>
<div class="hr10"></div>
</div><div class="cArea">
<div class="cen_box">
<div class="PartGs">
  <div class="cen_top"></div>
  <div class="content_list">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6e9ce0c92fd62de2b71b4e611595b999&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=id+desc&page=%24page&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>'id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>'id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
    <div class="results">
	<div class="a1">共有<span class="redb" id="num"></span>条
	威海<?php if(!empty($parentid)) { ?>
<?php $menu_info = menu_info('3360',$parentid)?>
<?php echo $menu_info['0'];?><?php } ?>业主QQ群楼盘</div>
</div>
<div class="listhouse_k">
  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
  <div class="qqhouse">
        <div class="qqtp">
<a href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>" target="_blank">
<img src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb],130,90);?><?php } else { ?><?php echo APP_PATH;?>statics/house5-style1/img/index/nopic.jpg<?php } ?>" width="130" height="90" />
</a>
</div>
    <ul>
          <li>
<span class="td_1">
<a href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>" target="_blank"><?php echo $r['title'];?></a>
</span>
  </li>
      <li>
<span class="td_4 linkg">
<a onclick="ow('http://qun.qq.com/#jointhegroup/gid/<?php echo $r['qqqun'];?>')" href="javascript:void(0)" title="威海<?php echo $r['title'];?>业主QQ群(<?php echo $r['qqqun'];?>)"><?php echo $r['qqqun'];?><img border="0" src="<?php echo APP_PATH;?>statics/images/gp.gif" alt="点击这里加入此群" title="威海<?php echo $r['title'];?>业主QQ群(<?php echo $r['qqqun'];?>)"></a><SCRIPT>
function ow(owurl){
h=screen.height; 
w=screen.width;
ls = 'scrollbars   =   0,top=0,left=0,width= '+String(w)+ ',height= '+String(h);
var tmp=window.open(owurl,"",ls)
tmp.moveTo(0,0)
tmp.resizeTo(w-20,h)
tmp.focus()
tmp.location=owurl
}
</SCRIPT></span>
  </li>
      </ul>
    </div>
<?php $n++;}unset($n); ?>
<h2>	
<div class="hr10"></div>
<div class="pga"><div class="pages cl"><div class="pg"><?php echo $housepages;?></div></div></div>
</h2>
<script>
var num = $('#nums').val();
$('#num').html(num);
$('#num1').html(num);
</script>
</div>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <div style="clear:both;font-size:1px;"></div>
  </div>
</div>
<div class="cen_end"></div>
</div>
<div class="right">
<!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
<!--最新浏览记录上方广告位-->
<!--最新浏览记录上方广告位--> <!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
 <!--最新楼盘上方广告-->
 <!--最新楼盘上方广告-->
 <?php
 if(isset($recentlyHouse))
 {
	$prowhere = implode(',',$recentlyHouse);
}
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=94502c9ae7b785fa535277fe2ee67783&action=lists&catid=%24catid&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$sql,)).'94502c9ae7b785fa535277fe2ee67783');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--最新楼盘 begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">最近浏览过的楼盘</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--最新楼盘 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
     <div class="hr10"></div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6586ec47215fc8efa0c3d1846ea2ec81&action=lists&catid=%24catid&where=%60hot%60+like+%27%255%25%27&num=10&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,)).'6586ec47215fc8efa0c3d1846ea2ec81');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--最新楼盘 begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">更多&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">威海最新楼盘</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--最新楼盘 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
 <!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
 <!--精品楼盘上方广告-->
 <!--精品楼盘上方广告-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=705733c05377aa7eb117c4bccf67adb8&action=lists&catid=%24catid&where=%60hot%60+like+%27%256%25%27&num=10&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,)).'705733c05377aa7eb117c4bccf67adb8');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--精品楼盘推荐 begin-->
     <div class="rig_wrap">
       <div class="title_rig link5">
<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">更多&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">精品楼盘推荐</a>
   </div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
</li>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
   
         </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--精品楼盘推荐 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
</div>
</div>
<div class="hr10"></div>
<div class="hr10"></div>
</div>
</div>
<?php include template("content","footer"); ?>
<!--cArea-end-->
<!--lp_duibi start-->
<div class="clzt1" id="clzt1" title="点击展开" onclick="float_display('clzt1','none');float_display('clzt2','');">&nbsp;</div>
<div class="comparison" id="clzt2" style="display:none;position:absolute;z-index:200; right:0px;">
  <div class="comp_title font2">
  <span>
<a href="javascript:void(0)" onclick="float_display('clzt2','none');"><img src="<?php echo CSS_PATH;?>static/style/house/close.gif" /></a>
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
        window.attachEvent("onresize",function(){ scrolldiv(),scroll_bot()});
        window.attachEvent("onscroll",function(){ scrolldiv(),scroll_bot()});
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