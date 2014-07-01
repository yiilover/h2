<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad-lr-10">
<form name="downform" action="?s=admin/downservers/init" method="post" >
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('downserver_name');echo '  <input type="text" value="';echo $sitename;echo '" class="input-text" name="info[sitename]">    ';echo L('downserver_url');echo '   <input type="text" value="';echo $siteurl;echo '" class="input-text" name="info[siteurl]" size="50">  ';echo L('downserver_site');;echo ' ';echo form::select($sitelist,self::get_siteid(),'name="info[siteid]"',$default);echo ' <input type="submit" value="';echo L('add');;echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" action="?s=admin/downservers/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left">';echo L('listorder');;echo '</th>
            <th width="10%"  align="left">ID</th>
            <th width="20%">';echo L('downserver_name');echo '</th>
            <th width="35%">';echo L('downserver_url');echo '</th>
            <th width="15%">';echo L('downserver_site');echo '</th>
            <th width="15%">';echo L('posid_operation');;echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td width="10%">
	<input name=\'listorders[';echo $info['id'];echo ']\' type=\'text\' size=\'2\' value=\'';echo $info['listorder'];echo '\' class="input-text-c">
	</td>	
	<td width="10%">';echo $info['id'];echo '</td>
	<td  width="20%" align="center">';echo $info['sitename'];echo '</td>
	<td width="35%" align="center">';echo $info['siteurl'];echo '</td>
	<td width="15%" align="center">';echo $info['siteid'] ?$sitelist[$info['siteid']] : L('all_site');echo '</td>
	<td width="15%" align="center">
	<a href="javascript:edit(';echo $info['id'];echo ', \'';echo new_addslashes($info['sitename']);echo '\')">';echo L('edit');echo '</a> | 
	<a href="javascript:confirmurl(\'?s=admin/downservers/delete&id=';echo $info['id'];echo '\', \'';echo L('downserver_del_cofirm');echo '\')">';echo L('delete');echo '</a>
	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
    <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
</form>
 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>

</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
<!--
	function edit(id, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=admin/downservers/edit&id=\'+id ,width:\'520px\',height:\'150px\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>