<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">�ı�����</td>
      <td><input type="text" name="setting[width]" value="';echo $setting['width'];;echo '" size="10" class="input-text" > %</td>
    </tr>
	<tr> 
      <td>�ı���߶�</td>
      <td><input type="text" name="setting[height]" value="';echo $setting['height'];;echo '" size="10" class="input-text"> px</td>
    </tr>
	<tr> 
      <td>Ĭ��ֵ</td>
      <td><textarea name="setting[defaultvalue]" rows="2" cols="20" id="defaultvalue" style="height:60px;width:250px;" >';echo $setting['defaultvalue'];;echo '</textarea></td>
    </tr>
	<tr> 
      <td>�Ƿ�����Html</td>
      <td><input type="radio" name="setting[enablehtml]" value="1" ';if($setting['enablehtml']==1) {;echo 'checked';};echo '> �� <input type="radio" name="setting[enablehtml]" value="0" ';if($setting['enablehtml']==0) {;echo 'checked';};echo '> ��</td>
    </tr>
</table>';?>