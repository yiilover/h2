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
	//价格 售价
	this.isprice = false;
	//价格 月租金
	this.ismonthprice = false;
	//房源标题
	this.istitle = false;
	//检测户型
	this.isroom = false;
	this.ishall = false;
	this.istoilet = false;
	//检测房屋类型
	this.isproperty = false;
	//检测装修情况
	this.isdecorate = false;
	//检测房屋朝向
	this.isaspect = false;
	//房龄
	this.ishouseage = false;
	//房屋求租求购类型
	this.isrenttype = false;
	//区域
	this.isareaid = false;
	//最低楼层
	this.minfloor = false;
	//委托房源类型
	this.ishousetype = false;
	//楼号
	this.isbuildingtip = false;
	//单元号
	this.isunittip = false;
	//室号
	this.isroomtip = false;
	//联系人
	this.isusername = false;
	//联系电话
	this.isusertel = false;
	//租金
	this.isrentprice = false;
	//物业名称
	this.ispropertyname = false;
	//地址
	this.isaddress = false;
	this.ispaytype = false;
    this.ispaytype2 = false;
	//商铺类型
	this.isshoptype = false;
	//物业费
	this.ismanageprice = false;
	//出租房源的类型
	this.isrenthouse = false;	
	//手机认证码
	this.isdencode = false;
	//X坐标
	this.islaticoor = false;
	//Y坐标
	this.islongcoor = false;
	//最小租金
	this.ismonthpricemin = false;
	//最大租金
	this.ismonthpricemax = false;
	//最小售价
	this.ispricemin = false;
	//最大售价
	this.ispricemax = false;
	//最小面积
	this.isareamin = false;
	//最大面积
	this.isareamax = false;
	//楼层区域
	this.isfloorarea = false;
	//商铺 单层
	this.is1floor = false;
	//商铺 多层 第*层
	this.is2floor = false;
	//商铺 多层 至第*层
	this.is2totalfloor = false;
	//商铺 独栋 第*层
	this.is3totalfloor = false;
	//商铺 出租类型
	this.isshoprenttype = false;
	//商铺 当前状态
	this.isbusinessstatus = false;
	//商铺 当前行业
	this.isbusinessindustry = false;
	//商铺 转让费
	this.istransferfee = false;
	
	//获得字符串长度
	this.val = function(obj){
		return jQuery.trim(jQuery(obj).val());
	}
	
	//获得字符串长度
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
	
	//可以是0 正整数 或者小数 长度最大10 最多两位小数
	this.intfloat = function(obj){
		if(this.GetStrLen(this.val(obj)) > 7 || this.GetStrLen(this.val(obj)) < 1){
			return false;
		}
		if((/\.{1,}/).test(this.val(obj))){ //有小数点
			if((/\.$/).test(this.val(obj))){ //末尾点
				return false;
			}
			if((/\.{2,}/).test(this.val(obj))){ //多点
				return false;
			}
			if(!(/\.[\d]{0,2}$/).test(this.val(obj))){ //最多为两位小数
				return false;
			}
			if(!(/^[0-9]{1}[\d\.]{0,6}$/).test(this.val(obj))){ //防止如：02.89
				return false;
			}
			if((/^0{1,}/).test(this.val(obj))){ //0开头
				if(!(/^0{1}\.[0-9]{1,5}$/).test(this.val(obj))){
					return false;
				}
			}
		}else{
			if(this.val(obj) == 0){
				return true;
			}
			if(!(/^[1-9]{1}[\d]{0,6}$/).test(this.val(obj))){ //非零开头最大7位
				return false;
			}
		}
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
	if(this.GetStrLen(this.val(obj)) > 20 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "小区名称应在20字以内", "plus_c");
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
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#floor', "楼层数值应在-10至99之间", "plus_c");
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
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#floor', "楼层数值应在-10至99之间", "plus_c");
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
//楼层区域
validator.prototype.check_floorarea = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#floorarea', '请选择所在楼层', 'plus_c');
		this.isfloorarea = false;
		return false;
	}
	this.isfloorarea = true;
	this.ShowWrong('#floorarea', "", "pw_success");
}
//商铺 单层
validator.prototype.check_1floor = function(obj){
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
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong(obj, "楼层数值应在-10至99之间", "plus_c");
		this.is1floor = false;
		return false;
	}
	this.is1floor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//商铺 独栋
