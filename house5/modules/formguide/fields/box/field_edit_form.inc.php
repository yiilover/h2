<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">ѡ���б�</td>
      <td><textarea name="setting[options]" rows="2" cols="20" id="options" style="height:100px;width:200px;">';echo $setting['options'];;echo '</textarea></td>
    </tr>
	<tr> 
      <td>ѡ������</td>
      <td>
	  <input type="radio" name="setting[boxtype]" value="radio" ';if($setting['boxtype']=='radio') echo 'checked';;echo ' onclick="$(\'#setcols\').show();$(\'#setsize\').hide();"/> ��ѡ��ť 
	  <input type="radio" name="setting[boxtype]" value="checkbox" ';if($setting['boxtype']=='checkbox') echo 'checked';;echo ' onclick="$(\'#setcols\').show();$(\'setsize\').hide();"/> ��ѡ�� 
	  <input type="radio" name="setting[boxtype]" value="select" ';if($setting['boxtype']=='select') echo 'checked';;echo ' onclick="$(\'#setcols\').hide();$(\'setsize\').show();" /> ������ 
	  <input type="radio" name="setting[boxtype]" value="multiple" ';if($setting['boxtype']=='multiple') echo 'checked';;echo ' onclick="$(\'#setcols\').hide();$(\'setsize\').show();" /> ��ѡ�б��
	  </td>
    </tr>
	<tr> 
      <td>�ֶ�����</td>
      <td>
	  <select name="setting[fieldtype]" onchange="javascript:fieldtype_setting(this.value);">
	  <option value="varchar" ';if($setting['fieldtype']=='varchar') echo 'selected';;echo '>�ַ� VARCHAR</option>
	  <option value="tinyint" ';if($setting['fieldtype']=='tinyint') echo 'selected';;echo '>���� TINYINT(3)</option>
	  <option value="smallint" ';if($setting['fieldtype']=='smallint') echo 'selected';;echo '>���� SMALLINT(5)</option>
	  <option value="mediumint" ';if($setting['fieldtype']=='mediumint') echo 'selected';;echo '>���� MEDIUMINT(8)</option>
	  <option value="int" ';if($setting['fieldtype']=='int') echo 'selected';;echo '>���� INT(10)</option>
	  </select> <span id="minnumber" style="display:none"><input type="radio" name="setting[minnumber]" value="1" ';if($setting['minnumber']==1) echo 'checked';;echo '/> <font color=\'red\'>������</font> <input type="radio" name="setting[minnumber]" value="-1" ';if($setting['minnumber']==-1) echo 'checked';;echo '/> ����</span>
	  </td>
    </tr>
<tbody id="setcols" style="display:">
	<tr> 
      <td>����</td>
      <td><input type="text" name="setting[cols]" value="';echo $setting['cols'];;echo '" size="5" class="input-text"> ÿ����ʾ��ѡ�����</td>
    </tr>
	<tr> 
      <td>ÿ�п��</td>
      <td><input type="text" name="setting[width]" value="';echo $setting['width'];;echo '" size="5" class="input-text"> px</td>
    </tr>
</tbody>
<tbody id="setsize" style="display:none">
	<tr> 
      <td>�߶�</td>
      <td><input type="text" name="setting[size]" value="';echo $setting['size'];;echo '" size="5" class="input-text"> ��</td>
    </tr>
</tbody>
	<tr> 
      <td>Ĭ��ֵ</td>
      <td><input type="text" name="setting[defaultvalue]" size="40" class="input-text" value="';echo $setting['defaultvalue'];;echo '"></td>
    </tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fieldtype_setting(obj) {
	if(obj!=\'varchar\') {
		$(\'#minnumber\').css(\'display\',\'\');
	} else {
		$(\'#minnumber\').css(\'display\',\'none\');
	}
}
//-->
</SCRIPT>';?>