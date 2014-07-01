<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?>二手房</title>
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
	<h1>
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
		<a href="<?php echo ESF_PATH;?>map.html"  class="mapS" target="_blank">地图找房</a>
		<div id="qy">
			<span>区域/地铁</span>
			<div>
				<a data-val="" href="javascript:void(0)">全部区县</a>
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
		<div data-k = "平" id="wy" data-val="">
			<span>面积</span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
															<a  href="javascript:void(0)" data-val="-c1">70平米以下</a>
											<a  href="javascript:void(0)" data-val="-c3">70-90平米</a>
											<a  href="javascript:void(0)" data-val="-c4">90-120平米</a>
											<a  href="javascript:void(0)" data-val="-c5">120-150平米</a>
											<a  href="javascript:void(0)" data-val="-c6">150-200平米</a>
											<a  href="javascript:void(0)" data-val="-c7">200-300平米</a>
											<a  href="javascript:void(0)" data-val="-c8">300平米以上</a>
												</div>
		</div>
		<div data-k = "万" id="jg" data-val="">
			<span>价格范围</span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
															<a  href="javascript:void(0)" data-val="-p1">50万以下</a>
											<a  href="javascript:void(0)" data-val="-p2">50-80万</a>
											<a  href="javascript:void(0)" data-val="-p3">80-100万</a>
											<a  href="javascript:void(0)" data-val="-p4">100-150万</a>
											<a  href="javascript:void(0)" data-val="-p5">150-200万</a>
											<a  href="javascript:void(0)" data-val="-p6">200-250万</a>
											<a  href="javascript:void(0)" data-val="-p7">250-300万</a>
											<a  href="javascript:void(0)" data-val="-p8">300-400万</a>
												</div>
		</div>
		<div id="shx">
			<span>户型</span>
			<div>
				<a data-val="" href="javascript:void(0)">全部</a>
															<a  href="javascript:void(0)" data-val="-t1">一室</a>
											<a  href="javascript:void(0)" data-val="-t2">二室</a>
											<a  href="javascript:void(0)" data-val="-t3">三室</a>
											<a  href="javascript:void(0)" data-val="-t4">四室</a>
											<a  href="javascript:void(0)" data-val="-t5">其它</a>
												</div>
		</div>
		<input type="text" data-val="请输入关键字（楼盘名或地名）" value="请输入关键字（楼盘名或地名）">
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
			<li class="s">
				<a href="<?php echo ESF_PATH;?>" >首页<em></em></a>
			</li>
			<li >
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
		$("#Search").hSearch("<?php echo ESF_PATH;?>list","<?php echo APP_PATH;?>api.php?op=esfsuggest");
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
</script>        <!--r二手房广告 二手房首页-通栏1-->
  <div class="mt10 cf">
		<script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=25"></script>
		</div>

		<div class="cf mt10 inLi">
			<div class="modA">
				<div class="hotdc" id="hotdc">
									<span class="a_name">区域搜索</span>
					<span>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);
	?>
	<a <?php if($n==1) { ?>class="on"<?php } ?> href="list-r<?php echo $reg['0'];?>.html" ><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>																																							</span>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>

		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $i++; ?>
	<?php
 	$reg = explode('$$', $r);
	?>
		<span class="hotInfo"<?php if($i>1) { ?>style="display:none"<?php } ?>>	
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8ce37f2fa942953947c4a5ee8a5f5a39&action=getlinkage&keyid=3360&parentid=%24reg%5B0%5D&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>$reg[0],'order'=>'listorder ASC',)).'8ce37f2fa942953947c4a5ee8a5f5a39');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>$reg[0],'order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>

			<?php if($data) { ?>	

			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg2 = explode('$$', $r);
?>
														<a href="list-r<?php echo $reg['0'];?>-b<?php echo $reg2['0'];?>.html" ><?php echo $reg2['1'];?></a>
													<?php $n++;}unset($n); ?><?php } ?>

			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</span>

																																					<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>																																																																																																																																						<span class="a_name">热门小区</span>
										<span>
										<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7b9d751a0a7a9039b2517950949619c2&action=lists&catid=110&where=%60hot%60+like+%27%254%25%27&num=16&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'110','where'=>'`hot` like \'%4%\'','order'=>$order,)).'7b9d751a0a7a9039b2517950949619c2');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'110','where'=>'`hot` like \'%4%\'','order'=>$order,'limit'=>'16',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
												<a class="c" href="#"  target="_blank"><?php echo $r['title'];?></a>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
											</span>
									</div>
			</div>
