<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
	<link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/esf.css"  rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/default/js/esf/sea.js"  type="text/javascript"></script>
</head>
<body>
	<div id="main">
		<div id="header">
	<?php include template("ssi","ssi_8"); ?>
<script type="text/javascript">
seajs.use("topbarlogin")
</script>	<h1>
		<a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
			<img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a>
		</h1>
	<div id="Search">
		<ul class="searchURL">
			<li><a href="<?php echo catlink(6);?>"  target="_blank">资讯</a></li>			
			<li><a href="<?php echo HOUSE_PATH;?>"  target="_blank">新房</a></li>
			<li class="on"><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">二手房</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">出租房</a></li>
			<li><a href="<?php echo catlink(7);?>"  target="_blank">图库</a></li>
			<li><a href="<?php echo catlink(10);?>"  target="_blank">视频</a></li>
			<li class="more"><a href="javascript:void(0)">更多<em></em></a>
				<div>
					<a href="<?php echo BBS_PATH;?>"  target="_blank">论坛</a>
				</div>
			</li>
		</ul>
		<a href="map.html"  class="mapS" target="_blank">地图找房</a>
<?php
$param = $_GET['param'];
	if(!empty($param)&&stristr($param,'-')!=false)
	{
		$param_arr = explode('-', $param);
		foreach($param_arr as $_v) {
				if($_v) 
				{
					if(preg_match ( '/([a-z])([0-9_]+)/', $_v, $matchs))
					{
						$$matchs[1] = trim($matchs[2]);
					}
				}
			}
		$parentid = $r;
		$bid = $b;
		$eprice = $e;
		$marea = $m;
		$range = $p;
		$type = $t;
		$fix = $f;
		$year = $y;
		$source = $u;
		$floor = $l;
		$opentime = $o;
		$hot = $h;
		$ord = $n;
		$area = $c;
		$page = $g;
	}
	else
	{
 	$parentid = intval($_GET['r']);
	$bid = intval($_GET['b']);
	$eprice = trim($_GET['e']);
	$marea = trim($_GET['m']);
	$range = intval($_GET['p']);
	$type = intval($_GET['t']);
	$fix = intval($_GET['f']);
	$year = intval($_GET['y']);
	$floor = intval($_GET['l']);
	$source = intval($_GET['u']);
	$opentime = intval($_GET['o']);
	$hot = intval($_GET['h']);
	$ord = intval($_GET['n']);
	$area = intval($_GET['c']);
	$page = intval($_GET['g']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	}
	
	$where = "status=99 and house_status=1";
	if(!empty($keyword))
	{
		$keyword1 = iconv('gbk', 'utf-8', $keyword);//rewrite 只支持UTF-8编码的中文
		$lst1.= "-k".htmlentities(urlencode($keyword1));
		$where.=" and (`title` like '%$keyword%' or `address` like '%$keyword%' )";
	}
	if(!empty($k))
	{
		$keyword = iconv('utf-8','gbk' , $k);
		$lst1.= "-k".htmlentities(urlencode($k));
		$where.=" and (`communityname` like '%$keyword%')";
		$lstaddr.= "<em>".$keyword."<a href=\"list.html\"></a></em>";
	}
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
	}
	if(!empty($bid))
	{
		$lst.= "-b".$bid;
	}
	if(!empty($parentid) && !empty($bid))
	{
		$where.=" and `region`=$bid";
	}
	elseif(!empty($parentid) && empty($bid))//区域顶级
	{
		$arrchildid = get_arrchildid('3360',$parentid);
		$where.=" and `region` in ($arrchildid)";
	}
	if(!empty($eprice))
	{
		if(stripos($eprice,'_')!==false)
		{
			$pricearr = explode('_',$eprice);
			$minprice = intval($pricearr[0]);
			$maxprice = intval($pricearr[1]);
			if($maxprice>0)
			{
				$lst.= "-e".$eprice;
				$where.=" and `price`>$minprice and `price`<=$maxprice";
				if($minprice==0)
				{
					$range_name = $maxprice."万以下";
				}
				else
				{
					$range_name = $minprice."-".$maxprice."万";
				}
			}
		}
		else
		{
			$minprice = $eprice;
			$lst.= "-e".$eprice;
			$where.=" and `price`>$eprice";
			$range_name = $eprice."万以上";
		}
		
	}
	if(!empty($range))
	{
		$lst.= "-p".$range;
		$where.=" and `range`=$range";
		if($range==1)
		{
			$range_name="50万以下";
		}
		elseif($range==2)
		{
			$range_name="50-80万";
		}
		elseif($range==3)
		{
			$range_name="80-100万";
		}
		elseif($range==4)
		{
			$range_name="100-150万";
		}
		elseif($range==5)
		{
			$range_name="150-200万";
		}
		elseif($range==6)
		{
			$range_name="200-250万";
		}
		elseif($range==7)
		{
			$range_name="250-300万";
		}
		elseif($range==8)
		{
			$range_name="300-400万";
		}
	}
	if(!empty($type))
	{
		$lst.= "-t".$type;
		$where.=" and `huxingshi`=$type";
		if($type==1)
		{
			$type_name="一室";
		}
		elseif($type==2)
		{
			$type_name="二室";
		}
		elseif($type==3)
		{
			$type_name="三室";
		}
		elseif($type==4)
		{
			$type_name="四室";
		}
		else
		{
			$type_name="其他";
		}
	}
	if(!empty($fix))
	{
		$lst.= "-f".$fix;
		$where.=" and `fix`=$fix";
		if($fix==1)
		{
			$fix_name = "毛坯";
		}
		elseif($fix==2)
		{
			$fix_name = "精装";
		}
		elseif($fix==3)
		{
			$fix_name = "中等装修";
		}
		elseif($fix==4)
		{
			$fix_name = "简装";
		}
		elseif($fix==5)
		{
			$fix_name = "豪华装修";
		}
		elseif($fix==6)
		{
			$fix_name = "原房";
		}
	}
	if(!empty($year))
	{
		$lst.= "-y".$year;
		if($year==1)
		{
			$where.=" and `house_age`<='2000'";
			$year_name = "2000年以前";
		}
		elseif($year==2)
		{
			$where.=" and `house_age`>'2000' and `house_age`<='2005'";
			$year_name = "20000年以后";
		}
		elseif($year==3)
		{
			$where.=" and `house_age`>'2005' and `house_age`<='2010'";
			$year_name = "2005年以后";
		}
		elseif($year==4)
		{
			$where.=" and `house_age`>'2010'";
			$year_name = "2010年以后";
		}
	}
	if(!empty($floor))
	{
		$lst.= "-l".$floor;
		if($floor==1)
		{
			$where.=" and `floor`<='6'";
			$floor_name = "6层以下";
		}
		elseif($floor==2)
		{
			$where.=" and `floor`>'6' and `floor`<='12'";
			$floor_name = "6-12层";
		}
		elseif($floor==3)
		{
			$where.=" and `floor`>'12' and `floor`<='20'";
			$floor_name = "12-20层";
		}
		elseif($floor==4)
		{
			$where.=" and `floor`>'20'";
			$floor_name = "20层以上";
		}
	}
	if(!empty($source))
	{
		$lst.= "-u".$source;
		if($source==1)
		{
			$source_name = "个人";
			$where.=" and isbroker=0";
		}
		elseif($source==2)
		{
			$source_name = "中介";
			$where.=" and isbroker=1";
		}
	}
	if(!empty($marea))
	{
		if(stripos($marea,'_')!==false)
		{
			$areaarr = explode('_',$marea);
			$minarea = intval($areaarr[0]);
			$maxarea = intval($areaarr[1]);
			if($maxarea>0)
			{
				$lst.= "-m".$marea;
				$where.=" and `total_area`>$minarea and `total_area`<=$maxarea";
				if($minarea==0)
				{
					$area_name = $maxarea."平米以下";
				}
				else
				{
					$area_name = $minarea."-".$maxarea."平米";
				}
			}
		}
		else
		{
			$minarea = $marea;
			$lst.= "-m".$marea;
			$where.=" and `total_area`>$marea";
			$area_name = $marea."平米以上";
		}
	}
	if(!empty($area))
	{
		$lst.= "-c".$area;
		$where.=" and `area_range`=$area";
		if($area==1)
		{
			$area_name="70平米以下";
		}
		elseif($area==3)
		{
			$area_name="70-90平米";
		}
		elseif($area==4)
		{
			$area_name="90-120平米";
		}
		elseif($area==5)
		{
			$area_name="120-150平米";
		}
		elseif($area==6)
		{
			$area_name="150-200平米";
		}
		elseif($area==7)
		{
			$area_name="200-300平米";
		}
		elseif($area==8)
		{
			$area_name="300平米以上";
		}
	}
	if(!empty($opentime))
	{
		$lst.= "-o".$opentime;
		if($opentime=='2')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//3天内
			$opentime_name= "3天内";
		}
		elseif($opentime=='3')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 7 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//7天内
			$opentime_name= "7天内";
		}
		elseif($opentime=='4')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 15 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//15天内
			$opentime_name= "15天内";
		}
		elseif($opentime=='5')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 30 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//30天内
			$opentime_name= "30天内";
		}
	}
	if(!empty($hot))
	{
			$where.=" and `flag` like '%$hot%'";
			$lst.= "-h".$hot;
	}
	if(!empty($ord))
	{
		if($ord=='2')
		{
			$order="  CAST(`total_area` AS SIGNED) DESC";
			$order_name = "面积从大到小";
		}
		elseif($ord=='3')
		{
			$order=" CAST(`total_area` AS SIGNED) ASC";
			$order_name = "面积从小到大";
		}
		elseif($ord=='4')
		{
			$order=" `mprice` DESC";
			$order_name = "单价从高到低";
		}
		elseif($ord=='5')
		{
			$order=" `mprice` ASC";
			$order_name = "单价从低到高";
		}
		elseif($ord=='6')
		{
			$order=" CAST(price AS SIGNED) DESC";
			$order_name = "总价从高到低";
		}
		elseif($ord=='7')
		{
			$order=" CAST(price AS SIGNED) ASC";
			$order_name = "总价从低到高";
		}
		else
		{
			$order=" `listorder` desc,`updatetime` DESC";
			$order_name = "默认排序";
		}
		$lst.= "-n".$ord;
	}
	else
	{
		$order = "`listorder` desc,`updatetime` DESC";
		$order_name = "默认排序";
	}
	?>
		<div id="qy">
			<?php if(!empty($parentid)) { ?>
			<?php $menu_info = menu_info('3360',$parentid)?>
			<span><?php echo $menu_info['0'];?></span>
			<?php } else { ?>
			<span>区域/地铁</span>
			<?php } ?>
			<div>
				<a data-val="" href="javascript:void(0)">全部区县</a>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
												</div>
		</div>
		<div data-k = "平" id="wy" data-val="<?php if(!empty($marea)) { ?>-m<?php echo $marea;?><?php } ?>">
			<span><?php if(!empty($area_name)) { ?><?php echo $area_name;?><?php } else { ?>面积<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
											<a <?php if($area=="1") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c1">70平米以下</a>
											<a <?php if($area=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c3">70-90平米</a>
											<a <?php if($area=="4") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c4">90-120平米</a>
											<a <?php if($area=="5") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c5">120-150平米</a>
											<a <?php if($area=="6") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c6">150-200平米</a>
											<a <?php if($area=="7") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c7">200-300平米</a>
											<a <?php if($area=="8") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c8">300平米以上</a>
												</div>
		</div>
		<div data-k = "万" id="jg" data-val="<?php if(!empty($eprice)) { ?>-e<?php echo $eprice;?><?php } ?>">
			<span><?php if(!empty($range_name)) { ?><?php echo $range_name;?><?php } else { ?>价格范围<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
											<a <?php if($range=="1") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p1">50万以下</a>
											<a <?php if($range=="2") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p2">50-80万</a>
											<a <?php if($range=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p3">80100万</a>
											<a <?php if($range=="4") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p4">100-150万</a>
											<a <?php if($range=="5") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p5">150-200万</a>
											<a <?php if($range=="6") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p6">200-250万</a>
											<a <?php if($range=="7") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p7">250-300万</a>
											<a <?php if($range=="8") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p8">300-400万</a>
												</div>
		</div>
		<div id="shx">
			<span><?php if(!empty($type_name)) { ?><?php echo $type_name;?><?php } else { ?>户型<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
											<a <?php if($type=="1") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t1">一室</a>
											<a <?php if($type=="2") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t2">二室</a>
											<a <?php if($type=="3") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t3">三室</a>
											<a <?php if($type=="4") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t4">四室</a>
											<a <?php if($type=="5") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t5">其它</a>
												</div>
		</div>
		<input type="text" data-val="<?php if(empty($k)) { ?>请输入关键字（楼盘名或地名）<?php } else { ?><?php echo $keyword;?><?php } ?>" value="<?php if(empty($k)) { ?>请输入关键字（楼盘名或地名）<?php } else { ?><?php echo $keyword;?><?php } ?>">
		<button> </button>
	</div>
	<div id="indexMenu"> 
		<em class="r2"></em>
		<div id="newMenu">
	<a href="javascript:void(0)" class="fir">网站导航</a>
	<?php include template("ssi","ssi_12"); ?>
</div>
<script type="text/javascript">
seajs.use("jquery",function($){
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
</script>		<ul class="menuL">
			<li >
				<a href="<?php echo ESF_PATH;?>" >首页<em></em></a>
			</li>
			<li class="s">
				<a href="<?php echo ESF_PATH;?>list.html" >出售房源<em></em></a>
			<li >
				<a href="<?php echo ESF_PATH;?>rent-list.html" >出租房源<em></em></a>
			</li>
			<li>
				<a href="<?php echo ESF_PATH;?>map.html"  target="_blank">地图找房<em></em></a>
			</li>
			<li >
				<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" >小区找房<em></em></a>
			</li>
			<li >
				<a href="<?php echo ESF_PATH;?>jingjiren" >经纪人<em></em></a>
			</li>
			<li>
				<a href="<?php echo catlink(6);?>"  target="_blank">资讯<em></em></a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","hsearch"],function($){
		$("#Search").hSearch("list","<?php echo APP_PATH;?>api.php?op=esfsuggest");
		$("#jg,#wy").each(function(){
			var $t=$(this);
			var t=$t.attr("data-val");
			if(t){
				$t.data("val",$t.attr("data-val"));
				var k=$t.attr("data-k");
				t=t.substring(2).split("_");
				if(t[0]==0)
					$t.find("span").html(t[1]+k+"以下");
				else if(t.length==1)
					$t.find("span").html(t[0]+k+"以上");
				else
					$t.find("span").html(t.join("-")+k);
			}
		});
	})
</script>		<div class="bread">
			您当前的位置：<a href="<?php echo APP_PATH;?>" ><?php echo $site_title;?></a> &gt;
			<a href="<?php echo APP_PATH;?>esf" ><?php echo $default_city;?>二手房网</a> &gt;
			房源列表
		</div>
		<div class="modB">
	<a href="<?php echo ESF_PATH;?>chushou.html"  target="_blank" class="fbfr">个人免费发布房源</a>
	<ul class="modTab">
	<li class="on"><a href="<?php echo ESF_PATH;?>list.html" >全部房源</a></li>
	<li><a href="<?php echo ESF_PATH;?>map.html"  target="_blank">地图找房</a></li>
	<li><a href="<?php echo ESF_PATH;?>xiaoqu-list.html"  target="_blank">小区找房</a></li>
	<li></li>
</ul>
<div class="conl1" id="conl1">
	<div class="cf" style="padding-top:9px;">
			<span class="a_name">区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'r');?>.html" <?php if(empty($parentid)) { ?>  class="c" <?php } ?>>不限</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	if(!empty($parentid) && $parentid==$reg[0] && empty($bid))
	{
		$lstaddr.= "<em>".$reg[1]."<a href=\"list".deal_str($lst,'r').".html\"></a></em>";
	}
	?>
	<a href="list-r<?php echo $reg['0'];?><?php echo deal_str($lst,'r');?>.html" <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="c"<?php } ?>><?php echo $reg['1'];?></a>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	                			  				</span>
<?php if($parentid) { ?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e3d28ce1f67a9f7addc16249214e52e5&action=getlinkage&keyid=3360&parentid=%24parentid&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC',)).'e3d28ce1f67a9f7addc16249214e52e5');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
												<!--以下是板块信息，点击区域后才出现的-->
												<span class="i">
				<a href="list<?php echo deal_str($lst,'b');?>.html" <?php if(empty($bid)) { ?> class="c"<?php } ?>>不限</a>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php
				$reg2 = explode('$$', $r);//add by L 2012/3/22
				if(!empty($bid) && $bid==$reg2[0])
				{
					$lstaddr.= "<em>".$reg2[1]."<a href=\"list".deal_str($lst,'r').".html\"></a></em>";
				}
				?>
				               		<a href="list<?php echo deal_str($lst,'b');?>-b<?php echo $reg2['0'];?>.html" <?php if(!empty($bid) && $bid==$reg2[0]) { ?> class="c"<?php } ?>><?php echo $reg2['1'];?></a>
									<?php $n++;}unset($n); ?>
               				</span>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
					</div>
		<div class="cf">
			<span class="a_name">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span>
			<span>
				<a <?php if(empty($range)) { ?> class="c"<?php } ?> href="list<?php echo deal_str($lst,'p');?>.html" >不限</a>
				<a href="list<?php echo deal_str($lst,'p');?>-p1.html" <?php if($range=="1") { ?> class="c"<?php } ?>>50万以下</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p2.html" <?php if($range=="2") { ?> class="c"<?php } ?>>50-80万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p3.html" <?php if($range=="3") { ?> class="c"<?php } ?>>80-100万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p4.html" <?php if($range=="4") { ?> class="c"<?php } ?>>100-150万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p5.html" <?php if($range=="5") { ?> class="c"<?php } ?>>150-200万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p6.html" <?php if($range=="6") { ?> class="c"<?php } ?>>200-250万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p7.html" <?php if($range=="7") { ?> class="c"<?php } ?>>250-300万</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p8.html" <?php if($range=="8") { ?> class="c"<?php } ?>>300-400万</a> 
				<?php
			if(!empty($range_name))
				{
					$lstaddr.= "<em>".$range_name."<a href=\"list".deal_str($lst,'p').".html\"></a></em>";
				}
			?>
              										<div class="autoF">
					<form action="list<?php echo deal_str($lst,'p');?>-e" method="get">
						<input type="text" value="<?php echo $minprice;?>"> - 
						<input type="text" value="<?php echo $maxprice;?>"> 万
						<button type="button"></button>
					</form>
				</div>
			</span>
		</div>
		<div class="cf">
			<span class="a_name">面&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;积：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'c');?>.html" <?php if(empty($area)) { ?> class="c"<?php } ?>  >不限</a>
							   	               	<a href="list<?php echo deal_str($lst,'c');?>-c1.html" <?php if($area=="1") { ?> class="c"<?php } ?>>70平米以下</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c3.html" <?php if($area=="3") { ?> class="c"<?php } ?>>70-90平米</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c4.html" <?php if($area=="4") { ?> class="c"<?php } ?>>90-120平米</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c5.html" <?php if($area=="5") { ?> class="c"<?php } ?>>120-150平米</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c6.html" <?php if($area=="6") { ?> class="c"<?php } ?>>150-200平米</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c7.html" <?php if($area=="7") { ?> class="c"<?php } ?>>200-300平米</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c8.html" <?php if($area=="8") { ?> class="c"<?php } ?>>300平米以上</a> 
					<?php
			if(!empty($area_name))
				{
					$lstaddr.= "<em>".$area_name."<a href=\"list".deal_str($lst,'c').".html\"></a></em>";
				}
			?>
               				   				   	<div class="autoF">
					<form action="list<?php echo deal_str($lst,'c');?>-m" method="get">
						<input type="text" value="<?php echo $minarea;?>"> - 
						<input type="text" value="<?php echo $maxarea;?>"> 平
						<button type="button"></button>
					</form>
				</div>
			</span>
		</div>
		<div class="cf">
			<span class="a_name">户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'t');?>.html"  <?php if(empty($type)) { ?> class="c" <?php } ?>>不限</a>
							   	    <a href="list<?php echo deal_str($lst,'t');?>-t1.html" <?php if($type=="1") { ?> class="c" <?php } ?>>一室</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t2.html" <?php if($type=="2") { ?> class="c" <?php } ?>>二室</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t3.html" <?php if($type=="3") { ?> class="c" <?php } ?>>三室</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t4.html" <?php if($type=="4") { ?> class="c" <?php } ?>>四室</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t5.html" <?php if($type=="5") { ?> class="c" <?php } ?>>其它</a> 
               				   				</span>
					<?php
			if(!empty($type))
				{
					$lstaddr.= "<em>".$type_name."<a href=\"list".deal_str($lst,'t').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">来&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;源：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'u');?>.html" <?php if(empty($source)) { ?> class="c" <?php } ?>>不限</a> 
				<a href="list<?php echo deal_str($lst,'u');?>-u2.html" <?php if($source=="2") { ?> class="c" <?php } ?>>中介</a> 
				<a href="list<?php echo deal_str($lst,'u');?>-u1.html" <?php if($source=="1") { ?> class="c" <?php } ?>>个人</a> 
			</span>
				<?php
			if(!empty($source))
				{
					$lstaddr.= "<em>".$source_name."<a href=\"list".deal_str($lst,'u').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">装&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'f');?>.html" <?php if(empty($fix)) { ?> class="c" <?php } ?>>不限</a>
							   		<a href="list<?php echo deal_str($lst,'f');?>-f1.html" <?php if($fix=="1") { ?> class="c" <?php } ?>>毛坯</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f2.html" <?php if($fix=="2") { ?> class="c" <?php } ?>>精装</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f3.html" <?php if($fix=="3") { ?> class="c" <?php } ?>>中等装修</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f4.html" <?php if($fix=="4") { ?> class="c" <?php } ?>>简装</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f5.html" <?php if($fix=="5") { ?> class="c" <?php } ?>>豪华装修</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f6.html" <?php if($fix=="6") { ?> class="c" <?php } ?>>原房</a> 
               				   				</span>
			<?php
			if(!empty($fix))
				{
					$lstaddr.= "<em>".$fix_name."<a href=\"list".deal_str($lst,'f').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">楼&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;层：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'l');?>.html" <?php if(empty($floor)) { ?> class="c" <?php } ?>>不限</a>
				                                	<a href="list<?php echo deal_str($lst,'l');?>-l1.html" <?php if($floor=="1") { ?> class="c" <?php } ?>>6层以下</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l2.html" <?php if($floor=="2") { ?> class="c" <?php } ?>>6-12层</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l3.html" <?php if($floor=="3") { ?> class="c" <?php } ?>>12-20层</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l4.html" <?php if($floor=="4") { ?> class="c" <?php } ?>>20层以上</a>
                                			</span>
			<?php
			if(!empty($floor))
				{
					$lstaddr.= "<em>".$floor_name."<a href=\"list".deal_str($lst,'l').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">房&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;龄：</span>
			<span>
				<a href="list<?php echo deal_str($lst,'y');?>.html" <?php if(empty($year)) { ?> class="c" <?php } ?>>不限</a>
				                                <a href="list<?php echo deal_str($lst,'y');?>-y1.html" <?php if($year=="1") { ?> class="c" <?php } ?>>2000年以前</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y2.html" <?php if($year=="2") { ?> class="c" <?php } ?>>2000年以后</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y3.html" <?php if($year=="3") { ?> class="c" <?php } ?>>2005年以后</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y4.html" <?php if($year=="4") { ?> class="c" <?php } ?>>2010年以后</a>
                			</span>
					<?php
			if(!empty($year))
				{
					$lstaddr.= "<em>".$year_name."<a href=\"list".deal_str($lst,'y').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">发布时间：</span>
			<span>
					<a href="list<?php echo deal_str($lst,'o');?>.html"  <?php if(empty($opentime)) { ?> class="c" <?php } ?>>不限</a> 
					<a href="list<?php echo deal_str($lst,'o');?>-o2.html" <?php if($opentime=="2") { ?> class="c" <?php } ?> >3天内发布</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o3.html" <?php if($opentime=="3") { ?>  class="c" <?php } ?>>7天内发布</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o4.html" <?php if($opentime=="4") { ?>  class="c" <?php } ?>>15天内发布</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o5.html" <?php if($opentime=="5") { ?>  class="c" <?php } ?>>30天内发布</a>
					</span>
			<?php
			if(!empty($opentime))
				{
					$lstaddr.= "<em>".$opentime_name."<a href=\"list".deal_str($lst,'o').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf b">
			<span class="a_name">您已选择：</span>
			<span> <?php if(empty($lstaddr)) { ?>
								<em>无<a href="javascript:void(0)"></a></em>
					<?php } else { ?><?php echo $lstaddr;?>
				<a href="list.html"  class="cle">清空搜索条件</a>
				<?php } ?>
			</span>
		</div>
	</div>
</div>		<div class="cf">
			<div class="w720 fl">
				<div class="Tle cf">
					<div class="fl">
						<a <?php if(empty($hot)) { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list.html" >全部房源</a>
	                	<a <?php if($hot=="1") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h1.html" >新推房源</a>
	                	<a <?php if($hot=="3") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h3.html" >急售房源</a>
	                	<a <?php if($hot=="2") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h2.html" >推荐房源</a>
						<a <?php if($hot=="4") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h4.html" >多图房源</a>
	                	<a <?php if($source=="1") { ?> class="D"<?php } else { ?> class="C"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-u1.html" >个人</a>
					</div>
					<div class="tel_page fr">
						<span>
							共找到 <strong class="red" id="num"></strong>条房源
						</span>
						<a class="pre" href="list<?php echo deal_str($lst,'g');?>-g1.html" ></a>
						<span class="num">1</span>
						<a class="next" href="list<?php echo deal_str($lst,'g');?>-g2.html" >下一页</a>
					</div>
				</div>
				<div class="Tle2">
					<form action="<?php echo ESF_PATH;?>list-search" method="post">
						<input id="hname" type="text" name="keyword" data-val="<?php if(empty($k)) { ?>小区/地址/标题<?php } else { ?><?php echo $keyword;?><?php } ?>" value="<?php if(empty($k)) { ?>小区/地址/标题<?php } else { ?><?php echo $keyword;?><?php } ?>" class="txt" autocomplete="off">
						<input id="kwsearch" type="submit" name="" class="btn" value="">
					</form>
					<div class="TelIcon fr">
						<a href="<?php if($ord==2) { ?>list<?php echo deal_str($lst,'n');?>-n3.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n2.html<?php } ?>"  class="A1 <?php if($ord==2) { ?>down<?php } ?><?php if($ord==3) { ?>up<?php } ?>">面积</a>
						<a href="<?php if($ord==4) { ?>list<?php echo deal_str($lst,'n');?>-n5.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n4.html<?php } ?>"  class="A1 <?php if($ord==4) { ?>down<?php } ?><?php if($ord==5) { ?>up<?php } ?>">单价</a>
						<a href="<?php if($ord==6) { ?>list<?php echo deal_str($lst,'n');?>-n7.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n6.html<?php } ?>"  class="A1 <?php if($ord==6) { ?>down<?php } ?><?php if($ord==7) { ?>up<?php } ?>">总价</a>
						<a id="B1" class="B1" href="javascript:void(0)"></a>
						<a id="B2" class="B2h" href="javascript:void(0)"></a>
						<a id="B3" class="B3" href="javascript:void(0)"></a>
					</div>
					<div class="s_list fr" id="s_list1">
						<span><?php echo $order_name;?></span>
						<ul>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n2.html" >面积从大到小</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n3.html" >面积从小到大</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n4.html" >单价从高到低</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n5.html" >单价从低到高</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n6.html" >总价从高到低</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n7.html" >总价从低到高</a>
							</li>
						</ul>
					</div>
				</div>
								<!--list-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=23f679dea3b13baa52bd938cc747055c&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=%24order&page=%24page&moreinfo=1&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?><!-- 楼盘列表 -->
	<table id="FyList" class="FyList">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<?php $relationxq = get_relationxq($r[id],$catid,110)?>
	<?php $menu_info = menu_info('3360',$r[region])?>
	<?php $pic_num = count(string2array($r[house_pic]))+count(string2array($r[house_room]))+count(string2array($r[house_outdoor]))?>
			<tr>
			<td class="pic">
				<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank">
					<img data-src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb],130,90);?><?php } else { ?><?php echo APP_PATH;?>statics/default/img/esf/nopic_100x75.gif<?php } ?>"  alt="<?php echo $r['title'];?>">
				<?php if($pic_num) { ?><span class="picnumber"><?php echo $pic_num;?>图</span><?php } ?>
									</a>
			</td>
			<td class="info">
				<h5>
					<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
					<?php if($r[listorder]>0) { ?>
					<img src="<?php echo APP_PATH;?>statics/default/img/esf/icon-ding.gif" alt="置顶楼盘" title="置顶楼盘" style="vertical-align:middle" />
					<?php } ?>
					<?php $flag = explode(',', $r[flag]);
						foreach ($flag as $t => $c) {
					if(intval($c))
					{
						if($c=='5')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/icon-more-28x16.gif" alt="多图楼盘" title="多图楼盘" style="vertical-align:middle" />';		
						}
						if($c=='3')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent2.gif" alt="推荐楼盘" title="推荐楼盘" style="vertical-align:middle" />';		
						}
						if($c=='2')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent3.gif" alt="急售楼盘" title="急售楼盘" style="vertical-align:middle" />';		
						}
						if($c=='1')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent1.gif" alt="新推楼盘" title="新推楼盘" style="vertical-align:middle" />';		
						}
					}
				}?>							</h5>
				<p>
					<a href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $relationxq['id'];?>.html"  target="_blank" title="<?php echo $relationxq['title'];?>"><?php echo $relationxq['title'];?></a> <?php echo $menu_info['0'];?> <?php echo $relationxq['address'];?><br>
					户型：<?php echo $r['huxingshi'];?>室<?php echo $r['huxingting'];?>厅					楼层：<?php echo $r['floor'];?>/<?php echo $r['zonglouceng'];?>					单价：
					<?php echo $r['mprice'];?>元					房龄：<?php echo $r['house_age'];?>年					<br>
					<?php if($r[isbroker]) { ?><A href="<?php echo ESF_PATH;?>jingjiren-<?php echo $r['uid'];?>" target="_blank"><?php echo $r['username'];?></A><?php } else { ?><?php echo $r['username'];?><?php if(!$r[isbroker]) { ?>(个人)<?php } ?><?php } ?>					  
					<?php echo format::sgmdate('Y-m-d H:i:s',$r[updatetime],1);?> 更新
				</p>
			</td>
			<td class="area"><?php echo $r['total_area'];?>平米</td>
			<td class="price">
				<strong><?php echo $r['price'];?>万元</strong>
			</td>
			<td class=""> </td>	
		</tr>
	<?php $n++;}unset($n); ?>
		</table>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	<div class="pagination" >
		<?php echo $housepages;?></div>
							</div>
			<div class="w230 fr">
				<div class="modC">
	<h4 class="modBT"><sub></sub>
		我的浏览记录
	</h4>
	<?php
 if(isset($recentlyEsf))
 {
	$prowhere = implode(',',$recentlyEsf);
}
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=94502c9ae7b785fa535277fe2ee67783&action=lists&catid=%24catid&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$sql,)).'94502c9ae7b785fa535277fe2ee67783');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	<ul class="t3List">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $relationxq = get_relationxq($r[id],$catid,110)?>
				<li>
			<span class="lettsub7"><a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html" title="<?php echo $r['title'];?>" target="_blank"><?php echo $relationxq['title'];?></a></span>
			<span class="w2"><?php echo $r['total_area'];?>㎡</span>
			<span class="w3"><?php echo $r['price'];?>万元</span>
		</li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	<?php } ?>
	</div>				<div class="modC">
	<h4 class="modBT"><sub></sub>
		经纪人排行
	</h4>
	 
	<ul class="jjrl">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=0eaea06bd802853761909dfe5aa29a3d&action=memberlist&type=1&order=point+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'5',));}?>
	<?php $n=1; if(is_array($data['result'])) foreach($data['result'] AS $k => $v) { ?> 
				<li>
			<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>"  class="jAvatar" target="_blank">
				<img src="<?php echo $v['avatar'];?>" >
			</a>
			<p>
				<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" ><?php echo $v['truename'];?></a>
				<img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>"  border="0" align="absmiddle" title="等级：<?php echo $v['groupname'];?> 积分：<?php echo $v['point'];?>" /><br><?php $district_info = menu_info('4000',$v[district])?>
					区域：<?php echo $district_info['0'];?><br>电话：<?php echo $v['tel'];?>			</p>
		</li>
		<?php $n++;}unset($n); ?>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	</div>                <div class="mt10"></div>
