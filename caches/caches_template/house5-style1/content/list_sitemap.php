<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $site_title;?>��վ��ͼ,����-<?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="��վ��ͼ,<?php echo $site_title;?>��վ��ͼ,<?php echo $site_title;?>��վ����" />
<meta name="description" content="<?php echo $site_title;?>��վ��ͼ����������������˽�<?php echo $site_title;?>,ͨ����վ��ͼ������ҳ����١����㡢����ҵ��Լ���Ҫ�����ݰ�飬����Լ���Ҫ�����ݡ�" />
<base target="_blank" />
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />

<style type="text/css">
body{font-size:12px;font-family:"����", "Arial";margin:0;padding:0;background:#fff;color:#333;}
div,form,img,ul,ol,li,dl,dt,dd,span,p{margin:0;padding:0;border:0;}
ul,ol,li{list-style-type:none;}
h1,h2,h3,h4,h5,h6{margin:0;padding:0;font-size:12px;font-weight:normal;}
img{vertical-align:top;border:0;}
a:link{color:#333;text-decoration:none;}
a:visited{color:#333;text-decoration:none;}
a:hover{color:#c00;text-decoration:underline;}
a:active{color:#c00;}
/* ������ʽ
------------------------------- */
.linka {color:#666; text-decoration:none;font-size:12px;font-weight: normal;font-family:"Arial";}

.linka a:link{color:#666; text-decoration:none;font-size:12px;font-weight: normal;font-family:"Arial";}
.linka a:visited{color:#666; text-decoration:none;font-size:12px;font-weight: normal;font-family:"Arial";}
.linka a:hover{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;font-family:"Arial";}
.linka a:active{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;font-family:"Arial";}



.linkb {color:#15a; text-decoration:none;font-size:14px;font-weight: bold;}
.linkb a:link{color:#15a; text-decoration:none;font-size:14px;font-weight: bold;}
.linkb a:visited{color:#15a; text-decoration:none;font-size:14px;font-weight: bold;}
.linkb a:hover{color:#c00;text-decoration:underline;font-size:14px;font-weight: bold;}
.linkb a:active{color:#c00;text-decoration:underline;font-size:14px;font-weight: bold;}



.linkc {color:#15a;text-decoration:none;font-size:12px;font-weight: normal;}
.linkc a:link{color:#15a;text-decoration:none;font-size:12px;font-weight: normal;}
.linkc a:visited{color:#15a;text-decoration:none;font-size:12px;font-weight: normal;}
.linkc a:hover{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;}
.linkc a:active{color:#c00;font-size:12px;text-decoration:underline;font-weight: normal;}

.linkd {color:#333; text-decoration:none;font-size:12px;font-weight: normal;}
.linkd a:link{color:#15a; text-decoration:none;font-size:12px;font-weight: normal;}
.linkd a:visited{color:#15a; text-decoration:none;font-size:12px;font-weight: normal;}
.linkd a:hover{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;}
.linkd a:active{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;}

.linke {color:#333; text-decoration:none;font-size:14px;font-weight: normal;}
.linke a:link{color:#15a; text-decoration:none;font-size:14px;font-weight: normal;}
.linke a:visited{color:#15a; text-decoration:none;font-size:14px;font-weight: normal;}
.linke a:hover{color:#c00;text-decoration:underline;font-size:14px;font-weight: normal;}
.linke a:active{color:#c00;text-decoration:underline;font-size:14px;font-weight: normal;}

.linkf {color:#666; text-decoration:none;font-size:12px;font-weight: normal;}
.linkf a:link{color:#666; text-decoration:none;font-size:12px;font-weight: normal;}
.linkf a:visited{color:#666; text-decoration:none;font-size:12px;font-weight: normal;}
.linkf a:hover{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;}
.linkf a:active{color:#c00;text-decoration:underline;font-size:12px;font-weight: normal;}

.linka a.newlink { color: #666666;
    font-family: "Arial";
    font-size: 12px;
    font-weight:lighter;
    text-decoration: none;}
.linka a.newlink:hover { color: #ff0000;
    font-family: "Arial";
    font-size: 12px;
    font-weight:lighter;
    text-decoration: underline;}

/* ����ͨ��class
------------------------------- */
#wrap{width:960px; overflow: hidden; display:block; margin:0 auto;}
.cArea{width:960px; clear:both; display:block; }
.hr5{height:5px;margin:auto;clear:both;overflow:hidden;}
.hr10{height:10px;margin:auto;clear:both;overflow:hidden;}
.hr15{height:15px;margin:auto;clear:both;overflow:hidden;}
.left{float: left;width:698px;background-color: #fff;margin:0 auto;border-right-width: 1px;border-left-width: 1px;border-right-style: solid;
border-left-style: solid;border-right-color: #BFD3EE;border-left-color: #BFD3EE;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #BFD3EE;}
.right{float: right;width:248px;background-color: #fff;margin:0 auto;border: 1px solid #BFD3EE;padding:0 0 10px 0;}

/* �·�logo+��������class
------------------------------- */
.logo_search{float: left; height:55px; width:950px;padding:25px 10px 0 0px;}
.logo{height:55px;width:220px;float: left;overflow: hidden;padding:0 9px 0 9px;background:#fff;}
.logoa{height:34px;width:99px;float: left;overflow: hidden;padding:18px 0 0 0;background:#fff;}
.logorig{float: right;overflow: hidden; line-height:24px;padding:18px 0 0 0;}
/* ��վͷ��ͨ��class
------------------------------- */
.header{height:29px;width:960px;clear:both;overflow: hidden;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #dedede;}
.header ul{height:29px;width:705px;float: left;overflow: hidden;padding:0 10px 0 10px ;}
.header ul li{height:29px;width:auto;float: left;padding:0 1px 0 2px ; line-height:29px;}
.header span{height:29px;width:235px;float: right;line-height:29px;}
/* footer
------------------------------- */
.footer{width:100%; background-color:#f4f9ff; margin-top:30px; border-top:1px solid #dbe7ed;}
.footer .info{width:960px; margin:0 auto; border-top:1px solid #dbe7ed;}
.footer .info{color:#666; line-height:24px;text-align:center;  margin-top:15px; }
.footer .info .info_link{width:960px; margin:0 auto; border-top:1px solid #FFF; }
.footer .info a{color:#666;}
/* ����
------------------------------- */
.metitle{float: left;width:688px;overflow: hidden; height:28px;background:url(<?php echo APP_PATH;?>statics/images/mebj.jpg) repeat-x;line-height:28px;padding:0 0 0 10px;}
.metitle span{padding:0 10px 0 10px;}

.content{float: left;width:678px;overflow: hidden; padding:10px 0 8px 10px;}
.content li span{display:block; float:left;line-height:22px;padding:0px 7px 0px 0px;}
.content li{overflow: hidden;line-height:22px;clear:both;}
.content li .td_1 {text-align: left;overflow:hidden;line-height: 22px;float:left;width:550px;}
.content li .td_2 {text-align: left;overflow:hidden;line-height: 22px;float:left;}
.content li .td_3 {text-align: left;overflow:hidden;line-height: 22px;float:left;}

.titlerig{float: left;width:238px;overflow: hidden; height:28px;padding:0 0 0 10px;font-family:"΢���ź�";color:#6B99D8; text-decoration:none;font-size:15px;font-weight: bold;line-height:28px;margin-bottom: 10px;}
.dotted{float: left;width:218px;margin-top: 10px;border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color: #D8D8D8;}
.rigcon{float: left;width:218px;overflow: hidden;margin-bottom: 10px;padding:0 10px 0 10px;}
.rigcon h1{float: left;width:218px;overflow: hidden;}
.rigcon h2{float: left;width:218px;overflow: hidden;border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color: #D8D8D8;padding:5px 0 5px 0;line-height: 22px;color:#999;}
.rigcon h3{float: left;width:178px;overflow: hidden;padding:0 0 0 40px;line-height: 22px;}
</style>

<style type="text/css">
.partbd ul li{display:block; float:left; width:50px; line-height:22px;  height:22px; text-align:center; text-decoration:none;}
.partbd ul li a{display:inline-block;}
.partbd li a:link, .partbd li a:visited {display: inline-block; height: 17px;line-height: 17px;padding: 0 5px;text-decoration:none;}
.partbd li a:hover{background: none repeat scroll 0 0 #30c8f7;color:#ffffff;text-decoration:none;}
</style>

</head>
<script>
function MM_over(mmObj) {
	var mSubObj = mmObj.getElementsByTagName("div")[0];
	mSubObj.style.display = "block";
	mSubObj.style.backgroundColor = "#fff";
}
function MM_out(mmObj) {
	var mSubObj = mmObj.getElementsByTagName("div")[0];
	mSubObj.style.display = "none";
	
}
</script>
<body>
<div id="wrap">
	<div class="cArea">

		<!--logo+���� begin -->
			<div class="logo_search">
				<div class="logo"><a href="<?php echo APP_PATH;?>"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/logo.png" /></a></div>
			  <div class="logoa"><a href="<?php echo APP_PATH;?>sitemap.html"><img src="<?php echo APP_PATH;?>statics/images/sitemap.jpg" alt="<?php echo $site_title;?>��վ��ͼ" /></a></div>			  
			  <div class="logorig"><a href="<?php echo APP_PATH;?>"><?php echo $site_title;?>��ҳ</a>&nbsp;|&nbsp;<a href="<?php echo MEMBER_PATH;?>">��Ա����</a>&nbsp;|&nbsp;<a href="<?php echo APP_PATH;?>search/">����</a></div>
	  </div>
		<!--logo+���� end -->
	</div>
	<div class="hr15"></div>

	<div class="cArea">
	  <div class="left">
	    <!--��Ѷ begin-->
		<div class="metitle linkb"><a href="<?php echo catlink(6);?>">��Ѷ</a><span class="linka"><a href="<?php echo catlink(6);?>special/" class="newlink">ר��</a></span><span class="linka"><a href="<?php echo catlink(6);?>rss-s1.html" class="newlink">RSS����</a></span></div>
		<div class="content">
			<li><span class="td_3"><a href="<?php echo catlink(48);?>"><?php echo catname(48);?></a> <a href="<?php echo catlink(16);?>"><?php echo catname(16);?></a> <a href="<?php echo catlink(24);?>"><?php echo catname(24);?></a> <a href="<?php echo catlink(25);?>"><?php echo catname(25);?></a></span></li>
  <li><span class="td_3"><a href="<?php echo catlink(26);?>"><?php echo catname(26);?></a> <a href="<?php echo catlink(27);?>"><?php echo catname(27);?></a> <a href="<?php echo catlink(28);?>"><?php echo catname(28);?></a> <a href="<?php echo catlink(29);?>"><?php echo catname(29);?></a> <a href="<?php echo catlink(30);?>"><?php echo catname(30);?></a> <a href="<?php echo catlink(49);?>"><?php echo catname(49);?></a> <a href="<?php echo catlink(31);?>"><?php echo catname(31);?></a> <a href="<?php echo catlink(32);?>"><?php echo catname(32);?></a><br />
	          <a href="<?php echo catlink(33);?>"><?php echo catname(33);?></a> <a href="<?php echo catlink(35);?>"><?php echo catname(35);?></a> <a href="<?php echo catlink(37);?>"><?php echo catname(37);?></a> <a href="<?php echo catlink(67);?>"><?php echo catname(67);?></a> <a href="<?php echo catlink(38);?>"><?php echo catname(38);?></a> <a href="<?php echo catlink(63);?>"><?php echo catname(63);?></a></span></li>
		</div>
		<!--�·� begin-->
		<div class="metitle linkb"><a href="<?php echo HOUSE_PATH;?>">�·�</a></div>
		<div class="content">
			<li><span class="td_3"><a href="<?php echo HOUSE_PATH;?>list.html">¥�̳���</a> <a href="<?php echo HOUSE_PATH;?>baojia.html">¥�̱���</a> <A href="<?php echo HOUSE_PATH;?>xclist.html">¥��ͼ��</A> <A href="<?php echo HOUSE_PATH;?>hxlist.html">����ͼ��</A> <A href="<?php echo HOUSE_PATH;?>ybjlist.html">������</A> <a href="<?php echo HOUSE_PATH;?>list-o1.html">���¿���</a> <A href="<?php echo HOUSE_PATH;?>list-h4.html">����¥��</A> <A href="<?php echo HOUSE_PATH;?>list-h5.html">����¥��</A> <A href="<?php echo HOUSE_PATH;?>list-h6.html">��Ʒ¥��</A> <a href="<?php echo HOUSE_PATH;?>wenfang-p1.html">�ʷ�</a> <a href="<?php echo APP_PATH;?>map/">��ͼ�ҷ�</a></span></li>
		  <li><span class="td_2">¥����ĸ������</span><span class="td_1"><A href="<?php echo HOUSE_PATH;?>zimu-a.html">A</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-b.html">B</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-c.html">C</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-d.html">D</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-e.html">E</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-f.html">F</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-g.html">G</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-h.html">H</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-i.html">I</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-j.html">J</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-k.html">K</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-l.html">L</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-m.html">M</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-n.html">N</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-o.html">O</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-p.html">P</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-q.html">Q</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-r.html">R</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-s.html">S</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-t.html">T</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-u.html">U</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-v.html">V</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-w.html">W</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-x.html">X</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-y.html">Y</A> 
<A href="<?php echo HOUSE_PATH;?>zimu-z.html">Z</A><br /><A href="<?php echo HOUSE_PATH;?>list-t1.html">סլ</A> <A href="<?php echo HOUSE_PATH;?>list-t2.html">��԰��</A> <A href="<?php echo HOUSE_PATH;?>list-t3.html">�Ƶ�ʽ��Ԣ</A> <A href="<?php echo HOUSE_PATH;?>list-t4.html">��ס����</A> <A href="<?php echo HOUSE_PATH;?>list-t5.html">�ۺ���</A> <A href="<?php echo HOUSE_PATH;?>list-t6.html">����</A> <A href="<?php echo HOUSE_PATH;?>list-t7.html">д��¥</A> <A href="<?php echo HOUSE_PATH;?>list-t8.html">����</A> <A href="<?php echo HOUSE_PATH;?>list-t9.html">��Ԣ</A><br />
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?>¥��</a> 
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></span></li>
		</div>
		<!--���ַ� begin-->
		<div class="metitle linkb"><a href="<?php echo ESF_PATH;?>">���ַ�</a></div>
		<div class="content">
			<li><span class="td_3"><a href="<?php echo ESF_PATH;?>list.html">���۷�Դ</a> <a href="<?php echo ESF_PATH;?>map.html">��ͼ�ҷ�</a> <a href="<?php echo ESF_PATH;?>list-h3.html">���۷�Դ</a> <a href="<?php echo ESF_PATH;?>">���³��۷�Դ</a> <a href="<?php echo ESF_PATH;?>list-u1.html">���˳��۷�Դ</a> <a href="<?php echo ESF_PATH;?>list-h4.html">��ͼ���۷�Դ</a><br /> <a href="<?php echo ESF_PATH;?>xiaoqu-list.html">С������</a> <a href="#">������</a> <a href="<?php echo catlink(66);?>"><?php echo catname(66);?></a></span></li>
		  <li><span class="td_2">���ַ�����������</span><span class="td_1">
		  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a href="<?php echo ESF_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?>���ַ�</a> 
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></span></li>
		</div>
		<!--�ⷿ begin-->
		<div class="metitle linkb"><a href="<?php echo ESF_PATH;?>rent-list.html">�ⷿ</a></div>
		<div class="content">
			<li><span class="td_3"><a href="<?php echo ESF_PATH;?>rent-list.html">���ⷿԴ</a> <a href="<?php echo ESF_PATH;?>rent-list-u1.html">���˳���</a> <a href="<?php echo ESF_PATH;?>rent-list.html">���·�Դ</a> <a href="<?php echo ESF_PATH;?>rent-map.html">��ͼ�ⷿ</a></span></li>
		  <li><span class="td_2">�ⷿ����������</span><span class="td_1">
		  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?><a href="<?php echo ESF_PATH;?>rent-list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?>�ⷿ</a> <?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></span></li>
		</div>
		<!--��̳ begin-->
		<div class="metitle linkb"><a href="<?php echo BBS_PATH;?>">��̳</a><span class="linka"><a href="<?php echo BBS_PATH;?>" class="newlink"><?php echo BBS_PATH;?></a></span></div>
		<!--�Ҿ� begin-->	
		<div class="metitle linkb"><a href="<?php echo catlink(53);?>"><?php echo catname(53);?></a></div>
		<div class="content">
			<li><span class="td_3"><a href="<?php echo catlink(54);?>"><?php echo catname(54);?></a> <a href="<?php echo catlink(55);?>"><?php echo catname(55);?></a> <a href="<?php echo catlink(56);?>"><?php echo catname(56);?></a> <a href="<?php echo catlink(57);?>"><?php echo catname(57);?></a> <a href="<?php echo catlink(58);?>"><?php echo catname(58);?></a> <a href="<?php echo catlink(59);?>"><?php echo catname(59);?></a> <a href="<?php echo catlink(114);?>"><?php echo catname(114);?></a></span></li>
		</div>
		<!--��Ƶ begin-->
	  </div>
		<div class="right">
			<div class="titlerig">�ص��Ƽ�</div>
				<div class="rigcon">
					<h1><a href="<?php echo MEMBER_PATH;?>"><?php echo $site_title;?>ͨ��֤</h1>
				  <h2><font style="color: #f60;"><?php echo $site_title;?>ͨ��֤</font>���û���¼<?php echo $site_title;?>��ͳһ��֤��ݡ�ע��ɹ��󣬿���ʵ��һ֤ͨ��<?php echo $site_title;?>���еĲ�Ʒ���������Ϊ��׼���ĸ��ֲ�Ʒ�͸��Ի�����</h2>
				</div>
				<div class="rigcon">
					<h1><a href="<?php echo TUAN_PATH;?>">������</a></h1>
				  <h2>Ҫ�򷿿���������æ��������������˵ķ��ӡ�</h2>
				</div>
				<div class="rigcon">
					<h1><a href="<?php echo HOUSE_PATH;?>wenfang-p1.html">�ʷ���</a></h1>
					<h2>��һʱ��Ϊ�����������</h2>
				</div>
				<div class="rigcon linkc">
					<h1><img src="<?php echo APP_PATH;?>statics/images/m5.jpg" width="100" height="27" border="0" /></h1>
					<h3><a href="<?php echo APP_PATH;?>one.html" title="���5�� �ҵ��÷�">1�����ҷ�</a></h3>
					<h3><a href="<?php echo APP_PATH;?>tools/gfnlpg.html">������������</a></h3>
					<h3><a href="<?php echo APP_PATH;?>tools/fdjsq.html">����������</a></h3>
  					<h3><a href="<?php echo APP_PATH;?>tools/tqhkjsq.html">��ǰ����������</a></h3>
					<h3><a href="<?php echo APP_PATH;?>tools/gjjdkjsq.html">��������������</a></h3>
					<h3><a href="<?php echo APP_PATH;?>tools/sfjsq.html">˰�Ѽ�����</a></h3>
				</div>
		</div>
	</div>
	<div class="hr10"></div>
</div>
<!--ҳβ begin-->
<?php include template("content","footer"); ?>