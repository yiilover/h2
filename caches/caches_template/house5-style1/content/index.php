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
				  ��������
					<i></i>
					<div>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>">�·�</a>
                        <a target="_blank" href="<?php echo catlink(6);?>" rel="nofollow"><?php echo catname(6);?></a>
						<a target="_blank" href="<?php echo ESF_PATH;?>" rel="nofollow">���ַ�</a>
                        <a target="_blank" href="<?php echo ESF_PATH;?>rent-list.html" rel="nofollow">��ͼ</a>
                        <a target="_blank" href="<?php echo catlink(53);?>" rel="nofollow"><?php echo catname(53);?></a>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>list-t6.html" rel="nofollow">����</a>
						<a target="_blank" href="<?php echo TUAN_PATH;?>" rel="nofollow">������</a>
						 <a target="_blank" href="<?php echo BBS_PATH;?>" rel="nofollow">ҵ����̳</a>
						<a target="_blank" href="<?php echo APP_PATH;?>wenfang-p1.html" rel="nofollow">�ʷ�</a>
						
					</div>
				</div>
			<span>��վ����:0701-5366533</span>
				<a href="<?php echo ESF_PATH;?>chushou.html" class="send" target="_blank">������ѷ�����Դ</a>
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
                    <li class="on"><a href="<?php echo HOUSE_PATH;?>" target="_blank">�·�</a></li>
                    <li><a href="<?php echo ESF_PATH;?>" target="_blank">���ַ�</a></li>
                    <li><a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">���ⷿ</a></li>
                    <li><a href="<?php echo catlink(6);?>" target="_blank">��Ѷ</a></li>
                    <li><a href="<?php echo BBS_PATH;?>" target="_blank">��̳</a></li>
                </ul>
                <a href="<?php echo APP_PATH;?>map/" class="map" target="_blank">��ͼ�ҷ�</a>
                <form action="<?php echo HOUSE_PATH;?>list.html" id="xinfang">
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>����/����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ������</a>
                            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>��Ŀ����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
                           <?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a data-val="-t<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
                        </div>
                    </div>
                    <div class="scp">
                        <input type="hidden" name="">
                        <span>�۸�Χ</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
		<?php $range_arr = getbox_name('13','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az����ҳ ����-�·��۸�-->
                        </div>
                    </div>
                    <input type="text" id="xfinput" value="����ؼ���" data-url="<?php echo HOUSE_PATH;?>list">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo ESF_PATH;?>list.html" style="display:none" method="post" target="_blank">
                    <div class="scp">
                        <input type="hidden" name="place">
                        <span>����/����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ������</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="area">
                        <span>���</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
	<?php $area_range_arr = getbox_name('39','area_range')?>
		<?php $n=1; if(is_array($area_range_arr)) foreach($area_range_arr AS $key => $v) { ?>
			 <a data-val="-c<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az����ҳ ����-���ַ����-->
                        </div>
                    </div>
                    <div class="scp" style="width:80px">
                        <input type="hidden" name="price">
                        <span>�۸�Χ</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
	<?php $range_arr = getbox_name('39','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az����ҳ ����-���ַ����ۼ۸�-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="room">
                        <span>����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
                              <a data-val="1" href="javascript:void(0)" >һ��</a>
  <a data-val="2" href="javascript:void(0)" >����</a>
  <a data-val="3" href="javascript:void(0)" >����</a>
  <a data-val="4" href="javascript:void(0)" >����</a>
  <a data-val="5" href="javascript:void(0)" >����</a>
<!--az����ҳ ����-���ַ�����-->
                        </div>
                    </div>
                    <input type="text" id="esfinput" name="keyword" value="������ؼ���">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo ESF_PATH;?>rent-list.html" style="display:none" method="post" target="_blank">
                    <div class="scp">
                        <input type="hidden" name="place">
                        <span>����/����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ������</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r);?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<!--az����ҳ ����-���·�����-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="area">
                        <span>���</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
	<?php $area_range_arr = getbox_name('41','area_range')?>
		<?php $n=1; if(is_array($area_range_arr)) foreach($area_range_arr AS $key => $v) { ?>
			 <a data-val="-c<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az����ҳ ����-���ַ����-->
                        </div>
                    </div>
                    <div class="scp" style="width:80px">
                        <input type="hidden" name="price">
                        <span>�۸�Χ</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
<?php $range_arr = getbox_name('41','range')?>
		<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
			 <a data-val="-p<?php echo $key;?>.html" href="javascript:void(0)" ><?php echo $v;?></a>
		 <?php $n++;}unset($n); ?>
<!--az����ҳ ����-���ַ�����۸�-->
                        </div>
                    </div>
                    <div class="scp" style="width:50px">
                        <input type="hidden" name="room">
                        <span>����</span>
                        <div>
                            <a data-val="" href="javascript:void(0)">ȫ��</a>
                              <a data-val="1" href="javascript:void(0)" >һ��</a>
  <a data-val="2" href="javascript:void(0)" >����</a>
  <a data-val="3" href="javascript:void(0)" >����</a>
  <a data-val="4" href="javascript:void(0)" >����</a>
  <a data-val="5" href="javascript:void(0)" >����</a>
<!--az����ҳ ����-���ַ�����-->
                        </div>
                    </div>
                    <input type="text" id="czfinput" value="������ؼ��֣�¥�����������" name="keyword">
                    <button type="submit"> </button>
                </form>
               
                <form action="<?php echo APP_PATH;?>index.php" style="display:none" id="zixun" method="GET" target="_blank">
                   <input type="hidden" name="s" value="search/index/init/siteid/1/">
                  <input type="hidden" name="typeid" value="1">
                    <input name="q" class="l" type="text" value="������ؼ���">
                    <button type="submit"> </button>
                </form>
                <form action="<?php echo BBS_PATH;?>search.php" style="display:none" id="luntan" method="get" target="_blank" onSubmit="document.charset='gbk';" accept-charset="gbk">
                    <div class="scp">
				        <input type="hidden" name="searchsubmit" value="yes">
                        <input type="hidden" name="mod" value="forum">
                        <span>��������</span>
                        <div>
                            <a data-val="forum" href="javascript:void(0)">����</a>
                            <a data-val="thread" href="javascript:void(0)">����</a>
                            <a data-val="forum" href="javascript:void(0)">���</a>
                            <a data-val="user" href="javascript:void(0)">�û�</a>
                        </div>
                    </div>
                    <input type="hidden" name="searchsubmit" value="yes">
                    <input class="m" type="text" value="������ؼ���" name="kw">
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
    <a href="<?php echo HOUSE_PATH;?>" target="_blank"><b>�·�</b></a>
    <a href="<?php echo catlink(26);?>" target="_blank">Ԥ��</a>
    <a href="<?php echo TUAN_PATH;?>" target="_blank">������</a>
    <a href="<?php echo catlink(29);?>" target="_blank">�Ż�</a>
    <a href="<?php echo HOUSE_PATH;?>baojia.html" target="_blank">����</a>
    <a href="<?php echo catlink(6);?>special/" target="_blank">ר��</a><br>
    <a href="<?php echo catlink(40);?>" target="_blank"><b>�ȵ�</b></a>
    <a href="<?php echo siteurl($siteid);?>/map/" target="_blank">��ͼ</a>
    <a href="<?php echo HOUSE_PATH;?>list-t7.html" target="_blank">д��¥</a>
    <a href="<?php echo HOUSE_PATH;?>list-t9.html" target="_blank">��Ԣ</a>
    <a href="<?php echo HOUSE_PATH;?>list-t8.html" target="_blank">����</a>
    <a href="<?php echo HOUSE_PATH;?>list-t6.html" target="_blank">����</a>
</p>
<p>
    <a href="<?php echo ESF_PATH;?>" target="_blank"><b>���ַ�</b></a>
    <a href="<?php echo ESF_PATH;?>list-h1.html" target="_blank">����</a>
    <a href="<?php echo ESF_PATH;?>list-h3.html" target="_blank">����</a>
    <a href="<?php echo ESF_PATH;?>map.html" target="_blank">��ͼ</a>
    <a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank">������</a><br>
    <a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank"><b>���ⷿ</b></a>
    <a href="<?php echo ESF_PATH;?>rent-list-h1.html" target="_blank">����</a>
    <a href="<?php echo ESF_PATH;?>rent-list-h3.html" target="_blank">����</a>
    <a href="<?php echo ESF_PATH;?>rent-list-l2.html" target="_blank">����</a>
    <a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank">������</a>
</p>
<p>
    <a href="<?php echo catlink(6);?>" target="_blank"><b>��Ѷ</b></a>
    <a href="<?php echo catlink(25);?>" target="_blank">����</a>
    <a href="<?php echo catlink(16);?>" target="_blank">ȫ��</a>
    <a href="<?php echo catlink(30);?>" target="_blank">�г�</a><br>
    <a href="<?php echo catlink(27);?>" target="_blank"><b>����</b></a>
    <a href="<?php echo catlink(33);?>" target="_blank">����</a>
    <a href="<?php echo catlink(32);?>" target="_blank">��Ƹ</a>
    <a href="<?php echo catlink(80);?>" target="_blank">����</a>
</p>
<p>
    <a href="<?php echo catlink(53);?>" target="_blank"><b>�Ҿ�</b></a>
    <a href="<?php echo catlink(57);?>" target="_blank">����</a>
    <a href="<?php echo catlink(56);?>" target="_blank">�Ź�</a>
    <a href="<?php echo catlink(58);?>" target="_blank">�ٿ�</a><br>
    <a href="<?php echo catlink(59);?>" target="_blank"><b>��װ</b></a>
     <a href="<?php echo catlink(114);?>" target="_blank">װ��</a>
    <a href="<?php echo catlink(55);?>" target="_blank">�ȵ�</a>
    <a href="<?php echo catlink(56);?>" target="_blank">ͼ��</a><!--ͼ��ID δ��-->
</p>
<p class="nob">
    <a href="<?php echo BBS_PATH;?>" target="_blank"><b>����</b></a>
    <a href="<?php echo HOUSE_PATH;?>qqqun-p1.html" target="_blank">ҵ��QQȺ</a>
    <a href="<?php echo HOUSE_PATH;?>wenfang-p1.html" target="_blank">�ʷ�</a><br>
    <a href="<?php echo BBS_PATH;?>" target="_blank"><b>ҵ��</b></a>
     <a href="<?php echo siteurl($siteid);?>/tools/fdjsq.html" target="_blank">����</a>
    <a href="<?php echo siteurl($siteid);?>/one.html" target="_blank">һ�����ҷ�</a>
</p><!--az����ҳ ����-->
		</div>

		<div class="adb cf"><!-- [��1]��ҳ-ͨ��6 -->
		<div class="mt2"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=31"></script></div></div>
		<div class="cona">
			<div class="conaT">
				<div class="conaTT">
					<img src="<?php echo APP_PATH;?>statics/house5-style1/index/img/xf.png" alt="" class="fl">
					<a href="<?php echo HOUSE_PATH;?>" target="_blank">�·���ҳ</a>|<a href="/map" target="_blank">��ͼ�ҷ�</a>|<a href="<?php echo HOUSE_PATH;?>baojia.html" target="_blank">¥�̱���</a>|<a href="/special/" target="_blank">��ר��</a>|<a href="<?php echo catlink(49);?>" target="_blank"><?php echo catname(49);?></a>|<a href="<?php echo catlink(27);?>" target="_blank"><?php echo catname(27);?></a>|<a href="<?php echo catlink(29);?>" target="_blank"><?php echo catname(29);?></a>|<a href="<?php echo HOUSE_PATH;?>hxlist.html" target="_blank">����ͼ</a>|<a href="/tools/fdjsq.html" target="_blank">����������</a>|<a href="<?php echo HOUSE_PATH;?>qqqun-p1.html" target="_blank">ҵ��QQȺ</a></div>
				<div class="xfs">
					<span>����ĸ��</span>
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
<span>װ��״����</span>
<?php $fix_arr = getbox_name('13','fix')?>
<?php $n=1; if(is_array($fix_arr)) foreach($fix_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'f');?>-f<?php echo $key;?>.html"><?php echo $v;?></a><?php $n++;}unset($n); ?>
<br>
<span>��������</span>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee3a82b09698607383a5d01b0653d667&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r)?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<span>¥����ɫ��</span>
<?php $type_arr = getbox_name('13','character')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a href="<?php echo HOUSE_PATH;?>list-l<?php echo $key;?>.html" val="-l<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?><br>
<span>���۵��ۣ�</span>
<?php $range_arr = getbox_name('13','range')?>
<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-p<?php echo $key;?>.html" val="-p<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
<br>
<span>¥�����ͣ�</span>
<?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-t<?php echo $key;?>.html" val="-t<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
<br>
<span>����ʱ�䣺</span>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o1.html">���¿���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o2.html">���¿���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o3.html">3���ڿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o4.html">6���ڿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o5.html">ǰ3���ѿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o6.html">ǰ6���ѿ���</a>
<span style="color:#F00"><B>¥��״̬��</B></span>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h2.html">����¥��</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h3.html">��������</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h1.html">β��</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h4.html">����¥��</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-h6.html">��Ʒ¥��</a><!--az����ҳ 2�·�����-->
				</div>
			</div>
			<div class="conab cf">
				<div class="conaL">
					<div id="tab41">
						<h4><a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank" class="more">����&gt;&gt;</a>
							<a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank" class="h4tab on"><span>�ȵ�¥��</span></a>
							<a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank" class="h4tab"><span>��Ʒ¥��</span></a></h4>
						<div class="autab">
							<div class="bl ibA cf mb2">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=de1a50556d08395f50f47eea984eccb9&action=lists&catid=14&where=hot+like+%27%254%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%4%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>">
                <img src="<?php echo thumb($v[thumb],100,53);?>" alt="<?php echo $v['title'];?>">
                <span><?php echo $v['title'];?></span>
            </a>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=df187ef318aaa425a3a7a698402da504&action=lists&catid=14&where=hot+like+%27%254%25%27+&order=listorder+DESC&limit=3%2C7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%4%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>
            <tr>
            <td width="56"><span>[<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr>  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
              
        </table>

<!--az����ҳ 2�ȵ�¥��-->
						</div>
						<div class="autab" style="display:none">
							<div class="bl ibA cf mb2">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8d58e5cc3001046afe77b515544a52ca&action=lists&catid=14&where=hot+like+%27%256%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>">
                <img src="<?php echo thumb($v[thumb],100,53);?>" alt="<?php echo $v['title'];?>">
                <span><?php echo $v['title'];?></span>
            </a>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az����ҳ 2�ؼ۷�Դ|ͼ-->
							</div>
							<table>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fe2fd720882dba5a1caf319e7482d3e7&action=lists&catid=14&where=hot+like+%27%256%25%27+&order=listorder+DESC&limit=3%2C7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>
            <tr>
            <td width="56"><span>[<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr>  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table><!--az����ҳ 2�ؼ۷�Դ|�б�-->
						</div>
					</div>
					<div id="tab12">
					<h4 class="mt10">
                                                <a href="<?php echo HOUSE_PATH;?>list-l6.html" target="_blank" class="h4tab on"><span>Ͷ��¥��</span></a>
						<a href="<?php echo HOUSE_PATH;?>list-l8.html" target="_blank" class="h4tab"><span>����¥��</span></a></h4>
						
					<div class="tabToplist">
<!--az����ҳ 2�ܵ������-->
						<table>
 	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=61b0f402aa661ef20c6c08d3921047e7&action=lists&catid=14&where=%60character%60+like+%27%256%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`character` like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

    <tr>
            <td width="56"><span><a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
    </tr>
     <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table>


                    	<table style="display:none">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=cac5dd2a12bc981bc4942ca93566db86&action=lists&catid=14&where=%60character%60+like+%27%258%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`character` like \'%8%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

    <tr>
            <td width="56"><span><a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
    </tr>
     <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</table>

<!--az����ҳ 2��400�绰����-->
					</div>
					</div>
				</div>
				<div class="conaR">
					<div class="conaRC cf">
						<div class="conaRCL">
							<div class="conRT">
								<a href="<?php echo catlink(37);?>" target="_blank" class="more">����&gt;&gt;</a>
								<h4><a target="_blank" href="<?php echo catlink(37);?>"><?php echo catname(37);?></a></h4>
							</div>
							<ul class="cul">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fa53fbf627a64db545c53ec5add909d8&action=lists&catid=37&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					<li><a target="_blank" <?php echo title_style($v[style]);?>  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
				<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
   
</ul><!--az����ҳ 2�·�����-->
							<div class="conRT mt10">
								<a href="<?php echo catlink(29);?>" target="_blank" class="more">����&gt;&gt;</a>
								<h4><a target="_blank" href="<?php echo catlink(29);?>"><?php echo catname(29);?></a></h4>
							</div>
							<ul class="cul">
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=521b95d7cb1df0895316f8645208e23e&action=lists&catid=29&moreinfo=1&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','moreinfo'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
								<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								<?php $house_info = get_relationinfo($v[xglp],14,1)?>
    <li><?php if($v[xglp]) { ?><a target="_blank"  title="[<?php echo $house_info['title'];?>] " href="<?php echo $house_info['url'];?>">[<?php echo $house_info['title'];?>] </a><?php } ?><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
   
</ul><!--([��1]��ҳ-�·�����-С���)����λ����-->
<ul class="mt5"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=204"></script></ul>
						</div>
						<div class="conaRCR">
							<div id="tab13">
								<h4 class="mb10"><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank" class="more">����&gt;&gt;</a>
									<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank" class="h4tab on"><span>����¥��</span></a>
									<a href="<?php echo HOUSE_PATH;?>list-h3.html" target="_blank" class="h4tab"><span>��������</span></a></h4>
								<table>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=144ee39ccc4bc6c47b87bcc35a4d27a8&action=lists&catid=14&where=hot+like+%27%255%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%5%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

            <tr>
            <td width="56"><span>[<a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           
    </table>


<!--az����ҳ 2����¥��-->
								<table style="display:none">
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=795b787bcbcae591ea6bb19a3304a515&action=lists&catid=14&where=hot+like+%27%253%25%27+&order=listorder+DESC&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%3%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php $menu_info = menu_info('3360',$v[region])?>

            <tr>
            <td width="56"><span>[<a target="_blank" title="<?php echo $menu_info['0'];?>" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a target="_blank"  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></span></td>
            <td width="72"><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></td>
            <td width="56"><span><?php echo getbox_val('13','type',$v['type']);?></span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </table>


<!--az����ҳ 2���ڿ���-->
							</div>
							<div id="tab31">
								<h4 class="mt10"><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank" class="more">����&gt;&gt;</a>                

<a href="<?php echo HOUSE_PATH;?>list-t8.html" target="_blank" class="h4tab on"><span>����</span></a>            
<a href="<?php echo HOUSE_PATH;?>list-t7.html" target="_blank" class="h4tab"><span>д��¥</span></a>
<a href="<?php echo HOUSE_PATH;?>list-t6.html" target="_blank" class="h4tab"><span>����</span></a>
									
									
								</h4>
														
<div class="ibA cf mb10">
										<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6f8581824f8b34a178abce184145190d&action=lists&catid=14&where=%60type%60+like+%27%258%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%8%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az����ҳ 3����-->
								</div>
<div class="ibA cf mb10" style="display:none">
										<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0eb8af360f8fcc87608b6abe6ace0af3&action=lists&catid=14&where=%60type%60+like+%27%257%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%7%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az����ҳ 2д��¥-->
								</div>

<div class="ibA cf mb10" style="display:none">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=69f793565b0081024e52cde15ce120f6&action=lists&catid=14&where=%60type%60+like+%27%256%25%27+&order=listorder+DESC&limit=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'`type` like \'%6%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
       <a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>">
			<img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],77,67);?>" />
			<span><?php echo $v['title'];?></span>
		</a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <!--az����ҳ 2����-->
								</div>
							</div>
							<div id="tab21">
								<h4><a href="<?php echo catlink(6);?>" target="_blank" class="more">����&gt;&gt;</a>
									<a href="<?php echo catlink(34);?>" target="_blank" class="h4tab on"><span><?php echo catname(34);?></span></a>
									<a href="<?php echo catlink(31);?>" target="_blank" class="h4tab"><span><?php echo catname(31);?></span></a></h4>
								<ul class="cul">
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6c63b949d6743d0ed106eca69e5f8388&action=lists&catid=34&posids=0&order=id+DESC&num=5&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'34','posids'=>'0','order'=>'id DESC',)).'6c63b949d6743d0ed106eca69e5f8388');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','posids'=>'0','order'=>'id DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								 <li><a target="_blank"  title="<?php echo $v['title'];?> " href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
								 </ul><!--az����ҳ 2����ר��-->
                                <ul class="cul" style="display:none">
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f45cb49a9fed17bcbd2cf4fd075bd923&action=lists&catid=31&posids=0&order=id+DESC&num=5&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'31','posids'=>'0','order'=>'id DESC',)).'f45cb49a9fed17bcbd2cf4fd075bd923');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'31','posids'=>'0','order'=>'id DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
								 <li><a target="_blank"  title="<?php echo $v['title'];?> " href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul><!--az����ҳ 2�Է��ռ�-->
							</div>
						</div>
					</div>