<!--r二手房广告 二手房列表页-画中画1-->
			</div>	
		</div>
        
		<!--热点搜索-->
<div class="hota">
	<!--相关信息-->
	<div class="hot cf">
		<span class="hot_fenlei"><?php echo $default_city;?>二手房相关信息:</span>
		<p class="hot_link">
			<a target="_blank" href="map.html" ><?php echo $default_city;?>地图找房</a>   
			<a target="_blank" href="xiaoqu-list.html" ><?php echo $default_city;?>二手房房价</a>   
			<a target="_blank" href="rent-list.html" ><?php echo $default_city;?>出租房</a>   
		</p>
	</div>
	<!--热门区域-->
	<div class="hot cf">
		<span class="hot_fenlei"><?php echo $default_city;?>热门区域二手房:</span>
				<p class="hot_link">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>			
						<a href="list-r<?php echo $reg['0'];?>.html"  target="_blank"><?php echo $reg['1'];?></a>						
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</p>
			</div>
	<!--abc-->	
</div>		<div class="links mt10">
	<b>友情链接：</b>
		<a target="_blank" href="<?php echo HOUSE_PATH;?>" ><?php echo $default_city;?>新房</a>
		<a target="_blank" href="<?php echo HOUSE_PATH;?>list.html" ><?php echo $default_city;?>房产</a>
	</div>
