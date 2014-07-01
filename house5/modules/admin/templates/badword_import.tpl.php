<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
<form action="?s=admin/badword/import" method="post" name="myform">
 	<tr> 
      <th width="10%"> ';echo L('badword_name');echo ' </th>
      <td width="200"><textarea name="info" cols="50" rows="6" require="true" datatype="limit" ></textarea> </td>
    </tr>
   
    <tr> 
      <th> ';echo L('badword_name');echo ' ';echo L('badword_require');echo ': </th>
      <td>
';echo L('badword_import_infos');echo ' </td>
    </tr> 
    
 
    <tr> 
      <th></th>
      <td> 
	  <input type="hidden" name="forward" value="?s=admin/badword/import"> 
	  <input type="submit" name="dosubmit" value=" ';echo L('submit');echo ' " class="button"> 
      &nbsp; <input type="reset" name="reset" value=" ';echo L('clear');echo ' " class="button">
	  </td>
    </tr>
	</form>
</table> 
</div>
</body>
</html>';?>