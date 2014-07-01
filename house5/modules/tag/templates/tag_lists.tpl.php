<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form action="" method="get">
<input type="hidden" name="m" value="tag/tag/del" />
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th>';echo L('name');echo '</th>
		<th>';echo L('stdcall');echo '</th>
		<th>';echo L('stdcode');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';switch($v['type']){case 0:echo L('model_configuration');break;case 1:echo L('custom_sql');break;case 2:echo L('block');};echo '</td>
<td align="center"><textarea ondblclick="copy_text(this)" style="width: 400px;height:30px" />';echo htmlspecialchars($v['tag']);echo '</textarea></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>

</from>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<script type="text/javascript">
<!--

function copy_text(matter){

	//var d = window.top.art.dialog({id:\'edit_file\'}).data.iframe;
	//d.call(matter);
	//window.top.art.dialog({id:\'list\'}).close();
	matter.select();
	js1=matter.createTextRange();
	js1.execCommand("Copy");
	alert(\'';echo L('copy_code');;echo '\');
}

//-->
</script>
</body>
</html>';?>