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
      <td>是否为密码框</td>
      <td><input type="radio" name="setting[ispassword]" value="1" ';if($setting['ispassword']) echo 'checked';;echo '> 是 <input type="radio" name="setting[ispassword]" value="0" ';if(!$setting['ispassword']) echo 'checked';;echo '> 否</td>
    </tr>
</table>';?>