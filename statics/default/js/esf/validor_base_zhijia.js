/**
 * ��֤���ݸ�ʽ ������
 */
var validator = function(){
	//�����ҵ
	this.isvillagename = false;
	//��ǰ¥��
	this.isfloor = false;
	//��¥��
	this.isflooragain = false;
	//������
	this.isbuildarea = false;
	//�۸� �ۼ�
	this.isprice = false;
	//�۸� �����
	this.ismonthprice = false;
	//��Դ����
	this.istitle = false;
	//��⻧��
	this.isroom = false;
	this.ishall = false;
	this.istoilet = false;
	//��ⷿ������
	this.isproperty = false;
	//���װ�����
	this.isdecorate = false;
	//��ⷿ�ݳ���
	this.isaspect = false;
	//����
	this.ishouseage = false;
	//��������������
	this.isrenttype = false;
	//����
	this.isareaid = false;
	//���¥��
	this.minfloor = false;
	//ί�з�Դ����
	this.ishousetype = false;
	//¥��
	this.isbuildingtip = false;
	//��Ԫ��
	this.isunittip = false;
	//�Һ�
	this.isroomtip = false;
	//��ϵ��
	this.isusername = false;
	//��ϵ�绰
	this.isusertel = false;
	//���
	this.isrentprice = false;
	//��ҵ����
	this.ispropertyname = false;
	//��ַ
	this.isaddress = false;
	this.ispaytype = false;
    this.ispaytype2 = false;
	//��������
	this.isshoptype = false;
	//��ҵ��
	this.ismanageprice = false;
	//���ⷿԴ������
	this.isrenthouse = false;	
	//�ֻ���֤��
	this.isdencode = false;
	//X����
	this.islaticoor = false;
	//Y����
	this.islongcoor = false;
	//��С���
	this.ismonthpricemin = false;
	//������
	this.ismonthpricemax = false;
	//��С�ۼ�
	this.ispricemin = false;
	//����ۼ�
	this.ispricemax = false;
	//��С���
	this.isareamin = false;
	//������
	this.isareamax = false;
	//¥������
	this.isfloorarea = false;
	//���� ����
	this.is1floor = false;
	//���� ��� ��*��
	this.is2floor = false;
	//���� ��� ����*��
	this.is2totalfloor = false;
	//���� ���� ��*��
	this.is3totalfloor = false;
	//���� ��������
	this.isshoprenttype = false;
	//���� ��ǰ״̬
	this.isbusinessstatus = false;
	//���� ��ǰ��ҵ
	this.isbusinessindustry = false;
	//���� ת�÷�
	this.istransferfee = false;
	
	//����ַ�������
	this.val = function(obj){
		return jQuery.trim(jQuery(obj).val());
	}
	
	//����ַ�������
	/*this.GetStrLen = function(key){
			var l = escape(key), len;
			len = l.length - (l.length - l.replace(/\%u/g, "u").length) * 4;
			l = l.replace(/\%u/g, "uu");
			len = len - (l.length - l.replace(/\%/g, "").length) * 2;
			return len;
	}*/
	this.GetStrLen = function(key){
			return key.length;
	}
	
	//������0 ������ ����С�� �������10 �����λС��
	this.intfloat = function(obj){
		if(this.GetStrLen(this.val(obj)) > 7 || this.GetStrLen(this.val(obj)) < 1){
			return false;
		}
		if((/\.{1,}/).test(this.val(obj))){ //��С����
			if((/\.$/).test(this.val(obj))){ //ĩβ��
				return false;
			}
			if((/\.{2,}/).test(this.val(obj))){ //���
				return false;
			}
			if(!(/\.[\d]{0,2}$/).test(this.val(obj))){ //���Ϊ��λС��
				return false;
			}
			if(!(/^[0-9]{1}[\d\.]{0,6}$/).test(this.val(obj))){ //��ֹ�磺02.89
				return false;
			}
			if((/^0{1,}/).test(this.val(obj))){ //0��ͷ
				if(!(/^0{1}\.[0-9]{1,5}$/).test(this.val(obj))){
					return false;
				}
			}
		}else{
			if(this.val(obj) == 0){
				return true;
			}
			if(!(/^[1-9]{1}[\d]{0,6}$/).test(this.val(obj))){ //���㿪ͷ���7λ
				return false;
			}
		}
	}
		
	//��ʾ��Ϣ
	this.ShowWrong = function(obj, message, className){
		var showObject = jQuery("#div_" + jQuery(obj).attr("id"));
		showObject.html("<span class=\"" + className + "\">" + message + "</span>");
	}
}
//���С������
validator.prototype.checkVillageName = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "������С������", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 20 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "С������Ӧ��20������", "plus_c");
		this.isvillagename = false;
		return false;
	}
	this.isvillagename = true;
	this.ShowWrong(obj, "", "pw_success");
}
//���¥��
validator.prototype.check_floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#floor', "¥���ʽ����", "plus_c");
		this.isfloor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#floor', "¥����ֵӦ��-10��99֮��", "plus_c");
		this.isfloor = false;
		return false;
	}
	this.isfloor = true;
	if(this.isflooragain && this.check_floor_val()){
		this.ShowWrong('#floor', '', 'pw_success');
	}
}
validator.prototype.check_floor_again = function(obj){
	if(!(/^[1-9|-]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#floor', "¥���ʽ����", "plus_c");
		this.isflooragain = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#floor', "¥����ֵӦ��-10��99֮��", "plus_c");
		this.isflooragain = false;
		return false;
	}
	this.isflooragain = true;
	if(this.isfloor && this.check_floor_val()){
		this.ShowWrong('#floor', '', 'pw_success');
	}
}
validator.prototype.check_floor_val = function(){
	if(parseInt(this.val('input[name=floor]')) > parseInt(this.val('input[name=totalfloor]'))){
		this.ShowWrong('#floor', "��¥��������С������¥����", "plus_c");
		this.isfloor = false;
		this.isflooragain = false;
		return false;
	}
	return true;
}
//¥������
validator.prototype.check_floorarea = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#floorarea', '��ѡ������¥��', 'plus_c');
		this.isfloorarea = false;
		return false;
	}
	this.isfloorarea = true;
	this.ShowWrong('#floorarea', "", "pw_success");
}
//���� ����
validator.prototype.check_1floor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д¥��", "plus_c");
		this.is1floor = false;
		return false;
	}
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "¥���ʽ����", "plus_c");
		this.is1floor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong(obj, "¥����ֵӦ��-10��99֮��", "plus_c");
		this.is1floor = false;
		return false;
	}
	this.is1floor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���� ����
