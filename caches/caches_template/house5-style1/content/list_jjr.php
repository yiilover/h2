<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
	<meta name="keywords" content="������,���ز�������,����������,���ַ�������,���ַ�"/>
	<meta name="description" content="�������ṩ���꾡�ľ������б�, Ϊ���ز��������ṩ����Ӫ�����ߡ���Դ������,�ǳ�Ϊ�������緿����������õ�����ƽ̨���鿴���෿���н鹫˾,���ز���������Ϣ�뵽��������"/>
	<link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/reset.css"  rel="stylesheet" type="text/css"/>
	<link href="<?php echo APP_PATH;?>statics/default/css/esf/esf.css"  rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/default/js/esf/sea.js"  type="text/javascript"></script>
	<title>�������б� - <?php echo $SEO['site_title'];?></title>
</head>
<body>
	<div id="main">
		<div id="header">
	<?php include template("ssi","ssi_8"); ?>
<script type="text/javascript">
seajs.use("topbarlogin")
</script>	<h1>
			<a href="<?php echo APP_PATH;?>"  title="<?php echo $site_title;?>" class="logo fl">
			<img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></a></h1>
<div id="Search">
		<ul class="searchURL">
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
		$where.=" and (truename like '%$keyword%')";
	}
 	if(!empty($parentid))
	{
		$lst = "-r".$parentid;
		$where.=" and `district`=$parentid";
	}
	if(!empty($ord))
	{
		if($ord=='1')
		{
			$order=" point desc";
			$order_name = "�ȼ��ɸߵ���";
		}
		elseif($ord=='2')
		{
			$order=" point ASC";
			$order_name = "�ȼ��ɵ͵���";
		}
		else
		{
			$order=" `userid` DESC";
			$order_name = "Ĭ������";
		}
		$lst.= "-n".$ord;
	}
	else
	{
		$order = "`userid` DESC";
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
											<a <?php if($range=="3") { ?> class="on"<?php } ?> href="javascript:void(0)" data-val="-p3">80-100��</a>
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
			<li>
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
			<li class="s">
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
			<div class="conl1">
				<div class="cf" style="padding:9px 0;">
					<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span>
					<span>
						<a href="<?php echo ESF_PATH;?>jingjiren" <?php if(empty($parentid)) { ?>  class="c" <?php } ?>>����</a>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=c428f9bfc8e5c974315cc73e1df10891&action=getlinkage&keyid=4000&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'4000','parentid'=>'0','order'=>'listorder ASC',)).'c428f9bfc8e5c974315cc73e1df10891');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'4000','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="c"<?php } ?> href="<?php echo ESF_PATH;?>jingjiren-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				      					        					</span>
									</div>
			</div>
		</div>
		<div class="cf">
			<div class="w720 fl">
				<div class="Tle2">
					<form action="" method="post">
						<input id="hname" type="text" name="keyword" data-val = "����������/��˾����" value="����������/��˾����" class="txt" autocomplete="off">
						<input id="kwsearch" type="button" name="" class="btn" value="">
					</form>
					<div class="s_list fr" id="s_list1">
						<span><?php echo $order_name;?></span>
						<ul>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren">Ĭ������</a>
							</li>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren-n1">�ȼ��ɸߵ���</a>
							</li>
							<li>
								<a href="<?php echo ESF_PATH;?>jingjiren-n2">�ȼ��ɵ͵���</a>
							</li>
						</ul>
					</div>
					<span class="fr">���� <b class="red" id="num"></b> ��������������������</span>
				</div>
				<!--list-->
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=d5b31dfddfe80a1768eda3e161f378ce&action=memberlist&type=1&where=%24where&order=%24order&pg=%24page&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','where'=>$where,'order'=>$order,'pg'=>$page,'limit'=>'10',));}?>
					<table class="FyList jjrSearch" id="FyList">
												
					<?php $n=1; if(is_array($data[result])) foreach($data[result] AS $k => $v) { ?> 
						<tr>
						<td class="pic">
							<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank">
								<img src="<?php echo $v['avatar'];?>" /></a>
						</td>
						<td class="info">
							<h5>
								<a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank"><?php echo $v['truename'];?>&#160;</a> <img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>" border="0" align="absmiddle" title="�ȼ���<?php echo $v['groupname'];?> ���֣�<?php echo $v['point'];?>" /> 
							</h5>
							<p>
								������˾��<?php if($v[company]) { ?><A href="<?php echo ESF_PATH;?>mendian-<?php echo $v['company'];?>" target="_blank"><?php echo $v['companyname'];?></A><?php } else { ?><?php echo $v['companyname'];?><?php } ?>								<br><?php $district_info = menu_info('4000',$v[district])?>
								<?php echo $district_info['0'];?>   &nbsp;��    ����<?php echo $v['tel'];?>							<br>
								 ÿ�춼��							</p>
						</td>
						<td class="price">
							<a class="dp" href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank">�������</a>
						</td>
					</tr>
					<?php $n++;}unset($n); ?>
									</table>						
					<div class="pagination" >
					<?php echo $data['pages'];?>
					</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</div>
			<div class="w230 fr">
				<div class="modC">
					<h4 class="modBT"><sub></sub>
						�����˻������а�
					</h4>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"member\" data=\"op=member&tag_md5=703eab47405d0efc1f300cf39fb34630&action=memberlist&type=1&order=point+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$member_tag = h5_base::load_app_class("member_tag", "member");if (method_exists($member_tag, 'memberlist')) {$data = $member_tag->memberlist(array('type'=>'1','order'=>'point DESC','limit'=>'10',));}?>
							<ul class="top10">
									<?php $n=1; if(is_array($data[result])) foreach($data[result] AS $k => $v) { ?> 
            									<li>
							<span class="lettsub7"><a href="<?php echo ESF_PATH;?>jingjiren-<?php echo $v['userid'];?>" target="_blank"><?php echo $v['truename'];?></a></span>
							<span class="w2"><img src="<?php echo APP_PATH;?>statics/default/img/esf/<?php echo $v['groupicon'];?>"  border="0" align="absmiddle" title="�ȼ���<?php echo $v['groupname'];?> ���֣�<?php echo $v['point'];?>" /></span>
						</li>
						<?php $n++;}unset($n); ?>
											</ul>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
									</div>
                <div class="mt10"></div>
<!--r���ַ���� �������б�ҳ-�Ҳ�-->
			</div>
		</div>
<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery"],function($){
	$("#s_list1").add("tr").hover(function(){
		$(this).addClass("h")
	},function(){
		$(this).removeClass("h")
	})
	var num = $('#nums').val();
	$('#num').html(num);
	var $hname=$("#hname");
	var ht=$hname.attr("data-val");
	$hname.on("focus",function(){
		if($hname.val()==ht)
			$hname.val("");
	}).on("blur",function(){
		if($hname.val()=="")
			$hname.val(ht);
	}).on("keydown",function(e){
		if(e.which==13){
			$("#kwsearch").click()
			return false
		}	
	}).closest("form").submit(function(){
		if($hname.val()==ht)
			return false;
	})
	$("#kwsearch").click(function(){
		var kw = $hname.val();
		if(kw!=""&&kw!=ht){
			var kw_encode = encodeURIComponent(kw);
			setTimeout(function(){
				window.location.href = "<?php echo ESF_PATH;?>jingjiren-K" + kw_encode;
			},99)
		}
		$hname.focus();
		return false;
	});

})
</script>
</body>
</html>