<?php $_username = param::get_cookie('_username');?>
<?php $_userid = param::get_cookie('_userid')?>
<?php if($_username) { ?>
<div class="modB userLogin">
	<p>
		欢迎您
		<br> <b class="red"><?php echo $_username;?></b>
		<a href="/index.php?s=member/index/logout">[安全退出]</a>
	</p>
	<div class="personal jjr">
		<a href="/index.php?s=member/index/">用户中心</a>
		<a href="#"></a>
		<a href="/index.php?s=member/index/esf">发布出售</a>
		<a href="/index.php?s=member/index/rent">发布出租</a>
		<a href="/index.php?s=member/index/manage_sell">管理出售</a>
		<a href="/index.php?s=member/index/manage_rent">管理出租</a>
		<a href="#"></a>
		<a href="/jingjiren-<?php echo $_userid;?>">进入店铺</a>
	</div>
</div>
<?php } else { ?>
<div class="w225 fr">
	<div class="login_sign">
		<a href="<?php echo APP_PATH;?>login.html"  title="登录" class="login">登录</a>
		<a href="<?php echo APP_PATH;?>index.php?s=member/index/register/modelid/42"  title="注册" class="sign_in">注册</a>
	</div>
	<ul class="mt10 modB manage">
		<li class="t1">
			<a href="<?php echo ESF_PATH;?>chushou.html" >个人免费发布</a>
		</li>
		<li class="t2">
			<a href="/index.php?s=member" >管理我的房源</a>
		</li>
	</ul>
</div>
<?php } ?>
		</div>
        <div class="mb10 cf">
		</div>
<!--r二手房广告 二手房首页-通栏2-->
		<div class="cf inLi">
			<div class="modA">
				<div class="cf pic_news">
					<h4 class="modBT">
    推荐资讯
    <a href="<?php echo APP_PATH;?>news/"  target="_blank" class="more">更多>></a>
</h4>
<div class="focus-pic fl" id="tab1">
    <div class="dt">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=82af36c649ff633249c0579ff6128dfb&action=position&posid=84&siteid=%A1%B1%24siteid%A1%B1+order%3D&thumb=1&num=4&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'84','siteid'=>'”$siteid” order=','thumb'=>'1',)).'82af36c649ff633249c0579ff6128dfb');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'84','siteid'=>'”$siteid” order=','thumb'=>'1','limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                        <i <?php if($n==1) { ?>class="on"<?php } ?>><?php echo $n;?></i>
	<?php $n++;}unset($n); ?>
	<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             
    </div>
    <ul class="dd">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=82af36c649ff633249c0579ff6128dfb&action=position&posid=84&siteid=%A1%B1%24siteid%A1%B1+order%3D&thumb=1&num=4&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'84','siteid'=>'”$siteid” order=','thumb'=>'1',)).'82af36c649ff633249c0579ff6128dfb');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'84','siteid'=>'”$siteid” order=','thumb'=>'1','limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                        <li <?php if($n>1) { ?>style="display:none;"<?php } ?>>
                    <a target="_blank" href="<?php echo $v['url'];?>"  title="<?php echo $v['title'];?>">
                        <img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],280,170);?>"  />
                    </a>
                    <p>
                        <a href="<?php echo $v['url'];?>"  title="<?php echo $v['title'];?>" target="_blank"><?php echo str_cut($v[title],36);?></a>
                    </p>
                </li>
		<?php $n++;}unset($n); ?>
	<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                             
    </ul>
</div><!--e二手房首页 焦点图-->
					<ul class="xwlist w400 fl">
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e2e23be701c216459c04e4a05dcbf6fc&action=position&posid=10&catid=66&order=listorder+DESC&num=8&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'10','catid'=>'66','order'=>'listorder DESC',)).'e2e23be701c216459c04e4a05dcbf6fc');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'66','order'=>'listorder DESC','limit'=>'8',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
          <li>
                        <a href="<?php echo $v['url'];?>"  <?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>" target="_blank"><?php echo str_cut($v[title],48);?></a><?php echo date('Y-m-d',$v[inputtime]);?>               </li>
         <?php $n++;}unset($n); ?>
		 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--e二手房首页 一屏右侧-栏目1-->
				</div>
			</div>
			<div class="modB adb">
			<script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=52"></script>
