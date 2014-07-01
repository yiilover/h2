<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">

<form name="myform" action="?s=mood/mood_admin/setting" method="post">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th  align="left" width="40">';echo L('on_hand');echo '</th>
			<th align="left" width="200">';echo L('name');echo '</th>
			<th align="left">';echo L('pic');echo '</th>
		</tr>
	</thead>
<tbody>
';
for($i=1;$i<=10;$i++) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="1" name="use[';echo $i;echo ']" ';if($mood_program[$i]['use']==1){echo 'checked';};echo '></td>
		<td align="left"><input type="text" name="name[';echo $i;echo ']" value="';echo $mood_program[$i]['name'];echo '"></td>
		<td align="left"><input type="text" name="pic[';echo $i;echo ']" value="';echo $mood_program[$i]['pic'];echo '">';if ($mood_program[$i]['pic']) {echo '<img src="'.IMG_PATH.$mood_program[$i]['pic'].'">';};echo '</td>
    </tr>
';
}
;echo '</tbody>
</table>

<div class="btn">
<input type="submit" class="button" name="dosubmit" value="';echo L('submit');echo '"/>
</div>

</div>
</form>
</div>
</body>
</html>';?>