<div class="mt5 fr"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=203"></script></div>
<!--]��ҳ-�·���������-->
				</div>
			</div>
		</div>
		<div class="adb cf">
<!--����ҳ��� ͨ��7-->
<div class="mt2"><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=31"></script></div>
<div class="mt2"></div><!--����ҳ��� ͨ��7--></div>

		<div class="cona">
			<div class="conaT">
				<div class="conaTT">
					<img src="<?php echo APP_PATH;?>statics/house5-style1/index/img/es.png" alt="" class="fl">
					<a href="<?php echo ESF_PATH;?>list.html" target="_blank">���ַ�����</a>|<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">���ַ�����</a>|<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank">С���ҷ�</a>|
                    <a href="<?php echo ESF_PATH;?>map.html" target="_blank">��ͼ�ҷ�</a>|<a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank">������</a>|<a href="<?php echo catlink(66);?>" target="_blank">���ַ���Ѷ</a></div>
			</div>
			<div class="conab cf">
				<div class="conaL">
					<div id="tab22">
						<h4><a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="more">����&gt;&gt;</a>
							<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>���ַ�����</span></a>
							<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>�ⷿ����</span></a></h4>
						<ul class="esfs">


	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3361.html">������</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3362.html">����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3363.html">����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3365.html">�ٳ���</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3366.html">�ĵ���</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3367.html">��ɽ��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-r3364.html">��ҵ����</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p1.html" val="-p1">30������</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p2.html" val="-p2">30-40��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p3.html" val="-p3">40-50��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p4.html" val="-p4">50-60��</a>
		
	
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p5.html" val="-p5">60-80��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p6.html" val="-p6">80-100��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p7.html" val="-p7">100-150��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-p8.html" val="-p8">150-200��</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c1.html" val="-c1">70ƽ����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c3.html" val="-c3">70-90ƽ</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-c4.html" val="-c4">90-120ƽ</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>list-o120.html" val="-c5">120ƽ����</a>		
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>list-t1.html" target="_blank">һ��</a>
		<a href="<?php echo ESF_PATH;?>list-t2.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>list-t3.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>list-t4.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>list-t5.html" target="_blank">����</a>
	</li>
