<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header');
;echo '<div class="pad-10">
<form action="?s=admin/module/install" method="post" id="myform">
<div>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('modulename');echo '£º</th>
    <td class="y-bg">';echo $modulename;echo '</td>
  </tr>
  <tr>
    <th width="80">';echo L('introduce');echo '£º</th>
    <td class="y-bg">';echo $introduce;echo '</td>
  </tr>
  <tr>
    <th width="80">';echo L('moduleauthor');echo '£º</th>
    <td class="y-bg">';echo $author;echo '</td>
  </tr>
  <tr>
    <th width="80">E-mail£º</th>
    <td class="y-bg">';echo $authoremail;echo '</td>
 </tr>
 <tr>
    <th width="80">';echo L('homepage');echo '£º</th>
    <td class="y-bg">';echo $authorsite;echo '</td>
 </tr>
</table>
</div>
<div class="bk15"></div><input type="hidden" name="module" value="';echo $_GET['module'];echo '">
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>
</div>
</form>
</body>
</html>';?>