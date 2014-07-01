<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li><a href="?s=vote/vote/statistics_userlist&subjectid=';echo $subjectid;;echo '">';echo L('user_list');echo '</a></li>
<li class="on"><a href="?s=vote/vote/statistics&subjectid=';echo $subjectid;;echo '">';echo L('vote_result');echo '</a></li>
</ul>
<div class="content pad-10" style="height:auto">
<form name="myform" action="?s=vote/vote/delete_statistics" method="post">

<table width="100%" cellspacing="0" class="table-list">
	<thead>
		<tr>
			<th>';echo L('vote_option');echo '</th>
			<th width="10%" align="center">';echo L('vote_num');echo '</th>
			<th width=\'30%\' align="center">';echo L('pic_view');echo '</th>
		</tr>
	</thead>
<tbody>
';
$i = 1;
if(is_array($options)){
foreach($options as $info){
if($vote_data['total']==0){
$per=0;
}else{
$per=intval($vote_data[$info['optionid']]/$vote_data['total']*100);
}
;echo '	<tr>
		<td> ';echo $i.' , '.$info['option'];echo ' </td>
		<td align="center">';echo $vote_data[$info['optionid']];;echo '</td>
		<td align="center">
		<div class="vote_bar">
        	<div style="width:';echo $per;echo '%"><span>';echo $per;;echo ' %</span> </div>
        </div>
		</td>
		
		</tr>
	';
$i++;
}
}
;echo '</tbody>
</table>
<div id="pages">
';echo L('vote_all_num');echo '  ';echo $vote_data['total'];;echo '<br>
</div>
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