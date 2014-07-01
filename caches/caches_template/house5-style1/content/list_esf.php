<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
	<link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/esf.css"  rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/default/js/esf/sea.js"  type="text/javascript"></script>
</head>
<body>
	<div id="main">
		<div id="header">
	<?php include template("ssi","ssi_8"); ?>
<script type="text/javascript">
seajs.use("topbarlogin")
</script>	<h1>
		<a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
			<img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a>
		</h1>
	<div id="Search">
		<ul class="searchURL">
			<li><a href="<?php echo catlink(6);?>"  target="_blank">��Ѷ</a></li>			
			<li><a href="<?php echo HOUSE_PATH;?>"  target="_blank">�·�</a></li>
			<li class="on"><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">���ַ�</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">���ⷿ</a></li>
			<li><a href="<?php echo catlink(7);?>"  target="_blank">ͼ��</a></li>
			<li><a href="<?php echo catlink(10);?>"  target="_blank">��Ƶ</a></li>
			<li class="more"><a href="javascript:void(0)">����<em></em></a>
				<div>
					<a href="<?php echo BBS_PATH;?>"  target="_blank">��̳</a>
				</div>
			</li>
		</ul>
		<a href="map.html"  class="mapS" target="_blank">��ͼ�ҷ�</a>
<?php
$param = $_GET['param'];
	if(!empty($param)&&stristr($param,'-')!=false)
	{
		$param_arr = explode('-', $param);
		foreach($param_arr as $_v) {
				if($_v) 
				{
					if(preg_match ( '/([a-z])([0-9_]+)/', $_v, $matchs))
					{
						$$matchs[1] = trim($matchs[2]);
					}
				}
			}
		$parentid = $r;
		$bid = $b;
		$eprice = $e;
		$marea = $m;
		$range = $p;
		$type = $t;
		$fix = $f;
		$year = $y;
		$source = $u;
		$floor = $l;
		$opentime = $o;
		$hot = $h;
		$ord = $n;
		$area = $c;
		$page = $g;
	}
	else
	{
 	$parentid = intval($_GET['r']);
	$bid = intval($_GET['b']);
	$eprice = trim($_GET['e']);
	$marea = trim($_GET['m']);
	$range = intval($_GET['p']);
	$type = intval($_GET['t']);
	$fix = intval($_GET['f']);
	$year = intval($_GET['y']);
	$floor = intval($_GET['l']);
	$source = intval($_GET['u']);
	$opentime = intval($_GET['o']);
	$hot = intval($_GET['h']);
	$ord = intval($_GET['n']);
	$area = intval($_GET['c']);
	$page = intval($_GET['g']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	}
	
	$where = "status=99 and house_status=1";
	if(!empty($keyword))
	{
		$keyword1 = iconv('gbk', 'utf-8', $keyword);//rewrite ֻ֧��UTF-8���������
		$lst1.= "-k".htmlentities(urlencode($keyword1));
		$where.=" and (`title` like '%$keyword%' or `address` like '%$keyword%' )";
	}
	if(!empty($k))
	{
		$keyword = iconv('utf-8','gbk' , $k);
		$lst1.= "-k".htmlentities(urlencode($k));
		$where.=" and (`communityname` like '%$keyword%')";
		$lstaddr.= "<em>".$keyword."<a href=\"list.html\"></a></em>";
	}
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
	}
	if(!empty($bid))
	{
		$lst.= "-b".$bid;
	}
	if(!empty($parentid) && !empty($bid))
	{
		$where.=" and `region`=$bid";
	}
	elseif(!empty($parentid) && empty($bid))//���򶥼�
	{
		$arrchildid = get_arrchildid('3360',$parentid);
		$where.=" and `region` in ($arrchildid)";
	}
	if(!empty($eprice))
	{
		if(stripos($eprice,'_')!==false)
		{
			$pricearr = explode('_',$eprice);
			$minprice = intval($pricearr[0]);
			$maxprice = intval($pricearr[1]);
			if($maxprice>0)
			{
				$lst.= "-e".$eprice;
				$where.=" and `price`>$minprice and `price`<=$maxprice";
				if($minprice==0)
				{
					$range_name = $maxprice."������";
				}
				else
				{
					$range_name = $minprice."-".$maxprice."��";
				}
			}
		}
		else
		{
			$minprice = $eprice;
			$lst.= "-e".$eprice;
			$where.=" and `price`>$eprice";
			$range_name = $eprice."������";
		}
		
	}
	if(!empty($range))
	{
		$lst.= "-p".$range;
		$where.=" and `range`=$range";
		if($range==1)
		{
			$range_name="50������";
		}
		elseif($range==2)
		{
			$range_name="50-80��";
		}
		elseif($range==3)
		{
			$range_name="80-100��";
		}
		elseif($range==4)
		{
			$range_name="100-150��";
		}
		elseif($range==5)
		{
			$range_name="150-200��";
		}
		elseif($range==6)
		{
			$range_name="200-250��";
		}
		elseif($range==7)
		{
			$range_name="250-300��";
		}
		elseif($range==8)
		{
			$range_name="300-400��";
		}
	}
	if(!empty($type))
	{
		$lst.= "-t".$type;
		$where.=" and `huxingshi`=$type";
		if($type==1)
		{
			$type_name="һ��";
		}
		elseif($type==2)
		{
			$type_name="����";
		}
		elseif($type==3)
		{
			$type_name="����";
		}
		elseif($type==4)
		{
			$type_name="����";
		}
		else
		{
			$type_name="����";
		}
	}
	if(!empty($fix))
	{
		$lst.= "-f".$fix;
		$where.=" and `fix`=$fix";
		if($fix==1)
		{
			$fix_name = "ë��";
		}
		elseif($fix==2)
		{
			$fix_name = "��װ";
		}
		elseif($fix==3)
		{
			$fix_name = "�е�װ��";
		}
		elseif($fix==4)
		{
			$fix_name = "��װ";
		}
		elseif($fix==5)
		{
			$fix_name = "����װ��";
		}
		elseif($fix==6)
		{
			$fix_name = "ԭ��";
		}
	}
	if(!empty($year))
	{
		$lst.= "-y".$year;
		if($year==1)
		{
			$where.=" and `house_age`<='2000'";
			$year_name = "2000����ǰ";
		}
		elseif($year==2)
		{
			$where.=" and `house_age`>'2000' and `house_age`<='2005'";
			$year_name = "20000���Ժ�";
		}
		elseif($year==3)
		{
			$where.=" and `house_age`>'2005' and `house_age`<='2010'";
			$year_name = "2005���Ժ�";
		}
		elseif($year==4)
		{
			$where.=" and `house_age`>'2010'";
			$year_name = "2010���Ժ�";
		}
	}
	if(!empty($floor))
	{
		$lst.= "-l".$floor;
		if($floor==1)
		{
			$where.=" and `floor`<='6'";
			$floor_name = "6������";
		}
		elseif($floor==2)
		{
			$where.=" and `floor`>'6' and `floor`<='12'";
			$floor_name = "6-12��";
		}
		elseif($floor==3)
		{
			$where.=" and `floor`>'12' and `floor`<='20'";
			$floor_name = "12-20��";
		}
		elseif($floor==4)
		{
			$where.=" and `floor`>'20'";
			$floor_name = "20������";
		}
	}
	if(!empty($source))
	{
		$lst.= "-u".$source;
		if($source==1)
		{
			$source_name = "����";
			$where.=" and isbroker=0";
		}
		elseif($source==2)
		{
			$source_name = "�н�";
			$where.=" and isbroker=1";
		}
	}
	if(!empty($marea))
	{
		if(stripos($marea,'_')!==false)
		{
			$areaarr = explode('_',$marea);
			$minarea = intval($areaarr[0]);
			$maxarea = intval($areaarr[1]);
			if($maxarea>0)
			{
				$lst.= "-m".$marea;
				$where.=" and `total_area`>$minarea and `total_area`<=$maxarea";
				if($minarea==0)
				{
					$area_name = $maxarea."ƽ������";
				}
				else
				{
					$area_name = $minarea."-".$maxarea."ƽ��";
				}
			}
		}
		else
		{
			$minarea = $marea;
			$lst.= "-m".$marea;
			$where.=" and `total_area`>$marea";
			$area_name = $marea."ƽ������";
		}
	}
	if(!empty($area))
	{
		$lst.= "-c".$area;
		$where.=" and `area_range`=$area";
		if($area==1)
		{
			$area_name="70ƽ������";
		}
		elseif($area==3)
		{
			$area_name="70-90ƽ��";
		}
		elseif($area==4)
		{
			$area_name="90-120ƽ��";
		}
		elseif($area==5)
		{
			$area_name="120-150ƽ��";
		}
		elseif($area==6)
		{
			$area_name="150-200ƽ��";
		}
		elseif($area==7)
		{
			$area_name="200-300ƽ��";
		}
		elseif($area==8)
		{
			$area_name="300ƽ������";
		}
	}
	if(!empty($opentime))
	{
		$lst.= "-o".$opentime;
		if($opentime=='2')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//3����
			$opentime_name= "3����";
		}
		elseif($opentime=='3')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 7 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//7����
			$opentime_name= "7����";
		}
		elseif($opentime=='4')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 15 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//15����
			$opentime_name= "15����";
		}
		elseif($opentime=='5')
		{
			$where.=" and DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 30 DAY),'%Y%m%d')<= FROM_UNIXTIME(inputtime,'%Y%m%d')";//30����
			$opentime_name= "30����";
		}
	}
	if(!empty($hot))
	{
			$where.=" and `flag` like '%$hot%'";
			$lst.= "-h".$hot;
	}
	if(!empty($ord))
	{
		if($ord=='2')
		{
			$order="  CAST(`total_area` AS SIGNED) DESC";
			$order_name = "����Ӵ�С";
		}
		elseif($ord=='3')
		{
			$order=" CAST(`total_area` AS SIGNED) ASC";
			$order_name = "�����С����";
		}
		elseif($ord=='4')
		{
			$order=" `mprice` DESC";
			$order_name = "���۴Ӹߵ���";
		}
		elseif($ord=='5')
		{
			$order=" `mprice` ASC";
			$order_name = "���۴ӵ͵���";
		}
		elseif($ord=='6')
		{
			$order=" CAST(price AS SIGNED) DESC";
			$order_name = "�ܼ۴Ӹߵ���";
		}
		elseif($ord=='7')
		{
			$order=" CAST(price AS SIGNED) ASC";
			$order_name = "�ܼ۴ӵ͵���";
		}
		else
		{
			$order=" `listorder` desc,`updatetime` DESC";
			$order_name = "Ĭ������";
		}
		$lst.= "-n".$ord;
	}
	else
	{
		$order = "`listorder` desc,`updatetime` DESC";
		$order_name = "Ĭ������";
	}
	?>
		<div id="qy">
			<?php if(!empty($parentid)) { ?>
			<?php $menu_info = menu_info('3360',$parentid)?>
			<span><?php echo $menu_info['0'];?></span>
			<?php } else { ?>
			<span>����/����</span>
			<?php } ?>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ������</a>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
												</div>
		</div>
		<div data-k = "ƽ" id="wy" data-val="<?php if(!empty($marea)) { ?>-m<?php echo $marea;?><?php } ?>">
			<span><?php if(!empty($area_name)) { ?><?php echo $area_name;?><?php } else { ?>���<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a <?php if($area=="1") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c1">70ƽ������</a>
											<a <?php if($area=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c3">70-90ƽ��</a>
											<a <?php if($area=="4") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c4">90-120ƽ��</a>
											<a <?php if($area=="5") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c5">120-150ƽ��</a>
											<a <?php if($area=="6") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c6">150-200ƽ��</a>
											<a <?php if($area=="7") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c7">200-300ƽ��</a>
											<a <?php if($area=="8") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-c8">300ƽ������</a>
												</div>
		</div>
		<div data-k = "��" id="jg" data-val="<?php if(!empty($eprice)) { ?>-e<?php echo $eprice;?><?php } ?>">
			<span><?php if(!empty($range_name)) { ?><?php echo $range_name;?><?php } else { ?>�۸�Χ<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a <?php if($range=="1") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p1">50������</a>
											<a <?php if($range=="2") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p2">50-80��</a>
											<a <?php if($range=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p3">80100��</a>
											<a <?php if($range=="4") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p4">100-150��</a>
											<a <?php if($range=="5") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p5">150-200��</a>
											<a <?php if($range=="6") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p6">200-250��</a>
											<a <?php if($range=="7") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p7">250-300��</a>
											<a <?php if($range=="8") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p8">300-400��</a>
												</div>
		</div>
		<div id="shx">
			<span><?php if(!empty($type_name)) { ?><?php echo $type_name;?><?php } else { ?>����<?php } ?></span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a <?php if($type=="1") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t1">һ��</a>
											<a <?php if($type=="2") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t2">����</a>
											<a <?php if($type=="3") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t3">����</a>
											<a <?php if($type=="4") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t4">����</a>
											<a <?php if($type=="5") { ?>  class="on"<?php } ?> href="javascript:void(0)" data-val="-t5">����</a>
												</div>
		</div>
		<input type="text" data-val="<?php if(empty($k)) { ?>������ؼ��֣�¥�����������<?php } else { ?><?php echo $keyword;?><?php } ?>" value="<?php if(empty($k)) { ?>������ؼ��֣�¥�����������<?php } else { ?><?php echo $keyword;?><?php } ?>">
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
			<li >
				<a href="<?php echo ESF_PATH;?>" >��ҳ<em></em></a>
			</li>
			<li class="s">
				<a href="<?php echo ESF_PATH;?>list.html" >���۷�Դ<em></em></a>
			<li >
				<a href="<?php echo ESF_PATH;?>rent-list.html" >���ⷿԴ<em></em></a>
			</li>
			<li>
				<a href="<?php echo ESF_PATH;?>map.html"  target="_blank">��ͼ�ҷ�<em></em></a>
			</li>
			<li >
				<a href="<?php echo ESF_PATH;?>xiaoqu-list.html" >С���ҷ�<em></em></a>
			</li>
			<li >
				<a href="<?php echo ESF_PATH;?>jingjiren" >������<em></em></a>
			</li>
			<li>
				<a href="<?php echo catlink(6);?>"  target="_blank">��Ѷ<em></em></a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","hsearch"],function($){
		$("#Search").hSearch("list","<?php echo APP_PATH;?>api.php?op=esfsuggest");
		$("#jg,#wy").each(function(){
			var $t=$(this);
			var t=$t.attr("data-val");
			if(t){
				$t.data("val",$t.attr("data-val"));
				var k=$t.attr("data-k");
				t=t.substring(2).split("_");
				if(t[0]==0)
					$t.find("span").html(t[1]+k+"����");
				else if(t.length==1)
					$t.find("span").html(t[0]+k+"����");
				else
					$t.find("span").html(t.join("-")+k);
			}
		});
	})
</script>		<div class="bread">
			����ǰ��λ�ã�<a href="<?php echo APP_PATH;?>" ><?php echo $site_title;?></a> &gt;
			<a href="<?php echo APP_PATH;?>esf" ><?php echo $default_city;?>���ַ���</a> &gt;
			��Դ�б�
		</div>
		<div class="modB">
	<a href="<?php echo ESF_PATH;?>chushou.html"  target="_blank" class="fbfr">������ѷ�����Դ</a>
	<ul class="modTab">
	<li class="on"><a href="<?php echo ESF_PATH;?>list.html" >ȫ����Դ</a></li>
	<li><a href="<?php echo ESF_PATH;?>map.html"  target="_blank">��ͼ�ҷ�</a></li>
	<li><a href="<?php echo ESF_PATH;?>xiaoqu-list.html"  target="_blank">С���ҷ�</a></li>
	<li></li>
</ul>
<div class="conl1" id="conl1">
	<div class="cf" style="padding-top:9px;">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span>
			<span>
				<a href="list<?php echo deal_str($lst,'r');?>.html" <?php if(empty($parentid)) { ?>  class="c" <?php } ?>>����</a>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	if(!empty($parentid) && $parentid==$reg[0] && empty($bid))
	{
		$lstaddr.= "<em>".$reg[1]."<a href=\"list".deal_str($lst,'r').".html\"></a></em>";
	}
	?>
	<a href="list-r<?php echo $reg['0'];?><?php echo deal_str($lst,'r');?>.html" <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="c"<?php } ?>><?php echo $reg['1'];?></a>
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	                			  				</span>
<?php if($parentid) { ?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e3d28ce1f67a9f7addc16249214e52e5&action=getlinkage&keyid=3360&parentid=%24parentid&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC',)).'e3d28ce1f67a9f7addc16249214e52e5');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
												<!--�����ǰ����Ϣ����������ų��ֵ�-->
												<span class="i">
				<a href="list<?php echo deal_str($lst,'b');?>.html" <?php if(empty($bid)) { ?> class="c"<?php } ?>>����</a>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php
				$reg2 = explode('$$', $r);//add by L 2012/3/22
				if(!empty($bid) && $bid==$reg2[0])
				{
					$lstaddr.= "<em>".$reg2[1]."<a href=\"list".deal_str($lst,'r').".html\"></a></em>";
				}
				?>
				               		<a href="list<?php echo deal_str($lst,'b');?>-b<?php echo $reg2['0'];?>.html" <?php if(!empty($bid) && $bid==$reg2[0]) { ?> class="c"<?php } ?>><?php echo $reg2['1'];?></a>
									<?php $n++;}unset($n); ?>
               				</span>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
					</div>
		<div class="cf">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span>
			<span>
				<a <?php if(empty($range)) { ?> class="c"<?php } ?> href="list<?php echo deal_str($lst,'p');?>.html" >����</a>
				<a href="list<?php echo deal_str($lst,'p');?>-p1.html" <?php if($range=="1") { ?> class="c"<?php } ?>>50������</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p2.html" <?php if($range=="2") { ?> class="c"<?php } ?>>50-80��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p3.html" <?php if($range=="3") { ?> class="c"<?php } ?>>80-100��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p4.html" <?php if($range=="4") { ?> class="c"<?php } ?>>100-150��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p5.html" <?php if($range=="5") { ?> class="c"<?php } ?>>150-200��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p6.html" <?php if($range=="6") { ?> class="c"<?php } ?>>200-250��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p7.html" <?php if($range=="7") { ?> class="c"<?php } ?>>250-300��</a> 
				<a href="list<?php echo deal_str($lst,'p');?>-p8.html" <?php if($range=="8") { ?> class="c"<?php } ?>>300-400��</a> 
				<?php
			if(!empty($range_name))
				{
					$lstaddr.= "<em>".$range_name."<a href=\"list".deal_str($lst,'p').".html\"></a></em>";
				}
			?>
              										<div class="autoF">
					<form action="list<?php echo deal_str($lst,'p');?>-e" method="get">
						<input type="text" value="<?php echo $minprice;?>"> - 
						<input type="text" value="<?php echo $maxprice;?>"> ��
						<button type="button"></button>
					</form>
				</div>
			</span>
		</div>
		<div class="cf">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����</span>
			<span>
				<a href="list<?php echo deal_str($lst,'c');?>.html" <?php if(empty($area)) { ?> class="c"<?php } ?>  >����</a>
							   	               	<a href="list<?php echo deal_str($lst,'c');?>-c1.html" <?php if($area=="1") { ?> class="c"<?php } ?>>70ƽ������</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c3.html" <?php if($area=="3") { ?> class="c"<?php } ?>>70-90ƽ��</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c4.html" <?php if($area=="4") { ?> class="c"<?php } ?>>90-120ƽ��</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c5.html" <?php if($area=="5") { ?> class="c"<?php } ?>>120-150ƽ��</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c6.html" <?php if($area=="6") { ?> class="c"<?php } ?>>150-200ƽ��</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c7.html" <?php if($area=="7") { ?> class="c"<?php } ?>>200-300ƽ��</a> 
               	               	<a href="list<?php echo deal_str($lst,'c');?>-c8.html" <?php if($area=="8") { ?> class="c"<?php } ?>>300ƽ������</a> 
					<?php
			if(!empty($area_name))
				{
					$lstaddr.= "<em>".$area_name."<a href=\"list".deal_str($lst,'c').".html\"></a></em>";
				}
			?>
               				   				   	<div class="autoF">
					<form action="list<?php echo deal_str($lst,'c');?>-m" method="get">
						<input type="text" value="<?php echo $minarea;?>"> - 
						<input type="text" value="<?php echo $maxarea;?>"> ƽ
						<button type="button"></button>
					</form>
				</div>
			</span>
		</div>
		<div class="cf">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ͣ�</span>
			<span>
				<a href="list<?php echo deal_str($lst,'t');?>.html"  <?php if(empty($type)) { ?> class="c" <?php } ?>>����</a>
							   	    <a href="list<?php echo deal_str($lst,'t');?>-t1.html" <?php if($type=="1") { ?> class="c" <?php } ?>>һ��</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t2.html" <?php if($type=="2") { ?> class="c" <?php } ?>>����</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t3.html" <?php if($type=="3") { ?> class="c" <?php } ?>>����</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t4.html" <?php if($type=="4") { ?> class="c" <?php } ?>>����</a> 
               	               		<a href="list<?php echo deal_str($lst,'t');?>-t5.html" <?php if($type=="5") { ?> class="c" <?php } ?>>����</a> 
               				   				</span>
					<?php
			if(!empty($type))
				{
					$lstaddr.= "<em>".$type_name."<a href=\"list".deal_str($lst,'t').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Դ��</span>
			<span>
				<a href="list<?php echo deal_str($lst,'u');?>.html" <?php if(empty($source)) { ?> class="c" <?php } ?>>����</a> 
				<a href="list<?php echo deal_str($lst,'u');?>-u2.html" <?php if($source=="2") { ?> class="c" <?php } ?>>�н�</a> 
				<a href="list<?php echo deal_str($lst,'u');?>-u1.html" <?php if($source=="1") { ?> class="c" <?php } ?>>����</a> 
			</span>
				<?php
			if(!empty($source))
				{
					$lstaddr.= "<em>".$source_name."<a href=\"list".deal_str($lst,'u').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">װ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ޣ�</span>
			<span>
				<a href="list<?php echo deal_str($lst,'f');?>.html" <?php if(empty($fix)) { ?> class="c" <?php } ?>>����</a>
							   		<a href="list<?php echo deal_str($lst,'f');?>-f1.html" <?php if($fix=="1") { ?> class="c" <?php } ?>>ë��</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f2.html" <?php if($fix=="2") { ?> class="c" <?php } ?>>��װ</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f3.html" <?php if($fix=="3") { ?> class="c" <?php } ?>>�е�װ��</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f4.html" <?php if($fix=="4") { ?> class="c" <?php } ?>>��װ</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f5.html" <?php if($fix=="5") { ?> class="c" <?php } ?>>����װ��</a> 
               	               		<a href="list<?php echo deal_str($lst,'f');?>-f6.html" <?php if($fix=="6") { ?> class="c" <?php } ?>>ԭ��</a> 
               				   				</span>
			<?php
			if(!empty($fix))
				{
					$lstaddr.= "<em>".$fix_name."<a href=\"list".deal_str($lst,'f').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">¥&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�㣺</span>
			<span>
				<a href="list<?php echo deal_str($lst,'l');?>.html" <?php if(empty($floor)) { ?> class="c" <?php } ?>>����</a>
				                                	<a href="list<?php echo deal_str($lst,'l');?>-l1.html" <?php if($floor=="1") { ?> class="c" <?php } ?>>6������</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l2.html" <?php if($floor=="2") { ?> class="c" <?php } ?>>6-12��</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l3.html" <?php if($floor=="3") { ?> class="c" <?php } ?>>12-20��</a>
                                	<a href="list<?php echo deal_str($lst,'l');?>-l4.html" <?php if($floor=="4") { ?> class="c" <?php } ?>>20������</a>
                                			</span>
			<?php
			if(!empty($floor))
				{
					$lstaddr.= "<em>".$floor_name."<a href=\"list".deal_str($lst,'l').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�䣺</span>
			<span>
				<a href="list<?php echo deal_str($lst,'y');?>.html" <?php if(empty($year)) { ?> class="c" <?php } ?>>����</a>
				                                <a href="list<?php echo deal_str($lst,'y');?>-y1.html" <?php if($year=="1") { ?> class="c" <?php } ?>>2000����ǰ</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y2.html" <?php if($year=="2") { ?> class="c" <?php } ?>>2000���Ժ�</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y3.html" <?php if($year=="3") { ?> class="c" <?php } ?>>2005���Ժ�</a>
                                <a href="list<?php echo deal_str($lst,'y');?>-y4.html" <?php if($year=="4") { ?> class="c" <?php } ?>>2010���Ժ�</a>
                			</span>
					<?php
			if(!empty($year))
				{
					$lstaddr.= "<em>".$year_name."<a href=\"list".deal_str($lst,'y').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf">
			<span class="a_name">����ʱ�䣺</span>
			<span>
					<a href="list<?php echo deal_str($lst,'o');?>.html"  <?php if(empty($opentime)) { ?> class="c" <?php } ?>>����</a> 
					<a href="list<?php echo deal_str($lst,'o');?>-o2.html" <?php if($opentime=="2") { ?> class="c" <?php } ?> >3���ڷ���</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o3.html" <?php if($opentime=="3") { ?>  class="c" <?php } ?>>7���ڷ���</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o4.html" <?php if($opentime=="4") { ?>  class="c" <?php } ?>>15���ڷ���</a>
					<a href="list<?php echo deal_str($lst,'o');?>-o5.html" <?php if($opentime=="5") { ?>  class="c" <?php } ?>>30���ڷ���</a>
					</span>
			<?php
			if(!empty($opentime))
				{
					$lstaddr.= "<em>".$opentime_name."<a href=\"list".deal_str($lst,'o').".html\"></a></em>";
				}
			?>
		</div>
		<div class="cf b">
			<span class="a_name">����ѡ��</span>
			<span> <?php if(empty($lstaddr)) { ?>
								<em>��<a href="javascript:void(0)"></a></em>
					<?php } else { ?><?php echo $lstaddr;?>
				<a href="list.html"  class="cle">�����������</a>
				<?php } ?>
			</span>
		</div>
	</div>
</div>		<div class="cf">
			<div class="w720 fl">
				<div class="Tle cf">
					<div class="fl">
						<a <?php if(empty($hot)) { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list.html" >ȫ����Դ</a>
	                	<a <?php if($hot=="1") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h1.html" >���Ʒ�Դ</a>
	                	<a <?php if($hot=="3") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h3.html" >���۷�Դ</a>
	                	<a <?php if($hot=="2") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h2.html" >�Ƽ���Դ</a>
						<a <?php if($hot=="4") { ?> class="A"<?php } else { ?> class="B"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-h4.html" >��ͼ��Դ</a>
	                	<a <?php if($source=="1") { ?> class="D"<?php } else { ?> class="C"<?php } ?> href="list<?php echo deal_str($lst,'u');?>-u1.html" >����</a>
					</div>
					<div class="tel_page fr">
						<span>
							���ҵ� <strong class="red" id="num"></strong>����Դ
						</span>
						<a class="pre" href="list<?php echo deal_str($lst,'g');?>-g1.html" ></a>
						<span class="num">1</span>
						<a class="next" href="list<?php echo deal_str($lst,'g');?>-g2.html" >��һҳ</a>
					</div>
				</div>
				<div class="Tle2">
					<form action="<?php echo ESF_PATH;?>list-search" method="post">
						<input id="hname" type="text" name="keyword" data-val="<?php if(empty($k)) { ?>С��/��ַ/����<?php } else { ?><?php echo $keyword;?><?php } ?>" value="<?php if(empty($k)) { ?>С��/��ַ/����<?php } else { ?><?php echo $keyword;?><?php } ?>" class="txt" autocomplete="off">
						<input id="kwsearch" type="submit" name="" class="btn" value="">
					</form>
					<div class="TelIcon fr">
						<a href="<?php if($ord==2) { ?>list<?php echo deal_str($lst,'n');?>-n3.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n2.html<?php } ?>"  class="A1 <?php if($ord==2) { ?>down<?php } ?><?php if($ord==3) { ?>up<?php } ?>">���</a>
						<a href="<?php if($ord==4) { ?>list<?php echo deal_str($lst,'n');?>-n5.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n4.html<?php } ?>"  class="A1 <?php if($ord==4) { ?>down<?php } ?><?php if($ord==5) { ?>up<?php } ?>">����</a>
						<a href="<?php if($ord==6) { ?>list<?php echo deal_str($lst,'n');?>-n7.html<?php } else { ?>list<?php echo deal_str($lst,'n');?>-n6.html<?php } ?>"  class="A1 <?php if($ord==6) { ?>down<?php } ?><?php if($ord==7) { ?>up<?php } ?>">�ܼ�</a>
						<a id="B1" class="B1" href="javascript:void(0)"></a>
						<a id="B2" class="B2h" href="javascript:void(0)"></a>
						<a id="B3" class="B3" href="javascript:void(0)"></a>
					</div>
					<div class="s_list fr" id="s_list1">
						<span><?php echo $order_name;?></span>
						<ul>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n2.html" >����Ӵ�С</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n3.html" >�����С����</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n4.html" >���۴Ӹߵ���</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n5.html" >���۴ӵ͵���</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n6.html" >�ܼ۴Ӹߵ���</a>
							</li>
							<li>
								<a href="list<?php echo deal_str($lst,'n');?>-n7.html" >�ܼ۴ӵ͵���</a>
							</li>
						</ul>
					</div>
				</div>
								<!--list-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=23f679dea3b13baa52bd938cc747055c&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=%24order&page=%24page&moreinfo=1&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?><!-- ¥���б� -->
	<table id="FyList" class="FyList">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<?php $relationxq = get_relationxq($r[id],$catid,110)?>
	<?php $menu_info = menu_info('3360',$r[region])?>
	<?php $pic_num = count(string2array($r[house_pic]))+count(string2array($r[house_room]))+count(string2array($r[house_outdoor]))?>
			<tr>
			<td class="pic">
				<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank">
					<img data-src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb],130,90);?><?php } else { ?><?php echo APP_PATH;?>statics/default/img/esf/nopic_100x75.gif<?php } ?>"  alt="<?php echo $r['title'];?>">
				<?php if($pic_num) { ?><span class="picnumber"><?php echo $pic_num;?>ͼ</span><?php } ?>
									</a>
			</td>
			<td class="info">
				<h5>
					<a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
					<?php if($r[listorder]>0) { ?>
					<img src="<?php echo APP_PATH;?>statics/default/img/esf/icon-ding.gif" alt="�ö�¥��" title="�ö�¥��" style="vertical-align:middle" />
					<?php } ?>
					<?php $flag = explode(',', $r[flag]);
						foreach ($flag as $t => $c) {
					if(intval($c))
					{
						if($c=='5')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/icon-more-28x16.gif" alt="��ͼ¥��" title="��ͼ¥��" style="vertical-align:middle" />';		
						}
						if($c=='3')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent2.gif" alt="�Ƽ�¥��" title="�Ƽ�¥��" style="vertical-align:middle" />';		
						}
						if($c=='2')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent3.gif" alt="����¥��" title="����¥��" style="vertical-align:middle" />';		
						}
						if($c=='1')
						{
					echo '<img src="'.APP_PATH.'statics/default/img/esf/tag_urgent1.gif" alt="����¥��" title="����¥��" style="vertical-align:middle" />';		
						}
					}
				}?>							</h5>
				<p>
					<a href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $relationxq['id'];?>.html"  target="_blank" title="<?php echo $relationxq['title'];?>"><?php echo $relationxq['title'];?></a> <?php echo $menu_info['0'];?> <?php echo $relationxq['address'];?><br>
					���ͣ�<?php echo $r['huxingshi'];?>��<?php echo $r['huxingting'];?>��					¥�㣺<?php echo $r['floor'];?>/<?php echo $r['zonglouceng'];?>					���ۣ�
					<?php echo $r['mprice'];?>Ԫ					���䣺<?php echo $r['house_age'];?>��					<br>
					<?php if($r[isbroker]) { ?><A href="<?php echo ESF_PATH;?>jingjiren-<?php echo $r['uid'];?>" target="_blank"><?php echo $r['username'];?></A><?php } else { ?><?php echo $r['username'];?><?php if(!$r[isbroker]) { ?>(����)<?php } ?><?php } ?>					  
					<?php echo format::sgmdate('Y-m-d H:i:s',$r[updatetime],1);?> ����
				</p>
			</td>
			<td class="area"><?php echo $r['total_area'];?>ƽ��</td>
			<td class="price">
				<strong><?php echo $r['price'];?>��Ԫ</strong>
			</td>
			<td class=""> </td>	
		</tr>
	<?php $n++;}unset($n); ?>
		</table>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	<div class="pagination" >
		<?php echo $housepages;?></div>
							</div>
			<div class="w230 fr">
				<div class="modC">
	<h4 class="modBT"><sub></sub>
		�ҵ������¼
	</h4>
	<?php
 if(isset($recentlyEsf))
 {
	$prowhere = implode(',',$recentlyEsf);
}
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=94502c9ae7b785fa535277fe2ee67783&action=lists&catid=%24catid&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$sql,)).'94502c9ae7b785fa535277fe2ee67783');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	<ul class="t3List">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $relationxq = get_relationxq($r[id],$catid,110)?>
				<li>
			<span class="lettsub7"><a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html" title="<?php echo $r['title'];?>" target="_blank"><?php echo $relationxq['title'];?></a></span>
			<span class="w2"><?php echo $r['total_area'];?>�O</span>
			<span class="w3"><?php echo $r['price'];?>��Ԫ</span>
		</li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	<?php } ?>
	</div>				<div class="modC">
	<h4 class="modBT"><sub></sub>
		����������
	</h4>
	 
	<ul class="jjrl">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=0eaea06bd802853761909dfe5aa29a3d&action=memberlist&type=1&order=point+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'5',));}?>
	<?php $n=1; if(is_array($data['result'])) foreach($data['result'] AS $k => $v) { ?> 
				<li>
			<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>"  class="jAvatar" target="_blank">
				<img src="<?php echo $v['avatar'];?>" >
			</a>
			<p>
				<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" ><?php echo $v['truename'];?></a>
				<img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>"  border="0" align="absmiddle" title="�ȼ���<?php echo $v['groupname'];?> ���֣�<?php echo $v['point'];?>" /><br><?php $district_info = menu_info('4000',$v[district])?>
					����<?php echo $district_info['0'];?><br>�绰��<?php echo $v['tel'];?>			</p>
		</li>
		<?php $n++;}unset($n); ?>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	</div>                <div class="mt10"></div>