validator.prototype.check_3totalfloor = function(obj){
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
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong(obj, "楼层数值应在-10至99之间", "plus_c");
		this.is3totalfloor = false;
		return false;
	}
	this.is3totalfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//商铺 楼层 多层
validator.prototype.check_2floor = function(obj){
	if(!(/^([(1-9)]{1}|(-[1-9]{1}))[\d]*$/).test(this.val(obj))){
		this.ShowWrong(obj, "楼层格式错误", "plus_c");
		this.is2floor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#2floor', "楼层数值应在-10至99之间", "plus_c");
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
		this.ShowWrong('#2floor', "楼层格式错误", "plus_c");
		this.is2totalfloor = false;
		return false;
	}
	if(this.val(obj) < -10 || this.val(obj) > 99){
		this.ShowWrong('#2floor', "楼层数值应在-10至99之间", "plus_c");
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
		this.ShowWrong('#2floor', "起始楼层不能小于终止楼层", "plus_c");
		this.is2floor = false;
		this.is2totalfloor = false;
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
		this.ShowWrong(obj, "建筑面积应在8位数字以内", "plus_c");
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
//检测最小建筑面积
validator.prototype.check_areamin = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "", "pw_success");
		this.isareamin = true;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "建筑面积应在8位数字以内", "plus_c");
		this.isareamin = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong(obj, "建筑面积格式错误", "plus_c");
		this.isareamin = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "建筑面积格式错误", "plus_c");
		this.isareamin = false;
		return false;
	}
	this.isareamin = true;
	this.ShowWrong(obj, '', 'pw_success');
	this.check_areamax('input[name=areamax]');
}
//检测最大建筑面积
validator.prototype.check_areamax = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#areamin", "", "pw_success");
		this.isareamax = true;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong("#areamin", "建筑面积应在8位数字以内", "plus_c");
		this.isareamax = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d\.]{0,7}$/).test(this.val(obj))){
		this.ShowWrong("#areamin", "建筑面积格式错误", "plus_c");
		this.isareamax = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong("#areamin", "建筑面积格式错误", "plus_c");
		this.isareamax = false;
		return false;
	}
	var areamin_val = $("#areamin").val();
	var areamax_val = $("#areamax").val();
	if(areamin_val != "" && areamax_val != "" && areamax_val <= areamin_val){
		this.ShowWrong("#areamin", "最大面积应大于最小面积", "plus_c");
		this.isareamax = false;	
		return false;
	}
	this.isareamax = true;
	this.ShowWrong("#areamin", '', 'pw_success');
}
//检测月租金
validator.prototype.check_monthprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写价格", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 6 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "价格应为6位以内的正整数", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	if(this.val(obj) == 0){
		this.ShowWrong(obj, '', 'pw_success');
		this.ismonthprice = true;
		return true;
	}
	if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val(obj))){ //非零开头最大10位
		this.ShowWrong(obj, "价格应为6位以内的正整数", "plus_c");
		this.ismonthprice = false;
		return false;
	}
	this.ismonthprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测售价
validator.prototype.check_price = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写价格", "plus_c");
		this.isprice = false;
		return false;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "价格应在7位以内,小数则最多两位", "plus_c");
		this.isprice = false;
		return false;
	}
	/*if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "价格应在10位数字以内", "plus_c");
		this.isprice = false;
		return false;
	}
	if((/\.{1,}/).test(this.val(obj))){ //有小数点
		if((/\.$/).test(this.val(obj))){ //末尾点
			this.ShowWrong(obj, "价格格式错误", "plus_c");
			this.isprice = false;
			return false;
		}
		if((/\.{2,}/).test(this.val(obj))){ //多点
			this.ShowWrong(obj, "价格格式错误", "plus_c");
			this.isprice = false;
			return false;
		}
		if(!(/\.[\d]{0,2}$/).test(this.val(obj))){
			this.ShowWrong(obj, "价格最多为两位小数", "plus_c");
			this.isprice = false;
			return false;
		}
		if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){ //防止如：02.89
			this.ShowWrong(obj, "价格格式错误", "plus_c");
			this.isprice = false;
			return false;
		}
		if((/^0{1,}/).test(this.val(obj))){ //0开头
			if(!(/^0{1}\.[0-9]{1,8}$/).test(this.val(obj))){
				this.ShowWrong(obj, "价格格式错误", "plus_c");
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
		if(!(/^[1-9]{1}[\d]{0,9}$/).test(this.val(obj))){ //非零开头最大10位
			this.ShowWrong(obj, "价格格式错误", "plus_c");
			this.isprice = false;
			return false;
		}
	}*/
	this.isprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//商铺 转让费
