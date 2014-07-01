<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo CHARSET;echo '" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>';echo L('admin_site_title');echo '</title>
<link href="';echo CSS_PATH;echo 'reset.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH.SYS_STYLE;;echo '-system.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH;echo 'dialog.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles1.css" title="styles1" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles2.css" title="styles2" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles3.css" title="styles3" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles4.css" title="styles4" media="screen" />
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'styleswitch.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'dialog.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'jquery.sgallery.js"></script>
<script type="text/javascript">
var h5_hash = \'';echo $_SESSION['h5_hash'];echo '\'
</script>
<style type="text/css">
.objbody{overflow:hidden}
</style>
</head>
<body scroll="no" class="objbody">
<div id="dvLockScreen" class="ScreenLock" style="display:';if(isset($_SESSION['lock_screen']) &&$_SESSION['lock_screen']==0) echo 'none';;echo '">
    <div id="dvLockScreenWin" class="inputpwd">
    <h5><b class="ico ico-info"></b><span id="lock_tips">';echo L('lockscreen_status');;echo '</span></h5>
    <div class="input">
    	<label class="lb">';echo L('password');echo '：</label><input type="password" id="lock_password" class="input-text" size="24">
        <input type="submit" class="submit" value="&nbsp;" name="dosubmit" onclick="check_screenlock();return false;">
    </div></div>
</div>
<div class="header">
	<div class="logo lf"><a href="?s=admin/index&h5_hash=';echo $_SESSION['h5_hash'];;echo '"><span class="invisible">';echo L('house5_title');echo '</span></a></div>
    <div class="col-auto">
    	<div class="log white cut_line">';echo L('hello'),$admin_username;echo '  [';echo $rolename;echo ']<span>|</span><a href="?s=admin/index/public_logout">[';echo L('exit');echo ']</a><span>|</span>
    		<a href="';echo $currentsite['domain'];echo '" target="_blank" id="site_homepage">';echo L('site_homepage');echo '</a><span>|</span>
    		<a href="?s=member" target="_blank">';echo L('member_center');echo '</a><span>|</span>
    		<a href="?s=search" target="_blank" id="site_search">';echo L('search');echo '</a>
    	</div>
        <ul class="nav white" id="top_menu">
        ';
$array = admin::admin_menu(0);
foreach($array as $_value) {
if($_value['id']==10) {
echo '<li id="_M'.$_value['id'].'" class="on top_menu"><a href="javascript:_M('.$_value['id'].',\'?s='.$_value['m'].'/'.$_value['c'].'/'.$_value['a'].'\')" hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
}else {
echo '<li id="_M'.$_value['id'].'" class="top_menu"><a href="javascript:_M('.$_value['id'].',\'?s='.$_value['m'].'/'.$_value['c'].'/'.$_value['a'].'\')"  hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
}
}
;echo '        </ul>
    </div>
</div>
<div id="content">
	<div class="col-left left_menu">
    	<div id="Scroll"><div id="leftMain"></div></div>
        <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium;" hideFocus="hidefocus" class="open" title="';echo L('spread_or_closed');echo '"><span class="hidden">';echo L('expand');echo '</span></a>
    </div>
	<div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
	<div class="content">
        	<iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
            </div>
        </div>
    <div class="col-auto mr8">
    <div class="crumbs">
    <div class="shortcut cu-span"><a href="?s=content/create_html/public_index&h5_hash=';echo $_SESSION['h5_hash'];;echo '" target="right"><span>';echo L('create_index');echo '</span></a><a href="?s=admin/cache_all/init&h5_hash=';echo $_SESSION['h5_hash'];;echo '" target="right"><span>';echo L('update_backup');echo '</span></a><a href="javascript:art.dialog({id:\'map\',iframe:\'?s=admin/index/public_map\', title:\'';echo L('background_map');echo '\', width:\'700\', height:\'500\', lock:true});void(0);"><span>';echo L('background_map');echo '</span></a>';echo runhook('admin_top_left_menu');echo '</div>
    ';echo L('current_position');echo '<span id="current_pos"></span></div>
    	<div class="col-1">
        	<div class="content" style="position:relative; overflow:hidden">
                <iframe name="right" id="rightMain" src="?s=admin/index/public_main" frameborder="false" scrolling="auto" style="border:none; margin-bottom:30px" width="100%" height="auto" allowtransparency="true"></iframe>
                <div class="fav-nav">
					<div id="panellist">
						';foreach($adminpanel as $v) {;echo '								<span>
								<a onclick="paneladdclass(this);" target="right" href="';echo $v['url'].'menuid='.$v['menuid'].'&h5_hash='.$_SESSION['h5_hash'];;echo '">';echo L($v['name']);echo '</a>
								<a class="panel-delete" href="javascript:delete_panel(';echo $v['menuid'];echo ', this);"></a></span>
						';};echo '					</div>
					<div id="paneladd"></div>
					<input type="hidden" id="menuid" value="">
					<input type="hidden" id="bigid" value="" />
                    <div id="help" class="fav-help"></div>
				</div>
        	</div>
        </div>
    </div>
