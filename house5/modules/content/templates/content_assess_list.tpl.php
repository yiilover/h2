<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="content-menu ib-a blue line-x">
';$catid = $_GET['catid'] ?intval($_GET['catid']) : '6';;echo '<A href="?s=content/assess/init/catid/';echo $catid;echo '/adminname/';echo $adminname;echo '/themonth/1/dosubmit/1" ';if($_GET['themonth']){;echo 'class="on"';};echo '>本月</A> | <A href="?s=content/assess/init/catid/';echo $catid;echo '/adminname/';echo $adminname;echo '/week/1/dosubmit/1" ';if($_GET['week']){;echo 'class="on"';};echo '>本周</A> | <A href="?s=content/assess/init/catid/';echo $catid;echo '/adminname/';echo $adminname;echo '/yesterday/1/dosubmit/1" ';if($_GET['yesterday']){;echo 'class="on"';};echo '>昨天</A> | <A href="?s=content/assess/init/catid/';echo $catid;echo '/adminname/';echo $adminname;echo '/today/1/dosubmit/1" ';if((!$_GET['dosubmit']&&!$_GET['week']&&!$_GET['yesterday'])||$_GET['today']){;echo 'class="on"';};echo '>今天</A> | <a href="javascript:;" onclick="javascript:$(\'#searchid\').css(\'display\',\'\');" ';if($_GET['dosubmit']=="搜索"){;echo 'class="on"';};echo '><em>';echo L('search');;echo '</em></a>
</div>
<div id="searchid" style="display:';if(!isset($_GET['search'])) echo 'none';;echo '">
<form name="searchform" action="" method="get" >
<input type="hidden" value="content/assess/init" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col"><select name="year">';$year = date("Y");for($i=$year;$i>=$year-3;$i--){;echo '<option ';if(!empty($_GET['year'])){if($i==$_GET['year']) {;echo 'selected';}}else{if($i==$year){;echo 'selected ';}};echo ' value="';echo $i;;echo '">';echo $i;;echo '</option>';};echo '</select>年 <select name="month">';$month = date("m");for($j=1;$j<=12;$j++){;echo '<option ';if(!empty($_GET['month'])){if($j==$_GET['month']) {;echo 'selected';}}else{if($j==$month){;echo 'selected ';}};echo ' value="';echo $j;;echo '">';echo $j;;echo '</option>';};echo '<option value="0">不限</option></select>月 <select name="catid"><option value="6" ';if ($_GET['catid']=='6'||empty($_GET['catid'])){;echo 'selected';};echo '>新闻</option><option value="9" ';if ($_GET['catid']=='9'){;echo 'selected';};echo '>新房</option></select>
		 ';
