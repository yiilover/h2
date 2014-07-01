<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta name="author" content="house5">
<link href="<?php echo APP_PATH;?>statics/house5-style1/index/css/reset.css"  rel="stylesheet" type="text/css"/>
<link href="<?php echo APP_PATH;?>statics/house5-style1/index/css/index.css" rel="stylesheet" type="text/css" />
<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
<script language="javascript">
var mobiles = new Array
            (
                "midp", "j2me", "avant", "docomo", "novarra", "palmos", "palmsource",
                "240x320", "opwv", "chtml", "pda", "windows ce", "mmp/",
                "blackberry", "mib/", "symbian", "wireless", "nokia", "hand", "mobi",
                "phone", "cdm", "up.b", "audio", "sie-", "sec-", "samsung", "htc",
                "mot-", "mitsu", "sagem", "sony", "alcatel", "lg", "eric", "vx",
                "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch",
                "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi",
                "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo",
                "sgh", "gradi", "jb", "dddi", "moto", "iphone", "android",
                "iPod", "incognito", "webmate", "dream", "cupcake", "webos",
                "s8000", "bada", "googlebot-mobile"
            )
var ua = navigator.userAgent.toLowerCase();
    var isMobile = false;
    for (var i = 0; i < mobiles.length; i++) {
        if (ua.indexOf(mobiles[i]) > 0) {
            isMobile = true;
                        location.href = "<?php echo $wap_siteurl;?>";
        }
    }