</div>
<div class="tab-web-panel hidden" style="position:absolute; z-index:999; background:#fff">
<ul>
';foreach ($sitelist as $key=>$v):;echo '	<li style="margin:0"><a href="javascript:site_select(';echo $v['siteid'];echo ', \'';echo new_addslashes($v['name']);echo '\', \'';echo $v['domain'];echo '\', \'';echo $v['siteid'];echo '\')">';echo $v['name'];echo '</a></li>
';endforeach;;echo '</ul>
</div>
<div class="scroll"><a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a><a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a></div>
<script type="text/javascript"> 
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};

var getWindowSize = function(){
return ["Height","Width"].map(function(name){
  return window["inner"+name] ||
	document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
});
}
window.onload = function (){
	if(!+"\\v1" && !document.querySelector) { // for IE6 IE7
	  document.body.onresize = resize;
	} else { 
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	//这是一字符串
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0]-150,Body = $(\'body\');$(\'#rightMain\').height(heights);   
	//iframe.height = strs[0]-46;
	if(strs[1]<980){
		$(\'.header\').css(\'width\',980+\'px\');
		$(\'#content\').css(\'width\',980+\'px\');
		Body.attr(\'scroll\',\'\');
		Body.removeClass(\'objbody\');
	}else{
		$(\'.header\').css(\'width\',\'auto\');
		$(\'#content\').css(\'width\',\'auto\');
		Body.attr(\'scroll\',\'no\');
		Body.addClass(\'objbody\');
	}
	
	var openClose = $("#rightMain").height()+39;
	$(\'#center_frame\').height(openClose+9);
	$("#openClose").height(openClose+30);	
	$("#Scroll").height(openClose-20);
	windowW();
}
wSize();
function windowW(){
	if($(\'#Scroll\').height()<$("#leftMain").height()){
		$(".scroll").show();
	}else{
		$(".scroll").hide();
	}
}
windowW();
//站点下拉菜单
$(function(){
	var offset = $(".tab_web").offset();
	var tab_web_panel = $(".tab-web-panel");
	$(".tab_web").mouseover(function(){
			tab_web_panel.css({ "left": +offset.left+4, "top": +offset.top+$(\'.tab_web\').height()+2});
			tab_web_panel.show();
			if(tab_web_panel.height() > 200){
				tab_web_panel.children("ul").addClass("tab-scroll");
			}
		});
	$(".tab_web span").mouseout(function(){hidden_site_list_1()});
	$(".tab-web-panel").mouseover(function(){clearh();$(\'.tab_web a\').addClass(\'on\')}).mouseout(function(){hidden_site_list_1();$(\'.tab_web a\').removeClass(\'on\')});
	//默认载入左侧菜单
	$("#leftMain").load("?s=admin/index/public_menu_left&menuid=10");
})
//站点选择
function site_select(id,name, domain, siteid) {
	$(".tab_web span").html(name);
	$.get("?s=admin/index/public_set_siteid&siteid="+id,function(data){
		if (data==1){
				window.top.right.location.reload();
				window.top.center_frame.location.reload();
				$.get("?s=admin/index/public_menu_left&menuid=0&parentid="+$("#bigid").val(), function(data){$(\'.top_menu\').remove();$(\'#top_menu\').prepend(data)});
			}
		});
	$(\'#site_homepage\').attr(\'href\', domain);
	$(\'#site_search\').attr(\'href\', \'index.php?s=search&siteid=\'+siteid);
}
//隐藏站点下拉。
var s = 0;
var h;
function hidden_site_list() {
	s++;
	if(s>=3) {
		$(\'.tab-web-panel\').hide();
		clearInterval(h);
		s = 0;
	}
}
function clearh(){
	if(h)clearInterval(h);
}
function hidden_site_list_1() {
	h = setInterval("hidden_site_list()", 1);
}

//左侧开关
$("#openClose").click(function(){
	if($(this).data(\'clicknum\')==1) {
		$("html").removeClass("on");
		$(".left_menu").removeClass("left_menu_on");
		$(this).removeClass("close");
		$(this).data(\'clicknum\', 0);
		$(".scroll").show();
	} else {
		$(".left_menu").addClass("left_menu_on");
		$(this).addClass("close");
		$("html").addClass("on");
		$(this).data(\'clicknum\', 1);
		$(".scroll").hide();
	}
	return false;
});

function _M(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#bigid").val(menuid);
	$("#paneladd").html(\'<a class="panel-add" href="javascript:add_panel();"><em>';echo L('add');echo '</em></a>\');
	if(menuid!=8) {
		$("#leftMain").load("?s=admin/index/public_menu_left&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	} else {
		$("#leftMain").load("?s=admin/phpsso/public_menu_left&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	}
	//$("#rightMain").attr(\'src\', targetUrl);
	$(\'.top_menu\').removeClass("on");
	$(\'#_M\'+menuid).addClass("on");
	$.get("?s=admin/index/public_current_pos&menuid="+menuid, function(data){
		$("#current_pos").html(data);
	});
	//当点击顶部菜单后，隐藏中间的框架
	$(\'#display_center_id\').css(\'display\',\'none\');
	//显示左侧菜单，当点击顶部时，展开左侧
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data(\'clicknum\', 0);
	$("#current_pos").data(\'clicknum\', 1);
}
function _MP(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#paneladd").html(\'<a class="panel-add" href="javascript:add_panel();"><em>';echo L('add');echo '</em></a>\');

	$("#rightMain").attr(\'src\', targetUrl+\'&menuid=\'+menuid+\'&h5_hash=\'+h5_hash);
	$(\'.sub_menu\').removeClass("on fb blue");
	$(\'#_MP\'+menuid).addClass("on fb blue");
	$.get("?s=admin/index/public_current_pos&menuid="+menuid, function(data){
		$("#current_pos").html(data+\'<span id="current_pos_attr"></span>\');
	});
	$("#current_pos").data(\'clicknum\', 1);
	show_help(targetUrl);
}

function show_help(targetUrl) {
	$("#help").slideUp("slow");
	var str = \'\';
	$.getJSON("http://help.house5.net/api.php?jsoncallback=?",{op:\'help\',targetUrl: targetUrl},
	function(data){
		if(data!=null) {
			$("#help").slideDown("slow");
			$.each(data, function(i,item){
				str += \'<a href="\'+item.url+\'" target="_blank">\'+item.title+\'</a>\';
			});
			
			str += \'<a class="panel-delete" href="javascript:;" onclick="$(\\\'#help\\\').slideUp(\\\'slow\\\')"></a>\';
			$(\'#help\').html(str);
		}
	});
	$("#help").data(\'time\', 1);
}
setInterval("hidden_help()", 10000);
function hidden_help() {
	var htime = $("#help").data(\'time\')+1;
	$("#help").data(\'time\', htime);
	if(htime>2) $("#help").slideUp("slow");
}
function add_panel() {
	var menuid = $("#menuid").val();
	$.ajax({
		type: "POST",
		url: "?s=admin/index/public_ajax_add_panel",
		data: "menuid=" + menuid,
		success: function(data){
			if(data) {
				$("#panellist").html(data);
			}
		}
	});
}
function delete_panel(menuid, id) {
	$.ajax({
		type: "POST",
		url: "?s=admin/index/public_ajax_delete_panel",
		data: "menuid=" + menuid,
		success: function(data){
			$("#panellist").html(data);
		}
	});
}

function paneladdclass(id) {
	$("#panellist span a[class=\'on\']").removeClass();
	$(id).addClass(\'on\')
}
setInterval("session_life()", 160000);
function session_life() {
	$.get("?s=admin/index/public_session_life");
}
function lock_screen() {
	$.get("?s=admin/index/public_lock_screen");
	$(\'#dvLockScreen\').css(\'display\',\'\');
}
function check_screenlock() {
	var lock_password = $(\'#lock_password\').val();
	if(lock_password==\'\') {
		$(\'#lock_tips\').html(\'<font color="red">';echo L('password_can_not_be_empty');;echo '</font>\');
		return false;
	}
	$.get("?s=admin/index/public_login_screenlock", { lock_password: lock_password},function(data){
		if(data==1) {
			$(\'#dvLockScreen\').css(\'display\',\'none\');
			$(\'#lock_password\').val(\'\');
			$(\'#lock_tips\').html(\'';echo L('lockscreen_status');;echo '\');
		} else if(data==3) {
			$(\'#lock_tips\').html(\'<font color="red">';echo L('wait_1_hour_lock');;echo '</font>\');
		} else {
			strings = data.split(\'|\');
			$(\'#lock_tips\').html(\'<font color="red">';echo L('password_error_lock');;echo '\'+strings[1]+\'';echo L('password_error_lock2');;echo '</font>\');
		}
	});
}
$(document).bind(\'keydown\', \'return\', function(evt){check_screenlock();return false;});

(function(){
    var addEvent = (function(){
             if (window.addEventListener) {
                return function(el, sType, fn, capture) {
                    el.addEventListener(sType, fn, (capture));
                };
            } else if (window.attachEvent) {
                return function(el, sType, fn, capture) {
                    el.attachEvent("on" + sType, fn);
                };
            } else {
                return function(){};
            }
        })(),
    Scroll = document.getElementById(\'Scroll\');
    // IE6/IE7/IE8/Opera 10+/Safari5+
    addEvent(Scroll, \'mousewheel\', function(event){
        event = window.event || event ;  
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);

    // Firefox 3.5+
    addEvent(Scroll, \'DOMMouseScroll\',  function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);
	
})();
function menuScroll(num){
	var Scroll = document.getElementById(\'Scroll\');
	if(num==1){
		Scroll.scrollTop = Scroll.scrollTop - 60;
	}else{
		Scroll.scrollTop = Scroll.scrollTop + 60;
	}
}
</script>
</body>
</html>';?>