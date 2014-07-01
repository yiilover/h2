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
			<li><a href="<?php echo HOUSE_PATH;?>"  target="_blank">�·�</a></li>
			<li class="on"><a href="<?php echo ESF_PATH;?>list.html"  target="_blank">���ַ�</a></li>
			<li><a href="<?php echo ESF_PATH;?>rent-list.html"  target="_blank">���ⷿ</a></li>
			<li class="more"><a href="javascript:void(0)">����<em></em></a>
				<div>
					<a href="<?php echo catlink(6);?>"  target="_blank">��Ѷ</a>
					<a href="<?php echo BBS_PATH;?>"  target="_blank">��̳</a>
				</div>
			</li>
		</ul>
		<a href="<?php echo ESF_PATH;?>map.html"  class="mapS" target="_blank">��ͼ�ҷ�</a>
	<?php
$param = $_GET['param'];
	if(!empty($param)&&stristr($param,'-')!=false)
	{
		$param_arr = explode('-', $param);
		foreach($param_arr as $_v) {
				if($_v) 
				{
					if(preg_match ( '/([a-z])([0-9A-Z_]+)/', $_v, $matchs))
					{
						$$matchs[1] = trim($matchs[2]);
					}
				}
			}
		$parentid = $r;
		$bid = $b;
		$ename = $e;
		$ord = $n;
		$page = $g;
	}
	else
	{
 	$parentid = intval($_GET['r']);
	$bid = intval($_GET['b']);
	$ename = trim($_GET['e']);
	$ord = intval($_GET['n']);
	$page = intval($_GET['g']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	}
	
	$where = "status=99";
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
		$where.=" and (`title` like '%$keyword%' or `address` like '%$keyword%' )";
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
	if(!empty($ename) && preg_match('/^[a-zA-Z]+$/i',$ename))
	{
		$lst.= "-e".$ename;
		$ename = strtolower($ename);
		$where.=" and (`ename` like '$ename%' or `pinyin` like '$ename%' )";
	}
	$order = "id desc";
	?>
		<div id="qy">
			<span>����/����</span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ������</a>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
	<a href="javascript:void(0)" data-val="-r<?php echo $reg['0'];?>"><?php echo $reg['1'];?></a>											
	<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
												</div>
		</div>
		<div data-k = "ƽ" id="wy" data-val="">
			<span>���</span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a href="javascript:void(0)" data-val="-c1">70ƽ������</a>
											<a href="javascript:void(0)" data-val="-c3">70-90ƽ��</a>
											<a href="javascript:void(0)" data-val="-c4">90-120ƽ��</a>
											<a href="javascript:void(0)" data-val="-c5">120-150ƽ��</a>
											<a href="javascript:void(0)" data-val="-c6">150-200ƽ��</a>
											<a href="javascript:void(0)" data-val="-c7">200-300ƽ��</a>
											<a href="javascript:void(0)" data-val="-c8">300ƽ������</a>
												</div>
		</div>
		<div data-k = "��" id="jg" data-val="">
			<span>�۸�Χ</span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a href="javascript:void(0)" data-val="-p1">50������</a>
											<a href="javascript:void(0)" data-val="-p2">50-80��</a>
											<a href="javascript:void(0)" data-val="-p3">80-100��</a>
											<a href="javascript:void(0)" data-val="-p4">100-150��</a>
											<a href="javascript:void(0)" data-val="-p5">150-200��</a>
											<a href="javascript:void(0)" data-val="-p6">200-250��</a>
											<a href="javascript:void(0)" data-val="-p7">250-300��</a>
											<a href="javascript:void(0)" data-val="-p8">300-400��</a>
												</div>
		</div>
		<div id="shx">
			<span>����</span>
			<div>
				<a data-val="" href="javascript:void(0)">ȫ��</a>
											<a href="javascript:void(0)" data-val="-t1">һ��</a>
											<a href="javascript:void(0)" data-val="-t2">����</a>
											<a href="javascript:void(0)" data-val="-t3">����</a>
											<a href="javascript:void(0)" data-val="-t4">����</a>
											<a href="javascript:void(0)" data-val="-t5">����</a>
												</div>
		</div>
		<input type="text" data-val="������ؼ��֣�¥�����������" value="������ؼ��֣�¥�����������">
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
			<li class="s">
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
			<a href="<?php echo APP_PATH;?>esf" ><?php echo $default_city;?>���ַ�</a> &gt;
			С���ҷ�
		</div>
		<div class="modB">
			<div class="conl1">
				<div class="cf" style="padding-top:9px;">
					<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span>
					<span>
						<a href="xiaoqu-list<?php echo deal_str($lst,'r');?>.html" <?php if(empty($parentid)) { ?>  class="c" <?php } ?>>����</a>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php
								$reg = explode('$$', $r);//add by L 2012/3/22
								if(!empty($parentid) && $parentid==$reg[0] && empty($bid))
								{
									$lstaddr.= "<em>".$reg[1]."<a href=\"xiaoqu-list".deal_str($lst,'r').".html\"></a></em>";
								}
								?>
								<a href="xiaoqu-list-r<?php echo $reg['0'];?><?php echo deal_str($lst,'r');?>.html" <?php if(!empty($parentid) && $parentid==$reg[0]) { ?> class="c"<?php } ?>><?php echo $reg['1'];?></a>
								<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
																</span>
				<!--�������-->
					<?php if($parentid) { ?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e3d28ce1f67a9f7addc16249214e52e5&action=getlinkage&keyid=3360&parentid=%24parentid&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC',)).'e3d28ce1f67a9f7addc16249214e52e5');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
												<!--�����ǰ����Ϣ����������ų��ֵ�-->
												<span class="i">
				<a href="xiaoqu-list<?php echo deal_str($lst,'b');?>.html" <?php if(empty($bid)) { ?> class="c"<?php } ?>>����</a>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php
				$reg2 = explode('$$', $r);//add by L 2012/3/22
				if(!empty($bid) && $bid==$reg2[0])
				{
					$lstaddr.= "<em>".$reg2[1]."<a href=\"xiaoqu-list".deal_str($lst,'r').".html\"></a></em>";
				}
				?>
				               		<a href="xiaoqu-list<?php echo deal_str($lst,'b');?>-b<?php echo $reg2['0'];?>.html" <?php if(!empty($bid) && $bid==$reg2[0]) { ?> class="c"<?php } ?>><?php echo $reg2['1'];?></a>
									<?php $n++;}unset($n); ?>
               				</span>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
									</div>
				<!-- <div class="cf">
					<span class="a_name">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ͣ�</span>
					<span>
						<a href="xiaoqu-list.html"   class="c" >����</a>
																				<a href="xiaoqu-list-c12.html"  >�ߵ�סլ</a>
														<a href="xiaoqu-list-c11.html"  >�����ۺ���</a>
														<a href="xiaoqu-list-c10.html"  >��ס��Ԣ</a>
														<a href="xiaoqu-list-c9.html"  >�Ƶ�ʽ��Ԣ</a>
														<a href="xiaoqu-list-c8.html"  >��԰��</a>
														<a href="xiaoqu-list-c1.html"  >��ͨסլ</a>
														<a href="xiaoqu-list-c2.html"  >��Ԣ</a>
														<a href="xiaoqu-list-c3.html"  >����</a>
														<a href="xiaoqu-list-c4.html"  >�������÷�</a>
														<a href="xiaoqu-list-c7.html"  >����</a>
														<a href="xiaoqu-list-c6.html"  >д��¥</a>
																		</span>
				</div> -->
				<div class="cf">
					<span class="a_name">��&nbsp;&nbsp;��&nbsp;&nbsp;ĸ��</span>
					<span class="Letter">
						<a href="xiaoqu-list.html"  <?php if(empty($ename)) { ?>class="n c "<?php } else { ?>class="n"<?php } ?>>����</a>
														<a href="xiaoqu-list-eA.html" <?php if($ename=='a') { ?>class="n c "<?php } ?>>A</a>
														<a href="xiaoqu-list-eB.html" <?php if($ename=='b') { ?>class="n c "<?php } ?>>B</a>
														<a href="xiaoqu-list-eC.html" <?php if($ename=='c') { ?>class="n c "<?php } ?>>C</a>
														<a href="xiaoqu-list-eD.html" <?php if($ename=='d') { ?>class="n c "<?php } ?>>D</a>
														<a href="xiaoqu-list-eE.html" <?php if($ename=='e') { ?>class="n c "<?php } ?>>E</a>
														<a href="xiaoqu-list-eF.html" <?php if($ename=='f') { ?>class="n c "<?php } ?>>F</a>
														<a href="xiaoqu-list-eG.html" <?php if($ename=='g') { ?>class="n c "<?php } ?>>G</a>
														<a href="xiaoqu-list-eH.html" <?php if($ename=='h') { ?>class="n c "<?php } ?>>H</a>
														<a href="xiaoqu-list-eI.html" <?php if($ename=='i') { ?>class="n c "<?php } ?>>I</a>
														<a href="xiaoqu-list-eJ.html" <?php if($ename=='j') { ?>class="n c "<?php } ?>>J</a>
														<a href="xiaoqu-list-eK.html" <?php if($ename=='k') { ?>class="n c "<?php } ?>>K</a>
														<a href="xiaoqu-list-eL.html" <?php if($ename=='l') { ?>class="n c "<?php } ?>>L</a>
														<a href="xiaoqu-list-eM.html" <?php if($ename=='m') { ?>class="n c "<?php } ?>>M</a>
														<a href="xiaoqu-list-eN.html" <?php if($ename=='n') { ?>class="n c "<?php } ?>>N</a>
														<a href="xiaoqu-list-eO.html" <?php if($ename=='o') { ?>class="n c "<?php } ?>>O</a>
														<a href="xiaoqu-list-eP.html" <?php if($ename=='p') { ?>class="n c "<?php } ?>>P</a>
														<a href="xiaoqu-list-eQ.html" <?php if($ename=='q') { ?>class="n c "<?php } ?>>Q</a>
														<a href="xiaoqu-list-eR.html" <?php if($ename=='r') { ?>class="n c "<?php } ?>>R</a>
														<a href="xiaoqu-list-eS.html" <?php if($ename=='s') { ?>class="n c "<?php } ?>>S</a>
														<a href="xiaoqu-list-eT.html" <?php if($ename=='t') { ?>class="n c "<?php } ?>>T</a>
														<a href="xiaoqu-list-eU.html" <?php if($ename=='u') { ?>class="n c "<?php } ?>>U</a>
														<a href="xiaoqu-list-eV.html" <?php if($ename=='v') { ?>class="n c "<?php } ?>>V</a>
														<a href="xiaoqu-list-eW.html" <?php if($ename=='w') { ?>class="n c "<?php } ?>>W</a>
														<a href="xiaoqu-list-eX.html" <?php if($ename=='x') { ?>class="n c "<?php } ?>>X</a>
														<a href="xiaoqu-list-eY.html" <?php if($ename=='y') { ?>class="n c "<?php } ?>>Y</a>
														<a href="xiaoqu-list-eZ.html" <?php if($ename=='z') { ?>class="n c "<?php } ?>>Z</a>
																		</span>
				</div>
			</div>
		</div>
		<div class="cf">
			<div class="w720 fl">
				<div class="Tle2">
					<form action="<?php echo ESF_PATH;?>xiaoqu-list-search" method="post">
						<input id="hname" type="text" name="keyword" data-val="������С������" value="<?php if($keyword) { ?><?php echo $keyword;?><?php } else { ?>������С������<?php } ?>" class="txt" autocomplete="off">
						<input id="kwsearch" type="submit" name="" class="btn" value="">
					</form>
					<!-- <div class="TelIcon fr">
						<a class="A1" 
						href="xiaoqu-list-s1.html" >����</a>
					</div> -->
					<div class="s_list fr" id="s_list1">
						<span>Ĭ������</span>
						<ul>
							<li>
								<a href="xiaoqu-list-s0.html" >Ĭ������</a> 
							</li>
							<!-- 
							<li>
								<a href="xiaoqu-list-s1.html" >���۴Ӹߵ���</a>
							</li>
							<li>
								<a href="xiaoqu-list-s2.html" >���۴ӵ͵���</a>
							</li> -->
						</ul>
					</div>
					<span class="fr">���� <span class="red" id="num"></span> �׷���Ҫ���С��</span>
				</div>
				<!--list-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=23f679dea3b13baa52bd938cc747055c&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=%24order&page=%24page&moreinfo=1&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
								<table class="FyList xqSearch" id="FyList">
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
										<tr>
						<td class="pic">
							<a href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $r['id'];?>.html"  title="<?php echo $r['title'];?>" target="_blank">
								<img data-src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb],100,75);?><?php } else { ?><?php echo APP_PATH;?>statics/default/img/esf/nopic_100x75.gif<?php } ?>"  alt="<?php echo $r['title'];?>"></a>
						</td>
						<td class="info">
							<h5>
								<a href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $r['id'];?>.html"   title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a>
							</h5>
							<p><?php echo $r['address'];?><a target="_blank" href="<?php echo ESF_PATH;?>xiaoqu-map-<?php echo $r['id'];?>.html" >�鿴��ͼ</a>
								<br>				
								<a target="_blank" href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $r['id'];?>.html" >С���ſ�</a>/<a target="_blank" href="<?php echo ESF_PATH;?>xiaoqu-price-<?php echo $r['id'];?>.html" >�۸�����</a>
							</p>
						</td>
						 <td class="area">
							�ۼۣ�<?php if($r[price]) { ?><b><?php echo $r['price'];?></b>Ԫ/�O	<?php } else { ?>����<?php } ?>						<br>	
							ͬ�����£�							<?php if($r[price_percent]>0) { ?><b class="up">��<?php echo $r['price_percent'];?>%</b><?php } elseif ($r[price_percent]<0) { ?><b class="down">��<?php echo $r['price_percent'];?>%</b><?php } else { ?><b>��ƽ</b><?php } ?>
													</td>
						<td class="area">
							���<?php if($r[price_rent]) { ?><b><?php echo $r['price_rent'];?></b>Ԫ/��<?php } else { ?>����<?php } ?>							<br>	
							ͬ�����£�					<?php if($r[price_rent_percent]>0) { ?><b class="up">��<?php echo $r['price_rent_percent'];?>%</b><?php } elseif ($r[price_rent_percent]<0) { ?><b class="down">��<?php echo $r['price_rent_percent'];?>%</b><?php } else { ?><b>��ƽ</b><?php } ?>
														<br>
						</td> 
						<td class="price">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=7f30cf449cec4894f1f71134fd664bc2&action=esfcount&relation=%24r%5Bid%5D&catid=112&cache=3600&return=esfcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('relation'=>$r[id],'catid'=>'112',)).'7f30cf449cec4894f1f71134fd664bc2');if(!$esfcount = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$esfcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'112','limit'=>'20',));}if(!empty($esfcount)){setcache($tag_cache_name, $esfcount, 'tpl_data');}}?>
							<a class="shou" href="sell/<?php echo $r['id'];?>.html"  target="_blank"><?php echo $esfcount;?>��</a>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=bbf2b89a94e3df94e67b6c9696b4def6&action=esfcount&relation=%24r%5Bid%5D&catid=113&cache=3600&return=rentcount\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('relation'=>$r[id],'catid'=>'113',)).'bbf2b89a94e3df94e67b6c9696b4def6');if(!$rentcount = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'esfcount')) {$rentcount = $content_tag->esfcount(array('relation'=>$r[id],'catid'=>'113','limit'=>'20',));}if(!empty($rentcount)){setcache($tag_cache_name, $rentcount, 'tpl_data');}}?>
							<a class="zu" href="rent/<?php echo $r['id'];?>.html"  target="_blank"><?php echo $rentcount;?>��</a>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</td>
					</tr>	<?php $n++;}unset($n); ?>
		</table>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<div class="pagination" >
					<?php echo $housepages;?>
				</div>
							</div>
			<div class="w230 fr">
				<div class="modC">
	<h4 class="modBT"><sub></sub>
		�ҵ������¼
	</h4>
		<?php
 if(isset($recentlyXiaoqu))
 {
	$prowhere1 = implode(',',$recentlyXiaoqu);
}
 ?>
