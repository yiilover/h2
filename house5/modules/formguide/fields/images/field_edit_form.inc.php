<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>�����ϴ���ͼƬ����</td>
      <td><input type="text" name="setting[upload_allowext]" value="';echo $setting['upload_allowext'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>�Ƿ�����ϴ���ѡ��</td>
      <td><input type="radio" name="setting[isselectimage]" value="1" ';if($setting['isselectimage']) echo 'checked';;echo '> �� <input type="radio" name="setting[isselectimage]" value="0" ';if(!$setting['isselectimage']) echo 'checked';;echo '> ��</td>
    </tr>
	<tr> 
      <td>����ͬʱ�ϴ��ĸ���</td>
      <td><input type="text" name="setting[upload_number]" value="';echo $setting['upload_number'];;echo '" size=3></td>
    </tr>
</table>';?>