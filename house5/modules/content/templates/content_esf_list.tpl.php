<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<div class="content-menu ib-a blue line-x">
<a href="?s=content/esf/init/catid/';echo $catid;;echo '/h5_hash/';echo $h5_hash;;echo '" ';if($steps==0 &&!isset($_GET['reject'])) echo 'class=on';;echo '><em>';echo L('check_passed');;echo '</em></a><span>|</span>
';echo $workflow_menu;;echo ' <a href="javascript:;" onclick="javascript:$(\'#searchid\').css(\'display\',\'\');"><em>';echo L('search');;echo '</em></a> |  <a href="?s=content/esf/init/catid/';echo $catid;;echo '/steps/1/h5_hash/';echo $h5_hash;;echo '" ';if(isset($_GET['steps'])&&($_GET['steps']=='1')){echo 'class=on';};echo '>未审核</a> | ';if($_GET[catid]=='112'){;echo '<a href="?s=content/esf/init/catid/';echo $catid;;echo '/house_status/1/h5_hash/';echo $h5_hash;;echo '" ';if(isset($_GET['house_status'])&&($_GET['house_status']=='1')) echo 'class=on';;echo '>出售</a>';};echo '';if($_GET[catid]=='113'){;echo '<a href="?s=content/esf/init/catid/';echo $catid;;echo '/house_status/1/h5_hash/';echo $h5_hash;;echo '" ';if(isset($_GET['house_status'])&&($_GET['house_status']=='1')) echo 'class=on';;echo '>出租</a>';};echo ' | <a href="?s=content/esf/init/catid/';echo $catid;;echo '/house_status/2/h5_hash/';echo $h5_hash;;echo '" ';if(isset($_GET['house_status'])&&($_GET['house_status']=='2')) echo 'class=on';;echo '>下架</a> | <a href="?s=content/esf/init/catid/';echo $catid;;echo '/house_status/4/h5_hash/';echo $h5_hash;;echo '" ';if(isset($_GET['house_status'])&&($_GET['house_status']=='4')) echo 'class=on';;echo '>已成交</a>
</div>
<div id="searchid" style="display:';if(!isset($_GET['search'])) echo 'none';;echo '">
<form name="searchform" action="" method="get" >
<input type="hidden" value="content/esf/init" name="s">
<input type="hidden" value="';echo $catid;;echo '" name="catid">
<input type="hidden" value="';echo $steps;;echo '" name="steps">
<input type="hidden" value="1" name="search">
<input type="hidden" value="';echo $h5_hash;;echo '" name="h5_hash">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
				';echo L('addtime');;echo '：
				';echo form::date('start_time',$_GET['start_time'],0,0,'false');;echo '- &nbsp;';echo form::date('end_time',$_GET['end_time'],0,0,'false');;echo '				
				<select name="posids"><option value=\'\' ';if($_GET['posids']=='') echo 'selected';;echo '>';echo L('all');;echo '</option>
				<option value="1" ';if($_GET['posids']==1) echo 'selected';;echo '>';echo L('elite');;echo '</option>
				<option value="2" ';if($_GET['posids']==2) echo 'selected';;echo '>';echo L('no_elite');;echo '</option>
				</select>				
				<select name="searchtype">
					<option value=\'0\' ';if($_GET['searchtype']==0) echo 'selected';;echo '>';echo L('title');;echo '</option>
					<option value=\'1\' ';if($_GET['searchtype']==1) echo 'selected';;echo '>';echo L('intro');;echo '</option>
					<option value=\'2\' ';if($_GET['searchtype']==2) echo 'selected';;echo '>';echo L('username');;echo '</option>
					<option value=\'3\' ';if($_GET['searchtype']==3) echo 'selected';;echo '>ID</option>
				</select>
				
				<input name="keyword" type="text" value="';if(isset($keyword)) echo $keyword;;echo '" class="input-text" />
				<input type="submit" name="search" class="button" value="';echo L('search');;echo '" />
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
			<th width="118">小区/房源标题</th>
            <th width="50">经纪人/房东</th>
			<th width="40">区域/类型</th>
            <th width="60">房源信息</th>
			<!-- <th width="10">点击量</th> -->
            <th width="20">状态</th>
            <th width="25">房源属性</th>
			<th width="20">楼层</th>
			<th width="20">发布人</th>
			<th width="20">更新时间</th>
			<th width="30">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
<tbody>
    ';
