<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link type="text/css" rel="stylesheet" href="<?php echo APP_PATH;?>statics/house5-style1/home/css/jiancai2013.css" />
<link href="<?php echo APP_PATH;?>statics/house5-style1/home/css/top.css" rel="stylesheet" type="text/css" />
<script src="<?php echo APP_PATH;?>statics/house5-style1/home/js/jQuery.1.8.2.min.js" type="text/javascript"> </script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/home/js/common.js" type="text/javascript"> </script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/home/js/seekDom.js"></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/house5-style1/home/js/jquery.lazyload.js"></script>
<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>

<script src="<?php echo APP_PATH;?>statics/house5-style1/home/js/responsiveslides.min.js"></script>
</head>
<body class="graybg">
<div id="wrap" style="">
 <div id="header">
	<?php include template("ssi","ssi_8"); ?>
	<h1><a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
	<img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a></h1>
	<div id="Search">
		<ul class="searchURL">
			<li class="on"><a href="<?php echo HOUSE_PATH;?>"  target="_blank">�·�</a></li>
			<li><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">���ַ�</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">���ⷿ</a></li>
			<li class="more"><a href="javascript:void(0)">����<em></em></a>
				<div>
					<a target="_blank" href="<?php echo catlink(6);?>">��Ѷ</a>
					<a target="_blank" href="<?php echo BBS_PATH;?>">��̳</a>
				</div>
			</li>
		</ul>
		<a href="<?php echo APP_PATH;?>map/" target="_blank" class="mapS">��ͼ�ҷ�</a>
		<div id="qy">
			<span>����/����</span>
			<div>
				<a href="javascript:void(0)" data-val="">ȫ������</a>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
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
			<span>��Ŀ����</span>
			<div>
				<a href="javascript:void(0)" data-val="">ȫ��</a>
											<a  href="javascript:void(0)" data-val="-h1">סլ</a>
											<a  href="javascript:void(0)" data-val="-h7">�����ۺ���</a>
											<a  href="javascript:void(0)" data-val="-h2">����</a>
											<a  href="javascript:void(0)" data-val="-h3">д��¥</a>
											<a  href="javascript:void(0)" data-val="-h4">��Ԣ</a>
											<a  href="javascript:void(0)" data-val="-h5">����</a>
											<a  href="javascript:void(0)" data-val="-h6">��԰��</a>
											<a  href="javascript:void(0)" data-val="-h8">�Ƶ�</a>
											<a  href="javascript:void(0)" data-val="-h9">��ҵ�ز�</a>
												</div>
		</div>
		<div id="jg">
			<span>�۸�Χ</span>
			<div>
				<a href="javascript:void(0)" data-val="">ȫ��</a>
											<a  href="javascript:void(0)" data-val="-g1">10000Ԫ����</a>
											<a  href="javascript:void(0)" data-val="-g2">10000-15000Ԫ</a>
											<a  href="javascript:void(0)" data-val="-g3">15000-20000Ԫ</a>
											<a  href="javascript:void(0)" data-val="-g4">20000-30000Ԫ</a>
											<a  href="javascript:void(0)" data-val="-g5">30000-400000Ԫ</a>
											<a  href="javascript:void(0)" data-val="-g6">40000Ԫ����</a>
												</div>
		</div>
		<input type="text" value="������ؼ��֣�¥����/��ַ��" data-val="������ؼ��֣�¥����/��ַ��">
		<button> </button>
	</div>
	<div id="indexMenu"> 
		<em class="r2"></em>
		<div id="newMenu">
	<a href="javascript:void(0)" class="fir">��վ����</a>
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
				<a href="<?php echo catlink(53);?>" target="_self" >��ҳ<em></em></a>
			</li>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fe7335ff0b124cdf7b46503d50f305a1&action=category&catid=53&num=7&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'53','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'7',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li>
				<a href=<?php echo $r['url'];?>><?php echo $r['catname'];?><em></em></a>
            </li>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?> 
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","searchhouselist"],function($){
		$("#Search").hSearch("http://house.inhe.net/xinfang/list","http://house.inhe.net/xinfang/ajax/house.html")//ǰ����������ַ��������ajax��ѯ����api
	})
</script>   
<!--���� end -->

