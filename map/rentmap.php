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
<title>��ͼ�ҷ�-';echo $default_city;;echo '���ַ�-';echo $site_title;;echo '</title>
<meta name="keywords" content="';echo $default_city;;echo '���ַ�,��ͼ�ҷ�';echo $default_city;;echo '��ͼ�Ҷ��ַ�,';echo $default_city;;echo '���ַ���Դ,';echo $default_city;;echo '���ַ���Ϣ" />
<meta name="description" content="';echo $site_title;;echo '';echo $default_city;;echo '���ַ���ͼ,����������';echo $default_city;;echo '���ַ���Դ,��ȷ�Ķ�λ,�꾡����Ϣ,��ݵĲ�ѯ,��������ֱ�۵�Ѱ�ҵ����ʵ�';echo $default_city;;echo '���ַ���Դ,��';echo $default_city;;echo '���ַ�����';echo $site_title;;echo '';echo $default_city;;echo '���ַ���!" />
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
        	<dt class="icon"><input name="k" id="keyword" class="qwhereinput gray" value="�������ƻ�ر�" type="text" size="38" /></dt>
            <dt class="btn_search"></dt>
        </dl>
    </div>
    <h2>
            <table>

            <tr>
            <td class="i0">���ٶ�λ��</td>
            <td id="area" class="i1 off" >
            <dl class="DL1">
            	<dd></dd>
            	<dt><a href="javascript:" id="currentArea">����</a></dt>
            	<dt class="arr"></dt>
           	</dl>
           	               <dl id="areaList" class="DL2">
               <dt><a href="javascript:;" pid="0" lat="" lng="" zoom="13">����</a></dt>
   							</dl>
			            </td>
            <td id="block" class="i2 off" >
            	<dl class="DL1"><dd></dd><dt><a href="javascript:" id="currentCircle">���</a></dt><dt class="arr"></dt></dl>
                <dl id="blockList" class="DL2">
                	<dt class="none_block"><-����ѡ������</dt>
                </dl>
            </td>
                        <td id="recent" class="i4 off" >
            	<dl class="DL1"><dd></dd><dt><a href="javascript:" id="recent_select">������</a></dt><dt class="arr"></dt></dl>
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
			<dt><a href="';echo APP_PATH;;echo '" title="�� ҳ">�� ҳ</a></dt>
			<dd></dd>
					<dt><a href="';echo HOUSE_PATH;;echo '" title="�·�">�·�</a></dt>
					<dd></dd>
					<dt><a href="';echo catlink(6);;echo '" title="��Ѷ">��Ѷ</a></dt>
					<dd></dd>
					<dt><a href="';echo ESF_PATH;;echo '" title="���ַ�">���ַ�</a></dt>
					<dd></dd>
					<dt><a href="';echo ESF_PATH;;echo 'rent-list.html" title="���ⷿ">���ⷿ</a></dt>
					<dd></dd>
					<dt><a href="';echo BBS_PATH;;echo '" title="�㳡">�㳡</a></dt>
					<dd></dd>					
			</dl>
<dl id="switch_model" class="mapothers">
	    <dd class="icon"></dd>
    <dt><a href="';echo ESF_PATH;;echo 'list.html" class="switch_to_list">�б���ͼ</a></dt>

</dl>
</div>
    </div>
    <div id="content" style="width:100%;position:absolute">


<div id="apf_id_9" class="map2_sidebar">
	<div class="map2left2010">
	    <dl class="list1 price" id="price">
    	<dt class="title">���ۣ�</dt>
    	<dt><a href="javascript:;" fid="0" >�۸���</a></dt>
			';
