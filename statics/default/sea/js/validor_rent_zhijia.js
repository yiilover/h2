jQuery(document).ready(function() {
	//��������
	jQuery('input[name=renthouse]').click(function(){
		rent.checkRenthouse(this);
	})
	
	//С��
	jQuery('#villagename').focus(function(){
		rent.ShowWrong(this, "����дС��������", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		rent.checkVillageName(this);
	})
	
	//��������
	$(".area_select").click(function(){
		rent.check_area("#shop_areaid");
	});
	
	//�������
	jQuery('#buildarea').focus(function(){
		rent.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		rent.check_buildarea(this);
	})
	
	//�Ƿ����
	jQuery('[id^=renttype_]').click(function(){
		rent.check_rent(this);
	})
	
	//�۸�
	jQuery('#price').focus(function(){
		rent.ShowWrong(this, "����д�۸�", "plus_d");
	})
	jQuery('#price').blur(function(){
		rent.check_monthprice(this);
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
	
	//װ�����
	jQuery('input[name=decorate]').click(function(){
		rent.check_decorate(this);
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
	
	//¥������
	jQuery('input[name=floor]').click(function(){
		rent.check_floorarea(this);
	})
	
	//������
	jQuery('input[name=room]').focus(function(){
		rent.ShowWrong('#room', "����д���͵ľ���", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		rent.checkRoom(this);
	})
	//������
	jQuery('input[name=hall]').focus(function(){
		rent.ShowWrong('#room', "����д���͵Ŀ���", "plus_d");
	})
	jQuery('input[name=hall]').blur(function(){
		rent.checkHall(this);
	})
	//������
	jQuery('input[name=toilet]').focus(function(){
		rent.ShowWrong('#room', "����д���͵�������", "plus_d");
	})
	jQuery('input[name=toilet]').blur(function(){
		rent.checkToilet(this);
	})
	
	//���ݳ���
	jQuery('input[name=aspect]').click(function(){
		rent.check_aspect(this);
	})
	
	//����
	jQuery('#houseage').focus(function(){
		rent.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		rent.check_houseage(this);
	})
	
	//��Դ����
	jQuery('#title').focus(function(){
		rent.ShowWrong(this, "����д��Դ����", "plus_d");
	})
	jQuery('#title').blur(function(){
		rent.check_title(this);
	})
	
	//��ϵ��
	jQuery('#username').focus(function(){
		rent.ShowWrong(this, "��������ϵ��", "plus_d");
	})
	jQuery('#username').blur(function(){
		rent.checkUsername(this);
	})
	
	//��ϵ�绰
	jQuery('#usertel').focus(function(){ 
		rent.ShowWrong(this, "������ϵ�绰", "plus_d");
	})
	jQuery('#usertel').blur(function(){
		//rent.checkUsertel(this);
		check_mobile(this);
		if(rent.isusertel == true){
			$("#send_code_bt").show();
		}else{
			$("#send_code_bt").hide();
		}
	})
	
	//��֤��
	jQuery('#encode').focus(function(){
		rent.ShowWrong(this, "��������֤��", "plus_d");
	})
	jQuery('#encode').blur(function(){
		rent.checkEncode(this);
	})

	//��ҵ����
	jQuery('#propertyname').focus(function(){
		rent.ShowWrong(this, "��������ҵ����", "plus_d");
	})
	jQuery('#propertyname').blur(function(){
		rent.checkPropertyname(this);
	})
	
	//��������
	
	//���̵�ַ
	jQuery('#address').focus(function(){
		rent.ShowWrong(this, "����д�������ڵ�ַ!", "plus_d");
	})
	jQuery('#address').blur(function(){
		rent.check_address(this);
	})
	
	//��������
	jQuery('[id^=shoptype_]').click(function(){
		rent.check_shoptype(this);
	})
	
	//��ҵ�����
	jQuery('#manageprice').focus(function(){
		rent.ShowWrong(this, "����д��ҵ�����", "plus_d");
	})
	jQuery('#manageprice').blur(function(){
		rent.check_manageprice(this);
	})
	
	//���¥��->����
	jQuery('#1floor').focus(function(){
		rent.ShowWrong(this, "����д¥��", "plus_d");
	})
	jQuery('#1floor').blur(function(){
		rent.check_1floor(this);
	})
	//���¥��->����
	jQuery('#3totalfloor').focus(function(){
		rent.ShowWrong(this, "����д¥��", "plus_d");
	})
	jQuery('#3totalfloor').blur(function(){
		rent.check_3totalfloor(this);
	})
	//¥�� ���
	jQuery('input[name=2floor]').focus(function(){
		rent.ShowWrong('#2floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=2floor]').blur(function(){
		rent.check_2floor(this);
	})
	jQuery('input[name=2totalfloor]').focus(function(){
		rent.ShowWrong('#2floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=2totalfloor]').blur(function(){
		rent.check_2totalfloor(this);
	})
	

	//���̳�������
	jQuery('[id^=shoprenttype_]').click(function(){
		rent.check_shoprenttype(this);
	})
	
	//���� ת��
	jQuery('#transferfee').focus(function(){
		rent.ShowWrong(this, "����дת�÷�", "plus_d");
	})
	jQuery('#transferfee').blur(function(){
		if($('[id^=transfertype_]:checked').val() == 0){
			rent.check_istransferfee(this);
		}
	})
	
	//��ǰ״̬
	jQuery('[id^=businessstatus_]').click(function(){
		rent.check_businessstatus(this);
	})
	//��ǰ��ҵ
	jQuery('.industry_select').live("click",function(){
		rent.check_businessindustry('#businessindustry');
	})
	
	//�ύ
	jQuery("#dosubmit").click(function() {
		if (rent.check()) {
			jQuery("#myform").submit();
		}
		return false;
	});
});

//��֤�ֻ�����
function check_mobile(obj) {
	var objvar = val(obj);
	var reg_mobile = /^1[3458]\d{9}$/; //�ֻ�(13,15,18)
    if (!reg_mobile.test(objvar)){
		rent.ShowWrong(obj, "��������ȷ��ʽ���ֻ�����", "plus_c");
		rent.isusertel = false;
        return false;
    }else{
		rent.isusertel = true; //�û�����֤��ȷ
		rent.ShowWrong(jQuery("#usertel"), "", "pw_success");
    }
}

//�õ�����ֵ���ѹ��˿ո�
function val(obj) {
    return jQuery.trim(jQuery(obj).val());
}



//���ⷿ ��֤����
var rent = new validator();
rent.check = function(){
	var typeid = $("input[name=renthouse]:checked").val();
	if(typeid == "0" || typeid == ""){
		alert("��ѡ��Դ����");
		return false;
	}
	
	/*����*/
	this.checkRenthouse("input[name=renthouse]:checked"); //isrenthouse
	this.check_buildarea("#buildarea"); //isbuildarea
	this.check_monthprice("#price"); //isprice
	this.check_title("#title"); //istitle
	this.checkUsername("#username"); //isusername
	//this.checkUsertel("#usertel"); //isusertel
	check_mobile("#usertel");
	this.checkEncode("#encode"); //isencode
	eventHandle(tiny_mce_check.event);
	

	

	if(typeid == 1){
		/*���ַ� д��¥*/
		this.checkVillageName("#villagename"); //isvillagename    ���ַ�  д��¥
		this.check_rent("[id^=renttype_]:checked"); //isrenttype    ���ַ�
		this.check_paytype("input[name=paytype]"); //ispaytype    ���ַ�
		this.check_paytype2("input[name=paytype2]"); //ispaytype2    ���ַ�
		this.check_decorate("input[name=decorate]:checked"); //isdecorate    ���ַ�
		this.checkProperty("input[name=property]:checked"); //isproperty    ���ַ�
		this.checkRoom("input[name=room]"); //isroom    ���ַ�
		this.checkHall("input[name=hall]"); //ishall    ���ַ�
		this.checkToilet("input[name=toilet]"); //istoilet    ���ַ�
		this.check_aspect("input[name=aspect]:checked"); //isaspect    ���ַ�
		this.check_houseage("#houseage"); //ishouseage    ���ַ�
		this.check_floor("input[name=floor]"); //isfloor
		this.check_floor_again("input[name=totalfloor]"); //isflooragain
	}
	
	var floor_status = pay_status = curbus_status  = transfer_status = true;
	if(typeid == 6){
		/*����*/
		this.checkPropertyname("#propertyname"); //ispropertyname
		this.check_area("#shop_areaid"); //isareaid
		this.check_address("#address"); //isaddress
		this.check_manageprice("#manageprice"); //ismanageprice
		this.check_laticoor("#laticoor"); //islaticoor
		this.check_longcoor("#longcoor"); //islongcoor
		this.check_shoptype('[id^=shoptype_]:checked'); //isshoptype
		this.check_paytype("input[name=paytype]"); //ispaytype
		this.check_paytype2("input[name=paytype2]"); //ispaytype2
		//��ǰ״̬
		this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
		
		this.check_shoprenttype('[id^=shoprenttype_]:checked'); //isshoprenttype
		//ת�÷�
		if($("[id^=shoprenttype_]:checked").val() == 1 && $("[id^=transfertype_]:checked").val() == 0){
			this.check_istransferfee('#transferfee'); //istransferfee  ������
			transfer_status = this.istransferfee;
		}
		//¥��
		var floortype = $("[name^=floortype]:checked").val();
		if(floortype == 1){
			this.check_1floor("#1floor"); //is1floor
			floor_status = this.is1floor;
		}else if(floortype == 2){
			this.check_2floor("input[name=2floor]"); //is2floor
			this.check_2totalfloor("input[name=2totalfloor]"); //is2totalfloor
			floor_status = this.is2floor && this.is2totalfloor;
		}else if(floortype == 3){
			this.check_3totalfloor("input[name=3totalfloor]"); //is3totalfloor
			floor_status = this.is3totalfloor;
		}
		//��ǰ��ҵ
		var cur_busstatus =  parseInt($('input[name=businessstatus]:checked').val());
		if(cur_busstatus == 1 || cur_busstatus == 2){
			this.check_businessindustry("#businessindustry"); //isbusinessindustry
			curbus_status = this.isbusinessindustry;
		}
	}

	

	var otherdom = false;

	
	if(typeid == 1){ //סլ
		if ( this.isvillagename  && this.isrenttype 
			   && this.ispaytype && this.ispaytype2 && this.isdecorate && this.isproperty && this.isroom && this.ishall && this.istoilet && this.isaspect
				  && this.ishouseage && this.isfloor && this.isflooragain
			) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 4){ //д��¥
		if ( this.isvillagename && this.isfloorarea) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 6){ //����
		if ( this.ispropertyname  && this.isareaid && this.isaddress && this.ismanageprice 
				&& this.islaticoor && this.islongcoor && this.isshoptype && this.isbusinessstatus && this.isshoprenttype
				&& floor_status && pay_status && curbus_status && transfer_status
				 ) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}


	if (!( otherdom && this.isrenthouse && this.isbuildarea  && this.ismonthprice &&  this.istitle && this.isusername	&& this.isusertel && this.isencode && tiny_mce_check.isinfo)) {
		return false;
	}
	return true;
}
