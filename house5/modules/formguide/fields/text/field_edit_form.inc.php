<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">�ı��򳤶�</td>
      <td><input type="text" name="setting[size]" value="';echo $setting['size'];;echo '" size="10" class="input-text"></td>
    </tr>
	<tr> 
      <td>Ĭ��ֵ</td>
      <td><input type="text" name="setting[defaultvalue]" value="';echo $setting['defaultvalue'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>�Ƿ�Ϊ�����</td>
      <td><input type="radio" name="setting[ispassword]" value="1" ';if($setting['ispassword']) echo 'checked';;echo '> �� <input type="radio" name="setting[ispassword]" value="0" ';if(!$setting['ispassword']) echo 'checked';;echo '> ��</td>
    </tr>
</table>';?>