<!-- ͷ�� ���� -->
<div class="Hspace10"></div>
<div class="wrapper yahei">
  <div class="clr">
    <div class="w469 mr10">
        <div class="focus">
               <!--ͼƬ�б�-->
            <ul class="picrslides picrslides1" style="max-width: 474px;">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fe3b5a0fba17671fe0c5154b150652ce&action=position&posid=8&order=listorder+DESC&thumb=1&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'8','order'=>'listorder DESC','thumb'=>'1','limit'=>'5',));}?>
			<?php $i=0?>
			<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
			            <li id="picrslides1_s<?php echo $i;?>" style="display: list-item; float: left; position: relative;" class="picrslides1_on">
			<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><img class="lazy1" src="<?php echo thumb($v[thumb],474,536);?>" data-original="<?php echo thumb($v[thumb],474,536);?>" alt="<?php echo $v['title'];?>" width="474" height="536" style="display: inline-block;"></a></li>
			<?php $i++?>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                     </ul>
		<a href="#" class="picrslides_nav picrslides1_nav prev" style="display: inline; overflow: hidden; height: 1px; margin: 0px; padding: 0px; width: 1px; opacity: 0;">Previous</a><a href="#" class="picrslides_nav picrslides1_nav next" style="display: inline; overflow: hidden; height: 1px; margin: 0px; padding: 0px; width: 1px; opacity: 0;">Next</a>
		<ul class="picrslides_tabs picrslides1_tabs"><li class="picrslides_here"><a href="#" class="picrslides1_s1">1</a></li><li><a href="#" class="picrslides1_s2">2</a></li><li><a href="#" class="picrslides1_s3">3</a></li><li><a href="#" class="picrslides1_s4">4</a></li><li><a href="#" class="picrslides1_s5">5</a></li></ul>
      </div>
     
    </div>
    <div class="w469">
      <div class="w-bg plr18 pt10 pb18 clr" style="height:510px; overflow:hidden;">
        <div class="newsbox">
     <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9067d07f391a4be1011f0cf1e6455287&action=position&posid=11&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'11','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <dl class='topnews'><dt>
		<a target='_blank' href='<?php echo $v['url'];?>' class=' orange' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dt>
		<dd><?php echo str_cut($v[description],80);?>[<a target='_blank' href='<?php echo $v['url'];?>' class='orange' >��ϸ</a>]</dd></dl>
		<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		
<dl class='topnewslist'><dt>��Ѷ</dt>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=63f868cdf7bbff84a787198ac2d108ff&action=lists&catid=54&posids=0&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'54','posids'=>'0','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<dd <?php if($n%2==0) { ?><?php } else { ?>class='mr4'<?php } ?>><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dd>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</dl>

<dl class='topnewslist'><dt>�ȵ�</dt>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0283dd6405f84c610979f5492884d91e&action=lists&catid=55&posids=0&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'55','posids'=>'0','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<dd <?php if($n%2==0) { ?><?php } else { ?>class='mr4'<?php } ?>><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dd>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</dl>

<dl class='topnewslist'><dt>��̸</dt>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=b455ae9d31f2f77ba736d0c15e7b9160&action=lists&catid=56&posids=0&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'56','posids'=>'0','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<dd <?php if($n%2==0) { ?><?php } else { ?>class='mr4'<?php } ?>><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dd>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</dl>

<dl class='topnewslist'><dt>����</dt>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fb4d05df197f70d276e6bf850d56663a&action=lists&catid=57&posids=0&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'57','posids'=>'0','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<dd <?php if($n%2==0) { ?><?php } else { ?>class='mr4'<?php } ?>><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dd>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</dl>

