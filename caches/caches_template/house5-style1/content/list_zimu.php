<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php include template("content","head_house"); ?>
<!--���� end -->
<div class="cArea">
<div class="zm_title">
<h1 class="linko"><a href="<?php echo HOUSE_PATH;?>zimu.html">��ĸ����</a></h1>
<h2><font style="color: #999; font-weight: normal;">��¥��������ĸ����</font></h2>
    </div>
  <?php
  $keyword = trim($_GET['ename']);
  $where = "status=99";
  if(!empty($keyword))
	{
		$where.=" and `ename` like '$keyword%'";
	}?>
<div class="listconsearch">
  <div class="get1">
<div  class="getLine1">
<span <?php if($keyword=="") { ?> class="z_k" <?php } else { ?> class="z1_k"<?php } ?>><a href="<?php echo HOUSE_PATH;?>zimu.html">ȫ��</a></span>
<ul>
 <li><h1 <?php if($keyword=="a") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-a.html">A</a></h1>
  </li>
 <li><h1 <?php if($keyword=="b") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-b.html">B</a></h1>
  </li>
 <li><h1 <?php if($keyword=="c") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-c.html">C</a></h1>
  </li>
 <li><h1 <?php if($keyword=="d") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-d.html">D</a></h1>
 </li>
 <li><h1 <?php if($keyword=="e") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-e.html">E</a></h1>
 </li>
 <li><h1 <?php if($keyword=="f") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-f.html">F</a></h1>
 </li>
 <li><h1 <?php if($keyword=="g") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-g.html">G</a></h1>
 </li>
 <li><h1 <?php if($keyword=="h") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-h.html">H</a></h1>
 </li>
 <li><h1 <?php if($keyword=="i") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-i.html">I</a></h1>
 </li>
 <li><h1 <?php if($keyword=="j") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-j.html">J</a></h1>
 </li>
 <li><h1 <?php if($keyword=="k") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-k.html">K</a></h1>
 </li>
 <li><h1 <?php if($keyword=="l") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-l.html">L</a></h1>
 </li>
 <li><h1 <?php if($keyword=="m") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-m.html">M</a></h1>
 </li>
 <li><h1 <?php if($keyword=="n") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-n.html">N</a></h1>
 </li>
 <li><h1 <?php if($keyword=="o") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-o.html">O</a></h1>
 </li>
 <li><h1 <?php if($keyword=="p") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-p.html">P</a></h1>
 </li>
 <li><h1 <?php if($keyword=="q") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-q.html">Q</a></h1>
 </li>
 <li><h1 <?php if($keyword=="r") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-r.html">R</a></h1>
 </li>
 <li><h1 <?php if($keyword=="s") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-s.html">S</a></h1>
 </li>
 <li><h1 <?php if($keyword=="t") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-t.html">T</a></h1>
 </li>
 <li><h1 <?php if($keyword=="u") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-u.html">U</a></h1>
 </li>
 <li><h1 <?php if($keyword=="v") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-v.html">V</a></h1>
 </li>
 <li><h1 <?php if($keyword=="w") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-w.html">W</a></h1>
 </li>
 <li><h1 <?php if($keyword=="x") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-x.html">X</a></h1>
 </li>
 <li><h1 <?php if($keyword=="y") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-y.html">Y</a></h1>
 </li>
 <li><h1 <?php if($keyword=="z") { ?> class="a1 z_k" <?php } else { ?> class="z1_k"<?php } ?>>
<a href="<?php echo HOUSE_PATH;?>zimu-z.html">Z</a></h1>
</li>
</ul>
</div>
 </div>
</div>
<div class="display_com_end"></div>
<div class="hr10"></div>
</div>

<div class="cArea">
<div class="cen_box">
<div class="PartGs">
  <div class="cen_top"></div>
  <div class="content_list">
<?php if($keyword) { ?>
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=25e13702113196e7bb64a5cd64293164&action=lists&catid=%24catid&where=%24where&num=80&order=id+DESC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$where,'order'=>'id DESC',)).'25e13702113196e7bb64a5cd64293164');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'order'=>'id DESC','limit'=>'80',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
    <div class="results"><div class="a1">����<span class="redb" id="num"></span>��¥��������ĸ�� <b><?php echo strtoupper($keyword);?></b> ��¥��</div></div>
    <div class="zmhouse_k"><div class="zmhouse">
<ul>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<li><a href="<?php echo $r['url'];?>" target="_blank" alt="<?php echo $r['title'];?>¥��" title="<?php echo $r['title'];?>¥��"><?php echo $r['title'];?></a></li>
<?php $n++;}unset($n); ?>
</ul>
</div>	

</div>
    
    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
   <script>
var num = <?php echo count($data);?>;
$('#num').html(num);
</script> 
<?php } else { ?>
<div class="zmhouse_k">
<?php $a_z = range('a','z');?>
<?php $n=1;if(is_array($a_z)) foreach($a_z AS $v) { ?>
	<?php $where = "status=99";?>
	<?php $where.=" and `ename` like '$v%'";?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=d59b8d2dc493d3670b5af92f7beff0a6&action=lists&catid=%24catid&where=%24where&num=20&order=id+DESC&cache=864000\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$where,'order'=>'id DESC',)).'d59b8d2dc493d3670b5af92f7beff0a6');if(!$data = tpl_cache($tag_cache_name,864000)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'order'=>'id DESC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
<div class="zmhousetit">
<h1><a href="<?php echo HOUSE_PATH;?>zimu-<?php echo $v;?>.html" title="¥��������ĸ�� <?php echo strtoupper($v);?> ��¥��"><?php echo strtoupper($v);?></a></h1>
<h2><a href="<?php echo HOUSE_PATH;?>zimu-<?php echo $v;?>.html">����&gt;&gt;</a></h2>
</div>
<div class="zmhouse">
<ul>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<li><a href="<?php echo $r['url'];?>" target="_blank" alt="<?php echo $r['title'];?>¥��" title="<?php echo $r['title'];?>¥��"><?php echo $r['title'];?></a></li>
<?php $n++;}unset($n); ?>
</ul>
</div>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php $n++;}unset($n); ?>
</div>
	<?php } ?>
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
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=94502c9ae7b785fa535277fe2ee67783&action=lists&catid=%24catid&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$sql,)).'94502c9ae7b785fa535277fe2ee67783');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
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
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
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


<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=cd25e21e1000d20ac7109261e1011102&action=lists&catid=%24catid&where=%60hot%60+like+%27%255%25%27&num=10&order=%24order&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,)).'cd25e21e1000d20ac7109261e1011102');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
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
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
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



<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=809969496a71d4500ae1a6fa0960bc07&action=hits&catid=%24catid&num=10&order=views+DESC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'order'=>'views DESC',)).'809969496a71d4500ae1a6fa0960bc07');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--����¥�����а� begin-->
     <div class="rig_wrap">
       <div class="title_rig link5">
<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank">����&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank">����¥�����а�</a>
   </div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">¥������</span>
<span class="td_3">����</span>
<span class="td_02">���(��)</span>
</li>

        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php echo $r['views'];?></span>
</li>
<?php $n++;}unset($n); ?>
   
         </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--����¥�����а� end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>


<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8b9c34086b65337eff8f9a0eb6725910&action=lists&catid=%24catid&where=%60hot%60+like+%27%256%25%27&num=10&order=%24order&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,)).'8b9c34086b65337eff8f9a0eb6725910');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
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
<span class="td_1">��<a title="<?php echo $r['title'];?>" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
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