</ul><!--az����ҳ 4���ַ�����-->
						<ul class="esfs"  style="display:none">
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3361.html">������</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3362.html">����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3363.html">����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3365.html">�ٳ���</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3366.html">�ĵ���</a>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3367.html">��ɽ��</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-r3364.html">��ҵ����</a>
	</li>
	<li class="bl">
        <A href="<?php echo ESF_PATH;?>rent-list-p1.html" target="_blank">500����</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p3.html" target="_blank">600-700Ԫ</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p4.html" target="_blank">700-800Ԫ</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p5.html" target="_blank">800-1000Ԫ</A>
	</li>
	<li class="bl">
        <A href="<?php echo ESF_PATH;?>rent-list-p6.html" target="_blank">1000-1200Ԫ</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p7.html" target="_blank">1200-1500Ԫ</A>
        <A href="<?php echo ESF_PATH;?>rent-list-p8.html" target="_blank">1500Ԫ����</A>
	</li>
	<li class="bl">
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c1.html" val="-c1">70ƽ����</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c3.html" val="-c3">70-90ƽ</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-c4.html" val="-c4">90-120ƽ</a>
		<a target="_blank" href="<?php echo ESF_PATH;?>rent-list-o120.html" val="-c5">120ƽ����</a>
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>rent-list-t1.html" target="_blank">һ��</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t2.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t3.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t4.html" target="_blank">����</a>
		<a href="<?php echo ESF_PATH;?>rent-list-t5.html" target="_blank">����</a>
	</li>
