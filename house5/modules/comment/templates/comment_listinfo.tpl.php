<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad_10">
<div id="searchid">
<form name="searchform" action="" method="get" >
<input type="hidden" value="comment/comment_admin/listinfo" name="s">
<input type="hidden" value="1" name="search">
<input type="hidden" value="';echo $_SESSION['h5_hash'];echo '" name="h5_hash">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">	
			';if($max_table >1) {;echo '			';echo L('choose_database');echo '£º<select name="tableid" onchange="show_tbl(this)">';for($i=1;$i<=$max_table;$i++) {;echo '<option value="';echo $i;echo '" ';if($i==$tableid){;echo 'selected';};echo '>';echo $this->comment_data_db->db_tablepre;echo 'comment_data_';echo $i;echo '</option>';};echo '</select>
			';};echo '			<select name="searchtype">
				<option value=\'0\' ';if($_GET['searchtype']==0) echo 'selected';;echo '>';echo L('original').L('title');;echo '</option>
				<option value=\'1\' ';if($_GET['searchtype']==1) echo 'selected';;echo '>';echo L('original');;echo 'ID</option>
				<option value=\'2\' ';if($_GET['searchtype']==2) echo 'selected';;echo '>';echo L('username');;echo '</option>
			</select>
			<input name="keyword" type="text" value="';if(isset($keywords)) echo $keywords;;echo '" class="input-text" />
			<input type="submit" name="search" class="button" value="';echo L('search');;echo '" />
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>
</div>
<div class="pad-lr-10">
<form name="myform" id="myform" action="" method="get" >
<input type="hidden" value="comment/comment_admin/del" name="s">
<input type="hidden" value="';echo $tableid;echo '" name="tableid">
<input type="hidden" value="1" name="dosubmit">
<div class="table-list comment">
    <table width="100%">
        <thead>
            <tr>
			 <th width="16"><input type="checkbox" value="" id="check_box" onclick="selectall(\'ids[]\');"></th>
			<th width="130">';echo L('author');echo '</th>
			<th>';echo L('comment');echo '</th>
			<th width="230">';echo L('original').L('title');;echo '</th>
			<th width="72">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
		<tbody class="add_comment">
    ';
if(is_array($data)) {
foreach($data as $v) {
$comment_info = $this->comment_db->get_one(array('commentid'=>$v['commentid']));
if (strpos($v['content'],'<div class="content">') !==false) {
$pos = strrpos($v['content'],'</div>');
$v['content'] = substr($v['content'],$pos+6);
}
;echo '     <tr id="tbody_';echo $v['id'];echo '">
		<td align="center" width="16"><input class="inputcheckbox " name="ids[]" value="';echo $v['id'];;echo '" type="checkbox"></td> 
		<td width="130">';echo $v['username'];echo '<br />';echo $v['ip'];echo '</td>
		<td><font color="#888888">';echo L('chez');echo ' ';echo format::date($v['creat_at'],1);echo ' ';echo L('release');echo '</font><br />';echo $v['content'];echo '</td>
		<td width="230"><a href="?s=comment/comment_admin/listinfo/search/1/searchtype/0/keyword/';echo urlencode($comment_info['title']);echo '/h5_hash/';echo $_SESSION['h5_hash'];echo '/tableid/';echo $tableid;echo '">';echo $comment_info['title'];echo '</td>
		<td align=\'center\' width="72"><a href="?s=comment/comment_admin/del/ids/';echo $v['id'];echo '/tableid/';echo $tableid;echo '/dosubmit/1" onclick="return check(';echo $v['id'];echo ', -1, \'';echo $v['commentid'];echo '\')">';echo L('delete');;echo '</a> </td>
	</tr>
     ';}
}
;echo '	</tbody>
     </table>
    <div class="btn"><label for="check_box">';echo L('selected_all');;echo '/';echo L('cancel');;echo '</label>
		<input type="hidden" value="';echo $_SESSION['h5_hash'];;echo '" name="h5_hash">
		<input type="submit" class="button" value="';echo L('delete');;echo '" />
	</div>
    <div id="pages">';echo $pages;;echo '</div>
</div>
</form>
</div>
<script type="text/javascript">
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function check(id, type, commentid) {
	if(type == -1 && !confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')) {
		return false;
	}
	return true;
}
function show_tbl(obj) {
	var pdoname = $(obj).val();
	location.href=\'?s=comment/comment_admin/listinfo/tableid/\'+pdoname+\'/h5_hash/';echo $_SESSION['h5_hash'];echo '\';
}
function confirm_delete(){
	if(confirm(\'';echo L('confirm_delete',array('message'=>L('selected')));;echo '\')) $(\'#myform\').submit();
}
</script>
</body>
</html>';?>