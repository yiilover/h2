<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<form action="?s=wap/wap_admin/add" method="post" id="myform">
<input type="hidden" value=\'';echo $siteid;echo '\' name="siteid">
<fieldset>
	<legend>';echo L('basic_config');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="120">';echo L('wap_sel_site');echo '</th>
    <td class="y-bg">';echo form::select($sitelist,self::get_siteid(),'name="siteid"');echo '</td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_sitename');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="sitename" id="sitename" size="30" value=""/></td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_logo');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="logo" id="logo" size="30" value=""/></td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_domain');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain" size="30" value=""/> </td>
    </tr>
    </table> 
  </fieldset>
 <div class="bk10"></div>
 <fieldset>  
 <legend>';echo L('parameter_config');echo '</legend>
 <table width="100%"  class="table_form">  
    <tr>
    <th width="120">';echo L('wap_listnum');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[listnum]" id="listnum" size="10" value="10"/> Ìõ</td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_thumb');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[thumb_w]" id="thumb_w" size="5" value="220"/>px¡¡*¡¡<input type="text" class="input-text" name="setting[thumb_h]" id="thumb_h" size="5" value="0"/>px</td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_content_page');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[c_num]" id="c_num" size="10" value="1000"/></td>
    </tr>   
    <tr>
    <th width="120">';echo L('wap_index_tpl');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[index_template]" id="index_template" size="20" value="index"/>.html</td>
    </tr> 
     <tr>
    <th width="120">';echo L('wap_cat_tpl');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[category_template]" id="category_template" size="20" value="category"/>.html</td>
    </tr>             
     <tr>
    <th width="120">';echo L('wap_list_tpl');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[list_template]" id="list_template" size="20" value="list"/>.html</td>
    </tr>             
     <tr>
    <th width="120">';echo L('wap_show_tpl');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[show_template]" id="show_template" size="20" value="show"/>.html</td>
    </tr>  
     <tr>
    <th width="120">';echo L('wap_hotword');echo '</th>
    <td class="y-bg"> <textarea style="height: 100px; width: 200px;" id="options" cols="20" rows="2" name="setting[hotwords]">';echo $hotwords;echo '</textarea>  ';echo L('wap_hotword_desc');echo '</td>
    </tr>                 
</table>

<div class="bk15"></div>
<input type="submit" id="dosubmit" name="dosubmit" class="dialog" value="';echo L('submit');echo '" />
</fieldset>
</form>
</div>
</body>
</html>';?>