</ul><!--az����ҳ 4�ⷿ����-->
					</div>
					<div id="tab23">
						<h4 class="cf"><a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank" class="more">����&gt;&gt;</a>
							<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" target="_blank" class="h4tab on"><span>����С��</span></a>
							<a href="<?php echo ESF_PATH;?>list-h3.html" target="_blank" class="h4tab"><span>���۶��ַ�</span></a></h4>
						<ul class="cul hotli">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f20b08e1f07b89322727f48aa8ba5361&action=lists&catid=110&num=8&order=listorder+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'110','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'8',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>	<?php $menu_info = menu_info('3360',$r[region])?>
            <li>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1d4476d6109efa7faba491db115f470c&action=esfcount&relation=%24r%5Bid%5D&catid=113&return=rentcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$rentcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'113','limit'=>'20',));}?>
            <span class="fr">��<i><?php echo $rentcount;?></i>��</span>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c244456ccc881a34b417f2031b1b656f&action=esfcount&relation=%24r%5Bid%5D&catid=112&return=esfcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$esfcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'112','limit'=>'20',));}?>
			<span class="fr">��<i><?php echo $esfcount;?></i>��</span>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			
			
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
        </li>	<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
    </ul><!--az����ҳ 4����С��-->
						<ul class="cul hotli" style="display:none">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4f6ceed923e8385c42d24501cd63bd51&action=lists&catid=112&where=flag+like+%27%253%25%27&num=8&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'flag like \'%3%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'8',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>��</span>
            <span class="fr"><?php echo $r['total_area'];?>�O</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--az����ҳ 4����д��¥-->
					</div>
				</div>
				<div class="conaR">
					<div class="conaRC cf">
						<div class="conaRCL" id="tab42">
							<h4 class="cf"><a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="more">����&gt;&gt;</a>
								<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>���ַ�Դ</span></a>
								<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>���ⷿԴ</span></a></h4>
							<div class="autab">
								<div class="ibA bl cf">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=be368e0b2034a122782c267e5b870dfe&action=lists&catid=112&where=flag+like+%27%251%25%27&num=3&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'flag like \'%1%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'3',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $rxq = get_relationxq($r[id],112,110)?>
               <a href="<?php echo $r['url'];?>" target="_blank">
                <img src="<?php echo thumb($rxq[thumb],90,78);?>" alt="<?php echo $rxq['title'];?>">
                <span><?php echo $rxq['title'];?></span>
            </a> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1198622848bbed1d85d4c3ec975ee68f&action=lists&catid=112&num=13&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'13',));}?>
		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><?php $menu_info = menu_info('3360',$r[region])?>
		<?php $rxq = get_relationxq($r[id],112,110)?>
            <tr>
            <td width="56"><span>[<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo $rxq['title'];?></a></span></td>
            <td width="48"><span><?php echo $r['huxingshi'];?>��<?php echo $r['huxingting'];?>��</span></td>
            <td width="48"><span><?php echo $r['total_area'];?>�O</span></td>
            <td width="56"><span><?php echo $r['price'];?>��</span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
        </table><!--az����ҳ 4���ַ�Դ-->
							</div>
							<div class="autab" style="display:none">
								<div class="ibA bl cf">
              <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=aabc28dc9055c9936c47bbb83c375e71&action=lists&catid=113&where=flag+like+%27%251%25%27&num=3&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'113','where'=>'flag like \'%1%\'','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'3',));}?><?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $rxq = get_relationxq($r[id],113,110)?>
               <a href="<?php echo $r['url'];?>" target="_blank">
                <img src="<?php echo thumb($rxq[thumb],90,78);?>" alt="<?php echo $rxq['title'];?>">
                <span><?php echo $rxq['title'];?></span>
            </a> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
<table>
           <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=39d53d33eac31abe127936b53c096e85&action=lists&catid=113&num=13&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'113','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'13',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><?php $menu_info = menu_info('3360',$r[region])?>
		<?php $rxq = get_relationxq($r[id],113,110)?>
            <tr>
            <td width="56"><span>[<a href="<?php echo ESF_PATH;?>rent-list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]</span></td>
            <td><span><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo $rxq['title'];?></a></span></td>
            <td width="48"><span><?php echo $r['huxingshi'];?>��<?php echo $r['huxingting'];?>��</span></td>
            <td width="48"><span><?php echo $r['total_area'];?>�O</span></td>
            <td width="56"><span><?php echo $r['price'];?>Ԫ/��</span></td>
        </tr><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
             
        </table><!--az����ҳ 4���ⷿԴ-->
							</div>
						</div>
						<div class="conaRCR">
							<div id="tab24">
								<h4>
									<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="h4tab on"><span>���ַ���ɫ</span></a>
									<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank" class="h4tab"><span>�ⷿ��ɫ</span></a></h4>
									<ul class="esfs">
	<li class="bl">
		<a href="<?php echo ESF_PATH;?>list-f1.html" target="_blank">ë��</a>
		<a href="<?php echo ESF_PATH;?>list-f2.html" target="_blank">��װ</a>
		<a href="<?php echo ESF_PATH;?>list-f3.html" target="_blank">�е�װ��</a>        
		<a href="<?php echo ESF_PATH;?>list-f4.html" target="_blank">��װ</a>
		<a href="<?php echo ESF_PATH;?>list-f5.html" target="_blank">����װ��</a>
		<a href="<?php echo ESF_PATH;?>list-f6.html" target="_blank">ԭ��</a> 
	</li>
	<li class="bl">
		
		<a href="<?php echo ESF_PATH;?>list-l1.html" target="_blank">6������</a>
        <a href="<?php echo ESF_PATH;?>list-l2.html" target="_blank">6-12��</a>
        <a href="<?php echo ESF_PATH;?>list-l3.html" target="_blank">12-20��</a>
        <a href="<?php echo ESF_PATH;?>list-l4.html" target="_blank">20������</a>
	</li>
	<li class="bl">
		  <a href="<?php echo ESF_PATH;?>list-y1.html" target="_blank">2000����ǰ</a>
          <a href="<?php echo ESF_PATH;?>list-y2.html" target="_blank">2000���Ժ�</a>
          <a href="<?php echo ESF_PATH;?>list-y3.html" target="_blank">2005���Ժ�</a>
          <a href="<?php echo ESF_PATH;?>list-y4.html" target="_blank">2010���Ժ�</a>
	</li>
	<li>
		<a href="<?php echo ESF_PATH;?>list.html" target="_blank" class="c">����</a> 
		<a href="<?php echo ESF_PATH;?>list-o2.html" target="_blank">3���ڷ���</a>
		<a href="<?php echo ESF_PATH;?>list-o3.html" target="_blank">7���ڷ���</a>
		<a href="<?php echo ESF_PATH;?>list-o4.html" target="_blank">15���ڷ���</a>
		<a href="<?php echo ESF_PATH;?>list-o5.html" target="_blank">30���ڷ���</a>
	</li>
</ul><!--az����ҳ 4д��¥�������-->
									<ul class="esfs" style="display:none">
	<li class="bl">
		        <a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">����</a> 
				<a href="<?php echo ESF_PATH;?>rent-list-u2.html" target="_blank">�н�</a> 
				<a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank">����</a> 
	</li>
	<li class="bl">
		<a href="<?php echo ESF_PATH;?>rent-list.html" target="_blank">����</a>
				                    <a href="<?php echo ESF_PATH;?>rent-list-l1.html" target="_blank">����</a>
                                	<a href="<?php echo ESF_PATH;?>rent-list-l2.html" target="_blank">����</a>
                                	<a href="<?php echo ESF_PATH;?>rent-list-l3.html" target="_blank">����</a>
	</li>
	<li class="bl">
							   		<a href="<?php echo ESF_PATH;?>rent-list-f1.html" target="_blank">ë��</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f2.html" target="_blank">��װ</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f3.html" target="_blank">�е�װ��</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f4.html" target="_blank">��װ</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f5.html" target="_blank">����װ��</a> 
               	               		<a href="<?php echo ESF_PATH;?>rent-list-f6.html" target="_blank">ԭ��</a> 
	</li>
	<li>
	<a href="rent-list-u2.html" target="_blank">����</a> 
					<a href="<?php echo ESF_PATH;?>rent-list-o2.html" target="_blank">3���ڷ���</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o3.html" target="_blank">7���ڷ���</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o4.html" target="_blank">15���ڷ���</a>
					<a href="<?php echo ESF_PATH;?>rent-list-o5.html" target="_blank">30���ڷ���</a>
	</li>
</ul><!--az����ҳ 4д��¥���ۿ���-->
							</div>
							<div id="tab25">
								<h4>
									<a href="<?php echo ESF_PATH;?>rent-list-u2.html" target="_blank" class="h4tab on"><span>�н�</span></a>
									<a href="<?php echo ESF_PATH;?>rent-list-u1.html" target="_blank" class="h4tab"><span>����</span></a></h4>
									<ul class="cul hotli">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4a6a0cae8100d691c15ef25d1b52c227&action=lists&catid=112&where=isbroker%3D1&num=6&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'isbroker=1','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'6',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>��</span>
            <span class="fr"><?php echo $r['total_area'];?>�O</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--az����ҳ 4���̳������-->
									<ul class="cul hotli" style="display:none">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=adf95d3c347a8b2007b4dc13e0071353&action=lists&catid=112&where=isbroker%3D0&num=6&order=updatetime+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>'isbroker=0','order'=>'updatetime DESC','moreinfo'=>'1','limit'=>'6',));}?>
 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?> <?php $menu_info = menu_info('3360',$r[region])?>
 <?php $rxq = get_relationxq($r[id],112,110)?>
            <li>
            <span class="fr"><?php echo $r['price'];?>��</span>
            <span class="fr"><?php echo $r['total_area'];?>�O</span>
            [<a href="<?php echo ESF_PATH;?>list-r<?php echo $menu_info['1'];?>.html" target="_blank"><?php echo $menu_info['0'];?></a>]
            <a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $rxq['title'];?></a>
        </li>
        <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul><!--az����ҳ 4���̳��ۿ���-->
							</div>
							<h4><a href="<?php echo ESF_PATH;?>jingjiren/" target="_blank" class="more">����&gt;&gt;</a><a target="_blank" href="<?php echo ESF_PATH;?>jingjiren/">����������</a></h4>
							<ul class="cf jjrimg">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=0eaea06bd802853761909dfe5aa29a3d&action=memberlist&type=1&order=point+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'5',));}?>
							<?php $n=1; if(is_array($data['result'])) foreach($data['result'] AS $k => $v) { ?> 
				
    <li>		<a target="_blank" title="<?php echo $v['truename'];?>" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>">
			<img alt="<?php echo $v['truename'];?>" src="<?php echo $avatar;?>" />
		</a>
		<a target="_blank"  title="<?php echo $v['truename'];?>" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>"><?php echo $v['truename'];?></a>
    </li> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
  
</ul><!--az����ҳ 4���㾭����-->
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="adb cf"><div><script language="javascript" src="<?php echo APP_PATH;?>index.php?s=poster/index/show_poster&id=206"></script></div><!--nz����ҳ��� ͨ��9--></div>
		<div class="conb">
			<h3>���а�</h3>
			<div class="cf toplist">
				<ul class="l">
    <li class="b">һ����Ѷ����</li>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e71a6e1b6c4e550980dd593104096c64&action=hits&catid=6&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>
				 <ul>
    <li class="b">һ��¥������</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6a76a3418858249c852733001bad53b1&action=hits&catid=14&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['views'];?>��</span><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
        </ul>
				<ul>
    <li class="b">һ��С������</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c8dad494a9fc49415b0fb82eee0c21c5&action=hits&catid=110&order=weekviews+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'110','order'=>'weekviews DESC','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['views'];?>��</span><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     
    </ul>
				<ul class="l">
    <li class="b">һ���Ź�����</li>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=69b4739aa86e69c03ec78d8d7756e1f8&action=toptuangou&years=1&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'toptuangou')) {$data = $content_tag->toptuangou(array('years'=>'1','limit'=>'10',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><span class="fr"><?php echo $v['counts'];?>��</span><a target="_blank" title="<?php echo $v['subject'];?>" href="<?php echo HOUSE_PATH;?><?php echo $v['relation'];?>"><?php echo $v['subject'];?></a></li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
           
    </ul>
			</div>
		</div>
        <div class="adb cf"><!--nz����ҳ��� ͨ��7--></div>
		<div class="conb">
			<h3>
				<span class="ztControl" id="ztControl">
					<i class="l"></i>
					<i class="on"></i>
					<i></i>
					<i></i>
					<i class="r"></i>
				</span>
			���ʻع�</h3>
			<div class="ztcon ibA">
				<ul id="ztcon">
	 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=93c4e8892c4cf021b0593762985611d3&action=lists&posid=0&catid=6&thumb=1&order=listorder+DESC&num=18\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('posid'=>'0','catid'=>'6','thumb'=>'1','order'=>'listorder DESC','limit'=>'18',));}?>
		 <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
	    <li> <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
            <img src="<?php echo thumb($v[thumb],143,108);?>" alt="<?php echo $v['title'];?>" />
            <span><?php echo $v['title'];?></span>
        </a>
    </li>
  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>
<!--az����ҳ ���ʻع�-->
			</div>
		</div>

<div class="friendslink">
			<h3>�������</h3>
			<ul class="cf">
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=228c445fc692f915e8591138bcaf272b&action=type_list&typeid=41&siteid=1&linktype=1&order=listorder+DESC&num=18&return=pic_link\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$pic_link = $link_tag->type_list(array('typeid'=>'41','siteid'=>'1','linktype'=>'1','order'=>'listorder DESC','limit'=>'18',));}?> 
            <?php $n=1;if(is_array($pic_link)) foreach($pic_link AS $v) { ?>
			 <li><a target="_blank" href="<?php echo $v['url'];?>"><img width="90" height="40" border="0" alt="<?php echo $v['name'];?>" src="<?php echo $v['logo'];?>"></a></li>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			 </ul>
			 <!--az����ҳ �������-->
		</div>

		

		<div class="friendslink">
			<h3>��������</h3>
			<ul class="cf">
			  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"link\" data=\"op=link&tag_md5=b0f527e540bdf059adc26aad25b4f840&action=type_list&typeid=42&siteid=1&order=listorder+DESC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�޸�</a>";}$link_tag = h5_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'42','siteid'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
			   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
 <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['name'];?>" target="_blank"><?php echo $r['name'];?></a></li>
             <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			 </ul>
			 <!--az����ҳ ��������-->
		</div>
	</div>
</div>
<script type="text/javascript">
seajs.use("indexcontrol")
</script>
<?php include template("content","footer"); ?>
</body>
</html><!--b������ҳ �°��ע1-->