<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php include template("content","head_house"); ?>
<!--���� end -->
<div class="cArea">
<div class="qq_title qq_title02">
<div class="a1 linko">�ʷ�����</div>
</div>
<div class="listconsearch">
  <div class="get" id="get">
 <div  class="getLine"> 
<strong>����</strong> 
<?php
	$parentid = intval($_GET['r']);
	$page = intval($_GET['p']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	$where = "isreply=1";
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
		$where.=" and `region`=$parentid";
	}
	if(!empty($keyword))
	{
		$keyword1 = iconv('gbk', 'utf-8', $keyword);//rewrite ֻ֧��UTF-8���������
		$lst.= "-k".htmlentities(urlencode($keyword1));
		$where.=" and `housename` like '%$keyword%'";
	}
	if(!empty($k))
	{
		$keyword = iconv('utf-8','gbk' , $k);
		$lst.= "-k".htmlentities(urlencode($k));
		$where.=" and `housename` like '%$keyword%'";
	}
?>
<?php if(!empty($parentid)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>wenfang<?php echo deal_str2($lst);?>-p1.html">����</a>
</span>	
<ul>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8e3dfdbb4b4db89207e67734d1e6af96&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'8e3dfdbb4b4db89207e67734d1e6af96');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
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
<a href="<?php echo HOUSE_PATH;?>wenfang-r<?php echo $reg['0'];?><?php echo deal_str2($lst,'r');?>.html"><?php echo $reg['1'];?></a>
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
<ul><form method="get" name="search" action="<?php echo HOUSE_PATH;?>wenfang-<?php echo $rp;?>.php"  autocomplete="off"><li>¥������</li>				
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
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8a75a4546f4768a3a09348c9c86b235e&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=id+desc&page=%24page&moreinfo=1&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>'id desc','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>'id desc','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
    <div class="results">
	<div class="a1">����<span class="redb" id="num"></span>��
	<?php if(!empty($parentid)) { ?>
<?php $menu_info = menu_info('3360',$parentid)?>
<?php echo $menu_info['0'];?>
<?php } else { ?><?php } ?>����¥���ʷ�</div>		
</div>
<div class="listhouse_k">
  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
  <div class="wenhouse">
        <div class="wentp">
<a href="<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>" target="_blank">
<?php echo gethouse_thumb($r[xglp],$housecatid);?>
</a>
</div>
    <ul>
          <li>
   <span class="td_1"><a href="<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>" target="_blank"><?php echo $r['housename'];?></a></span>
   <span class="td_3">
                 <input name="submit8" type="submit" class="smb_btn8" value="" onclick="window.open('<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>/wenfang-p1.html', '_blank');" />
  </span>
  </li>
      <li><span class="td_4 linkg"><a href="<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>/wenfang-p1.html" target="_blank">�ʣ�<?php echo $r['question'];?></a></span></li>
      <li><span class="td_5"><a href="<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>/wenfang-p1.html" target="_blank">��<?php echo $r['content'];?></a></span></li>
      <li>
<span class="td_6">(<?php echo date('Y��m��d��',$r[inputtime]);?>)</span>
<span class="td_2 linkn">
<a href="<?php echo HOUSE_PATH;?><?php echo $r['xglp'];?>/wenfang-p1.html" target="_blank">&gt;&gt;�鿴<?php echo $r['housename'];?>ȫ���ʷ�</a>
</span>
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
<!--���������¼�Ϸ����λ-->
<!--���������¼�Ϸ����λ--> <!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
 <!--����¥���Ϸ����-->
 <!--����¥���Ϸ����-->
 <?php
$prowhere = implode(',',$recentlyHouse);
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f1f60c249aade4c5d387dec033f931ea&action=lists&catid=%24housecatid&where=%24sql&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$housecatid,'where'=>$sql,'limit'=>'10',));}?>
     <!--����¥�� begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">����������¥��</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">¥������</span>
<span class="td_3">����</span>
<span class="td_02">�۸�(Ԫ/�O)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="һ��һ��") { ?><?php echo $r['price'];?><?php } else { ?>һ��һ��<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--����¥�� end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
     <div class="hr10"></div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=b93a1c7e6b4b3321621af607db890d8a&action=lists&catid=%24housecatid&where=%60hot%60+like+%27%255%25%27&num=10&order=%24order&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$housecatid,'where'=>'`hot` like \'%5%\'','order'=>$order,)).'b93a1c7e6b4b3321621af607db890d8a');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$housecatid,'where'=>'`hot` like \'%5%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--����¥�� begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">����&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">����¥��</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">¥������</span>
<span class="td_3">����</span>
<span class="td_02">�۸�(Ԫ/�O)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="һ��һ��") { ?><?php echo $r['price'];?><?php } else { ?>һ��һ��<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--����¥�� end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
 <!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
 <!--��Ʒ¥���Ϸ����-->
 <!--��Ʒ¥���Ϸ����-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ec137bcfb9856b6489aeca2e46ce9d5d&action=lists&catid=%24housecatid&where=%60hot%60+like+%27%256%25%27&num=10&order=%24order&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$housecatid,'where'=>'`hot` like \'%6%\'','order'=>$order,)).'ec137bcfb9856b6489aeca2e46ce9d5d');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$housecatid,'where'=>'`hot` like \'%6%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--��Ʒ¥���Ƽ� begin-->
     <div class="rig_wrap">
       <div class="title_rig link5">
