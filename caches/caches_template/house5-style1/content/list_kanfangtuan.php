<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML 
xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></TITLE>
<META content="text/html; charset=gb2312" http-equiv=Content-Type>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
<link href="<?php echo APP_PATH;?>/statics/css/dialog.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/statics/js/dialog.js"></script>
<LINK rel=stylesheet type=text/css href="<?php echo APP_PATH;?>/statics/house5-style1/css/tuan/main.css" media=screen>
<!--不知道干嘛用的-->
<SCRIPT type=text/javascript>var QosSS=new Object();QosSS.t=new Array([0,0,0,0,0,0]);QosSS.t[0]=(new Date()).getTime();QosSS.t[5]=QosSS.t[4]=QosSS.t[3]=QosSS.t[2]=QosSS.t[1]=QosSS.t[0];</SCRIPT>
<META name=GENERATOR content="MSHTML 9.00.8112.16450"></HEAD>
<BODY>
<DIV id=mainPageContent class=page><!--公共头部-->
<STYLE>
.miniNavWrap {BACKGROUND: url(/statics/house5-style1/img/tuan/miniNavWrap.png) repeat-x center top; HEIGHT: 32px}
.miniNav {LINE-HEIGHT: 30px; HEIGHT: 32px; COLOR: #222}
.miniNav A {COLOR: #5b5b5b}
.miniNav A:hover {COLOR: #2d374b; TEXT-DECORATION: none}
.miniNav .login {_padding-top: 4px}
.miniNav .loginBtn {TEXT-ALIGN: center; LINE-HEIGHT: 20px; WIDTH: 59px; DISPLAY: inline-block; HEIGHT: 20px; COLOR: #6994c1}
.miniNav .loginBtn:hover {BACKGROUND-POSITION: -60px 0px; COLOR: #fff}
.miniNav .msg A {COLOR: #ee5f00}
.header {HEIGHT: 90px}
.header .telBox {MARGIN-TOP: 20px; PADDING-LEFT: 55px; WIDTH: 215px; BACKGROUND-POSITION: -690px 5px; OVERFLOW: hidden}
.header .telBox H2 {FONT: bold 22px/30px "微软雅黑","黑体"; COLOR: #505050}
.header .telBox P {FONT: bold 18px/22px "微软雅黑","黑体"; COLOR: #ee5f00}
.header .telBox P SPAN {PADDING-BOTTOM: 0px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; COLOR: #888; PADDING-TOP: 0px}
.header .selCity {Z-INDEX: 99; BORDER-BOTTOM: #c2c2c2 1px solid; POSITION: relative; TEXT-ALIGN: center; BORDER-LEFT: #c2c2c2 1px solid; LINE-HEIGHT: 14px; MARGIN: 34px 0px 0px 13px; WIDTH: 53px; HEIGHT: 17px; BORDER-TOP: #c2c2c2 1px solid; BORDER-RIGHT: #c2c2c2 1px solid; PADDING-TOP: 4px}
.header .selCity EM {LINE-HEIGHT: 0; WIDTH: 5px; DISPLAY: inline-block; BACKGROUND-POSITION: -560px -140px; HEIGHT: 3px; MARGIN-LEFT: 3px; FONT-SIZE: 0px; VERTICAL-ALIGN: middle}
.header .current .cityList {DISPLAY: block}
.header .cityList {BORDER-BOTTOM: #c2c2c2 1px solid; POSITION: absolute; TEXT-ALIGN: left; BORDER-LEFT: #c2c2c2 1px solid; PADDING-BOTTOM: 18px; LINE-HEIGHT: 18px; PADDING-LEFT: 10px; PADDING-RIGHT: 0px; DISPLAY: none; BACKGROUND: #fff; BORDER-TOP: #c2c2c2 1px solid; BORDER-RIGHT: #c2c2c2 1px solid; PADDING-TOP: 18px; TOP: 21px; LEFT: -1px}
.header .cityList .btnClose {POSITION: absolute; WIDTH: 11px; DISPLAY: inline-block; BACKGROUND-POSITION: -600px -50px; HEIGHT: 12px; CURSOR: pointer; RIGHT: 9px; TOP: 7px}
.header .cityList A {PADDING-BOTTOM: 0px; LINE-HEIGHT: 18px; MARGIN: 0px 2px; PADDING-LEFT: 3px; PADDING-RIGHT: 3px; DISPLAY: inline-block; HEIGHT: 18px; PADDING-TOP: 0px}
.header .cityList A:hover {BACKGROUND: #5673ce; COLOR: #fff; TEXT-DECORATION: none}
.header .cityList .item {PADDING-BOTTOM: 5px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 5px}
.header .cityList .item SPAN {PADDING-LEFT: 10px; COLOR: #8e9fe1; FONT-WEIGHT: bold}
.mainNavWrap {	BACKGROUND: url(/statics/house5-style1/img/tuan/mainNavWrap.png) repeat-x center top; HEIGHT: 40px}
.mainNav {HEIGHT: 40px}
.mainNav LI {FLOAT: left; HEIGHT: 40px}
.mainNav LI A {	PADDING-BOTTOM: 0px; LINE-HEIGHT: 40px; PADDING-LEFT: 26px; PADDING-RIGHT: 26px; DISPLAY: inline-block; HEIGHT: 40px; COLOR: #fff; FONT-SIZE: 14px; PADDING-TOP: 0px}
.mainNav LI A:hover {TEXT-DECORATION: none}
.mainNav .current {BORDER-LEFT: #3e5dc1 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 25px; PADDING-RIGHT: 25px; BACKGROUND: url(/statics/house5-style1/img/tuan/icons.png) no-repeat 0px -70px; COLOR: #fff; OVERFLOW: hidden; BORDER-RIGHT: #4c69c7 1px solid; PADDING-TOP: 0px}
.mainNav LI A:hover {BORDER-LEFT: #3e5dc1 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 25px; PADDING-RIGHT: 25px; BACKGROUND: url(/statics/house5-style1/img/tuan/icons.png) no-repeat 0px -70px; COLOR: #fff; OVERFLOW: hidden; BORDER-RIGHT: #4c69c7 1px solid; PADDING-TOP: 0px}
</STYLE>
<!-- miniNavWrap s -->
<DIV class="miniNavWrap cf">
<DIV class="miniNav layout cf"><SPAN class=fl><A href="<?php echo APP_PATH;?>" target=_blank>首页</A>&nbsp;|&nbsp; <A href="<?php echo HOUSE_PATH;?>" 
target=_blank>新房</A>&nbsp;|&nbsp; <A href="<?php echo APP_PATH;?>sitemap.html" target=_blank>网站导航</A> </SPAN><SPAN class="fr login"><script type="text/javascript">document.write('<iframe src="<?php echo APP_PATH;?>index.php?s=member/index/mini&forward='+encodeURIComponent(location.href)+'&siteid=<?php echo get_siteid();?>" allowTransparency="true"  width="200" height="24" frameborder="0" scrolling="no"></iframe>')</script></SPAN> </DIV></DIV><!-- miniNavWrap e --><!-- ad s --><!-- ads head start--><!-- ads head end --><!-- ad e --><!-- header s -->
<DIV class="header layout cf">
<DIV class=fl>
<H1 class="fl"  style="margin:15px 0px;"><A href="<?php echo TUAN_PATH;?>"><IMG alt=看房团 
src="<?php echo APP_PATH;?>/statics/house5-style1/img/logo.png"></A></H1>
<DIV id=selCity class="selCity fl"><?php echo $default_city;?><EM class=icons></EM> 
</DIV></DIV>
<DIV class=fr>
<DIV class="telBox icons">
<H2>看房团热线</H2>
<P><?php echo $site_tel;?>&nbsp;</P></DIV></DIV></DIV><!-- header e --><!-- mainNavWrap s -->
<DIV class="mainNavWrap mb15">
<DIV class="mainNav layout">
<UL class=cf>
  <LI><A href="<?php echo TUAN_PATH;?>">首页</A> </LI>
  <LI><A onclick="boss_statistics(1556,'getmymsg','mainnavigation','other')" 
  href="#">我的看房单</A> </LI>
  <LI><A href="<?php echo catlink(6);?>special-1-1.html" 
  target=_blank>往期看房团</A> 
</LI></UL></DIV></DIV><!-- mainNavWrap e -->
<SCRIPT>
var g_city_info = {"FId":"1","FName":"\u5317\u4eac","FFirstLetter":"B","FSubName":"bj","FEnName":"beijing","FIsNewYouth":"1","FQQGroups":null,"FStatus":"1","FType":"2","FLatitude":"39.916527","FLongitude":"116.397128","FZoomLevel":"11","FOpenMap":"1","FMapInfo":"a:2:{s:3:\"day\";a:4:{s:2:\"sp\";s:5:\"10.00\";s:2:\"sd\";i:3000;s:4:\"unit\";s:4:\"2.00\";s:2:\"sc\";s:4:\"3.00\";}s:5:\"night\";a:4:{s:2:\"sp\";s:5:\"10.00\";s:2:\"sd\";i:3000;s:4:\"unit\";s:4:\"2.40\";s:2:\"sc\";s:4:\"3.00\";}}","FOpenKft":"1","FKftLatitude":"39.916527","FKftLongitude":"116.397128","FKftZoomLevel":"11","FIsOpenConsulHotline":"1"};
var house_front_domain = "<?php echo APP_PATH;?>";
function getByClass(oParent, sClass) {
    var aTmp = [],
    aEle = oParent.getElementsByTagName('*');
    for (var i = 0, l = aEle.length; i < l; i++) {
        if (aEle[i].className.indexOf(sClass) != -1) {
            aTmp.push(aEle[i]);
        }
    }
    return aTmp;
}
/* selCity */
var cityBtn = document.getElementById("selCity");
function isMouseLeave(evt, element) {  
    if (evt.type != 'mouseout' && evt.type != 'mouseover') return false;   
    var target = evt.relatedTarget ? evt.relatedTarget : evt.toElement;  
    while (target && target != element) {  
        target = target.parentNode;  
    }  
    return (target != element);  
}

function kft_signup_submit()
{
if (document.Tgform.truename.value=="")
  {
    alert("请输入姓名！");
    document.Tgform.truename.focus();
    return false;
   }

	if (document.Tgform.phone.value=="")
  {
    alert("请输入手机！");
    document.Tgform.phone.focus();
    return false;
   }
	if(document.Tgform.relation.value=="")
	{
		document.Tgform.action='<?php echo APP_PATH;?>index.php?s=formguide/index/show&formid=17&siteid=1&flag=act';
		document.Tgform.submit();
	}
	else
	{
		document.Tgform.action='<?php echo APP_PATH;?>index.php?s=formguide/index/show&formid=17&siteid=1&flag=lp';
		document.Tgform.submit();
	}
   /*
   if (document.Tgform.num.value=="")
  {
    alert("请输入团购人数！");
    document.Tgform.num.focus();
    return false;
   }
   if (/\D/g.test(document.Tgform.num.value)){
	  document.Tgform.num.value=(document.Tgform.num.value).replace(/\D/g,'');
	  return false;
   }*/
   return true;
}

function kft_login_submit()
{
	if (document.Tgform.username.value=="")
  {
    alert("请输入帐号！");
    document.Tgform.username.focus();
    return false;
   }

	if (document.Tgform.password.value=="")
  {
    alert("请输入密码！");
    document.Tgform.password.focus();
    return false;
   }
   if (document.Tgform.code.value=="")
  {
    alert("请输入验证码！");
    document.Tgform.code.focus();
    return false;
   }
	document.Tgform.action='<?php echo APP_PATH;?>index.php?s=member/index/login';
	document.Tgform.submit();
   return true;
}
</SCRIPT>
<script type="text/javascript" src="<?php echo APP_PATH;?>/statics/house5-style1/js/tuan/lightBox.js"></script>
<script type="text/javascript">
var vf_box1='<DIV id=resgInfo class=resgInfo><DIV class="hd cf"><H2>填写报名资料&nbsp;<SPAN>（带<EM>*</EM>为必填项）</SPAN></H2></DIV><FORM id=Tgform method=post name=Tgform action= target=ifr_1><DIV class=bd><DIV><SPAN class=name><EM>*</EM>姓　名：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=gb_name class="icons txt" name=truename></DIV><DIV><SPAN class=name>性　别：</SPAN><LABEL><INPUT style="VERTICAL-ALIGN: middle" id=gb_sex name=sex type=radio value=2>女士</LABEL>&nbsp;&nbsp;<LABEL><INPUT style="VERTICAL-ALIGN: middle" name=sex type=radio value=1>先生</LABEL></DIV><DIV><SPAN class=name><EM>*</EM>手　机：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=gb_mobile class="icons txt" name=phone></DIV><DIV><SPAN class=name>QQ：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=gb_email class="icons txt" name=qq></DIV><DIV></DIV><DIV><SPAN class=name></SPAN><INPUT class="icons submit" title=立即报名 tabIndex=21 onclick="kft_signup_submit();" value=立即报名 type=button><input type=hidden name=from id=from value=<?php echo TUAN_PATH;?>><SPAN style="LINE-HEIGHT: 40px; DISPLAY: none; COLOR: #ff0000; MARGIN-LEFT: 30px; FONT-SIZE: 12px" id=kft_error_result></SPAN></DIV></DIV><INPUT id=dosubmit name=dosubmit value="提&nbsp;交" type=hidden> add_hidden</FORM></DIV>';
var vf_box2='<DIV id=loginInfo class=resgInfo><DIV class="hd cf"><H2>会员登录&nbsp;<SPAN>（带<EM>*</EM>为必填项）</SPAN></H2></DIV><FORM id=loginform method=post name=Tgform action= target=ifr_1><DIV class=bd><DIV><SPAN class=name><EM>*</EM>帐　号：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=username class="icons txt" name=username></DIV><DIV><SPAN class=name><EM>*</EM>密　码：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=password class="icons txt" type="password" name=password></DIV><DIV><SPAN class=name><EM>*</EM>验证码：</SPAN><INPUT style="VERTICAL-ALIGN: middle" id=code class="icons txt" name=code><img id="code_img" onclick="this.src=this.src+&quot;&amp;&quot;+Math.random()" src="<?php echo APP_PATH;?>api.php?op=checkcode&amp;code_len=4&amp;font_size=14&amp;width=84&amp;height=29&amp;font_color=&amp;background="></DIV><DIV style="margin-top:10px;"><SPAN class=name></SPAN><INPUT class="loginicons" title=登录 tabIndex=21 onclick="kft_login_submit();" value="" type=button><input type=hidden name=forward id=forward value=<?php echo TUAN_PATH;?>><input type="hidden" name="cookietime" value="2592000" id="cookietime"><SPAN style="LINE-HEIGHT: 40px; DISPLAY: none; COLOR: #ff0000; MARGIN-LEFT: 30px; FONT-SIZE: 12px" id=kft_error_result></SPAN></DIV><DIV>您还可以使用以下帐号直接登录</DIV><DIV class="login_other"><A class="lo_sina" title="新浪微博帐号登录" href="<?php echo APP_PATH;?>index.php?s=member/index/public_sina_login&forward=<?php echo TUAN_PATH;?>">新浪微博</A><A class="lo_qq" title="QQ帐号登录" href="<?php echo APP_PATH;?>index.php?s=member/index/public_qq_loginnew&forward=<?php echo TUAN_PATH;?>">QQ帐号</A></P></DIV><DIV><span style="float:left;line-height:25px;">还没有帐号？马上注册吧！</span><a class="login_ljzc" title="立即注册" href="<?php echo APP_PATH;?>register.html?forward=<?php echo TUAN_PATH;?>">立即注册</a></DIV></DIV><INPUT id=dosubmit name=dosubmit value="提&nbsp;交" type=hidden></FORM></DIV>';
var	footerhtml1='<input type="image" alt="Cancel" src="<?php echo APP_PATH;?>/statics/house5-style1/img/tuan/cancel_button.gif" class="btn" id="msg1cancel" />';	
</script>
<!-- mainWrap s -->
<DIV class="mainWrap layout cf"><!-- main s -->
<DIV class=main>
<DIV class="hotBox mb15 cf">
<P class=hide><B style="COLOR: red">每行最多共计输入21个汉字或者字符,该区域图片尺寸为width:452px, 
height:258px</B></P><!--HTML结构开始-->
<DIV id=fsE2 class=fs_E2>
<DIV class=fPs>
<DIV class=fix>
<DIV id=E2pic1 class=fPic>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0afc2785af9449daee03afc024ce0098&action=house_position&posid=44&catid=%24housecatid&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'house_position')) {$data = $content_tag->house_position(array('posid'=>'44','catid'=>$housecatid,'order'=>'listorder DESC','limit'=>'4',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $k++; ?>
<DIV id=focus<?php echo $k;?> class=fcon>
<DIV class="txtBox fl">
<H2 class=hd><A href="<?php echo $r['url'];?>" 
target=_blank><?php echo $r['title'];?></A></H2>
<DIV class=bd>
<DIV>价格：<?php if(!empty($r[price]) && $r[price]!="一房一价") { ?>最低<?php if($r[priceunit]=="0" ) { ?><SPAN 
class=price><?php echo $r['price'];?></SPAN>元/平米<?php } elseif ($r[priceunit]=="2") { ?><SPAN 
class=price><?php echo price_short($r[price]);?></SPAN>/套<?php } ?><?php } else { ?>一房一价<?php } ?></DIV>
<DIV>折扣：<?php echo $r['dzinfo'];?></DIV>
<DIV>开盘：<?php if(!empty($r[opentimetips])) { ?><?php echo $r['opentimetips'];?><?php } elseif (!empty($r[opentime])&& $r[opentime]!="0000-00-00") { ?><?php echo $r['opentime'];?><?php } else { ?>待定<?php } ?></DIV>
<DIV><SPAN>位置：</SPAN><?php echo $r['address'];?></DIV>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=5c6ca7661968bffa7b81058686583d12&action=progressinfo&xglp=%24r%5Bid%5D&catid=29&num=2&order=inputtime+DESC&cache=86400&return=dzinfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('xglp'=>$r[id],'catid'=>'29','order'=>'inputtime DESC',)).'5c6ca7661968bffa7b81058686583d12');if(!$dzinfo = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'progressinfo')) {$dzinfo = $content_tag->progressinfo(array('xglp'=>$r[id],'catid'=>'29','order'=>'inputtime DESC','limit'=>'2',));}if(!empty($dzinfo)){setcache($tag_cache_name, $dzinfo, 'tpl_data');}}?>
<?php if($dzinfo) { ?>
<UL class=txtList>

<?php $n=1;if(is_array($dzinfo)) foreach($dzinfo AS $v) { ?>
<LI><EM>·</EM><A href="<?php echo $v['url'];?>" target=_blank><?php echo str_cut($v['description'],40,'...');?></A></LI>
<?php $n++;}unset($n); ?>
</UL>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</DIV>
<DIV id=focus1_oper class=ft>
<P class="btn icons fl signUpHouse" onclick="var addr='<input type=\'hidden\' name=\'relation\' id=\'relation\' value=<?php echo $r[id];?>><input type=\'hidden\' name=\'subject\' id=\'subject\' value=<?php echo $r[title];?>><input type=\'hidden\' name=\'price\' id=\'price\' value=<?php echo $r[price];?>><input type=\'hidden\' name=\'region\' id=\'region\' value=<?php echo menu_linkinfo('3360',$r[region])?> ><input type=\'hidden\' name=\'regionid\' id=\'regionid\' value=<?php echo $r[region]?> >';Box('msg1',502,345,vf_box1,footerhtml1,addr);">立即报名</P>
<P class="numBox fl">已报名<SPAN class=num><?php echo get_tuancount($r[id]);?></SPAN>人</P></DIV></DIV>
<DIV class="picBox fr"><A href="<?php echo $r['url'];?>" 
target=_blank><IMG title=<?php echo $r['title'];?> alt=<?php echo $r['title'];?> 
src="<?php echo thumb($r[thumb],452,258);?>"></A></DIV></DIV>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV>

</DIV>

<DIV id=E2fBt class=E2fBt>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<A href="javascript:void(0)" target=_self><?php echo $n;?></A>
<?php $n++;}unset($n); ?>
</DIV></DIV><!--HTML结构结束--></DIV>

<!--[if !IE]>|xGv00|29c39a84934b5fa46f15976a6c88fcfa<![endif]--><!--[if !IE]>|xGv00|00d65e473bb3d94522dd566d4aa82f02<![endif]--><!-- ad s -->


<DIV class="mainAd mb15"></DIV><!-- ad e -->
<DIV class="linkBox mb15 cf">
<UL class="linkList cf">
  <LI class="item1 icons fl">
  <H2 class=fl>参团看房</H2><SPAN class=fl>总有一条线路适合你！</SPAN> </LI>
  <LI class="item2 icons fl">
  <H2 class=fl>自主组团</H2><SPAN class=fl>满100人就有机会成团！</SPAN> </LI>
  <LI class="item3 icons fl">
  <H2 class=fl>独家优惠</H2><SPAN class=fl>参团看房享优惠！</SPAN> </LI></UL></DIV><!-- 参团看房 -->
<DIV id=mainList class="mainList mb10">
<DIV class="tit icons cf">
<H2 class=fl>参团看房</H2></DIV>
<DIV class=con>

<!-- item s -->
<?php $where=" catid=$catid and DATE_FORMAT(endtime,'%Y%m%d')>= DATE_FORMAT(CURDATE(),'%Y%m%d')"?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=68cdb56f8f4bb2a0267ec14905e8a9d2&action=lists&catid=%24catid&where=%24where&num=20&order=id+DESC&moreinfo=1&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$where,'order'=>'id DESC','moreinfo'=>'1',)).'68cdb56f8f4bb2a0267ec14905e8a9d2');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'order'=>'id DESC','moreinfo'=>'1','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<DIV class=item>
<DIV class=cf>
<DIV class="txtBox fl">
<DIV class=hd>
<H3 style="POSITION: relative; HEIGHT: 60px"><A 
href="<?php echo $r['url'];?>" target=_blank><SPAN 
class=day>[<?php echo date('m月d日',strtotime($r[addtime]));?>]</SPAN></A><A title=<?php echo $r['title'];?> 
href="<?php echo $r['url'];?>" 
target=_blank><?php echo $r['title'];?></A>
<DIV style="POSITION: absolute; BOTTOM: 0px; RIGHT: 0px" 
class="numBox fr">已报名<SPAN id=kft_route_signup_num_105 
class=num><?php echo get_routecount($r[id]);?></SPAN>人</DIV></H3></DIV>
<DIV class=bd>
<P><?php echo $r['description'];?>[<A 
href="<?php echo $r['url'];?>" 
target=_blank>详情</A>]</P>
<UL class=list>
  <LI><SPAN class=bold>所属区域：</SPAN><?php echo menu_linkinfo('3360',$r[region],1);?> 
  <LI><SPAN class=bold>线路特点：</SPAN><?php echo $r['character'];?> </LI></UL></DIV>
<DIV class=ft><SPAN class="btn btnBm icons" 
onclick="var addr='<input type=\'hidden\' name=\'relation\' id=\'relation\' value=><input type=\'hidden\' name=\'relatedid\' id=\'relatedid\' value=<?php echo $r[id];?>>';Box('msg1',502,345,vf_box1,footerhtml1,addr);">立即报名</SPAN><SPAN 
class=hide>105</SPAN></DIV></DIV>
<DIV class="picBox fr"><A 
href="<?php echo $r['url'];?>" 
target=_blank><IMG alt=<?php echo $r['title'];?> src="<?php echo thumb($r[thumb],370,235);?>" width=370 
height=235></A> </DIV></DIV>
<TABLE class="lineList icons">
  <TBODY>
  <TR>
  <!--线路下楼盘开始-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fb280caec7e40ad205dc0709df3ae20a&action=houseinfo&catid=%24housecatid&relation=%24r%5Brelation%5D&order=id+DESC&cache=86400&return=houseinfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$housecatid,'relation'=>$r[relation],'order'=>'id DESC',)).'fb280caec7e40ad205dc0709df3ae20a');if(!$houseinfo = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'houseinfo')) {$houseinfo = $content_tag->houseinfo(array('catid'=>$housecatid,'relation'=>$r[relation],'order'=>'id DESC','limit'=>'20',));}if(!empty($houseinfo)){setcache($tag_cache_name, $houseinfo, 'tpl_data');}}?>
<?php $n=1;if(is_array($houseinfo)) foreach($houseinfo AS $v) { ?>
    <TD>
      <DIV class=lineItem>
      <DIV class="iconDot icons">
      <DIV class=detail><EM class=icons></EM>
      <DIV class=cf>
      <DIV class="picBox2 fl"><A href="<?php echo $v['url'];?>" 
      target=_blank><IMG alt=<?php echo $v['title'];?> width=140 height=101 
      _src="<?php echo thumb($v[thumb],140,101);?>"></A></DIV>
      <DIV class=txtBox2>
      <H4 class=bold><A href="<?php echo $v['url'];?>" 
      target=_blank><SPAN title=<?php echo $v['title'];?>><?php echo $v['title'];?></SPAN></A></H4>
      <P>价格：<SPAN><?php if(!empty($v[price]) && $v[price]!="一房一价") { ?> 均价<?php if($v[priceunit]=="0" ) { ?><SPAN 
class=num><?php echo $v['price'];?></SPAN>元/平米<?php } elseif ($v[priceunit]=="2") { ?><SPAN 
class=num><?php echo price_short($v[price]);?></SPAN>/套<?php } ?><?php } else { ?>一房一价<?php } ?></SPAN></P>
      <P><SPAN title=<?php echo $v['dzinfo'];?>><?php echo $v['dzinfo'];?></SPAN></P>
      <P>开盘时间：<?php if(!empty($v[opentimetips])) { ?><?php echo $v['opentimetips'];?><?php } elseif (!empty($v[opentime])&& $v[opentime]!="0000-00-00") { ?><?php echo $v['opentime'];?><?php } else { ?>待定<?php } ?></P></DIV></DIV>
      <DIV class=tese>项目特色：<SPAN title="<?php echo get_charactername($v[character]);?>"><?php echo get_charactername($v[character]);?></DIV></DIV></DIV>
      <P class="center f14"><?php echo $v['title'];?></P></DIV></TD>
<!--第一个结束-->
  <?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</TR></TBODY></TABLE></DIV>
	  
	  
	  <!-- item e -->
  <?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	  
</DIV></DIV><INPUT 
id=KFTRouteIds value=105|106|107|109|111 type=hidden> 
<DIV class="mainAd mb15"></DIV>
<SCRIPT type=text/javascript>QosSS.t[1]= (new Date()).getTime();</SCRIPT>

<DIV class="mainSo mb15">
<DIV class="tit icons">
<H2>自主组团</H2></DIV>

<DIV class=con>
<FORM id=smartbox_form_1 class=dis method=get action="">
<DIV class=search><EM class="icons arr"></EM><INPUT id=search_city 
name=search_city value=1 type=hidden> <!--select下拉框-->
<DIV class=dropDownList>
<DIV id=dropDownList1 class=dropdown>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<SELECT id=search_region_subway 
name=search_region_subway>
<OPTION selected value="">选择区域</OPTION> 
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

<?php

 	$reg = explode('$$', $r);//add by L 2012/3/22

	?>
	<OPTION value=<?php echo $reg['0'];?>><?php echo $reg['1'];?></OPTION>	
	<?php $n++;}unset($n); ?>
</SELECT><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<SPAN id=search_region_subway_show>选择区域</SPAN> 
<UL></UL></DIV>
<DIV id=dropDownList2 class=dropdown><SELECT id=search_price name=search_price> 
  <OPTION selected value="">选择价格</OPTION> <OPTION 
  value=1>3千元/平米以下</OPTION> <OPTION value=2>3-4千元/平米</OPTION> 
  <OPTION value=3>4-5千元/平米</OPTION> 
  <OPTION value=4>5-6千元/平米</OPTION> <OPTION 
  value=5>6-7千元/平米</OPTION> <OPTION 
  value=6>7-8千元/平米</OPTION> <OPTION 
  value=7>8千-1万元/平米</OPTION> <OPTION 
  value=8>1万元/平米以上</OPTION></SELECT> <SPAN 
id=search_price_show>选择价格</SPAN> 
<UL></UL></DIV>
<DIV id=dropDownList3 class=dropdown><SELECT id=search_housetype 
name=search_housetype> <OPTION selected value="">选择物业类型</OPTION> <OPTION 
  value=1>普通住宅</OPTION> <OPTION value=2>花园洋房</OPTION> <OPTION 
  value=9>公寓</OPTION> <OPTION value=3>酒店式公寓</OPTION> <OPTION 
  value=8>商铺</OPTION> <OPTION value=7>写字楼</OPTION> <OPTION 
  value=5>建筑综合体</OPTION> <OPTION value=4>商住两用</OPTION> <OPTION 
  value=6>别墅</OPTION> </SELECT> <SPAN 
id=search_housetype_show>选择物业类型</SPAN> 
<UL></UL></DIV></DIV><!--/select下拉框-->
<DIV class=input_box><!-- smartbox 样式 -->
<STYLE>#smartbox_result {
	Z-INDEX: 1000; BORDER-BOTTOM: #8fa7c7 1px solid; POSITION: absolute; TEXT-ALIGN: left; BORDER-LEFT: #8fa7c7 1px solid; WIDTH: 204px; DISPLAY: none; FONT: 12px/1.75 "宋体",arial,sans-serif; BACKGROUND: #ffffff 0px 0px; BORDER-TOP: #8fa7c7 1px solid; BORDER-RIGHT: #8fa7c7 1px solid; TOP: 30px; LEFT: 0px
}
#smartbox_list LI {
	PADDING-LEFT: 5px
}
#smartbox_list .focus {
	DISPLAY: block; BACKGROUND: #deefff 0px 0px; CURSOR: pointer; TEXT-DECORATION: none
}
</STYLE>
<INPUT id=search_keyword class=input01 name=search_keyword maxLength=14 
autocomplete="off"> 
<DIV style="DISPLAY: none" id=smartbox_result>
<UL id=smartbox_list></UL></DIV></DIV><INPUT id=smartbox_search_1 class=input02 name=Submit value="" type=submit> 
</DIV>
<!-- 无结果显示 s -->
<DIV id=search_no_result class="resBox resEmpty hide">
<DIV class=emptyTxt>没有找到相关结果！</DIV>
<DIV class=f14>你可以通过“<A href="http://db.house.qq.com/bj/" 
target=_blank>高级搜索</A>”查找或者重新查找 ！ <A id=search_return_from_no_result 
href="javascript:void(0);">返回到备选楼盘</A></DIV></DIV><!-- 无结果显示结束 e -->



<DIV id=resBox class="resBox tabList">
<DIV class=resHd>
<DIV class="hdList cf"><SPAN id=search_title class="fl f14">备选楼盘</SPAN>
<SPAN 
id=search_btn_map_module class="fr icons tabBtn iconDt"></SPAN>
</DIV>
<DIV class="hdMap cf f14"><SPAN class=fl><SPAN 
id=search_tips_on_map>搜索到的楼盘</SPAN><EM id=search_house_num_on_map 
class="num bold">0</EM>个<A id=search_return_to_init_search_result 
class="f12 btn" href="javascript:void(0);">&lt;&lt;返回到备选楼盘</A></SPAN><SPAN 
class="fr icons tabBtn iconList f12">列表模式</SPAN></DIV></DIV>


<DIV class=resBd>
<DIV id=resList class=resList>

<!--search recommend house s-->

<P class=hide><B style="COLOR: red">每行最多共计输入11个汉字或者字符</B></P>
<UL id=search_result_list class=cf>
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c772161f1896572a80b29c415817c61f&action=house_position&posid=83&catid=14&order=listorder+DESC&num=8&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'83','catid'=>'14','order'=>'listorder DESC',)).'c772161f1896572a80b29c415817c61f');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'house_position')) {$data = $content_tag->house_position(array('posid'=>'83','catid'=>'14','order'=>'listorder DESC','limit'=>'8',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
 <?php $menu_info = menu_info('3360',$v[region])?>
 <!--备选楼盘列表开始-->
  <LI class=item>
  <!--层上显示内容-->
  <DIV class=picBox><EM class="icons iconSc hide"></EM><A 
  href="<?php echo $v['url'];?>" target=_blank><IMG title=<?php echo $v['title'];?> 
  alt=<?php echo $v['title'];?> src="<?php echo thumb($v[thumb], 155, 103, 0);?>" width=155 height=103></A>
  <DIV class=picShade>
  <DIV>优惠：<SPAN class=price><?php echo $v['dzinfo'];?></SPAN></DIV></DIV></DIV>
  <!--楼盘图片下显示-->
  <DIV class=txtBox>
  <DIV><EM>[</EM><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a><EM>]</EM><A href="<?php echo $v['url'];?>" 
  target=_blank><?php echo $v['title'];?></A></DIV>
  <DIV><SPAN class=ca>均价：</SPAN><SPAN class=num><?php if(!empty($v[price]) && $v[price]!="一房一价") { ?><?php if($v[priceunit]=="0" ) { ?><?php echo $v['price'];?>元/平米<?php } elseif ($v[priceunit]=="2") { ?><?php echo price_short($v[price]);?>元/套<?php } ?><?php } else { ?>待定<?php } ?></SPAN></DIV>
  <DIV><SPAN class=ca>特色：</SPAN><?php echo str_cut(get_charactername($v[character]),40);?></DIV></DIV>
  <DIV class=btnBox>
  <P class="btn icons scBtn favHouse">收藏</P>
  <P style="DISPLAY: none" class="btn scBtn over ">已收藏</P>
  <P class="btn icons ztBtn signUpHouse" onclick="var addr='<input type=\'hidden\' name=\'relation\' id=\'relation\' value=<?php echo $v[id];?>><input type=\'hidden\' name=\'subject\' id=\'subject\' value=<?php echo $v[title];?>><input type=\'hidden\' name=\'price\' id=\'price\' value=<?php echo $v[price];?>><input type=\'hidden\' name=\'region\' id=\'region\' value=<?php echo menu_linkinfo('3360',$v[region])?> ><input type=\'hidden\' name=\'regionid\' id=\'regionid\' value=<?php echo $v[region]?> >';Box('msg1',502,345,vf_box1,footerhtml1,addr);">求组团</P>
  <P style="DISPLAY: none" class="btn ztBtn over">已参与</P></DIV></LI>
  <!--备选楼盘列表第一个结束-->
  <?php $n++;}unset($n); ?>
  <?php } ?>
  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

</UL><!--[if !IE]>|xGv00|55bdd2d4283c3418bab5294471e3d6b5<![endif]--><!--[if !IE]>|xGv00|88acc76f3f29c9aec23f1a815cd523b7<![endif]--><!--search recommend house e-->


<UL id=search_result_list_2 class="cf hide"></UL>
<DIV style="DISPLAY: none" id=search_bottom_toolbar class="resListFt cf">
<DIV style="DISPLAY: none" class="sortBox fl"><SELECT id=search_order 
class="rankDate fl" name=search_order> <OPTION value=2>价格从低到高</OPTION> <OPTION 
  value=1>价格从高到低</OPTION> <OPTION selected value=4>开盘时间从近到远</OPTION> <OPTION 
  value=3>开盘时间从远到近</OPTION></SELECT> <SPAN id=search_order_price 
class="icons rankPrice fl">售价<EM id=search_order_price_icon 
class="icons up"></EM></SPAN> <SPAN id=search_order_opendate 
class="icons kpDate fl">开盘时间<EM id=search_order_opendate_icon 
class="icons up"></EM></SPAN> </DIV>
<DIV id=search_pagebar class="pageBox fr"></DIV></DIV></DIV>
<DIV class=resMap>
<DIV style="WIDTH: 700px; HEIGHT: 520px" 
id=resMap></DIV></DIV></DIV></DIV></FORM></DIV></DIV>
<!--自主组团TOP10开始-->
<DIV class="rankBox mb15 cf">
<DIV id=ungroup_top10 class="rank rank1 fl">
<DIV class=hd>
<H3>自主组团TOP10</H3></DIV>
<DIV class=bd>

<DIV class="listHd cf"><SPAN class=col1>&nbsp;</SPAN> <SPAN 
class=col2>楼盘名称</SPAN> <SPAN class=col3>区域</SPAN> <SPAN class=col4>报名人数</SPAN> 
<SPAN class=col5>&nbsp;</SPAN> </DIV>
<UL class=list>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
 <?php $menu_info = menu_info('3360',$r[regionid])?>
  <LI class=rankItem>
  <P class=col5><SPAN style="CURSOR: pointer" id=ungroup_top10_qiang_9455 
  class="icons qiang" 
   onclick="var addr='<input type=\'hidden\' name=\'relation\' id=\'relation\' value=<?php echo $r[relation];?>><input type=\'hidden\' name=\'subject\' id=\'subject\' value=<?php echo $r[title];?>><input type=\'hidden\' name=\'price\' id=\'price\' value=<?php echo $r[price];?>><input type=\'hidden\' name=\'region\' id=\'region\' value=<?php echo menu_linkinfo('3360',$r[region])?> ><input type=\'hidden\' name=\'regionid\' id=\'regionid\' value=<?php echo $r[region]?> >';Box('msg1',502,345,vf_box1,footerhtml1,addr);">抢</SPAN></P>
  <P class=col1><SPAN<?php if($n<4) { ?> class=top<?php } ?>><?php echo $n;?></SPAN></P><SPAN class=col2 title=<?php echo $r['title'];?>><A 
  href="<?php echo HOUSE_PATH;?><?php echo $r['relation'];?>" target=_blank><?php echo $r['subject'];?></A></SPAN> <SPAN 
  class=col3><?php echo $menu_info['0'];?></SPAN> <SPAN class=col4><?php echo $r[counts]+10;?></SPAN> </LI>
  <?php $n++;}unset($n); ?>
 </UL>
 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV>
