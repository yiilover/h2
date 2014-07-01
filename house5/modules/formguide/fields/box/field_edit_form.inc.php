<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">选项列表</td>
      <td><textarea name="setting[options]" rows="2" cols="20" id="options" style="height:100px;width:200px;">';echo $setting['options'];;echo '</textarea></td>
    </tr>
	<tr> 
      <td>选项类型</td>
      <td>
	  <input type="radio" name="setting[boxtype]" value="radio" ';if($setting['boxtype']=='radio') echo 'checked';;echo ' onclick="$(\'#setcols\').show();$(\'#setsize\').hide();"/> 单选按钮 
	  <input type="radio" name="setting[boxtype]" value="checkbox" ';if($setting['boxtype']=='checkbox') echo 'checked';;echo ' onclick="$(\'#setcols\').show();$(\'setsize\').hide();"/> 复选框 
	  <input type="radio" name="setting[boxtype]" value="select" ';if($setting['boxtype']=='select') echo 'checked';;echo ' onclick="$(\'#setcols\').hide();$(\'setsize\').show();" /> 下拉框 
	  <input type="radio" name="setting[boxtype]" value="multiple" ';if($setting['boxtype']=='multiple') echo 'checked';;echo ' onclick="$(\'#setcols\').hide();$(\'setsize\').show();" /> 多选列表框
	  </td>
    </tr>
	<tr> 
      <td>字段类型</td>
      <td>
	  <select name="setting[fieldtype]" onchange="javascript:fieldtype_setting(this.value);">
	  <option value="varchar" ';if($setting['fieldtype']=='varchar') echo 'selected';;echo '>字符 VARCHAR</option>
	  <option value="tinyint" ';if($setting['fieldtype']=='tinyint') echo 'selected';;echo '>整数 TINYINT(3)</option>
	  <option value="smallint" ';if($setting['fieldtype']=='smallint') echo 'selected';;echo '>整数 SMALLINT(5)</option>
	  <option value="mediumint" ';if($setting['fieldtype']=='mediumint') echo 'selected';;echo '>整数 MEDIUMINT(8)</option>
	  <option value="int" ';if($setting['fieldtype']=='int') echo 'selected';;echo '>整数 INT(10)</option>
	  </select> <span id="minnumber" style="display:none"><input type="radio" name="setting[minnumber]" value="1" ';if($setting['minnumber']==1) echo 'checked';;echo '/> <font color=\'red\'>正整数</font> <input type="radio" name="setting[minnumber]" value="-1" ';if($setting['minnumber']==-1) echo 'checked';;echo '/> 整数</span>
	  </td>
    </tr>
<tbody id="setcols" style="display:">
	<tr> 
      <td>列数</td>
      <td><input type="text" name="setting[cols]" value="';echo $setting['cols'];;echo '" size="5" class="input-text"> 每行显示的选项个数</td>
    </tr>
	<tr> 
      <td>每列宽度</td>
      <td><input type="text" name="setting[width]" value="';echo $setting['width'];;echo '" size="5" class="input-text"> px</td>
    </tr>
</tbody>
<tbody id="setsize" style="display:none">
	<tr> 
      <td>高度</td>
      <td><input type="text" name="setting[size]" value="';echo $setting['size'];;echo '" size="5" class="input-text"> 行</td>
    </tr>
</tbody>
	<tr> 
      <td>默认值</td>
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