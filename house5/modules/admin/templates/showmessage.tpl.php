<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo CHARSET;echo '" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>';echo L('message_tips');;echo '</title>
<style>
body {
    background: none repeat scroll 0 0 #F3F3F3;
    color: #333333;
    font-family: Arial;
    font-size: 12px;
    line-height: 1.5;
    overflow-x: hidden;
    overflow-y: auto;
}
html, body, div, dl, dt, dd, ul, p, th, td, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend {
    margin: 0;
    padding: 0;
}
.wrap{ padding: 20px 20px 70px;}
li {
    list-style: none outside none;
}
td, th, div {
    word-break: break-all;
    word-wrap: break-word;}
.user_group dt, #error_tips h2, .task_item_list .hd, .medal_term .ct h6, .app_info .hd, .app_present .hd, .app_updata .hd, .sql_list dt {
    background: linear-gradient(#FFFFFF, #FFFFFF 25%, #F4F4F4) no-repeat scroll 0 0 #F9F9F9;
    border-bottom: 1px solid #DFDFDF;
}
#error_tips{
	border:1px solid #d4d4d4;
	background:#fff;
	-webkit-box-shadow: #ccc 0 1px 5px;
	-moz-box-shadow: #ccc 0 1px 5px;
	-o-box-shadow:#ccc 0 1px 5px;
	box-shadow: #ccc 0 1px 5px;
	filter: progid: DXImageTransform.Microsoft.Shadow(Strength=3, Direction=180, Color=\'#ccc\');
	width:500px;
	margin:50px auto;
}
#error_tips h2{
	font:bold 14px/40px Arial;
	height:40px;
	padding:0 20px;
	color:#666;
	
}
.error_cont{
	padding:20px 20px 30px 80px;
	background:url(statics/images/admin_img/light.png) 20px 20px no-repeat;
	line-height:1.8;
}
.error_return{
	padding:10px 0 0 0;
}
.btn {
    background: url(statics/images/admin_img/btn.png) repeat scroll 0 0 #E6E6E6;
    border: 1px solid #C4C4C4;
    border-radius: 2px 2px 2px 2px;
    color: #333333;
    cursor: pointer;
    display: inline-block;
    font-family: inherit;
    font-size: 100%;
    line-height: normal;
    margin: 0;
    overflow: visible;
    padding: 4px 10px;
    text-align: center;
    text-decoration: none;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
    white-space: nowrap;
}
.btn_submit{    background-color: #1B75B6;
    background-position: 0 -120px;
    border-color: #106BAB #106BAB #0D68A9;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);}
</style>
<script type="text/javaScript" src="';echo JS_PATH;echo 'jquery.min.js"></script>
<script language="JavaScript" src="';echo JS_PATH;echo 'admin_common.js"></script>
</head>
<body>
<div class="wrap">
	<div id="error_tips">
		<h2>信息提示</h2>
    <div class="error_cont">
			<ul>
								<li>';echo $msg;echo '</li>
								</ul>
   <div class="error_return">
    ';if($url_forward=='goback'||$url_forward=='') {;echo '	<a href="javascript:history.back();" >[';echo L('return_previous');;echo ']</a>
	';}elseif($url_forward=="close") {;echo '	<input type="button" name="close" value="';echo L('close');;echo ' " onClick="window.close();">
	';}elseif($url_forward=="blank") {;echo '	
	';}elseif($url_forward) {
if(strpos($url_forward,'h5_hash')===false) $url_forward .= '/h5_hash/'.$_SESSION['h5_hash'];
;echo '	<a href="';echo $url_forward;echo '">';echo L('click_here');;echo '</a>
	<script language="javascript">setTimeout("redirect(\'';echo $url_forward;echo '\');",';echo $ms;echo ');</script> 
	';};echo '	';if($returnjs) {;echo ' <script style="text/javascript">';echo $returnjs;;echo '</script>';};echo '	';if ($dialog):;echo '<script style="text/javascript">window.top.right.location.reload();window.top.art.dialog({id:"';echo $dialog;echo '"}).close();</script>';endif;;echo '        </div>
					</div>
	</div>
</div>
<script style="text/javascript">
	function close_dialog() {
		window.top.right.location.reload();window.top.art.dialog({id:"';echo $dialog;echo '"}).close();
	}
</script>

</body>
</html>';?>