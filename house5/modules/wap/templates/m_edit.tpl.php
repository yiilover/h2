<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<form action="?s=wap/wap_admin/edit" method="post" id="myform">
<input type="hidden" value=\'';echo $siteid;echo '\' name="siteid">
<fieldset>
	<legend>';echo L('basic_config');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="120">';echo L('wap_belong_site');echo '</th>
    <td class="y-bg">';echo $sitelist[$siteid]['name'];echo '</td>
    </tr>	
    <tr>
    <th width="120">';echo L('wap_sitename');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="sitename" id="sitename" size="30" value="';echo $sitename;echo '"/></td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_domain');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain" size="30" value="';echo $domain;echo '"/></td>
    </tr>
    <tr>
    <th width="120">';echo L('wap_thumb');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[thumb_w]" id="thumb_w" size="5" value="';echo $thumb_w;echo '"/>px¡¡*¡¡<input type="text" class="input-text" name="setting[thumb_h]" id="thumb_h" size="5" value="';echo $thumb_h;echo '"/>px</td>
    </tr>
    <tr>
    <th width="120">';echo L('default_city');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[default_city]" id="default_city" size="10" value="';echo $default_city;echo '"/></td>
    </tr> 
    </table> 
  </fieldset>
<div class="bk15"></div>
<input type="submit" id="dosubmit" name="dosubmit" class="dialog" value="';echo L('submit');echo '" />

</form>
</div>
</body>
</html>';?>