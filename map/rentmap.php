<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$site_title = $sitelist[1]['site_title'];
$default_city = $sitelist[1]['default_city'];
$city_map = $sitelist[1]['city_map'];
list($lngX,$latY) = explode('|',$city_map);
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" /> 
<title>地图找房-';echo $default_city;;echo '二手房-';echo $site_title;;echo '</title>
<meta name="keywords" content="';echo $default_city;;echo '二手房,地图找房';echo $default_city;;echo '地图找二手房,';echo $default_city;;echo '二手房房源,';echo $default_city;;echo '二手房信息" />
<meta name="description" content="';echo $site_title;;echo '';echo $default_city;;echo '二手房地图,整合了所有';echo $default_city;;echo '二手房房源,精确的定位,详尽的信息,快捷的查询,帮您更加直观的寻找到合适的';echo $default_city;;echo '二手房房源,找';echo $default_city;;echo '二手房就上';echo $site_title;;echo '';echo $default_city;;echo '二手房网!" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2&services=true"></script> 
<script type="text/javascript" src="';echo APP_PATH;;echo 'statics/default/js/esf/map/jquery-1.7.2.min.js"></script> 
<script>var ESF_URL = \'';echo APP_PATH;;echo '\';var COMMUNITY_URL = \'';echo ESF_PATH;;echo '\';var IMG_URL = \'';echo APP_PATH;;echo '\';var SITE_URL = \'';echo APP_PATH;;echo '\';var RENT_URL = \'';echo APP_PATH;;echo '\';var module = \'zufang\';</script>
<link rel="stylesheet" type="text/css" href="';echo APP_PATH;;echo 'statics/default/css/esf/Map2_Baidu_Findding_sell.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="';echo APP_PATH;;echo 'statics/default/css/esf/bmapCommon.css" />
<style type="text/css">
#header .head1 h2 td.off dl.init_drop_list{border:1px transparent dotted;}
#header .head1 h2 td.off dl.over_drop_list{background-color:#fff;border-style: solid solid none;border-width: 1px 1px medium;border-color: #F8931E #F8931E -moz-use-text-color}
</style>
</head>
<body>
<div id="container" style=" width:100%;height:100%;border:none;">
    <div id="header">
        <div class="header_box">
<div id="zhijia-logo">
	<h1>	
		<a href="{ESF_PATH}" target="_blank">
			<img src="';echo APP_PATH;;echo 'statics/default/img/logo.png" />
		</a>
	</h1>
</div>

<div class="head1" id="apf_id_4">
	<div class="searchs">
    	<dl>
        	<dt class="icon"><input name="k" id="keyword" class="qwhereinput gray" value="输入名称或地标" type="text" size="38" /></dt>
            <dt class="btn_search"></dt>
        </dl>
    </div>
    <h2>
            <table>

            <tr>
            <td class="i0">快速定位：</td>
            <td id="area" class="i1 off" >
            <dl class="DL1">
            	<dd></dd>
            	<dt><a href="javascript:" id="currentArea">区域</a></dt>
            	<dt class="arr"></dt>
           	</dl>
           	               <dl id="areaList" class="DL2">
               <dt><a href="javascript:;" pid="0" lat="" lng="" zoom="13">不限</a></dt>
   							</dl>
			            </td>
            <td id="block" class="i2 off" >
            	<dl class="DL1"><dd></dd><dt><a href="javascript:" id="currentCircle">板块</a></dt><dt class="arr"></dt></dl>
                <dl id="blockList" class="DL2">
                	<dt class="none_block"><-请先选择区域</dt>
                </dl>
            </td>
                        <td id="recent" class="i4 off" >
            	<dl class="DL1"><dd></dd><dt><a href="javascript:" id="recent_select">最近浏览</a></dt><dt class="arr"></dt></dl>
	            <dl id="recentList" class="DL2">
	            	            		            	<dt><a href="javascript:;" title="" lat="38.049270" lng="114.567020" zoom="16" hid=""></a></dt>
	            		            	<dt><a href="javascript:;" title="" lat="38.042157" lng="114.494534" zoom="16" hid=""></a></dt>
	            		            	<dt><a href="javascript:;" title="" lat="38.021629" lng="114.457802" zoom="16" hid=""></a></dt>
	            		            	<dt><a href="javascript:;" title="" lat="38.059261" lng="114.447464" zoom="16" hid=""></a></dt>
	            		            	<dt><a href="javascript:;" title="" lat="38.018759" lng="114.444022" zoom="16" hid=""></a></dt>
	            		                        </td>

            </tr>
            </table>
    </h2>
    
