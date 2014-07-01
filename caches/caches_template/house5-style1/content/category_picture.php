<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="zh-CN" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="zh-CN" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="zh-CN" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="zh-CN"><!--<![endif]-->
<head>
    <meta charset="gbk">
   <title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
	<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo APP_PATH;?>statics/house5-style1/pic/css/house5-common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo APP_PATH;?>statics/house5-style1/pic/css/house5-pic-channel.css" />
	<link href="<?php echo APP_PATH;?>statics/house5-style1/pic/css/pic_header.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/house5-common.js"></script>
	<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
	<!--[if lt IE 9 ]>
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/modernizr.js"></script>
    <![endif]-->
    <script type="text/javascript">
	var IMG_URL="",UPLOAD_URL="",APP_URL="",WWW_URL="",SPACE_URL="",COOKIE_PRE="",COOKIE_DOMAIN="",COOKIE_PATH="/",SINA_APPKEY="",QQ_SOURCEID="";
        var pageid = 4;
    </script>
</head>
<body>
<!-- 头部 -->
<header class="head-repeat-x">
    
    		<div class="header-topbar">
		<?php include template("ssi","ssi_8"); ?></div>
		<!-- end顶部背景条 --></header>


<!-- 导航 -->
<div class="nav-wrapper">
  <div id="header">
	<h1><a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
	<img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a></h1>
	<div id="Search">
		<ul class="searchURL">
			<li><a target="_blank" href="<?php echo catlink(6);?>">资讯</a></li>
			<li><a href="<?php echo HOUSE_PATH;?>"  target="_blank">新房</a></li>
			<li><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">二手房</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">出租房</a></li>
			<li class="on"><a href="<?php echo catlink(7);?>"  target="_blank">图库</a></li>
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
				<a href="<?php echo catlink(7);?>" target="_self" >首页<em></em></a>
			</li>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1c38ea6594b91db20d67477ba34f167b&action=category&catid=7&num=5&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'7','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'5',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li >
				<a href="<?php echo catlink($r[catid]);?>" target="_self" ><?php echo catname($r[catid]);?><em></em></a>
            </li>
			 <?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","nsearch"],function($){
		$("#Search").hSearch("<?php echo APP_PATH;?>index.php?s=search/index/init/siteid/1/typeid/2/")
	})
</script>   
<!--导航 end -->
</div><!-- @end 导航 -->

<!-- Banner -->
<section class="column banner-wrap">
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=885b00eb1e2c94fb111575f37c5be7bc&action=position&posid=68&num=5&order=listorder+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'68','order'=>'listorder desc','limit'=>'5',));}?>
    <div class="slide" id="PicSlide">
       <ul class="img">
		   <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li <?php if($n>1) { ?>class="hidden"<?php } ?>><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo thumb($v[thumb],640,360);?>" width="640"  height="360" alt="<?php echo $v['description'];?>"></a></li>
       <?php $n++;}unset($n); ?>
    </ul>
<!-- 标题区 -->
<div class="title">
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<?php if($n==1) { ?>
    <p class="h3 pos-a"><a title=""><?php echo $v['description'];?></a></p>
<?php } ?>
	<?php $n++;}unset($n); ?>
    <div class="shadow"></div>
</div>
<!-- 缩略图 -->
<div class="thumb">
    <ul>
	  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo thumb($v[thumb],120,60);?>" width="120" height="60" alt="<?php echo $v['title'];?>"></a></li>
   <?php $n++;}unset($n); ?>
            </ul>
    <div class="now-status"></div>
</div>
    </div>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <aside class="image-rank">
        <div class="hd"><!-- 图片排行榜 --></div>
        <div class="bd">
           <ul id="accordion_elem" class="list">
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ca03151e5cb7c51b5b1ab0a6c061cff2&action=hits&catid=7&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'7','order'=>'weekviews DESC','limit'=>'10',));}?>
  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<li class="item">
    <div class="ov">
        <em class="ico front"><?php echo $n;?></em><a class="title" target="_blank" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a>
    </div>
    <div class="summary" style="display: none;">
        <a title="<?php echo $v[$title];?>" target="_blank" href="<?php echo $v['url'];?>"><img width="80" height="60" alt="" class="thumb" src="<?php echo thumb($v[thumb],80,60);?>"></a>
        <p><?php echo str_cut($v[description],30);?></p>
    </div>
</li>
 <?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>           
            </ul>
        </div>
    </aside>
</section><!-- @end Banner -->

<!-- 广告 -->
<section class="column column-ad">
<script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=46"></script>
</section><!-- @end 广告 -->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1c38ea6594b91db20d67477ba34f167b&action=category&catid=7&num=5&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'7','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'5',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<section class="ov rec-special">
    <div class="m-head dotted-head">
        <a class="more" href="<?php echo catlink($r[catid]);?>">更多 &gt;&gt;</a>
        <em class="ico"></em>
        <div class="title"><a href="<?php echo catlink($r[catid]);?>" title="<?php echo catname($r[catid]);?>" class="words"><?php echo catname($r[catid]);?></a></div>
    </div>
    <div class="m-main">
        <div class="pic-list-box ov">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9f2525b74e7df114fa675c34ac37446f&action=lists&catid=%24r%5Bcatid%5D&num=12&order=id+DESC&page=%24page&cache=1800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 12;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$r[catid],'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$r[catid],'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                        <div class="v-pic">
                <div class="thumb">
                    <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" width="120" height="90"></a>
                </div>
                <div class="title"><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></div>
            </div>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </div>
    </div>
</section>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<!-- footer -->
<?php include template("content","footer"); ?>

<script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/house5-slider.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //幻灯片调用
        slider.init({'id': $('#PicSlide'), way:'left', interval: 4000});
        accordion($('#accordion_elem'));
    });

    // 手风琴效果
    function accordion( elem ){
        var lis = elem.find('.item');
        var Tag = lis.eq(0).get(0).nodeName;
        lis.hover(function( ev ){
            $(this).find('.summary').show().parent().siblings().find('.summary').hide();
        },function( ev ){
            if(ev.relatedTarget.nodeName != Tag ){
                $(this).find('.summary').show().parent().siblings().find('.summary').hide();
            } else{
                $(this).find('.summary').hide();
            }
        });
    }
</script>
</body>
</html>