/**
 * 验证数据格式 父对象
 */
var validator = function(){
	//检查物业
	this.isvillagename = false;
	//当前楼层
	this.isfloor = false;
	//总楼层
	this.isflooragain = false;
	//检查面积
	this.isbuildarea = false;
	//价格
	this.isprice = false;
	//房源标题
	this.istitle = false;
	//检测户型
	this.isroom = false;	
	//检测房屋类型
	this.isproperty = false;
	//检测装修情况
	this.isdecorate = false;
	//检测房屋朝向
	this.isaspect = false;
	//房龄
	this.ishouseage = false;
	//联系人
	this.isusername = false;
	//联系电话
	this.ismobile = false;
	//押付款
	this.ispaytype = false;
	this.ispaytype2 = false;
	//获得字符串长度
	this.val = function(obj){
		return jQuery.trim(jQuery(obj).val());
	}
	//获得字符串长度
	this.GetStrLen = function(key){
			var l = escape(key), len;
			len = l.length - (l.length - l.replace(/\%u/g, "u").length) * 4;
			l = l.replace(/\%u/g, "uu");
			len = len - (l.length - l.replace(/\%/g, "").length) * 2;
			return len;
	}
	//提示消息
	this.ShowWrong = function(obj, message, className){
		var showObject = jQuery("#div_" + jQuery(obj).attr("id"));
		showObject.html("<span class=\"" + className + "\">" + message + "</span>");
	}
}
//检测小区名称
validator.prototype.checkVillageName = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入小区名称", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "请不要输入空格", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 40){
		this.ShowWrong(obj, "小区名称长度应该小于10个字", "plus_c");
		this.isvillagename = false;
		return false;
	}
	this.isvillagename = true;
	this.ShowWrong(obj, "", "pw_success");
}
//检测楼层
validator.prototype.check_floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#floor', "楼层格式错误", "plus_c");
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
		this.ShowWrong('#floor', "楼层格式错误", "plus_c");
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
		this.ShowWrong('#floor', "总楼层数不能小于所在楼层数", "plus_c");
		this.isfloor = false;
		this.isflooragain = false;
		return false;
	}
	return true;
}
//检测建筑面积
validator.prototype.check_buildarea = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写建筑面积", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "建筑面积最长为8位数字", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "建筑面积格式错误", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "建筑面积格式错误", "plus_c");
		this.isbuildarea = false;
		return false;
	}
	this.isbuildarea = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测价格
validator.prototype.check_price = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写价格", "plus_c");
		this.isprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "价格最长为10位数字", "plus_c");
		this.isprice = false;
		return false;
	}
	if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){
		this.ShowWrong(obj, "价格格式错误", "plus_c");
		this.isprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "价格格式错误", "plus_c");
		this.isprice = false;
		return false;
	}
	this.isprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测标题
validator.prototype.check_title = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入标题", "plus_c");
		this.istitle = false;
		return false;
	}	

	if(this.GetStrLen(this.val(obj)) > 60 || this.GetStrLen(this.val(obj)) < 8){
		this.ShowWrong(obj, "标题长度错误", "plus_c");
		this.istitle = false;
		return false;
	}
	this.istitle = true;
	this.ShowWrong(obj, '', 'pw_success');
}