</div>
</div>
<style type="text/css">
	#loginstate{float:right; padding-right:15px;}
</style>
<div class="head2">
        <div class="f1 header_line loadingbg" id="loginstate"></div>

<dl class="navlink">
			<dt><a href="';echo APP_PATH;;echo '" title="首 页">首 页</a></dt>
			<dd></dd>
					<dt><a href="';echo HOUSE_PATH;;echo '" title="新房">新房</a></dt>
					<dd></dd>
					<dt><a href="';echo catlink(6);;echo '" title="资讯">资讯</a></dt>
					<dd></dd>
					<dt><a href="';echo ESF_PATH;;echo '" title="二手房">二手房</a></dt>
					<dd></dd>
					<dt><a href="';echo ESF_PATH;;echo 'rent-list.html" title="出租房">出租房</a></dt>
					<dd></dd>
					<dt><a href="';echo BBS_PATH;;echo '" title="广场">广场</a></dt>
					<dd></dd>					
			</dl>
<dl id="switch_model" class="mapothers">
	    <dd class="icon"></dd>
    <dt><a href="';echo ESF_PATH;;echo 'list.html" class="switch_to_list">列表视图</a></dt>

</dl>
</div>
    </div>
    <div id="content" style="width:100%;position:absolute">


<div id="apf_id_9" class="map2_sidebar">
	<div class="map2left2010">
	    <dl class="list1 price" id="price">
    	<dt class="title">均价：</dt>
    	<dt><a href="javascript:;" fid="0" >价格不限</a></dt>
			';
