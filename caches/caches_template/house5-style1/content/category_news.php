<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
    <meta name="description" content="<?php echo $SEO['description'];?>">
    <link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/house5-style1/index/css/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/house5-style1/news/css/news.css" rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
</head>
<body>
<div id="main" class="xfindex">
		<div id="header">
   <?php include template("ssi","ssi_8"); ?>
	<div class="mt5 cf">
	
</div>
	

	   <h1><a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
	<img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a></h1>
	<div id="Search">
		<ul class="searchURL">
			<li class="on"><a   target="_blank">资讯</a></li>
			<li><a href="<?php echo HOUSE_PATH;?>"  target="_blank">新房</a></li>
			<li><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">二手房</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">出租房</a></li>
			<li><a href="<?php echo catlink(7);?>"  target="_blank">图库</a></li>
			<li><a href="<?php echo catlink(10);?>"  target="_blank">视频</a></li>
			<li class="more"><a href="javascript:void(0)">更多<em></em></a>
				<div>
					<a target="_blank" href="<?php echo BBS_PATH;?>">论坛</a>
				</div>
			</li>
		</ul>
		<a href="<?php echo APP_PATH;?>map/" target="_blank" class="mapS">地图找房</a>
		<input type="text" value="请输入关键字" data-val="请输入关键字">
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
				<a href="<?php echo catlink(6);?>" target="_self" >首页<em></em></a>
			</li>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=47c0821d7ebfee9af2d7dfe4fae4d0af&action=category&catid=6&num=7&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'7',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li >
				<a href=<?php echo $r['url'];?>><?php echo $r['catname'];?><em></em></a>
            </li>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","nsearch"],function($){
		$("#Search").hSearch("<?php echo APP_PATH;?>index.php?s=search/index/init/siteid/1/typeid/1/","#")//前面是搜索地址，后面是ajax查询新盘api
	})
</script> 
	
	   
	   
	   <div class="mt5"></div>
		<div class="cf mt10">
			<div class="w300 fl">
				<div class="focus-pic" id="tab2">
    <div class="dt">
        <i class="on">1</i>
        <i>2</i>
        <i>3</i>
        <i>4</i>
        <i>5</i>
    </div>
    <ul class="dd">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1b82083706d495c02aac68c745489be8&action=position&posid=1&thumb=1&order=listorder+DESC&num=5&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'1','thumb'=>'1','order'=>'listorder DESC',)).'1b82083706d495c02aac68c745489be8');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 首页幻灯新闻 -->
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <li <?php if($n>1) { ?>style="display:none"<?php } ?>><a href="<?php echo $v['url'];?>"><img border="0" src="<?php echo thumb($v[thumb],340,190);?>" width="340" height="190" alt="<?php echo $v['title'];?>"/></a>
       <p><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></p></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
    </ul>
</div>

				<div class="newsA mt10">
            <h2> <strong><?php echo catname(37);?></strong><!-- 楼盘导购 -->
            <a class="more" href="<?php echo catlink(37);?>" title="<?php echo catname(37);?>" target="_blank">更多</a>
        </h2>
        <ul class="NewsList">
		 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=2807b90464edec51f5131a74ab0c76bd&action=lists&catid=37&order=listorder+DESC&num=8&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'37','order'=>'listorder DESC',)).'2807b90464edec51f5131a74ab0c76bd');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'listorder DESC','limit'=>'8',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
				 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                        <li><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"<?php echo title_style($v[style]);?>><?php echo str_cut($v[title],40,'');?></a> </li>
						 <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        
            </ul>
