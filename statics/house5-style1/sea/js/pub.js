$(function() {
	
	$("#usertel").focus(function(){
		$("#send_code_bt").hide();
	});
	
	/*���ݷ�Դ����ƥ���*/
	$('#renthouse_' + pubhousetype).attr("checked","checked");
	var theval = $("input[name=renthouse]:checked").val();
	$('.form_element').hide();
	$('.house' + theval).show();
	//ˢ�´���
	if(theval == 3 || theval == 4){
		$(".com_office").html("¥��");
		$("#btnAddCommunity").val("�����¥��");
	}else if(theval == 1 || theval == 2){
		$(".com_office").html("С��");
		$("#btnAddCommunity").val("�����С��");
	}
/*	
	$('input[name=renthouse]').click(function(){
		var val = $(this).val();
		var gotoaction = '';
		var gototype = '';
		if(pubaction == "rent"){
			gotoaction = "chuzu";
			gototype = val == 2 ? "ershoufang" : (val == 4 ? "xiezilou" : "shangpu");
		}
		if(pubaction == "sell"){
			gotoaction = "chushou";
			gototype = val == 1 ? "ershoufang" : (val == 3 ? "xiezilou" : "shangpu");
		}
		document.getElementById("myform").reset(); //������
		window.location.href = PubUrl + gotoaction + "/" + gototype + "/";		
	})
*/

	/*���ⷽʽ �����*/
	if(parseInt($('[id^=renttype_]:checked').val()) == 2){
		$('#roomhouse').show();
		$('#limitsex').show();
	}else{
		$('#roomhouse').hide();
		$('#limitsex').hide();
	}
	if(parseInt($('[id^=renttype_]:checked').val()) == 3){
			$("#rentprice_unit").html("Ԫ/��");
	}
	$('[id^=renttype_]').click(function(){
		if(parseInt($(this).val()) == 2){
			$('#roomhouse').show();
			$('#limitsex').show();
		}else{
			$('input[name=roomtype]:checked').removeAttr('checked');
			$('input[name=limitsex]:checked').removeAttr('checked');
			$('#roomhouse').hide();
			$('#limitsex').hide();
		}
		if(parseInt($(this).val()) == 3){
			$("#rentprice_unit").html("Ԫ/��");
		}else{
			$("#rentprice_unit").html("Ԫ/��");
		}
	})
	
	/*ֻ���ַ��г������ͺͻ���*/
	if(parseInt($('input[name=propertytype]:checked').val()) == 2){
		$("#is_renttype,#room_type").show();
		if(parseInt($('input[name=renttype]:checked').val()) == 2){
			$('#roomhouse').show();
			$('#limitsex').show();
		}else{
			$('#roomhouse').hide();
			$('#limitsex').hide();
		}
		if(parseInt($('input[name=renttype]:checked').val()) == 3){
				$("#rentprice_unit").html("Ԫ/��");
		}
	}else{
		$(".only_esf").hide();
		$("#rentprice_unit").html("Ԫ/��");
	}
	$('input[name=propertytype]').click(function(){
		if(parseInt($(this).val()) == 2){
			$("#is_renttype,#room_type").show();
			if(parseInt($('input[name=renttype]:checked').val()) == 2){
				$('#roomhouse').show();
				$('#limitsex').show();
			}else{
				$('#roomhouse').hide();
				$('#limitsex').hide();
			}
			if(parseInt($('input[name=renttype]:checked').val()) == 3){
				$("#rentprice_unit").html("Ԫ/��");
			}
		}else{
			$(".only_esf").hide();
			$("#rentprice_unit").html("Ԫ/��");
		}
	})
	
	$('#area_select_bt').click(function(){
		$('.selUlA').toggle().end();
	});
	
	$('#circle_select_bt').click(function(){
		$('.selUlB').toggle().end();
	});
	
	$(".area_select").click(function(){
		var old_name = $("#shop_areaname").html();
		var thepid = $(this).attr("thepid");
		var thename = $(this).attr("thename");
		$("#shop_areaname").html(thename);
		$("#shop_areaid").val(thepid);
		$(".selUlA").hide();
		$.getJSON(PubUrl + "ajax/circlelist/areaid/"+thepid, function(data){
			if(data.status){
				  var circle_html="";
				  $.each(data.data, function(i,item){
						circle_html += '<li><a href="javascript:void(0)" class="circle_select" thepid="'+item.pid+'" thename="'+item.name+'" >'+item.name+'</a></li>';
				  });
				  $(".selUlB").html(circle_html);
			}
		});
		if(old_name != thename){
			$("#shop_circlename").html("��Ȧ");
			$("#shop_circleid").val("");
		}
	});
	
	//��ǰ��ҵ
	$('#cur_industry_select').click(function(){
		$('.select_cur').toggle().end();
	});
	$("#cur_name").html("��ѡ��");
	$("#businessindustry").val("");
	$(".industry_select").click(function(){
		var old_name = $("#cur_name").html();
		var thepid = $(this).attr("thepid");
		var thename = $(this).attr("thename");
		$("#cur_name").html(thename);
		$("#businessindustry").val(thepid);
		$(".select_cur").hide();
	});
	

	$(".circle_select").live('click',function(){
		var thepid = $(this).attr("thepid");
		var thename = $(this).attr("thename");
		$("#shop_circlename").html(thename);
		$("#shop_circleid").val(thepid);
		$(".selUlB").hide();
	});
	
})


//��֤�ֻ�����
function send_telcode() {
var tel_val =  $('#usertel').val();
	var tel_right = false;
	var objvar = jQuery.trim(tel_val);
    if (objvar == "") {
		alert("�ֻ����벻��Ϊ��");
        return false;
    }else{
		if(housetype == 2 || housetype == 4 || housetype == 6){
			tel_right = rent.isusertel;
		}else if(housetype == 1 || housetype == 3 || housetype == 5){
			tel_right = sell.isusertel;
		}else if(housetype == 7){
			tel_right = hire.isusertel;
		}else if(housetype == 8){
			tel_right = buy.isusertel;
		}
		if(tel_right){
			jQuery.ajax({
				type: "post",
				async: false,
				url: PubUrl + "ajax/mobile",
				data: {"mobile": objvar},
				success: function(data) {
					if (data == "true") {
						$("#send_telcode_bt").attr("disabled", true);
						updateTimeLabel(119);
					}else {
						alert("��ȡ��֤��ʧ��");
					}
				}
			});
		}
	}
}


function updateTimeLabel(time) {
    var btn = jQuery("#send_telcode_bt");
    btn.val(time <= 0 ? "��ѻ�ȡ��֤��" : ("" + (time) + "��������·���"));
    var hander = setInterval(function() {
        if (time <= 0) {
            clearInterval(hander);
            hander = null;
            btn.val("��ѻ�ȡ��֤��");
            btn.attr("disabled", false);
        }
        else {
            btn.attr("disabled", true);
            btn.val("" + (time--) + "��������·���");
        }
    }, 1000);
}