validator.prototype.check_istransferfee = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写转让费", "plus_c");
		this.istransferfee = false;
		return false;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "转让费应为7位以内,小数则最多两位", "plus_c");
		this.istransferfee = false;
		return false;
	}
	this.istransferfee = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测最大租金 最小租金
validator.prototype.check_monthminmax = function(){
	if(this.val("#pricemin") != ''){
		if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val("#pricemin"))){ //非零开头最大10位
			this.ShowWrong("#pricemin", "价格应为6位以内的正整数", "plus_c");
			this.ismonthpricemin = false;
			return false;
		}
	}
	if(this.val("#pricemax") != ''){
		if(!(/^[1-9]{1}[\d]{0,5}$/).test(this.val("#pricemax"))){ //非零开头最大10位
			this.ShowWrong("#pricemin", "价格应为6位以内的正整数", "plus_c");
			this.ismonthpricemax = false;
			return false;
		}
	}
	var pricemin_val = $("#pricemin").val();
	var pricemax_val = $("#pricemax").val();
	if(pricemin_val != "" && pricemax_val != "" && pricemax_val <= pricemin_val){
		this.ShowWrong("#pricemin", "最大价格应大于最小价格", "plus_c");
		this.ismonthpricemin = false;
		this.ismonthpricemax = false;		
		return false;
	}
	this.ismonthpricemin = true;
	this.ismonthpricemax = true;
	this.ShowWrong("#pricemin", '', 'pw_success');
}
//检测最小售价 最大售价
validator.prototype.check_priceminmax = function(obj){
	if(this.val("#pricemin") != ''){
		if(this.intfloat("#pricemin") == false){ //非零开头最大10位
			this.ShowWrong("#pricemin", "价格应为7位以内,小数则最多两位", "plus_c");
			this.ispricemin = false;
			return false;
		}
	}
	if(this.val("#pricemax") != ''){
		if(this.intfloat("#pricemax") == false){ //非零开头最大10位
			this.ShowWrong("#pricemin", "价格应为7位以内,小数则最多两位", "plus_c");
			this.ispricemax = false;
			return false;
		}
	}
	var pricemin_val = $("#pricemin").val();
	var pricemax_val = $("#pricemax").val();
	if(pricemin_val != "" && pricemax_val != "" && pricemax_val <= pricemin_val){
		this.ShowWrong("#pricemin", "最大价格应大于最小价格", "plus_c");
		this.ispricemin = false;
		this.ispricemax = false;		
		return false;
	}
	this.ispricemin = true;
	this.ispricemax = true;
	this.ShowWrong("#pricemin", '', 'pw_success');
}
//检测租金
validator.prototype.checkRentprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写价格", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 10 || this.GetStrLen(this.val(obj)) < 1){
		this.ShowWrong(obj, "价格应在10位数字以内", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if(!(/^[0-9]{1}[\d\.]{0,9}$/).test(this.val(obj))){
		this.ShowWrong(obj, "价格格式错误", "plus_c");
		this.isrentprice = false;
		return false;
	}
	if((/\.{2,}/).test(this.val(obj))){
		this.ShowWrong(obj, "价格格式错误", "plus_c");
		this.isrentprice = false;
		return false;
	}
	this.isrentprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测标题
validator.prototype.check_title = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入标题", "plus_c");
		this.istitle = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 30 || this.GetStrLen(this.val(obj)) < 4){
		this.ShowWrong(obj, "标题应在4-30字之间", "plus_c");
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
	this.checkHall('input[name=hall]');
}
//检测客厅
validator.prototype.checkHall = function(obj){
	/*if(this.val(obj) == ''){
		this.ShowWrong("#room", "请填写正确的客厅", "plus_c");
		this.ishall = false;
		return false;
	}*/
	if(!(/^\d{1}$/).test(this.val(obj)) && this.val(obj) != ''){
		this.ShowWrong("#room", "请填写正确的客厅", "plus_c");
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
//检查卫生间
validator.prototype.checkToilet = function(obj){
	/*if(this.val(obj) == ''){
		this.ShowWrong("#room", "请填写正确的卫生间", "plus_c");
		this.istoilet = false;
		return false;
	}*/
	if(!(/^\d{1}$/).test(this.val(obj))  && this.val(obj) != ''){
		this.ShowWrong("#room", "请填写正确的卫生间", "plus_c");
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
		this.ShowWrong(obj, '', 'pw_success');
		this.ishouseage = true;
		return true;
	}
	if(!/^[1-2]{1}\d{3}$/.test(this.val(obj)) ){
		this.ShowWrong(obj, '建造年代格式错误', 'plus_c');
		this.ishouseage = false;
		return false;
	}
	this.ishouseage = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测楼号
validator.prototype.checkBuildingtip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#buildingtip", "请填写正确的幢号", "plus_c");
		this.isbuildingtip = false;
		return false;
	}
	if(!/[1-9]$/.test(this.val(obj))){
		this.ShowWrong("#buildingtip", "请填写正确的幢号", "plus_c");
		this.isbuildingtip = false;
		return false;
	}

	this.isbuildingtip = true;
	
	if(this.isbuildingtip && this.isunittip){
		this.ShowWrong(obj, '', 'pw_success');
	}
}
//检测单元
validator.prototype.checkUnittip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong("#buildingtip", "请填写正确的单元号", "plus_c");
		this.isunittip = false;
		return false;
	}
	if(!(/^\d{1}$/).test(this.val(obj))){
		this.ShowWrong("#buildingtip", "请填写正确的单元号", "plus_c");
		this.isunittip = false;
		return false;
	}
	this.isunittip = true;
	this.checkBuildingtip('input[name=buildingtip]');
	if(this.isbuildingtip && this.isunittip){
		this.ShowWrong(obj, '', 'pw_success');
	}
}
//室号
validator.prototype.checkRoomtip = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写正确的室号", "plus_c");
		this.isroomtip = false;
		return false;
	}
	if(!/[1-9]$/.test(this.val(obj))){
		this.ShowWrong(obj, "请填写正确的室号", "plus_c");
		this.isroomtip = false;
		return false;
	}
	this.isroomtip = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//联系人