validator.prototype.check_3totalfloor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д¥��", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "¥���ʽ����", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong(obj, "¥����ֵӦ��-10��99֮��", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	this.is3totalfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���� ¥�� ���
validator.prototype.check_2floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "¥���ʽ����", "plus_c");
		this.is2floor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#2floor', "¥����ֵӦ��-10��99֮��", "plus_c");
		this.is2floor = false;
		return false;
	}
	this.is2floor = true;
	if(this.is2totalfloor && this.check_twofloor_val()){
		this.ShowWrong('#2floor', '', 'pw_success');
	}
}
validator.prototype.check_2totalfloor = function(obj){
	if(!(/^[1-9|-]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#2floor', "¥���ʽ����", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#2floor', "¥����ֵӦ��-10��99֮��", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	this.is2totalfloor = true;
	if(this.is2floor && this.check_twofloor_val()){
		this.ShowWrong('#2floor', '', 'pw_success');
	}
}
validator.prototype.check_twofloor_val = function(){
	if(parseInt(this.val('input[name=2floor]')) > parseInt(this.val('input[name=2totalfloor]'))){
		this.ShowWrong('#2floor', "��ʼ¥�㲻��С����ֹ¥��", "plus_c");
		this.is2floor = false;
		this.is2totalfloor = false;
		return false;
	}
	return true;
}
//��⽨�����
validator.prototype.check_buildarea = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�������", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�������Ӧ��8λ��������", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "���������ʽ����", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "���������ʽ����", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	this.isbuildarea = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�����С�������
validator.prototype.check_areamin = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "", "pw_success");
		this.isareamin = true;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�������Ӧ��8λ��������", "plus_c");
		this.isareamin = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "���������ʽ����", "plus_c");
		this.isareamin = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "���������ʽ����", "plus_c");
		this.isareamin = false;
		return false;
	}
	this.isareamin = true;
	this.ShowWrong(obj, '', 'pw_success');
	this.check_areamax('input[name=areamax]');
}
//�����������
validator.prototype.check_areamax = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#areamin", "", "pw_success");
		this.isareamax = true;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong("#areamin", "�������Ӧ��8λ��������", "plus_c");
		this.isareamax = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong("#areamin", "���������ʽ����", "plus_c");
		this.isareamax = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong("#areamin", "���������ʽ����", "plus_c");
		this.isareamax = false;
		return false;
	}
	var areamin_val = $("#areamin").val();
	var areamax_val = $("#areamax").val();
	if(areamin_val != "" && areamax_val != "" && areamax_val <= areamin_val){
		this.ShowWrong("#areamin", "������Ӧ������С���", "plus_c");
		this.isareamax = false;	
		return false;
	}
	this.isareamax = true;
	this.ShowWrong("#areamin", '', 'pw_success');
}
//��������
validator.prototype.check_monthprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�۸�", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 6 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�۸�ӦΪ6λ���ڵ�������", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	if(this.val(obj) == 0){
		this.ShowWrong(obj, '', 'pw_success');
		this.ismonthprice = true;
		return true;
	}
	if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val(obj))){ //���㿪ͷ���10λ
		this.ShowWrong(obj, "�۸�ӦΪ6λ���ڵ�������", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	this.ismonthprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//����ۼ�
validator.prototype.check_price = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�۸�", "plus_c");
		this.isprice = false;
		return false;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "�۸�Ӧ��7λ����,С���������λ", "plus_c");
		this.isprice = false;
		return false;
	}
	/*if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�۸�Ӧ��10λ��������", "plus_c");
		this.isprice = false;
		return false;
	}
	if((/\.{1,}/).test(this.val(obj))){ //��С����
		if((/\.$/).test(this.val(obj))){ //ĩβ��
			this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
			this.isprice = false;
			return false;
		}
		if((/\.{2,}/).test(this.val(obj))){ //���
			this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
			this.isprice = false;
			return false;
		}
		if(!(/\.[\d]{0,2}$/).test(this.val(obj))){
			this.ShowWrong(obj, "�۸����Ϊ��λС��", "plus_c");
			this.isprice = false;
			return false;
		}
		if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){ //��ֹ�磺02.89
			this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
			this.isprice = false;
			return false;
		}
		if((/^0{1,}/).test(this.val(obj))){ //0��ͷ
			if(!(/^0{1}\.[0-9]{1,8}$/).test(this.val(obj))){
				this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
				this.isprice = false;
				return false;
			}
		}
	}else{
		if(this.val(obj) == 0){
			this.ShowWrong(obj, '', 'pw_success');
			this.isprice = true;
			return true;
		}
		if(!(/^[1-9]{1}[\d]{0,9}$/).test(this.val(obj))){ //���㿪ͷ���10λ
			this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
			this.isprice = false;
			return false;
		}
	}*/
	this.isprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���� ת�÷�
validator.prototype.check_istransferfee = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����дת�÷�", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "ת�÷�ӦΪ7λ����,С���������λ", "plus_c");
		this.istransferfee = false;
		return false;
	}
	this.istransferfee = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//��������� ��С���
validator.prototype.check_monthminmax = function(){
	if(this.val("#pricemin") != ''){
		if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val("#pricemin"))){ //���㿪ͷ���10λ
			this.ShowWrong("#pricemin", "�۸�ӦΪ6λ���ڵ�������", "plus_c");
			this.ismonthpricemin = false;
			return false;
		}
	}
	if(this.val("#pricemax") != ''){
		if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val("#pricemax"))){ //���㿪ͷ���10λ
			this.ShowWrong("#pricemin", "�۸�ӦΪ6λ���ڵ�������", "plus_c");
			this.ismonthpricemax = false;
			return false;
		}
	}
	var pricemin_val = $("#pricemin").val();
	var pricemax_val = $("#pricemax").val();
	if(pricemin_val != "" && pricemax_val != "" && pricemax_val <= pricemin_val){
		this.ShowWrong("#pricemin", "���۸�Ӧ������С�۸�", "plus_c");
		this.ismonthpricemin = false;
		this.ismonthpricemax = false;		
		return false;
	}
	this.ismonthpricemin = true;
	this.ismonthpricemax = true;
	this.ShowWrong("#pricemin", '', 'pw_success');
}
//�����С�ۼ� ����ۼ�
validator.prototype.check_priceminmax = function(obj){
	if(this.val("#pricemin") != ''){
		if(this.intfloat("#pricemin") == false){ //���㿪ͷ���10λ
			this.ShowWrong("#pricemin", "�۸�ӦΪ7λ����,С���������λ", "plus_c");
			this.ispricemin = false;
			return false;
		}
	}
	if(this.val("#pricemax") != ''){
		if(this.intfloat("#pricemax") == false){ //���㿪ͷ���10λ
			this.ShowWrong("#pricemin", "�۸�ӦΪ7λ����,С���������λ", "plus_c");
			this.ispricemax = false;
			return false;
		}
	}
	var pricemin_val = $("#pricemin").val();
	var pricemax_val = $("#pricemax").val();
	if(pricemin_val != "" && pricemax_val != "" && pricemax_val <= pricemin_val){
		this.ShowWrong("#pricemin", "���۸�Ӧ������С�۸�", "plus_c");
		this.ispricemin = false;
		this.ispricemax = false;		
		return false;
	}
	this.ispricemin = true;
	this.ispricemax = true;
	this.ShowWrong("#pricemin", '', 'pw_success');
}
//������
validator.prototype.checkRentprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�۸�", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�۸�Ӧ��10λ��������", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){
		this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
		this.isrentprice = false;
		return false;
	}
	this.isrentprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//������
