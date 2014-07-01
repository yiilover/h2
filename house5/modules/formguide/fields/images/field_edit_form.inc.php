<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>允许上传的图片类型</td>
      <td><input type="text" name="setting[upload_allowext]" value="';echo $setting['upload_allowext'];;echo '" size="40" class="input-text"></td>
    </tr>
	<tr> 
      <td>是否从已上传中选择</td>
      <td><input type="radio" name="setting[isselectimage]" value="1" ';if($setting['isselectimage']) echo 'checked';;echo '> 是 <input type="radio" name="setting[isselectimage]" value="0" ';if(!$setting['isselectimage']) echo 'checked';;echo '> 否</td>
    </tr>
	<tr> 
      <td>允许同时上传的个数</td>
      <td><input type="text" name="setting[upload_number]" value="';echo $setting['upload_number'];;echo '" size=3></td>
    </tr>
</table>';?>