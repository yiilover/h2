<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script language="javascript" type="text/javascript" src="{JS_PATH}dialog.js"></script>

<link href="';echo CSS_PATH;echo 'table_form.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH;echo 'dialog.css" rel="stylesheet" type="text/css" />
<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo $f_info['name'];echo '--';echo L('form_preview');echo '</h2>  
<div class="content-menu ib-a blue line-x">
¡¡ ';if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>¡¡';;echo '<a class="on" href="?s=formguide/formguide/init"><em>';echo L('return_list');echo '</em></a></div>
</div>
<div class="pad-10">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	';
if(is_array($forminfos_data)) {
foreach($forminfos_data as $field=>$info) {
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos_data as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
}
;echo '	<tr>
      <th width="80">';if($info['star']){;echo ' <font color="red">*</font>';};echo ' ';echo $info['name'];echo '	  </th>
      <td>';echo $info['form'];echo '  ';echo $info['tips'];echo '</td>
    </tr>
';
}}
;echo '	</tbody>
</table>
<input type="submit" class="button" name="dosubmit" id="dosubmit" value=" ';echo L('ok');echo ' ">&nbsp;<input type="reset" class="button" value=" ';echo L('clear');echo ' ">
</div>
</body>
</html>';?>