<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">����&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">��Ʒ¥���Ƽ�</a>
   </div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">¥������</span>
<span class="td_3">����</span>
<span class="td_02">�۸�(Ԫ/�O)</span>
</li>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="һ��һ��") { ?><?php echo $r['price'];?><?php } else { ?>һ��һ��<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
   
         </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--��Ʒ¥���Ƽ� end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
</div>
</div>
<div class="hr10"></div>
<div class="hr10"></div>
</div>
</div>
<!--cArea-end-->
<?php include template("content","footer"); ?>
<!--lp_duibi start-->
<div class="clzt1" id="clzt1" title="���չ��" onclick="float_display('clzt1','none');float_display('clzt2','');">&nbsp;</div>
<div class="comparison" id="clzt2" style="display:none;position:absolute;z-index:200; right:0px;">
  <div class="comp_title font2">
  <span>
<a href="javascript:void(0)" onclick="float_display('clzt2','none');"><img src="<?php echo CSS_PATH;?>static/style/house/close.gif" /></a>
  </span>
  ¥�̶Ա���
  </div>
  <div class="comp_lr"  id="withitem">
  <div class="cllist1" id="itemlist">
  <ul>
  <li><!--addinto--></li>	
  </ul>
  </div>
 <div class="a1">		
<label id="dui_remove"><input type="submit" value="���" class="smb_btn2" onclick="removeAllItem();" /></label>
<label id="dui_togo"><input type="submit" value="�Ա�" class="smb_btn4" onclick="toComparePage();" /></label>		
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
//��ת���Ա�ҳ��
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
alert('��Ǹ������ѡ��2�����ϵ�¥�̽��бȽϣ�');
return false;
}
window.open('<?php echo HOUSE_PATH;?>lp_duibi/'+cmpstr.join("_"));
        //why clear
        //CompCookie.clearCookie("wz_Houseapp_compare");
}else
    {
       // window.open('index.php');
   alert('��Ǹ������ѡ��2�����ϵ�¥�̽��бȽϣ�');
    }
    initCompareBar();
}
var g_comp_cookie = -1;
//��ʼ��ҳ��Ƭ
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
float_$("dui_remove").innerHTML = '<input type="submit" value="���" class="smb_btn2" onclick="removeAllItem();" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="�Ա�" class="smb_btn4" onclick="toComparePage();" />';	
var cookieArr = compCookie.split("|");
var itemStr = "";
itemStr+='<ul>';
for(var i=0;i<cookieArr.length;i++)
{
var serial_info = cookieArr[i].split(",");
itemStr+= '<li>';   		
itemStr+= '<span class="td_1" title="' + serial_info[0] + '">' + serial_info[0] + '</span>';
itemStr+= '<span class="td_2 linke"><a class="remove" href="javascript:removeCompareItem('+serial_info[1]+');">ɾ��</a></span></li>';
 }
itemStr+='</ul>';
float_$("itemlist").innerHTML = itemStr;
}else
{	
float_$("itemlist").innerHTML = "";
float_$("itemlist").innerHTML = '<font style="line-height:25px; color:#ccc; overflow:hidden;">����ѡ��¥�̼��뵽�Ա���<br />����ͬʱ�Ա�4��¥��</font>';
float_$("dui_remove").innerHTML = '<input type="submit" value="���" class="smb_btn2" disabled="disabled" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="�Ա�" class="smb_btn4" disabled="disabled" />';	
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
//cookie����
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
alert("����,Ϊ�˱�֤�ԱȲ鿴Ч�������ֻ��ѡ��4��¥�̲μӱȽ�");
return;
}
for(var i=0;i<comArr.length;i++)
{
if(comArr[i].split(",")[1] == id)
{
alert("�Բ������Ѿ����\""+comArr[i].split(",")[0]+"\"");
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
//ɾ���Ա���
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
//ɾ��������
function removeAllItem()
{
CompCookie.clearCookie("house_duibi");
initCompareBar();
}
//��С�߶ȣ�һ�������й�
var MIN_TOP = 220;
//��������Ŀ��
var CLZT_WIDTH1 = 29;
var CLZT_WIDTH2 = 224;
function scrolldiv()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
    var scr_top = document.documentElement.scrollTop || document.body.scrollTop;
    var client_h = document.documentElement.clientHeight||document.body.clientHeight;
    var top = scr_top + (client_h/2 - 95);
    //��ǰ�߶�
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
//�ײ�������
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
//�̶�λ��
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
//��Ӧ������
function mousewhell_cancel(tar) {clearInterval(tar);};
function mousewhell_go() {
    //setTimeout(scrolldiv,10);
var _detector = setInterval(scrolldiv,10);
setTimeout('mousewhell_cancel(' + _detector + ')',1000);
};
//��ʼ���������
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
    //��ʱ����cookie����
    setInterval(initCompareBar,2000);
}
//��ʼ���Ա�������
initCompareBar();
//��ʼ��λ��
init_comp_bar();
</script>
<!--lp_duibi end-->
<!-- ���ض��� -->
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