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
      <td>����ʾģʽ</td>
      <td><input type="radio" name="setting[show_type]" value="1" ';if($setting['show_type']) echo 'checked';;echo '/> ͼƬģʽ <input type="radio" name="setting[show_type]" value="0" ';if(!$setting['show_type']) echo 'checked';;echo '/> �ı���ģʽ</td>
    </tr>
	<tr> 
      <td>�����ϴ���ͼƬ��С</td>
      <td><input type="text" name="setting[upload_maxsize]" value="';echo $setting['upload_maxsize'];;echo '" size="5" class="input-text">KB ��ʾ��1KB=1024Byte��1MB=1024KB *</td>
    </tr>
	<tr> 
      <td>�����ϴ���ͼƬ����</td>
      <td><input type="text" name="setting[upload_allowext]" value="';echo $setting['upload_allowext'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>�Ƿ�����ϴ���ѡ��</td>
      <td><input type="radio" name="setting[isselectimage]" value="1" ';if($setting['isselectimage']) echo 'checked';;echo '> �� <input type="radio" name="setting[isselectimage]" value="0" ';if(!$setting['isselectimage']) echo 'checked';;echo '> ��</td>
    </tr>
	<tr> 
      <td>ͼ���С</td>
      <td>�� <input type="text" name="setting[images_width]" value="';echo $setting['images_width'];;echo '" size="3">px �� <input type="text" name="setting[images_height]" value="';echo $setting['images_height'];;echo '" size="3">px</td>
    </tr>
</table>';?>