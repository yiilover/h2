<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
	<meta name="keywords" content="经纪人,房地产经纪人,房产经纪人,二手房经纪人,二手房"/>
	<meta name="description" content="房产网提供最详尽的经纪人列表, 为房地产经纪人提供网络营销工具、房源管理工具,是成为优秀网络房产经纪人最好的网络平台。查看更多房产中介公司,房地产经纪人信息请到房产网。"/>
	<link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/esf.css"  rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/default/js/esf/sea.js"  type="text/javascript"></script>
	<title>经纪人列表 - <?php echo $SEO['site_title'];?></title>
</head>
<body>
	<div id="main">
		<div id="header">
	<?php include template("ssi","ssi_8"); ?>
<script type="text/javascript">
seajs.use("topbarlogin")
</script>	<h1>
			<a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
			<img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a></h1>
<div id="Search">
		<ul class="searchURL">
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
		$where.=" and (truename like '%$keyword%')";
	}
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
		$where.=" and `district`=$parentid";
	}
	if(!empty($ord))
	{
		if($ord=='1')
		{
			$order=" point desc";
			$order_name = "等级由高到低";
		}
		elseif($ord=='2')
		{
			$order=" point ASC";
			$order_name = "等级由低到高";
		}
		else
		{
			$order=" `userid` DESC";
			$order_name = "默认排序";
		}
		$lst.= "-n".$ord;
	}
	else
	{
		$order = "`userid` DESC";
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
											<a <?php if($range=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p3">80-100万</a>
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
			<li>
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
			<li class="s">
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
			<div class="conl1">
				<div class="cf" style="padding:9px 0;">
					<span class="a_name">区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域：</span>
					<span>
						<a href="<?php echo ESF_PATH;?>jingjiren" <?php if(empty($parentid)) { ?>  class="c" <?php } ?>>不限</a>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c428f9bfc8e5c974315cc73e1df10891&action=getlinkage&keyid=4000&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'4000','parentid'=>'0','order'=>'listorder ASC',)).'c428f9bfc8e5c974315cc73e1df10891');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'4000','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="c"<?php } ?> href="<?php echo ESF_PATH;?>jingjiren-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				      					        					</span>
									</div>
			</div>
		</div>
		<div class="cf">
			<div class="w720 fl">
				<div class="Tle2">
					<form action="" method="post">
						<input id="hname" type="text" name="keyword" data-val = "经纪人姓名/公司名称" value="经纪人姓名/公司名称" class="txt" autocomplete="off">
						<input id="kwsearch" type="button" name="" class="btn" value="">
					</form>
					<div class="s_list fr" id="s_list1">
						<span><?php echo $order_name;?></span>
						<ul>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren">默认排序</a>
							</li>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren-n1">等级由高到低</a>
							</li>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren-n2">等级由低到高</a>
							</li>
						</ul>
					</div>
					<span class="fr">共有 <b class="red" id="num"></b> 个经纪人满足您的条件</span>
				</div>
				<!--list-->
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=d5b31dfddfe80a1768eda3e161f378ce&action=memberlist&type=1&where=%24where&order=%24order&pg=%24page&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','where'=>$where,'order'=>$order,'pg'=>$page,'limit'=>'10',));}?>
					<table class="FyList jjrSearch" id="FyList">
												
					<?php $n=1; if(is_array($data[result])) foreach($data[result] AS $k => $v) { ?> 
						<tr>
						<td class="pic">
							<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank">
								<img src="<?php echo $v['avatar'];?>" /></a>
						</td>
						<td class="info">
							<h5>
								<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank"><?php echo $v['truename'];?>&#160;</a> <img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>" border="0" align="absmiddle" title="等级：<?php echo $v['groupname'];?> 积分：<?php echo $v['point'];?>" /> 
							</h5>
							<p>
								所属公司：<?php if($v[company]) { ?><A href="<?php echo ESF_PATH;?>mendian-<?php echo $v['company'];?>" target="_blank"><?php echo $v['companyname'];?></A><?php } else { ?><?php echo $v['companyname'];?><?php } ?>								<br><?php $district_info = menu_info('4000',$v[district])?>
								<?php echo $district_info['0'];?>   &nbsp;手    机：<?php echo $v['tel'];?>							<br>
								 每天都来							</p>
						</td>
						<td class="price">
							<a class="dp" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank">进入店铺</a>
						</td>
					</tr>
					<?php $n++;}unset($n); ?>
									</table>						
					<div class="pagination" >
					<?php echo $data['pages'];?>
					</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</div>
			<div class="w230 fr">
				<div class="modC">
					<h4 class="modBT"><sub></sub>
						经纪人积分排行榜
					</h4>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=703eab47405d0efc1f300cf39fb34630&action=memberlist&type=1&order=point+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'10',));}?>
							<ul class="top10">
									<?php $n=1; if(is_array($data[result])) foreach($data[result] AS $k => $v) { ?> 
            									<li>
							<span class="lettsub7"><a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank"><?php echo $v['truename'];?></a></span>
							<span class="w2"><img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>"  border="0" align="absmiddle" title="等级：<?php echo $v['groupname'];?> 积分：<?php echo $v['point'];?>" /></span>
						</li>
						<?php $n++;}unset($n); ?>
											</ul>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
									</div>
                <div class="mt10"></div>
<!--r二手房广告 经纪人列表页-右侧-->
			</div>
		</div>
<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery"],function($){
	$("#s_list1").add("tr").hover(function(){
		$(this).addClass("h")
	},function(){
		$(this).removeClass("h")
	})
	var num = $('#nums').val();
	$('#num').html(num);
	var $hname=$("#hname");
	var ht=$hname.attr("data-val");
	$hname.on("focus",function(){
		if($hname.val()==ht)
			$hname.val("");
	}).on("blur",function(){
		if($hname.val()=="")
			$hname.val(ht);
	}).on("keydown",function(e){
		if(e.which==13){
			$("#kwsearch").click()
			return false
		}	
	}).closest("form").submit(function(){
		if($hname.val()==ht)
			return false;
	})
	$("#kwsearch").click(function(){
		var kw = $hname.val();
		if(kw!=""&&kw!=ht){
			var kw_encode = encodeURIComponent(kw);
			setTimeout(function(){
				window.location.href = "<?php echo ESF_PATH;?>jingjiren-K" + kw_encode;
			},99)
		}
		$hname.focus();
		return false;
	});

})
</script>
</body>
</html>
