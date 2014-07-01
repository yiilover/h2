$(function() {
	$("#changeinfo").click(function() {
		if ($(this).is(':checked')) {
			$('.remarks').show();
		} else {
			$('.remarks').hide();
		}
	})	
	$("#areaid").change( function() {
		var areaid = $(this).val();
		  $.ajax({
			  type:'GET',
			  url:SiteUrl + "ajax/circle",
			  data:{'areaid':areaid},
			  success:function(response){
				  if(response){
					  $('#circleid').remove();
					  $('#areaid').after(response);
				  }
			  }
		  })
	})
	$("#areaid_com").change( function() {
		var areaid = $(this).val();
		  $.ajax({
			  type:'GET',
			  url:SiteUrl + "api.php?op=circlecom",
			  data:{'areaid':areaid},
			  success:function(response){
				  if(response){
					  $('#circleid_com').remove();
					  $('#areaid_com').after(response);
				  }
			  }
		  })
	})
	$("#areaid_office").change( function() {
		var areaid = $(this).val();
		  $.ajax({
			  type:'GET',
			  url:SiteUrl + "ajax/circleoffice",
			  data:{'areaid':areaid},
			  success:function(response){
				  if(response){
					  $('#circleid_office').remove();
					  $('#areaid_office').after(response);
				  }
			  }
		  })
	})
	$('#pic').click(function(){
		if($(this).attr('checked') == 'checked'){
			$('#dosubmit').val("保存并上传房源照片");
			$('#dosubmit').addClass("putout_step_1")
			$('#dosubmit').removeClass("putout_step_1a");
		}else{
			$('#dosubmit').val("保存房源");
			$('#dosubmit').addClass("putout_step_1a")
			$('#dosubmit').removeClass("putout_step_1");
		}
	})
	$('#mapLngLat').click(function(){
		art.dialog.open(PubUrl + 'ajax/bmap',
				{title: '地图标注', width: 684, height: 330});
	})

})
function CheckAll(value) {
	var boxes = document.getElementsByTagName("input");
	for ( var i = 0; i < boxes.length; i++) {
		if (boxes[i].type == 'checkbox' && boxes[i].id != 'changeinfo') {
			boxes[i].checked = value;
		}
	}
}
function addTag(hid, housetype){
	if($("input[name='tag']:checked").val()==null){
		alert('还没有选择标签');
	}else{
		var type = $("input[name='tag']:checked").val();
		$.post(SiteUrl + 'ajax/addtag?action=addtag', {'hid':hid,'type':type,'housetype':housetype},
		function(data)
		  {
			var msg = data.split('|');
			if(msg[0]=="success"){
				window.location.reload();
			}else{
				alert(msg[1]);
			}
		  }
		);
	}
};
function delTag(hid, type, housetype){
	if(confirm("确定要取消该标签？")){
		$.post(SiteUrl + 'ajax/addtag?action=deltag', {'hid':hid, 'type':type, 'housetype':housetype},
		function(data)
		  {
			var msg = data.split('|');
			if(msg[0]=="success"){
				window.location.reload();
			}else{
				alert(msg[1]);
			}
		  }
		);
	}
};
function cron_confirm(){
	var str = 0;
	var cron = 0;
	$("input[class='hid']").each(function() {
		if($(this).attr('checked')=='checked') {
			if($(this).attr('id')== "cron"){
				str = 1;
				cron = 1;
			}else{
				str = 1;
			}
		}
	});
	if(str==0) {
		alert('您还没有勾选任何房源信息项!');
		return false;
	}
	if(cron==1) {
		alert('取消定时刷新后操作!');
		return false;
	}
	return true;
}
function del_confirm(){
	var str = 0;
	var cron = 0;
	$("input[class='hid']").each(function() {
		if($(this).attr('checked')=='checked') {
			if($(this).attr('id')== "cron"){
				str = 1;
				cron = 1;
			}else{
				str = 1;
			}
		}
	});
	if(str==0) {
		alert('您还没有勾选任何房源信息项!');
		return false;
	}
	if(confirm('删除的房源无法恢复,确认删除吗？')) {
		var form = document.getElementById('dodel');
		return true;
	}
	return false;
}
function del_commission(){
	var str = 0;
	var cron = 0;
	$("input[class='eid']").each(function() {
		if($(this).attr('checked')=='checked') {
			if($(this).attr('id')== "cron"){
				str = 1;
				cron = 1;
			}else{
				str = 1;
			}
		}
	});
	if(str==0) {
		alert('您还没有勾选任何房源信息项!');
		return false;
	}
	if(confirm('删除的房源无法恢复,确认删除吗？')) {
		return true;
	}
	return false;
}
function op_confirm(){
	var str = 0;
	var cron = 0;
	$("input[class='hid']").each(function() {
		if($(this).attr('checked')=='checked') {
			if($(this).attr('id')== "cron"){
				cron = 1;
			}
			str = 1;
		}
	});
	if(str==0) {
		alert('您还没有勾选任何房源信息项!');
		return false;
	}
	if(cron==1) {
		alert('取消定时刷新后操作!');
		return false;
	}
	
	return true;
}
function updatesell(hid, action) {
	if(hid == '' || hid <= 0) {
		alert('刷新数据不正确!');
		return false;
	}
	if($('input[name^= hid]').attr('id') == 'cron'){
		alert('取消定时刷新后操作!');
		return false;
	}
	$.post(SiteUrl + "process/doupdate", {'hid': hid, 'action': action, 'doupdate': true}, function(data){
		if(data == 1) {
			alert('刷新成功!');
			$('#update_' + hid).html('今日已刷新');
		} else if(data == 2) {
			alert('操作失败,原因：更新次数已用完!');
		} else {
			alert('操作失败,刷新数据不正确!');
		}
	});
}