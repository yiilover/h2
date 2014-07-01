jQuery(document).ready(function() {
	//��������
	jQuery('input[name=renthouse]').click(function(){
		sell.checkRenthouse(this);
	})
	
	//С��
	jQuery('#villagename').focus(function(){
		sell.ShowWrong(this, "����дС��������", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		sell.checkVillageName(this);
	})
	
	//��������
	$(".area_select").click(function(){
		sell.check_area("#shop_areaid");
	});
	
	//�������
	jQuery('#buildarea').focus(function(){
		sell.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		sell.check_buildarea(this);
	})
	

	
	//�۸�
	jQuery('#price').focus(function(){
		sell.ShowWrong(this, "����д�۸�", "plus_d");
	})
	jQuery('#price').blur(function(){
		sell.check_price(this);
	})
	

	
	//װ�����
	jQuery('input[name=decorate]').click(function(){
		sell.check_decorate(this);
	})
	
	//��������
	jQuery('[id^=property_]').click(function(){
		sell.checkProperty(this);
	})
	
	//���¥��
	jQuery('input[name$=floor]').focus(function(){
		sell.ShowWrong('#floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		sell.check_floor(this);
	})
	jQuery('input[name=totalfloor]').blur(function(){
		sell.check_floor_again(this);
	})
	
	//¥������
	jQuery('input[name=floor]').click(function(){
		sell.check_floorarea(this);
	})
	
	//������
	jQuery('input[name=room]').focus(function(){
		sell.ShowWrong('#room', "����д���͵ľ���", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		sell.checkRoom(this);
	})
	//������
	jQuery('input[name=hall]').focus(function(){
		sell.ShowWrong('#room', "����д���͵Ŀ���", "plus_d");
	})
	jQuery('input[name=hall]').blur(function(){
		sell.checkHall(this);
	})
	//������
	jQuery('input[name=toilet]').focus(function(){
		sell.ShowWrong('#room', "����д���͵�������", "plus_d");
	})
	jQuery('input[name=toilet]').blur(function(){
		sell.checkToilet(this);
	})
	
	//���ݳ���
	jQuery('input[name=aspect]').click(function(){
		sell.check_aspect(this);
	})
	
	//����
	jQuery('#houseage').focus(function(){
		sell.ShowWrong(this, "����д�������", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		sell.check_houseage(this);
	})
	
	//��Դ����
	jQuery('#title').focus(function(){
		sell.ShowWrong(this, "����д��Դ����", "plus_d");
	})
	jQuery('#title').blur(function(){
		sell.check_title(this);
	})
	
	//��ϵ��
	jQuery('#username').focus(function(){
		sell.ShowWrong(this, "��������ϵ��", "plus_d");
	})
	jQuery('#username').blur(function(){
		sell.checkUsername(this);
	})
	
	//��ϵ�绰
	jQuery('#usertel').focus(function(){
		sell.ShowWrong(this, "������ϵ�绰", "plus_d");
	})
	jQuery('#usertel').blur(function(){
		//sell.checkUsertel(this);
		check_mobile(this);
		if(sell.isusertel == true){
			$("#send_code_bt").show();
		}else{
			$("#send_code_bt").hide();
		}
	})
	
	//��֤��
	jQuery('#encode').focus(function(){
		sell.ShowWrong(this, "����д��֤��", "plus_d");
	})
	jQuery('#encode').blur(function(){
		sell.checkEncode(this);
	})

	//��ҵ����
	jQuery('#propertyname').focus(function(){
		sell.ShowWrong(this, "��������ҵ����", "plus_d");
	})
	jQuery('#propertyname').blur(function(){
		sell.checkPropertyname(this);
	})
	
	//��������
	
	//���̵�ַ
	jQuery('#address').focus(function(){
		sell.ShowWrong(this, "����д�������ڵ�ַ!", "plus_d");
	})
	jQuery('#address').blur(function(){
		sell.check_address(this);
	})
	
	//��ҵ�����
	jQuery('#manageprice').focus(function(){
		sell.ShowWrong(this, "����д��ҵ�����", "plus_d");
	})
	jQuery('#manageprice').blur(function(){
		sell.check_manageprice(this);
	})
	
	//��������
	jQuery('[id^=shoptype_]').click(function(){
		sell.check_shoptype(this);
	})
	
	//���¥��->����
	jQuery('#1floor').focus(function(){
		sell.ShowWrong(this, "����д¥��", "plus_d");
	})
	jQuery('#1floor').blur(function(){
		sell.check_1floor(this);
	})
	//���¥��->����
	jQuery('#3totalfloor').focus(function(){
		sell.ShowWrong(this, "����д¥��", "plus_d");
	})
	jQuery('#3totalfloor').blur(function(){
		sell.check_3totalfloor(this);
	})
	//¥�� ���
	jQuery('input[name=2floor]').focus(function(){
		sell.ShowWrong('#2floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=2floor]').blur(function(){
		sell.check_2floor(this);
	})
	jQuery('input[name=2totalfloor]').focus(function(){
		sell.ShowWrong('#2floor', "����д�����¥��", "plus_d");
	})
	jQuery('input[name=2totalfloor]').blur(function(){
		sell.check_2totalfloor(this);
	})
	
	//��ǰ״̬
	jQuery('[id^=businessstatus_]').click(function(){
		sell.check_businessstatus(this);
	})
	//��ǰ��ҵ
	jQuery('.industry_select').live("click",function(){
		sell.check_businessindustry('#businessindustry');
	})
	
	//�ύ
	jQuery("#dosubmit").click(function() {
		if (sell.check()) {
			jQuery("#myform").submit();
		}
		return false;
	});
});

//��֤�ֻ�����
function check_mobile(obj) {
	var objvar = val(obj);
    if (objvar == "") {
		sell.ShowWrong(obj, "��������ϵ�绰", "plus_c");
        return false;
    }else{
		var asktel = val((jQuery("#usertel")));
		var reg2=/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3|4|5|8][0-9]{9}$)/; 
		if(!reg2.test(asktel)){
			isusertel = false;
			sell.ShowWrong(jQuery("#usertel"), "�ֻ����벻��ȷ", "plus_c");
		}
		else
		{
			sell.isusertel = true; //�û�����֤��ȷ
			sell.ShowWrong(jQuery("#usertel"), "", "pw_success");
		}
		/*
		jQuery.ajax({
			type: "post",
			async: false,
			url: PASSPORT_URL + "register/ajax?action=checkispersonmobile&jsonpCallback=?",
			data: {"mobile": val((jQuery("#usertel"))), "num": Math.random().toString()},
			dataType:'jsonp',
			success: function(req) {
				if (req.status == "success") {
					sell.isusertel = true; //�û�����֤��ȷ
					//��ʾ�ɹ�
					sell.ShowWrong(jQuery("#usertel"), "", "pw_success");
				}else {
					isusertel = false;
					sell.ShowWrong(jQuery("#usertel"), req.tips, "plus_c");
				}
			}
		});*/
    }
}

//�õ�����ֵ���ѹ��˿ո�
function val(obj) {
    return jQuery.trim(jQuery(obj).val());
}

//���ⷿ ��֤����
var sell = new validator();
sell.check = function(){
	var typeid = $("input[name=renthouse]:checked").val();
	if(typeid == "0" || typeid == ""){
		alert("��ѡ��Դ����");
		return false;
	}
	
	/*����*/
	this.checkRenthouse("input[name=renthouse]:checked"); //isrenthouse
	this.check_buildarea("#buildarea"); //isbuildarea
	this.check_price("#price"); //isprice
	this.check_title("#title"); //istitle
	this.checkUsername("#username"); //isusername
	//this.checkUsertel("#usertel"); //isusertel
	check_mobile("#usertel");
	this.checkEncode("#encode"); //isencode
	eventHandle(tiny_mce_check.event);
	

	if(typeid == 1){
		/*���ַ� д��¥*/
		this.checkVillageName("#villagename"); //isvillagename    ���ַ�  д��¥
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
	
	if(typeid == 3){
		/*д��¥*/
		this.checkVillageName("#villagename"); //isvillagename    ���ַ�  д��¥
		this.check_floorarea("[id^=floorarea_]:checked"); //isfloorarea
	}

	var floor_status = curbus_status  = true;
	if(typeid == 5){
		/*����*/
		this.checkPropertyname("#propertyname"); //ispropertyname
		this.check_area("#shop_areaid"); //isareaid
		this.check_address("#address"); //isaddress
		this.check_manageprice("#manageprice"); //ismanageprice
		this.check_laticoor("#laticoor"); //islaticoor
		this.check_longcoor("#longcoor"); //islongcoor
		this.check_shoptype('[id^=shoptype_]:checked'); //isshoptype
		//��ǰ״̬
		this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
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
		if ( this.isvillagename  
			    && this.isdecorate && this.isproperty && this.isroom && this.ishall && this.istoilet && this.isaspect
				  && this.ishouseage && this.isfloor && this.isflooragain
			) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	if(typeid == 3){ //д��¥
		if ( this.isvillagename && this.isfloorarea) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 5){ //����
		if ( this.ispropertyname  && this.isareaid && this.isaddress && this.ismanageprice
			 && this.islaticoor && this.islongcoor && this.isshoptype && this.isbusinessstatus
			 && floor_status && curbus_status
			  ) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}

	if (!( otherdom && this.isrenthouse && this.isbuildarea  && this.isprice && this.istitle && this.isusername	&& this.isusertel && this.isencode && tiny_mce_check.isinfo)) {
		return false;
	}
	return true;
}