validator.prototype.checkUsername = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入联系人", "plus_c");
		this.isusername = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 8 || this.GetStrLen(this.val(obj)) < 2){
		this.ShowWrong(obj, "联系人应在2-8字之间", "plus_c");
		this.isusername = false;
		return false;
	}
	this.isusername = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//联系电话
validator.prototype.checkUsertel = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写正确的电话", "plus_c");
		this.isusertel = false;
		return false;
	}
	if(!/^1[3458]\d{9}$/.test(this.val(obj))){
		this.ShowWrong(obj, "请填写正确的电话", "plus_c");
		this.isusertel = false;
		return false;
	}
	this.isusertel = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//物业名称
validator.prototype.checkPropertyname = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入物业名称", "plus_c");
		this.ispropertyname = false;
		return false;
	} 
	if(this.GetStrLen(this.val(obj)) > 20 || this.GetStrLen(this.val(obj)) < 4){
		this.ShowWrong(obj, "物业名称应在4-20字之间", "plus_c");
		this.ispropertyname = false;
		return false;
	}
	this.ispropertyname = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//是否合租
validator.prototype.check_rent = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#renttype', '请选择合租方式', 'plus_c');
		this.isrenttype = false;
		return false;
	}
	this.isrenttype = true;
	this.ShowWrong('#renttype', "", "pw_success");
}
//押付款
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
//检测地址
validator.prototype.check_address = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入地址", "plus_c");
		this.isaddress = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) > 30 || this.GetStrLen(this.val(obj)) < 6){
		this.ShowWrong(obj, "地址长度应在6-30字之间", "plus_c");
		this.isaddress = false;
		return false;
	}
	this.isaddress = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测商铺类型
