<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>�˵�ID</td>
      <td><input type="text" id="linkageid" name="setting[linkageid]" value="';echo $setting['linkageid'];;echo '" size="5"> 
	  <input type=\'button\' value="���б���ѡ��" onclick="omnipotent(\'selectid\',\'?s=admin/linkage/public_get_list\',\'���б���ѡ��\')" class="button">
		�뵽���� ��չ > �����˵� > ��������˵�</td>
    </tr>
	<tr>
	<td>��ʾ��ʽ</td>
	<td>
      	<input name="setting[showtype]" value="0" type="radio" ';if($setting['showtype']==0) echo 'checked';;echo '>
        ֻ��ʾ����
        <input name="setting[showtype]" value="1" type="radio" ';if($setting['showtype']==1) echo 'checked';;echo '>
        ��ʾ����·��  
        <input name="setting[showtype]" value="2" type="radio" ';if($setting['showtype']==2) echo 'checked';;echo '>
        ���������˵�id 		
	</td></tr>
	<tr> 
      <td>·���ָ���</td>
      <td><input type="text" name="setting[space]" value="';echo $setting['space'];;echo '" size="5" class="input-text"> ��ʾ����·��ʱ��Ч</td>
    </tr>	
</table>';?>