<!--r���ַ���� ���ַ��б�ҳ-���л�1-->
			</div>	
		</div>
        
		<!--�ȵ�����-->
<div class="hota">
	<!--�����Ϣ-->
	<div class="hot cf">
		<span class="hot_fenlei"><?php echo $default_city;?>���ַ������Ϣ:</span>
		<p class="hot_link">
			<a target="_blank" href="map.html" ><?php echo $default_city;?>��ͼ�ҷ�</a>   
			<a target="_blank" href="xiaoqu-list.html" ><?php echo $default_city;?>���ַ�����</a>   
			<a target="_blank" href="rent-list.html" ><?php echo $default_city;?>���ⷿ</a>   
		</p>
	</div>
	<!--��������-->
	<div class="hot cf">
		<span class="hot_fenlei"><?php echo $default_city;?>����������ַ�:</span>
				<p class="hot_link">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>			
						<a href="list-r<?php echo $reg['0'];?>.html"  target="_blank"><?php echo $reg['1'];?></a>						
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</p>
			</div>
	<!--abc-->	
</div>		<div class="links mt10">
	<b>�������ӣ�</b>
		<a target="_blank" href="<?php echo HOUSE_PATH;?>" ><?php echo $default_city;?>�·�</a>
		<a target="_blank" href="<?php echo HOUSE_PATH;?>list.html" ><?php echo $default_city;?>����</a>
	</div>