<?php if($prowhere1) { ?>
    <?php $sql = "id in($prowhere1) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=0709167b1769541af69e88c4a42fa681&action=lists&catid=110&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'110','where'=>$sql,)).'0709167b1769541af69e88c4a42fa681');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'110','where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	<ul class="t3List">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<?php $menu_info = menu_info('3360',$r[region])?>
				<li>
			<span class="lettsub7"><a href="<?php echo ESF_PATH;?>xiaoqu-show-<?php echo $r['id'];?>.html" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a></span>
			<span class="w2"><?php echo $menu_info['0'];?></span>
			<span class="w3"><?php if($r[price]) { ?><?php echo $r['price'];?>Ԫ/�O<?php } else { ?>����<?php } ?></span>
		</li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	<?php } ?>
	</div>				<div class="modC">
					<h4 class="modBT"><sub></sub>
						�����������Ķ��ַ�
					</h4><?php
 if(isset($recentlyEsf))
 {
	$prowhere = implode(',',$recentlyEsf);
}
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=daf72bffd1b82c35e169d3b002659002&action=lists&catid=112&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'112','where'=>$sql,)).'daf72bffd1b82c35e169d3b002659002');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'112','where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
	<ul class="t3List">
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $relationxq = get_relationxq($r[id],112,110)?>
				<li>
			<span class="lettsub7"><a href="<?php echo ESF_PATH;?>show-<?php echo $r['id'];?>.html" title="<?php echo $r['title'];?>" target="_blank"><?php echo $relationxq['title'];?></a></span>
			<span class="w2"><?php echo $r['total_area'];?>�O</span>
			<span class="w3"><?php echo $r['price'];?>��Ԫ</span>
		</li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
	<?php } ?>
									</div>
			</div>
		</div>
<?php include template("content","footer"); ?>
</div>
<script type="text/javascript">
seajs.use(["jquery","alert","autoc","cookie"],function($,alertM){
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
})
</script>
</body>
</html>