<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<br />
<div class="pad-lr-10">
<div id="searchid" style="display:">
<form name="searchform" action="" method="get" >
<input type="hidden" value="special/special/public_get_pics" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
 			';echo $model_form;echo '&nbsp;&nbsp; 
<span id="catids"></span>&nbsp;&nbsp; <span id="title" style="display:none;">';echo L('title');echo '£º<input type="text" name="title" size="20"></span>
				';echo L('input_time');echo '£º
				';$start_f = $_GET['start_time'] ?$_GET['start_time'] : format::date(SYS_TIME-2592000);$end_f = $_GET['end_time'] ?$_GET['end_time'] : format::date(SYS_TIME+86400);;echo '				';echo form::date('start_time',$start_f,1);echo ' - ';echo form::date('end_time',$end_f,1);echo '				 <input type="submit" name="search" class="button" value="';echo L('search');echo '" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			<th>';echo L('content_title');echo '</th>
			</tr>
        </thead>
<tbody>
    ';if(is_array($data)) {foreach ($data as $r) {;echo '        <tr>
		<td><label style="display:block"><input type="radio" onclick="choosed(';echo $r['id'];echo ', ';echo $r['catid'];echo ', \'';echo $r['title'];echo '\')" class="inputcheckbox " name=\'ids\' value="';echo $r['id'];;echo '">		  ';echo $r['title'];;echo '</label></td>
		</tr>
     ';}};echo '</tbody>
     </table>
    <div class="btn"> <input type="hidden" name="msg_id" id="msg_id"> </div>
    <div id="pages">';echo $pages;;echo '</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">

	function choosed(contentid, catid, title) {
		var msg = contentid+\'|\'+catid+\'|\'+title;
		$(\'#msg_id\').val(msg);
	}

	function select_categorys(modelid, id) {
		if(modelid) {
			$.get(\'\', {s: \'special/special/public_categorys_list\', modelid: modelid, catid: id, h5_hash: h5_hash }, function(data){
				if(data) {
					$(\'#catids\').html(data);
					$(\'#title\').show();
				} else {
					$(\'#catids\').html(\'\');
					$(\'#title\').hide();
				}
			});
		}
	}
	select_categorys(';echo $_GET['modelid'];echo ', ';echo $_GET['catid'];echo ');
	$(document).ready(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'220\',height:\'70\'}, function(){this.close();$(obj).focus();})}});
		$("#typeid").formValidator({tipid:"msg_id",onshow:"';echo L('please_choose_type');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:1,onerror:"';echo L('please_choose_type');echo '"});	
	});
	$("#myform").submit(function (){
		var str = 0;
		$("input[name=\'ids[]\']").each(function() {
			if($(this).attr(\'checked\')==true) str = 1;
		});
		if(str==0) {
			alert(\'';echo L('choose_news');echo '\');
			return false;
		}
		return true;
	});
</script>';?>