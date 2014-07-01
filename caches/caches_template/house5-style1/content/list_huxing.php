<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php include template("content","head_house"); ?>
 <div class="hr10"></div>
<!-- 图库检索start -->
    <div class="PartAs">
      <div class="PartAsc fl">
        <div class="PartAsc1">
          <ul>
  	<a href="ybjlist.html"><li id="s1" class="SearchA">样板间库</li></a>
            <a href="xclist.html"><li id="s2" class="SearchA">楼盘图库</li></a>
            <a href="hxlist.html"><li id="s3" class="SearchB">户型图库</li></a>
          </ul>
        </div>

        <div class="PartAs_wrap">

<!--楼盘搜索-->
          <div  class="listimgbak"> 
  
  		<div id="get" class="get">



<div class="getLine">
<strong>选择区域：</strong> 
<?php
	$parentid = intval($_GET['r']);
	$page = intval($_GET['p']);
	$typeid = intval($_GET['typeid']);
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
		$regionsql = "and h.region='$parentid'";
	}
	if(!empty($typeid))
	{
		$typesql = "and p.typeid='$typeid'";
	}
?>
<?php if(!empty($parentid)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>hxlist<?php echo deal_str2($lst);?>-p1.html">不限</a>
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
<a href="<?php echo HOUSE_PATH;?>hxlist-r<?php echo $reg['0'];?><?php echo deal_str2($lst,'r');?>.html"><?php echo $reg['1'];?></a>
</div>					
</li>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>
</div>
</div>
  	
   </div>
   <!--楼盘搜索-->

          
   
  

        </div>

        <div class="PartAs_end"></div>
      </div>
    </div>
    <!-- 图库检索end -->

  <!-- 公用头部结束 -->
  <div class="hr10"></div>
<!-- 列表内容开始 -->
  <div class="cArea">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"get\" data=\"op=get&tag_md5=a724ce55f58e54f0b4d4b96355aa806d&sql=SELECT+h.title%2Ch.id%2Cp.id+as+pid%2Cp.typeid%2Cpd.pictureurls+from+h5_picture_data+pd+inner+join+h5_picture+p+inner+join+h5_house+h+on+p.id%3Dpd.id+and+p.catid%3D%24catid+%24typesql+%24regionsql+and+h.id%3Dpd.relation+order+by+h.id+desc&page=%24page&num=3&return=data&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}h5_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$pagesize = 3;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$r = $get_db->sql_query("SELECT COUNT(*) as count FROM  h5_picture_data pd inner join h5_picture p inner join h5_house h on p.id=pd.id and p.catid=$catid $typesql $regionsql and h.id=pd.relation order by h.id desc");$s = $get_db->fetch_next();$pages=pages($s['count'], $page, $pagesize, $urlrule);$r = $get_db->sql_query("SELECT h.title,h.id,p.id as pid,p.typeid,pd.pictureurls from h5_picture_data pd inner join h5_picture p inner join h5_house h on p.id=pd.id and p.catid=$catid $typesql $regionsql and h.id=pd.relation order by h.id desc LIMIT $offset,$pagesize");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
  <div class="qq_title qq_title02">
<div class="a1 linko">户型图</div><div class="a2" style="float:right">
共有
<span class="redb" id="num"></span>个符合条件的户型图片
</div>
  </div>
  <!-- 列表开始 -->
  <div class="listconimg">
  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
$count+=count(string2array($r['pictureurls']));?>
<?php $n=1; if(is_array(string2array($r['pictureurls']))) foreach(string2array($r['pictureurls']) AS $pic_k => $v) { ?>

  <div class="tpstyle tpstyle02">
<ul>
<li class="bk bk02 ">
<a title="<?php echo $r['title'];?><?php echo $v['alt'];?>" target="_blank" href="<?php echo HOUSE_PATH;?>hxlist-<?php echo $r['id'];?>-<?php echo $r['typeid'];?>-<?php echo $r['pid'];?>.html#<?php echo $n;?>"><img alt="<?php echo $r['title'];?><?php echo $v['alt'];?>" src="<?php echo thumb($v[url], 156, 156, 0);?>"></a>
</li>

<li class="imgstitle">
<a title="<?php echo $r['title'];?><?php echo $v['alt'];?>" target="_blank" href="<?php echo HOUSE_PATH;?>hxlist-<?php echo $r['id'];?>-<?php echo $r['typeid'];?>-<?php echo $r['pid'];?>.html"><b><?php echo str_cut($v[alt],20,'');?></b></a>
</li>
<li class="lpname">楼盘：<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo HOUSE_PATH;?><?php echo $r['id'];?>"><?php echo str_cut($r[title],20,'');?></a></li>
</ul>
  </div>
<?php $n++;}unset($n); ?>
<?php $n++;}unset($n); ?>
 <!-- listpages start -->
<h2>	
<div class="hr10"></div>
<div class="pga"><div class="pages cl"><div class="pg"><?php echo $pages;?></div></div></div>
<div class="hr10"></div>
</h2>
<!-- listpages end -->
<script>
var num = <?php echo $count;?>;
$('#num').html(num);
$('#num1').html(num);
</script>
  </div>
  <!-- 列表结束 -->
  <div class="display_com_end"></div>
  </div>
  	<!-- 列表内容开始 -->
  
    <div class="hr10"></div>
<div class="hr10"></div>



</div>
<!--cArea-end-->
<?php include template("content","footer"); ?>


</body>
</html><!--lpimg007-->