</div><!--r二手房广告 二手房首页-画中画1-->

		</div>
        <div class="mb10 cf">
</div>
<!--r二手房广告 二手房首页-通栏3-->
		<div class="cf inLi">
			<div class="modA">
				<h4 class="modBT cf">
					<span class="fr">
						<a href="rent-list-h1.html"  target="_blank">新推</a>
						|
						<a href="rent-list-h3.html"  target="_blank">急售</a>
						|
						<a href="rent-list-h2.html"  target="_blank">推荐</a>
						<a href="rent-list.html"  target="_blank">更多>></a>
					</span>
					出租房源
				</h4>
								<ul class="pic_tj cf">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=2af79a72d6988b15b40fea7627a2290f&action=lists&catid=113&where=%60flag%60+like+%27%252%25%27+or+%60flag%60+like+%27%253%25%27+or+%60flag%60+like+%27%251%25%27&num=4&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'113','where'=>'`flag` like \'%2%\' or `flag` like \'%3%\' or `flag` like \'%1%\'','order'=>$order,)).'2af79a72d6988b15b40fea7627a2290f');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'113','where'=>'`flag` like \'%2%\' or `flag` like \'%3%\' or `flag` like \'%1%\'','order'=>$order,'limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
					 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
										<li> <sub><?php $flag = explode(',', $r[flag]);
						foreach ($flag as $t => $c) {
					if(intval($c))
					{
						if($c=='3')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tuijian.gif" alt="推荐楼盘" title="推荐楼盘" style="vertical-align:middle" />';
						}
						if($c=='2')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/jishou.gif" alt="急售楼盘" title="急售楼盘" style="vertical-align:middle" />';
						}
						if($c=='1')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/xintui.gif" alt="新推楼盘" title="新推楼盘" style="vertical-align:middle" />';
						}
					}
				}?>		</sub>
						<a href="<?php echo ESF_PATH;?>rent-show-<?php echo $r['id'];?>.html"  target="_blank" title="<?php echo $r['title'];?>">
							<img src="<?php echo thumb($r[thumb], 200, 150, 0);?>" ></a>
						<p><?php $relationxq = get_relationxq($r[id],113,110)?>
							<a href="<?php echo ESF_PATH;?>rent-show-<?php echo $r['id'];?>.html" ><?php echo $relationxq['title'];?></a>
							<span class="red"><?php echo $r['price'];?>元/月</span>
							<span><?php echo $r['huxingshi'];?>室<?php echo $r['huxingting'];?>厅</span>
							<span><?php echo $r['total_area'];?>㎡</span>
						</p>
					</li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
							</div>
			<div class="modB adb"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=53"></script>
</div><!--r二手房广告 二手房首页-画中画2-->
		</div>
        <div class="mb10 cf"></div>