<DIV id=favHouses class="rank rank2 fr">
<DIV class=hd>
<H3>最受关注楼盘</H3></DIV>
<DIV class=bd>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=3e32e5b7a05553ef9cbf529600cce1f4&action=hits&catid=14&num=10&order=views+DESC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'14','order'=>'views DESC',)).'3e32e5b7a05553ef9cbf529600cce1f4');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<DIV class="listHd cf"><SPAN class=col1>&nbsp;</SPAN> <SPAN 
class=col2>楼盘名称</SPAN> <SPAN class=col3>价格</SPAN> <SPAN class=col4>&nbsp;</SPAN> 
</DIV><!-- most favorite houses s-->
<UL class=list>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
  <LI class="rankItem<?php if($n==1) { ?> current<?php } ?>">
  <P class=col1><SPAN<?php if($n<4) { ?> class=top<?php } ?>><?php echo $n;?></SPAN></P><SPAN class=col2><A 
  href="<?php echo $r['url'];?>" target=_blank><?php echo $r['title'];?></A></SPAN> <SPAN 
  class=col3><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?><?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?>/套<?php } ?><?php } else { ?>待定<?php } ?></SPAN>

  <P class=col4><SPAN class="icons zutuan signupHouse" onclick="var addr='<input type=\'hidden\' name=\'relation\' id=\'relation\' value=<?php echo $r[id];?>><input type=\'hidden\' name=\'subject\' id=\'subject\' value=<?php echo $r[title];?>><input type=\'hidden\' name=\'price\' id=\'price\' value=<?php echo $r[price];?>><input type=\'hidden\' name=\'region\' id=\'region\' value=<?php echo menu_linkinfo('3360',$r[region])?> ><input type=\'hidden\' name=\'regionid\' id=\'regionid\' value=<?php echo $r[region]?> >';Box('msg1',502,345,vf_box1,footerhtml1,addr);">求组团</SPAN></P></LI>
  <?php $n++;}unset($n); ?></UL><!--[if !IE]>|xGv00|5ebf3d1b9a995b37f439eced723c0724<![endif]--><!--[if !IE]>|xGv00|ae993c991d548c0e7ea97e7ad9dfed08<![endif]--><!-- most favorite houses e-->
  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV></DIV>

