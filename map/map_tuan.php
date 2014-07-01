<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$site_title = $sitelist[1]['site_title'];
$default_city = $sitelist[1]['default_city'];
$city_map = $sitelist[1]['city_map'];
list($lngX,$latY) = explode('|',$city_map);
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>';echo $default_city;;echo '楼盘电子地图 - ';echo $site_title;;echo '</title>
<meta name="keywords" content="楼盘电子地图，楼盘地图搜索，';echo $default_city;;echo '电子地图,';echo $default_city;;echo '楼盘地图,楼盘地图,楼市地图,新房地图" />
<meta name="description" content="楼盘电子地图，楼盘地图搜索，搜索楼盘，问房网，问房网楼盘地图、做最好的房产地图网站，提供';echo $default_city;;echo '房产分布地图、楼市电子地图、楼盘电子地图、新房电子地图搜索，提供最新、最全、最快的';echo $default_city;;echo '新房楼盘信息查询，公寓、经济适用房、花园洋房、板楼、塔楼、板塔结合、别墅等各式楼盘电子地图。" />
<link href="./img/css.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="';echo APP_PATH;;echo 'favicon.ico" />
';
error_reporting(0);
$newcodes = remove_xss(safe_replace(trim($_GET['ids'])));
;echo '<script type="text/javascript" src="http://app.mapabc.com/apis?&t=ajaxmap&v=2.1.2&key=';echo $map_key;;echo '"></script>
<script type="text/javascript">
var cityx="';echo $lngX;;echo '";
var cityy="';echo $latY;;echo '";
var citynameencode="';echo urlencode($default_city);;echo '";
var curCity = "0631";
var city="weihai";
var houseurl="';echo HOUSE_PATH;;echo '";
var cname="';echo $default_city;;echo '";
var mapcitycenter="" ;
//var mapcityround="" ;
var listtype="" ;
var mapsize=14;
var filePath = \'';echo APP_PATH;;echo 'api.php?\';
//var imgPath = \'\';
mapsize=15;
</script>
<script type="text/javascript" language="javascript">
';
$datas = getcache('3360','linkage');
$infos = $datas['data'];
$Districts = Array();
foreach ($infos as $key=>$value)
{
if($value['parentid'] == 0) {
$Districts[]= "{name:"."'".$value[name]."',index:"."'".$value[linkageid]."'}";
}
}
$District = implode(',',$Districts);
;echo 'var Districts=[';echo $District;;echo '];
var Area=[];
var Purposes=[{name:\'住宅\',index:\'1\'},{name:\'经济适用房\',index:\'10\'},{name:\'别墅\',index:\'6\'},{name:\'写字楼\',index:\'7\'},{name:\'商铺\',index:\'8\'},{name:\'公寓\',index:\'9\'},{name:\'商铺\',index:\'8\'},{name:\'酒店式公寓\',index:\'3\'}];
var Price=[];
Price[-1]=Price[1]={unit:\'单价(元/㎡)\',text:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\'],value:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\']};
Price[2]={unit:\'单价(元/㎡)\',text:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\'],value:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\']};
Price[3]={unit:\'单价(元/㎡)\',text:[\'3000以下\',\'3000-5000\',\'5000-7000\',\'7000-11000\',\'11000-13000\',\'13000-15000\',\'15000以上\'],value:[\'3000以下\',\'3000-5000\',\'5000-7000\',\'7000-11000\',\'11000-13000\',\'13000-15000\',\'15000以上\']};
Price[13]={unit:\'总价(万元/套)\',text:[\'150以下\',\'150-300\',\'300以上\'],value:[\'150以下\',\'150-300\',\'300以上\']};
Price[4]={unit:\'单价(元/㎡)\',text:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\'],value:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\']};
Price[5]={unit:\'单价(元/㎡)\',text:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\'],value:[\'3000以下\',\'3000-4000\',\'4000-6000\',\'6000-7000\',\'7000以上\']};
</script>
<script type="text/javascript" src="./js/SFUtil.js"></script>
<script type="text/javascript" src="./js/SFUI.js"></script>
<script type="text/javascript" src="./js/MapApi.js"></script>
<script type="text/javascript">

var searchcondition={
	cityname : \'';echo $default_city;;echo '\',
	newcodes : \'';echo $newcodes;;echo '\',
	listtype: \'\',
	drivertype : \'\',
	driverpoint : \'\',
	purpose: \'\',
	price: \'\',
	district: \'\',
	round: \'\',
	subwayname: \'\',
	searchname: \'\',
	area: \'\',
	keyword: \'\'
};

var zssearch={
	did:\'\',
	key:\'\',
	page:\'\'
};
zssearch.cid = "";
zssearch.dealerid = "";
var districtname = "";
var paramsname = "";
var roundname = "";
var searchname = "";
var purposename = "";
var pricevalue = "";
var defaultValue={
			"keyword":{"text":"请输入您要查询的楼盘名称，如：西海景苑","value":"西海景苑"},
			"zhs_key":{"text":"请输入您要查询的装饰公司名称","value":""},
			"jcc_key":{"text":"请输入您要查询的家居卖场名称","value":""},
			"nearfindname":{"text":"如：海水浴场","value":"海水浴场"},
			"nearfindtype":{"text":"如：餐厅","value":"餐厅"},
			"busstartname":{"text":"如：华联","value":"华联"},
			"busendname":{"text":"如：火炬大厦","value":"火炬大厦"},
			"busstationname":{"text":"请输入公交站名，如：火炬大厦","value":"火炬大厦"},
			"buslinenum":{"text":"请输入公交线路，如：7","value":"7"},
			"startarea":{"text":"如：大福源","value":"大福源"},
			"endarea":{"text":"如：火炬大厦","value":"火炬大厦"}
		};

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
<script type="text/javascript" src="./js/SFMapTuan.js"></script>
<script type="text/javascript" src="./js/search_other.js"></script>


</head>
<body>
<!-- 模板区域 begin -->

<form name="templates" id="templates" action="#" class="noshow" style="display:none;">
<textarea name="template_list" id="template_list">
	<li>
		<div class="inforightnrtr02td">
			<a href="javascript:;" onclick="SFMap.openTipById(\'{newCode}\');//Clickstat.optClickHandler(\'list\',\'openTip\',\'{newCode}\',\'{title}\');" class="s1">{title}</a>
			<span class="s2">[<a href="{detailUrl}" target="_blank" onclick="//Clickstat.optClickHandler(\'list\',\'detail\',\'{newCode}\',\'{title}\');">详情</a>]</span><span class="s2">{fav}</span>
		</div>
		<div class="inforightnrtr02td">物业类型:{purpose}</div>
		<div class="inforightnrtr02td">{price_type}:{price_num}{price_unit}</div>
		<div class="inforightnrtr02td">地址:{address}</div>
	</li>
</textarea>
<textarea name="template_notfound" id="template_notfound">
	<div class="searchinfobt">{title}</div>
	<div class="nosearchnr">
		<div class="zbresult02sm1"><strong>没有找到符合条件的楼盘</strong></div>
		<div class="zbresult02sm2">建议：
		<ul>{words}</ul>
	</div>
</textarea>
<!--楼盘详情 begin-->
<textarea name="template_maptip" id="template_maptip">
	<div id="maptip_bar" class="qipaobt" onmousedown="SFUI.drag(this.parentNode, event, \'map_canvas\');" style="cursor:move;">
		<div class="l"><span title="{title}">{title_s}</span>{saling_cn}</div>
		<div class="r"><li><span onclick="SFMap.closeTip();" style="cursor:pointer;"><img alt="关闭" src="./img/icon_title14.gif"></span></li></div>
		<div class="clear"></div>
	</div>
	<div class="qipaonr">
		<div class="qipaonr01">
			<div class="qipaonr01l">
			<ul>
				{price_d}
				<li>物业类型：{purpose}</li>
				<li>开盘时间：{startTime}</li>
				<li>开发商：{developer}</li>
				<li>楼盘销售电话：<span>{tel}</span></li>
				<li class="link"><a target="_blank" href="{detailUrl}">查看楼盘详情 &gt;&gt; </a></li>
			</ul>
			</div>
			<div class="qipaonr01r"><a target="_blank" href="{detailUrl}"><img width="167" height="134" src="{picAddress}" alt="{title}"></a></div>
			<div class="clear"></div>
		</div>
		<div class="qipaonr02">
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/dongtai.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'activUrl\',\'{newCode}\',\'{title}\');">楼盘动态</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/dianping.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'activUrl\',\'{newCode}\',\'{title}\');">楼盘点评</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/huxing.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'houseImg\',\'{newCode}\',\'{title}\');">户型图</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/xiangce.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'houseImg\',\'{newCode}\',\'{title}\');">楼盘相册</a>]
			<span><a href="javascript:;" onclick="SFMap.addFavorite(\'{newCode}\',this);//Clickstat.optClickHandler(\'list\',\'addfavorite\',\'{newCode}\',\'{title}\');">{fav}</a></span>
		</div>
	</div>
	<div class="qipaofoota"></div>
	<div class="qipaojt2" id="qipaojt">&nbsp;</div>
</textarea>
<!--楼盘详情 end-->
<textarea name="template_opentime" id="template_opentime">
<div class="conditionsearch">
<div class="s1"></div>
<div class="s3">开盘时间：&nbsp;
	<span class="path_down" id="opentimesyear_a" onclick="SFMapUI.makeSubmenu(event);SFUI.setInputA(\'opentimeeyear\',\'\',\'年\');return false;">{opentimesyear}</span>&nbsp;
	<span class="path_down" id="opentimesmonth_a" onclick="SFMapUI.makeSubmenu(event);SFUI.setInputA(\'opentimeemonth\',\'\',\'月\');return false;">{opentimesmonth}</span>
	&nbsp;-&nbsp;
	<span class="path_down" id="opentimeeyear_a" onclick="SFMapUI.makeSubmenu(event);return false;">{opentimesyear}</span>&nbsp;
	<span class="path_down" id="opentimeemonth_a" onclick="SFMapUI.makeSubmenu(event);return false;">{opentimesmonth}</span>&nbsp;&nbsp;&nbsp;
	<input type="button" class="but_2" value="确定" onclick="SFMapUI.searchOpentime(event);" />&nbsp;&nbsp;
	<span class="font1"><a href="javascript:;" onclick="SFMapUI.clearOpentime();">清空</a></span>
</div>
<div class="s2"></div>
<div class="clear"></div>
</div>
</textarea>
{*收藏单条*}
<textarea name="template_fav" id="template_fav">
<tr>
	<td style="width:25px"><input checked="checked" type="checkbox" value="{newCode}" name="fav_{newCode}" onclick="SFMap.toggleFav(this);"></td>
	<td><div class="mycollectionnrtrm" id="map_fav{newCode}"><a href="javascript:;" onclick="SFMap.openTipById(\'{newCode}\');//Clickstat.optClickHandler(\'favorite\',\'openTip\',\'{newCode}\',\'{title}\');">{title}</a></div></td>
	<td style="width:15px"><a href="javascript:;" onclick="SFMap.delFavorite(\'{newCode}\', this);"><img alt="清除" src="./img/icon_title03.gif"></a></td>
</tr>
</textarea>
<textarea name="template_result" id="template_result">
<div class="searchinfobt">{title}</div>
<div class="inforightnr">
	<div class="inforightnrtr01">
		<div class="s1">{allcount}</div>
		<div class="s2"><span class="path_down" id="sort_a" onmouseover="SFMapUI.showMenu(\'sort_a\');" onmouseout="SFUI.hideId(\'panel_sort_a\');">{sortStr}</span></div>
		<div class="clear"></div>
	</div>
	<div class="inforightnrtr02" id="resultlist"><ul>{list}</ul></div>
	<div class="inforightnrtr04" id="resultpage">{pager}</div>
</div>
</textarea>
<textarea name="template_fav_fdtips" id="template_fdtips">
	<div class="fdtips01"><div class="fdtips02"><img alt="" src="./img/map_title15.gif"></div>
		<div class="s1"></div>
		<div class="s2">
			<div class="text"><strong>{words}</strong> <span class="font1">[<a href="javascript:;" onclick="{iknow}">我知道了,不再提示</a>]</span></div>
			<div class="close"><a href="javascript:;" onclick="$id(\'fdtip\').style.display=\'none\';"><img alt="X" src="./img/icon_title14.gif"></a></div>
		</div>
		<div class="s3"></div>
	</div>
</textarea>
<textarea name="template_loading" id="template_loading">
<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding: 20px 0pt;"><img width="18" height="18" align="absmiddle" alt="" src="./img/load_18x18.gif">&nbsp;&nbsp;正在{words}，请稍候...</td>
	</tr></tbody>
</table>
</textarea>
</form>

<!-- 详情窗口 begin -->
<div class="fdtips" id="fdtip"></div>
<!-- 详情窗口 end -->
<!-- 模板区域 end -->
<div class="box">
<!-- 顶部导航 end -->
<!-- 中间内容 begin -->
<!-- 中间内容 begin -->
<div class="pagebody">
	<!-- 右边内容 begin -->
	<div class="pagebodyRight" id="map_result_main">
	<div class="inforight" id="rightmenu1" style="display:none;">
		<!-- 搜索结果内容 begin -->
		<div class="inforightnr" id="tab_div0"></div>
		<!-- 搜索结果内容 end -->
	</div>
	</div>
	<!-- 右边内容 end -->
	<!-- 左边内容 begin -->
	<div class="pagebodyLeft" id="map_body_box" style="marginRight:0px;">
		<div id="maptip" class="qipao"></div>
		<!--地图主体区 begin-->
		<div id="map_canvas" class="mapBody"></div>
		<!--地图主体区 end-->
	<div id="jczbsearch" class="noshow">
<div class="hotzb" id="hotzb">
	<div class="hotzbtop"></div>
	<div class="hotzbm">
		<div class="hotzbmbt"><span onclick="SFUI.hideId(\'hotzb\');"><img alt="关闭" src="./img/icon_title12.gif"></span>热门周边搜索</div>
		<div class="hotzbmtr">
			<div class="s1">周边楼盘</div>
			<div class="s2"><span class="alink" onclick="SearchOther.searchNearType(this);">楼盘</span></div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">餐饮美食</div>
			<div class="s2">
				<span class="alink" onclick="SearchOther.searchNearType(this);">快餐</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">家常菜</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">川菜</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">湘菜</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">健身休闲</div>
			<div class="s2">
				<span class="alink" onclick="SearchOther.searchNearType(this);">酒吧</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">咖啡</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">茶楼</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">KTV</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">美容院</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">洗浴</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">生活便利</div>
	 	  <div class="s2">
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">商场</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">超市</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">医院</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">药店</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">银行</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">ATM</span>
	 	  </div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">出门在外</div>
		 	<div class="s2">
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">加油站</span>
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">停车场</span>
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">火车售票点</span>
		 	</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="hotzbfoot"></div>
</div>
</div>
<div class="zbresult noshow" id="jczbresult">
	<div class="zbresult01">
		<div class="s0" onmousedown="SFUI.drag($id(\'jczbresult\'), event,\'map_canvas\');"></div>
		<div class="s1" id="jczbtitle">周边查询结果</div>
		<div class="s2"><a href="javascript:;" onclick="SearchOther.minBar(\'jczbresult\');"><img alt="最小化" src="./img/icon_title11.gif"></a><a onclick="SearchOther.backToHouseSearch();"><img alt="关闭" src="./img/icon_title12.gif"></a></div>
		<div class="clear"></div>
	</div>
	<div class="zbresult02 noshow" id="searching">
		<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: 20px 0pt;">
			<tbody><tr><td><img width="18" height="18" align="absmiddle" alt="" src="./img/load_18x18.gif">&nbsp;&nbsp;正在查询，请稍候...</td></tr></tbody>
		</table>
	</div>
	<div class="zbresult02 noshow" id="drive_start">
		<form action="" method="post" onsubmit="SearchOther.searchdrivelist();return false;">
		<div class="carSearch">
			<ul>
				<li>
					<div class="s4"><img src="./img/dot10.gif" alt=""></div>
					<div class="s5"><span><a href="javascript:;" onclick="SearchOther.exchangeDrivePoint();">起点与终点交换</a></span>起点：</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="carSearchXz"><div id="startList" class="s6 carSearchXzOn"></div></div>
				</li>
				<li class="top20">
					<div class="s4"><img src="./img/dot12.gif" alt=""></div>
					<div class="s5">终点：</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="carSearchXz"><div id="endList" class="s6 carSearchXzOn"></div></div>
				</li>
				<li class="s7"><input type="submit" value="确定" class="but_2"></li>
			</ul>
		</div>
		</form>
	</div>
	<div class="zbresult02 noshow" id="drive_result">
		<div class="carSearch">
			<ul>
				<li>
					<div class="s4"><img src="./img/dot10.gif" alt=""></div>
					<div class="s5" id="startdrive">起点：</div>
					<div class="clear"></div>
				</li>
				<li class="line" id="driveline"></li>
				<li>
					<div class="s4"><img src="./img/dot12.gif" alt=""></div>
					<div class="s5" id="enddrive">终点：</div>
					<div class="clear"></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="local_notfound">
		<div class="zbresult02sm1"><strong>没有找到条件的内容</strong></div>
		<div class="zbresult02sm2">建议：
			<ul>
				<li>尝试不同关键字。</li>
				<li>重新选择“<span class="font1"><a href="javascript:;" onclick="SFUI.hideId(\'jczbresult\');SFUI.showId(\'hotzb\');return false;"><strong>热门周边搜索</strong></a></span>”</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="drive_notfound">
		<div class="zbresult02sm1"><strong>很抱歉，没找符合您要求的条件</strong></div>
		<div class="zbresult02sm2">您可以试试下面的方法：
			<ul>
				<li>调整一下您输入的搜索关键字</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="loca_result">
		<div class="zbresulttr01">
			您正在搜索的“<span class="font3" id="searchnearname">本家家园</span>”<br/>
			附近的“<span class="font3" id="searchneartype">楼盘</span>”共<span class="font3" id="searchnearnum">60条</span>记录	  </div>
	  <div class="zbresulttr02" id="searchNearResult"></div>
	  <div class="inforightnrtr04" id="nearpagemenu"></div>
	</div>
	<div class="zbresult03"></div>
</div>
<div class="minimize" id="jczbsearchmin">
	<div class="s0" onmousedown="SFUI.drag($id(\'jczbsearchmin\'), event,\'map_canvas\');"></div>
	<div class="s1">驾车/周边</div>
	<div class="s2"><a href="javascript:;" onclick="SearchOther.maxBar(\'jczbsearchmin\');"><img alt="还原" src="./img/icon_title11a.gif"></a></div>
	<div class="clear"></div>
</div>
<div class="minimize" id="jczbresultmin">
	<div class="s0" onmousedown="SFUI.drag($id(\'jczbresultmin\'), event,\'map_canvas\');"></div>
	<div class="s1">查询结果</div>
	<div class="s2"><a href="javascript:;" onclick="SearchOther.maxBar(\'jczbresultmin\');"><img alt="还原" src="./img/icon_title11a.gif"></a><a href="javascript:;" onclick="SFUI.hideId(\'jczbresultmin\');"><img alt="X" src="./img/icon_title12.gif"></a></div>
	<div class="clear"></div>
</div>
<div class="noshow" id="driveline1"></div>	</div>
	<!-- 左边内容 end -->
	<div class="clear"></div>

<!-- 中间内容 end --><!-- 中间内容 end -->
</div>
</div>
</body>
</html>';?>