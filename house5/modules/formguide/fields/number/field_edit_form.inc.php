<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">ȡֵ��Χ</td>
      <td><input type="text" name="setting[minnumber]" value="';echo $setting['minnumber'];;echo '" size="5" class="input-text"> - <input type="text" name="setting[maxnumber]" value="';echo $setting['maxnumber'];;echo '" size="5" class="input-text"></td>
    </tr>
	<tr> 
      <td>С��λ����</td>
      <td>
	  <select name="setting[decimaldigits]">
	  <option value="-1" ';if($setting['decimaldigits']==-1) echo 'selected';;echo ')>�Զ�</option>
	  <option value="0" ';if($setting['decimaldigits']==0) echo 'selected';;echo '>0</option>
	  <option value="1" ';if($setting['decimaldigits']==1) echo 'selected';;echo '>1</option>
	  <option value="2" ';if($setting['decimaldigits']==2) echo 'selected';;echo '>2</option>
	  <option value="3" ';if($setting['decimaldigits']==3) echo 'selected';;echo '>3</option>
	  <option value="4" ';if($setting['decimaldigits']==4) echo 'selected';;echo '>4</option>
	  <option value="5" ';if($setting['decimaldigits']==5) echo 'selected';;echo '>5</option>
	  </select>
    </td>
    </tr>
	<tr> 
      <td>����򳤶�</td>
      <td><input type="text" name="setting[size]" value="';echo $setting['size'];;echo '" size="3" class="input-text"> px</td>
    </tr>
	<tr> 
      <td>Ĭ��ֵ</td>
      <td><input type="text" name="setting[defaultvalue]" value="';echo $setting['defaultvalue'];;echo '" size="40" class="input-text"></td>
    </tr>
</table>';?>