</script>
</head>
<body>
	<div id="main">




		<div id="topBar">
			<div class="fl">
			</div>
			<div class="fr">
				<div class="panl" id="topBarPanl">
				  快速连接
					<i></i>
					<div>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>">新房</a>
                        <a target="_blank" href="<?php echo catlink(6);?>" rel="nofollow"><?php echo catname(6);?></a>
						<a target="_blank" href="<?php echo ESF_PATH;?>" rel="nofollow">二手房</a>
                        <a target="_blank" href="<?php echo ESF_PATH;?>rent-list.html" rel="nofollow">地图</a>
                        <a target="_blank" href="<?php echo catlink(53);?>" rel="nofollow"><?php echo catname(53);?></a>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>list-t6.html" rel="nofollow">别墅</a>
						<a target="_blank" href="<?php echo TUAN_PATH;?>" rel="nofollow">看房团</a>
						 <a target="_blank" href="<?php echo BBS_PATH;?>" rel="nofollow">业主论坛</a>
						<a target="_blank" href="<?php echo APP_PATH;?>wenfang-p1.html" rel="nofollow">问房</a>
						
					</div>
				</div>
			<span>网站热线:0701-5366533</span>
				<a href="<?php echo ESF_PATH;?>chushou.html" class="send" target="_blank">个人免费发布房源</a>
			</div>
		</div>
		<script type="text/javascript">
			seajs.use(["jquery","topbarlogin"],function($,login){
				login("<?php echo APP_PATH;?>index.php?s=member/index/loginbar")
				$("#topBarPanl").hover(function(){
					$(this).find("div").show()
				},function(){
					$(this).find("div").hide()
				})
			})
		</script>
		<div class="header">
			<h1><a href="<?php echo siteurl($siteid);?>" target="_blank"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" alt="<?php echo $cha['skinid'];?>"></a>
			<a href="<?php echo siteurl($siteid);?>" target="_blank"></a></h1>
			
            <div id="Search">
                <ul class="searchURL">
                    <li class="on"><a href="<?php echo HOUSE_PATH;?>" target="_blank">新房</a></li>
                    <li><a href="<?php echo ESF_PATH;?>" target="_blank">二手房</a></li>
                    <li><a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">出租房</a></li>
                    <li><a href="<?php echo catlink(6);?>" target="_blank">资讯</a></li>
                    <li><a href="<?php echo BBS_PATH;?>" target="_blank">论坛</a></li>
                </ul>
                <a href="<?php echo APP_PATH;?>map/" class="map" target="_blank">地图找房</a>
                <form action="<?php echo HOUSE_PATH;?>list.html" id="xinfang">
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>区域/环线</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部区县</a>
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>项目类型</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
                           <?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a data-val="-t<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
                        </div>
                    </div>
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>价格范围</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
		<?php $range_arr = getbox_name('13','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az新首页 搜索-新房价格-->
                        </div>
                    </div>
                    <input type="text" id="xfinput" value="输入关键词" data-url="<?php echo HOUSE_PATH;?>list">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo ESF_PATH;?>list.html" style="display:none" method="post" target="_blank">
                    <div class="scp">
                        <input type="hidden" name="place">
                        <span>区域/地铁</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部区县</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="area">
                        <span>面积</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
	<?php $area_range_arr = getbox_name('39','area_range')?>
		<?php $n=1; if(is_array($area_range_arr)) foreach($area_range_arr AS $key => $v) { ?>
			 <a data-val="-c<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az新首页 搜索-二手房面积-->
                        </div>
                    </div>
                    <div class="scp" style="width:80px">
                        <input type="hidden" name="price">
                        <span>价格范围</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
	<?php $range_arr = getbox_name('39','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az新首页 搜索-二手房出售价格-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="room">
                        <span>户型</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
                              <a data-val="1" href="javascript:void(0)" >一室</a>
  <a data-val="2" href="javascript:void(0)" >二室</a>
  <a data-val="3" href="javascript:void(0)" >三室</a>
  <a data-val="4" href="javascript:void(0)" >四室</a>
  <a data-val="5" href="javascript:void(0)" >其它</a>
<!--az新首页 搜索-二手房户型-->
                        </div>
                    </div>
                    <input type="text" id="esfinput" name="keyword" value="请输入关键字">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo ESF_PATH;?>rent-list.html" style="display:none" method="post" target="_blank">
                    <div class="scp">
                        <input type="hidden" name="place">
                        <span>区域/地铁</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部区县</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<!--az新首页 搜索-非新房区域-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="area">
                        <span>面积</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
	<?php $area_range_arr = getbox_name('41','area_range')?>
		<?php $n=1; if(is_array($area_range_arr)) foreach($area_range_arr AS $key => $v) { ?>
			 <a data-val="-c<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az新首页 搜索-二手房面积-->
                        </div>
                    </div>
                    <div class="scp" style="width:80px">
                        <input type="hidden" name="price">
                        <span>价格范围</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
<?php $range_arr = getbox_name('41','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az新首页 搜索-二手房出租价格-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="room">
                        <span>户型</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">全部</a>
                              <a data-val="1" href="javascript:void(0)" >一室</a>
  <a data-val="2" href="javascript:void(0)" >二室</a>
  <a data-val="3" href="javascript:void(0)" >三室</a>
  <a data-val="4" href="javascript:void(0)" >四室</a>
  <a data-val="5" href="javascript:void(0)" >其它</a>
<!--az新首页 搜索-二手房户型-->
                        </div>
                    </div>
                    <input type="text" id="czfinput" value="请输入关键字（楼盘名或地名）" name="keyword">
                    <button type="submit"> </button>
                </form>
               
                <form action="<?php echo APP_PATH;?>index.php" style="display:none" id="zixun" method="GET" target="_blank">
                   <input type="hidden" name="s" value="search/index/init/siteid/1/">
                  <input type="hidden" name="typeid" value="1">
                    <input name="q" class="l" type="text" value="请输入关键字">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo BBS_PATH;?>search.php" style="display:none" id="luntan" method="get" target="_blank" onSubmit="document.charset='gbk';" accept-charset="gbk">
                    <div class="scp">
				        <input type="hidden" name="searchsubmit" value="yes">
                        <input type="hidden" name="mod" value="forum">
                        <span>搜索类型</span>
                        <div>
                            <a data-val="forum" href="javascript:void(0)">不限</a>
                            <a data-val="thread" href="javascript:void(0)">帖子</a>
                            <a data-val="forum" href="javascript:void(0)">版块</a>
                            <a data-val="user" href="javascript:void(0)">用户</a>
                        </div>
                    </div>
                    <input type="hidden" name="searchsubmit" value="yes">
                    <input class="m" type="text" value="请输入关键字" name="kw">
                    <button type="submit"> </button>
                </form>
            </div>
            <script type="text/javascript">
                seajs.use(["jquery","autab","autoc"],function($){
                    $("#Search").autab("li","form",0,0.4).find("div.scp").hover(function(){
                        $(this).addClass("on")
                    },function(){
                        $(this).removeClass("on")
                    }).on("click","a",function(){
                        var $t=$(this).parent().parent()
                        $t.removeClass("on");
                        $t.find("span").html($(this).text())
                        $t.find("input").val($(this).attr("data-val"))
                    });
                    $("#Search input").each(function(){
                        var $t=$(this);
                        var ht=$t.val();
                        $t.on("focus",function(){
                            if($t.val()==ht)
                                $t.val("");
                        }).on("blur",function(){
                            if($t.val()=="")
                                $t.val(ht);
                        }).data("val",$t.val());
                    }).parent().submit(function(){
                        var $t=$(this).find(":text");
                        if($t.val()==$t.data("val")){
                            $t.val("");
                        }
                    })
					$("#luntan,#zixun").unbind("submit").submit(function(){
                        var $t=$(this).find(":text");
                        if($t.val()==$t.data("val")){
                            $t.focus();
                            return false;
                        }
                    })
                    $("#xinfang").unbind("submit").submit(function(){
                        var str="",$s=$(this).find("div.scp input"),$t=$(this).find(":text");
                        $s.each(function(){
                            str+=$(this).val();
                        })
                        if($t.val()!=$t.data("val"))
                            str+="-K"+$t.val();
                        window.open($t.attr("data-url")+str+".html");
                        return false;
                    })
					$("#xfinput").autoC("<?php echo APP_PATH;?>api.php?op=house");
					$("#czfinput").autoC("<?php echo APP_PATH;?>api.php?op=esfsuggest");
					$("#esfinput").autoC("<?php echo APP_PATH;?>api.php?op=esfsuggest");
                })
            </script>
		</div>
		
		<div class="conb menu cf">
			<p>
    <a href="<?php echo HOUSE_PATH;?>" target="_blank"><b>新房</b></a>
    <a href="<?php echo catlink(26);?>" target="_blank">预告</a>
    <a href="<?php echo TUAN_PATH;?>" target="_blank">看房团</a>
    <a href="<?php echo catlink(29);?>" target="_blank">优惠</a>
    <a href="<?php echo HOUSE_PATH;?>baojia.html" target="_blank">房价</a>
    <a href="<?php echo catlink(6);?>special/" target="_blank">专题</a><br>
    <a href="<?php echo catlink(40);?>" target="_blank"><b>热点</b></a>
    <a href="<?php echo siteurl($siteid);?>/map/" target="_blank">地图</a>
    <a href="<?php echo HOUSE_PATH;?>list-t7.html" target="_blank">写字楼</a>
    <a href="<?php echo HOUSE_PATH;?>list-t9.html" target="_blank">公寓</a>
    <a href="<?php echo HOUSE_PATH;?>list-t8.html" target="_blank">商铺</a>
    <a href="<?php echo HOUSE_PATH;?>list-t6.html" target="_blank">别墅</a>
</p>
<p>
    <a href="<?php echo ESF_PATH;?>" target="_blank"><b>二手房</b></a>
    <a href="<?php echo ESF_PATH;?>list-h1.html" target="_blank">新售</a>
    <a href="<?php echo ESF_PATH;?>list-h3.html" target="_blank">急售</a>
    <a href="<?php echo ESF_PATH;?>map.html" target="_blank">地图</a>
    <a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank">经纪人</a><br>
    <a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank"><b>出租房</b></a>
    <a href="<?php echo ESF_PATH;?>rent-list-h1.html" target="_blank">新租</a>
    <a href="<?php echo ESF_PATH;?>rent-list-h3.html" target="_blank">急租</a>
    <a href="<?php echo ESF_PATH;?>rent-list-l2.html" target="_blank">合租</a>
    <a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank">个　人</a>
</p>
<p>
    <a href="<?php echo catlink(6);?>" target="_blank"><b>资讯</b></a>
    <a href="<?php echo catlink(25);?>" target="_blank">本地</a>
    <a href="<?php echo catlink(16);?>" target="_blank">全国</a>
    <a href="<?php echo catlink(30);?>" target="_blank">市场</a><br>
    <a href="<?php echo catlink(27);?>" target="_blank"><b>行情</b></a>
    <a href="<?php echo catlink(33);?>" target="_blank">土地</a>
    <a href="<?php echo catlink(32);?>" target="_blank">招聘</a>
    <a href="<?php echo catlink(80);?>" target="_blank">数据</a>
</p>
<p>
    <a href="<?php echo catlink(53);?>" target="_blank"><b>家居</b></a>
    <a href="<?php echo catlink(57);?>" target="_blank">促销</a>
    <a href="<?php echo catlink(56);?>" target="_blank">团购</a>
    <a href="<?php echo catlink(58);?>" target="_blank">百科</a><br>
    <a href="<?php echo catlink(59);?>" target="_blank"><b>家装</b></a>
     <a href="<?php echo catlink(114);?>" target="_blank">装修</a>
    <a href="<?php echo catlink(55);?>" target="_blank">热点</a>
    <a href="<?php echo catlink(56);?>" target="_blank">图库</a><!--图库ID 未定-->
</p>
<p class="nob">
    <a href="<?php echo BBS_PATH;?>" target="_blank"><b>互动</b></a>
    <a href="<?php echo HOUSE_PATH;?>qqqun-p1.html" target="_blank">业主QQ群</a>
    <a href="<?php echo HOUSE_PATH;?>wenfang-p1.html" target="_blank">问房</a><br>
    <a href="<?php echo BBS_PATH;?>" target="_blank"><b>业主</b></a>
     <a href="<?php echo siteurl($siteid);?>/tools/fdjsq.html" target="_blank">工具</a>
    <a href="<?php echo siteurl($siteid);?>/one.html" target="_blank">一分钟找房</a>
</p><!--az新首页 导航-->
		</div>

		<div class="adb cf"><!-- [新1]首页-通栏6 -->
		<div class="mt2"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=31"></script></div></div>
		<div class="cona">
			<div class="conaT">
				<div class="conaTT">
					<img src="<?php echo APP_PATH;?>statics/house5-style1/index/img/xf.png" alt="" class="fl">
					<a href="<?php echo HOUSE_PATH;?>" target="_blank">新房首页</a>|<a href="/map" target="_blank">地图找房</a>|<a href="<?php echo HOUSE_PATH;?>baojia.html" target="_blank">楼盘报价</a>|<a href="/special/" target="_blank">买房专题</a>|<a href="<?php echo catlink(49);?>" target="_blank"><?php echo catname(49);?></a>|<a href="<?php echo catlink(27);?>" target="_blank"><?php echo catname(27);?></a>|<a href="<?php echo catlink(29);?>" target="_blank"><?php echo catname(29);?></a>|<a href="<?php echo HOUSE_PATH;?>hxlist.html" target="_blank">户型图</a>|<a href="/tools/fdjsq.html" target="_blank">房贷计算器</a>|<a href="<?php echo HOUSE_PATH;?>qqqun-p1.html" target="_blank">业主QQ群</a></div>
				<div class="xfs">
					<span>首字母：</span>
<span>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-a.html">A</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-b.html">B</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-c.html">C</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-d.html">D</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-e.html">E</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-f.html">F</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-g.html">G</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-h.html">H</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-i.html">I</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-j.html">J</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-k.html">K</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-l.html">L</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-m.html">M</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-n.html">N</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-o.html">O</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-p.html">P</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-q.html">Q</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-r.html">R</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-s.html">S</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-t.html">T</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-u.html">U</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-v.html">V</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-w.html">W</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-x.html">X</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-y.html">Y</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>zimu-z.html">Z</a>
</span>
<span>装修状况：</span>
<?php $fix_arr = getbox_name('13','fix')?>
<?php $n=1; if(is_array($fix_arr)) foreach($fix_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'f');?>-f<?php echo $key;?>.html"><?php echo $v;?></a><?php $n++;}unset($n); ?>
<br>
<span>所在区域：</span>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee3a82b09698607383a5d01b0653d667&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r)?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<span>楼盘特色：</span>
<?php $type_arr = getbox_name('13','character')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a href="<?php echo HOUSE_PATH;?>list-l<?php echo $key;?>.html" val="-l<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?><br>
<span>销售单价：</span>
<?php $range_arr = getbox_name('13','range')?>
<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-p<?php echo $key;?>.html" val="-p<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
<br>
<span>楼盘类型：</span>
<?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-t<?php echo $key;?>.html" val="-t<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
<br>
<span>开盘时间：</span>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o1.html">本月开盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o2.html">下月开盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o3.html">3月内开盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o4.html">6月内开盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o5.html">前3月已开盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o6.html">前6月已开盘</a>
<span style="color:#F00"><B>楼盘状态：</B></span>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h2.html">在售楼盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h3.html">即将上市</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h1.html">尾盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h4.html">热门楼盘</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h6.html">精品楼盘</a><!--az新首页 2新房搜索-->
				</div>
			</div>
			<div class="conab cf">
				<div class="conaL">
					<div id="tab41">
						<h4><a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank" class="more">更多&gt;&gt;</a>
							<a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank" class="h4tab on"><span>热点楼盘</span></a>
							<a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank" class="h4tab"><span>精品楼盘</span></a></h4>
						<div class="autab">
							<div class="bl ibA cf mb2">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=de1a50556d08395f50f47eea984eccb9&action=lists&catid=14&where=hot+like+%27%254%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%4%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>">
                <img src="<?php echo thumb($v[thumb],100,53);?>" alt="<?php echo $v['title'];?>">
                <span><?php echo $v['title'];?></span>
            </a>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=df187ef318aaa425a3a7a698402da504&action=lists&catid=14&where=hot+like+%27%254%25%27+&order=listorder+DESC&limit=3%2C7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%4%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>
            <tr>
            <td width="56"><span>[<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr>  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
              
        </table>

<!--az新首页 2热点楼盘-->
						</div>
						<div class="autab" style="display:none">
							<div class="bl ibA cf mb2">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8d58e5cc3001046afe77b515544a52ca&action=lists&catid=14&where=hot+like+%27%256%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>">
                <img src="<?php echo thumb($v[thumb],100,53);?>" alt="<?php echo $v['title'];?>">
                <span><?php echo $v['title'];?></span>
            </a>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az新首页 2特价房源|图-->
							</div>
							<table>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fe2fd720882dba5a1caf319e7482d3e7&action=lists&catid=14&where=hot+like+%27%256%25%27+&order=listorder+DESC&limit=3%2C7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>
            <tr>
            <td width="56"><span>[<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr>  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table><!--az新首页 2特价房源|列表-->
						</div>
					</div>
					<div id="tab12">
					<h4 class="mt10">
                                                <a href="<?php echo HOUSE_PATH;?>list-l6.html" target="_blank" class="h4tab on"><span>投资楼盘</span></a>
						<a href="<?php echo HOUSE_PATH;?>list-l8.html" target="_blank" class="h4tab"><span>经济楼盘</span></a></h4>
						
					<div class="tabToplist">
<!--az新首页 2周点击排行-->
						<table>
 	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=61b0f402aa661ef20c6c08d3921047e7&action=lists&catid=14&where=%60character%60+like+%27%256%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`character` like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

    <tr>
            <td width="56"><span><a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
    </tr>
     <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table>


                    	<table style="display:none">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=cac5dd2a12bc981bc4942ca93566db86&action=lists&catid=14&where=%60character%60+like+%27%258%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`character` like \'%8%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

    <tr>
            <td width="56"><span><a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
    </tr>
     <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table>

<!--az新首页 2周400电话排行-->
					</div>
					</div>
				</div>
				<div class="conaR">
					<div class="conaRC cf">
						<div class="conaRCL">
							<div class="conRT">
								<a href="<?php echo catlink(37);?>" target="_blank" class="more">更多&gt;&gt;</a>
								<h4><a target="_blank" href="<?php echo catlink(37);?>"><?php echo catname(37);?></a></h4>
							</div>
							<ul class="cul">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fa53fbf627a64db545c53ec5add909d8&action=lists&catid=37&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					<li><a target="_blank" <?php echo title_style($v[style]);?>  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
   
</ul><!--az新首页 2新房导购-->
							<div class="conRT mt10">
								<a href="<?php echo catlink(29);?>" target="_blank" class="more">更多&gt;&gt;</a>
								<h4><a target="_blank" href="<?php echo catlink(29);?>"><?php echo catname(29);?></a></h4>
							</div>
							<ul class="cul">
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=521b95d7cb1df0895316f8645208e23e&action=lists&catid=29&moreinfo=1&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','moreinfo'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
								<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								<?php $house_info = get_relationinfo($v[xglp],14,1)?>
    <li><?php if($v[xglp]) { ?><a target="_blank"  title="[<?php echo $house_info['title'];?>] " href="<?php echo $house_info['url'];?>">[<?php echo $house_info['title'];?>] </a><?php } ?><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
   
</ul><!--([新1]首页-新房中心-小广告)广告版位调用-->
<ul class="mt5"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=204"></script></ul>
						</div>
						<div class="conaRCR">
							<div id="tab13">
								<h4 class="mb10"><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank" class="more">更多&gt;&gt;</a>
									<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank" class="h4tab on"><span>最新楼盘</span></a>
									<a href="<?php echo HOUSE_PATH;?>list-h3.html" target="_blank" class="h4tab"><span>即将上市</span></a></h4>
								<table>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=144ee39ccc4bc6c47b87bcc35a4d27a8&action=lists&catid=14&where=hot+like+%27%255%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%5%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

            <tr>
            <td width="56"><span>[<a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           
    </table>


<!--az新首页 2最新楼盘-->
								<table style="display:none">
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=795b787bcbcae591ea6bb19a3304a515&action=lists&catid=14&where=hot+like+%27%253%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%3%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

            <tr>
            <td width="56"><span>[<a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/㎡<?php } else { ?>待定<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </table>


<!--az新首页 2近期开盘-->
							</div>
							<div id="tab31">
								<h4 class="mt10"><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank" class="more">更多&gt;&gt;</a>                

<a href="<?php echo HOUSE_PATH;?>list-t8.html" target="_blank" class="h4tab on"><span>商铺</span></a>            
<a href="<?php echo HOUSE_PATH;?>list-t7.html" target="_blank" class="h4tab"><span>写字楼</span></a>
<a href="<?php echo HOUSE_PATH;?>list-t6.html" target="_blank" class="h4tab"><span>别墅</span></a>
									
									
								</h4>
														
<div class="ibA cf mb10">
										<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6f8581824f8b34a178abce184145190d&action=lists&catid=14&where=%60type%60+like+%27%258%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%8%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az新首页 3商铺-->
								</div>
<div class="ibA cf mb10" style="display:none">
										<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0eb8af360f8fcc87608b6abe6ace0af3&action=lists&catid=14&where=%60type%60+like+%27%257%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%7%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az新首页 2写字楼-->
								</div>

<div class="ibA cf mb10" style="display:none">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=69f793565b0081024e52cde15ce120f6&action=lists&catid=14&where=%60type%60+like+%27%256%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az新首页 2别墅-->
								</div>
							</div>
							<div id="tab21">
								<h4><a href="<?php echo catlink(6);?>" target="_blank" class="more">更多&gt;&gt;</a>
									<a href="<?php echo catlink(34);?>" target="_blank" class="h4tab on"><span><?php echo catname(34);?></span></a>
									<a href="<?php echo catlink(31);?>" target="_blank" class="h4tab"><span><?php echo catname(31);?></span></a></h4>
								<ul class="cul">
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6c63b949d6743d0ed106eca69e5f8388&action=lists&catid=34&posids=0&order=id+DESC&num=5&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'34','posids'=>'0','order'=>'id DESC',)).'6c63b949d6743d0ed106eca69e5f8388');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','posids'=>'0','order'=>'id DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								 <li><a target="_blank"  title="<?php echo $v['title'];?> " href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
								 </ul><!--az新首页 2购房专题-->
                                <ul class="cul" style="display:none">
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f45cb49a9fed17bcbd2cf4fd075bd923&action=lists&catid=31&posids=0&order=id+DESC&num=5&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'31','posids'=>'0','order'=>'id DESC',)).'f45cb49a9fed17bcbd2cf4fd075bd923');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'31','posids'=>'0','order'=>'id DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								 <li><a target="_blank"  title="<?php echo $v['title'];?> " href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul><!--az新首页 2淘房日记-->
							</div>
						</div>
					</div>
<div class="mt5 fr"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=203"></script></div>
<!--]首页-新房中心右下-->
				</div>
			</div>
		</div>
		<div class="adb cf">
<!--新首页广告 通栏7-->
<div class="mt2"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=31"></script></div>
<div class="mt2"></div><!--新首页广告 通栏7--></div>

		<div class="cona">
			<div class="conaT">
				<div class="conaTT">
					<img src="<?php echo APP_PATH;?>statics/house5-style1/index/img/es.png" alt="" class="fl">
					<a href="<?php echo ESF_PATH;?>list.html" target="_blank">二手房出售</a>|<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">二手房出租</a>|<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank">小区找房</a>|
                    <a href="<?php echo ESF_PATH;?>map.html" target="_blank">地图找房</a>|<a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank">经纪人</a>|<a href="<?php echo catlink(66);?>" target="_blank">二手房资讯</a></div>
			</div>
			<div class="conab cf">
				<div class="conaL">
					<div id="tab22">
						<h4><a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="more">更多&gt;&gt;</a>
							<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>二手房快搜</span></a>
							<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>租房快搜</span></a></h4>
						<ul class="esfs">


	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3361.html">环翠区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3362.html">经区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3363.html">高区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3365.html">荣成市</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3366.html">文登市</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3367.html">乳山市</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3364.html">工业新区</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p1.html" val="-p1">30万以下</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p2.html" val="-p2">30-40万</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p3.html" val="-p3">40-50万</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p4.html" val="-p4">50-60万</a>
		
	
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p5.html" val="-p5">60-80万</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p6.html" val="-p6">80-100万</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p7.html" val="-p7">100-150万</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p8.html" val="-p8">150-200万</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c1.html" val="-c1">70平以下</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c3.html" val="-c3">70-90平</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c4.html" val="-c4">90-120平</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-o120.html" val="-c5">120平以上</a>		
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>list-t1.html" target="_blank">一室</a>
		<a href="<?php echo ESF_PATH;?>list-t2.html" target="_blank">二室</a>
		<a href="<?php echo ESF_PATH;?>list-t3.html" target="_blank">三室</a>
		<a href="<?php echo ESF_PATH;?>list-t4.html" target="_blank">四室</a>
		<a href="<?php echo ESF_PATH;?>list-t5.html" target="_blank">其它</a>
	</li>
</ul><!--az新首页 4二手房快搜-->
						<ul class="esfs"  style="display:none">
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3361.html">环翠区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3362.html">经区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3363.html">高区</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3365.html">荣成市</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3366.html">文登市</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3367.html">乳山市</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3364.html">工业新区</a>
	</li>
	<li class="bl">
        <A href="<?php echo ESF_PATH;?>rent-list-p1.html" target="_blank">500以下</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p3.html" target="_blank">600-700元</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p4.html" target="_blank">700-800元</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p5.html" target="_blank">800-1000元</A>
	</li>
	<li class="bl">
        <A href="<?php echo ESF_PATH;?>rent-list-p6.html" target="_blank">1000-1200元</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p7.html" target="_blank">1200-1500元</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p8.html" target="_blank">1500元以上</A>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c1.html" val="-c1">70平以下</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c3.html" val="-c3">70-90平</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c4.html" val="-c4">90-120平</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-o120.html" val="-c5">120平以上</a>
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>rent-list-t1.html" target="_blank">一室</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t2.html" target="_blank">二室</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t3.html" target="_blank">三室</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t4.html" target="_blank">四室</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t5.html" target="_blank">其它</a>
	</li>
</ul><!--az新首页 4租房快搜-->
					</div>
					<div id="tab23">
						<h4 class="cf"><a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank" class="more">更多&gt;&gt;</a>
							<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank" class="h4tab on"><span>热门小区</span></a>
							<a href="<?php echo ESF_PATH;?>list-h3.html" target="_blank" class="h4tab"><span>急售二手房</span></a></h4>
						<ul class="cul hotli">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f20b08e1f07b89322727f48aa8ba5361&action=lists&catid=110&num=8&order=listorder+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'110','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'8',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>	<?php $menu_info = menu_info('3360',$r[region])?>
            <li>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1d4476d6109efa7faba491db115f470c&action=esfcount&relation=%24r%5Bid%5D&catid=113&return=rentcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$rentcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'113','limit'=>'20',));}?>
            <span class="fr">租<i><?php echo $rentcount;?></i>套</span>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c244456ccc881a34b417f2031b1b656f&action=esfcount&relation=%24r%5Bid%5D&catid=112&return=esfcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$esfcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'112','limit'=>'20',));}?>
			<span class="fr">售<i><?php echo $esfcount;?></i>套</span>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			
			
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
        </li>	<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
    </ul><!--az新首页 4热门小区-->
						<ul class="cul hotli" style="display:none">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4f6ceed923e8385c42d24501cd63bd51&action=lists&catid=112&where=flag+like+%27%253%25%27&num=8&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'flag like \'%3%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'8',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>万</span>
            <span class="fr"><?php echo $r['total_area'];?>㎡</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--az新首页 4热门写字楼-->
					</div>
				</div>
				<div class="conaR">
					<div class="conaRC cf">
						<div class="conaRCL" id="tab42">
							<h4 class="cf"><a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="more">更多&gt;&gt;</a>
								<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>二手房源</span></a>
								<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>出租房源</span></a></h4>
							<div class="autab">
								<div class="ibA bl cf">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=be368e0b2034a122782c267e5b870dfe&action=lists&catid=112&where=flag+like+%27%251%25%27&num=3&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'flag like \'%1%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'3',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $rxq = get_relationxq($r[id],112,110)?>
               <a href="<?php echo $r['url'];?>" target="_blank">
                <img src="<?php echo thumb($rxq[thumb],90,78);?>" alt="<?php echo $rxq['title'];?>">
                <span><?php echo $rxq['title'];?></span>
            </a> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1198622848bbed1d85d4c3ec975ee68f&action=lists&catid=112&num=13&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'13',));}?>
		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><?php $menu_info = menu_info('3360',$r[region])?>
		<?php $rxq = get_relationxq($r[id],112,110)?>
            <tr>
            <td width="56"><span>[<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo $rxq['title'];?></a></span></td>
            <td width="48"><span><?php echo $r['huxingshi'];?>室<?php echo $r['huxingting'];?>厅</span></td>
            <td width="48"><span><?php echo $r['total_area'];?>㎡</span></td>
            <td width="56"><span><?php echo $r['price'];?>万</span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
        </table><!--az新首页 4二手房源-->
							</div>
							<div class="autab" style="display:none">
								<div class="ibA bl cf">
              <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=aabc28dc9055c9936c47bbb83c375e71&action=lists&catid=113&where=flag+like+%27%251%25%27&num=3&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'113','where'=>'flag like \'%1%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'3',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $rxq = get_relationxq($r[id],113,110)?>
               <a href="<?php echo $r['url'];?>" target="_blank">
                <img src="<?php echo thumb($rxq[thumb],90,78);?>" alt="<?php echo $rxq['title'];?>">
                <span><?php echo $rxq['title'];?></span>
            </a> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table>
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=39d53d33eac31abe127936b53c096e85&action=lists&catid=113&num=13&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'113','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'13',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><?php $menu_info = menu_info('3360',$r[region])?>
		<?php $rxq = get_relationxq($r[id],113,110)?>
            <tr>
            <td width="56"><span>[<a href="<?php echo ESF_PATH;?>rent-list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo $rxq['title'];?></a></span></td>
            <td width="48"><span><?php echo $r['huxingshi'];?>室<?php echo $r['huxingting'];?>厅</span></td>
            <td width="48"><span><?php echo $r['total_area'];?>㎡</span></td>
            <td width="56"><span><?php echo $r['price'];?>元/月</span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             
        </table><!--az新首页 4出租房源-->
							</div>
						</div>
						<div class="conaRCR">
							<div id="tab24">
								<h4>
									<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>二手房特色</span></a>
									<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>租房特色</span></a></h4>
									<ul class="esfs">
	<li class="bl">
		<a href="<?php echo ESF_PATH;?>list-f1.html" target="_blank">毛坯</a>
		<a href="<?php echo ESF_PATH;?>list-f2.html" target="_blank">精装</a>
		<a href="<?php echo ESF_PATH;?>list-f3.html" target="_blank">中等装修</a>        
		<a href="<?php echo ESF_PATH;?>list-f4.html" target="_blank">简装</a>
		<a href="<?php echo ESF_PATH;?>list-f5.html" target="_blank">豪华装修</a>
		<a href="<?php echo ESF_PATH;?>list-f6.html" target="_blank">原房</a> 
	</li>
	<li class="bl">
		
		<a href="<?php echo ESF_PATH;?>list-l1.html" target="_blank">6层以下</a>
        <a href="<?php echo ESF_PATH;?>list-l2.html" target="_blank">6-12层</a>
        <a href="<?php echo ESF_PATH;?>list-l3.html" target="_blank">12-20层</a>
        <a href="<?php echo ESF_PATH;?>list-l4.html" target="_blank">20层以上</a>
	</li>
	<li class="bl">
		  <a href="<?php echo ESF_PATH;?>list-y1.html" target="_blank">2000年以前</a>
          <a href="<?php echo ESF_PATH;?>list-y2.html" target="_blank">2000年以后</a>
          <a href="<?php echo ESF_PATH;?>list-y3.html" target="_blank">2005年以后</a>
          <a href="<?php echo ESF_PATH;?>list-y4.html" target="_blank">2010年以后</a>
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="c">不限</a> 
		<a href="<?php echo ESF_PATH;?>list-o2.html" target="_blank">3天内发布</a>
		<a href="<?php echo ESF_PATH;?>list-o3.html" target="_blank">7天内发布</a>
		<a href="<?php echo ESF_PATH;?>list-o4.html" target="_blank">15天内发布</a>
		<a href="<?php echo ESF_PATH;?>list-o5.html" target="_blank">30天内发布</a>
	</li>
</ul><!--az新首页 4写字楼出租快搜-->
									<ul class="esfs" style="display:none">
	<li class="bl">
		        <a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">不限</a> 
				<a href="<?php echo ESF_PATH;?>rent-list-u2.html" target="_blank">中介</a> 
				<a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank">个人</a> 
	</li>
	<li class="bl">
		<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">不限</a>
				                    <a href="<?php echo ESF_PATH;?>rent-list-l1.html" target="_blank">整租</a>
                                	<a href="<?php echo ESF_PATH;?>rent-list-l2.html" target="_blank">合租</a>
                                	<a href="<?php echo ESF_PATH;?>rent-list-l3.html" target="_blank">日租</a>
	</li>
	<li class="bl">
							   		<a href="<?php echo ESF_PATH;?>rent-list-f1.html" target="_blank">毛坯</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f2.html" target="_blank">精装</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f3.html" target="_blank">中等装修</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f4.html" target="_blank">简装</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f5.html" target="_blank">豪华装修</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f6.html" target="_blank">原房</a> 
	</li>
	<li>
	<a href="rent-list-u2.html" target="_blank">不限</a> 
					<a href="<?php echo ESF_PATH;?>rent-list-o2.html" target="_blank">3天内发布</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o3.html" target="_blank">7天内发布</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o4.html" target="_blank">15天内发布</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o5.html" target="_blank">30天内发布</a>
	</li>
</ul><!--az新首页 4写字楼出售快搜-->
							</div>
							<div id="tab25">
								<h4>
									<a href="<?php echo ESF_PATH;?>rent-list-u2.html" target="_blank" class="h4tab on"><span>中介</span></a>
									<a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank" class="h4tab"><span>个人</span></a></h4>
									<ul class="cul hotli">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4a6a0cae8100d691c15ef25d1b52c227&action=lists&catid=112&where=isbroker%3D1&num=6&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'isbroker=1','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'6',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>万</span>
            <span class="fr"><?php echo $r['total_area'];?>㎡</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--az新首页 4商铺出租快搜-->
									<ul class="cul hotli" style="display:none">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=adf95d3c347a8b2007b4dc13e0071353&action=lists&catid=112&where=isbroker%3D0&num=6&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'isbroker=0','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'6',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>万</span>
            <span class="fr"><?php echo $r['total_area'];?>㎡</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul><!--az新首页 4商铺出售快搜-->
							</div>
							<h4><a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank" class="more">更多&gt;&gt;</a><a target="_blank" href="<?php echo ESF_PATH;?>jingjiren/">房产经纪人</a></h4>
							<ul class="cf jjrimg">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=0eaea06bd802853761909dfe5aa29a3d&action=memberlist&type=1&order=point+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'5',));}?>
							<?php $n=1; if(is_array($data['result'])) foreach($data['result'] AS $k => $v) { ?> 
				
    <li>		<a target="_blank" title="<?php echo $v['truename'];?>" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>">
			<img alt="<?php echo $v['truename'];?>" src="<?php echo $avatar;?>" />
		</a>
		<a target="_blank"  title="<?php echo $v['truename'];?>" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>"><?php echo $v['truename'];?></a>
    </li> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
  
</ul><!--az新首页 4优秀经纪人-->
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="adb cf"><div><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=206"></script></div><!--nz新首页广告 通栏9--></div>
		<div class="conb">
			<h3>排行榜</h3>
			<div class="cf toplist">
				<ul class="l">
    <li class="b">一周资讯排行</li>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e71a6e1b6c4e550980dd593104096c64&action=hits&catid=6&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>
				 <ul>
    <li class="b">一周楼盘排行</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6a76a3418858249c852733001bad53b1&action=hits&catid=14&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['views'];?>次</span><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
        </ul>
				<ul>
    <li class="b">一周小区排行</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c8dad494a9fc49415b0fb82eee0c21c5&action=hits&catid=110&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'110','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['views'];?>次</span><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     
    </ul>
				<ul class="l">
    <li class="b">一周团购排行</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=69b4739aa86e69c03ec78d8d7756e1f8&action=toptuangou&years=1&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'toptuangou')) {$data = $content_tag->toptuangou(array('years'=>'1','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['counts'];?>人</span><a target="_blank" title="<?php echo $v['subject'];?>" href="<?php echo HOUSE_PATH;?><?php echo $v['relation'];?>"><?php echo $v['subject'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           
    </ul>
			</div>
		</div>
        <div class="adb cf"><!--nz新首页广告 通栏7--></div>
		<div class="conb">
			<h3>
				<span class="ztControl" id="ztControl">
					<i class="l"></i>
					<i class="on"></i>
					<i></i>
					<i></i>
					<i class="r"></i>
				</span>
			精彩回顾</h3>
			<div class="ztcon ibA">
				<ul id="ztcon">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=93c4e8892c4cf021b0593762985611d3&action=lists&posid=0&catid=6&thumb=1&order=listorder+DESC&num=18\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('posid'=>'0','catid'=>'6','thumb'=>'1','order'=>'listorder DESC','limit'=>'18',));}?>
		 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
	    <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
            <img src="<?php echo thumb($v[thumb],143,108);?>" alt="<?php echo $v['title'];?>" />
            <span><?php echo $v['title'];?></span>
        </a>
    </li>
  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>
<!--az新首页 精彩回顾-->
			</div>
		</div>

<div class="friendslink">
			<h3>合作伙伴</h3>
			<ul class="cf">
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=228c445fc692f915e8591138bcaf272b&action=type_list&typeid=41&siteid=1&linktype=1&order=listorder+DESC&num=18&return=pic_link\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$pic_link = $link_tag->type_list(array('typeid'=>'41','siteid'=>'1','linktype'=>'1','order'=>'listorder DESC','limit'=>'18',));}?> 
            <?php $n=1;if(is_array($pic_link)) foreach($pic_link AS $v) { ?>
			 <li><a target="_blank" href="<?php echo $v['url'];?>"><img width="90" height="40" border="0" alt="<?php echo $v['name'];?>" src="<?php echo $v['logo'];?>"></a></li>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			 </ul>
			 <!--az新首页 合作伙伴-->
		</div>

		

		<div class="friendslink">
			<h3>友情链接</h3>
			<ul class="cf">
			  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=b0f527e540bdf059adc26aad25b4f840&action=type_list&typeid=42&siteid=1&order=listorder+DESC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'42','siteid'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
			   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
 <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['name'];?>" target="_blank"><?php echo $r['name'];?></a></li>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			 </ul>
			 <!--az新首页 友情链接-->
		</div>
	</div>
</div>
<script type="text/javascript">
seajs.use("indexcontrol")
</script>
<?php include template("content","footer"); ?>
</body>
</html><!--b新闻首页 新版脚注1-->