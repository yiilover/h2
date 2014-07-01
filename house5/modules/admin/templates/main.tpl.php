<?php

defined('IN_ADMIN') or exit('No permission resources.');
include H5_PATH.'modules'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'header.tpl.php';
;echo '<div id="main_frameid" class="pad-10 display" style="_margin-right:-12px;_width:98.9%;">
<script type="text/javascript">
$(function(){if ($.browser.msie && parseInt($.browser.version) < 7) $(\'#browserVersionAlert\').show();}); 
</script>
<div class="explain-col mb10" style="display:none" id="browserVersionAlert">
';echo L('ie8_tip');echo '</div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>';echo L('personal_information');echo '</h6>
	<div class="content">
	';echo L('main_hello');echo '';echo $admin_username;echo '<br />
	';echo L('main_role');echo '';echo $rolename;echo ' <br />
	<div class="bk20 hr"><hr /></div>
	';echo L('main_last_logintime');echo '';echo date('Y-m-d H:i:s',$logintime);echo '<br />
	';echo L('main_last_loginip');echo '';echo $loginip;echo ' <br />
	</div>
</div>
<div class="col-2 col-auto">
	<h6>提醒</h6>
	<div class="content">
	';if($this->get_siteid()==1)
{
;echo '<table width="98%" class="table-list" cellspacing="1" cellpadding="0">
  <tr>
    <td>类型</td>
    <td>昨日</td>
    <td>本周</td>
    <td>本月</td>
  </tr>
  <tr>
    <td><A href="?s=content/content/init&menuid=822&catid=15&h5_hash=';echo $_SESSION['h5_hash'];;echo '">问房</A></td>
    <td>';echo count_wenfang_nums('15','1','0');;echo '(';echo count_wenfang_nums('15','1','1');;echo ')</td>
    <td>';echo count_wenfang_nums('15','2','0');;echo '(';echo count_wenfang_nums('15','2','1');;echo ')</td>
    <td>';echo count_wenfang_nums('15','3','0');;echo '(';echo count_wenfang_nums('15','3','1');;echo ')</td>
  </tr>
  <tr>
    <td><A href="?s=formguide/formguide_info/init&formid=17&menuid=1546&h5_hash=';echo $_SESSION['h5_hash'];;echo '">团购报名</a></td>
	<td>';echo count_tuangouinfo_nums('17','1','0');;echo '</td>
	<td>';echo count_tuangouinfo_nums('17','2','0');;echo '</td>
    <td>';echo count_tuangouinfo_nums('17','3','0');;echo '</td>
  </tr>
</table>';}else{;echo '';if($rolename=="超级管理员") {;echo '';if($h5_writeable) {;echo '	
';echo L('main_safety_permissions');echo '<br />
';};echo '';if(h5_base::load_config('system','debug')) {;echo '';echo L('main_safety_debug');echo '<br />
';};echo '';if(!h5_base::load_config('system','errorlog')) {;echo '';echo L('main_safety_errlog');echo '<br />
';};echo '	<div class="bk20 hr"><hr /></div>	
';if(h5_base::load_config('system','execution_sql')) {;echo '	
';echo L('main_safety_sql');echo ' <br />
';};echo '';if($logsize_warning) {;echo '	
';echo L('main_safety_log',array('size'=>$common_cache['errorlog_size'].'MB'));echo ' <br />
';};echo '';
$tpl_edit = h5_base::load_config('system','tpl_edit');
if($tpl_edit=='1') {;echo '';echo L('main_safety_tpledit');echo '<br />
';}}};echo '	</div>
</div>
<div class="bk10"></div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>';echo L('main_license');echo '</h6>
	<div class="content">
	';echo L('main_version');echo 'House5 ';echo h5_VERSION;echo '  Release ';echo h5_RELEASE;echo ' [<a href="http://www.house5.net" target="_blank">';echo L('main_support');echo '</a>]<br />
	';echo L('main_license_type');echo '<span id="house5_license"></span> <br />
	';echo L('main_serial_number');echo '<span id="house5_sn"></span> <br />
	</div>
</div>
<div class="col-2 col-auto">
	<h6>信息统计</h6>
	<div class="content">
	';if($this->get_siteid()==1){
if($rolename=="超级管理员") {;echo '<TABLE class="table-list" cellpadding="3" cellspacing="1" width="98%">
<tr>
	<td>考核人员</td>
    <td align="center">昨日<br>发稿量（点击量）</td>
    <td align="center">本周<br>发稿量（点击量）</td>
    <td align="center">本月<br>发稿量（点击量）</td>
  </tr>
  ';
$this->admin_db = h5_base::load_model('admin_model');
$infos = $this->admin_db->listinfo("disabled='0'",'',$page,20);
if(is_array($infos)){
foreach($infos as $info){
$adminname = !empty($info['nickname']) ?$info['nickname'] : $info['realname'];
;echo '  <tr>
    <td>';echo $adminname;;echo '</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&yesterday=1&adminname=';echo $adminname;;echo '&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','1',$adminname);;echo '</a>（';echo count_info_hits('6','1',$adminname);;echo '）</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&week=1&adminname=';echo $adminname;;echo '&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','2',$adminname);;echo '</a>（';echo count_info_hits('6','2',$adminname);;echo '）</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&themonth=1&adminname=';echo $adminname;;echo '&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','3',$adminname);;echo '</a>（';echo count_info_hits('6','3',$adminname);;echo '）</td>
  </tr>
  ';}};echo '   <tr>
    <td>合计</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&yesterday=1&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','1',0);;echo '</A>（';echo count_info_hits('6','1',0);;echo '）</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&week=1&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','2',0);;echo '</A>（';echo count_info_hits('6','2',0);;echo '）</td>
    <td align="center"><A href="?s=content/assess/init&catid=6&themonth=1&dosubmit=1&h5_hash=';echo $_SESSION['h5_hash'];;echo '" title="查看详情">';echo count_info_nums('6','3',0);;echo '</A>（';echo count_info_hits('6','3',0);;echo '）</td>
  </tr>
</TABLE>
';}else{
$this->admin_db = h5_base::load_model('admin_model');
$r = $this->admin_db->get_one(array('username'=>$admin_username));
$adminname = !empty($r['nickname']) ?$r['nickname'] : $r['realname'];
;echo '<TABLE border="1" cellpadding="3" cellspacing="1" width="98%">
<TR>
	<TD>';echo $admin_username;;echo '</TD>
	<TD align="center">发稿量</TD>
	<TD align="center">点击量</TD>
</TR>
<TR>
	<TD align="center">本月</TD>
	<TD align="center">';echo count_info_nums('6','3',$adminname);;echo '</TD>
	<TD align="center">';echo count_info_hits('6','3',$adminname);;echo '</TD>
</TR>
<TR>
	<TD align="center">本周</TD>
	<TD align="center">';echo count_info_nums('6','2',$adminname);;echo '</TD>
	<TD align="center">';echo count_info_hits('6','2',$adminname);;echo '</TD>
</TR>
<TR>
	<TD align="center">昨日</TD>
	<TD align="center">';echo count_info_nums('6','1',$adminname);;echo '</TD>
	<TD align="center">';echo count_info_hits('6','1',$adminname);;echo '</TD>
</TR>
</TABLE>
';}}else{;echo '	';echo L('main_version');echo 'House5 ';echo h5_VERSION;echo '  Release ';echo h5_RELEASE;echo ' [<a href="http://www.house5.net" target="_blank">';echo L('main_latest_version');echo '</a>]<br />
	';echo L('main_os');echo '';echo $sysinfo['os'];echo ' <br />
	';echo L('main_web_server');echo '';echo $sysinfo['web_server'];echo ' <br />
	';echo L('main_sql_version');echo '';echo $sysinfo['mysqlv'];echo '<br />
	';echo L('main_upload_limit');echo '';echo $sysinfo['fileupload'];echo '<br />
	';};echo '	</div>
</div>
<div class="bk10"></div>
</div>
</body></html>';?>