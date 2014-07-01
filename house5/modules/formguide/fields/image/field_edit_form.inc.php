<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">文本框长度</td>
      <td><input type="text" name="setting[size]" value="';echo $setting['size'];;echo '" size="10" class="input-text"></td>
    </tr>
	<tr> 
      <td>默认值</td>
      <td><input type="text" name="setting[defaultvalue]" value="';echo $setting['defaultvalue'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>表单显示模式</td>
      <td><input type="radio" name="setting[show_type]" value="1" ';if($setting['show_type']) echo 'checked';;echo '/> 图片模式 <input type="radio" name="setting[show_type]" value="0" ';if(!$setting['show_type']) echo 'checked';;echo '/> 文本框模式</td>
    </tr>
	<tr> 
      <td>允许上传的图片大小</td>
      <td><input type="text" name="setting[upload_maxsize]" value="';echo $setting['upload_maxsize'];;echo '" size="5" class="input-text">KB 提示：1KB=1024Byte，1MB=1024KB *</td>
    </tr>
	<tr> 
      <td>允许上传的图片类型</td>
      <td><input type="text" name="setting[upload_allowext]" value="';echo $setting['upload_allowext'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>是否从已上传中选择</td>
      <td><input type="radio" name="setting[isselectimage]" value="1" ';if($setting['isselectimage']) echo 'checked';;echo '> 是 <input type="radio" name="setting[isselectimage]" value="0" ';if(!$setting['isselectimage']) echo 'checked';;echo '> 否</td>
    </tr>
	<tr> 
      <td>图像大小</td>
      <td>宽 <input type="text" name="setting[images_width]" value="';echo $setting['images_width'];;echo '" size="3">px 高 <input type="text" name="setting[images_height]" value="';echo $setting['images_height'];;echo '" size="3">px</td>
    </tr>
</table>';?>