<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$site_title = $sitelist[1]['site_title'];
$default_city = $sitelist[1]['default_city'];
$city_map = $sitelist[1]['city_map'];
list($lngX,$latY) = explode('|',$city_map);
if(empty($zoom))
$zoom=14;
$api_key = getbox_val('13','map');
;echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>';echo $default_city;;echo '������ͼ - ';echo $default_city;;echo '¥�̵�ͼ - ';echo $default_city;;echo '-';echo $site_title;;echo '</title>
	<meta name="keywords" content="';echo $default_city;;echo '¥�̵�ͼ,';echo $default_city;;echo '������ͼ,¥�е�ͼ,¥�̵��ӵ�ͼ,';echo $default_city;;echo '��ͼ�ҷ�" />
	<meta name="description" content="';echo $default_city;;echo '¥�е�ͼ,�������ɲ��Һ���¥��,����˽�����¥�̼�Ҫ��Ϣ,���෽���ݵ����龡��';echo $site_title;;echo '';echo $default_city;;echo '����¥�е��ӵ�ͼ��" />
	<link href="{APP_PATH}favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="';echo APP_PATH;;echo 'statics/default/newhouse/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="';echo APP_PATH;;echo 'statics/default/newhouse/css/map.css" rel="stylesheet" type="text/css" />
	<script src="';echo APP_PATH;;echo 'statics/default/js/house/map/sea.js" type="text/javascript"></script>
</head>
<body>
	<div id="header">
		<h1>
			<a href="';echo HOUSE_PATH;;echo '" target="_blank">
			<img src="';echo APP_PATH;;echo 'statics/default/img/logo.png" />
		</a>
		</h1>
		<div id="sltype">
			<b>�·�</b>
			<ul>
				<li>
					<a href="';echo ESF_PATH;;echo 'map.html">���ַ�</a>
				</li>
				<li>
					<a href="';echo ESF_PATH;;echo 'rent-map.html">�ⷿ</a>
				</li>
			</ul>
		</div>
		<form id="sform">
			<button type="submit"></button>
			<input id="keyword" value="�������ƻ�ر�" type="text"/>
		</form>
		<div id="select">
			���ٶ�λ��
			<ul>
								  <li id="areaList"><span>����</span><s></s><em></em>
				  <div>
					<a href="javascript:;" pid="0" zoom="14">����</a>
';
$datas = getcache('3360','linkage');
$infos = $datas['data'];
$Districts = Array();
foreach ($infos as $key=>$value)
{
if($value['parentid'] == 0) {
echo '<a href="javascript:;" pid="'.$value[linkageid].'" zoom="14">'.$value[name].'</a>';
}
}
;echo '									  </div>
								<li id="blockList"><span>��Ȧ</span><s></s><em></em>
					<div>
						<p class="gray9">
							����ѡ������
						</p>
					</div>
				</li>
				<li id="recentList"><span>������</span><s></s><em></em>
					<div>
						
													<p class="gray9">
								����δ�������ҹ�����������ĵ�ͼ���ҿ���
							</p>
											</div>
				</li>
			</ul>
		</div>
		<a href="';echo HOUSE_PATH;;echo 'list.html" class="switchList">�б���ͼ</a>
	</div>
	<div id="content" class="cf">
		<div id="shadow1"></div>
		<div id="shadow2"></div>
		<div id="lmenu">
			
						<ul class="cf" id="price">
			<li><b>���ۣ�</b></li>
			<li><a href="javascript:;" fid="0">����</a></li>
						';