validator.prototype.check_title = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "���������", "plus_c");
		this.istitle = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 30 || this.GetStrLen(this.val(obj)) < 4){
		this.ShowWrong(obj, "����Ӧ��4-30��֮��", "plus_c");
		this.istitle = false;
		return false;
	}
	this.istitle = true;
	this.ShowWrong(obj, '', 'pw_success');
}

//������
validator.prototype.checkRoom = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#room", "����д��ȷ�ľ���", "plus_c");
		this.isroom = false;
		return false;
	}
	if(!(/^[1-9]{1}$/).test(this.val(obj))){
		this.ShowWrong("#room", "����д��ȷ�ľ���", "plus_c");
		this.isroom = false;
		return false;
	}
	this.isroom = true;
	this.checkHall('input[name=hall]');
}
//������
validator.prototype.checkHall = function(obj){
	/*if(this.val(obj) == ''){
		this.ShowWrong("#room", "����д��ȷ�Ŀ���", "plus_c");
		this.ishall = false;
		return false;
	}*/
	if(!(/^\d{1}$/).test(this.val(obj)) && this.val(obj) != ''){
		this.ShowWrong("#room", "����д��ȷ�Ŀ���", "plus_c");
		this.ishall = false;
		return false;
	}
	this.ishall = true;
	if(!this.isroom){
		this.checkRoom('input[name=room]');
	}else{
		this.checkToilet('input[name=toilet]');
	}
}
//���������
validator.prototype.checkToilet = function(obj){
	/*if(this.val(obj) == ''){
		this.ShowWrong("#room", "����д��ȷ��������", "plus_c");
		this.istoilet = false;
		return false;
	}*/
	if(!(/^\d{1}$/).test(this.val(obj))  && this.val(obj) != ''){
		this.ShowWrong("#room", "����д��ȷ��������", "plus_c");
		this.istoilet = false;
		return false;
	}
	this.istoilet = true;
	if(!this.isroom){
		this.checkRoom('input[name=room]');
	}else if(!this.ishall){
		this.checkHall('input[name=hall]');
	}else{
		this.ShowWrong("#room", "", "pw_success");
	}	
}
validator.prototype.checkProperty = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#property', '��ѡ��������', 'plus_c');
		this.isproperty = false;
		return false;
	}
	this.isproperty = true;
	this.ShowWrong('#property', "", "pw_success");
}
validator.prototype.check_decorate = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#decorate', '��ѡ��װ�����', 'plus_c');
		this.isdecorate = false;
		return false;
	}
	this.isdecorate = true;
	this.ShowWrong('#decorate', "", "pw_success");
}
validator.prototype.check_aspect = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#aspect', '��ѡ���ݳ���', 'plus_c');
		this.isaspect = false;
		return false;
	}
	this.isaspect = true;
	this.ShowWrong('#aspect', "", "pw_success");
}
validator.prototype.check_houseage = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, '', 'pw_success');
		this.ishouseage = true;
		return true;
	}
	if(!/^[1-2]{1}\d{3}$/.test(this.val(obj)) ){
		this.ShowWrong(obj, '���������ʽ����', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	this.ishouseage = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���¥��
validator.prototype.checkBuildingtip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#buildingtip", "����д��ȷ�Ĵ���", "plus_c");
		this.isbuildingtip = false;
		return false;
	}
	if(!/[1-9]$/.test(this.val(obj))){
		this.ShowWrong("#buildingtip", "����д��ȷ�Ĵ���", "plus_c");
		this.isbuildingtip = false;
		return false;
	}

	this.isbuildingtip = true;
	
	if(this.isbuildingtip && this.isunittip){
		this.ShowWrong(obj, '', 'pw_success');
	}
}
//��ⵥԪ
validator.prototype.checkUnittip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#buildingtip", "����д��ȷ�ĵ�Ԫ��", "plus_c");
		this.isunittip = false;
		return false;
	}
	if(!(/^\d{1}$/).test(this.val(obj))){
		this.ShowWrong("#buildingtip", "����д��ȷ�ĵ�Ԫ��", "plus_c");
		this.isunittip = false;
		return false;
	}
	this.isunittip = true;
	this.checkBuildingtip('input[name=buildingtip]');
	if(this.isbuildingtip && this.isunittip){
		this.ShowWrong(obj, '', 'pw_success');
	}
}
//�Һ�
validator.prototype.checkRoomtip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д��ȷ���Һ�", "plus_c");
		this.isroomtip = false;
		return false;
	}
	if(!/[1-9]$/.test(this.val(obj))){
		this.ShowWrong(obj, "����д��ȷ���Һ�", "plus_c");
		this.isroomtip = false;
		return false;
	}
	this.isroomtip = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//��ϵ��
validator.prototype.checkUsername = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "��������ϵ��", "plus_c");
		this.isusername = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 2){
		this.ShowWrong(obj, "��ϵ��Ӧ��2-8��֮��", "plus_c");
		this.isusername = false;
		return false;
	}
	this.isusername = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//��ϵ�绰
validator.prototype.checkUsertel = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д��ȷ�ĵ绰", "plus_c");
		this.isusertel = false;
		return false;
	}
	if(!/^1[3458]\d{9}$/.test(this.val(obj))){
		this.ShowWrong(obj, "����д��ȷ�ĵ绰", "plus_c");
		this.isusertel = false;
		return false;
	}
	this.isusertel = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//��ҵ����
validator.prototype.checkPropertyname = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "��������ҵ����", "plus_c");
		this.ispropertyname = false;
		return false;
	} 
	if(this.GetStrLen(this.val(obj)) > 20 || this.GetStrLen(this.val(obj)) < 4){
		this.ShowWrong(obj, "��ҵ����Ӧ��4-20��֮��", "plus_c");
		this.ispropertyname = false;
		return false;
	}
	this.ispropertyname = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�Ƿ����
validator.prototype.check_rent = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', '��ѡ����ⷽʽ', 'plus_c');
		this.isrenttype = false;
		return false;
	}
	this.isrenttype = true;
	this.ShowWrong('#renttype', "", "pw_success");
}
//Ѻ����
validator.prototype.check_paytype = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#paytype', 'Ѻ����Ϊ��', 'plus_c');
		this.ispaytype = false;
		return false;
	}
	if(!/\d{1}/.test(this.val(obj))){
		this.ShowWrong('#paytype', 'Ѻ���ʽ����', 'plus_c');
		this.ispaytype = false;
		return false;
	}
	this.ispaytype = true;
	if(this.ispaytype2 === false){
		jQuery('input[name=paytype2]').focus();
		return;
	}
	this.ShowWrong('#paytype', '', 'pw_success');
}
validator.prototype.check_paytype2 = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#paytype', '���ʽ����Ϊ��', 'plus_c');
		this.ispaytype2 = false;
		return false;
	}
	if(!/\d{1}/.test(this.val(obj))){
		this.ShowWrong('#paytype', '���ʽ��ʽ����', 'plus_c');
		this.ispaytype2 = false;
		return false;
	}
	this.ispaytype2 = true;
	if(this.ispaytype === false){
		jQuery('input[name=paytype]').focus();
		return;
	}
	this.ShowWrong('#paytype', '', 'pw_success');
}
//����ַ
validator.prototype.check_address = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "�������ַ", "plus_c");
		this.isaddress = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 30 || this.GetStrLen(this.val(obj)) < 6){
		this.ShowWrong(obj, "��ַ����Ӧ��6-30��֮��", "plus_c");
		this.isaddress = false;
		return false;
	}
	this.isaddress = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�����������
