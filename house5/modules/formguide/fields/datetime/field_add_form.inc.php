<?php
echo '<table cellpadding="2" cellspacing="1" bgcolor="#ffffff">
	<tr> 
      <td><strong>时间格式：</strong></td>
      <td>
	  <input type="radio" name="setting[fieldtype]" value="date" checked>日期（';echo date('Y-m-d');echo '）<br />
	  <input type="radio" name="setting[fieldtype]" value="datetime">日期+时间（';echo date('Y-m-d H:i:s');echo '）<br />
	  <input type="radio" name="setting[fieldtype]" value="int">整数 显示格式：
	  <select name="setting[format]">
	  <option value="Y-m-d H:i:s">';echo date('Y-m-d H:i:s');echo '</option>
	  <option value="Y-m-d H:i">';echo date('Y-m-d H:i');echo '</option>
	  <option value="Y-m-d">';echo date('Y-m-d');echo '</option>
	  <option value="m-d">';echo date('m-d');echo '</option>
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