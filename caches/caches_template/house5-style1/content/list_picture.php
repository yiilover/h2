<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
    <meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
	<link href="<?php echo APP_PATH;?>statics/house5-style1/index/css/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/house5-style1/news/css/news.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/pic/js/jquery.cookie.js"></script>
	<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
</head>
<body>
	<div id="main">
		<div id="header">
    <?php include template("ssi","ssi_8"); ?>
	<div class="mt5 cf">
	
</div>
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

			<li>
				<a href="<?php echo catlink(7);?>" target="_self" >首页<em></em></a>
			</li>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f229fa539eaa4bab59ee096d0410053f&action=category&catid=7&num=7&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'7','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'7',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li <?php if($r[catid]==$catid) { ?> class="s"<?php } ?> >
				<a href=<?php echo $r['url'];?>><?php echo $r['catname'];?><em></em></a>
            </li>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","nsearch"],function($){
		$("#Search").hSearch("<?php echo APP_PATH;?>index.php?s=search/index/init/siteid/1/typeid/2/","#")//前面是搜索地址，后面是ajax查询新盘api
	})
</script> 
        <div class="bread">
			<sub></sub>
			<a href="<?php echo APP_PATH;?>" class="one">首页</a><?php echo catpos($catid,'');?>
            		</div>		<div class="cf mt10">
			<div class="w650 newsA fl">
				<ul class="List pd10">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1de0ad26d6ad27e194425ac5e8fc27c1&action=lists&catid=%24catid&num=20&order=id+DESC&page=%24page&cache=1800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 20;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                	 <dd style="float:left;margin:5px;" class="inbox cf"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" class="fl"><img src="<?php echo $r['thumb'];?>" height="90" width="150"/></a></dd>
					  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                	                
                					</ul>
				<div class="pagination" >
					<?php echo $pages;?>			</div>
			</div>
						<div class="w300 fr">
            		                    <div class="newsC" id="tab3">
    <h2>
           <ul class="cf tabtitle">
            <li class="on">折扣优惠</li>
            <li>最新资讯</li>
        </ul>
        资讯
    </h2>
    <ul class="NewsList cf">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0fb1b74463d747a4fe2be879a9b669a7&action=lists&posids=0&catid=29&order=id+DESC&num=10&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posids'=>'0','catid'=>'29','order'=>'id DESC',)).'0fb1b74463d747a4fe2be879a9b669a7');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('posids'=>'0','catid'=>'29','order'=>'id DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
          <li><a href="<?php echo $r['url'];?>" target="_blank"  style=""  title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></li>
               <?php $n++;}unset($n); ?>
                  </ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <ul class="NewsList cf" style="display:none"> 
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0f6a041ae50c96cf3344784d8242bb70&action=lists&posids=0&catid=6&order=id+DESC&num=10&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posids'=>'0','catid'=>'6','order'=>'id DESC',)).'0f6a041ae50c96cf3344784d8242bb70');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('posids'=>'0','catid'=>'6','order'=>'id DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
          <li><a href="<?php echo $r['url'];?>" target="_blank"  style=""  title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></li>
               <?php $n++;}unset($n); ?>
                  </ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div>
                    <div class="mt10">
 
</div>
					<div class="newsC" id="tab1">
						<h2>
							<a href="<?php echo HOUSE_PATH;?>">更多>></a>
							<ul class="cf tabtitle">
								<li class="on">热点楼盘</li>
								<li>最新开盘</li>
							</ul>
							楼盘
						</h2>
						<table class="lp" width="280" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <th width="102">楼盘名称</th>
            <th width="65">开盘价</th>
            <th width="48">位置</th>
            <th width="65">开盘时间</th>
        </tr>  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=3e32e5b7a05553ef9cbf529600cce1f4&action=hits&catid=14&num=10&order=views+DESC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'14','order'=>'views DESC',)).'3e32e5b7a05553ef9cbf529600cce1f4');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
		<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
				<?php $menu_info = menu_info('3360',$v[region])?>
                        <tr>
                    <td width="102">
                        <em><a title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>/" target="_blank" ><?php echo str_cut($v[title],16,'');?></a></em> 
                    </td>
                    <td width="65">
                        <span><?php if(!empty($v[price]) && $v[price]!="一房一价") { ?><?php echo $v['price'];?><?php } else { ?>一房一价<?php } ?></span>
                    </td>
                    <td width="48"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank" ><?php echo $menu_info['0'];?></a></td>
                    <td width="65"><?php echo date('m-d',strtotime($v[opentime]));?></td>
                </tr>
                          <?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
                </tbody>