</div>
<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery","alert","autoc","cookie","autofh"],function($,alertM){
	$("#conl1 div.autoF").autofh()
	$("#s_list1").add("tr").hover(function(){
		$(this).addClass("h")
	},function(){
		$(this).removeClass("h")
	})	
	var num = $('#nums').val();
	$('#num').html(num);
	var $hname=$("#hname").autoC("<?php echo APP_PATH;?>api.php?op=esfsuggest");
	var ht=$hname.attr("data-val");
	$hname.on("focus",function(){
		if($hname.val()==ht)
			$hname.val("");
	}).on("blur",function(){
		if($hname.val()=="")
			$hname.val(ht);
	}).closest("form").submit(function(){
		if($hname.val()==ht){
			$hname.focus()
			return false;
		}
	})
	var $hotarea=$("#hotarea")
	$hotarea.on("mouseover","dt",function(){
		$hotarea.find("dd").hide().end().find("dt").removeClass("s");
		$(this).addClass("s").next().show();
	})
	$("#B1").click(function(){
		$.cookie("esf_list","3");
		window.location.reload();
	})
	$("#B2").click(function(){
		$.cookie("esf_list","1");
		window.location.reload();
	})
	$("#B3").click(function(){
		$.cookie("esf_list","2");
		window.location.reload();
	})
})
</script>
</body>
</html>