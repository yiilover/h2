<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset="gbk"/>
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
    <meta name="description" content="<?php echo $SEO['description'];?>">
    <link href="<?php echo APP_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="<?php echo APP_PATH;?>statics/house5-style1/index/css/reset.css"  rel="stylesheet" type="text/css"/>
	<script src="<?php echo APP_PATH;?>statics/house5-style1/sea/js/sea.js"  type="text/javascript"></script>
	<link href="<?php echo APP_PATH;?>statics/house5-style1/newhouse/css/newhouse.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="main" class="xfindex">
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
					<a href="<?php echo catlink(6);?>"  target="_blank">��Ѷ</a>
					<a target="_blank" href="<?php echo catlink(7);?>">ͼ��</a>
					<a target="_blank" href="<?php echo catlink(10);?>">��Ƶ</a>
					<a target="_blank" href="<?php echo BBS_PATH;?>">��̳</a>
				</div>
			</li>
		</ul>
		<a href="<?php echo APP_PATH;?>map/" target="_blank" class="mapS">��ͼ�ҷ�</a>
		<div id="qy">
			<span>����/����</span>
			<div>
				<a href="javascript:void(0)" data-val="">ȫ������</a>
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
											<a  href="javascript:void(0)" data-val="-g5">30000-40000Ԫ</a>
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
				<a href="<?php echo HOUSE_PATH;?>" target="_self" >��ҳ<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>list.html" target="_self" >����¥��<em></em></a>
            </li>
			<li >
				<a href="<?php echo APP_PATH;?>map/" target="_blank" >��ͼ�ҷ�<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>baojia.html" target="_self" >���շ���<em></em></a>
			</li>
			<li >
				<a href="<?php echo catlink(37);?>" target="_self">¥�̵���<em></em></a>
			</li>
			<li>
				<a href="<?php echo APP_PATH;?>special/" target="_blank">����ר��<em></em></a>
			</li>
			<li >
				<a href="<?php echo HOUSE_PATH;?>hxlist.html" target="_self" >����ͼ<em></em></a>
			</li>
			<li  >
				<a href="<?php echo APP_PATH;?>tools/fdjsq.html" target="_self" >���������</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	seajs.use(["jquery","hsearch"],function($){
		$("#Search").hSearch("<?php echo HOUSE_PATH;?>list","<?php echo APP_PATH;?>api.php?op=house")//ǰ����������ַ��������ajax��ѯ����api
	})
</script>        <div class="mt2"></div><!--�·����ַ���� �·���ҳ-������ͨ��1-->
		<div class="mt10 cf">
			<!--¥�̶�̬-->
			<div class="fl boxA">
				<h3>
					����¥��
				</h3>
				<p>
					<a href="<?php echo HOUSE_PATH;?>list.html">ȫ��</a>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee3a82b09698607383a5d01b0653d667&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $reg = explode('$$', $r)?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</p>
				<h3>
					�۸�����
				</h3>
				<p>
					<?php $range_arr = getbox_name('13','range')?>
<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-p<?php echo $key;?>.html" val="-p<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>
		        </p>
				<h3>
					����ʱ��
				</h3>
				<p>
					<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o1.html">���¿���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o2.html">���¿���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o3.html">3���ڿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o4.html">6���ڿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o5.html">ǰ3���ѿ���</a>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-o6.html">ǰ6���ѿ���</a>
		                	                				</p>
				<h3>
					��Ŀ����
				</h3>
				<p>
				<?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<a target="_blank" href="<?php echo HOUSE_PATH;?>list-t<?php echo $key;?>.html" val="-t<?php echo $key;?>" target="_blank"><?php echo $v;?></a>
<?php $n++;}unset($n); ?>

				</p>
				<p class="more">
					<a href="<?php echo HOUSE_PATH;?>list.html">
						����ɸѡ��ʽ <em></em>
					</a>
				</p>
			</div>
			<div class="w730 fr">
				
				<!--������Ѷ-->
				<div class="w345 fl border">
						<div class="tit">
    <span><?php echo catname(26);?></span><a href="<?php echo catlink(26);?>" target="_blank">����</a>
