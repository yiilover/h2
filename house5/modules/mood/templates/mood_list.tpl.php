<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="mood/mood_admin/init" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
 		';echo L('category');echo '£º';echo form::select_category('',$catid,'name="catid"',L('please_select'),'',0,1);echo ' 
 		';echo L('time');echo '£º';echo form::select(array('1'=>L('today'),'2'=>L('yesterday'),'3'=>L('this_week'),'4'=>L('this_month'),'5'=>L('all')),$datetype,'name="datetype"');echo ' 
 		';echo L('sort');echo '£º';echo form::select($order_list,$order,'name="order"');echo ' 
				<input type="submit" name="search" class="button" value="';echo L('view');echo '" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>


<div class="table-list">
';if ($catid) :;echo '<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left" width="300">';echo L('title');echo '</th>
			<th align="left">';echo L('total');echo '</th>
			';foreach ($mood_program as $k=>$v) {
echo  '<th align="left">'.$v['name'].'</th>';
};echo '			
		</tr>
	</thead>
<tbody>
';
if(is_array($data) &&!empty($data))foreach($data as $k=>$v) {
;echo '    <tr>
		<td align="left"><a href="';echo $content_data[$v['contentid']]['url'];echo '" target="_blank">';echo $content_data[$v['contentid']]['title'];echo '</a></td>
		<td align="left" ';if ($order == -1) echo 'class="on"';;echo '>';echo  $v['total'];echo '</td>
		';foreach ($mood_program as $k=>$b) {
$d = 'n'.$k;
echo  '<td align="left" '.($order==$k ?'class="on"': '').'>'.$v[$d].'</td>';
};echo '		
    </tr>
';
}
;echo '</tbody>
</table>

<div id="pages">';echo $pages;echo '</div>
';endif;;echo '</div>
</div>

</body>
</html>';?>