</div>
<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery","alert","autoc","cookie","autofh"],function($,alertM){
	$("#conl1 div.autoF").autofh()
	$("#s_list1").add("tr").hover(function(){
		$(this).addClass("h")
	},function(){
		$(this).removeClass("h")
	})	
	var num = $('#nums').val();
	$('#num').html(num);
	var $hname=$("#hname").autoC("<?php echo APP_PATH;?>api.php?op=esfsuggest");
	var ht=$hname.attr("data-val");
	$hname.on("focus",function(){
		if($hname.val()==ht)
			$hname.val("");
	}).on("blur",function(){
		if($hname.val()=="")
			$hname.val(ht);
	}).closest("form").submit(function(){
		if($hname.val()==ht){
			$hname.focus()
			return false;
		}
	})
	var $hotarea=$("#hotarea")
	$hotarea.on("mouseover","dt",function(){
		$hotarea.find("dd").hide().end().find("dt").removeClass("s");
		$(this).addClass("s").next().show();
	})
	$("#B1").click(function(){
		$.cookie("esf_list","3");
		window.location.reload();
	})
	$("#B2").click(function(){
		$.cookie("esf_list","1");
		window.location.reload();
	})
	$("#B3").click(function(){
		$.cookie("esf_list","2");
		window.location.reload();
	})
})
</script>
</body>
</html>