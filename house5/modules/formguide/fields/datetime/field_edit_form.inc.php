<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" bgcolor="#ffffff">
	<tr> 
      <td><strong>时间格式：</strong></td>
      <td>
	  <input type="radio" name="setting[fieldtype]" value="date" ';if($setting['fieldtype']=='date') echo 'checked';;echo '>日期（';echo date('Y-m-d');echo '）<br />
	  <input type="radio" name="setting[fieldtype]" value="datetime" ';if($setting['fieldtype']=='datetime') echo 'checked';;echo '>日期+时间（';echo date('Y-m-d H:i:s');echo '）<br />
	  <input type="radio" name="setting[fieldtype]" value="int" ';if($setting['fieldtype']=='int') echo 'checked';;echo '>整数 显示格式：
	  <select name="setting[format]">
	  <option value="Y-m-d H:i:s" ';if($setting['format']=='Y-m-d H:i:s') echo 'selected';;echo '>';echo date('Y-m-d H:i:s');echo '</option>
	  <option value="Y-m-d H:i" ';if($setting['format']=='Y-m-d H:i') echo 'selected';;echo '>';echo date('Y-m-d H:i');echo '</option>
	  <option value="Y-m-d" ';if($setting['format']=='Y-m-d') echo 'selected';;echo '>';echo date('Y-m-d');echo '</option>
	  <option value="m-d" ';if($setting['format']=='m-d') echo 'selected';;echo '>';echo date('m-d');echo '</option>
	  </select>
	  </td>
    </tr>
	<tr> 
      <td><strong>默认值：</strong></td>
      <td>
	  <input type="radio" name="setting[defaulttype]" value="0" checked/>无<br />
	 </td>
    </tr>
</table>';?>