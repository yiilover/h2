<?php
 defined('IN_HOUSE5') or exit('No permission resources.');;echo '<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td>菜单ID</td>
      <td><input type="text" id="linkageid" name="setting[linkageid]" value="';echo $setting['linkageid'];;echo '" size="5"> 
	  <input type=\'button\' value="在列表中选择" onclick="omnipotent(\'selectid\',\'?s=admin/linkage/public_get_list\',\'在列表中选择\')" class="button">
		请到导航 扩展 > 联动菜单 > 添加联动菜单</td>
    </tr>
	<tr>
	<td>显示方式</td>
	<td>
      	<input name="setting[showtype]" value="0" type="radio" ';if($setting['showtype']==0) echo 'checked';;echo '>
        只显示名称
        <input name="setting[showtype]" value="1" type="radio" ';if($setting['showtype']==1) echo 'checked';;echo '>
        显示完整路径  
        <input name="setting[showtype]" value="2" type="radio" ';if($setting['showtype']==2) echo 'checked';;echo '>
        返回联动菜单id 		
	</td></tr>
	<tr> 
      <td>路径分隔符</td>
      <td><input type="text" name="setting[space]" value="';echo $setting['space'];;echo '" size="5" class="input-text"> 显示完整路径时生效</td>
    </tr>	
</table>';?>