</div>
			</div>
			<div class="w360 newsB fl">
				<div class="ti">
				 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=028372bb5f0a33046b6e4733fe6caf28&action=position&posid=2&order=listorder+DESC&num=1&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'2','order'=>'listorder DESC',)).'028372bb5f0a33046b6e4733fe6caf28');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'2','order'=>'listorder DESC','limit'=>'1',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 头条1 -->
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					    <h1><a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],30,'');?></a></h1>
						<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<ul class="txtone cf">
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7b8e9a65c82c57ef0bf41ebe7a0ed921&action=position&posid=37&order=listorder+DESC&num=4&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'37','order'=>'listorder DESC',)).'7b8e9a65c82c57ef0bf41ebe7a0ed921');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'37','order'=>'listorder DESC','limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 头条1下4条 -->
  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],30,'');?></a></li>
           <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>

				</div>
				<ul class="NewsList NL14">
				<!-- 最新前6条 -->
				 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7a889758c276fa0f29615b22007a2f45&action=lists&catid=37&order=listorder+DESC&limit=1%2C6&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'37','order'=>'listorder DESC','limit'=>'1,6',)).'7a889758c276fa0f29615b22007a2f45');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'listorder DESC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
				 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li>
           <a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],80,'');?></a>
        </li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
		<ul class="NewsList nobor_b"> <!-- 最新下7条 -->
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0d4a57bbb6342d48e066356615243cfa&action=lists&catid=37&order=listorder+DESC&limit=7%2C7&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'37','order'=>'listorder DESC','limit'=>'7,7',)).'0d4a57bbb6342d48e066356615243cfa');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'listorder DESC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
				 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
				  <li>
           <a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],80,'');?></a>
        </li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
              
        </ul>
			</div>
			<div class="w280 fr">
				<div class="newsA">
    <h2> <strong><?php echo catname(16);?></strong>
	        <a href="<?php echo catlink(37);?>" title="<?php echo catname(16);?>" target="_blank" class="more">更多</a>
    </h2>
    <div class="inbox inbox1 cf">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=654870aaf1e19cd149dadb7a003e00a6&action=lists&catid=16&order=listorder+DESC&thumb=1&limit=1&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'16','order'=>'listorder DESC','thumb'=>'1','limit'=>'1',)).'654870aaf1e19cd149dadb7a003e00a6');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'16','order'=>'listorder DESC','thumb'=>'1','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 全国楼市第一个带图片的 -->
				 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <a href="<?php echo $v['url'];?>" target="_blank"  class="fl" title="<?php echo $v['title'];?>"><img src="<?php echo thumb($v[thumb],70,60);?>" width="70" height="60" alt="<?php echo $v['title'];?>"/></a>
        <h5>
           <a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],26,'');?></a>
        </h5><?php echo str_cut($v[description],46);?><a href="<?php echo $v['url'];?>" target="_blank">[详细]</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <ul class="NewsList">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6c089024be5d6dc670e9fbd8b185687f&action=lists&catid=16&order=listorder+DESC&limit=6&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'16','order'=>'listorder DESC','limit'=>'6',)).'6c089024be5d6dc670e9fbd8b185687f');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'16','order'=>'listorder DESC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 排除第一个带图的新闻调用5条 -->
	<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?> <?php if($n>1) { ?>
                <li> <a href="<?php echo $v['url'];?>" target="_blank"<?php echo title_style($v[style]);?> title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],38,'');?></a></li>
	 <?php } ?><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    
            </ul>
</div>
				<div class="mt5"><!-- 广告 --><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=207"></script></div>
			</div>
		</div>
        <div class="mt2"><!-- 广告区 --></div>
<div class="mt2 cf">
<!-- 广告区 -->
<div class="clear"></div></div>
<div class="mt2"><!-- 广告区 --></div>
<div class="mt2 cf">
<!-- 广告区 -->
<div class="clear"></div></div>
<div class="mt2 mb5"><!-- 广告区 --></div>
		<!--第二屏-->
		<div class="cf">
			<div class="w300 fl">
				<div class="newsA">
    <h2>
        <strong>新闻排行</strong>
        </h2>
    <ol class="Top10" style="padding-top:-10px;">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=557f3078847a4a4f7cd65e8fca9576d6&action=hits&catid=6&limit=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'6','limit'=>'10',)).'557f3078847a4a4f7cd65e8fca9576d6');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><!-- 排除第一个带图的新闻调用5条 -->
	<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?> 
	        <li class="A"> <i><?php echo $n;?></i>
               <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"<?php echo title_style($v[style]);?>><?php echo str_cut($v[title],40,'');?></a>
            </li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                 
            </ol>
