<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<div class="content-menu ib-a blue line-x">
<a href="?s=formguide/formguide_info/init/formid/17/menuid/1546" ';if($_GET['type']==0 ||!isset($_GET['type'])) echo 'class=on';;echo '><em>团购报名</em></a><span>|</span><a href="?s=formguide/formguide_info/init/formid/17/menuid/1546/type/1" ';if($type==1 ) echo 'class=on';;echo '><em>看房团</em></a><span>|</span><a href="javascript:;" onclick="javascript:$(\'#searchid\').css(\'display\',\'\');"><em>';echo L('search');;echo '</em></a><span>|</span><a href="javascript:call();void(0);">调用代码</a> 
</div>
<div id="searchid" style="display:';if(!isset($_GET['search'])) echo 'none';;echo '">
<form name="searchform" action="" method="get" >
<input type="hidden" value="formguide/formguide_info/init" name="s">
<input type="hidden" value="';echo $formid;;echo '" name="formid">
<input type="hidden" value="';echo $type;;echo '" name="type">
<input type="hidden" value="';echo $h5_hash;;echo '" name="h5_hash">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
				<select name="searchtype">
					<option value=\'0\' ';if($_GET['searchtype']==0) echo 'selected';;echo '>楼盘名</option>
					<option value=\'1\' ';if($_GET['searchtype']==1) echo 'selected';;echo '>电话</option>
					<option value=\'2\' ';if($_GET['searchtype']==2) echo 'selected';;echo '>姓名</option>
				</select>
				
				<input name="keyword" type="text" value="';if(isset($keyword)) echo $keyword;;echo '" class="input-text" />
				<input type="submit" name="search" class="button" value="';echo L('search');;echo '" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<form name="myform" action="?s=formguide/formguide_info/delete" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'did[]\');"></th>
			<th width=\'250\' align="center">姓名</th>
			<th width=\'250\' align="center">电话</th>
			<th width=\'250\' align="center">楼盘/线路</th>
			<th width=\'250\' align="center">';echo L('times');echo '</th>
			<th width="250" align="center">';echo L('operation');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($datas)){
foreach($datas as $d){
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="did[]" value="';echo $d['dataid'];echo '">
	</td>
	<td align="center">';echo $d['name'];echo ' </td>
	<td align="center">';echo $d['tel'];echo '</td>
	';if($type==1 ){
if($d['relatedid'])
{
;echo '	<td align="center"><a href="';echo TUAN_PATH.'route_'.$d['relatedid'].'.html';echo '" target="_blank">';echo $d['relatedid'];echo '</a></td>
	';}else{;echo '	<td align="center">';echo $d['fromurl'];echo '</td>
	';};echo '	';}else{;echo '	<td align="center"><a href="';echo HOUSE_PATH.$d['relation'];echo '" target="_blank">';echo $d['subject'];echo '</a></td>
	';};echo '	<td align="center">';echo date('Y-m-d',$d['datetime']);echo '</td>
	<td align="center"><a href="javascript:check(\'';echo $formid;echo '\', \'';echo $d['dataid'];echo '\', \'';echo safe_replace($d['username']);echo '\');void(0);">';echo L('check');echo '</a> | <a href="?s=formguide/formguide_info/public_delete/formid/';echo $formid;echo '/did/';echo $d['dataid'];echo '" onClick="return confirm(\'';echo L('confirm',array('message'=>L('delete')));echo '\')">';echo L('del');echo '</a></td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
		<input name="submit" type="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="document.myform.action=\'?s=formguide/formguide_info/public_delete/formid/';echo $formid;echo '\';return confirm(\'';echo L('affirm_delete');echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $pages;;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function check(id, did, title) {
	window.top.art.dialog({id:\'check\'}).close();
	window.top.art.dialog({title:\'';echo L('check');echo '--\'+title+\'';echo L('submit_info');echo '\', id:\'edit\', iframe:\'?s=formguide/formguide_info/public_view/formid/\'+id+\'/did/\'+did ,width:\'700px\',height:\'500px\'}, function(){window.top.art.dialog({id:\'check\'}).close()});
}
function call(id) {
		window.top.art.dialog({id:\'call\'}).close();
		window.top.art.dialog({title:\'调用代码\', id:\'call\', iframe:\'?s=formguide/formguide_info/public_call\', width:\'600px\', height:\'470px\'}, function(){window.top.art.dialog({id:\'call\'}).close();}, function(){window.top.art.dialog({id:\'call\'}).close();})
	}
</script>';?>