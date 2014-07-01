<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><?php
$param = $_GET['param'];//2012/8/7
	if(!empty($param)&&stristr($param,'-')!=false)
	{
		$param_arr = explode('-', $param);
		foreach($param_arr as $_v) {
				if($_v) 
				{
					if(preg_match ( '/([a-z])(\d*)/', $_v, $matchs))
					{
						$$matchs[1] = intval($matchs[2]);
					}
				}
			}
		$parentid = $r;
		$bid = $b;
		$range = $p;
		$type = $t;
		$fix = $f;
		$character = $l;
		$opentime = $o;
		$hot = $h;
		$ord = $n;
		$page = $g;
	}
	else
	{
 	$parentid = intval($_GET['r']);
	$bid = intval($_GET['b']);
	$range = intval($_GET['p']);
	$type = intval($_GET['t']);
	$fix = intval($_GET['f']);
	$character = intval($_GET['l']);
	$opentime = intval($_GET['o']);
	$hot = intval($_GET['h']);
	$ord = intval($_GET['n']);
	$page = intval($_GET['g']);
	$keyword = trim($_GET['keyword']);
	$k = trim($_GET['k']);
	}
	?>
<?php include template("content","head_house"); ?>
<div class="cArea" >
<div class="listtopsearch"></div>
<div class="listconsearch">
<div class="get" id="get">
  <div class="getLine">	
  
<strong>区域：</strong>
<?php
	
	$where = "status=99";
	if(!empty($keyword))
	{
		if(is_utf8($keyword))
		{
			$keyword = iconv('utf-8','gbk',  $keyword);//解决中文参数编码不统一问题
		}
		$keyword1 = iconv('gbk', 'utf-8', $keyword);//rewrite 只支持UTF-8编码的中文
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
	elseif(!empty($parentid) && empty($bid))//区域顶级
	{
		$arrchildid = get_arrchildid('3360',$parentid);
		$where.=" and `region` in ($arrchildid)";
	}
	if(!empty($range))
	{
		$lst.= "-p".$range;
		$where.=" and `range`=$range";
	}
	if(!empty($type))
	{
		$lst.= "-t".$type;
		$where.=" and `type` like '%$type%'";
	}
	if(!empty($fix))
	{
		$lst.= "-f".$fix;
		$where.=" and `fix`=$fix";
	}
	if(!empty($character))
	{
		$lst.= "-l".$character;
		$where.=" and `character` like '%$character%'";
	}
	if(!empty($opentime))
	{
		$lst.= "-o".$opentime;
		if($opentime=='1')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m')";//本月
		}
		elseif($opentime=='2')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH),'%Y%m')";//下月
		}
		elseif($opentime=='3')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 3 MONTH),'%Y%m')";//三月内
		}
		elseif($opentime=='4')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 6 MONTH),'%Y%m')";//六月内
		}
		elseif($opentime=='5')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 MONTH),'%Y%m')";//前三月
		}
		elseif($opentime=='6')
		{
			$where.=" and DATE_FORMAT(opentime,'%Y%m') = DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 6 MONTH),'%Y%m')";//前六月
		}
	}
	if(!empty($hot))
	{
		if($hot=='2'||$hot=='3')
		{
			$hot1 = $hot-1;
			$where.=" and xszt ='$hot1'";
			$lst.= "-h".$hot;
		}
		elseif($hot=='1')
		{
			$hot1 = 3;
			$where.=" and xszt ='$hot1'";
			$lst.= "-h".$hot;
		}
		else
		{
			$where.=" and `hot` like '%$hot%'";
			$lst.= "-h".$hot;
		}
	}
	if(!empty($ord))
	{
		if($ord=='1')
		{
			$order=" CAST(price AS SIGNED) DESC";
		}
		elseif($ord=='2')
		{
			$order=" CAST(price AS SIGNED) ASC";
		}
		elseif($ord=='3')
		{
			$order=" opentime DESC";
		}
		$lst.= "-n".$ord;
	}
	else
	{
		$order = "id DESC";
	}
	?>
<?php if(!empty($parentid)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'r');?>.html">不限</a>
</span>	
<ul>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg = explode('$$', $r);//add by L 2012/3/22
	?>