</div>
<ul class="news_jiantou">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=9f98283ca739ad25f6db13246be54318&action=lists&catid=26&order=listorder+DESC&limit=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'26','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a target="_blank" <?php echo title_style($v[style]);?>  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
         <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--f�·���ҳ һ���Ҳ�-��Ŀ1-->
						<div class="tit tit2 mt5">
    <span><?php echo catname(29);?></span><a href="<?php echo catlink(29);?>" target="_blank">����</a>
</div>
<ul class="news_jiantou news_noline">
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee16536bb52e2cfaf14a72f9110c5d9d&action=lists&catid=29&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a target="_blank" <?php echo title_style($v[style]);?>  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
         <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--f�·���ҳ һ���Ҳ�-��Ŀ2-->
					</div>

<div class="w375 fr border">
					<div class="focus-pic" id="tab1">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1b82083706d495c02aac68c745489be8&action=position&posid=1&thumb=1&order=listorder+DESC&num=5&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'1','thumb'=>'1','order'=>'listorder DESC',)).'1b82083706d495c02aac68c745489be8');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
   <div class="dt">
     <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
<i <?php if($n==1) { ?>class="on"<?php } ?>><?php echo $n;?></i>
 <?php $n++;}unset($n); ?>
    </div>
       <ul class="dd">
	  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li <?php if($n!=1) { ?>style="display:none;"<?php } ?>>
            <a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],300,220);?>"/></a><p><a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></p>
        </li>
<?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
          
        </ul>
