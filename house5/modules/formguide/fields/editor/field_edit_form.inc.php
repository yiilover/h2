<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">编辑器样式：</td>
      <td><input type="radio" name="setting[toolbar]" value="basic" ';if($setting['toolbar']=='basic') echo 'checked';;echo '> ';echo $setting['toolbar'];;echo '简洁型 <input type="radio" name="setting[toolbar]" value="full" ';if($setting['toolbar']=='full') echo 'checked';;echo '> 标准型 </td>
    </tr>
	<tr> 
      <td>默认值：</td>
      <td><textarea name="setting[defaultvalue]" rows="2" cols="20" id="defaultvalue" style="height:100px;width:250px;">';echo $setting['defaultvalue'];;echo '</textarea></td>
    </tr>
</table>';?>