<!--r二手房广告 二手房首页-通栏5-->
		<div class="cf inLi">
			<div class="modA">
				<h4 class="modBT cf">
					<span class="fr">
						<a href="list-h1.html"  target="_blank">新推</a>
						|
						<a href="list-h3.html"  target="_blank">急售</a>
						|
						<a href="list-h2.html"  target="_blank">推荐</a>
						<a href="list.html"  target="_blank">更多>></a>
					</span>
					出售房源
				</h4>
								<ul class="pic5_tj cf">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=af9c88c06df86457e1f53c64b85eeaa0&action=lists&catid=112&where=%60flag%60+like+%27%253%25%27&num=5&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'112','where'=>'`flag` like \'%3%\'','order'=>$order,)).'af9c88c06df86457e1f53c64b85eeaa0');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'`flag` like \'%3%\'','order'=>$order,'limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
										<li>
						<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  target="_blank" title="<?php echo $r['title'];?>">
							<img data-src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb], 100, 75, 0);?><?php } else { ?><?php echo CSS_PATH;?>images/nopic.jpg<?php } ?>"  title="<?php echo $r['title'];?>" alt="<?php echo $r['title'];?>"></a>
						<p><?php $relationxq = get_relationxq($r[id],112,110)?>
							<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  target="_blank" title="<?php echo $r['title'];?>"><?php echo $relationxq['title'];?></a>
							<span><?php echo $r['huxingshi'];?>室<?php echo $r['huxingting'];?>厅,<?php echo $r['total_area'];?>㎡</span>
							<span class="red"><?php echo $r['price'];?>万</span>
						</p>
					</li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
									</ul>
								<div class="cf">
										<ul class="fyList cf">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0d278bd16acecc54b9ed6922473b4ca9&action=lists&catid=112&num=14&order=%24order&order=updatetime+desc&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'112','order'=>'updatetime desc',)).'0d278bd16acecc54b9ed6922473b4ca9');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','order'=>'updatetime desc','limit'=>'14',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php $menu_info = menu_info('3360',$r[region])?>
							<?php $relationxq = get_relationxq($r[id],112,110)?>
												<li>
							<a class="w1" href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>"  target="_blank">[<?php echo $menu_info['0'];?>]</a>
							<span class="lettsub9"><a  href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank"><?php echo $relationxq['title'];?></a></span>
							<span class="w2"><?php echo $r['huxingshi'];?>室</span>
							<span class="w3"><?php echo $r['total_area'];?>㎡</span>
							<span class="w4"><?php echo $r['price'];?>万</span>
						</li>
						<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
											</ul>
									</div>
			</div>
			<div class="modB">
				<h4 class="modBT">
					推荐经纪人
					<a href="<?php echo ESF_PATH;?>jingjiren"  target="_blank" class="more">更多>></a>
				</h4>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=0eaea06bd802853761909dfe5aa29a3d&action=memberlist&type=1&order=point+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'5',));}?>
				<ul class="agent">
				<?php $n=1; if(is_array($data['result'])) foreach($data['result'] AS $k => $v) { ?> 
				<?php if($v[avatar]) { ?>
						<?php $avatar = str_replace('180x180','45x45',$v[avatar])?>
						<?php $avatar = str_replace('90x90','45x45',$avatar)?>
						<?php } ?>
                <li>
    <a class="tx" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>"  title="<?php echo $v['truename'];?>" target="_blank">
        <img src="<?php echo $avatar;?>" alt="<?php echo $v['truename'];?>" onerror="this.onerror=null;this.src='<?php echo APP_PATH;?>statics/default/img/esf/nophoto_90x90.gif'"></a>
    <a href="" ><?php echo $v['truename'];?></a>
    <a class="z" href="<?php echo ESF_PATH;?>jingjiren-rent-<?php echo $v['userid'];?>"  target="_blank"></a>
    <a class="s" href="<?php echo ESF_PATH;?>jingjiren-esf-<?php echo $v['userid'];?>"  target="_blank"></a>
    <p><?php if($v[company]) { ?><A href="<?php echo ESF_PATH;?>mendian-<?php echo $v['company'];?>" target="_blank"><?php echo $v['companyname'];?></A><?php } else { ?><?php echo $v['companyname'];?><?php } ?></p>
</li><?php $n++;}unset($n); ?>
	</ul>
							</div>
		</div>
        <!--r二手房广告 二手房首页-通栏6-->
		<div class="cf inLi">
			<div class="modA">
				<div class="total fl" id="highcharts"></div>
				<div class="total-txt fl">
					<p> <b>根据<?php echo $site_title;?>统计，<?php echo $default_city;?>本月：</b>
						<br>
						二手房均价为 <em>8619</em>元/平米						<br> <b>还能查小区房价，快来试试……</b>
						<br></p>
					<form id="myform" name="myform" method="post" action="<?php echo ESF_PATH;?>list-search">
						<input id="hname" name="keyword" type="text" value="请输入小区名字" data-val="请输入小区名字" autocomplete="off">
						<button type="submit">查看房价</button>
					</form>
				</div>
			</div>
			<div class="modB">
	<h4 class="modBT">实用工具箱</h4>
	<ul class="t_tools">
		<a href="<?php echo APP_PATH;?>tools/fdjsq.html"  target="_blank">代款计算器</a>
		<a href="<?php echo APP_PATH;?>tools/fdjsq.html"  target="_blank">等额本息还款法</a>
		<a href="<?php echo APP_PATH;?>tools/fdjsq.html"  target="_blank">等额本金还款法</a>
		<a href="<?php echo APP_PATH;?>tools/sfjsq.html"  target="_blank">税费计算器</a>
		<a href="<?php echo APP_PATH;?>tools/gjjdkjsq.html"  target="_blank">公积金贷款计算器</a>
	</ul>