$range_arr = getbox_name('13','range');
foreach ($range_arr as $key=>$value)
{
;echo '				    		    <li><a href="javascript:;" fid="';echo $key;;echo '">';echo $value;;echo '</a></li>
			';};echo '						</ul>
						
						<ul class="cf" id="project">
			<li><b>��Ŀ���ͣ�</b></li>
			<li><a href="javascript:;" fid="0">����</a></li>
			';
$type_arr = getbox_name('13','type');
foreach ($type_arr as $key=>$value)
{
;echo '				    		    <li><a href="javascript:;" fid="';echo $key;;echo '">';echo $value;;echo '</a></li>
			';};echo '						</ul>
									<ul class="cf">
				<li><b>����ɸѡ��</b></li>
			</ul>
			<ul id="sidebarFilters">
				<li id="feature" class="filterFit">
					<span>������ɫ</span>
					<ul class="cf">
					<li><a href="javascript:;" fid="0">����</a></li>
					';
$character_arr = getbox_name('13','character');
foreach ($character_arr as $key=>$value)
{
;echo '				    		    <li><a href="javascript:;" fid="';echo $key;;echo '">';echo $value;;echo '</a></li>
			';};echo '										</ul>
				</li>
			</ul>
					</div>
		<div id="cmap">
			<div id="map"></div>
			<div id="aPanl">
				<img src="';echo APP_PATH;;echo 'statics/default/newhouse/img/alert-t.png">��Ŀǰ�ĵ�ͼ��Χ��û�з�Դ����������Ϊ���ĵ�ͼ�����߹���������<a href="javascript:" class="reZoom">���ŵ�ͼ</a>��<a href="javascript:" class="reCenter">��������</a>
			</div>
		</div>
		</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=';echo $api_key;;echo '"></script>
<script type="text/javascript">
seajs.use(["jquery", "alert", "bmap", "autoc"], function($, alertM, bmap) {
	var lh = $("#lmenu").outerHeight(),
		$w = $(window);
	var $map = $("#map,#shadow2").height($w.height() - 105 > lh ? $w.height() - 105 : lh);
	$w.on("resize", function() {
		var h = $w.height() - 105;
		$map.height(h > lh ? h : lh);
	})
	var $keyword = $("#keyword").autoC("/api.php?op=house");
	$keyword.on("focus", function() {
		if ($keyword.val() == "�������ƻ�ر�") $keyword.val("");
	}).on("blur", function() {
		if ($keyword.val() == "") $keyword.val("�������ƻ�ر�");
	})

	var SellScheduleControl=function() {
		this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
		this.defaultOffset = new BMap.Size(58, 10)
	}
	SellScheduleControl.prototype = new BMap.Control();
	SellScheduleControl.prototype.initialize = function(b) {
		var c = document.createElement("div");
		c.innerHTML = \'<ul id="sellSchedule"><li class="t">����״̬</li><li><input type="checkbox" checked value="2"><img src="';echo APP_PATH;;echo 'statics/default/newhouse/img/sellSchedule1.gif"></li><li><input type="checkbox" checked value="1"><img src="';echo APP_PATH;;echo 'statics/default/newhouse/img/sellSchedule2.gif"></li><li><input type="checkbox" checked value="3"><img src="';echo APP_PATH;;echo 'statics/default/newhouse/img/sellSchedule3.gif"></li><li><input type="checkbox" checked value="4"><img src="';echo APP_PATH;;echo 'statics/default/newhouse/img/sellSchedule4.gif"></li></ul>\';
		b.getContainer().appendChild(c);
		return c
	};
	var sellScheduleCtrl = new SellScheduleControl();
	window.CSS_URL = \'';echo APP_PATH;;echo 'statics/default/newhouse/css/\';
	window.IMG_URL = \'';echo APP_PATH;;echo 'statics/default/newhouse/img/\';
	window.JS_URL = \'';echo APP_PATH;;echo 'statics/default/newhouse/js/\';
	window.ESF_URL = \'';echo ESF_PATH;;echo '\';
	window.SITE_URL = \'';echo APP_PATH;;echo '\';
	window.RENT_URL = \'';echo ESF_PATH;;echo '\';
	window.COMMUNITY_URL = \'\';
	window.searchType="xinfang";
	window.HOUSE_URL = "';echo HOUSE_PATH;;echo '";
	window.center = {
		"lat":"';echo $latY;;echo '",
		"lng":"';echo $lngX;;echo '",
		"zoom": "';echo $zoom;;echo '"
	};
	window.filter = {
		\'areaid\': 0,
		\'circleid\': 0,
		"price": 0,
		"project": 0,
		\'feature\': 0,
		\'keyword\': \'\'
	};

	window.map = new BMap.Map("map", {
		minZoom: 12
	});
	map.enableScrollWheelZoom();
	var point = new BMap.Point(center.lng, center.lat);
	map.centerAndZoom(point, center.zoom);
	map.addControl(new BMap.NavigationControl());
	map.addControl(sellScheduleCtrl);

	map.addEventListener("dragend", function() {
		bmap.getCurrentHouses(\'dragend\');
	});
	map.addEventListener("zoomend", function() {
		bmap.getCurrentHouses(\'zoomend\');
	});
	//����
	window.params = document.location.hash.substring(1).toQueryParams();
	bmap.initBmap(params);//��ʼ��url����
	//��ʼ������������ʽ
	bmap.initSearchStyle(params);
	$("#sellSchedule").on("click","input",function(){
		var state=$(this).is(\':checked\');
		bmap.colorCheck($(this).val()-0,state)
	})
	$("#sform").on("submit", function() {
		if(params.keyword != $keyword.val()){
			params.keyword = $keyword.val();
			bmap.initSearchStyle(params);
		}
		return false;
	})
	$(\'#price a\').click(function(){
		params.f1 = $(this).attr(\'fid\');
		bmap.initSearchStyle(params);
	})
	$(\'#project a\').click(function(){
		params.f2 = $(this).attr(\'fid\');
		bmap.initSearchStyle(params);
	})
	$(\'#feature a\').click(function(){
		params.f3 = $(this).attr(\'fid\');
		bmap.initSearchStyle(params);
	})
	$("#select li").on("mouseover",function(){
		$(this).addClass("on")
	}).on("mouseout",function(){
		$(this).removeClass("on")
	}).find("s").each(function(){
		$(this).width($(this).parent().outerWidth()-2)
	})
	var $areaList=$(\'#areaList\').on("click","a",function(){
		$areaList.find(\'span\').html($(this).html());
		$areaList.find(\'s\').width($areaList.outerWidth()-2)
		//��ȡ���
		$.ajax({
			type:\'GET\',
			url: HOUSE_URL + "ajax/circle",
			data:{\'areaid\':$(this).attr(\'pid\')},
			dataType:"html",
			success:function(response){
				if(response.length>0){
					$blockList.html(response);
				}else{
					$blockList.html(\'<p class="gray9">����ѡ������</p>\');
				}
				
			}
		})
		params.a1 = $(this).attr(\'pid\');
		params.a2 = 0;
		params.l1 = $(this).attr(\'lat\');
		params.l2 = $(this).attr(\'lng\');
		params.l3 = $(this).attr(\'zoom\');
		params.keyword = \'\';
		$keyword.val("�������ƻ�ر�");
		bmap.initSearchStyle(params);
	})
	var $blockList=$(\'#blockList\').on(\'click\',"a", function(){
		params.a2 = $(this).attr(\'pid\');
		params.l1 = $(this).attr(\'lat\');
		params.l2 = $(this).attr(\'lng\');
		params.l3 = $(this).attr(\'zoom\');
		bmap.initSearchStyle(params);
	}).find("div")
	$(\'#recentList\').on("click","a",function(){
		params.keyword = $(this).text();
		$(\'#keyword\').val(params.keyword);
		bmap.initSearchStyle(params);
	})
	$("#sltype").on("mouseover",function(){
		$(this).addClass("on")
	}).on("mouseout",function(){
		$(this).removeClass("on")
	})
	$("#sidebarFilters li.filterFit").on("mouseover",function(){
		$(this).addClass("on")
	}).on("mouseout",function(){
		$(this).removeClass("on")
	})
})
</script>
</body>
</html>
';?>