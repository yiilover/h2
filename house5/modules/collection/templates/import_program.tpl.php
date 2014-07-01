<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<fieldset>
	<legend>';echo L('the_new_publication_solutions');echo '</legend>
	<form name="myform" action="?" method="get" id="myform">
	
		<table width="100%" class="table_form">
			<tr>
			<td width="120">';echo L('category');echo '£º</td> 
			<td>
			';echo form::select_category('','','name="catid"',L('please_choose'),0,0,1);echo '			</td>
		</tr>
	</table>
	<input type="hidden" name="s" value="collection/node/import_program_add">
	<input type="hidden" name="nodeid" value="';if(isset($nodeid)) echo $nodeid;echo '">
	<input type="hidden" name="type" value="';echo $type;echo '">
	<input type="hidden" name="ids" value="';echo $ids;echo '">
	<input type="submit" id="dosubmit"  class="button" value="';echo L('submit');echo '">
	</form>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('publish_the_list');echo '</legend>
<form name="myform" action="?" method="get" >
<div class="bk15"></div>
';
foreach($program_list as $k=>$v) {
echo form::radio(array($v['id']=>$cat[$v['catid']]['catname']),'','name="programid"',150);
;echo '<span style="margin-right:10px;"><a href="?s=collection/node/import_program_del/id/';echo $v['id'];echo '" style="color:#ccc">';echo L('delete');echo '</a></span>
';
}
;echo '</fieldset>
	<input type="hidden" name="s" value="collection/node/import_content">
	<input type="hidden" name="nodeid" value="';if(isset($nodeid)) echo $nodeid;echo '">
	<input type="hidden" name="type" value="';echo $type;echo '">
	<input type="hidden" name="ids" value="';echo $ids;echo '">
<div class="btn">
<label for="check_box"><input type="submit" class="button" name="dosubmit" value="';echo L('submit');echo '"/>
</div>

</div>
</form>
</div>
<script type="text/javascript">
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>
</body>
</html>';?>