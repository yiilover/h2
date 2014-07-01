<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="subnav">
  <h1 class="title-2 line-x">';echo $this->style_info['name'].' - '.L('detail');echo '</h1>
</div>
<div class="pad-lr-10">
<div class="table-list">
<form action="?s=template/file/updatefilename&style=';echo $this->style;echo '" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th align="left" >';echo L("dir");echo '</th>
		<th align="left" >';echo L('desc');echo '</th>
		<th align="left" >';echo L('operation');echo '</th>
		</tr>
        </thead>
<tbody>
<tr>
<td align="left" colspan="3">';echo L("local_dir");echo '£º';echo $local;echo '</td>
</tr>
';if ($dir !=''&&$dir != '.'):;echo '<tr>
<td align="left" colspan="3"><a href="';echo '?s=template/file/init&style='.$this->style.'&dir='.stripslashes(dirname($dir));echo '"><img src="';echo IMG_PATH;echo 'folder-closed.gif" />';echo L("parent_directory");echo '</a></td>
</tr>
';endif;;echo '';
if(is_array($list)):
foreach($list as $v):
$filename = basename($v);
;echo '<tr>
';if (is_dir($v)) {
echo '<td align="left"><img src="'.IMG_PATH.'folder-closed.gif" /> <a href="?s=template/file/init&style='.$this->style.'&dir='.(isset($_GET['dir']) &&!empty($_GET['dir']) ?stripslashes($_GET['dir']).DIRECTORY_SEPARATOR : '').$filename.'"><b>'.$filename.'</b></a></td><td align="left"><input type="text" name="file_explan['.$encode_local.']['.$filename.']" value="'.(isset($file_explan[$encode_local][$filename]) ?$file_explan[$encode_local][$filename] : "").'"></td><td></td>';
}else {
if (substr($filename,-4,4) == 'html') {
echo '<td align="left"><img src="'.IMG_PATH.'file.gif" /> '.$filename.'</td><td align="left"><input type="text" name="file_explan['.$encode_local.']['.$filename.']" value="'.(isset($file_explan[$encode_local][$filename]) ?$file_explan[$encode_local][$filename] : "").'"></td>';
if($tpl_edit=='1'){
echo '<td> <a href="?s=template/file/edit_file&style='.$this->style.'&dir='.urlencode(stripslashes($dir)).'&file='.$filename.'">['.L('edit').']</a> <a href="?s=template/file/visualization&style='.$this->style.'&dir='.urlencode(stripslashes($dir)).'&file='.$filename.'" target="_blank">['.L('visualization').']</a> <a href="javascript:history_file(\''.$filename.'\')">['.L('histroy').']</a></td>';
}else{
echo '<td></td>';
}
}
};echo '</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
<div class="btn"><input type="button" onclick="location.href=\'?s=template/style/init&h5_hash=';echo $_SESSION['h5_hash'];;echo '\'" class="button" name="dosubmit" value="';echo L('returns_list_style');echo '" /> <input type="button" class="button" name="dosubmit" value="';echo L('new');echo '" onclick="add_file()" /> <input type="submit" class="button" name="dosubmit" value="';echo L('update');echo '" ></div> 
</form>
</div>
<div id="pages">';echo $pages;echo '</div>
</div>
<script type="text/javascript">
<!--

function history_file(name) {
	window.top.art.dialog({title:\'¡¶\'+name+\'¡·';echo L("histroy");echo '\',id:\'history\',iframe:\'?s=template/template_bak/init&style=';echo $this->style;;echo '&dir=';echo urlencode(stripslashes($dir));echo '&filename=\'+name,width:\'700\',height:\'521\'}, function(){var d = window.top.art.dialog({id:\'history\'}).close();return false;}, function(){window.top.art.dialog({id:\'history\'}).close()});
}

function add_file() {
	window.top.art.dialog({title:\'';echo L("new");echo '\',id:\'add_file\',iframe:\'?s=template/file/add_file&style=';echo $this->style;;echo '&dir=';echo urlencode(stripslashes($dir));echo '\',width:\'500\',height:\'100\'}, function(){var d = window.top.art.dialog({id:\'add_file\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'add_file\'}).close()});
}
//-->
</script>
</body>
</html>';?>