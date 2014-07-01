<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link href="<?php echo APP_PATH;?>statics/house5-style1/video/css/list.css" rel="stylesheet" type="text/css" />
</head>
<script>
    var orderType =0;
    var showSet = "r";
</script>
<body>
<div class="header w960">
<!--header-->
	<div class="logo"><a href="<?php echo catlink(115);?>"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt=""></a></div>
    <div class="search">
    	<div class="text">
        	<form id="search" name="search" action="<?php echo APP_PATH;?>index.php" method="GET">
				  <input type="hidden" name="s" value="search/index/init/siteid/1/">
                  <input type="hidden" name="typeid" value="3">
                  <input name="q" id="q" type="text" class="txt" value="请输入搜索关键字" onfocus="if(this.value=='请输入搜索关键字'){this.value='';}" onblur="if(this.value==''){this.value='请输入搜索关键字';}">
					<input type="submit" class="button" id="submit" value="搜&nbsp;索">
                </form>
        </div>
     <p>
	  
        </p>
    </div>
    <div class="phone">
        <div></div><label></label>
        <span>
        <a href="<?php echo APP_PATH;?>" target="_blank">网站首页</a> |
        <a href="<?php echo BBS_PATH;?>" target="_blank">业主社区</a>
        </span>
    </div>
</div>
<!--header end-->
<div class="navBar"><!--navBar-->
<div class="v-nav">
    <div id="overlayBox" class="v-area clearfix">
        <ul class="left v-nav-left">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8f9b2ca1f96ffb0e5843f81fc63fa4e8&action=category&catid=10&num=7&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'10','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'7',));}?>
        	<li><a href="<?php echo catlink(10);?>" title="首页">首页</a></li>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <li<?php if($r[catid]==$catid) { ?> class="v-nav-on"<?php } ?> ><a href="<?php echo $r['url'];?>" title="<?php echo $r['catname'];?>"><?php echo $r['catname'];?></a></li>
            <?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <!--<li><a target="_self" title="最新" href="">最新</a><span class="v-nav-new"></span></li>-->
            </ul>
      </div></div>
</div>
<!--navBar end-->

<div class="hr_10"></div>
<div class="w960">
	<div class="blockL">    
        <div class="adPlay b">
		<?php if($CAT[image]) { ?>
        	<div id="picContent"><img src="<?php echo $CAT['image'];?>" />
            </div>
		<?php } ?>
            <div>
            <!--<span class="changeBtn"><a href="javascript:void(0)" class="on"></a><a href="javascript:void(0)"></a><a href="javascript:void(0)"></a><a href="javascript:void(0)"></a><a href="javascript:void(0)"></a></span>-->
            </div>
        </div>
		<script>
//			$.PlayInfo.init({picList:'#picContent a img',blockList:'.changeBtn a'});
		</script>
        <div class="hr_10"></div>
    	<!-- <div class="rankStyle">
        	<div class="bg">
                <div class="order">
                    <span>排序方式：</span>
                        <a href="" class="hover">最新发布</a>
                        <a href="">最多播放</a>
                </div>
        	</div>
        </div> -->
        <div class="videoList">
            <ul id="style2">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=2706637b8d39dd5d4708ac123ecad40a&action=lists&catid=%24catid&num=12&order=id+DESC&moreinfo=1&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 12;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li>
                	    <a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><img src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>" /></a>
                	    <span><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title],40,'');?></a><code>上传时间：<?php echo date('Y-m-d',$r[inputtime]);?></code></span>
                        <p><b>【简介】</b><?php echo $r['description'];?><a href="<?php echo $r['url'];?>">详情&gt;&gt;</a></p>
                        <?php if($r[relation]) { ?>
						<label><a href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>/" target="_blank">楼盘详情</a>&nbsp;|&nbsp;<a href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>/tuan.html" target="_blank">参与团购</a>&nbsp;|&nbsp;<a href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>/wenfang-p1.html" target="_blank">问房</a>&nbsp;|&nbsp;<a href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>/dongtai.html" target="_blank">动态</a>&nbsp;|&nbsp;<a href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>/" target="_blank">查看地图</a></label>
						<?php } ?>
                        <a href="<?php echo $r['url'];?>" class="vplay" target="_blank"></a>
                    </li>
					  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>                	                
                					</ul>
        </div>
        <div class="hr_10"></div>
        <div class="pageBg">       
            	<div class="page"><!--page-->
            	    <?php echo $pages;?>		
   				 </div><!--page end--> 
        </div>
    </div>
    <div class="blockR"><!--blockR-->
        <div class="popRank b"><!--popRank-->
            <h3>人气排行</h3>
            <ol> 
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=79326906a89b5ea88b1045b813e6196d&action=hits&catid=10&num=10&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'10','order'=>'views DESC','limit'=>'10',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>				
                        <li class="up">
                        <dt><span><?php echo $n;?></span><a href="<?php echo $v['url'];?>" target="_blank"  title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],28,'');?></a></dt>
                        <dd><?php echo get_hits(5,$v[id]);?>次</dd>
                    </li>
					<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ol>
        </div><!--popRank end-->
        <div class="hr_10"></div>
        <div class="hotLabel b"><!--hotLabel-->
            <div class="title"><a href="#" target="_blank">更多&gt;&gt;</a><h3>热门标签</h3></div>
            <div class="content">
            </div>
        </div><!--hotLabel end-->
        <div class="hr_10"></div>
        <div class="hotTV b"><!--hotTV-->
            <div class="title"><a href="<?php echo catlink(10);?>" target="_blank">更多&gt;&gt;</a><h3>最新视频</h3></div>
            <ul>
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ad7b6db414a4b29eb01e6b49f5517d63&action=lists&catid=10&num=8&order=id+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'10','order'=>'id DESC','limit'=>'8',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                	<li>
                        <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" class="img">
                            <img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" />
                        </a>
                        <p><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a></p>
                    </li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
            <div class="clear"></div>
        </div><!--hotTV end-->
     </div><!--blockR end-->
</div>
<div class="hr_10"></div>
<div class="hr_10"></div>
<?php include template("content","footer"); ?>
<div class="hr_10"></div>
</body>
</html>