<li>
<?php if(!empty($parentid) && $parentid==$reg[0]) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list-r<?php echo $reg['0'];?><?php echo deal_str($lst,'r');?>.html"><?php echo $reg['1'];?></a>
</div>					
</li>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</ul>
</div>
<?php if($parentid) { ?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=e3d28ce1f67a9f7addc16249214e52e5&action=getlinkage&keyid=3360&parentid=%24parentid&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC',)).'e3d28ce1f67a9f7addc16249214e52e5');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>$parentid,'order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<?php if($data) { ?>
<div class="getLine">
<ul>
<strong>板块：</strong> 
<?php if(!empty($bid)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'b');?>.html">不限</a>
</span>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
 	$reg2 = explode('$$', $r);//add by L 2012/3/22
	?>
<li>
<?php if(!empty($bid) && $bid==$reg2[0]) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'b');?>-b<?php echo $reg2['0'];?>.html"><?php echo $reg2['1'];?></a>
</div>
</li>
<?php $n++;}unset($n); ?>
</ul>
</div>
<?php } ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
<div class="getLine">
<ul>
<strong>价格：</strong> 
<?php if(!empty($range)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'p');?>.html">不限</a>
</span>
<?php $range_arr = getbox_name('13','range')?>
<?php $n=1; if(is_array($range_arr)) foreach($range_arr AS $key => $v) { ?>
<li>
<?php if($range==$key) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>				
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'p');?>-p<?php echo $key;?>.html"><?php echo $v;?></a>
</div>
</li>
<?php $n++;}unset($n); ?>
</ul>
</div> 
  <div class="getLine">
<ul>
<strong>房屋类型：</strong>
<?php if(!empty($type)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'t');?>.html">不限</a>
</span>
<?php $type_arr = getbox_name('13','type')?>
<?php $n=1; if(is_array($type_arr)) foreach($type_arr AS $key => $v) { ?>
<li>
<?php if($type==$key) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'t');?>-t<?php echo $key;?>.html"><?php echo $v;?></a>
</div>
</li>
<?php $n++;}unset($n); ?>
</ul>
</div>  
<!--getLinemore-->
<div id="getLinemore" <?php if(empty($fix) && empty($character) && empty($opentime)) { ?> style="display:none"<?php } ?>>
 <div class="getLine">
<ul>
<strong>装修状况：</strong>
<?php if(!empty($fix)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'f');?>.html">不限</a>
</span>
<?php $fix_arr = getbox_name('13','fix')?>
<?php $n=1; if(is_array($fix_arr)) foreach($fix_arr AS $key => $v) { ?>
<li>
<?php if($fix==$key) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'f');?>-f<?php echo $key;?>.html"><?php echo $v;?></a>
</div>
</li>
<?php $n++;}unset($n); ?>
</ul>
 </div>
   <div class="getLine">
