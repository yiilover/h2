jQuery(document).ready(function() {
	//С��
	jQuery('#villagename').focus(function(){
		esf.ShowWrong(this, "����дС��������", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		esf.checkVillageName(this);
		
	})
	//��������
	jQuery('[id^=property_]').click(function(){
		esf.checkProperty(this);
		
	})
	//���¥��
	jQuery('input[name$=floor]').focus(function(){
		esf.ShowWrong('#floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		esf.check_floor(this);
		
	})
	jQuery('input[name=totalfloor]').blur(function(){
		esf.check_floor_again(this);
		
	})
	//�������
	jQuery('#buildarea').focus(function(){
		esf.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		esf.check_buildarea(this);
		
	})
	//������
	jQuery('input[name=room]').focus(function(){
		esf.ShowWrong('#room', "����д���͵ľ���", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		esf.checkRoom(this);
		
	})	
	//�۸�
	jQuery('#price').focus(function(){
		esf.ShowWrong(this, "����д�۸�", "plus_d");
	})
	jQuery('#price').blur(function(){
		esf.check_price(this);
		
	})
	//װ�����
	jQuery('input[name=decorate]').click(function(){
		esf.check_decorate(this);
		
	})
	//���ݳ���
	jQuery('input[name=aspect]').click(function(){
		esf.check_aspect(this);
		
	})
	//����
	/*jQuery('#houseage').focus(function(){
		esf.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		esf.check_houseage(this);
	})*/
	//��Դ����
	jQuery('#title').focus(function(){
		esf.ShowWrong(this, "����д��Դ����", "plus_d");
	})
	jQuery('#title').blur(function(){
		
		esf.check_title(this);
	})
	//�ύ
	jQuery("#dosubmit").click(function() {
		if (esf.check()) {
			$("#postsubmit").css('display',"block").attr("disabled",true);											 
			$('#dosubmit').css('display',"none");
			jQuery("#myform").submit();
		}
	});
});