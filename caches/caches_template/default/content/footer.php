<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><SCRIPT type=text/javascript src="<?php echo APP_PATH;?>statics/default/js/index/scrolltop.js"></SCRIPT>
<style>
fieldset,img{border:0 none;}
:focus{outline:0;}
.gg_full {
	POSITION: relative; MARGIN: 0px auto; WIDTH: 960px;background:#e8e8e8
}
.gg_full .gg_fbtn {
	POSITION: absolute; WIDTH: 19px; DISPLAY: none; HEIGHT: 55px; TOP: 10px; right: -23px
}
.gg_full .gg_fbtn A {
	DISPLAY: block; BACKGROUND: url(/statics/default/img/index/gg_btn.png) no-repeat 0px 0px; HEIGHT: 55px; OVERFLOW: hidden
}
.gg_full .gg_fbtn .gg_fclose {
	BACKGROUND: url(/statics/default/img/index/gg_btn.png) no-repeat -19px 0px
}
.gg_full .gg_fcon {
	DISPLAY: none; HEIGHT: 420px;
}
#goTopBtn {
	POSITION: fixed; TEXT-ALIGN: center; LINE-HEIGHT: 30px; WIDTH: 49px; BOTTOM: 35px; HEIGHT: 67px; FONT-SIZE: 12px; CURSOR: pointer; _position: absolute; _right: auto
}

.footer{width:100%; background-color:#f4f9ff; margin-top:30px; border-top:1px solid #dbe7ed;}

.footer .info{width:960px; margin:0 auto; border-top:1px solid #dbe7ed;}

.footer .info{color:#666; line-height:24px;text-align:center;  margin-top:15px; }

.footer .info .info_link{width:960px; margin:0 auto; border-top:1px solid #FFF; }

.footer .info a{color:#666;}

.footer img{display:inline;}
-->
</style>
<center>
<div class="footer">
<div class="info">
<!-- 返回顶部 made in winbug_lee -->
<DIV style="DISPLAY: none" id=goTopBtn><IMG border=0 src="<?php echo APP_PATH;?>statics/default/img/index/lanren_top.jpg"></DIV>
<SCRIPT type=text/javascript>goTopEx();</SCRIPT>
<div class="info_link">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7554398d30ea32e64da5e166d9df130d&action=category&catid=1&num=15&siteid=%24siteid&order=listorder+ASC&cache=172800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC',)).'7554398d30ea32e64da5e166d9df130d');if(!$data = tpl_cache($tag_cache_name,172800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['catname'];?></a><?php if($n<count($data)) { ?> |<?php } ?>    
<?php $n++;}unset($n); ?>
| <a href="<?php echo APP_PATH;?>sitemap.html" target="_blank">网站地图</a>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<br />
<?php echo $copyright;?> <img src="<?php echo APP_PATH;?>statics/default/img/index/copyright.gif"/>&copy;&nbsp;Powered by <A href="http://www.house5.net/" target="_blank">House5</A>
</div>
<br /><br />
<img src="<?php echo APP_PATH;?>statics/default/img/index/beian.gif" width="120" height="50"  style="display: inline; ">&nbsp;<img src="<?php echo APP_PATH;?>statics/default/img/index/baojing.gif" width="120" height="50" style="display: inline; ">&nbsp;<img src="<?php echo APP_PATH;?>statics/default/img/index/jubao.gif" width="120" height="50" style="display: inline; ">
</div>
</div>
</center>
<script type="text/javascript">

$(function(){

	$(".picbig").each(function(i){

		var cur = $(this).find('.img-wrap').eq(0);

		var w = cur.width();

		var h = cur.height();

	   $(this).find('.img-wrap img').LoadImage(true, w, h,'<?php echo IMG_PATH;?>msg_img/loading.gif');

	});

})

</script>
</body>
</html>