$range_arr = getbox_name('39','range');
foreach ($range_arr as $key=>$value)
{
;echo '				    		    <dt><a href="javascript:;" fid="';echo $key;;echo '">';echo $value;;echo '</a></dt>
			';};echo '	    	    	        </dl>
        
        <dl class="list1 model" id="roomtype">
    	<dt class="title">���ͣ�</dt>
    	<dt><a href="javascript:;" fid="0" >���Ͳ���</a></dt>
				    	    <dt><a href="javascript:;" fid="1">һ��</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="2">����</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="3">����</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="4">����</a></dt>	    	    
				    	    <dt><a href="javascript:;" fid="5">����</a></dt>	    	    
				        </dl>
		<ul class="map2_tab_selector">
    	<dt class="title">����ɸѡ:</dt>
    </ul>
    <div class="map2_sidebar_filters" id="map2_sidebar_filters_apf_id_9">
	    <ul class="map2_sidebar_filters_panel">
	    	<li id="filter_area" class="filter_area_fit"><a href="javascript:;">���</a></li>
	    	<li id="filter_type" class="filter_type"><a href="javascript:;">����</a></li>
	    </ul>
	    	    <ul class="map2_sidebar_filter_area" style="display: none; top: 0px;" id="sidebar_filter_area">
	    	<li><a paramid="0" href="javascript:;">�������</a></li>
			';
$area_range_arr = getbox_name('39','area_range');
foreach ($area_range_arr as $key=>$value)
{
;echo '				    		    <li><a paramid="';echo $key;;echo '" href="javascript:;">';echo $value;;echo '</a></li>
			';};echo '	    	    	    <li class="clear"></li>
	    	<li class="background" style="height: 94px;"></li>
	    </ul>        
		<ul class="map2_sidebar_filter_type" style="display: none; top: 54px;" id="sidebar_filter_type">
	    	<li><a paramid="0" href="javascript:;">���Ͳ���</a></li>
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
    	<div class="map2_propwind_close" id="map2_propwind_close"><a href="javascript:;" onclick="closeMapInfoDiv();">�ر�</a></div>
    	<h2>
    		<span class="map2_propwind_commname"></span>
    		<span style="color:#FFFF00">���ۣ�<strong class="prop_pricetrend">��6868</strong></span>
    	</h2>
    	<div id="map2_info_wrapper">
    		<div id="map2_propertys">
    			<div id="map2_info_sort">
    				<div class="sort_buttons" id="">
    					<span>����</span>
    					<a rel="area" href="javascript:;" class="sort_button">���</a>
    					<a rel="price" href="javascript:;" class="sort_button">�ܼ�</a>
    				</div>
    				<span class="span_propnum">
    				�ҵ�<em class="prop_num" style=""></em>�׷���
    				</span>
    			</div>
    			<div id="dmsg" style="width: 350px; height: 290px; margin: 0 auto; padding-top: 5px;"> </div> 
    			<div id="noprops" style="display: none;">
    				<p>
    					�ܱ�Ǹ��û���ҵ����������ķ�Դ��
    				</p>
    				<p>
    					<strong>��������</strong><br>
    					����ѡ��Դɸѡ������
    				</p>
    				<p class="red">
    					&lt;--�������
    				</p>
    			</div>
    			<ul class="property_list" style="" id="property_list"></ul>
    			<div id="map2_info_page" style="">
    				<a class="page_prev" style="visibility: hidden;">��һҳ</a>
    				<a class="page_next" style="visibility: hidden;">��һҳ</a>
    				<span class="total_pages"></span>
    			</div>
    		</div>
    	</div>
    	<div id="map2_filters">
    		<h5>���ۼ�ɸѡ:</h5>
    		<ul class="map2_filters_price" id="map2_filters_price"></ul>
    		<h5>������ɸѡ:</h5>
    		<ul class="map2_filters_roomtype" id="map2_filters_roomtype"></ul>
    		<ul class="map2_filters_morelink">
    			<li><a target="_blank" class="map2_comm_moreinfo" href="/community/view/258862">�鿴С������&gt;&gt;</a></li>
    			    			<li><a target="_blank" class="map2_comm_fresh" href="/community/trends/258862">�鿴С������&gt;&gt;</a></li>
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
	//��ʼ����ͼ
	$(\'#map_div\').height($(window).height() - $(\'#container\').height());
	map = new BMap.Map("map_div", {minZoom:12});
	map.enableScrollWheelZoom();
	var point = new BMap.Point(center.lng, center.lat);
	map.centerAndZoom(point, center.zoom);
	map.addControl(new BMap.NavigationControl());
	
	map.addEventListener("dragend", function(){ getCurrentHouses(\'dragend\'); }); 
	map.addEventListener("zoomend", function(){ getCurrentHouses(\'zoomend\'); });	
	//����
	var params = document.location.hash.substring(1).toQueryParams();
	initBmap(params);//��ʼ��url����	
	//��ʼ������������ʽ
	initSearchStyle(params);
	/* ������������ʽ - start */
	initDisplayStyle();
	//��������������
	initDomsSearch();
	//��������
	$(\'#price a\').click(function(){
		params.f1 = $(this).attr(\'fid\');
		initSearchStyle(params);
	})
	$(\'#roomtype a\').click(function(){
		//����
		params.f2 = $(this).attr(\'fid\');
		initSearchStyle(params);
	})
	$(\'#areaList a\').click(function(){
		//��ȡ���
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
					$(\'#blockList\').html(\'<dt class="none_block"><-����ѡ������</dt>\');
					$(\'#currentCircle\').html(\'���\');
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
	//������
	$(\'#keyword\').focus(function(){
		if($(this).val() == \'�������ƻ�ر�\'){
			$(this).val(\'\');
		}
	})
	$(\'#keyword\').blur(function(){
		if($(this).val() == \'\'){
			$(this).val(\'�������ƻ�ر�\');
		}
	})
	$(\'.btn_search\').click(function(){
		if(params.keyword != $(\'#keyword\').val()){
			params.keyword = $(\'#keyword\').val();
			initSearchStyle(params);
		}
	})
	//�������
	$(\'#sidebar_filter_area a\').click(function(){
		$(\'#sidebar_filter_area\').hide();
		params.f3 = $(this).attr(\'paramid\');
		initSearchStyle(params);
	})
	//�������
	$(\'#sidebar_filter_age a\').click(function(){
		$(\'#sidebar_filter_age\').hide();
		params.f4 = $(this).attr(\'paramid\');
		initSearchStyle(params);
	})
	//��Ŀ����
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