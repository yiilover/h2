<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>	<?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo APP_PATH;?>statics/default/about/css/about.css" />
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/lib/jquery.min.js"></script>
</head>
<body>
<div class="headbox">
	<div class="head">
		<div class="logo"><a href="/"><img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" /></a></div>
		<div class="logo_right">
			<a href="<?php echo siteurl($siteid);?>">首页</a> | <a href="<?php echo APP_PATH;?>login.html">登录</a> | <a href="<?php echo APP_PATH;?>register.html">注册</a>
		</div>
		<div class="clear"></div>
		<div class="nav">
			<ul>
			<?php $n=1;if(is_array($arrchild_arr)) foreach($arrchild_arr AS $cid) { ?>
                <li<?php if($catid==$cid) { ?> class="hover"<?php } ?>><a href="<?php echo $CATEGORYS[$cid]['url'];?>"><?php echo $CATEGORYS[$cid]['catname'];?></a></li>
			<?php $n++;}unset($n); ?>
			
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="content1"><?php echo $title;?></div>
<div class="content2">
	<div class="content2_div"><div class="Section0" style="layout-grid:  15.6pt none">

  <?php echo $content;?>

</div>
<!--EndFragment--></div>
</div>
<div class="content3">
	<div class="content3_box"></div>
</div>
<?php include template("content","footer"); ?>
</body>
</html>