</div><!--f�·���ҳ ����ͼ-->
<ul class="news news_jiantou mt5 news_noline">
 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=855585d9b89ee4d4aa33d4f390bd7998&action=lists&catid=28&order=listorder+DESC&limit=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
            <li><a target="_blank" <?php echo title_style($v[style]);?>  title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
            <?php $n++;}unset($n); ?>
			 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul><!--f�·���ҳ һ���м�-�Ƽ��б�-->
				</div>

			</div>

		</div>
        <div class="mt5"></div><!--q�·���� �·���ҳ-ͨ��1-->
		<div class="mt10 cf">
			<div class="w220 fl">
				<div class="border">
					<h3>
						<a class="fr" href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">����</a>
						����¥��
					</h3>
					<ul><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=fafcc32abe6bc78eaafc45d681e97d92&action=lists&catid=14&where=hot+like+%27%255%25%27+&order=listorder+DESC&limit=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%5%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					 <?php $menu_info = menu_info('3360',$v[region])?>
					        										<li>
							<a class="a1" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>
							<a href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a>
							<span class="a3"><?php echo getbox_val('13','type',$v['type']);?></span>
						</li>
									 <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
																</ul>
				</div>
				<!--�ȵ�¥��-->
				<div class="border mt10">
					<h3 class="pdlr10 bg_fcfcfc border_xuxian_bottom">
						<a class="fr" href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank">����</a>
						�ȵ�¥��
					</h3>
					<ul><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=58880032c838a2311e904ba0de876a4e&action=lists&catid=14&where=hot+like+%27%254%25%27+&order=listorder+DESC&limit=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>'hot like \'%4%\' ','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
					 <?php $menu_info = menu_info('3360',$v[region])?>
					        	<li>
							<a class="a1" href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a>
							<a href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a>
							<span class="a3"><?php echo getbox_val('13','type',$v['type']);?></span>
						</li>
									 <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
											
																</ul>
				</div>
				<!--һ�ܹ�ע¥��-->
				<div class="border mt10">
					<h3 class="pdlr10 bg_fcfcfc border_xuxian_bottom">
						<a class="fr" href="<?php echo HOUSE_PATH;?>list.html" target="_blank">����</a>
						һ�ܹ�ע¥��
					</h3>
					<div class="cf pdb10">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=cdc0de6cadb6e6e7e687bc9a20a3e1f6&action=hits&catid=14&order=weekviews+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'weekviews DESC','limit'=>'1',));}?> <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>	
					<?php $menu_info = menu_info('3360',$v[region])?>
					<div class="imgtxt cf">
							<div class="fl">
								<span class="num1">1</span>
								<img src="<?php echo thumb($v[thumb],68,52);?>" width="68" height="52" alt="<?php echo $menu_info['0'];?>" >
							</div>
							<p>
								<a class="red" href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a>
								| <?php echo $menu_info['0'];?>							</p>
							<p>����:<?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></p>
						</div>
									 <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>					          										          										          										          										          										          										          														<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=416fa5e82225f7ec2818ce13a764a6c0&action=hits&catid=14&order=weekviews+DESC&limit=1%2C8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'14','order'=>'weekviews DESC','limit'=>'20',));}?>
					<?php $i=2?>
					<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
						<li><span  class="num1"  ><?php echo $i;?></span><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a>
								<span class="a3"><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span></li>
									<?php $i++; ?>
								<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
																													</ul>
										</div>
				</div>
				<!--�Ź�����-->
				<div class="border mt10">
					<h3 class="pdlr10 bg_fcfcfc border_xuxian_bottom">
						<a class="fr" href="<?php echo HOUSE_PATH;?>list.html" target="_blank">����</a>
						�����Ź�����
					</h3>
					<div class="pdb10">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=bca19a1f656a2d8df2b97b61c714acd0&action=toptuangou&month=1&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'toptuangou')) {$data = $content_tag->toptuangou(array('month'=>'1','limit'=>'10',));}?> 																						<ul>		
							<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>						
							<li>
								<span  class="num1" ><?php echo $n;?></span>
								<a target="_blank" title="<?php echo $v['subject'];?>" href="<?php echo HOUSE_PATH;?><?php echo $v['relation'];?>"><?php echo $v['subject'];?></a>
								<span class="a3"><?php echo $v['counts'];?>��</span>
							</li>
											 <?php $n++;}unset($n); ?>
								</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
										</div>
				</div>
			</div>
			<div class="w730 fr">
				<!--�·��۸��ѯ-->
				<div class="border w728 cf" id="tab2">
					<div class="titl cf">
						<b>�·��۸��ѯ</b>
							<ul>
						<?php $range_arr = getbox_name('13','range')?>
						<?php $i=1?>
						
						<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
						<?php if($i<7) { ?>
						 <li <?php if($n==1) { ?>class="on"<?php } ?>><a href="<?php echo HOUSE_PATH;?>list-p<?php echo $key;?>.html"><?php echo $v;?></a></li>	<?php $i++?>
						<?php } ?> <?php $n++;}unset($n); ?>
					<li><span><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank">����</a></span></li>
						</ul>
					</div>
					<?php $i=1?>
					
					<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
					<?php if($i<7) { ?>
					<?php $where="`range`=$key"?>
					<div class="housetxt cf" <?php if($i==1) { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
						<ul class="rightimg">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1cae95f48b6f532be8d5cb07c90dd31f&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
    													<li>
								<p>
									<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
								</p>
								<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
									<img data-src="<?php echo thumb($v[thumb],169,130);?>" alt="<?php echo $v['title'];?>" /></a>
							</li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="houselist">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6e1b0dbbf76f9b0264ff0dc05ce52090&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=3%2C24\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
							<li><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
						<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						</div>
						<?php $i++?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						</div>
				<div class="mt10 mb10"><!--q�·���� �·���ҳ-����1--> </div><!--q�·���� �·���ҳ-����1-->
				<!--�·������ѯ-->
				<div class="border w728 cf" id="tab3">
					<div class="titl">
						<b>�·������ѯ</b>
						<ul class="w70">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ee3a82b09698607383a5d01b0653d667&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}?>
						<?php $i=1?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php $reg = explode('$$', $r)?>
						<?php if($i<8) { ?>
						 <li <?php if($n==1) { ?>class="on"<?php } ?>><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?>.html"><?php echo $reg['1'];?></a></li>	<?php $i++?>
						<?php } ?> <?php $n++;}unset($n); ?>
					<li><span><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank">����</a></span></li>
						</ul>
					</div>
					<?php $i=1?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php $where = "status=99";?>
					<?php $reg = explode('$$', $r)?>
					<?php $arrchildid = get_arrchildid('3360',$reg[0]);?>
					<?php $where.=" and `region` in ($arrchildid)";?>
					<?php if($i<8) { ?>
					<div class="housetxt cf" <?php if($i==1) { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
						<ul class="rightimg">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1cae95f48b6f532be8d5cb07c90dd31f&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
    													<li>
								<p>
									<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
								</p>
								<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
									<img data-src="<?php echo thumb($v[thumb],169,130);?>" alt="<?php echo $v['title'];?>" /></a>
							</li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="houselist">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6e1b0dbbf76f9b0264ff0dc05ce52090&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=3%2C24\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
							<li><span><?php if(!empty($v[price])) { ?><?php echo $v['price'];?>/�O<?php } else { ?>����<?php } ?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
						<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						</div>

						<?php $i++?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
											
                    		</div>
				<div class="mt10 mb10"><!--q�·���� �·���ҳ-����2--></div><!--q�·���� �·���ҳ-����2-->
				<!--����Ŀ���Ͳ�ѯ-->
				<div class="border w728 cf" id="tab4">
					<div class="titl">
						<b>����Ŀ���Ͳ�ѯ</b>
						<ul>
					<?php $type_arr = getbox_name('13','type')?>
						<?php $i=1?>						
						<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
						<?php if($i<7) { ?>
						 <li <?php if($n==1) { ?>class="on"<?php } ?>><a href="<?php echo HOUSE_PATH;?>list-p<?php echo $key;?>.html"><?php echo $v;?></a></li>	<?php $i++?>
						<?php } ?> <?php $n++;}unset($n); ?>
					<li><span><a href="<?php echo HOUSE_PATH;?>list.html" target="_blank">����</a></span></li>
						</ul>
					</div>
					<?php $i=1?>					
					<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
					<?php if($i<7) { ?>
					<?php $where="`type` like '%$key%'"?>
					<div class="housetxt cf" <?php if($i==1) { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
						<ul class="rightimg">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1cae95f48b6f532be8d5cb07c90dd31f&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
    													<li>
								<p>
									<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a>
								</p>
								<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
									<img data-src="<?php echo thumb($v[thumb],169,130);?>" alt="<?php echo $v['title'];?>" /></a>
							</li><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="houselist">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6e1b0dbbf76f9b0264ff0dc05ce52090&action=lists&catid=14&where=%24where&order=listorder+DESC&limit=3%2C24\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'14','where'=>$where,'order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
							<li><span><?php if(!empty($v[price])) { ?><?php if($v[priceunit]=="0" ) { ?><?php echo $v['price'];?>Ԫ/�O<?php } elseif ($v[priceunit]=="2") { ?><?php echo price_short($v[price]);?>/��<?php } ?> <?php } else { ?>����<?php } ?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
						<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						</div>
						<?php $i++?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
														</div>
			</div>
		</div>
        <div class="mt5"><!--q�·���� �·���ҳ-ͨ��2--></div>
<!--q�·���� �·���ҳ-ͨ��2-->
		<div class="mt10 cf">
			<div class="w313 fl border mr10">
    <h3>
        <a class="fr" href="<?php echo catlink(29);?>" target="_blank">����</a>
        <b class="line"><?php echo catname(29);?></b>
    </h3>
    <div class="imgtxtB cf">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=205ae4060da1cd8a9233e58f8e25b504&action=lists&catid=29&thumb=1&order=listorder+DESC&limit=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
	<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                          <a href="<?php echo $v['url'];?>" class="fl" target="_blank"><img src="<?php echo thumb($v[thumb],80,60);?>"  width="80" height="60" alt="<?php echo $v['title'];?>" /></a>
                  <p><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></p>
	<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
    <ul><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=ca7efb2c2dd83c6fbefa2dd33f02be44&action=lists&catid=29&order=listorder+DESC&limit=1%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li><span><?php echo date('m��d��',$v[inputtime]);?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
</div><!--f�·���ҳ �������-��Ŀ1-->
			<div class="w313 fl border">
   <h3>
        <a class="fr" href="<?php echo catlink(31);?>" target="_blank">����</a>
        <b class="line"><?php echo catname(31);?></b>
    </h3>
    <div class="imgtxtB cf">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=08e126136d9b56fbd5c98f055480f2b4&action=lists&catid=31&thumb=1&order=listorder+DESC&limit=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'31','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
	<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                          <a href="<?php echo $v['url'];?>" class="fl" target="_blank"><img src="<?php echo thumb($v[thumb],80,60);?>"  width="80" height="60" alt="<?php echo $v['title'];?>" /></a>
                  <p><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></p>
	<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
    <ul><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=3f7ac8aa63e3d7438f40cf37c5d10856&action=lists&catid=31&order=listorder+DESC&limit=1%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'31','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li><span><?php echo date('m��d��',$v[inputtime]);?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>
</div><!--f�·���ҳ �����м�-��Ŀ1-->
			<div class="w313 fr border">
  <h3>
        <a class="fr" href="<?php echo catlink(28);?>" target="_blank">����</a>
        <b class="line"><?php echo catname(28);?></b>
    </h3>
    <div class="imgtxtB cf">
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=3e58bd1832aa9a46c649534ee4ec6639&action=lists&catid=28&thumb=1&order=listorder+DESC&limit=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','thumb'=>'1','order'=>'listorder DESC','limit'=>'20',));}?>
	<?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                          <a href="<?php echo $v['url'];?>" class="fl" target="_blank"><img src="<?php echo thumb($v[thumb],80,60);?>"  width="80" height="60" alt="<?php echo $v['title'];?>" /></a>
                  <p><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></p>
	<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
    <ul><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=f12f2351e4cfe719902d8f47cc5722c0&action=lists&catid=28&order=listorder+DESC&limit=1%2C4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'listorder DESC','limit'=>'20',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
                <li><span><?php echo date('m��d��',$v[inputtime]);?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo $v['title'];?></a></li>
<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </ul>
</div><!--f�·���ҳ �����Ҳ�-��Ŀ1-->
		</div>
        <div class="mt2"></div><!--q�·���� �·���ҳ-ͨ��3-->
		<div class="mt10 cf border">
    <h3>
        <a class="fr" href="<?php echo catlink(39);?>" target="_blank">����</a>
        <b class="line"> <?php echo catname(39);?> </b>
    </h3>
    <div class="goufangzt cf" id="gfzt">
        <div>
		 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=b40745e779f4884886611424eb7b95bd&action=lists&catid=39&limit=1&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'39','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
          <a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],270,250);?>" width="270" height="250"></a>
          <a  href="<?php echo $v['url'];?>" target="_blank" class="pic_pop" style="line-height:237px;"><?php echo $v['title'];?></em></a>
		  <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <ul class="fl w660">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=8eec54999a0dc818813d3bba2f9f72c9&action=lists&catid=39&limit=1%2C8&thumb=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">�༭</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'39','limit'=>'20','thumb'=>'1','order'=>'listorder DESC',));}?><?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
         <li>
		 <a target="_blank" href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><img alt="<?php echo $v['title'];?>" src="<?php echo thumb($v[thumb],140,105);?>" width="140" height="105"></a>
         <a href="<?php echo $v['url'];?>" target="_blank" class="pic_pop"><?php echo $v['title'];?></a>
        </li> <?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                      
                    </ul>
    </div>
</div>


				
</div>
<?php include template("content","footer"); ?>
<script type="text/javascript">
seajs.use(["jquery","autab"],function($){
	$("#tab1").autab("i","li",4);
	$("#tab2,#tab3,#tab4").autab("div.titl li:not(:has(span))","div.housetxt");
	$("#gfzt").on("mouseover","li,div",function(){
		$(this).find(".pic_pop").stop().animate({top:0});
	}).on("mouseout","li,div",function(){
		$(this).find(".pic_pop").stop().animate({top:"100%"});
	})
	$("#tree").on("click","span",function(){
		var $t=$(this);
		window.open($t.attr("url") ? $t.attr("url") : ("<?php echo APP_PATH;?>" + $t.attr("href")));
	})
})
</script>

</body>
</html>