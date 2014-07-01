<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
<link href="<?php echo APP_PATH;?>statics/house5-style1/newhouse/css/listhouse.css" rel="stylesheet" type="text/css" />
<link href="<?php echo APP_PATH;?>statics/house5-style1/newhouse/css/house_styles.css" rel="stylesheet" type="text/css" />
<script language="Javascript" src="<?php echo APP_PATH;?>statics/house5-style1/js/house/house_default.js"></script>
<script language="Javascript" src="<?php echo APP_PATH;?>statics/house5-style1/js/house/house.js"></script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/newhouse/js/jquery.min.js" language="Javascript"></script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
<style type="text/css">
.partbd ul li{display:block; float:left; width:50px; line-height:22px;  height:22px; text-align:center; text-decoration:none;}
.partbd ul li a{display:inline-block;}
.partbd li a:link, .partbd li a:visited {display: inline-block; height: 17px;line-height: 17px;padding: 0 5px;text-decoration:none;}
.partbd li a:hover{background: none repeat scroll 0 0 #30c8f7;color:#ffffff;text-decoration:none;}
</style>
<script>
function MM_over(mmObj) {
var mSubObj = mmObj.getElementsByTagName("div")[0];
mSubObj.style.display = "block";
mSubObj.style.backgroundColor = "#fff";
}
function MM_out(mmObj) {
var mSubObj = mmObj.getElementsByTagName("div")[0];
mSubObj.style.display = "none";

}
</script>
</head>
<body>
<div id="main" class="xfindex">
		<div id="header">
	<?php include template("ssi","ssi_8"); ?>
	<h1><a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
	<img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="206" height="60"/></a></h1>
	<div id="Search">
		<ul class="searchURL">
			<li class="on"><a href="<?php echo HOUSE_PATH;?>"  target="_blank">新房</a></li>
			<li><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">二手房</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">出租房</a></li>
			<li class="more"><a href="javascript:void(0)">更多<em></em></a>
				<div>
					<a href="<?php echo catlink(6);?>" target="_blank">资讯</a>
					<a href="<?php echo catlink(7);?>"  target="_blank">图库</a>
					<a href="<?php echo catlink(10);?>"  target="_blank">视频</a>
					<a target="_blank" href="<?php echo BBS_PATH;?>">论坛</a>
				</div>
			</li>
		</ul>
		<a href="<?php echo APP_PATH;?>map/" target="_blank" class="mapS">地图找房</a>
		<div id="qy">
			<span>区域/地铁</span>
			<div>
				<a href="javascript:void(0)" data-val="">全部区县</a>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<div id="wy">
			<span>项目类型</span>
			<div>
				<a href="javascript:void(0)" data-val="">全部</a>
					<?php $type_arr = getbox_name('13','type')?>
				<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
											<a  href="javascript:void(0)" data-val="-t<?php echo $key;?>"><?php echo $v;?></a>
				<?php $n++;}unset($n); ?>
												</div>
		</div>
		<div id="jg">
			<span>价格范围</span>
			<div>
				<a href="javascript:void(0)" data-val="">全部</a>
				<?php $range_arr = getbox_name('13','range')?>
				<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
											<a  href="javascript:void(0)" data-val="-p<?php echo $key;?>"><?php echo $v;?></a>
				<?php $n++;}unset($n); ?>
												</div>
		</div>
		<input type="text" value="请输入关键字（楼盘名/地址）" data-val="请输入关键字（楼盘名/地址）">
		<button> </button>
	</div>
	<div id="indexMenu"> 
		<em class="r2"></em>
		<div id="newMenu">
	<a href="javascript:void(0)" class="fir">网站导航</a>
	<?php include template("ssi","ssi_12"); ?>
</div>
<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/hsearch.js"  type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	var $newMenu=$("#newMenu")
	$newMenu.hover(function(){
		$newMenu.addClass("on")
	},function(){
		$newMenu.removeClass("on")
	}).find("li").hover(function(){
		$(this).addClass("on")
	},function(){
		$(this).removeClass("on")
	})
})
</script>
<script type="text/javascript">
	seajs.use(["jquery","hsearch"],function($){
		$("#Search").hSearch("<?php echo HOUSE_PATH;?>list","<?php echo APP_PATH;?>api.php?op=house")//前面是搜索地址，后面是ajax查询新盘api
	})
</script>  
<ul class="menuL">
			<li class="s">
				<a href="<?php echo HOUSE_PATH;?>" target="_self" >首页<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>list.html" target="_self" >搜索楼盘<em></em></a>
            </li>
			<li >
				<a href="<?php echo APP_PATH;?>map" target="_blank" >地图找房<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>baojia.html" target="_self" >今日房价<em></em></a>
			</li>
			<li >
				<a href="<?php echo catlink(37);?>" target="_self">楼盘导购<em></em></a>
			</li>
			<li>
				<a href="<?php echo APP_PATH;?>special/" target="_blank">购房专题<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>hxlist.html" target="_self" >户型图<em></em></a>
			</li>
			<li  >
				<a href="<?php echo APP_PATH;?>tools/fdjsq.html" target="_self" >贷款计算器</a>
			</li>
		</ul>
	</div>
</div>