<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="subnav">
  <h1 class="title-2 line-x">';echo $node['name'];echo ' - ';echo L('content_list');echo '</h1>
</div>

<div class="pad-lr-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li ';if(empty($status)) echo 'class="on" ';echo 'id="tab_1"><a href="?s=collection/node/publist/nodeid/';echo $nodeid;echo '">';echo L('all');echo '</a></li>
<li ';if($status==1) echo 'class="on" ';echo 'id="tab_1"><a href="?s=collection/node/publist/nodeid/';echo $nodeid;echo '/status/1">';echo L('if_bsnap_then');echo '</a></li>
<li ';if($status==2) echo 'class="on" ';echo ' id="tab_2"><a href="?s=collection/node/publist/nodeid/';echo $nodeid;echo '/status/2">';echo L('spidered');echo '</a></li>
<li ';if($status==3) echo 'class="on" ';echo ' id="tab_3"><a href="?s=collection/node/publist/nodeid/';echo $nodeid;echo '/status/3">';echo L('imported');echo '</a></li>
</ul>
<div class="content pad-10" id="show_div_1" style="height:auto">
<form name="myform" id="myform" action="" method="get">
<div id="form_">
<input type="hidden" name="s" value="collection/node/content_del" />
</div>
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
			<th align="left">';echo L('status');echo '</th>
			<th align="left">';echo L('title');echo '</th>
			<th align="left">';echo L('url');echo '</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($data) &&!empty($data))foreach($data as $k=>$v) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="';echo $v['id'];echo '" name="id[]"></td>
		<td align="left">';if ($v['status'] == '0') {echo L('if_bsnap_then');}elseif ($v['status'] == 1) {echo L('spidered');}elseif ($v['status'] == 2) {echo L('imported');};echo '</td>
		<td align="left">';echo $v['title'];echo '</td>
		<td align="left">';echo $v['url'];echo '</td>
		<td align="left"><a href="javascript:void(0)" onclick="$(\'#tab_';echo $v['id'];echo '\').toggle()">';echo L('view');echo '</a></td>
    </tr>
      <tr id="tab_';echo $v['id'];echo '" style="display:none">
		<td align="left" colspan="5"><textarea style="width:98%;height:300px;">';echo htmlspecialchars($v['data']);echo '</textarea></td>
    </tr>
';
}
;echo '</tbody>
</table>

<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onclick="re_url(\'s=collection/node/content_del&nodeid=';echo $nodeid;echo '\');return check_checkbox(1);"/> 
<input type="submit" class="button" name="dosubmit"  onclick="re_url(\'s=collection/node/content_del&nodeid=';echo $nodeid;echo '&history=1\');return check_checkbox(1);" value="';echo L('also_delete_the_historical');echo '"/> 
<input type="submit" class="button" name="dosubmit" onclick="re_url(\'s=collection/node/import&nodeid=';echo $nodeid;echo '\');return check_checkbox();" value="';echo L('import_selected');echo '"/>
<input type="submit" class="button" name="dosubmit"  onclick="re_url(\'s=collection/node/import&type=all&nodeid=';echo $nodeid;echo '\')" value="';echo L('import_all');echo '"/>
</div>

<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
</div>
<script type="text/javascript">
<!--
function re_url(url) {
	var urls = url.split(\'&\');
	var num = urls.length;
	var str = \'\';
	for (var i=0;i<num;i++){
		var a = urls[i].split(\'=\');
		str +=\'<input type="hidden" name="\'+a[0]+\'" value="\'+a[1]+\'" />\';
	}
	$(\'#form_\').html(str);
}

function check_checkbox(obj) {
	var checked = 0;
	$("input[type=\'checkbox\'][name=\'id[]\']").each(function (i,n){if (this.checked) {
		checked = 1;
	}});
	if (checked != 0) {
		if (obj) {
			if (confirm(\'';echo L('sure_delete');echo '\')) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	} else {
		alert(\'';echo L('select_article');echo '\');
		return false;
	}
}
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>
</body>
</html>';?>