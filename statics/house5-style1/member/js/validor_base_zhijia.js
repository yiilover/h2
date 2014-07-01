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
	//�۸�
	this.isprice = false;
	//��Դ����
	this.istitle = false;
	//��⻧��
	this.isroom = false;	
	//��ⷿ������
	this.isproperty = false;
	//���װ�����
	this.isdecorate = false;
	//��ⷿ�ݳ���
	this.isaspect = false;
	//����
	this.ishouseage = false;
	//��ϵ��
	this.isusername = false;
	//��ϵ�绰
	this.ismobile = false;
	//Ѻ����
	this.ispaytype = false;
	this.ispaytype2 = false;
	//����ַ�������
	this.val = function(obj){
		return jQuery.trim(jQuery(obj).val());
	}
	//����ַ�������
	this.GetStrLen = function(key){
			var l = escape(key), len;
			len = l.length - (l.length - l.replace(/\%u/g, "u").length) * 4;
			l = l.replace(/\%u/g, "uu");
			len = len - (l.length - l.replace(/\%/g, "").length) * 2;
			return len;
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
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "�벻Ҫ����ո�", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 40){
		this.ShowWrong(obj, "С�����Ƴ���Ӧ��С��10����", "plus_c");
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
//��⽨�����
validator.prototype.check_buildarea = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�������", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "��������Ϊ8λ����", "plus_c");
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
//���۸�
validator.prototype.check_price = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д�۸�", "plus_c");
		this.isprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "�۸��Ϊ10λ����", "plus_c");
		this.isprice = false;
		return false;
	}
	if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){
		this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
		this.isprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "�۸��ʽ����", "plus_c");
		this.isprice = false;
		return false;
	}
	this.isprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//������
validator.prototype.check_title = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "���������", "plus_c");
		this.istitle = false;
		return false;
	}	

	if(this.GetStrLen(this.val(obj)) > 60 || this.GetStrLen(this.val(obj)) < 8){
		this.ShowWrong(obj, "���ⳤ�ȴ���", "plus_c");
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
	this.ShowWrong("#room", "", "pw_success");
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
		this.ShowWrong(obj, '�����������Ϊ��', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	if(!/^[1-9]{1}\d{3}$/.test(this.val(obj))){
		this.ShowWrong(obj, '���������ʽ����', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	this.ishouseage = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�����ϵ��
validator.prototype.check_username = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "��������ϵ��", "plus_c");
		this.isusername = false;
		return false;
	}
	this.isusername = true;
	this.ShowWrong(obj, '', 'pw_success');
}
validator.prototype.check_usertel = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, '��������ϵ�绰', 'plus_c');
		this.ismobile = false;
		return false;
	}
	if(!/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3|4|5|8][0-9]{9}$)/.test(this.val(obj))){
		this.ShowWrong(obj, '�ֻ����벻��ȷ', 'plus_c');
		this.ismobile = false;
		return false;
	}
	this.ismobile = true;
	this.ShowWrong(obj, '', 'pw_success');
}
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

//���ַ� ��֤����
var esf = new validator();
//����ύ
esf.check = function() {
	this.checkVillageName("#villagename");
	this.checkProperty('[id^=property_]:checked');
	this.check_floor('input[name=floor]');
	this.check_floor_again('input[name=totalfloor]');
	this.check_buildarea('#buildarea');	
	this.checkRoom('input[name=room]');
	this.check_price('#price');
	this.check_decorate('input[name=decorate]:checked');
	this.check_aspect('input[name=aspect]:checked');
	this.check_houseage('#houseage');
	this.check_username('#username');
	this.check_usertel('#usertel');
	this.check_title('#title');
	eventHandle(tiny_mce_check.event);
	if (!(this.isvillagename && this.isproperty && this.isfloor && this.isflooragain && this.isbuildarea 
			&& this.isroom && this.isprice && this.isdecorate 
			&& this.isaspect && this.istitle && tiny_mce_check.isinfo)) {
		return false;
	}
	return true;
}

//���ⷿ ��֤����

var rent = new validator();
//�Ƿ����
rent.isrenttype = false;
rent.check_rent = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', '��ѡ����ⷽʽ', 'plus_c');
		this.isrenttype = false;
		return false;
	}
	if($('input[name=renttype]:checked').val() == 3){
		$('#price_unit').html('Ԫ/��');
		$('input[name=paytype]').val('');
		$('input[name=paytype2]').val('');
		$('#pay_layer').hide();
		this.ispaytype = true;
		this.ispaytype2 = true;
	}else{
		$('#price_unit').html('Ԫ/��');
		$('#pay_layer').show();
		this.ispaytype = false;
		this.ispaytype2 = false;
	}
	this.isrenttype = true;
	this.ShowWrong('#renttype', "", "pw_success");
}