<ul>
<strong>开盘时间：</strong>
<?php if(!empty($opentime)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>.html">不限</a>
</span>
<li>
    <div class="a1">
<?php if($opentime=="1") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>			
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o1.html">本月开盘</a>
</div></div>
</li>
<li><div class="a1">
<?php if($opentime=="2") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o2.html">下月开盘</a>
</div></div>
</li>
<li><div class="a1">
<?php if($opentime=="3") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o3.html">三月内开盘</a>
</div></div>
</li>
<li><div class="a1">
<?php if($opentime=="4") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o4.html">六月内开盘</a>
</div></div>
</li>
<li><div class="a1">
<?php if($opentime=="5") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o5.html">前三月已开</a>
</div></div>
</li>
<li><div class="a1">
<?php if($opentime=="6") { ?>
<div class="j_k">
<?php } else { ?>
<div class="b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'o');?>-o6.html">前六月已开</a>
</div></div>
</li>
</ul>
 </div> 
   <div class="getLine">
<ul>
<strong>特色楼盘：</strong>
<?php if(!empty($character)) { ?>
<span  class="b_k">	
<?php } else { ?>
<span  class="j_k">	
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'l');?>.html">不限</a>
</span>
<?php $character_arr = getbox_name('13','character')?>
<?php $n=1; if(is_array($character_arr)) foreach($character_arr AS $key => $v) { ?>
<li>
<?php if($character==$key) { ?>
<div class="a1 j_k">
<?php } else { ?>
<div class="a1 b_k">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'l');?>-l<?php echo $key;?>.html"><?php echo $v;?></a>
</div>
</li>
<?php $n++;}unset($n); ?>
</ul>
 </div>	
 </div>
<!--getLinemore-->
 
  </div>
</div>
<div class="listendsearch linkh" id="linkhidden" style="padding:0 auto;display:none;cursor:pointer;" onclick="getLinemore('getLinemore', 'hidden', 'linkhidden', 'linkshow')">	
<span class="topimg"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/end.gif"/></span>隐藏更多搜索条件
</div>
<div class="listendsearch linkh" id="linkshow" style=" padding:0 auto;cursor:pointer;" onclick="getLinemore('getLinemore', 'show', 'linkshow', 'linkhidden')">	
<span class="topimg"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/top.gif"/></span>显示更多搜索条件
</div><?php if(empty($fix) && empty($character) && empty($opentime)) { ?> <script>getLinemore('getLinemore', 'hidden', 'linkhidden', 'linkshow')</script><?php } ?><script>getLinemore('getLinemore', 'loading', 'linkshow', 'linkhidden')</script>
<div class="hr10"></div>
</div><div class="cArea">
<div class="cen_box" style="position:relative">
<div class="PartGs">
  <div class="PartGsc">
    <ul>	  
<?php if(!empty($hot)) { ?>
  <li class="SearchI" id="m1">
  <?php } else { ?>
  <li class="SearchJ" id="m1">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>.html">全部楼盘</a>
  </li>
  <?php if($hot=="2") { ?>  
  <li class="SearchJ" id="m2">
  <?php } else { ?>
  <li class="SearchI" id="m2">
<?php } ?>
 <a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h2.html">在售楼盘</a>
  </li>	  	  
  <?php if($hot=="3") { ?>  
  <li class="SearchJ" id="m3">
  <?php } else { ?>
  <li class="SearchI" id="m3">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h3.html">即将上市</a>
  </li>	  
  <?php if($hot=="1") { ?>  
  <li class="SearchJ" id="m3">
  <?php } else { ?>
  <li class="SearchI" id="m3">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h1.html">尾盘</a>
  </li>	  
   <?php if($hot=="4") { ?>  
  <li class="SearchJ" id="m4">
  <?php } else { ?>
  <li class="SearchI" id="m4">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h4.html">热门楼盘 </a>
  </li>	 
   <?php if($hot=="5") { ?>  
  <li class="SearchJ" id="m5">
  <?php } else { ?>
  <li class="SearchI" id="m5">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h5.html">最新楼盘</a>
  </li>
 <?php if($hot=="6") { ?>  
  <li class="SearchJ" id="m6">
  <?php } else { ?>
  <li class="SearchI" id="m6">
<?php } ?>
<a href="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'h');?>-h6.html">精品楼盘</a>
   </li>
      <li class="SearchI">
<a href="<?php echo APP_PATH;?>map/" target="_blank">地图找房</a>
  </li>
    </ul>
  </div>
  <div class="content_list">
    <div id="n1">
<?php
if((!empty($keyword))||(!empty($k)))
{
	$lst=$lst1;	
}
?>
<div class="results">		
<div class="a1">共有<span class="redb" id="num"></span>个符合条件的楼盘</div><div class="a1">排序 
<select name="number" size="1" onchange="window.location.href=''+this.value+'';">
<option value="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'n');?>.html" <?php if(empty($ord)) { ?>selected<?php } ?>>默认排序</option>
<option value="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'n');?>-n1.html" <?php if($ord=="1") { ?>selected<?php } ?> >价格从高到低</option>
<option value="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'n');?>-n2.html" <?php if($ord=="2") { ?>selected<?php } ?>>价格从低到高</option>
<option value="<?php echo HOUSE_PATH;?>list<?php echo deal_str($lst,'n');?>-n3.html" <?php if($ord=="3") { ?>selected<?php } ?>>开盘时间倒序</option>
</select>
</div>
</div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=23f679dea3b13baa52bd938cc747055c&action=lists&catid=%24catid&where=%24where&num=10&lst=%24lst&order=%24order&page=%24page&moreinfo=1&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$housepages = housepages($content_total, $page, $pagesize, $urlrule,$lst);$mobilepages = mobilepages($content_total, $page, $pagesize, $urlrule,$keyword);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$where,'lst'=>$lst,'order'=>$order,'moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?><!-- 楼盘列表 -->
   
<div class="listhouse_k">
<!--hottop-->
    <!--list-->
	
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php
	if((!empty($keyword))||(!empty($k)))
	{
		if(count($data)==1)
		{
			header("location: ".HOUSE_PATH.$r[id]);//add by L 2012/7/29
		}
	}
?>
	<div class="listhouse">
<div class="listtp">
<a href="<?php echo $r['url'];?>/" target="_blank" title="<?php echo $r['title'];?>">
<img src="<?php if(!empty($r[thumb])) { ?><?php echo thumb($r[thumb],130,90);?><?php } else { ?><?php echo APP_PATH;?>statics/house5-style1/img/index/nopic.jpg<?php } ?>" width="130" height="90"/>
</a>
</div>
<ul>
<li>
<span class="td_1">
<a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a>
</span>
<?php if($r[xszt]=="1") { ?>
<div class="a2 state_zs">
<?php } ?>
<?php if($r[xszt]=="2") { ?>
<div class="a2 state_jjss">
<?php } ?>
<?php if($r[xszt]=="3") { ?>
<div class="a2 state_wp">
<?php } ?>
<?php if($r[xszt]=="4") { ?>
<div class="a2 state_sw">
<?php } ?>
<?php echo get_ztname($r[xszt]);?>
</div>
<span class="td_2 linkg">
<?php echo get_typename($r[type],2);?>
</span>
<span class="td_3"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?> 均价：<?php if($r[priceunit]=="0" ) { ?><?php echo $r['price'];?>元/平方米<?php } elseif ($r[priceunit]=="2") { ?><?php echo price_short($r[price]);?>/套<?php } ?> <?php } else { ?>一房一价<?php } ?> </span>
</li>
<li>
<span class="td_4 linkg">楼盘地址：<?php echo menu_linkinfo('3360',$r[region]);?><?php echo str_cut($r['address'],48,'');?> [<a href="<?php echo $r['url'];?>/peitao.html" target="_blank">查看地图</a>]
</span>
</li>
<li>
<span class="td_4">开 发 商：<?php echo getcompany_name($r[developer],12);?></span>
<span class="td_5">
<input type="submit" value="" class="smb_btn7" onmousedown="addCompareItem(<?php echo $r['id'];?>, '<?php echo $r['title'];?>')" />
</span>			
</li>
<li>
<span class="td_4 linka">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=4325b8b6cc777f60a1a3fc71531bf3d3&action=pictypecount&relation=%24r%5Bid%5D&catid=13&cache=172800&return=huxinginfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('relation'=>$r[id],'catid'=>'13',)).'4325b8b6cc777f60a1a3fc71531bf3d3');if(!$huxinginfo = tpl_cache($tag_cache_name,172800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'pictypecount')) {$huxinginfo = $content_tag->pictypecount(array('relation'=>$r[id],'catid'=>'13','limit'=>'20',));}if(!empty($huxinginfo)){setcache($tag_cache_name, $huxinginfo, 'tpl_data');}}?>
<a href="<?php echo $r['url'];?>/huxing.html" target="_blank">户型图(<?php echo $huxinginfo;?>)</a>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</span>
<span class="td_2 linkg">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=48d394915e011025c8111228e9e26385&action=pictypecount&relation=%24r%5Bid%5D&catid=8&cache=172800&return=xiangceinfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('relation'=>$r[id],'catid'=>'8',)).'48d394915e011025c8111228e9e26385');if(!$xiangceinfo = tpl_cache($tag_cache_name,172800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'pictypecount')) {$xiangceinfo = $content_tag->pictypecount(array('relation'=>$r[id],'catid'=>'8','limit'=>'20',));}if(!empty($xiangceinfo)){setcache($tag_cache_name, $xiangceinfo, 'tpl_data');}}?>
<a href="<?php echo $r['url'];?>/xiangce.html" target="_blank">楼盘相册(<?php echo $xiangceinfo;?>)</a>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</span>
<span class="td_2 linkg">
<?php $reviewsid="content_$catid-$r[id]-$siteid"?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"reviews\" data=\"op=reviews&tag_md5=e296a40ac8126d4deacfb35114aa7ab8&action=get_reviewscount&reviewsid=%24reviewsid&cache=172800&return=reviewsinfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('reviewsid'=>$reviewsid,)).'e296a40ac8126d4deacfb35114aa7ab8');if(!$reviewsinfo = tpl_cache($tag_cache_name,172800)){$reviews_tag = h5_base::load_app_class("reviews_tag", "reviews");if (method_exists($reviews_tag, 'get_reviewscount')) {$reviewsinfo = $reviews_tag->get_reviewscount(array('reviewsid'=>$reviewsid,'limit'=>'20',));}if(!empty($reviewsinfo)){setcache($tag_cache_name, $reviewsinfo, 'tpl_data');}}?>
<a href="<?php echo $r['url'];?>/dianping.html" target="_blank">楼盘点评(<?php echo $reviewsinfo;?>)</a>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</span>
<span class="td_2 linkg">
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1cbb76b154c27bb0b42cdb7bfda517d7&action=salescount&xglp=%24r%5Bid%5D&catid=6&morecatid=26%2C49%2C28%2C29&cache=172800&return=salescountinfo\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('xglp'=>$r[id],'catid'=>'6','morecatid'=>'26,49,28,29',)).'1cbb76b154c27bb0b42cdb7bfda517d7');if(!$salescountinfo = tpl_cache($tag_cache_name,172800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'salescount')) {$salescountinfo = $content_tag->salescount(array('xglp'=>$r[id],'catid'=>'6','morecatid'=>'26,49,28,29','limit'=>'20',));}if(!empty($salescountinfo)){setcache($tag_cache_name, $salescountinfo, 'tpl_data');}}?>
<a href="<?php echo $r['url'];?>/dongtai.html" target="_blank">销售动态(<?php echo $salescountinfo;?>)</a>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</span>
<span class="td_2 linkg">
<a href="<?php echo $r['url'];?>/#tg" target="_blank">团购</a>
</span>
<!-- <span class="td_2 linkg"><a href="<?php echo $r['bbs'];?>" target="_blank">业主论坛</a></span> -->
<span class="td_7">
电话：<?php echo $r['tel'];?>
</span>		
</li>
</ul>
</div>
<?php $n++;}unset($n); ?>
<h2>	
<div class="hr10"></div>
<div class="pga"><div class="pages cl"><div class="pg"><?php echo $housepages;?></div></div></div>
</h2>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
    </div>
