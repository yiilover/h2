<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<div class="col-tab">
        <ul class="tabBut cu-li">
            <li class="on"><a href="?s=vote/vote/statistics_userlist&subjectid=';echo $subjectid;;echo '">';echo L('user_list');echo '</a></li>
            <li><a href="?s=vote/vote/statistics&subjectid=';echo $subjectid;;echo '">';echo L('vote_result');echo '</a></li>
        </ul>
            <div class="content pad-10" style="height:auto">
<form name="myform" action="?s=vote/vote/delete_statistics" method="post">
<div class="table-list">

<br>	
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>';echo L('username');echo '</th>
			<th width="155" align="center">';echo L('up_vote_time');echo '</th>
			<th width="14%" align="center">';echo L('ip');echo '</th>
 		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td>';if($info['username']=="")echo L('guest');else echo $info['username'];echo '</td>
		<td align="center" width="155">';echo date("Y-m-d h-i",$info['time']);;echo '</td>
		<td align="center" width="14%">';echo $info['ip'];;echo '</td>
 		</tr>
	';
}
}
;echo '</tbody>
</table>
<div id="pages">';echo $pages;echo '</div>
</form>
</div>
</div>
</div>
</body>
</html>

<script type="text/javascript">
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=vote/vote/edit&subjectid=\'+id,width:\'700\',height:\'450\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
</script>
';?>