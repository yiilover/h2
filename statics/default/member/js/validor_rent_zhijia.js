jQuery(document).ready(function() {
	//С��
	jQuery('#villagename').focus(function(){
		rent.ShowWrong(this, "����дС��������", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		rent.checkVillageName(this);
	})
	//�Ƿ����
	if($('input[name=renttype]:checked').val() == 3){
		$('#price_unit').html('Ԫ/��');
		$('input[name=paytype]').val('');
		$('input[name=paytype2]').val('');
		$('#pay_layer').hide();
		rent.ispaytype = true;
		rent.ispaytype2 = true;
	}else{
		$('#price_unit').html('Ԫ/��');
		$('#pay_layer').show();
		rent.ispaytype = false;
		rent.ispaytype2 = false;
	}
	jQuery('input[name=renttype]').click(function(){
		rent.check_rent(this);		
	})
	//Ѻ����
	jQuery('input[name=paytype]').focus(function(){
		rent.ShowWrong('#paytype', '����дѺ��', 'plus_d');
	})
	jQuery('input[name=paytype]').blur(function(){
		rent.check_paytype(this);
	})
	jQuery('input[name=paytype2]').focus(function(){
		rent.ShowWrong('#paytype', '����д���ʽ', 'plus_d');
	})
	jQuery('input[name=paytype2]').blur(function(){
		rent.check_paytype2(this);
	})
	//��������
	jQuery('[id^=property_]').click(function(){
		rent.checkProperty(this);
	})
	//���¥��
	jQuery('input[name$=floor]').focus(function(){
		rent.ShowWrong('#floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		rent.check_floor(this);
	})
	jQuery('input[name=totalfloor]').blur(function(){
		rent.check_floor_again(this);
	})
	//�������
	jQuery('#buildarea').focus(function(){
		rent.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		rent.check_buildarea(this);
	})
	//������
	jQuery('input[name=room]').focus(function(){
		rent.ShowWrong('#room', "����д���͵ľ���", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		rent.checkRoom(this);
	})
	//�۸�
	jQuery('#price').focus(function(){
		rent.ShowWrong(this, "����д�۸�", "plus_d");
	})
	jQuery('#price').blur(function(){
		rent.check_price(this);
	})
	//װ�����
	jQuery('input[name=decorate]').click(function(){
		rent.check_decorate(this);
	})
	//���ݳ���
	jQuery('input[name=aspect]').click(function(){
		rent.check_aspect(this);
	})
	//����
	/*jQuery('#houseage').focus(function(){
		rent.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		rent.check_houseage(this);
	})*/
	//��Դ����
	jQuery('#title').focus(function(){
		rent.ShowWrong(this, "����д��Դ����", "plus_d");
	})
	jQuery('#title').blur(function(){
		rent.check_title(this);
	})
	//�ύ
	jQuery("#dosubmit").click(function() {
		if (rent.check()) {
			$("#postsubmit").css('display',"block").attr("disabled",true);											 
			$('#dosubmit').css('display',"none");
			jQuery("#myform").submit();
		}
	});
});