<script>
var num = $('#nums').val();
$('#num').html(num);
</script>
   
    <div style="clear:both;font-size:1px;"></div>
  </div>
</div>
<div class="cen_end"></div>
</div>
<div class="right">
<!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
<!--最新浏览记录上方广告位-->
<!--最新浏览记录上方广告位--> <!--div class="houselistgg"><img src="/static/style/house/ggtp.gif" /></div-->
 <!--最新楼盘上方广告-->
 <!--最新楼盘上方广告-->
 <?php
 if(isset($recentlyHouse))
 {
	$prowhere = implode(',',$recentlyHouse);
}
 ?>
<?php if($prowhere) { ?>
    <?php $sql = "id in($prowhere) ORDER BY listorder DESC,inputtime DESC";?>
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=94502c9ae7b785fa535277fe2ee67783&action=lists&catid=%24catid&where=%24sql&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>$sql,)).'94502c9ae7b785fa535277fe2ee67783');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--最新楼盘 begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">最近浏览过的楼盘</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--最新楼盘 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php } ?>
     <div class="hr10"></div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=6586ec47215fc8efa0c3d1846ea2ec81&action=lists&catid=%24catid&where=%60hot%60+like+%27%255%25%27&num=10&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,)).'6586ec47215fc8efa0c3d1846ea2ec81');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%5%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--最新楼盘 begin--> 
     <div class="rig_wrap">
       <div class="title_rig link5">
   		<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">更多&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h5.html" target="_blank">最新楼盘</a>