if(is_array($datas)) {
$sitelist = getcache('sitelist','commons');
$release_siteurl = $sitelist[$category['siteid']]['url'];
$path_len = -strlen(WEB_PATH);
$release_siteurl = substr($release_siteurl,0,$path_len);
foreach ($datas as $r) {
$menu_info = menu_info('3360',$r[region]);
$relation = get_relationxq($r['id'],$catid,110);
;echo '        <tr>
		<td align="center"><input class="inputcheckbox " name="ids[]" value="';echo $r['id'];;echo '" type="checkbox"></td>
		<td>';echo $relation['title'];;echo '<BR>
		';
if($status==99) {
if($_GET['catid']=='112') {
if(strpos($r['url'],'http://')!==false) {
echo '<a href="'.ESF_PATH.'show-'.$r['id'].'.html" target="_blank">';
}
}
elseif($_GET['catid']=='113') {
if(strpos($r['url'],'http://')!==false) {
echo '<a href="'.ESF_PATH.'rent-show-'.$r['id'].'.html" target="_blank">';
}
}
}else {
echo '<a href="javascript:;" onclick=\'window.open("?s=content/content/public_preview/steps/'.$steps.'/catid/'.$catid.'/id/'.$r['id'].'","manage")\'>';
};echo '<span';echo title_style($r['style']);echo '>';echo $r['title'];;echo '</span></a> ';if($r['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif" title="'.L('thumb').'">';}if($r['posids']) {echo '<img src="'.IMG_PATH.'icon/small_elite.gif" title="'.L('elite').'">';}if($r['islink']) {echo ' <img src="'.IMG_PATH.'icon/link.png" title="'.L('islink_url').'">';};echo '</td>
		<td align=\'center\' >';echo $r['username'];;echo '</td>
		<td align=\'center\' >';echo $menu_info[0];;echo '</td>
		<td align=\'center\' >';echo $r['huxingshi'];;echo '室';echo $r['huxingting'];;echo '厅';echo $r['huxingwei'];;echo '卫';echo $r['huxingyang'];;echo '阳</td>
		<td align=\'center\' >';if($r['status']=="99"){;echo '已审核';}else {;echo '<font color="red">未审核</font>';};echo '</td>
		<td align=\'center\' >';if($r['house_status']=="1"){if($r['catid']=='112'){;echo '出售';}elseif($r['catid']=="113"){;echo '出租';}};echo '		';if($r['house_status']=="2"){;echo '<font color="red">下架</font>';}if($r['house_status']=="4"){;echo '<font color="blue">已成交</font>';};echo '</td>
		<td align=\'center\' >';echo $r['floor'];;echo 'F/';echo $r['zonglouceng'];;echo 'F</td>
		<!-- <td align=\'center\' title="';echo L('today_hits');;echo '：';echo $hits_r['dayviews'];;echo '&#10;';echo L('yestoday_hits');;echo '：';echo $hits_r['yesterdayviews'];;echo '&#10;';echo L('week_hits');;echo '：';echo $hits_r['weekviews'];;echo '&#10;';echo L('month_hits');;echo '：';echo $hits_r['monthviews'];;echo '">';echo $hits_r['views'];;echo '</td> -->
		<td align=\'center\'>
		';
if($r['sysadd']==0) {
echo "<a href='?s=member/member/memberinfo/username/".urlencode($r['username'])."/h5_hash/".$_SESSION['h5_hash']."' >".$r['username']."</a>";
}else {
echo $r['username'];
}
;echo '</td>
		<td align=\'center\'>';echo format::date($r['updatetime'],1);;echo '</td>
		<td align=\'center\'>';
if($_GET['catid']=='112') {
if(strpos($r['url'],'http://')!==false) {
echo '<a href="'.ESF_PATH.'show-'.$r['id'].'.html" target="_blank">查看</a>';
}
}
elseif($_GET['catid']=='113') {
if(strpos($r['url'],'http://')!==false) {
echo '<a href="'.ESF_PATH.'rent-show-'.$r['id'].'.html" target="_blank">查看</a>';
}
};echo '</td>
	</tr>
     ';}
}
;echo '</tbody>
     </table>
    <div class="btn"><label for="check_box">';echo L('selected_all');;echo '/';echo L('cancel');;echo '</label>
		<input type="hidden" value="';echo $h5_hash;;echo '" name="h5_hash">
    	';if($status!=99) {;echo '		<input type="button" class="button" value="';echo L('passed_checked');;echo '" onclick="myform.action=\'?s=content/content/pass/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '\';myform.submit();"/>
		';};echo '		<input type="button" class="button" value="';echo L('delete');;echo '" onclick="myform.action=\'?s=content/content/delete/dosubmit/1/catid/';echo $catid;;echo '/steps/';echo $steps;;echo '\';return confirm_delete()"/>
		';if(!isset($_GET['reject'])) {;echo '		<input type="button" class="button" value="';echo L('push');;echo '" onclick="push();"/>
		';if($workflow_menu) {;echo '<input type="button" class="button" value="';echo L('reject');;echo '" onclick="reject_check()"/>
		<div id=\'reject_content\' style=\'background-color: #fff;border:#006699 solid 1px;position:absolute;z-index:10;padding:1px;display:none;\'>
		<table cellpadding=\'0\' cellspacing=\'1\' border=\'0\'><tr><tr><td colspan=\'2\'><textarea name=\'reject_c\' id=\'reject_c\' style=\'width:300px;height:46px;\'  onfocus="if(this.value == this.defaultValue) this.value = \'\'" onblur="if(this.value.replace(\' \',\'\') == \'\') this.value = this.defaultValue;">';echo L('reject_msg');;echo '</textarea></td><td><input type=\'button\' value=\' ';echo L('submit');;echo ' \' class="button" onclick="reject_check(1)"></td></tr>
		</table>
		</div>
		';}};echo '		';echo runhook('admin_content_init');echo '	</div>
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
	window.top.art.dialog({title:\'';echo L('push');;echo '：\',id:\'push\',iframe:\'?s=content/push/init/action/position_list/catid/';echo $catid;echo '/modelid/';echo $modelid;echo '/id/\'+id,width:\'800\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'push\'}).data.iframe;// 使用内置接口获取iframe对象
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