</div>		</div>
        <!--r二手房广告 二手房首页-通栏7-->
		<div class="modA cf">
			<h4 class="modBT cf">
				<span class="fr">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<?php if($n<=10) { ?>
	<a href="<?php echo ESF_PATH;?>list-r<?php echo $reg['0'];?>.html"  target="_blank"><?php echo $reg['1'];?></a>
	&nbsp;|&nbsp;
	<?php } ?>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<a href="<?php echo ESF_PATH;?>list.html"  target="_blank">更多>></a>
				</span>
				推荐小区
			</h4>
						<ul class="fyList xqList cf">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a105ef80f6897e3d7a3fdf0a80ce7deb&action=lists&catid=110&where=%60hot%60+like+%27%256%25%27&num=10&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'110','where'=>'`hot` like \'%6%\'','order'=>$order,)).'a105ef80f6897e3d7a3fdf0a80ce7deb');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'110','where'=>'`hot` like \'%6%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php $menu_info = menu_info('3360',$r[region])?>
					<li>
					<a class="w1" href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>"  target="_blank">[<?php echo $menu_info['0'];?>]</a>
					<a class="fl" href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6667cb114c4db330a4cb5cb1751e8989&action=salecount&relation=%24r%5Bid%5D&catid=113&return=rentcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'salecount')) {$rentcount = $content_tag->salecount(array('relation'=>$r[id],'catid'=>'113','limit'=>'20',));}?>
					<a class="w6" href="<?php echo ESF_PATH;?>rent-list-k<?php echo $r['title'];?>.html" >租<?php echo $rentcount;?>套</a>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=18ceba6af24d2cf8cbb35fa107b18414&action=salecount&relation=%24r%5Bid%5D&catid=112&return=salecount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'salecount')) {$salecount = $content_tag->salecount(array('relation'=>$r[id],'catid'=>'112','limit'=>'20',));}?>
					<a class="w6" href="<?php echo ESF_PATH;?>list-k<?php echo $r['title'];?>.html" >售<?php echo $salecount;?>套</a>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<span class="w5"><?php if($r[price]) { ?><?php echo $r['price'];?><?php } else { ?>暂无<?php } ?></span>
					</li>
				<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
					</div>
		<div class="modB links">
			<h4>
				<span class="fr">
                    申请友情链接 |<a href=""  target="_blank" style="font-weight:bold;margin:0px;"><?php echo $default_city;?>二手房网</a>
				</span>
				友情链接
			</h4>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=cf53f7272d991624010bdb473357508e&action=type_list&typeid=117&siteid=%24siteid&order=listorder+DESC&return=data&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('typeid'=>'117','siteid'=>$siteid,'order'=>'listorder DESC',)).'cf53f7272d991624010bdb473357508e');if(!$data = tpl_cache($tag_cache_name,86400)){$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'117','siteid'=>$siteid,'order'=>'listorder DESC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>

             <ul class="flinks">

			 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

                            <a href="<?php echo $r['url'];?>" title="<?php echo $r['name'];?>" target="_blank"><?php echo $r['name'];?></a>

             <?php $n++;}unset($n); ?>

			 </ul>

		 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
	</div>
<?php include template("content","footer"); ?>
	<script type="text/javascript">
seajs.use(["jquery","highcharts","autab","autoc"],function($,highcharts){
	$("#tab1").autab("i","li",4);
	$("#hotdc").autab("span:eq(1) a","span.hotInfo");
	highcharts('highcharts'," ",['10月','11月','12月','02月','01月','02月'],[7124,7184,7177,8899,7243,8619],'元/平米');
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
})
</script>
</body>
</html>