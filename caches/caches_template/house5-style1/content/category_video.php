<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link rel="icon" href="<?php echo APP_PATH;?>favicon.ico" type="image/icon" />
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" type="image/x-icon" />
<link href="<?php echo APP_PATH;?>statics/house5-style1/video/css/index.css" rel="stylesheet" type="text/css" />
<script src="<?php echo APP_PATH;?>statics/house5-style1/js/lib/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/video/js/lunbo.js" type="text/javascript"></script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/video/js/imageScroller.js" type="text/javascript"></script>
</head>
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
        	<li class="v-nav-on"><a href="<?php echo catlink(10);?>" title="首页">首页</a></li>
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
<div class="fi_movie w960" id="fi_movie"><!--fi_movie-->
	
<div id="slider">
	<div class="slider_box" id="slider_name">
 	  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e2ae9201f7d1c4a9e42d52e2dce9e297&action=position&posid=7&num=8&order=id+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'7','order'=>'id desc','limit'=>'8',));}?>
      <ul class="silder_con">
		<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li class="silder_panel clearfix">
       	  <a href="<?php echo $v['url'];?>" class="f_l"><img src="<?php echo $v['thumb'];?>" /></a>
          <div class="silder_intro f_r">
            <h3> <strong><a href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></strong> <span>播放：<?php echo get_hits(5,$v[id]);?>次</span> </h3>
            <p>[<strong>视频介绍</strong>]<?php echo str_cut($v[description],108,'');?></p>
            <a class="silder_play" target="_blank" href="<?php echo $v['url'];?>">马上观看</a></div>
        </li>
		<?php $n++;}unset($n); ?>
     
      </ul>
      <ul class="silder_nav clearfix">
	  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li><a href="#"><img src="<?php echo $v['thumb'];?>"/></a></li>    
		<?php $n++;}unset($n); ?>   
      </ul>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
    <div class="silderBox"></div>
</div>

<!--fi_movie end-->

<div class="hr_10"></div>
<div class="w960"><!--1楼-->
    <div class="blockyi"><!--blockyi-->
        <div class="title"><a href="<?php echo catlink(45);?>" target="_blank">更多&gt;&gt;</a><h2 class="ttkfAlt"><?php echo catname(45);?></h2></div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e6bb070c2688c44e7a3122c17d4e494f&action=position&catid=45&posid=10&thumb=1&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('catid'=>'45','posid'=>'10','thumb'=>'1','limit'=>'1',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <div class="play">
              <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" width="244px" height="183px"></a>
            </div>
            <div class="news">
                <h1><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></h1>
                <div class="xline"></div>
                <p><b>【简介】</b><?php echo str_cut($v[description],320);?><a href="<?php echo $v['url'];?>" target="_blank">[详情]</a></p>
        	</div>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<div class="hr_10"></div>
        <div class="videoList"><!--videoList-->
            <ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=435c82cfa4a291bcbd4a8c4141223169&action=lists&catid=45&order=listorder+DESC&limit=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'45','order'=>'listorder DESC','limit'=>'20',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                	<li>
                        <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" class="img">
                            <img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" />
                            <!-- <i></i>
                            <code>05:32</code> -->
                        </a>
                        <p><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],24,'');?></a></p>
                    </li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div><!--videoList end-->
	</div><!--blockyi end-->
    <div class="tongR"><!--tongR-->
        <div class="hotLabel b"><!--hotLabel-->
            <div class="title"><a href="#" target="_blank">更多&gt;&gt;</a><h3>热门标签</h3></div>
            <div class="content">
                	
            </div>
        </div><!--hotLabel end-->
    </div><!--tongR end-->
</div><!--1楼END-->
<div class="hr_10"></div>
<div class="w960"><!--2楼-->
    <div class="blockL"><!--blockL-->
        <div class="title"><a href="<?php echo catlink(47);?>" target="_blank">更多&gt;&gt;</a><h2 class="ztcAlt"><?php echo catname(47);?></h2></div>
        <div class="videoList"><!--videoList-->
            <ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=59401936696a6c840e9f86a06386888d&action=lists&catid=47&order=listorder+DESC&limit=0%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'47','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                    <li>
                        <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" class="img">
                            <img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" />
                            <!-- <i></i>
                            <code>05:16</code> -->
                        </a>
                        <p><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],24,'');?></a></p>
                    </li>
              <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div><!--videoList end-->
        <div class="clear"></div>
        <div class="otherVideo">
            <ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9e8c433cdd5eb79960d3e94e44676eca&action=lists&catid=47&order=listorder+DESC&limit=4%2C6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'47','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                	<li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],40,'');?></a></li>
				 <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
		</div>
    </div><!--blockL end-->
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

