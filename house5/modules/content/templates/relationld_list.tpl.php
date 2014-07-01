<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="content/content/public_relationld_list" name="s">
<input type="hidden" value="';echo $modelid;;echo '" name="modelid">
<input type="hidden" value="';echo $_GET['mid'];;echo '" id="mid">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td align="center">
		<div class="explain-col">
				<select name="field">
					<option value=\'title\' ';if($_GET['field']=='title') echo 'selected';;echo '>Â¥ºÅ</option>
					<option value=\'relation\' ';if($_GET['field']=='keywords') echo 'selected';;echo ' >Â¥ÅÌ</option>
				</select>
				<input name="keywords" type="text" value="';echo stripslashes($_GET['keywords']);echo '" style="width:330px;" class="input-text" />
				<input type="submit" name="dosubmit" class="button" value="';echo L('search');;echo '" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th >Â¥¶°ºÅ</th>
			<th width="100">ËùÊôÂ¥ÅÌ</th>
			<th width="100">ÏúÊÛ×´Ì¬</th>
			<th width="100">';echo L('belong_category');;echo '</th>
            <th width="100">';echo L('addtime');;echo '</th>
            </tr>
        </thead>
    <tbody>
	';foreach($infos as $r) {;echo '	<tr onclick="select_list(this,\'';echo safe_replace($r['title']);;echo '\',';echo $r['id'];;echo ',\'';echo getbox_val('29','xszt',$r['xszt']);;echo '\')" class="cu" title="';echo L('click_to_select');;echo '">
		<td align=\'center\' >';echo $r['title'];;echo '</td>
		';$ldinfo = get_relationxq($r['id'],19,14);;echo '		<td align=\'center\'>';echo $ldinfo['title'];;echo '</td>
		<td align=\'center\' >';echo getbox_val('29','xszt',$r['xszt']);;echo '</td>
		<td align=\'center\'>';echo $this->categorys[$r['catid']]['catname'];;echo '</td>
		<td align=\'center\'>';echo format::date($r['inputtime']);;echo '</td>
	</tr>
	 ';};echo '	    </tbody>
    </table>
   <div id="pages">';echo $pages;;echo '</div>
</div>
</div>
<style type="text/css">
 .line_ff9966,.line_ff9966:hover td{
	background-color:#FF9966;
}
 .line_fbffe4,.line_fbffe4:hover td {
	background-color:#fbffe4;
}
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function select_list(obj,title,id,xszt) {
		var relation_ids = window.top.$(\'#relation\').val();
		var value = $(\'#mid\').val();
		var sid = \'v';echo $modelid;;echo '\'+id;
		if($(obj).attr(\'class\')==\'line_ff9966\' || $(obj).attr(\'class\')==null) {
			$(obj).attr(\'class\',\'line_fbffe4\');
			window.top.$(\'#\'+sid).remove();
			if(relation_ids !=\'\' ) {
				var r_arr = relation_ids.split(\'|\');
				var newrelation_ids = \'\';
				$.each(r_arr, function(i, n){
					if(n!=id) {
						if(i==0) {
							newrelation_ids = n;
						} else {
						 newrelation_ids = newrelation_ids+\'|\'+n;
						}
					}
				});
				if(newrelation_ids.indexOf(\'|\')==0)
				{
					newrelation_ids = newrelation_ids.substring(1);
				}
				window.top.$(\'#relation\').val(newrelation_ids);
			}
		} else {
			$(obj).attr(\'class\',\'line_ff9966\');
			var str = "<li id=\'"+sid+"\'>¡¤<span>"+title+"</span><a href=\'javascript:;\' class=\'close\' onclick=\\"remove_relation(\'"+sid+"\',"+id+")\\"></a></li>";
			window.top.$(\'#relation_text\').append(str);
			if(relation_ids ==\'\' || relation_ids ==0) {
				window.top.$(\'#relation\').val(id);
			} else {
				relation_ids = relation_ids+\'|\'+id;
				window.top.$(\'#relation\').val(relation_ids);
			}
			window.top.art.dialog({id:\'selectid\'}).close();
		}
}
//-->
</SCRIPT>
</body>
</html>';?>