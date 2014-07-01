<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$site_title = $sitelist[1]['site_title'];
$default_city = $sitelist[1]['default_city'];
$city_map = $sitelist[1]['city_map'];
list($lngX,$latY,$zoom) = explode('|',$city_map);
if(empty($zoom))
$zoom=12;
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>';echo $default_city;;echo '¥�̵��ӵ�ͼ - ';echo $site_title;;echo '</title>
<meta name="keywords" content="¥�̵��ӵ�ͼ��¥�̵�ͼ������';echo $default_city;;echo '���ӵ�ͼ,';echo $default_city;;echo '¥�̵�ͼ,¥�̵�ͼ,¥�е�ͼ,�·���ͼ" />
<meta name="description" content="¥�̵��ӵ�ͼ��¥�̵�ͼ����������¥�̣�¥�̵�ͼ������õķ�����ͼ��վ���ṩ';echo $default_city;;echo '�����ֲ���ͼ��¥�е��ӵ�ͼ��¥�̵��ӵ�ͼ���·����ӵ�ͼ�������ṩ���¡���ȫ������';echo $default_city;;echo '�·�¥����Ϣ��ѯ����Ԣ���������÷�����԰�󷿡���¥����¥��������ϡ������ȸ�ʽ¥�̵��ӵ�ͼ��" />
<link href="./img/css.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="';echo APP_PATH;;echo 'favicon.ico" />
';
error_reporting(0);
$newcode = intval(trim($_GET['id']));
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
var filePath = \'';echo APP_PATH;;echo 'api.php?\';
//var imgPath = \'\';
mapsize="';echo $zoom;;echo '";
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
';
$type_arr = getbox_name('13','type');
$Types = Array();
foreach ($type_arr as $key=>$value)
{
$Types[]= "{name:"."'".$value."',index:"."'".$key."'}";
}
$Type = implode(',',$Types);
;echo 'var Purposes=[';echo $Type;;echo '];
var Price=[];
';
$range_arr = getbox_name('13','range');
$Prices = Array();
foreach ($range_arr as $key=>$value)
{
$Prices[]= "'".$value."'";
}
$Price = implode(',',$Prices);
;echo 'Price[-1]=Price[1]={unit:\'����(Ԫ/�O)\',text:[';echo $Price;;echo '],value:[';echo $Price;;echo ']};
</script>
<script type="text/javascript" src="./js/SFUtil.js"></script>
<script type="text/javascript" src="./js/SFUI.js"></script>
<script type="text/javascript" src="./js/MapApi.js"></script>
<script type="text/javascript">

