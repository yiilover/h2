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
if($form){
;echo '   
	<tr>
		<td>';echo $fields[$key]['name'];echo ':</td>
		<td>';echo $form;echo '</td>
		
		
		</tr>
';
}}
}
;echo '<FORM method="post" action="?s=formguide/formguide_info/public_tuanmark" id="myform">
	<tr><td colspan=2><TEXTAREA name="mark" rows="3" cols="30"></TEXTAREA><INPUT type="hidden" name="dataid" value="';echo $did;;echo '"></td></tr>
	<tr><td colspan=2><INPUT type="submit" name="marksubmit" value="保存"></tr>
</FORM>
	</tbody>
</table>
';
if(!empty($key_array))
{;echo '<table width="100%" class="table-list" cellspacing="0" cellpadding="0">
  <tr>
    <td width="72%">备注</td>
    <td width="10%">操作人</td>
    <td width="18%">日期</td>
  </tr>
  ';
foreach($key_array as $_fm=>$_fm_value) {
$addtime = date('Y-m-d H:i',$_fm_value['addtime']);
echo '<tr><td>'.$_fm_value['content'].'</td><td>'.$_fm_value['username'].'</td><td>'.$addtime.'</td></tr>';
};echo '			</table>
';};echo '</div>
</body>
</html>';?>