</table>

                        <table class="lp" width="280" border="0" align="center" cellpadding="0" cellspacing="0" style="display:none; ">
    <tbody>
        <tr>
            <th width="102">楼盘名称</th>
            <th width="65">开盘价</th>
            <th width="48">位置</th>
            <th width="65">开盘时间</th>
        </tr>
                   <?php $where= "status=99";?>
		  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7e2e7fbfddb84faa409633433465dadd&action=lists&catid=14&where=%24where&num=10&order=opentime+desc&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'14','where'=>$where,'order'=>'opentime desc',)).'7e2e7fbfddb84faa409633433465dadd');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'opentime desc','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
		        <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
				<?php $menu_info = menu_info('3360',$v[region])?>
                        <tr>
                    <td width="102">
                        <em><a title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>/" target="_blank" ><?php echo str_cut($v[title],16,'');?></a></em> 
                    </td>
                    <td width="65">
                        <span><?php if(!empty($v[price]) && $v[price]!="一房一价") { ?><?php echo $v['price'];?><?php } else { ?>一房一价<?php } ?></span>
                    </td>
                    <td width="48"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank" ><?php echo $menu_info['0'];?></a></td>
                    <td width="65"><?php echo date('m-d',strtotime($v[opentime]));?></td>
                </tr>
                          <?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
                </tbody>
</table>

					</div>
				
                    <div class="mt10"> </div>
                   
                    <div class="newsC">
    <h2>
       
        图片新闻
    </h2>
    <ul class="ImgList cf">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9cd1771aa32c22328de49d6ca842525c&action=lists&catid=6&thumb=1&order=listorder+DESC&num=4&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'6','thumb'=>'1','order'=>'listorder DESC',)).'9cd1771aa32c22328de49d6ca842525c');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'6','thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                    <li>
              <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo thumb($v[thumb],120,90);?>" width="120" height="90"/></a>
                <span>
                   <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" style="text-align:center"  style="" ><?php echo str_cut($v[title],22);?></a>
                </span>
            </li><?php $n++;}unset($n); ?>  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
      </ul>
	
                   
</div>

<div class="newsC">
    <h2>
               一周新闻排行
    </h2>
    <ol class="Top10">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0e6dee567fb81e5b9e035809177db2e4&action=hits&catid=6&num=10&order=views+DESC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'6','order'=>'views DESC',)).'0e6dee567fb81e5b9e035809177db2e4');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                   <li class="A"><i><?php echo $n;?></i>   <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" style="text-align:center"  style="" ><?php echo $v['title'];?></a></li>
                  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ol>
</div>
			</div>	</div>
	</div>
		<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery","alert","autab","cookie","copy","share"],function($,alertM){
	$("#tab1").autab("ul.tabtitle li","table.lp");
	$("#tab2").autab("ul.tabtitle li","ul.ImgList");
	$("#tab3").autab("ul.tabtitle li","ul.NewsList");
	$("#share").share();
	var $big=$("#big"),
		$small=$("#small"),
		$content=$("#cookieContent");
	var fontsize=$.cookie("fontsize")?$.cookie("fontsize"):14;
	$("#cookieContent").css("fontSize",fontsize+"px");
	if(fontsize>16)
		$big.addClass("no");
	if(fontsize<14)
		$small.addClass("no");
	$big.on("click",function(){
		fontsize=fontsize-0+2;
		if(fontsize>16){
			fontsize=18;
			$big.addClass("no")
		}
		$.cookie("fontsize",fontsize);
		$content.css("fontSize",fontsize+"px");
		$small.removeClass("no");
	})
	$small.on("click",function(){
		fontsize=fontsize-2;
		if(fontsize<14){
			fontsize=12;
			$small.addClass("no")
		}
		$.cookie("fontsize",fontsize);
		$content.css("fontSize",fontsize+"px");
		$big.removeClass("no");
	})
	
	$("#copyhref").zclip({
		copy: window.location.href,
		afterCopy: function() {
			alertM("复制成功",{cName:"succ"})
		}
	});
	$("#colpage").on("click",function(){
		window.opener=null;       
		window.open("","_self");     
		window.close();    
	})
	})
	
</script>
</body>
</html>