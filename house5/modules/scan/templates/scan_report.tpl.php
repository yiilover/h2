<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">';echo L('file_address');echo '</th>
			<th align="left">';echo L('function_of_characteristics');echo '</th>
			<th align="left">';echo L('characteristic_function');echo '</th>
			<th align="left">';echo L('code_number_of_features');echo '</th>
			<th align="left">';echo L('characteristic_key');echo '</th>
			<th align="left">Zend encoded</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($badfiles as $k=>$v) {
;echo '    <tr>
		<td align="left">';echo $k;echo '</td>
		<td align="left">';if(isset($v['func'])){echo count($v['func']);}else{echo '0';};echo '</td>
		<td align="left">';if(isset($v['func'])){
foreach ($v['func'] as $keys=>$vs)
{
$d[$keys] = strtolower($vs[1]);
}
$d = array_unique($d);
foreach ($d as $vs)
{
echo "<font color='red'>".$vs."</font>  ";
}
};echo '</td>
		<td align="left">';if(isset($v['code'])){echo count($v['code']);}else{echo '0';};echo '</td>
		<td align="left">';if(isset($v['code'])){
foreach ($v['code'] as $keys=>$vs)
{
$d[$keys] = strtolower($vs[1]);
}
$d = array_unique($d);
foreach ($d as $vs)
{
echo "<font color='red'>".htmlentities($vs)."</font>  ";
}
};echo '</td>
		<td align="left">';if(isset($v['zend'])){echo '<font color=\'red\'>Yes</font>';}else{echo 'No';};echo '</td>
		<td align="left"><a href="javascript:void(0)" onclick="view(\'';echo urlencode($k);echo '\')">';echo L('view');echo '</a> <a href="';echo APP_PATH,$k;;echo '" target="_blank">';echo L('access');echo '</a></td>
    </tr>
';
}
;echo '</tbody>
</table>

</div>
</div>
<script type="text/javascript">
<!--
function view(url) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('view_code');echo '\',id:\'edit\',iframe:\'?s=scan/index/view&url=\'+url,width:\'700\',height:\'500\'});
}
//-->
</script>
</body>
</html>';?>