<DIV class=hisFocus style="display:none;">
<DIV class=hd>
<DIV id=page2 class="pageBtn fr"><SPAN class="prevBtn undis">&lt;</SPAN> <SPAN 
class="nextBtn undis">&gt;</SPAN> 
<UL class=list></UL></DIV></DIV>
<DIV class=bd>
<DIV style="WIDTH: 2142px; LEFT: -1428px" id=pageList2 class="pageList cf">
</DIV><!--[if !IE]>|xGv00|9c0c17e1ee91e063e16313b398bcdabf<![endif]--><!--[if !IE]>|xGv00|f65d465f6e20294d7007d34af90be084<![endif]--></DIV></DIV>
</DIV><!-- main e --><!-- side s -->
<DIV class=side>
<DIV class="userBox mb10">
<DIV class="bd l24">
<H3 class="bold f12">看房团动态</H3><!-- kft dynamic recommend s-->
<P class=hide><B style="COLOR: red">每行最多共计输入17个汉字或者字符</B></P>
<?php include template("ssi","ssi_13"); ?>
<!--[if !IE]>|xGv00|8e9de9c7e53a6efdf0db933f4f8a3665<![endif]--><!--[if !IE]>|xGv00|7a89ba7b4c31746da307895a1ef3afb3<![endif]--><!-- kft dynamic recommend e--></DIV></DIV>
<DIV class="bmMod mb10">
<DIV class=hd>
<H3>大家正在报名</H3></DIV>
<DIV class=bd>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8920bf585907959c75e554df1ce73027&action=tuangouinfo&num=50&formid=17&order=views+DESC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('formid'=>'17','order'=>'views DESC',)).'8920bf585907959c75e554df1ce73027');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'tuangouinfo')) {$data = $content_tag->tuangouinfo(array('formid'=>'17','order'=>'views DESC','limit'=>'50',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<DIV id=bmList class="bmList l24">
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<DIV class=split title=<?php echo hidden($r[phone],1);?>成功报名<?php echo $r['subject'];?>><SPAN 
class=tel><?php echo hidden($r[tel],1);?></SPAN><SPAN> 成功报名 <?php echo $r['subject'];?></SPAN></DIV>
<?php $n++;}unset($n); ?>
</DIV>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV>
<!--AD240X150-->
<!-- <DIV class="sideAd mb10">

</DIV> -->
<!--AD end-->
<DIV id=yhMod class="yhMod sideRank mb10">
<DIV class=hd>
<H3>最新优惠</H3></DIV>
<DIV class=bd>
<?php
	$where = "`status`=99 and dzinfo<>''";
	?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=277d42bbd4d2e400e4396a44c05f6ed9&action=lists&catid=14&where=%24where&num=9&order=id+desc&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'14','where'=>$where,'order'=>'id desc',)).'277d42bbd4d2e400e4396a44c05f6ed9');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'id desc','limit'=>'9',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<DIV class="listHd cf"><SPAN class=col1>&nbsp;</SPAN> <SPAN 