var searchcondition={
	cityname : \'';echo $default_city;;echo '\',
	newcode : \'';echo $newcode;;echo '\',
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
			"keyword":{"text":"��������Ҫ��ѯ��¥�����ƣ��磺������Է","value":"������Է"},
			"zhs_key":{"text":"��������Ҫ��ѯ��װ�ι�˾����","value":""},
			"jcc_key":{"text":"��������Ҫ��ѯ�ļҾ���������","value":""},
			"nearfindname":{"text":"�磺��ˮԡ��","value":"��ˮԡ��"},
			"nearfindtype":{"text":"�磺����","value":"����"},
			"busstartname":{"text":"�磺����","value":"����"},
			"busendname":{"text":"�磺������","value":"������"},
			"busstationname":{"text":"�����빫��վ�����磺������","value":"������"},
			"buslinenum":{"text":"�����빫����·���磺7","value":"7"},
			"startarea":{"text":"�磺��Դ","value":"��Դ"},
			"endarea":{"text":"�磺������","value":"������"}
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
<script type="text/javascript" src="./js/SFMap.js"></script>
<script type="text/javascript" src="./js/search_other.js"></script>


</head>
<body>
<!-- ģ������ begin -->

<form name="templates" id="templates" action="#" class="noshow" style="display:none;">
<textarea name="template_list" id="template_list">
	<li>
		<div class="inforightnrtr02td">
			<a href="javascript:;" onclick="SFMap.openTipById(\'{newCode}\');//Clickstat.optClickHandler(\'list\',\'openTip\',\'{newCode}\',\'{title}\');" class="s1">{title}</a>
			<span class="s2">[<a href="{detailUrl}" target="_blank" onclick="//Clickstat.optClickHandler(\'list\',\'detail\',\'{newCode}\',\'{title}\');">����</a>]</span><span class="s2">{fav}</span>
		</div>
		<div class="inforightnrtr02td">��ҵ����:{purpose}</div>
		<div class="inforightnrtr02td">{price_type}:{price_num}{price_unit}</div>
		<div class="inforightnrtr02td">��ַ:{address}</div>
	</li>
</textarea>
<textarea name="template_notfound" id="template_notfound">
	<div class="searchinfobt">{title}</div>
	<div class="nosearchnr">
		<div class="zbresult02sm1"><strong>û���ҵ�����������¥��</strong></div>
		<div class="zbresult02sm2">���飺
		<ul>{words}</ul>
	</div>
</textarea>
<!--¥������ begin-->
<textarea name="template_maptip" id="template_maptip">
	<div id="maptip_bar" class="qipaobt" onmousedown="SFUI.drag(this.parentNode, event, \'map_canvas\');" style="cursor:move;">
		<div class="l"><span title="{title}">{title_s}</span>{saling_cn}</div>
		<div class="r"><li><span onclick="SFMap.closeTip();" style="cursor:pointer;"><img alt="�ر�" src="./img/icon_title14.gif"></span></li></div>
		<div class="clear"></div>
	</div>
	<div class="qipaonr">
		<div class="qipaonr01">
			<div class="qipaonr01l">
			<ul>
				{price_d}
				<li>��ҵ���ͣ�{purpose}</li>
				<li>����ʱ�䣺{startTime}</li>
				<li>�����̣�{developer}</li>
				<li>¥�����۵绰��<span>{tel}</span></li>
				<li class="link"><a target="_blank" href="{detailUrl}">�鿴¥������ &gt;&gt; </a></li>
			</ul>
			</div>
			<div class="qipaonr01r"><a target="_blank" href="{detailUrl}"><img width="167" height="134" src="{picAddress}" alt="{title}"></a></div>
			<div class="clear"></div>
		</div>
		<div class="qipaonr02">
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/dongtai.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'activUrl\',\'{newCode}\',\'{title}\');">¥�̶�̬</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/dianping.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'activUrl\',\'{newCode}\',\'{title}\');">¥�̵���</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/huxing.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'houseImg\',\'{newCode}\',\'{title}\');">����ͼ</a>]
			[<a href="';echo HOUSE_PATH;;echo '{newCode}/xiangce.html" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'houseImg\',\'{newCode}\',\'{title}\');">¥�����</a>]
			<span><a href="javascript:;" onclick="SFMap.addFavorite(\'{newCode}\',this);//Clickstat.optClickHandler(\'list\',\'addfavorite\',\'{newCode}\',\'{title}\');">{fav}</a></span>
		</div>
	</div>
	<div class="qipaofoota"></div>
	<div class="qipaojt2" id="qipaojt">&nbsp;</div>
</textarea>
<!--¥������ end-->
<textarea name="template_opentime" id="template_opentime">
<div class="conditionsearch">
<div class="s1"></div>
<div class="s3">����ʱ�䣺&nbsp;
	<span class="path_down" id="opentimesyear_a" onclick="SFMapUI.makeSubmenu(event);SFUI.setInputA(\'opentimeeyear\',\'\',\'��\');return false;">{opentimesyear}</span>&nbsp;
	<span class="path_down" id="opentimesmonth_a" onclick="SFMapUI.makeSubmenu(event);SFUI.setInputA(\'opentimeemonth\',\'\',\'��\');return false;">{opentimesmonth}</span>
	&nbsp;-&nbsp;
	<span class="path_down" id="opentimeeyear_a" onclick="SFMapUI.makeSubmenu(event);return false;">{opentimesyear}</span>&nbsp;
	<span class="path_down" id="opentimeemonth_a" onclick="SFMapUI.makeSubmenu(event);return false;">{opentimesmonth}</span>&nbsp;&nbsp;&nbsp;
	<input type="button" class="but_2" value="ȷ��" onclick="SFMapUI.searchOpentime(event);" />&nbsp;&nbsp;
	<span class="font1"><a href="javascript:;" onclick="SFMapUI.clearOpentime();">���</a></span>
</div>
<div class="s2"></div>
<div class="clear"></div>
</div>
</textarea>
{*�ղص���*}
<textarea name="template_fav" id="template_fav">
<tr>
	<td style="width:25px"><input checked="checked" type="checkbox" value="{newCode}" name="fav_{newCode}" onclick="SFMap.toggleFav(this);"></td>
	<td><div class="mycollectionnrtrm" id="map_fav{newCode}"><a href="javascript:;" onclick="SFMap.openTipById(\'{newCode}\');//Clickstat.optClickHandler(\'favorite\',\'openTip\',\'{newCode}\',\'{title}\');">{title}</a></div></td>
	<td style="width:15px"><a href="javascript:;" onclick="SFMap.delFavorite(\'{newCode}\', this);"><img alt="���" src="./img/icon_title03.gif"></a></td>
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
			<div class="text"><strong>{words}</strong> <span class="font1">[<a href="javascript:;" onclick="{iknow}">��֪����,������ʾ</a>]</span></div>
			<div class="close"><a href="javascript:;" onclick="$id(\'fdtip\').style.display=\'none\';"><img alt="X" src="./img/icon_title14.gif"></a></div>
		</div>
		<div class="s3"></div>
	</div>
</textarea>
<textarea name="template_loading" id="template_loading">
<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding: 20px 0pt;"><img width="18" height="18" align="absmiddle" alt="" src="./img/load_18x18.gif">&nbsp;&nbsp;����{words}�����Ժ�...</td>
	</tr></tbody>
</table>
</textarea>
</form>

<!-- ���鴰�� begin -->
<div class="fdtips" id="fdtip"></div>
<!-- ���鴰�� end -->
<!-- ģ������ end -->
<div class="box">
<!-- �������� begin -->
<div class="dingbuhexin" id="topmenu">
	<div class="dingbuhexinlogo"><a href="';echo HOUSE_PATH;;echo '"><img src="';echo APP_PATH;;echo 'statics/default/img/logo.png" alt="" /></a></div>
	<!-- �л����п�ʼ -->
	<div class="city" style=" line-height:40px; padding-left:5px; width:100px;  float:left; position:relative; top:5px; border-left:1px dashed #CCCCCC; z-index:9999"> <span style="display:block; float:left; cursor:pointer; padding-left:5px; padding-right:0px;">';echo $default_city;;echo '</span><span style="float:left; cursor:pointer; width:12px; display:block; background:url(';echo APP_PATH;;echo 'statics/default/img/icon/city.jpg) center no-repeat; height:40px;"></span>
      </div>
	  <!-- �л����н��� -->
	<div class="dingbuhexindh">
		<div class="rbjl noshow"></div>
				<div class="up">�·�</div>
		<div class="middle">
			<div class="line"></div><div class="down"><a href="';echo ESF_PATH;;echo 'map.html" target="_blank">���ַ�</a></div>								</div>
		<div class="rbj"></div> 
			</div>
	<div class="clear"></div>
</div>
<!-- �·���ͼ�������� begin -->
<div class="dingbuhexinnr" id="condition_bar">
<form id="form1" method="post" action=""  onsubmit="SFMapUI.clearAllOption();SFMap.searchKeyword();return false;">
	<div class="dingbuhexinnrl">������¥����/��ַ��<br/>
	<input name="keyword" autocomplete="off" id="keyword" type="text" class="guestbook01" style="vertical-align:middle;" value="" onkeyup="SFMapUI.suggest(event, this);"/>
	<input type="submit" class="but_1" value="����" style="vertical-align:middle;" />
	<div id="showsuggest" class="dingbuhexinnrljt" onclick="SFMapUI.showSuggest();"><img src="./img/icon_title23.gif" alt="" />&nbsp;</div>
	</div>
</form>
<form name="searchFilter" id="searchFilter" action="#">
<input type="hidden" name="purposes" id="purposes" value="" />
<input type="hidden" name="price" id="price"  />
<input type="hidden" name="opentimesyear" id="opentimesyear"  />
<input type="hidden" name="opentimesmonth" id="opentimesmonth"  />
<input type="hidden" name="opentimeeyear" id="opentimeeyear"  />
<input type="hidden" name="opentimeemonth" id="opentimeemonth"  />
<input type="hidden" name="opentime" id="opentime"  />
<input type="hidden" name="sort" id="sort" />
</form>
	<div class="dingbuhexinnrr">
		<div class="s1" id="purposes_a">���ͣ� ����&nbsp;&nbsp;<span><a href="#">סլ</a></span><span><a href="#">�������÷�</a></span><span><a href="#">����</a></span><span><a href="#">д��¥</a></span><span><a href="#">����</a></span></div>
		<div id="price_a">
			<div class="s1">�۸� ����   <span><a href="#">6ǧ����</a></span><span><a href="#">6ǧ-1��</a><span></span><a href="#">1��-1.5��</a></span><span><a href="#">1.5��-2��</a></span><span><a href="#">2��-3��</a></span><span><a href="#">3������</a></span> �ۼ� (��/�O)
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="conditionsearch" id="panel_moreoptions" onmouseover="SFMapUI.showMoreOptions();" onmouseout="SFMapUI.hideMoreOptions();">
		<div class="s1"></div>
		<div class="s3" id="panel_moreoptions_s3">
			<form>����ʱ�䣺<a onclick="SFMapUI.showMenu(\'opentimesyear_a\');SFUI.setInputA(\'opentimeeyear\',\'\',\'\');return false;" id="opentimesyear_a" class="path_down" href="javascript:;"></a> ��
				<a onclick="SFMapUI.showMenu(\'opentimesmonth_a\');SFUI.setInputA(\'opentimeeyear\',\'\',\'\');return false;" id="opentimesmonth_a" class="path_down" href="javascript:;"></a> ��  - 
				<a onclick="SFMapUI.showMenu(\'opentimeeyear_a\');return false;" id="opentimeeyear_a" class="path_down" href="javascript:;"></a> ��
				<a onclick="SFMapUI.showMenu(\'opentimeemonth_a\');return false;" id="opentimeemonth_a" class="path_down" href="javascript:;"></a> ��
			<input type="button" onclick="SFMapUI.searchOpentime(event);" value="ȷ ��" class="but_2" />
			<input type="button" onclick="SFMapUI.clearOpentime();" value="�� ��" class="but_3">
			</form>
		</div>
		<div class="s2"></div>
		<div class="clear"></div>
	</div>
</div>
<!-- �·���ͼ�������� end -->
<!-- �������� end -->
<!-- �м����� begin -->
<!-- �м����� begin -->
<div class="pagebody">
	<div class="path">
		<input type="hidden" name="districts" id="district" />
		<input type="hidden" name="area" id="area" />
		<input type="hidden" name="round" id="round" />
		<input type="hidden" name="subway" id="subway" />
		<input type="hidden" name="subwaystation" id="subwaystation" />
		<div class="pathl">���ٶ�λ��<span class="path_down" id="district_a" onmouseover="SFMapUI.showMenu(\'district_a\');"  onmouseout="SFUI.hideId(\'panel_district_a\');">ѡ������</span>
			<span class="path_down" id="round_a" onmouseover="SFMapUI.showMenu(\'round_a\');"  onmouseout="SFUI.hideId(\'panel_round_a\');">ѡ����</span>
			<span class="path_down" id="subway_a" onmouseover="SFMapUI.showMenu(\'subway_a\');"  onmouseout="SFUI.hideId(\'panel_subway_a\');">ѡ�����</span></div>
		<div class="pathm">
			<div class="pathm01 noshow" id="map_total"></div><span id="map_loading"><img width="18" height="18" align="absmiddle" alt="loading..." src="./img/load_18x18.gif"></span>
		</div>
		<div class="pathm2">
						<input name="lock" type="checkbox" id="lock" onclick="SFMap.toggleDrag(this,true);//Clickstat.optClickHandler(\'lock\',this.checked);" /> <span class="mapMenuRsd" title="��ѡ���϶���ͼ���ı��������">�����������</span></div>
				<div class="clear"></div>
	</div>
	<!-- �ұ����� begin -->
	<div class="pagebodyRight" id="map_result_main">
	<div class="inforight" id="rightmenu1">
		<div class="inforightbt">
			<ul>
				<li class="a_on">�������</li>
				<li class="line"></li>
				<li class="a_off"><a href="javascript:;" onclick="SFUI.showPeer(\'listfav\');SFMap.showFavorite();">�ҵ��ղ�</a></li>
			</ul>
		</div>
		<!-- ����������� begin -->
		<div class="inforightnr" id="tab_div0"></div>
		<!-- ����������� end -->
	</div>
	<div class="inforight noshow" id="listfav">
		<div class="inforightbt">
			<ul>
				<li class="a_off"><a href="javascript:;" onclick="SFUI.showPeer(\'rightmenu1\');SFMap.isDragend=true;SFMap.gotosearch();">�������</a></li>
				<li class="line"></li>
				<li class="a_on">�ҵ��ղ�</li>
			</ul>
		</div>
		<!-- �ҵ��ղ����� begin -->
		<div class="inforightnr">
			<div id="noFav">
				<div class="mycollectionbt"></div>
				<div class="mycollectionno"><strong>��û���ղ��κ�¥��</strong></div>
				<div class="description">
					<ul>
						<li>�����ԣ�</li><li>&nbsp;&nbsp;1.�����ͼ�е�¥��</li>
						<li>&nbsp;&nbsp;2.������ղء�</li>
						<li>&nbsp;&nbsp;3.�ղسɹ�</li>
						<li>ע�⣺������ղ�10��¥��</li>
					</ul>
				</div>
			</div>
			<div id="haveFav" style="display:none;">
				<div class="mycollectionbt">���������ղع���¥�̣�<span>[<a href="javascript:;" onclick="SFMap.clearFavorite();">����ղ�</a>]</span></div>
				<div class="mycollectionnr" id="map_fav"></div>
				<div class="description">
					<ul>
						<li>˵��</li>
						<li>1.�������ղ�10��¥��</li>
						<li>2.���<img hspace="2" align="absmiddle" alt="X" src="./img/icon_title03.gif">ɾ���ղص�¥��</li>
						<li>3.��ѡ��¥�̽��ڵ�ͼ����ʾ</li>
						<li>4.���<span class="zi1">[����ղ�]</span>��һ����ɾ�����ղص�����¥��</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- �ҵ��ղ����� begin -->
	</div>
	</div>
	<!-- �ұ����� end -->
	<!-- ������� begin -->
	<div class="pagebodyLeft" id="map_body_box">
		<div id="maptip" class="qipao"></div>
		<div id="map_result_barimg_hide" onclick="SFMapUI.toggleRight(false);">&nbsp;</div>
		<div id="map_result_barimg_open" onclick="SFMapUI.toggleRight(true);">&nbsp;</div>
		<!--��ͼ������ begin-->
		<div id="map_canvas" class="mapBody"></div>
		<!--��ͼ������ end-->
	<div id="jczbsearch" class="noshow">
<div class="hotzb" id="hotzb">
	<div class="hotzbtop"></div>
	<div class="hotzbm">
		<div class="hotzbmbt"><span onclick="SFUI.hideId(\'hotzb\');"><img alt="�ر�" src="./img/icon_title12.gif"></span>�����ܱ�����</div>
		<div class="hotzbmtr">
			<div class="s1">�ܱ�¥��</div>
			<div class="s2"><span class="alink" onclick="SearchOther.searchNearType(this);">¥��</span></div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">������ʳ</div>
			<div class="s2">
				<span class="alink" onclick="SearchOther.searchNearType(this);">���</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">�ҳ���</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">����</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">���</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">��������</div>
			<div class="s2">
				<span class="alink" onclick="SearchOther.searchNearType(this);">�ư�</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">����</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">��¥</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">KTV</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">����Ժ</span>
				<span class="alink" onclick="SearchOther.searchNearType(this);">ϴԡ</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">�������</div>
	 	  <div class="s2">
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">�̳�</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">����</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">ҽԺ</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">ҩ��</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">����</span>
	 	  	<span class="alink" onclick="SearchOther.searchNearType(this);">ATM</span>
	 	  </div>
			<div class="clear"></div>
		</div>
		<div class="hotzbmtr">
			<div class="s1">��������</div>
		 	<div class="s2">
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">����վ</span>
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">ͣ����</span>
		 		<span class="alink" onclick="SearchOther.searchNearType(this);">����Ʊ��</span>
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
		<div class="s1" id="jczbtitle">�ܱ߲�ѯ���</div>
		<div class="s2"><a href="javascript:;" onclick="SearchOther.minBar(\'jczbresult\');"><img alt="��С��" src="./img/icon_title11.gif"></a><a onclick="SearchOther.backToHouseSearch();"><img alt="�ر�" src="./img/icon_title12.gif"></a></div>
		<div class="clear"></div>
	</div>
	<div class="zbresult02 noshow" id="searching">
		<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: 20px 0pt;">
			<tbody><tr><td><img width="18" height="18" align="absmiddle" alt="" src="./img/load_18x18.gif">&nbsp;&nbsp;���ڲ�ѯ�����Ժ�...</td></tr></tbody>
		</table>
	</div>
	<div class="zbresult02 noshow" id="drive_start">
		<form action="" method="post" onsubmit="SearchOther.searchdrivelist();return false;">
		<div class="carSearch">
			<ul>
				<li>
					<div class="s4"><img src="./img/dot10.gif" alt=""></div>
					<div class="s5"><span><a href="javascript:;" onclick="SearchOther.exchangeDrivePoint();">������յ㽻��</a></span>��㣺</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="carSearchXz"><div id="startList" class="s6 carSearchXzOn"></div></div>
				</li>
				<li class="top20">
					<div class="s4"><img src="./img/dot12.gif" alt=""></div>
					<div class="s5">�յ㣺</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="carSearchXz"><div id="endList" class="s6 carSearchXzOn"></div></div>
				</li>
				<li class="s7"><input type="submit" value="ȷ��" class="but_2"></li>
			</ul>
		</div>
		</form>
	</div>
	<div class="zbresult02 noshow" id="drive_result">
		<div class="carSearch">
			<ul>
				<li>
					<div class="s4"><img src="./img/dot10.gif" alt=""></div>
					<div class="s5" id="startdrive">��㣺</div>
					<div class="clear"></div>
				</li>
				<li class="line" id="driveline"></li>
				<li>
					<div class="s4"><img src="./img/dot12.gif" alt=""></div>
					<div class="s5" id="enddrive">�յ㣺</div>
					<div class="clear"></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="local_notfound">
		<div class="zbresult02sm1"><strong>û���ҵ�����������</strong></div>
		<div class="zbresult02sm2">���飺
			<ul>
				<li>���Բ�ͬ�ؼ��֡�</li>
				<li>����ѡ��<span class="font1"><a href="javascript:;" onclick="SFUI.hideId(\'jczbresult\');SFUI.showId(\'hotzb\');return false;"><strong>�����ܱ�����</strong></a></span>��</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="drive_notfound">
		<div class="zbresult02sm1"><strong>�ܱ�Ǹ��û�ҷ�����Ҫ�������</strong></div>
		<div class="zbresult02sm2">��������������ķ�����
			<ul>
				<li>����һ��������������ؼ���</li>
			</ul>
		</div>
	</div>
	<div class="zbresult02 noshow" id="loca_result">
		<div class="zbresulttr01">
			�����������ġ�<span class="font3" id="searchnearname">���Ҽ�԰</span>��<br/>
			�����ġ�<span class="font3" id="searchneartype">¥��</span>����<span class="font3" id="searchnearnum">60��</span>��¼	  </div>
	  <div class="zbresulttr02" id="searchNearResult"></div>
	  <div class="inforightnrtr04" id="nearpagemenu"></div>
	</div>
	<div class="zbresult03"></div>
</div>
<div class="minimize" id="jczbsearchmin">
	<div class="s0" onmousedown="SFUI.drag($id(\'jczbsearchmin\'), event,\'map_canvas\');"></div>
	<div class="s1">�ݳ�/�ܱ�</div>
	<div class="s2"><a href="javascript:;" onclick="SearchOther.maxBar(\'jczbsearchmin\');"><img alt="��ԭ" src="./img/icon_title11a.gif"></a></div>
	<div class="clear"></div>
</div>
<div class="minimize" id="jczbresultmin">
	<div class="s0" onmousedown="SFUI.drag($id(\'jczbresultmin\'), event,\'map_canvas\');"></div>
	<div class="s1">��ѯ���</div>
	<div class="s2"><a href="javascript:;" onclick="SearchOther.maxBar(\'jczbresultmin\');"><img alt="��ԭ" src="./img/icon_title11a.gif"></a><a href="javascript:;" onclick="SFUI.hideId(\'jczbresultmin\');"><img alt="X" src="./img/icon_title12.gif"></a></div>
	<div class="clear"></div>
</div>
<div class="noshow" id="driveline1"></div>	</div>
	<!-- ������� end -->
	<div class="clear"></div>

<!-- �м����� end --><!-- �м����� end -->
</div>
<!--��׼�ʷ��ײ� begin-->
<!--��׼�ʷ��ײ� end-->

</div>
</body>
</html>';?>