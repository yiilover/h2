<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
 ';
if(is_array($result)){
foreach($result as $v){
;echo '<table width="100%" cellspacing="0" class="table-list">
	<thead>
		<tr>
			<th align="left"><strong>';echo $fields[$v['field']]['name'];echo '</strong></th>
			<th width="10%" align="center">';echo L('stat_num');echo '</th>
			<th width=\'30%\' align="center">';echo L('thumb_shi');echo '</th>
		</tr>
	</thead>
<tbody>
';
$i = 1;
$setting = string2array($v['setting']);
$setting = $setting['options'];
$options = explode("\n",$setting);
if(is_array($options)){
foreach($options AS $_k=>$_v){
$_key = $_kv = $_v;
if (strpos($_v,'|')!==false) {
$xs = explode('|',$_v);
$_key =$xs[0];
$_kv =$xs[1];
}
;echo '	<tr>
		<td> ';echo intval($_k+1).' ¡¢ '.$_key;;echo ' </td>
		<td align="center">';
$number = 0;
foreach ($datas AS $__k=>$__v) {
if(trim($__v[$v['field']])==trim($_kv))  $number++;
}
echo $number;
;echo '</td>
		<td align="center">
		';if($total==0){
$per=0;
}else{
$per=intval($number/$total*100);
};echo '		<div class="vote_bar">
        	<div style="width:';echo $per;echo '%"><span>';echo $per;;echo ' %</span> </div>
        </div>
		</td>
		</tr>
';
$i++;
}
}
;echo '	</tbody>
</table>
<div class="bk10"></div>
';
}
}
;echo '<div class="bk10"></div>
</div>
</body>
</html>








';?>