class=col2>楼盘名称</SPAN> <SPAN class=col3>区域</SPAN> <SPAN 
style="TEXT-ALIGN: center" class=col4>优惠</SPAN> </DIV>
<UL class=list>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

  <LI class="rankItem<?php if($n==1) { ?> current<?php } ?>">
  <?php $menu_info = menu_info('3360',$r[region])?>
  <DIV class="info cf"><SPAN class=col1><EM <?php if($n<4) { ?> class=top<?php } ?>><?php echo $n;?></EM></SPAN> <SPAN 
  class=col2 title=<?php echo $r['title'];?>><A href="<?php echo $r['url'];?>" 
  target=_blank><?php echo $r['title'];?></A></SPAN> <SPAN class=col3><?php echo $menu_info['0'];?></SPAN> <SPAN 
  style="TEXT-ALIGN: center" class="col4 num" 
  title=<?php echo $r['dzinfo'];?>><?php echo str_cut($r[dzinfo],18);?></SPAN> </DIV>
  <DIV class="moreInfo cf">
  <DIV class="picBox fl"><A href="<?php echo $r['url'];?>" 
  target=_blank><IMG alt=<?php echo $r['title'];?> src="<?php echo thumb($r[thumb], 100, 70, 0);?>" width=100 height=70></A> 
  </DIV>
  <DIV class=txtBox>
  <P><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?>均价：<?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?>元/平米<?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?>/套<?php } ?> <?php } else { ?>一房一价<?php } ?></P>
  <P>特色：<?php echo get_charactername($r[character]);?></P></DIV></DIV>
  </li>
  <?php $n++;}unset($n); ?></UL><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV>