</div><!--2楼END-->
<div class="hr_10"></div>
<div class="w960"><!--3楼--> 
    <div class="blockL"><!--blockL-->
        <div class="title"><a href="<?php echo catlink(50);?>" target="_blank">更多&gt;&gt;</a><h2 class="mdmAlt"><?php echo catname(50);?></h2></div>
        <div class="videoList"><!--videoList-->
            <ul>
                 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=a4116d298570fd310ca589e355f40301&action=lists&catid=50&order=listorder+DESC&limit=0%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'50','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                    <li>
                        <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" class="img">
                            <img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" />
                            <!-- <i></i>
                            <code>05:16</code> -->
                        </a>
                        <p><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],24,'');?></a></p>
                    </li>
              <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div><!--videoList end-->
        <div class="clear"></div>
        <div class="otherVideo">
            <ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f9aa705b4398b7dcb38f2b3d9d28b567&action=lists&catid=50&order=listorder+DESC&limit=4%2C6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'50','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                	<li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],40,'');?></a></li>
				 <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
		</div>
    </div><!--blockL end-->
    <div class="popRank b"><!--popRank-->
    	<h3>热门楼盘</h3>
    	<ol class="commRank">
             <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9b041e45666954838198fd57f72d86dd&action=hits&catid=14&num=10&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'views DESC','limit'=>'10',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>				
					<li class="up">
					<dt><span><?php echo $n;?></span><a href="<?php echo $v['url'];?>" target="_blank"  title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],28,'');?></a></dt>
					<dd><?php echo get_hits(13,$v[id]);?></dd>
				</li>
				<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ol>
    </div><!--popRank end-->
</div><!--3楼END-->    
<div class="hr_10"></div>
<div class="w960"><!--4楼--> 
    <div class="blockL"><!--blockL-->
        <div class="title"><a href="<?php echo catlink(51);?>" target="_blank">更多&gt;&gt;</a><h2 class="mdmAlt"><?php echo catname(51);?></h2></div>
        <div class="videoList"><!--videoList-->
            <ul>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=b3f9331ba673b694ab236a3e65b13bd4&action=lists&catid=51&order=listorder+DESC&limit=0%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'51','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                    <li>
                        <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>" class="img">
                            <img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" />
                            <!-- <i></i>
                            <code>05:16</code> -->
                        </a>
                        <p><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],24,'');?></a></p>
                    </li>
              <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div><!--videoList end-->
        <div class="clear"></div>
        <div class="otherVideo">
            <ul>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=aa3089582de375a2d6e579cbea142b45&action=lists&catid=51&order=listorder+DESC&limit=4%2C6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'51','order'=>'listorder DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                	<li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo str_cut($v[title],40,'');?></a></li>
				 <?php $n++;}unset($n); ?>
			  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
		</div>
    </div><!--blockL end-->
    <div class="popRank b">
    	<h3>热点资讯</h3>
        <ul>
		 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=d05d8718b91d21fdd5ace2eeff5ec0ae&action=hits&catid=6&num=10&order=weekviews+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','order'=>'weekviews DESC','limit'=>'10',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>				
					<li class="up">
					<dt><span><?php echo $n;?></span><a href="<?php echo $v['url'];?>" target="_blank"  title="<?php echo $v['title'];?>"><?php echo str_cut($v[title],28,'');?></a></dt>
					<dd><?php echo get_hits(1,$v[id]);?>次</dd>
				</li>
				<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
    </div>
</div><!--4楼END-->
<div class="hr_10"></div>
<div class="special b"><!--5楼-->
	<h2 class="hdzt">最新视频</h2>
	<div class="left_btn" id="prevButton"></div>
    <div class="right_btn" id="nextButton"></div>
    <div class="content" id="panelWrapper">
    	<ul id="list">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0d7a9f7de171589bddce6faefcc77ab4&action=lists&catid=10&num=10&order=id+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'10','order'=>'id DESC','limit'=>'10',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            	<li><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>">
            	<img src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>"></a>
            	<?php echo $v['title'];?>
            	</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
    </div>
</div><!--5楼 end-->
<div class="hr_10"></div>
<div class="hr_10"></div>
<div class="yqljAd b"><!--7楼--> 
    <h2 class="yqljAlt">友情链接</h2>
    <div class="clear"></div>
    <div class="content">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=b0f527e540bdf059adc26aad25b4f840&action=type_list&typeid=42&siteid=1&order=listorder+DESC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'42','siteid'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
			   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href="<?php echo $r['url'];?>" title="<?php echo $r['name'];?>" target="_blank"><?php echo $r['name'];?></a>
             <?php $n++;}unset($n); ?>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        <div class="hr_10"></div>     
    </div>
</div><!--7楼END-->
<div class="hr_10"></div>
<?php include template("content","footer"); ?>
<script src="<?php echo APP_PATH;?>statics/house5-style1/video/js/jquery.slides.js" type="text/javascript"></script>
<script type="text/javascript">    
    $("#panelWrapper").imageScroller({
        prev: "nextButton",
        next: "prevButton",
        frame: "list",
        child: "li",
        auto: true
    });
</script>
</body>
</html>
