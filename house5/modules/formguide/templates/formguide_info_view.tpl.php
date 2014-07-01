<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<table width="100%" cellspacing="0" class="table-list">
	<thead>
		<tr>
			<th width="15%" align="right">';echo L('selects');echo '</th>
			<th align="left">';echo L('values');echo '</th>
		</tr>
	</thead>
<tbody>
 ';
if(is_array($forminfos_data)){
foreach($forminfos_data as $key =>$form){
;echo '   
	<tr>
		<td>';echo $fields[$key]['name'];echo ':</td>
		<td>';echo $form;echo '</td>
		
		
		</tr>
';
}
}
;echo '	</tbody>
</table>

</div>
</body>
</html>';?>