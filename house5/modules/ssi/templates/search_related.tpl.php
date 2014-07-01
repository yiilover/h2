<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<form action="?" method="get">
<input type="hidden" name="m" value="block">
<input type="hidden" name="c" value="block_admin">
<input type="hidden" name="a" value="public_search_related">
<input type="hidden" name="contentid"  value="';echo $_GET['contentid'];;echo '">

<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('category');echo ':</td> 
			<td>';if(isset($_GET['dosubmit'])){;echo '<div class="rt"><a href="javascript:void(0)" onclick="$(\'#search\').toggle()">';echo L('folded_up_in_search_of');echo '</a></div>';}echo form::select_category('',$catid,'name="catid" id="catid"','','','0',1);echo ' </td>
		</tr>
		<tbody id="search" ';if(isset($_GET['dosubmit'])) echo 'style="display:none"';;echo '>
		<tr>
			<td>';echo L('posterize_time');echo ':</td> 
			<td>';echo form::date('start_time',$start_time ?date('Y-m-d',$start_time) : '');echo ' - ';echo form::date('end_time',$end_time ?date('Y-m-d',$end_time) : '');echo '</td>
		</tr>
		<tr>
			<td>';echo L('recommend');echo '£º</td> 
			<td>
			';echo form::select(array(''=>L('all'),'1'=>L('recommend'),'2'=>L('not_recommend')),$posids,'name="posids"');echo '			</td>
		</tr>
		<tr>
			<td>';echo L('search_mode');echo '£º</td>
			<td>
			';echo form::select(array('1'=>L('title'),'2'=>L('desc'),'3'=>L('username'),'4'=>'ID'),$searchtype,'name="searchtype"');echo '			</td>
		</tr>
		<tr>
			<td>';echo L('key_word');echo '£º</td>
			<td>
			<input name="keyword" type="text" value="';echo $keyword;echo '" class="input-text" />
</td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button" />
</td>
		</tr>
		</tbody>
	</table>
	</form>
';if (isset($_GET['dosubmit']) &&!empty($data)) :;echo '	
	<div class="table-list">
	<div class="btn"><input type="checkbox" value="" id="check_box" onclick="selectall(\'ids[]\');"> <input type="button" value="';echo L('insert_a_comment_about_the_selected_text');echo '" class="button" onclick="insert_form()"></div>
<table width="100%">
<tbody>
';foreach ($data as $v):;echo '<tr>
<td align="center" width="40"><input class="inputcheckbox " name="ids[]" value="{title:\'';echo str_replace('\'','\\\'',$v['title']);echo '\', thumb:\'';echo $v['thumb'];echo '\', desc:\'';echo str_replace(array('\'',"\r","\n"),array('\\\'',"",""),$v['description']);echo '\', url:\'';echo $v['url'];echo '\'}" type="checkbox"></td>
<td>';echo $v['title'];echo ' ';if ($v['thumb']) echo '<font color="red">['.L('pic').']</font>';echo '</td>
</tr>
';endforeach;;echo '</tbody>
</table>
<div class="btn"><label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="button" value="';echo L('insert_a_comment_about_the_selected_text');echo '" class="button" onclick="insert_form()"></div>
<dir id="pages">';echo $pages;echo '</dir>
	</div>
	
';endif;;echo '	
	</div>
<script type="text/javascript">
<!--
	function insert_form() {
	$("input[type=\'checkbox\'][name=\'ids[]\']:checked").each(function(i,n){parent.insert_forms_related(';echo $_GET['contentid'];;echo ',$(n).val());});
	parent.art.dialog({id:\'search_related\'}).close();
}
//-->
</script>
</body>
</html>';?>