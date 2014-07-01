<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div style="margin:20px; line-height:22px"><b>';echo L('intro');echo '</b><br />
<a href="?s=maillist/maillist/';echo (isset ($groups['status'])) ?'maillist_mgr': 'maillist_create';;echo '/menuid/';echo $_GET['menuid'];echo '"><img src="http://o.sdo.com/images/banner.jpg"  border="0"   /></a>

<div style="margin-top:30px; width:70%; word-wrap:break-word; word-break:normal; word-break:break-all;">
<span style="font-size:14px; font-weight:bold">';echo L('act');;echo '</span>
';
if (!count($data['activityes'])) {
echo '<br>'.L('no_act');
}else {
foreach ($data['activityes'] as $key =>$item) {
;echo '<div style="padding:10px; border-bottom:solid 1px #cccccc">
	<div>';echo L('act_id') .': '.$item['id'];;echo ' </div> 
	<div>';echo L('act_name') .': '.$item['name'];;echo ' </div> 
	<div>';echo L('act_time') .': '.date('Y-m-d H:i',$item['startTime']['time'] / 1000) .L('to') .date('Y-m-d H:i',$item['endTime']['time'] / 1000) ;;echo '</div>
	<div>';echo L('act_content') .': '.$item['content'];echo '</div>
</div>
';}};echo '</div>
</div>
';?>