rent.check = function(){
	this.checkVillageName("#villagename");
	this.checkProperty('[id^=property_]:checked');
	this.check_floor('input[name=floor]');
	this.check_floor_again('input[name=totalfloor]');
	this.check_buildarea('#buildarea');
	this.checkRoom('input[name=room]');
	this.check_price('#price');
	this.check_rent('input[name=renttype]:checked');
	if($('input[name=renttype]:checked').val() != 3){
		this.check_paytype('input[name=paytype]');
		this.check_paytype2('input[name=paytype2]');
	}
	this.check_decorate('input[name=decorate]:checked');
	this.check_aspect('input[name=aspect]:checked');
	this.check_houseage('#houseage');
	this.check_username('#username');
	this.check_usertel('#usertel');
	this.check_title('#title');
	eventHandle(tiny_mce_check.event);
	if (!(this.isvillagename && this.isproperty && this.isfloor && this.isflooragain && this.isbuildarea 
			&& this.isroom && this.isprice && this.isdecorate 
			&& this.isaspect && this.istitle && tiny_mce_check.isinfo
			&& this.isrenttype && this.ispaytype && this.ispaytype2)) {
		return false;
	}
	return true;
}

//д��¥��֤����
var office = new validator();
office.check_floor_district = function(obj){
	if(!$(obj + ':checked').val()){
		this.ShowWrong('#floorarea', '¥�㲻��Ϊ��', 'plus_c');
		this.isfloor = false;
		return false;
	}
	var tmp_floor_value = parseInt($(obj + ':checked').val());
	if(!(tmp_floor_value == 1 || tmp_floor_value == 2 || tmp_floor_value == 3)){
		this.ShowWrong('#floorarea', '¥���������', 'plus_c');
		this.isfloor = false;
		return false;
	}
	this.isfloor = true;
	this.ShowWrong('#floorarea', "", "pw_success");
}
office.check = function(){	
	this.checkVillageName("#villagename");
	this.check_floor_district('input[name=floor]');
	this.check_buildarea('#buildarea');
	this.check_price('#price');
	this.check_title('#title');
	eventHandle(tiny_mce_check.event);
	if (!(this.isvillagename && this.isfloor && this.isbuildarea && this.isprice && this.istitle && tiny_mce_check.isinfo)) {
		return false;
	}
	return true;	
}

//������֤����
var shop = new validator();
//�������
shop.isareaid = false;
//��������
shop.isshoptype = false;
//��ҵ��
shop.ismanageprice = false;
//¥������
shop.isfloorarea = false;
//���� ����
shop.is1floor = false;
//���� ��� ��*��
shop.is2floor = false;
//���� ��� ����*��
shop.is2totalfloor = false;
//���� ���� ��*��
shop.is3totalfloor = false;
//���� ��������
shop.isrenttype = false;
//���� ��ǰ״̬
shop.isbusinessstatus = false;
//���� ��ǰ��ҵ
shop.isbusinessindustry = false;

//������̵�ַ
shop.check_address = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "�������������ڵ�ַ", "plus_c");
		this.isaddress = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "�벻Ҫ����ո�", "plus_c");
		this.isaddress = false;
		return false;
	}
	this.isaddress = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�����������
shop.check_shoptype = function(obj){
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
//�����ҵ�����
shop.check_manageprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����д��ҵ�����", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "��ҵ������Ϊ8λ����", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "��ҵ����Ѹ�ʽ����", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "��ҵ����Ѹ�ʽ����", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	this.ismanageprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//�������
shop.check_area = function(obj)
{
	if(this.val(obj) == "0"){
		this.ShowWrong(obj, "��ѡ�������ڵ�����!", "plus_c");
		this.isareaid = false;
		return false;
	}
	this.isareaid = true;
	this.ShowWrong(obj, "", "pw_success");
}
//�����ҵ��˾����
shop.checkVillageName = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "��������ҵ��˾����", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "�벻Ҫ����ո�", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 20){
		this.ShowWrong(obj, "��ҵ��˾���Ƴ���Ӧ��С��10����", "plus_c");
		this.isvillagename = false;
		return false;
	}
	this.isvillagename = true;
	this.ShowWrong(obj, "", "pw_success");
}
//���� ����
shop.check_1floor = function(obj){
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
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "¥�����Ϊ3λ����", "plus_c");
		this.is1floor = false;
		return false;
	}
	this.is1floor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���� ����
