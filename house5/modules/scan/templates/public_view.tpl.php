<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10" style="padding-bottom:0px;">
<table width="100%" height="400" class="table_form">
';if (isset($func)) :;echo ' 	<tr>
    <td>';echo L('characteristic_function');echo '��';
if ($func) {
foreach ($func as $val) {
if($val) {
echo "<input type='button' onclick=\"fnSearch('$val');\" value='".$val."' class='button'> ";
}
}
}
;echo '</td>
    </tr>
';endif;;echo '';if (isset($code)) :;echo ' 	<tr>
    <td>';echo L('characteristic_key');echo '��';
if($code) {
foreach ($code as $val) {
if($val) {
echo "<input type='button' onclick=\"fnSearch('".htmlentities($val)."');\" value='".htmlentities($val)."' class='button'> ";
}
}
}
;echo '</td>
    </tr>
';endif;;echo '    <tr>
    <td><textarea name="code" id="code" style="width:650px;height: 380px;">';echo htmlspecialchars($html);echo '</textarea></td>
    </tr>
</table>
</div>
<script type="text/javascript">
var oRange; 
var intCount = 0;  
var intTotalCount = 100;

function fnSearch(strBeReplaced) { 
	var strBeReplaced; 
	var strReplace; 
	fnNext(); 
	$(\'#code\').focus(); 
	oRange = document.getElementById(\'code\').createTextRange(); 
	for (i=1; oRange.findText(strBeReplaced)!=false; i++) { 
		if(i==intCount){ 
			oRange.select(); 
			oRange.scrollIntoView(); 
			break; 
		} 
		oRange.collapse(false); 
	} 
} 


function fnNext(){ 
	if (intCount > 0 && intCount < intTotalCount){ 
		intCount = intCount + 1; 
	} else { 
		intCount = 1 ; 
	} 
} 
//--> 
</SCRIPT> 
</script>
</body>
</html>';?>