//检测居室
validator.prototype.checkRoom = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#room", "请填写正确的居室", "plus_c");
		this.isroom = false;
		return false;
	}
	if(!(/^[1-9]{1}$/).test(this.val(obj))){
		this.ShowWrong("#room", "请填写正确的居室", "plus_c");
		this.isroom = false;
		return false;
	}
	this.isroom = true;
	this.ShowWrong("#room", "", "pw_success");
}
validator.prototype.checkProperty = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#property', '请选择房屋类型', 'plus_c');
		this.isproperty = false;
		return false;
	}
	this.isproperty = true;
	this.ShowWrong('#property', "", "pw_success");
}
validator.prototype.check_decorate = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#decorate', '请选择装修情况', 'plus_c');
		this.isdecorate = false;
		return false;
	}
	this.isdecorate = true;
	this.ShowWrong('#decorate', "", "pw_success");
}
validator.prototype.check_aspect = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#aspect', '请选择房屋朝向', 'plus_c');
		this.isaspect = false;
		return false;
	}
	this.isaspect = true;
	this.ShowWrong('#aspect', "", "pw_success");
}
validator.prototype.check_houseage = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, '建造年代不能为空', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	if(!/^[1-9]{1}\d{3}$/.test(this.val(obj))){
		this.ShowWrong(obj, '建造年代格式错误', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	this.ishouseage = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测联系人
validator.prototype.check_username = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入联系人", "plus_c");
		this.isusername = false;
		return false;
	}
	this.isusername = true;
	this.ShowWrong(obj, '', 'pw_success');
}
validator.prototype.check_usertel = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, '请输入联系电话', 'plus_c');
		this.ismobile = false;
		return false;
	}
	if(!/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3|4|5|8][0-9]{9}$)/.test(this.val(obj))){
		this.ShowWrong(obj, '手机号码不正确', 'plus_c');
		this.ismobile = false;
		return false;
	}
	this.ismobile = true;
	this.ShowWrong(obj, '', 'pw_success');
}
validator.prototype.check_paytype = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#paytype', '押金不能为空', 'plus_c');
		this.ispaytype = false;
		return false;
	}
	if(!/\d{1}/.test(this.val(obj))){
		this.ShowWrong('#paytype', '押金格式错误', 'plus_c');
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
		this.ShowWrong('#paytype', '付款方式不能为空', 'plus_c');
		this.ispaytype2 = false;
		return false;
	}
	if(!/\d{1}/.test(this.val(obj))){
		this.ShowWrong('#paytype', '付款方式格式错误', 'plus_c');
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
				tiny_mce_check.ShowWrong('#content', "请输入简介", "plus_c");
				tiny_mce_check.isinfo = false;
				return false;
			}
			tiny_mce_check.isinfo = 1;
			tiny_mce_check.ShowWrong('#content', '', 'pw_success');
		}
	}

//二手房 验证对象
var esf = new validator();
//检测提交
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

//出租房 验证对象

var rent = new validator();
//是否合租
rent.isrenttype = false;
rent.check_rent = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', '请选择合租方式', 'plus_c');
		this.isrenttype = false;
		return false;
	}
	if($('input[name=renttype]:checked').val() == 3){
		$('#price_unit').html('元/日');
		$('input[name=paytype]').val('');
		$('input[name=paytype2]').val('');
		$('#pay_layer').hide();
		this.ispaytype = true;
		this.ispaytype2 = true;
	}else{
		$('#price_unit').html('元/月');
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

//写字楼验证对象
var office = new validator();
office.check_floor_district = function(obj){
	if(!$(obj + ':checked').val()){
		this.ShowWrong('#floorarea', '楼层不能为空', 'plus_c');
		this.isfloor = false;
		return false;
	}
	var tmp_floor_value = parseInt($(obj + ':checked').val());
	if(!(tmp_floor_value == 1 || tmp_floor_value == 2 || tmp_floor_value == 3)){
		this.ShowWrong('#floorarea', '楼层参数错误', 'plus_c');
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

//商铺验证对象
var shop = new validator();
//检查区域
shop.isareaid = false;
//商铺类型
shop.isshoptype = false;
//物业费
shop.ismanageprice = false;
//楼层区域
shop.isfloorarea = false;
//商铺 单层
shop.is1floor = false;
//商铺 多层 第*层
shop.is2floor = false;
//商铺 多层 至第*层
shop.is2totalfloor = false;
//商铺 独栋 第*层
shop.is3totalfloor = false;
//商铺 出租类型
shop.isrenttype = false;
//商铺 当前状态
shop.isbusinessstatus = false;
//商铺 当前行业
shop.isbusinessindustry = false;

//检测商铺地址
shop.check_address = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入商铺所在地址", "plus_c");
		this.isaddress = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "请不要输入空格", "plus_c");
		this.isaddress = false;
		return false;
	}
	this.isaddress = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测商铺类型
shop.check_shoptype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#shoptype', "商铺类型错误，请重新选择", "plus_c");
		this.isshoptype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#shoptype', "商铺类型错误，请重新选择", "plus_c");
		this.isshoptype = false;
		return false;
	}
	this.isshoptype = true;
	this.ShowWrong('#shoptype', '', 'pw_success');
}
//检测物业管理费
shop.check_manageprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写物业管理费", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "物业管理费最长为8位数字", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "物业管理费格式错误", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "物业管理费格式错误", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	this.ismanageprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测区域
shop.check_area = function(obj)
{
	if(this.val(obj) == "0"){
		this.ShowWrong(obj, "请选择您所在的区域!", "plus_c");
		this.isareaid = false;
		return false;
	}
	this.isareaid = true;
	this.ShowWrong(obj, "", "pw_success");
}
//检测物业公司名称
shop.checkVillageName = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入物业公司名称", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "请不要输入空格", "plus_c");
		this.isvillagename = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 20){
		this.ShowWrong(obj, "物业公司名称长度应该小于10个字", "plus_c");
		this.isvillagename = false;
		return false;
	}
	this.isvillagename = true;
	this.ShowWrong(obj, "", "pw_success");
}
//商铺 单层
shop.check_1floor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写楼层", "plus_c");
		this.is1floor = false;
		return false;
	}
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "楼层格式错误", "plus_c");
		this.is1floor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "楼层最高为3位数字", "plus_c");
		this.is1floor = false;
		return false;
	}
	this.is1floor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//商铺 独栋