shop.check_3totalfloor = function(obj){
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
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "¥�����Ϊ3λ����", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	this.is3totalfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//���� ¥�� ���
shop.check_2floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "¥���ʽ����", "plus_c");
		this.is2floor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "¥�����Ϊ3λ����", "plus_c");
		this.is2floor = false;
		return false;
	}
	this.is2floor = true;
	if(this.is2totalfloor && this.check_twofloor_val()){
		this.ShowWrong('#2floor', '', 'pw_success');
	}
}
shop.check_2totalfloor = function(obj){
	if(!(/^[1-9|-]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#2floor', "¥���ʽ����", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong("#2floor", "¥�����Ϊ3λ����", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	this.is2totalfloor = true;
	if(this.is2floor && this.check_twofloor_val()){
		this.ShowWrong('#2floor', '', 'pw_success');
	}
}
shop.check_twofloor_val = function(){
	if(parseInt(this.val('input[name=2floor]')) > parseInt(this.val('input[name=2totalfloor]'))){
		this.ShowWrong('#2floor', "��¥��������С������¥����", "plus_c");
		this.is2floor = false;
		this.is2totalfloor = false;
		return false;
	}
	return true;
}
//������� ��������
shop.check_renttype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', "���ʹ���������ѡ��", "plus_c");
		this.isrenttype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#renttype', "���ʹ���������ѡ��", "plus_c");
		this.isrenttype = false;
		return false;
	}
	this.isrenttype = true;
	this.ShowWrong('#renttype', '', 'pw_success');
}
//������� ��ǰ״̬
shop.check_businessstatus = function(obj){
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
shop.check_businessindustry = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "��ѡ��ǰ��ҵ", "plus_c");
		this.isbusinessindustry = false;
		return false;
	}
	this.isbusinessindustry = true;
	this.ShowWrong(obj, "", "pw_success");
}
//���� ת�÷�
shop.check_istransferfee = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "����дת�÷�", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 5 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "ת�÷�ӦΪ1-5λ����", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]{0,4}$/).test(this.val(obj))){
		this.ShowWrong(obj, "ת�÷Ѹ�ʽ����", "plus_c");
		this.istransferfee = false;
		return false;
	}
	this.istransferfee = true;
	this.ShowWrong(obj, '', 'pw_success');
}
shop.check = function(){
	this.checkVillageName("#villagename");
	this.check_area("#areaid");
	this.check_address("#address");
	this.check_shoptype('[id^=shoptype_]:checked');
	this.check_buildarea('#buildarea');
	this.check_price('#price');
	//this.check_manageprice('#manageprice');
	this.check_title('#title');
	eventHandle(tiny_mce_check.event);
	//��ǰ״̬
	this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
	
	var floor_status = pay_status = curbus_status = renttype_status = transfer_status = true;
	
	//����
	if(shopaction == "shoprent"){
		this.check_renttype('[id^=shoprenttype_]:checked'); //isrenttype ������
		renttype_status = this.isrenttype;
		
		if($("[id^=shoprenttype_]:checked").val() == 1 && $("[id^=transfertype_]:checked").val() == 0){
			this.check_istransferfee('#transferfee'); //istransferfee  ������
			transfer_status = this.istransferfee;
		}
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
	//��*Ѻ* ����
	if(shopaction == "shoprent"){
		this.check_paytype("input[name=paytype]"); //ispaytype
		this.check_paytype2("input[name=paytype2]"); //ispaytype2
		pay_status = this.ispaytype && this.ispaytype2;
	}
	//��ǰ��ҵ
	var cur_busstatus =  parseInt($('input[name=businessstatus]:checked').val());
	if(cur_busstatus == 1 || cur_busstatus == 2){
		this.check_businessindustry("#businessindustry"); //isbusinessindustry
		curbus_status = this.isbusinessindustry;
	}
	
	if (!(this.isvillagename && this.isareaid && this.isaddress && this.isshoptype && this.isbuildarea 
	&& this.isprice && this.istitle && this.isbusinessstatus
	&& floor_status && pay_status && curbus_status && renttype_status && transfer_status && tiny_mce_check.isinfo
	)) {
		return false;
	}
	return true;
}