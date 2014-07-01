<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="bk10"></div>
<link rel="stylesheet" href="';echo CSS_PATH;;echo 'jquery.treeview.css" type="text/css" />
<script type="text/javascript" src="';echo JS_PATH;;echo 'jquery.cookie.js"></script>
<script type="text/javascript" src="';echo JS_PATH;;echo 'jquery.treeview.js"></script>
';if($ajax_show) {;echo '<script type="text/javascript" src="';echo JS_PATH;;echo 'jquery.treeview.async.js"></script>
';};echo '<SCRIPT LANGUAGE="JavaScript">
<!--
';if($ajax_show) {;echo '$(document).ready(function(){
    $("#category_tree").treeview({
			control: "#treecontrol",
			url: "index.php?s=content/content/public_sub_categorys/menuid/';echo $_GET['menuid'];echo '",
			ajax: {
				data: {
					"additional": function() {
						return "time: " + new Date;
					},
					"modelid": function() {
						return "';echo $modelid;echo '";
					}
				},
				type: "post"
			}
	});
});
';}else {;echo '$(document).ready(function(){
    $("#category_tree").treeview({
			control: "#treecontrol",
			persist: "cookie",
			cookieId: "treeview-black"
	});
});
';};echo 'function open_list(obj) {

	window.top.$("#current_pos_attr").html($(obj).html());
}

//-->
</SCRIPT>
 <style type="text/css">
.filetree *{white-space:nowrap;}
.filetree span.folder, .filetree span.file{display:auto;padding:1px 0 1px 16px;}
 </style>
 <div id="treecontrol">
 <span style="display:none">
		<a href="#"></a>
		<a href="#"></a>
		</span>
		<a href="#"><img src="';echo IMG_PATH;;echo 'minus.gif" /> <img src="';echo IMG_PATH;;echo 'application_side_expand.png" /> Õ¹¿ª/ÊÕËõ</a>
</div>
';
if($_GET['from']=='block') {
;echo '<ul class="filetree  treeview"><li class="collapsable"><div class="hitarea collapsable-hitarea"></div><span><img src="';echo IMG_PATH.'icon/home.png';;echo '" width="15" height="14">&nbsp;<a href=\'?s=block/block_admin/public_visualization/type/index\' target=\'right\'>';echo L('block_site_index');;echo '</a></span></li></ul>
';}else {;echo '<ul class="filetree  treeview"><li class="collapsable"><div class="hitarea collapsable-hitarea"></div><span><img src="';echo IMG_PATH.'icon/box-exclaim.gif';;echo '" width="15" height="14">&nbsp;<a href=\'?s=content/content/public_checkall/menuid/822\' target=\'right\'>';echo L('checkall_content');;echo '</a></span></li></ul>
';}echo $categorys;?>