shop.check_3totalfloor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写楼层", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "楼层格式错误", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "楼层最高为3位数字", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	this.is3totalfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//商铺 楼层 多层
shop.check_2floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "楼层格式错误", "plus_c");
		this.is2floor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "楼层最高为3位数字", "plus_c");
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
		this.ShowWrong('#2floor', "楼层格式错误", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 3 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong("#2floor", "楼层最高为3位数字", "plus_c");
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
		this.ShowWrong('#2floor', "总楼层数不能小于所在楼层数", "plus_c");
		this.is2floor = false;
		this.is2totalfloor = false;
		return false;
	}
	return true;
}
//检测商铺 出租类型
shop.check_renttype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', "类型错误，请重新选择", "plus_c");
		this.isrenttype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#renttype', "类型错误，请重新选择", "plus_c");
		this.isrenttype = false;
		return false;
	}
	this.isrenttype = true;
	this.ShowWrong('#renttype', '', 'pw_success');
}
//检测商铺 当前状态
shop.check_businessstatus = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#businessstatus', "当前状态错误，请重新选择", "plus_c");
		this.isbusinessstatus = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#businessstatus', "当前状态错误，请重新选择", "plus_c");
		this.isbusinessstatus = false;
		return false;
	}
	this.isbusinessstatus = true;
	this.ShowWrong('#businessstatus', '', 'pw_success');
}
//商铺 当前行业
shop.check_businessindustry = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "请选择当前行业", "plus_c");
		this.isbusinessindustry = false;
		return false;
	}
	this.isbusinessindustry = true;
	this.ShowWrong(obj, "", "pw_success");
}
//商铺 转让费
shop.check_istransferfee = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写转让费", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 5 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "转让费应为1-5位数字", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]{0,4}$/).test(this.val(obj))){
		this.ShowWrong(obj, "转让费格式错误", "plus_c");
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
	//当前状态
	this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
	
	var floor_status = pay_status = curbus_status = renttype_status = transfer_status = true;
	
	//类型
	if(shopaction == "shoprent"){
		this.check_renttype('[id^=shoprenttype_]:checked'); //isrenttype 仅出租
		renttype_status = this.isrenttype;
		
		if($("[id^=shoprenttype_]:checked").val() == 1 && $("[id^=transfertype_]:checked").val() == 0){
			this.check_istransferfee('#transferfee'); //istransferfee  仅出租
			transfer_status = this.istransferfee;
		}
	}
	//楼层
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
	//付*押* 面议
	if(shopaction == "shoprent"){
		this.check_paytype("input[name=paytype]"); //ispaytype
		this.check_paytype2("input[name=paytype2]"); //ispaytype2
		pay_status = this.ispaytype && this.ispaytype2;
	}
	//当前行业
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