</div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
   </li>
   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
            </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--最新楼盘 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=77eef62a5610b4b2384a5c48ba46bbe5&action=hits&catid=%24catid&num=10&order=views+DESC&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'order'=>'views DESC',)).'77eef62a5610b4b2384a5c48ba46bbe5');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--热门楼盘排行榜 begin-->
     <div class="rig_wrap">
       <div class="title_rig link5">
<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank">更多&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h4.html" target="_blank">热门楼盘排行榜</a>
   </div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">点击(次)</span>
</li>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php echo $r['views'];?></span>
</li>
<?php $n++;}unset($n); ?>
   
         </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--热门楼盘排行榜 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=705733c05377aa7eb117c4bccf67adb8&action=lists&catid=%24catid&where=%60hot%60+like+%27%256%25%27&num=10&order=%24order&cache=10800\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,)).'705733c05377aa7eb117c4bccf67adb8');if(!$data = tpl_cache($tag_cache_name,10800)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'where'=>'`hot` like \'%6%\'','order'=>$order,'limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
     <!--精品楼盘推荐 begin-->
     <div class="rig_wrap">
       <div class="title_rig link5">
<span class="link_span"><a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">更多&gt;&gt;</a></span>
<a href="<?php echo HOUSE_PATH;?>list-h6.html" target="_blank">精品楼盘推荐</a>
   </div>
       <div class="rig_cont px7">
         <ul class="hlist_a">
           <li class="title">
<span class="td_1">楼盘名称</span>
<span class="td_3">区域</span>
<span class="td_02">价格(元/㎡)</span>
</li>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<?php $menu_info = menu_info('3360',$r[region])?>
      <li>
<span class="td_1">·<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>/" target="_blank"><?php echo $r['title'];?></a></span>
<span class="td_2 link6"><a href="<?php echo HOUSE_PATH;?>list-r<?php echo $menu_info['1'];?>.html"><?php echo $menu_info['0'];?></a></span>
<span class="td_4"><?php if(!empty($r[price]) && $r[price]!="一房一价") { ?><?php echo $r['price'];?><?php } else { ?>一房一价<?php } ?></span>
</li>
<?php $n++;}unset($n); ?>
   
         </ul>
       </div>
       <div class="rig_end"></div>
     </div>
     <!--精品楼盘推荐 end-->
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
     <div class="hr10"></div>