</div>

				<div class="mt10"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=208"></script></div>
			</div>
			<div class="w650 cf fr bor_br">
				<div class="NewsList2">
            <h2>
            <a href="<?php echo catlink(27);?>" title="<?php echo catname(27);?>" target="_blank">更多</a>
            <?php echo catname(27);?>        </h2>
        <div class="inbox cf">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=3309dc44a624cb78ca488f2675a80be0&action=lists&catid=27&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'27','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank" class="fl"><img src="<?php echo thumb($v[thumb],105,80);?>" width="105" height="80"></a>
        <h5>
            <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
        </h5>
        <?php echo str_cut($r[description],50);?><a href="<?php echo $v['url'];?>" target="_blank">[详细]</a>
		<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <ul class="NewsList">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=5fa1e855c4a8105f08b55131628d4794&action=lists&catid=27&limit=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'27','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

				<div class="NewsList2">
            <h2>
          <a href="<?php echo catlink(30);?>" title="<?php echo catname(30);?>" target="_blank">更多</a>
           <?php echo catname(30);?>     </h2>
        <div class="inbox cf">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a3595ffbbc8ba6efbff0fa3b053812b5&action=lists&catid=30&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'30','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank" class="fl"><img src="<?php echo thumb($v[thumb],105,80);?>" width="105" height="80"></a>
        <h5>
            <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
        </h5>
        <?php echo str_cut($r[description],50);?><a href="<?php echo $v['url'];?>" target="_blank">[详细]</a>
		<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <ul class="NewsList">
             <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=2fb4ba604f4a036d1432e07f6930a6ff&action=lists&catid=30&limit=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'30','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
                <div class="NewsList2">
            <h2>
           <a  class="more"  href="<?php echo catlink(31);?>" title="<?php echo catname(31);?>" target="_blank">更多</a>
           <?php echo catname(31);?>     </h2>
        <ul class="NewsList">
   <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8b4870ec7225b44eb18d1cc33e4d698a&action=lists&catid=31&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'31','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

                <div class="NewsList2">
            <h2>
          <a href="<?php echo catlink(34);?>" title="<?php echo catname(34);?>" target="_blank">更多</a>
           <?php echo catname(34);?>     </h2>
        <ul class="NewsList">
                       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a7ed18cc114991db9db93c812c3690a1&action=lists&catid=34&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

			</div>
		</div>
        <div class="mt5"><!-- 广告区 --></div>
<div class="mt2"></div>
		<div class="cf mt10">
			<div class="w300 fl">
				<div class="newsA">
             <h2>
            <strong><?php echo catname(38);?></strong>
            <a class="more" href="<?php echo catlink(38);?>" title="<?php echo catname(38);?>" target="_blank">更多</a>
        </h2>
             <div class="esfimg">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=bacbce460e6aacc2678a2084944dbee4&action=lists&catid=38&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'38','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
                <img src="<?php echo thumb($v[thumb],300, 178);?>" alt="<?php echo $v['title'];?>" width="300" height="178">
            </a>
            <h5>
               <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
            </h5><?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
         <ul class="NewsList">
       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=700965ac394ed262da3a7d2879f1c5c8&action=lists&catid=38&limit=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'38','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                     <li><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>
