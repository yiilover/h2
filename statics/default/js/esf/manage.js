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
			$('#dosubmit').val("���沢�ϴ���Դ��Ƭ");
			$('#dosubmit').addClass("putout_step_1")
			$('#dosubmit').removeClass("putout_step_1a");
		}else{
			$('#dosubmit').val("���淿Դ");
			$('#dosubmit').addClass("putout_step_1a")
			$('#dosubmit').removeClass("putout_step_1");
		}
	})
	$('#mapLngLat').click(function(){
		art.dialog.open(PubUrl + 'ajax/bmap',
				{title: '��ͼ��ע', width: 684, height: 330});
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
		alert('��û��ѡ���ǩ');
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
	if(confirm("ȷ��Ҫȡ���ñ�ǩ��")){
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
		alert('����û�й�ѡ�κη�Դ��Ϣ��!');
		return false;
	}
	if(cron==1) {
		alert('ȡ����ʱˢ�º����!');
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
		alert('����û�й�ѡ�κη�Դ��Ϣ��!');
		return false;
	}
	if(confirm('ɾ���ķ�Դ�޷��ָ�,ȷ��ɾ����')) {
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
		alert('����û�й�ѡ�κη�Դ��Ϣ��!');
		return false;
	}
	if(confirm('ɾ���ķ�Դ�޷��ָ�,ȷ��ɾ����')) {
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
		alert('����û�й�ѡ�κη�Դ��Ϣ��!');
		return false;
	}
	if(cron==1) {
		alert('ȡ����ʱˢ�º����!');
		return false;
	}
	
	return true;
}
function updatesell(hid, action) {
	if(hid == '' || hid <= 0) {
		alert('ˢ�����ݲ���ȷ!');
		return false;
	}
	if($('input[name^= hid]').attr('id') == 'cron'){
		alert('ȡ����ʱˢ�º����!');
		return false;
	}
	$.post(SiteUrl + "process/doupdate", {'hid': hid, 'action': action, 'doupdate': true}, function(data){
		if(data == 1) {
			alert('ˢ�³ɹ�!');
			$('#update_' + hid).html('������ˢ��');
		} else if(data == 2) {
			alert('����ʧ��,ԭ�򣺸��´���������!');
		} else {
			alert('����ʧ��,ˢ�����ݲ���ȷ!');
		}
	});
}