validator.prototype.check_shoptype = function(obj){
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
//检测商铺 出租类型
validator.prototype.check_shoprenttype = function(obj){
	if(this.val(obj) == 0 || this.val(obj) == ''){
		this.ShowWrong('#shoprenttype', "类型错误，请重新选择", "plus_c");
		this.isshoprenttype = false;
		return false;
	}
	if(!(/^[1-9]{1}[\d]*$/).test(this.val(obj))){
		this.ShowWrong('#shoprenttype', "类型错误，请重新选择", "plus_c");
		this.isshoprenttype = false;
		return false;
	}
	this.isshoprenttype = true;
	this.ShowWrong('#shoprenttype', '', 'pw_success');
}
//检测商铺 当前状态
validator.prototype.check_businessstatus = function(obj){
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
validator.prototype.check_businessindustry = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "请选择当前行业", "plus_c");
		this.isbusinessindustry = false;
		return false;
	}
	this.isbusinessindustry = true;
	this.ShowWrong(obj, "", "pw_success");
}
//检测物业管理费
validator.prototype.check_manageprice = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "", "pw_success");
		this.ismanageprice = true;
		return true;
	}
	if(this.intfloat(obj) == false){
		this.ShowWrong(obj, "物业费应在7位以内,小数则最多两位", "plus_c");
		this.ismanageprice = false;
		return false;
	}
	this.ismanageprice = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//检测区域
validator.prototype.check_area = function(obj)
{
	if(this.val(obj) == "0" || this.val(obj) == ""){
		this.ShowWrong(obj, "请选择您所在的区域!", "plus_c");
		this.isareaid = false;
		return false;
	}
	this.isareaid = true;
	this.ShowWrong(obj, "", "pw_success");
}
//求购类型
validator.prototype.checkPropertytype = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#propertytype', '请选择求购类型', 'plus_c');
		this.isproperty = false;
		return false;
	}
	this.isproperty = true;
	this.ShowWrong('#propertytype', "", "pw_success");
}
//检测建筑面积
validator.prototype.check_minfloor = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请填写具体的楼层", "plus_c");
		this.minfloor = false;
		return false;
	}
	if(this.val(obj) > 99 || this.val(obj) < -10){
		this.ShowWrong(obj, "楼层数值应在-10至99之间", "plus_c");
		this.minfloor = false;
		return false;
	}
	this.minfloor = true;
	this.ShowWrong(obj, '', 'pw_success');
}

//委托类型
validator.prototype.checkHousetype = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong('#div_housetype', '请选择委托类型', 'plus_c');
		this.ishousetype = false;
		return false;
	}
	this.ishousetype = true;
	this.ShowWrong('#housetype', "", "pw_success");
}

//出租房源类型
validator.prototype.checkRenthouse = function(obj){
	if(parseInt(this.val(obj)) == 0 || this.val(obj) == ''){
		this.ShowWrong("#div_renthouse", '请选择出租房源类型', 'plus_c');
		this.isrenthouse = false;
		return false;
	}
	this.isrenthouse = true;
	this.ShowWrong("#renthouse", "", "pw_success");
}
//手机认证码
validator.prototype.checkEncode = function(obj){
	if(this.val(obj) == ''){
		this.ShowWrong(obj, "请输入管理密码", "plus_c");
		this.isencode = false;
		return false;
	}
	if (this.val(obj).indexOf(" ") > -1) {
		this.ShowWrong(obj, "请不要输入空格", "plus_c");
		this.isencode = false;
		return false;
	}
	if(this.GetStrLen(this.val(obj)) < 3){
		this.ShowWrong(obj, "管理密码太短", "plus_c");
		this.isencode = false;
		return false;
	}
	this.isencode = true;
	this.ShowWrong(obj, '', 'pw_success');
}
//坐标
validator.prototype.check_laticoor = function(obj){
	if(!this.val(obj)){
		this.ShowWrong('#laticoor', 'X坐标不能为空', 'plus_c');
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
		this.ShowWrong('#paytype', '付款方式不能为空', 'plus_c');
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
				tiny_mce_check.ShowWrong('#content', "请输入简介", "plus_c");
				tiny_mce_check.isinfo = false;
				return false;
			}
			tiny_mce_check.isinfo = 1;
			tiny_mce_check.ShowWrong('#content', '', 'pw_success');
		}
	}