$range_arr = getbox_name('39','range');
foreach ($range_arr as $key=>$value)
{
;echo '				    		    <dt><a href="javascript:;" fid="';echo $key;;echo '">';echo $value;;echo '</a></dt>
			';};echo '	    	    	        </dl>
        
        <dl class="list1 model" id="roomtype">
    	<dt class="title">户型：</dt>
    	<dt><a href="javascript:;" fid="0" >类型不限</a></dt>
				    	    <dt><a href="javascript:;" fid="1">一室</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="2">二室</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="3">三室</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="4">四室</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="5">其它</a></dt>	    	    
				        </dl>
		<ul class="map2_tab_selector">
    	<dt class="title">更多筛选:</dt>
    </ul>
    <div class="map2_sidebar_filters" id="map2_sidebar_filters_apf_id_9">
	    <ul class="map2_sidebar_filters_panel">
	    	<li id="filter_area" class="filter_area_fit"><a href="javascript:;">面积</a></li>
	    	<li id="filter_type" class="filter_type"><a href="javascript:;">类型</a></li>
	    </ul>
	    	    <ul class="map2_sidebar_filter_area" style="display: none; top: 0px;" id="sidebar_filter_area">
	    	<li><a paramid="0" href="javascript:;">面积不限</a></li>
			';
$area_range_arr = getbox_name('39','area_range');
foreach ($area_range_arr as $key=>$value)
{
;echo '				    		    <li><a paramid="';echo $key;;echo '" href="javascript:;">';echo $value;;echo '</a></li>
			';};echo '	    	    	    <li class="clear"></li>
	    	<li class="background" style="height: 94px;"></li>
	    </ul>        
		<ul class="map2_sidebar_filter_type" style="display: none; top: 54px;" id="sidebar_filter_type">
	    	<li><a paramid="0" href="javascript:;">类型不限</a></li>
	    		  ';
$type_arr = getbox_name('39','type');
foreach ($type_arr as $key=>$value)
{
;echo '				    		    <li><a paramid="';echo $key;;echo '" href="javascript:;">';echo $value;;echo '</a></li>
			';};echo '	    		    	<li class="clear"></li>
	    	<li class="background" style="height: 118px;"></li>
	    </ul>
	    
    </div>
	</div>
</div>


<div id="apf_id_10" class="map2_div">
	<div id="overmap_layer_only" style="display:block;"></div>
	<div class="shadowh o1 shadowh1"></div>
    <div class="shadowh o2 shadowh2"></div>
    <div class="shadowh o3 shadowh3"></div>
    <div class="shadowh o4 shadowh4"></div>
    <div class="shadowh o5 shadowh5"></div>

    <div class="shadowv o1 shadowv1"></div>
    <div class="shadowv o2 shadowv2"></div>
    <div class="shadowv o3 shadowv3"></div>
    <div class="shadowv o4 shadowv4"></div>
    <div class="shadowv o5 shadowv5"></div>
    
    <div style="width:100%;" id="map_div"></div>   
</div>
    </div>
   
</div>
	<div class="map2_propwind" id="ppp" style="display: none;">
    	<div class="map2_propwind_close" id="map2_propwind_close"><a href="javascript:;" onclick="closeMapInfoDiv();">关闭</a></div>
    	<h2>
    		<span class="map2_propwind_commname"></span>
    		<span style="color:#FFFF00">均价：<strong class="prop_pricetrend">￥6868</strong></span>
    	</h2>
    	<div id="map2_info_wrapper">
    		<div id="map2_propertys">
    			<div id="map2_info_sort">
    				<div class="sort_buttons" id="">
    					<span>排序：</span>
    					<a rel="area" href="javascript:;" class="sort_button">面积</a>
    					<a rel="price" href="javascript:;" class="sort_button">总价</a>
    				</div>
    				<span class="span_propnum">
    				找到<em class="prop_num" style=""></em>套房子
    				</span>
    			</div>
    			<div id="dmsg" style="width: 350px; height: 290px; margin: 0 auto; padding-top: 5px;"> </div> 
    			<div id="noprops" style="display: none;">
    				<p>
    					很抱歉，没有找到符合条件的房源。
    				</p>
    				<p>
    					<strong>建议您：</strong><br>
    					重新选择房源筛选条件。
    				</p>
    				<p class="red">
    					&lt;--就在左边
    				</p>
    			</div>
    			<ul class="property_list" style="" id="property_list"></ul>
    			<div id="map2_info_page" style="">
    				<a class="page_prev" style="visibility: hidden;">上一页</a>
    				<a class="page_next" style="visibility: hidden;">下一页</a>
    				<span class="total_pages"></span>
    			</div>
    		</div>
    	</div>
    	<div id="map2_filters">
    		<h5>按售价筛选:</h5>
    		<ul class="map2_filters_price" id="map2_filters_price"></ul>
    		<h5>按房型筛选:</h5>
    		<ul class="map2_filters_roomtype" id="map2_filters_roomtype"></ul>
    		<ul class="map2_filters_morelink">
    			<li><a target="_blank" class="map2_comm_moreinfo" href="/community/view/258862">查看小区详情&gt;&gt;</a></li>
    			    			<li><a target="_blank" class="map2_comm_fresh" href="/community/trends/258862">查看小区房价&gt;&gt;</a></li>
    			    		</ul>
    	</div>
    </div>
</body>
<script type="text/javascript" src="';echo APP_PATH;;echo 'statics/default/js/esf/map/bMapNewHouse-min.js"></script> 
<script type="text/javascript" src="';echo APP_PATH;;echo 'statics/default/js/esf/map/bMapLabel-min.js"></script> 
<script type="text/javascript" src="';echo APP_PATH;;echo 'statics/default/js/esf/map/snail-baidumap.js"></script> 
<script type="text/javascript"> 
var map = null;
var center = {
        "lat":"';echo $latY;;echo '",
		"lng":"';echo $lngX;;echo '",
        "zoom":13
    };
var filter = {\'areaid\': 0, \'circleid\': 0, "price": 0, \'roomtype\': 0 , \'area\': 0, \'houseage\': 0, "project": 0, \'page\': 1, \'areaorder\': \'\', \'priceorder\': \'\', \'keyword\': \'\'};
$(function(){
	//初始化地图
	$(\'#map_div\').height($(window).height() - $(\'#container\').height());
	map = new BMap.Map("map_div", {minZoom:12});
	map.enableScrollWheelZoom();
	var point = new BMap.Point(center.lng, center.lat);
	map.centerAndZoom(point, center.zoom);
	map.addControl(new BMap.NavigationControl());
	
	map.addEventListener("dragend", function(){ getCurrentHouses(\'dragend\'); }); 
	map.addEventListener("zoomend", function(){ getCurrentHouses(\'zoomend\'); });	
	//参数
	var params = document.location.hash.substring(1).toQueryParams();
	initBmap(params);//初始化url参数	
	//初始化搜索条件样式
	initSearchStyle(params);
	/* 操作下拉框样式 - start */
	initDisplayStyle();
	//弹出框搜索操作
	initDomsSearch();
	//搜索条件
	$(\'#price a\').click(function(){
		params.f1 = $(this).attr(\'fid\');
		initSearchStyle(params);
	})
	$(\'#roomtype a\').click(function(){
		//户型
		params.f2 = $(this).attr(\'fid\');
		initSearchStyle(params);
	})
	$(\'#areaList a\').click(function(){
		//获取板块
		var areaurl;
		if(module == \'ershoufang\'){
			areaurl =  ESF_URL + "ajax/circle";
		}else{
			areaurl =  RENT_URL + "ajax/circle";
		}
		$.ajax({
			type:\'GET\',
			url: areaurl,
			data:{\'areaid\':$(this).attr(\'pid\')},
			success:function(response){
				if(response){
					$(\'#blockList\').html(response);
				}else{
					$(\'#blockList\').html(\'<dt class="none_block"><-请先选择区域</dt>\');
					$(\'#currentCircle\').html(\'板块\');
				}
			}
		})
		params.a1 = $(this).attr(\'pid\');
		params.a2 = 0;
		params.l1 = $(this).attr(\'lat\');
		params.l2 = $(this).attr(\'lng\');
		params.l3 = $(this).attr(\'zoom\');
		params.keyword = \'\';
		$(\'#keyword\').val("\\u8f93\\u5165\\u540d\\u79f0\\u6216\\u5730\\u6807");
		initSearchStyle(params);
		$(\'#areaList\').hide();
	})
	$(\'#blockList a\').live(\'click\', function(){
		params.a2 = $(this).attr(\'pid\');
		params.l1 = $(this).attr(\'lat\');
		params.l2 = $(this).attr(\'lng\');
		params.l3 = $(this).attr(\'zoom\');
		initSearchStyle(params);
		$(\'#blockList\').hide();
	})
	$(\'#recentList a\').click(function(){
		params.l1 = $(this).attr(\'lat\');
		params.l2 = $(this).attr(\'lng\');
		params.l3 = $(this).attr(\'zoom\');
		params.h = $(this).attr(\'hid\');
		initSearchStyle(params);
		$(\'#recentList\').hide();
	})
	//搜索框
	$(\'#keyword\').focus(function(){
		if($(this).val() == \'输入名称或地标\'){
			$(this).val(\'\');
		}
	})
	$(\'#keyword\').blur(function(){
		if($(this).val() == \'\'){
			$(this).val(\'输入名称或地标\');
		}
	})
	$(\'.btn_search\').click(function(){
		if(params.keyword != $(\'#keyword\').val()){
			params.keyword = $(\'#keyword\').val();
			initSearchStyle(params);
		}
	})
	//面积搜索
	$(\'#sidebar_filter_area a\').click(function(){
		$(\'#sidebar_filter_area\').hide();
		params.f3 = $(this).attr(\'paramid\');
		initSearchStyle(params);
	})
	//建造年代
	$(\'#sidebar_filter_age a\').click(function(){
		$(\'#sidebar_filter_age\').hide();
		params.f4 = $(this).attr(\'paramid\');
		initSearchStyle(params);
	})
	//项目类型
	$(\'#sidebar_filter_type a\').click(function(){
		$(\'#sidebar_filter_type\').hide();
		params.f5 = $(this).attr(\'paramid\');
		initSearchStyle(params);
	})
	var autocompleteurl;
	if(module == \'ershoufang\'){
		autocompleteurl =  ESF_URL + "api.php?op=village";
	}else{
		autocompleteurl =  RENT_URL + "api.php?op=village";
	}
	var options = {
		serviceUrl: autocompleteurl,
		width: 260,
		deferRequestBy: 0,
		params: { },
		noCache: true,
		autoSubmit: true
		};
	var a1 = $(\'#keyword\').autocomplete(options);
});
</script>
<link rel="stylesheet" type="text/css" href="';echo APP_PATH;;echo 'statics/default/css/esf/styles.css">
<script type="text/javascript" src="';echo APP_PATH;;echo 'statics/default/js/esf/jquery.autocomplete.js"></script>
</html>
';?>