<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<link href="';echo CSS_PATH;echo 'dianping.css" rel="stylesheet" type="text/css" />

<div class="pad-lr-10">
';include HOUSE5_PATH.'star_config.php';;echo '<form name="form" action="?s=dianping/dianping/dianping_data&menuid=';echo $_GET['menuid'];;echo '" method="get" >
<input type="hidden" value="dianping/dianping/dianping_data" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('module');echo ': ';echo form::select($module_arr,'','name="search[module]"',$default);echo ' ';echo L('username');echo '  <input type="text" value="" class="input-text" name="search[username]" size=\'10\'>  ';echo L('times');echo '  ';echo form::date('search[start_time]','','1');echo ' ';echo L('to');echo '   ';echo form::date('search[end_time]','','1');echo '    <input type="submit" value="';echo L('determine_search');echo '" class="button" name="dosubmit"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
 
 
 <table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">按类型查看: 
		
		&nbsp;&nbsp;<a href="';echo APP_PATH;;echo 'index.php?s=dianping/dianping/dianping_data&menuid=';echo $_GET['menuid'];echo '"><font color=red>全部</a></a>	
	';
if(is_array($dianping_type_array)){
foreach($dianping_type_array as $type=>$type_array){
;echo '	&nbsp;&nbsp;
<a href="';echo APP_PATH;;echo 'index.php?s=dianping/dianping/dianping_data&menuid=';echo $_GET['menuid'];;echo '&h5_hash=G6Ihra&typeid=';echo $type;;echo '">';echo $type_array['type_name'];;echo '</a>	
	';}};echo '		</div>
		</td>
		</tr>
    </tbody>
</table>


 <form action="?" method="get">
 <input type="hidden" name="s" value="reviews/check/ajax_checks">
    <input type="hidden" name="type" value="-1">
    <input type="hidden" name="reviewsid" value="">
<div class="comment">
';if(is_array($infos)) foreach($infos as $v) :
;echo '<div  id="tbody_';echo $v['id'];echo '">
<h5 class="title fn" ><span class="rt">';if( $v['status'] == 0) {;echo '<input type="button" value="';echo L('pass');echo '" class="button" onclick="check(';echo $v['id'];echo ', 1, ';echo $v['dianpingid'];;echo ')" /> ';};echo '<input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(';echo $v['id'];echo ', -1, \'';echo $v['dianpingid'];echo '\')" />
</span>';echo $v['username'];echo ' (127.0.0.1) 于 ';echo format::date($v['addtime'],1);echo ' </h5>
';if (!empty($v['content'])) {;echo '    <div class="content">
    	<pre>';echo $v['content'];echo '</pre>
    </div>
';};echo '        ';
$star_type = $v['startype'];
$star_li = explode('|',$star_config[$star_type]['star_name']);
$star_img = explode('|',$star_config[$star_type]['star_images']);
$star_n = 0;
;echo '    <div id="star_show">
 		';
$data = string2array($v['data']);
foreach ($data as $name=>$val){
;echo '	 		<b>';echo $name;;echo '：</b>
	 		';if($name=='平均得分'){;echo '	 			<dl class="lite-rate ib"><dd style="width:';echo $val;;echo '%"></dd></dl>
	 		';}else{;echo '		 		';for($n=1;$n<=$val;$n++){;echo '		 		<img alt="分" src="';echo APP_PATH;;echo '/statics/images/star2.gif">
		 		';};echo ' 
		 		';for($k=1;$k<=(5-$val);$k++){;echo '		 		<img alt="分" src="';echo APP_PATH;;echo '/statics/images/star1.gif">
		 		';};echo '  
	 		';};echo '		';};echo '    </div>
    <div class="bk20 hr mb8"></div>
</div>
';endforeach;;echo '</div>
 </form>
<div id="pages">';echo $pages;;echo '</div>
</div>
<script type="text/javascript">
';if(!isset($_GET['show_center_id'])) {;echo ' window.top.$(\'#display_center_id\').css(\'display\',\'none\');';};echo 'function check(id, type, dianpingid) {
	if(type == -1 && !confirm(\'确定要删除吗？\')) {
		return false;
	}
	$.get(\'?s=dianping/dianping/ajax_checks&id=\'+id+\'&type=\'+type+\'&dianpingid=\'+dianpingid+\'&\'+Math.random()+\'&h5_hash=';echo $_SESSION['h5_hash'];;echo '\', function(data){if(data!=1){if(data==0){alert(\'';echo L('illegal_parameters');echo '\')}else{alert(data)}}else{$(\'#tbody_\'+id).remove();}});
}
</script>
</body>
</html>';?>