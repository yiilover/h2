<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">

<div class="explain-col">
';echo L('check_file_notice');;echo '</div>
<div class="bk15"></div>

<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">';echo L('modifyedfile');echo '</th>
			<th align="left">';echo L('lostfile');echo '</th>
			<th align="left">';echo L('unknowfile');echo '</th>
		</tr>
	</thead>
<tbody>
    <tr>
		<td align="left">';echo count($diff);;echo '</td>
		<td align="left">';echo count($lostfile);;echo '</td>
		<td align="left">';echo count($unknowfile);;echo '</td>
    </tr>

</tbody>
</table>
<div class="bk15"></div>
';if(!empty($diff)) {;echo '<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">';echo L('modifyedfile');echo '</th>
			<th align="left">';echo L('lastmodifytime');echo '</th>
			<th align="left">';echo L('filesize');echo '</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($diff as $k=>$v) {
;echo '    <tr>
		<td align="left">';echo base64_decode($k);echo '</td>
		<td align="left">';echo date("Y-m-d H:i:s",filemtime(base64_decode($k)));echo '</td>
		<td align="left">';echo sizecount(filesize(base64_decode($k)));echo '</td>
		<td align="left"><a href="javascript:void(0)" onclick="view(\'';echo base64_decode($k);echo '\')">';echo L('view');echo '</a> <a href="';echo APP_PATH,base64_decode($k);;echo '" target="_blank">';echo L('access');echo '</a></td>
    </tr>
';
}
;echo '</tbody>
</table>
<div class="bk15"></div>
';};echo '
';if(!empty($unknowfile)) {;echo '<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">';echo L('unknowfile');echo '</th>
			<th align="left">';echo L('lastmodifytime');echo '</th>
			<th align="left">';echo L('filesize');echo '</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($unknowfile as $k=>$v) {
;echo '    <tr>
		<td align="left">';echo base64_decode($v);echo '</td>
		<td align="left">';echo date("Y-m-d H:i:s",filectime(base64_decode($v)));echo '</td>
		<td align="left">';echo sizecount(filesize(base64_decode($v)));echo '</td>
		<td align="left"><a href="javascript:void(0)" onclick="view(\'';echo base64_decode($v);echo '\')">';echo L('view');echo '</a> <a href="';echo APP_PATH,base64_decode($v);;echo '" target="_blank">';echo L('access');echo '</a></td>
    </tr>
';
}
;echo '</tbody>
</table>
<div class="bk15"></div>
';};echo '
';if(!empty($lostfile)) {;echo '<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">';echo L('lostfile');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($lostfile as $k) {
;echo '    <tr>
		<td align="left">';echo base64_decode($k);echo '</td>
    </tr>
';
}
;echo '</tbody>
</table>
';};echo '
</div>
</div>
<script type="text/javascript">
<!--
function view(url) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('view_code');echo '\',id:\'edit\',iframe:\'?s=scan/index/public_view&url=\'+url,width:\'700\',height:\'500\'});
}
//-->
</script>
</body>
</html>';?>