validator.prototype.check_shoptype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#shoptype', "�������ʹ���������ѡ��", "plus_c");
		this.isshoptype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#shoptype', "�������ʹ���������ѡ��", "plus_c");
		this.isshoptype = false;
		return false;
	}
	this.isshoptype = true;
	this.ShowWrong('#shoptype', '', 'pw_success');
}
//������� ��������
validator.prototype.check_shoprenttype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#shoprenttype', "���ʹ���������ѡ��", "plus_c");
		this.isshoprenttype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#shoprenttype', "���ʹ���������ѡ��", "plus_c");
		this.isshoprenttype = false;
		return false;
	}
	this.isshoprenttype = true;
	this.ShowWrong('#shoprenttype', '', 'pw_success');
}
//������� ��ǰ״̬
validator.prototype.check_businessstatus = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#businessstatus', "��ǰ״̬����������ѡ��", "plus_c");
		this.isbusinessstatus = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#businessstatus', "��ǰ״̬����������ѡ��", "plus_c");
		this.isbusinessstatus = false;
		return false;
	}
	this.isbusinessstatus = true;
	this.ShowWrong('#businessstatus', '', 'pw_success');
}
//���� ��ǰ��ҵ
validator.prototype.check_businessindustry = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "��ѡ��ǰ��ҵ", "plus_c");
		this.isbusinessindustry = false;
		return false;
	}
	this.isbusinessindustry = true;
	this.ShowWrong(obj, "", "pw_success");
}
//�����ҵ�����
validator.prototype.check_manageprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "", "pw_success");
		this.ismanageprice = true;
		return true;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "��ҵ��Ӧ��7λ����,С���������λ", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	this.ismanageprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�������
validator.prototype.check_area = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "��ѡ�������ڵ�����!", "plus_c");
		this.isareaid = false;
		return false;
	}
	this.isareaid = true;
	this.ShowWrong(obj, "", "pw_success");
}
//������
validator.prototype.checkPropertytype = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#propertytype', '��ѡ��������', 'plus_c');
		this.isproperty = false;
		return false;
	}
	this.isproperty = true;
	this.ShowWrong('#propertytype', "", "pw_success");
}
//��⽨�����
validator.prototype.check_minfloor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�����¥��", "plus_c");
		this.minfloor = false;
		return false;
	}
	if(this.val(obj) > 99 || this.val(obj) < -10){
		this.ShowWrong(obj, "¥����ֵӦ��-10��99֮��", "plus_c");
		this.minfloor = false;
		return false;
	}
	this.minfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}

//ί������
validator.prototype.checkHousetype = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#div_housetype', '��ѡ��ί������', 'plus_c');
		this.ishousetype = false;
		return false;
	}
	this.ishousetype = true;
	this.ShowWrong('#housetype', "", "pw_success");
}

//���ⷿԴ����
validator.prototype.checkRenthouse = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong("#div_renthouse", '��ѡ����ⷿԴ����', 'plus_c');
		this.isrenthouse = false;
		return false;
	}
	this.isrenthouse = true;
	this.ShowWrong("#renthouse", "", "pw_success");
}
//�ֻ���֤��
validator.prototype.checkEncode = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "�������������", "plus_c");
		this.isencode = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "�벻Ҫ����ո�", "plus_c");
		this.isencode = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) < 3){
		this.ShowWrong(obj, "��������̫��", "plus_c");
		this.isencode = false;
		return false;
	}
	this.isencode = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//����
validator.prototype.check_laticoor = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#laticoor', 'X���겻��Ϊ��', 'plus_c');
		this.islaticoor = false;
		return false;
	}
	this.islaticoor = true;
	if(this.islongcoor === false){
		jQuery('input[name=longcoor]').focus();
		return;
	}
	this.ShowWrong('#laticoor', '', 'pw_success');
}
validator.prototype.check_longcoor = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#paytype', '���ʽ����Ϊ��', 'plus_c');
		this.islongcoor = false;
		return false;
	}
	this.islongcoor = true;
	if(this.islaticoor === false){
		jQuery('input[name=laticoor]').focus();
		return;
	}
	this.ShowWrong('#laticoor', '', 'pw_success');
}

	var tiny_mce_check = new validator();
	tiny_mce_check.info = false;
	tiny_mce_check.event = {type:'customsubmit'};
	function eventHandle(event)
	{
		if(event.type == 'click' || event.type == 'keyup' || event.type == 'customsubmit'){
			var cur_html = UE.getEditor('content').getContent()
			if(!cur_html){
				tiny_mce_check.ShowWrong('#content', "��������", "plus_c");
				tiny_mce_check.isinfo = false;
				return false;
			}
			tiny_mce_check.isinfo = 1;
			tiny_mce_check.ShowWrong('#content', '', 'pw_success');
		}
	}