</div>
</div>
<div class="hr10"></div>
<div class="hr10"></div>
</div>
</div>
<?php include template("content","footer"); ?>
<!--cArea-end-->
<!--lp_duibi start-->
<div class="clzt1" id="clzt1" title="点击展开" onclick="float_display('clzt1','none');float_display('clzt2','');">&nbsp;</div>
<div class="comparison" id="clzt2" style="display:none;position:absolute;z-index:200; right:0px;">
  <div class="comp_title font2">
  <span>
<a href="javascript:void(0)" onclick="float_display('clzt2','none');"><img src="<?php echo APP_PATH;?>statics/house5-style1/img/house/close.gif" /></a>
  </span>
  楼盘对比栏
  </div>
  <div class="comp_lr"  id="withitem">
  <div class="cllist1" id="itemlist">
  <ul>
  <li><!--addinto--></li>	
  </ul>
  </div>
 <div class="a1">		
<label id="dui_remove"><input type="submit" value="清空" class="smb_btn2" onclick="removeAllItem();" /></label>
<label id="dui_togo"><input type="submit" value="对比" class="smb_btn4" onclick="toComparePage();" /></label>		
</div>
  </div>
  <iframe  id="topframe" style='position:absolute; visibility:inherit; top:0px; border:0px; left:0px;width:150px;z-index:-1; filter: Alpha(Opacity=0);'></iframe>
  <div class="comp_end"></div>