</div>

				<div class="mt5"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=208"></script></div>
				<div class="newsA mt10">
            <h2>
            <strong><?php echo catname(32);?></strong>
            <a class="more" href="<?php echo catlink(32);?>" title="<?php echo catname(32);?>" target="_blank">更多</a>
        </h2>
        <ul class="NewsList">

                     <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a34d936e3f249d5b4e41be172a548de6&action=lists&catid=32&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'32','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                     <li><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

			</div>
			<div class="w650 cf fr bor_br">
				<div class="NewsList2">
            <h2>
           <a class="more" href="<?php echo catlink(34);?>" title="<?php echo catname(34);?>" target="_blank">更多</a>
            <?php echo catname(34);?>        </h2>
        <div class="inbox cf">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=d1fd04af0c332ad816a6db3eb2786343&action=lists&catid=34&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank" class="fl"><img src="<?php echo thumb($v[thumb],105,80);?>" width="105" height="80"></a>
        <h5>
            <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
        </h5>
        <?php echo str_cut($r[description],50);?><a href="<?php echo $v['url'];?>" target="_blank">[详细]</a>
		<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <ul class="NewsList">
                 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0c7f8251afe6937df1cf97d8afb137f6&action=lists&catid=34&limit=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

                <div class="NewsList2">
             <h2>
           <a class="more" href="<?php echo catlink(33);?>" title="<?php echo catname(33);?>" target="_blank">更多</a>
            <?php echo catname(33);?>        </h2>
        <div class="inbox cf">
       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c3c29c7e0445085488ff32d4277bfe27&action=lists&catid=33&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'33','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank" class="fl"><img src="<?php echo thumb($v[thumb],105,80);?>" width="105" height="80"></a>
        <h5>
            <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
        </h5>
        <?php echo str_cut($r[description],50);?><a href="<?php echo $v['url'];?>" target="_blank">[详细]</a>
		<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <ul class="NewsList">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4a62285a9daf1ec42ab5eda7e200d5ae&action=lists&catid=33&limit=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'33','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>

                <div class="NewsList2">
               <h2>
           <a class="more" href="<?php echo catlink(24);?>" title="<?php echo catname(24);?>" target="_blank">更多</a>
            <?php echo catname(24);?>        </h2>
        <ul class="NewsList">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=04e20be2f763cf313d081ec36f564be1&action=lists&catid=24&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'24','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
                <div class="NewsList2">
                 <h2>
           <a class="more" href="<?php echo catlink(29);?>" title="<?php echo catname(29);?>" target="_blank">更多</a>
            <?php echo catname(29);?>        </h2>
        <ul class="NewsList">
                       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=567d6bd753eb7ca73e27e3b6d32a5c21&action=lists&catid=29&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
               <div class="NewsList2">
                 <h2>
           <a class="more" href="<?php echo catlink(37);?>" title="<?php echo catname(37);?>" target="_blank">更多</a>
            <?php echo catname(37);?>        </h2>
        <ul class="NewsList">
                       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=83d7c55602069e5c116bf9b6b9dc5ce0&action=lists&catid=37&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
             <div class="NewsList2">
                 <h2>
           <a class="more" href="<?php echo catlink(35);?>" title="<?php echo catname(35);?>" target="_blank">更多</a>
            <?php echo catname(35);?>        </h2>
        <ul class="NewsList">
                       <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6d4ec0e2518edea99171ae216d9ce593&action=lists&catid=35&limit=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'35','limit'=>'20','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
			</div>
		</div>
		<div class="Imgs cf">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=b40745e779f4884886611424eb7b95bd&action=lists&catid=39&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'39','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <div class="One" style="margin-right:10px;">
<a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>">
        <img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],270,250);?>" width="270" height="250">
    </a>
    <a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a>
</div>
<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <ul class="cf" style="margin-left:10px;">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a29d08979cc13c26c8f874dabfe2a0ee&action=lists&catid=39&limit=1%2C9&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'39','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
 <li>
  <div class="frimg">
    <div class="pic"><a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],140,105);?>" width="140" height="105"></a></div>
    <div class="text"><a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></div>
  </div>
</li>
<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>

		</div>
		<div class="friendslink mt10" id="tab1">
    <h4>
        <span>区域楼盘</span>
        <ul class="areatab">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee3a82b09698607383a5d01b0653d667&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r)?>
 <li <?php if($n==1) { ?>class="on"<?php } else { ?><?php } ?>><a href="javascript:void(0);"><?php echo $reg['1'];?></a></li>
 <?php $n++;}unset($n); ?> 
</ul></h4>
<?php $i=1?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $where = "status=99";?>
<?php $reg = explode('$$', $r)?>
<?php $arrchildid = get_arrchildid('3360',$reg[0]);?>
<?php $where.=" and `region` in ($arrchildid)";?>
<ul class="link cf" <?php if($i!=1) { ?>style="display: none;"<?php } ?>>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=d90913c93fb29eb548435a109293fdbb&action=lists&where=%24where&catid=14&num=40&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('where'=>$where,'catid'=>'14','order'=>'listorder ASC','limit'=>'40',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<li><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo str_cut($v[title],16);?></a></li>
<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> </ul>
<?php $i++; ?>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

        </div>

     

</div>

<script type="text/javascript">
seajs.use(["jquery","autab"],function($){
	$("#tab1").autab("ul.areatab li","ul.cf");
	$("#tab2").autab("i","li",4);
})
</script>
<?php include template("content","footer"); ?>