<DIV id=kpMod class="kpMod sideRank mb10">
<DIV class=hd>
<H3>最新开盘</H3></DIV>
<DIV class=bd>
<?php

	$where = "status=99";

	?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7e5b25cdada0df17b5e8ee18bad04e04&action=lists&catid=14&where=%24where&num=9&order=opentime+desc&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'14','where'=>$where,'order'=>'opentime desc',)).'7e5b25cdada0df17b5e8ee18bad04e04');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'opentime desc','limit'=>'9',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<DIV class="listHd cf"><SPAN class=col1></SPAN><SPAN class=col2>楼盘名称</SPAN> 
<SPAN class=col3>区域</SPAN> <SPAN style="TEXT-ALIGN: center" 
class=col4>开盘价</SPAN> </DIV>
<UL class=list>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

  <LI class="rankItem<?php if($n==1) { ?> current<?php } ?>">
  <?php $menu_info = menu_info('3360',$r[region])?>
  <DIV class="info cf"><SPAN class=col1><EM <?php if($n<4) { ?> class=top<?php } ?>><?php echo $n;?></EM></SPAN> <SPAN 
  class=col2 title=<?php echo $r['title'];?>><A href="<?php echo $r['url'];?>" 
  target=_blank><?php echo $r['title'];?></A></SPAN> <SPAN style="TEXT-ALIGN: center" 
  class=col3><?php echo $menu_info['0'];?></SPAN> <SPAN style="TEXT-ALIGN: center" class=col4><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?><?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?>/套<?php } ?><?php } else { ?>待定<?php } ?></SPAN> 
  </DIV>
  <DIV class="moreInfo cf">
  <DIV class="picBox fl"><A href="<?php echo $r['url'];?>" 
  target=_blank><IMG alt=<?php echo $r['title'];?> src="<?php echo thumb($r[thumb], 100, 70, 0);?>" width=100 height=70></A> 
  </DIV>
  <DIV class=txtBox>
  <P><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?>均价：<?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?>元/平米<?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?>/套<?php } ?> <?php } else { ?>一房一价<?php } ?></P>
  <P>特色：<?php echo get_charactername($r[character]);?></P></DIV></DIV>
  </LI>
  <?php $n++;}unset($n); ?></UL>
  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></DIV></DIV>