</div>
<script>
var Float= new Object();
Float.Browser = {
ua: window.navigator.userAgent.toLowerCase(),
ie: /msie/.test(window.navigator.userAgent.toLowerCase()),
moz: /gecko/.test(window.navigator.userAgent.toLowerCase())
};
/************************Cookie*******************************/
var CompCookie = {
setCookie : function(name, value, expires, path, domain, secure)
{
document.cookie = name + "=" + escape(value) +
((expires) ? "; expires=" + expires.toGMTString() : "") +
((path) ? "; path=" + path : "; path=/") +
((domain) ? "; domain=" + domain : "") +
((secure) ? "; secure" : "");		
},
getCookie : function(name)
{
var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
if (arr != null)
{
return unescape(arr[2]);
}
return null;
},
clearCookie : function(name, path, domain)
{
if (CompCookie.getCookie(name))
{
 document.cookie = name + "=" +
((path) ? "; path=" + path : "; path=/") +
((domain) ? "; domain=" + domain : "") +
";expires=Fri, 02-Jan-1970 00:00:00 GMT";
}
}
};
function float_$(id)
{
return (typeof id == "object")?id:document.getElementById(id);
}
function float_display(id,display)
{
float_$(id).style.display = display;
setTopFrame();
}
//跳转至对比页面
function toComparePage()
{
var compCookie = CompCookie.getCookie("house_duibi");
if(compCookie)
{
var comps = compCookie.split("|");
var cmpstr = new Array();
var tempi = 0; 
for(var i=0;i<comps.length;i++)
{
cmpstr.push(comps[i].split(",")[1]);
tempi = tempi + 1;
}
if(tempi < 2){
alert('抱歉，至少选择2个以上的楼盘进行比较！');
return false;
}
window.open('<?php echo HOUSE_PATH;?>lp_duibi/'+cmpstr.join("_"));
        //why clear
        //CompCookie.clearCookie("wz_Houseapp_compare");
}else
    {
       // window.open('index.php');
   alert('抱歉，至少选择2个以上的楼盘进行比较！');
    }
    initCompareBar();
}
var g_comp_cookie = -1;
//初始化页面片
function initCompareBar()
{
    var compCookie = CompCookie.getCookie("house_duibi");
    if (g_comp_cookie == compCookie)
    {
        return false;
    }else
    {
        g_comp_cookie = compCookie;
    }
     if(compCookie)
{ 
//float_$("noitem").style.display="none";
//float_$("withitem").style.display="block";
float_$("itemlist").innerHTML = '';		
float_$("dui_remove").innerHTML = '<input type="submit" value="清空" class="smb_btn2" onclick="removeAllItem();" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="对比" class="smb_btn4" onclick="toComparePage();" />';	
var cookieArr = compCookie.split("|");
var itemStr = "";
itemStr+='<ul>';
for(var i=0;i<cookieArr.length;i++)
{
var serial_info = cookieArr[i].split(",");
itemStr+= '<li>';   		
itemStr+= '<span class="td_1" title="' + serial_info[0] + '">' + serial_info[0] + '</span>';
itemStr+= '<span class="td_2 linke"><a class="remove" href="javascript:removeCompareItem('+serial_info[1]+');">删除</a></span></li>';
 }
itemStr+='</ul>';
float_$("itemlist").innerHTML = itemStr;
}else
{	
float_$("itemlist").innerHTML = "";
float_$("itemlist").innerHTML = '<font style="line-height:25px; color:#ccc; overflow:hidden;">请先选择楼盘加入到对比栏<br />最多可同时对比4个楼盘</font>';
float_$("dui_remove").innerHTML = '<input type="submit" value="清空" class="smb_btn2" disabled="disabled" />';	
float_$("dui_togo").innerHTML = '<input type="submit" value="对比" class="smb_btn4" disabled="disabled" />';	
}
setTopFrame();
}
//setup topframe
function setTopFrame()
{
    if(Float.Browser.moz)
{
        float_$("topframe").style.top = "10px";
    }
    float_$("topframe").style.height=(float_$("clzt2").offsetHeight-(Float.Browser.moz?28:0))+"px";
}
//cookie设置
function addCompareItem(id,value)
{
float_$("clzt1").style.display="none";
float_$("clzt2").style.display="";
var compare = CompCookie.getCookie("house_duibi");
if(compare)
{
var newComArr = new Array();
var comArr = compare.split("|");
 		if(comArr.length>=4)
{
alert("您好,为了保证对比查看效果您最多只能选择4个楼盘参加比较");
return;
}
for(var i=0;i<comArr.length;i++)
{
if(comArr[i].split(",")[1] == id)
{
alert("对不起，您已经添加\""+comArr[i].split(",")[0]+"\"");
return;
}else
            {
                newComArr.push(comArr[i]);
            }
}
newComArr.push(value+","+id);
CompCookie.setCookie("house_duibi",newComArr.join("|"));
initCompareBar();
}else{
CompCookie.setCookie("house_duibi",value+","+id);		
 	}
initCompareBar();
}
//删除对比项
function removeCompareItem(id)
{
    initCompareBar();
var compare = CompCookie.getCookie("house_duibi");
if(compare)
{
var newComArr = new Array();
var comArr = compare.split("|");
for(var i=0;i<comArr.length;i++)
{
if(comArr[i].split(",")[1]!=id)
{
newComArr.push(comArr[i]);
}
}
CompCookie.setCookie("house_duibi",newComArr.join("|"));
initCompareBar();
}
}
//删除所有项
function removeAllItem()
{
CompCookie.clearCookie("house_duibi");
initCompareBar();
}
//最小高度，一级导航有关
var MIN_TOP = 220;
//浮动自身的宽度
var CLZT_WIDTH1 = 29;
var CLZT_WIDTH2 = 224;
function scrolldiv()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
    var scr_top = document.documentElement.scrollTop || document.body.scrollTop;
    var client_h = document.documentElement.clientHeight||document.body.clientHeight;
    var top = scr_top + (client_h/2 - 95);
    //当前高度
    var cur_top = parseInt(clzt1.style.top);
    if (top - cur_top > 4 || top - cur_top < -4)
    {
        top = Math.ceil(0.2 * (top - cur_top)) + cur_top;
    }
    if (top < MIN_TOP)
    {
        top = MIN_TOP;
    }
    //clzt1.style.top = top + 90 +"px";
    //clzt2.style.top = top + 90 +"px";