<dl class='topnewslist'><dt>��ˮ</dt>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c0204bf2009f9ddf41733132b80f8f72&action=lists&catid=59&posids=0&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'59','posids'=>'0','order'=>'listorder DESC','limit'=>'2',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<dd <?php if($n%2==0) { ?><?php } else { ?>class='mr4'<?php } ?>><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dd>
<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</dl>
        </div>
        <div class="pt18">
          <div class="title-line">
            <h2>��ҵ��Ѷ</h2>
            <a target="_blank" href="<?php echo catlink(54);?>" class="more">����</a> </div>
          <div class="infobox">
          <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1273dfabee74d19334b507b384705ecc&action=lists&catid=54&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'54','thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <dl><dt><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></dt><dd class='pic'><a href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>' target='_blank'><img class='lazy' src='<?php echo thumb($v[thumb],95,95);?>' data-original='<?php echo thumb($v[thumb],95,95);?>' alt='<?php echo $v['title'];?>' /></a></dd>
			<dd><?php echo str_cut($v[description],80);?>[<a target='_blank' href='<?php echo $v['url'];?>' class='orange' title='<?php echo $v['title'];?>'>��ϸ</a>] </dd></dl>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6dff83ecc83940fa56b703e1705ac991&action=lists&catid=54&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'54','order'=>'listorder DESC','limit'=>'5',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
			<li><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></li>
			<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="Hspace10"></div>
  <div id="goodinfo_1244" class="topadbox">
  <!-- �˴��Ź�� -->
    </div>
  <div class="w-bg clr plr18 pt10 pb18">
    <div class="title-i">
      <h2><?php echo catname(114);?></h2>
      <a target="_blank" href="<?php echo catlink(114);?>" class="more">����</a> </div>
    <div class="photoWall" id="photoWall01">
      <ul>
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0e16886146b99999e45b67c0e76b699b&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li class='picBorder02'><div class='p1'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],234,364);?>' alt='' height='364' width='234' /></a><p style='top: -364px;' class='photo_info'><a style='bottom: -335px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div></li>
		<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<li class='picBorder02'>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c833301fc4f802d54066cd8bb2423c53&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=2%2C1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
		<div class='p3'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],157,180);?>' alt='' height='180' width='157' /></a><p style='top: -180px;' class='photo_info'><a style='bottom: -163px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div><?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<span class='picHr'></span>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=d708db9b50865af28ca2be6b13ba2132&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=3%2C1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
		<div class='p4'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],157,182);?>' alt='' height='182' width='157' /></a><p style='top: -60px;' class='photo_info'><a style='bottom: -165px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div><?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</li>

		<li class='picBorder02'>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=177ef7a478f8919255db4a0a6af21ed1&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=4%2C1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
		<div class='p5'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],180,280);?>' alt='' height='180' width='280' /></a><p style='top: -180px;' class='photo_info'><a style='bottom: -163px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div><?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		
		<span class='picHr'></span>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f457730cc3e8804a0d28082ce1e19d99&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=5%2C1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
		<div class='p6'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],182,280);?>' alt='' height='182' width='280' /></a><p style='top: -182px;' class='photo_info'><a style='bottom: -165px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div><?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</li>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=5affd1de3b82249e4d1c9ec0028b55b6&action=lists&catid=114&thumb=1&order=listorder+DESC&limit=6%2C1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'114','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
		<li><div class='p1'> <a href='<?php echo $v['url'];?>' target='_blank' title=''><img src='<?php echo thumb($v[thumb],234,364);?>' alt='' height='364' width='234' /></a><p style='top: -364px;' class='photo_info'><a style='bottom: -347px;' href='<?php echo $v['url'];?>' target='_blank' title=''><?php echo $v['title'];?></a></p></div></li><?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
      </ul>
    </div>
  </div>
  <div class="Hspace10"></div>
  <div class="clr">
    <div class="w683 w-bg mr10">
      <div class="w-bg clr" style="height:290px; overflow:hidden;">
        <div class="title-i plr18  pt10">
          <h2><?php echo catname(56);?></h2>
          <a target="_blank" href="<?php echo catlink(56);?>" class="more">����</a></div>
        <ul class="peoplelist">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=cb043b7a63b6e0986a9877b41e98bd0e&action=lists&catid=56&thumb=1&order=listorder+DESC&limit=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'56','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
          <li><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><img class='lazy' src='<?php echo thumb($v[thumb],148,197);?>' data-original='<?php echo thumb($v[thumb],148,197);?>'/></a><span><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></span></li>
		<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
      </div>
    </div>
    <div class="w255">
      <div class="w-bg plr18 pt10 pb18" style="height:262px; overflow:hidden;">
        <!-- ��� -->
    </div>
  </div>
  <div class="Hspace10"></div>
  <div class="clr w-bg">
     <div class="title-i plr18 pt10">
      <h2><?php echo catname(59);?></h2>
      <a target="_blank" href="<?php echo catlink(59);?>" class="more">����</a> </div>
      <ul class="shoplist">
	  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=87e5533094ed017d4ffe39aab5083e9f&action=lists&catid=59&thumb=1&order=listorder+DESC&limit=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'59','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
           <li><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><img class='lazy' src='<?php echo thumb($v[thumb],148,197);?>' data-original='<?php echo thumb($v[thumb],148,197);?>'/></a><span><a target='_blank' href='<?php echo $v['url'];?>' title='<?php echo $v['title'];?>'><?php echo $v['title'];?></a></span></li>
		<?php $n++;}unset($n); ?> <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></ul>
  </div>
   <div class="Hspace10"></div>
 <script type="text/javascript">
    var web_url = 'http://find.letfind.com.cn/shop/index.aspx?cid=591';
    var cache = '/shop/cache/index/';
    var new_name = 'index_591';
    var page_type = 1;
    var handurl = 'http://shop.letfind.com.cn/';
    $("img.lazy").lazyload();
    //��Ƭǽ��� ��Ҫ���seekDom.JS�ļ�
    function disInfo(parentObj, direction) {

        var wallObj = getId(parentObj);
        var infos = getTag(wallObj, "p");
        var imgList = getTag(wallObj, "div");
        for (var i = 0; i < infos.length; i++) {
            if (direction == "up") {

                infos[i].onTar = infos[i].parentNode.offsetHeight - infos[i].offsetHeight;
                infos[i].outTar = infos[i].parentNode.offsetHeight;
                infos[i].style.top = infos[i].parentNode.offsetHeight + "px";
                infos[i].childNodes[0].style.top = 5 + "px";
            }
            else if (direction == "down") {
                infos[i].onTar = -(infos[i].parentNode.offsetHeight - infos[i].offsetHeight);
                infos[i].outTar = -infos[i].parentNode.offsetHeight;
                infos[i].style.top = -infos[i].parentNode.offsetHeight + "px";
                infos[i].childNodes[0].style.bottom = -infos[i].offsetHeight + infos[i].childNodes[0].offsetHeight + 5 + "px";
            }
            else {
                infos[i].onTar = infos[i].parentNode.offsetHeight - infos[i].offsetHeight;
                infos[i].outTar = infos[i].parentNode.offsetHeight;
                infos[i].style.top = infos[i].parentNode.offsetHeight + "px";
                infos[i].childNodes[0].style.top = 5 + "px";
            }
        }
        for (var i = 0; i < infos.length; i++) {
            imgList[i].index = i;
            imgList[i].onmouseover = function () {
                this_ = this;
                toDrag(infos[this_.index], infos[this_.index].onTar);
            }
            imgList[i].onmouseout = function () {
                var this_ = this;
                toDrag(infos[this_.index], infos[this_.index].outTar);
            }
        }
        function toDrag(thisObj, tar) {
            thisObj.speed = thisObj.offsetTop;
            if (thisObj.timer) { clearInterval(thisObj.timer); }
            thisObj.timer = setInterval(function () {
                thisObj.a = (tar - thisObj.offsetTop) / 7;
                if (thisObj.offsetTop == tar) { clearInterval(thisObj.timer); }
                else {
                    thisObj.a > 0 ? thisObj.speed += Math.ceil(thisObj.a) : thisObj.speed += Math.floor(thisObj.a);
                    thisObj.style.top = thisObj.speed + "px";
                }
            }, 25);
        }
    }
    disInfo("photoWall01", "down"); //Ϊ"up"ʱ�����Ϸ�����Ϊ"down"ʱ�����·��� ����Ĭ��Ϊ���ϣ��������δ��ʱ��
//����ͼ
$(document).ready(function(){
		//��һ��ͼƬ����
		$(".focus").hover(function(){$(".picrslides_nav").show(100)},function(){$(".picrslides_nav").hide(100)})
		//myFocus.set({
		//	id:'myFocus',//ID
	     // 	pattern:'mF_fancy'//���
          //          });
	 
});




      </script>
 </div>
 	<?php include template("content","footer"); ?>
</body>
</html>