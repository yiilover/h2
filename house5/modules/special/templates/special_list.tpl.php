<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" action="?s=special/special/listorder" method="post">
    <table width="100%" cellspacing="0" class="table-list nHover">
        <thead>
            <tr>
            <th width="40"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
			<th width="40" align="center">ID</th>
			<th width="80" align="center">';echo L('listorder');echo '</th>
			<th >';echo L('special_info');echo '</th>
			<th width="160">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
        <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td align="center" width="40"><input class="inputcheckbox" name="id[]" value="';echo $info['id'];;echo '" type="checkbox"></td>
	<td width="40" align="center">';echo $info['id'];echo '</td>
	<td width="80" align="center"><input type=\'text\' name=\'listorder[';echo $info['id'];echo ']\' value="';echo $info['listorder'];echo '" class="input-text-c" size="4"></td>
	<td>
    <div class="col-left mr10" style="width:146px; height:112px">
<a href="';echo $info['url'];echo '" target="_blank"><img src="';echo $info['thumb'];echo '" width="146" height="112" style="border:1px solid #eee" align="left"></a>
</div>
<div class="col-auto">  
    <h2 class="title-1 f14 lh28 mb6 blue"><a href="';echo $info['url'];echo '" target="_blank">';echo $info['title'];echo '</a></h2>
    <div class="lh22">';echo $info['description'];echo '</div>
<p class="gray4">';echo L('create_man');echo '：<a href="#" class="blue">';echo $info['username'];echo '</a>， ';echo L('create_time');echo '：';echo format::date($info['createtime'],1);echo '</p>
</div>
	</td>
	<td align="center"><span style="height:22"><a href=\'?s=special/content/init&specialid=';echo $info['id'];echo '\' onclick="javascript:openwinx(\'?s=special/content/add&specialid=';echo $info['id'];echo '&h5_hash=';echo $_SESSION['h5_hash'];echo '\',\'\')">';echo L('add_news');echo '</a></span> | 
<span style="height:22"><a href=\'javascript:import_c(';echo $info['id'];echo ');void(0);\'>';echo L('import_news');echo '</a></span><br />
<span style="height:22"><a href=\'?s=special/content/init&specialid=';echo $info['id'];echo '\'>';echo L('manage_news');echo '</a></span> | 
<span style="height:22"><a href=\'?s=special/template&specialid=';echo $info['id'];echo '\' style="color:red" target="_blank">';echo L('template_manage');echo '</a></span><br/>
<span style="height:22"><a href=\'?s=special/special/elite&value=';if($info['elite']==0) {;echo '1';}elseif($info['elite']==1) {;echo '0';};echo '&id=';echo $info['id'];echo '\'>';if($info['elite']==0) {echo L('elite_special');}else {;echo '<font color="red">';echo L('remove_elite');echo '</font>';};echo '</a></span> | 
<span style="height:22"><a href="javascript:comment(\'';echo id_encode('special',$info['id'],$this->get_siteid());echo '\', \'';echo addslashes(htmlspecialchars($info['title']));echo '\');void(0);">';echo L('special_comment');echo '</a></span><br/>
<span style="height:22"><a href="?s=special/special/edit&specialid=';echo $info['id'];echo '&menuid=';echo $_GET['menuid'];echo '">';echo L('edit_special');echo '</a></span> | 
<span style="height:22"><a href="?s=special/special/delete&id=';echo $info['id'];echo '" onclick="return confirm(\'';echo L('confirm',array('message'=>addslashes(htmlspecialchars($info['title']))));echo '\')">';echo L('del_special');echo '</a></span></td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
        <input name=\'dosubmit\' type=\'submit\' class="button" value=\'';echo L('listorder');echo '\'>&nbsp;
        <input type="submit" class="button" value="';echo L('delete');echo '" onclick="if(confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')){document.myform.action=\'?s=special/special/delete\';}else{return false;}"/>
        &nbsp;<input type="submit" class="button" value="';echo L('update');echo 'html" onclick="document.myform.action=\'?s=special/special/html\'"/></div>
 <div id="pages">';echo $this->db->pages;;echo '</div><script>window.top.$("#display_center_id").css("display","none");</script>
</form>
</div>
</body>
</html>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_special');echo '--\'+name, id:\'edit\', iframe:\'?s=special/special/edit&specialid=\'+id ,width:\'700px\',height:\'500px\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function comment(id, name) {
	window.top.art.dialog({id:\'comment\'}).close();
	window.top.art.dialog({title:\'';echo L('see_comment');echo '：\'+name, id:\'comment\', iframe:\'?s=comment/comment_admin/lists&show_center_id=1&commentid=\'+id ,width:\'700px\',height:\'500px\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function import_c(id) {
	window.top.art.dialog({id:\'import\'}).close();
	window.top.art.dialog({title:\'';echo L('import_news');echo '--\', id:\'import\', iframe:\'?s=special/special/import&specialid=\'+id ,width:\'700px\',height:\'500px\'}, function(){var d = window.top.art.dialog({id:\'import\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'import\'}).close()});
}

</script>';?>