clzt1.style.top = top + 0 + "px";
    clzt2.style.top = top + 0 + "px";
}
//底部滚动条
function scroll_bot()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
    var scr_left = document.documentElement.scrollLeft || document.body.scrollLeft;
    var client_w = document.documentElement.clientWidth||document.body.clientWidth;
    var left1 = scr_left + client_w - CLZT_WIDTH1;
    if (left1 > 0)
    {
        //clzt1.style.left = left1 + 90 + "px";
clzt1.style.right = 0 + "px";
    }
    var left2 = scr_left + client_w - CLZT_WIDTH2;
    if (left2 > 0)
    {
        //clzt2.style.left = left2 + 90 + "px";
clzt2.style.right = 0 + "px";
    }
}
//固定位置
function fixed_div()
{
    var clzt1 = float_$("clzt1");
    var clzt2 = float_$("clzt2");
var top = document.documentElement.clientHeight||document.body.clientHeight;
    var scr_top = document.documentElement.scrollTop || document.body.scrollTop;
clzt1.style.position="fixed";
clzt1.style.right=0;
    top = (top/2-95);
    if (scr_top + top < MIN_TOP)
    {
        top = MIN_TOP - scr_top;
    }
clzt1.style.top = top + 90+"px";
    clzt2.style.position="fixed";
clzt2.style.right=0;
clzt2.style.top = top + 90+"px";
}
//相应鼠标滚轮
function mousewhell_cancel(tar) {clearInterval(tar);};
function mousewhell_go() {
    //setTimeout(scrolldiv,10);
var _detector = setInterval(scrolldiv,10);
setTimeout('mousewhell_cancel(' + _detector + ')',1000);
};
//初始化相关设置
function init_comp_bar()
{
    if (document.attachEvent&&window.ActiveXObject&&!window.XMLHttpRequest)
    {
        window.attachEvent("onload",scrolldiv);
        document.attachEvent("onmousewheel",mousewhell_go);
        window.attachEvent("onresize",function(){ scrolldiv(),scroll_bot()});
        window.attachEvent("onscroll",function(){ scrolldiv(),scroll_bot()});
    };
    if (document.attachEvent&&window.ActiveXObject&&window.XMLHttpRequest)
    {
    window.attachEvent("onload",fixed_div);
    window.attachEvent("onresize",fixed_div);
    window.attachEvent("onscroll",fixed_div);
    };
    if (document.addEventListener)
    {
        window.addEventListener("load",fixed_div,true);
        window.addEventListener("resize",fixed_div,true);
        window.addEventListener("scroll",fixed_div,true);
    };
    //定时更新cookie内容
    setInterval(initCompareBar,2000);
}
//初始化对比篮内容
initCompareBar();
//初始化位置
init_comp_bar();
</script>
<!--lp_duibi end-->
<!-- 返回顶部 -->
<!--a href="#"><div class="rTop" id="rTop"></div></a>
<script>
 window.onscroll=function(){
  if(document.body.scrollTop||document.documentElement.scrollTop>0){
   document.getElementById('rTop').style.display="block"
   }else{
    document.getElementById('rTop').style.display="none"
    }
  
  
  }
</script-->