$this->admin_db = h5_base::load_model('admin_model');
$infos = $this->admin_db->listinfo("disabled='0' and roleid in (8,9,10,11)",'','',20);
if(is_array($infos)){
echo '<select name="adminname">';
foreach($infos as $info){
$admin_name = !empty($info['nickname']) ?$info['nickname'] : $info['realname'];
;echo '<option value="';echo $admin_name;;echo '" ';if ($_GET['adminname']==$admin_name){;echo 'selected';};echo '>';echo $admin_name;;echo '</option>
	';}};echo '<option value="0">不限</option></select>
		  <input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			 <th width="16"><input type="checkbox" value="" id="check_box" onclick="selectall(\'ids[]\');"></th>
            <th width="37">';echo L('listorder');;echo '</th>
            <th width="40">ID</th>
			<th>';echo L('title');;echo '</th>
            <th width="40">';echo L('hits');;echo '</th>
            <th width="70">';echo L('publish_user');;echo '</th>
            <th width="118">';echo L('updatetime');;echo '</th>
			<th width="72">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
<tbody>
    ';
if(is_array($datas)) {
$sitelist = getcache('sitelist','commons');
$release_siteurl = $sitelist[$category['siteid']]['url'];
$path_len = -strlen(WEB_PATH);
$release_siteurl = substr($release_siteurl,0,$path_len);
$this->hits_db = h5_base::load_model('hits_model');
foreach ($datas as $r) {
$hits_r = $this->hits_db->get_one(array('hitsid'=>'c-'.$modelid.'-'.$r['id']));
;echo '        <tr>
		<td align="center"><input class="inputcheckbox " name="ids[]" value="';echo $r['id'];;echo '" type="checkbox"></td>
        <td align=\'center\'><input name=\'listorders[';echo $r['id'];;echo ']\' type=\'text\' size=\'3\' value=\'';echo $r['listorder'];;echo '\' class=\'input-text-c\'></td>
		<td align=\'center\' >';echo $r['id'];;echo '</td>
		<td>
		';
if(strpos($r['url'],'http://')!==false) {
echo '<a href="'.$r['url'].'" target="_blank">';
}else {
echo '<a href="'.$release_siteurl.$r['url'].'" target="_blank">';
};echo '<span';echo title_style($r['style']);echo '>';echo $r['title'];;echo '</span></a> ';if($r['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif" title="'.L('thumb').'">';}if($r['posids']) {echo '<img src="'.IMG_PATH.'icon/small_elite.gif" title="'.L('elite').'">';}if($r['islink']) {echo ' <img src="'.IMG_PATH.'icon/link.png" title="'.L('islink_url').'">';};echo '</td>
		<td align=\'center\' title="';echo L('today_hits');;echo '：';echo $hits_r['dayviews'];;echo '&#10;';echo L('yestoday_hits');;echo '：';echo $hits_r['yestodayviews'];;echo '&#10;';echo L('week_hits');;echo '：';echo $hits_r['weekviews'];;echo '&#10;';echo L('month_hits');;echo '：';echo $hits_r['monthviews'];;echo '">';echo $hits_r['views'];;echo '</td>
		<td align=\'center\'>
		';
if($r['sysadd']==0) {
echo "<a href='?s=member/member/memberinfo/username/".urlencode($r['username'])."/h5_hash/".$_SESSION['h5_hash']."' >".$r['username']."</a>";
echo '<img src="'.IMG_PATH.'icon/contribute.png" title="'.L('member_contribute').'">';
}else {
echo $r['username'];
}
;echo '</td>
		<td align=\'center\'>';echo format::date($r['updatetime'],1);;echo '</td>
		<td align=\'center\'><a href="javascript:;" onclick="javascript:openwinx(\'?s=content/content/edit/catid/';echo $catid;;echo '/id/';echo $r['id'];echo '\',\'\')">';echo L('edit');;echo '</a> | <a href="javascript:view_comment(\'';echo id_encode('content_'.$catid,$r['id'],$this->siteid);;echo '\',\'';echo safe_replace($r['title']);;echo '\')">';echo L('comment');;echo '</a></td>
	</tr>
     ';}
}
;echo '</tbody>
     </table>
    <div class="btn"><label for="check_box">';echo L('selected_all');;echo '/';echo L('cancel');;echo '</label>
		<input type="hidden" value="';echo $h5_hash;;echo '" name="h5_hash">
    	<input type="button" class="button" value="';echo L('listorder');;echo '" onclick="myform.action=\'?s=content/content/listorder/dosubmit/1/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '\';myform.submit();"/>
		';if($category['content_ishtml']) {;echo '		<input type="button" class="button" value="';echo L('createhtml');;echo '" onclick="myform.action=\'?s=content/create_html/batch_show/dosubmit/1/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '\';myform.submit();"/>
		';};echo '		<input type="button" class="button" value="';echo L('delete');;echo '" onclick="myform.action=\'?s=content/content/delete/dosubmit/1/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '\';return confirm_delete()"/>
		';if(!isset($_GET['reject'])) {;echo '		<input type="button" class="button" value="';echo L('push');;echo '" onclick="push();"/>
		';if($workflow_menu) {;echo '<input type="button" class="button" value="';echo L('reject');;echo '" onclick="reject_check()"/>
		<div id=\'reject_content\' style=\'background-color: #fff;border:#006699 solid 1px;position:absolute;z-index:10;padding:1px;display:none;\'>
		<table cellpadding=\'0\' cellspacing=\'1\' border=\'0\'><tr><tr><td colspan=\'2\'><textarea name=\'reject_c\' id=\'reject_c\' style=\'width:300px;height:46px;\'  onfocus="if(this.value == this.defaultValue) this.value = \'\'" onblur="if(this.value.replace(\' \',\'\') == \'\') this.value = this.defaultValue;">';echo L('reject_msg');;echo '</textarea></td><td><input type=\'button\' value=\' ';echo L('submit');;echo ' \' class="button" onclick="reject_check(1)"></td></tr>
		</table>
		</div>
		';}};echo '		<input type="button" class="button" value="';echo L('remove');;echo '" onclick="myform.action=\'?s=content/content/remove/catid/';echo $catid;;echo '\';myform.submit();"/>
		';echo runhook('admin_content_init');echo '	</div>
    <div id="pages">';echo $pages;;echo '</div>
</div>
</form>
</div>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'cookie.js"></script>
<script type="text/javascript"> 
<!--
function push() {
	var str = 0;
	var id = tag = \'\';
	$("input[name=\'ids[]\']").each(function() {
		if($(this).attr(\'checked\')==true) {
			str = 1;
			id += tag+$(this).val();
			tag = \'|\';
		}
	});
	if(str==0) {
		alert(\'';echo L('you_do_not_check');;echo '\');
		return false;
	}
	window.top.art.dialog({id:\'push\'}).close();
	window.top.art.dialog({title:\'';echo L('push');;echo '：\',id:\'push\',iframe:\'?s=content/push/action/position_list/catid/';echo $catid;echo '/modelid/';echo $modelid;echo '/id/\'+id,width:\'800\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'push\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'push\'}).close()});
}
function confirm_delete(){
	if(confirm(\'';echo L('confirm_delete',array('message'=>L('selected')));;echo '\')) $(\'#myform\').submit();
}
function view_comment(id, name) {
	window.top.art.dialog({id:\'view_comment\'}).close();
	window.top.art.dialog({yesText:\'';echo L('dialog_close');;echo '\',title:\'';echo L('view_comment');;echo '：\'+name,id:\'view_comment\',iframe:\'index.php?s=comment/comment_admin/lists/show_center_id/1/commentid/\'+id,width:\'800\',height:\'500\'}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function reject_check(type) {
	if(type==1) {
		var str = 0;
		$("input[name=\'ids[]\']").each(function() {
			if($(this).attr(\'checked\')==true) {
				str = 1;
			}
		});
		if(str==0) {
			alert(\'';echo L('you_do_not_check');;echo '\');
			return false;
		}
		document.getElementById(\'myform\').action=\'?s=content/content/pass/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '/reject/1\';
		document.getElementById(\'myform\').submit();
	} else {
		$(\'#reject_content\').css(\'display\',\'\');
		return false;
	}	
}
setcookie(\'refersh_time\', 0);
function refersh_window() {
	var refersh_time = getcookie(\'refersh_time\');
	if(refersh_time==1) {
		window.location.reload();
	}
}
setInterval("refersh_window()", 3000);
//-->
</script>
</body>
</html>';?>