<DIV class="bdMod mb10">
<DIV class=hd>
<H3>买房宝典</H3></DIV>
<DIV class="bd icons">
<UL class="list cf">
  <LI><A href="<?php echo HOUSE_PATH;?>list.html" 
  target=_blank>搜索找房</A></LI>
  <LI><A href="<?php echo APP_PATH;?>tools/sfjsq.html" 
  target=_blank>税费计算</A></LI>
  <LI><A href="<?php echo APP_PATH;?>tools/fdjsq.html" 
  target=_blank>贷款计算</A></LI>
  <LI><A href="<?php echo APP_PATH;?>tools/gfnlpg.html" 
  target=_blank>能力评估</A></LI>
  <LI><A href="<?php echo HOUSE_PATH;?>baojia.html" 
target=_blank>最新报价</A></LI>
  <LI><A href="<?php echo APP_PATH;?>tools/tqhkjsq.html" 
  target=_blank>还款计算</A></LI></UL></DIV><!--[if !IE]>|xGv00|5ed8c64a56417e778f3fba64b42a8b06<![endif]--><!--[if !IE]>|xGv00|2506011300e5d946ea676f878afe888a<![endif]--></DIV>

<DIV class=sideAd></DIV>

</DIV>
<!-- side e -->
</DIV>
<!-- mainWrap e -->
</DIV>
<!--公共底部-->
<?php include template("content","footer"); ?>

<SCRIPT src="<?php echo APP_PATH;?>/statics/house5-style1/js/tuan/kft_index_v22.js"></SCRIPT>

<!-- end guide --></BODY></HTML>
