jQuery(document).ready(function() {
	//房屋类型
	jQuery('input[name=renthouse]').click(function(){
		rent.checkRenthouse(this);
	})
	
	//小区
	jQuery('#villagename').focus(function(){
		rent.ShowWrong(this, "请填写小区的名称", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		rent.checkVillageName(this);
	})
	
	//所在区域
	$(".area_select").click(function(){
		rent.check_area("#shop_areaid");
	});
	
	//建筑面积
	jQuery('#buildarea').focus(function(){
		rent.ShowWrong(this, "请填写建筑面积", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		rent.check_buildarea(this);
	})
	
	//是否合租
	jQuery('[id^=renttype_]').click(function(){
		rent.check_rent(this);
	})
	
	//价格
	jQuery('#price').focus(function(){
		rent.ShowWrong(this, "请填写价格", "plus_d");
	})
	jQuery('#price').blur(function(){
		rent.check_monthprice(this);
	})
	
	//押付款
	jQuery('input[name=paytype]').focus(function(){
		rent.ShowWrong('#paytype', '请填写押金', 'plus_d');
	})
	jQuery('input[name=paytype]').blur(function(){
		rent.check_paytype(this);
	})
	jQuery('input[name=paytype2]').focus(function(){
		rent.ShowWrong('#paytype', '请填写付款方式', 'plus_d');
	})
	jQuery('input[name=paytype2]').blur(function(){
		rent.check_paytype2(this);
	})
	
	//装修情况
	jQuery('input[name=decorate]').click(function(){
		rent.check_decorate(this);
	})
	
	//房屋类型
	jQuery('[id^=property_]').click(function(){
		rent.checkProperty(this);
	})
	
	//检测楼层
	jQuery('input[name$=floor]').focus(function(){
		rent.ShowWrong('#floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		rent.check_floor(this);
	})
	jQuery('input[name=totalfloor]').blur(function(){
		rent.check_floor_again(this);
	})
	
	//楼层区域
	jQuery('input[name=floor]').click(function(){
		rent.check_floorarea(this);
	})
	
	//户型室
	jQuery('input[name=room]').focus(function(){
		rent.ShowWrong('#room', "请填写户型的居室", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		rent.checkRoom(this);
	})
	//户型厅
	jQuery('input[name=hall]').focus(function(){
		rent.ShowWrong('#room', "请填写户型的客厅", "plus_d");
	})
	jQuery('input[name=hall]').blur(function(){
		rent.checkHall(this);
	})
	//户型卫
	jQuery('input[name=toilet]').focus(function(){
		rent.ShowWrong('#room', "请填写户型的卫生间", "plus_d");
	})
	jQuery('input[name=toilet]').blur(function(){
		rent.checkToilet(this);
	})
	
	//房屋朝向
	jQuery('input[name=aspect]').click(function(){
		rent.check_aspect(this);
	})
	
	//房龄
	jQuery('#houseage').focus(function(){
		rent.ShowWrong(this, "请填写建造年代", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		rent.check_houseage(this);
	})
	
	//房源标题
	jQuery('#title').focus(function(){
		rent.ShowWrong(this, "请填写房源标题", "plus_d");
	})
	jQuery('#title').blur(function(){
		rent.check_title(this);
	})
	
	//联系人
	jQuery('#username').focus(function(){
		rent.ShowWrong(this, "请输入联系人", "plus_d");
	})
	jQuery('#username').blur(function(){
		rent.checkUsername(this);
	})
	
	//联系电话
	jQuery('#usertel').focus(function(){ 
		rent.ShowWrong(this, "请填联系电话", "plus_d");
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
	
	//认证码
	jQuery('#encode').focus(function(){
		rent.ShowWrong(this, "请输入认证码", "plus_d");
	})
	jQuery('#encode').blur(function(){
		rent.checkEncode(this);
	})

	//物业名称
	jQuery('#propertyname').focus(function(){
		rent.ShowWrong(this, "请输入物业名称", "plus_d");
	})
	jQuery('#propertyname').blur(function(){
		rent.checkPropertyname(this);
	})
	
	//所在区域
	
	//商铺地址
	jQuery('#address').focus(function(){
		rent.ShowWrong(this, "请填写商铺所在地址!", "plus_d");
	})
	jQuery('#address').blur(function(){
		rent.check_address(this);
	})
	
	//商铺类型
	jQuery('[id^=shoptype_]').click(function(){
		rent.check_shoptype(this);
	})
	
	//物业管理费
	jQuery('#manageprice').focus(function(){
		rent.ShowWrong(this, "请填写物业管理费", "plus_d");
	})
	jQuery('#manageprice').blur(function(){
		rent.check_manageprice(this);
	})
	
	//检测楼层->单层
	jQuery('#1floor').focus(function(){
		rent.ShowWrong(this, "请填写楼层", "plus_d");
	})
	jQuery('#1floor').blur(function(){
		rent.check_1floor(this);
	})
	//检测楼层->独栋
	jQuery('#3totalfloor').focus(function(){
		rent.ShowWrong(this, "请填写楼层", "plus_d");
	})
	jQuery('#3totalfloor').blur(function(){
		rent.check_3totalfloor(this);
	})
	//楼层 多层
	jQuery('input[name=2floor]').focus(function(){
		rent.ShowWrong('#2floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=2floor]').blur(function(){
		rent.check_2floor(this);
	})
	jQuery('input[name=2totalfloor]').focus(function(){
		rent.ShowWrong('#2floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=2totalfloor]').blur(function(){
		rent.check_2totalfloor(this);
	})
	

	//商铺出租类型
	jQuery('[id^=shoprenttype_]').click(function(){
		rent.check_shoprenttype(this);
	})
	
	//出租 转让
	jQuery('#transferfee').focus(function(){
		rent.ShowWrong(this, "请填写转让费", "plus_d");
	})
	jQuery('#transferfee').blur(function(){
		if($('[id^=transfertype_]:checked').val() == 0){
			rent.check_istransferfee(this);
		}
	})
	
	//当前状态
	jQuery('[id^=businessstatus_]').click(function(){
		rent.check_businessstatus(this);
	})
	//当前行业
	jQuery('.industry_select').live("click",function(){
		rent.check_businessindustry('#businessindustry');
	})
	
	//提交
	jQuery("#dosubmit").click(function() {
		if (rent.check()) {
			jQuery("#myform").submit();
		}
		return false;
	});
});

//验证手机号码
function check_mobile(obj) {
	var objvar = val(obj);
	var reg_mobile = /^1[3458]\d{9}$/; //手机(13,15,18)
    if (!reg_mobile.test(objvar)){
		rent.ShowWrong(obj, "请输入正确格式的手机号码", "plus_c");
		rent.isusertel = false;
        return false;
    }else{
		rent.isusertel = true; //用户名验证正确
		rent.ShowWrong(jQuery("#usertel"), "", "pw_success");
    }
}

//得到输入值，已过滤空格
function val(obj) {
    return jQuery.trim(jQuery(obj).val());
}



//出租房 验证对象
var rent = new validator();
rent.check = function(){
	var typeid = $("input[name=renthouse]:checked").val();
	if(typeid == "0" || typeid == ""){
		alert("请选择房源类型");
		return false;
	}
	
	/*共有*/
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
		/*二手房 写字楼*/
		this.checkVillageName("#villagename"); //isvillagename    二手房  写字楼
		this.check_rent("[id^=renttype_]:checked"); //isrenttype    二手房
		this.check_paytype("input[name=paytype]"); //ispaytype    二手房
		this.check_paytype2("input[name=paytype2]"); //ispaytype2    二手房
		this.check_decorate("input[name=decorate]:checked"); //isdecorate    二手房
		this.checkProperty("input[name=property]:checked"); //isproperty    二手房
		this.checkRoom("input[name=room]"); //isroom    二手房
		this.checkHall("input[name=hall]"); //ishall    二手房
		this.checkToilet("input[name=toilet]"); //istoilet    二手房
		this.check_aspect("input[name=aspect]:checked"); //isaspect    二手房
		this.check_houseage("#houseage"); //ishouseage    二手房
		this.check_floor("input[name=floor]"); //isfloor
		this.check_floor_again("input[name=totalfloor]"); //isflooragain
	}
	
	var floor_status = pay_status = curbus_status  = transfer_status = true;
	if(typeid == 6){
		/*商铺*/
		this.checkPropertyname("#propertyname"); //ispropertyname
		this.check_area("#shop_areaid"); //isareaid
		this.check_address("#address"); //isaddress
		this.check_manageprice("#manageprice"); //ismanageprice
		this.check_laticoor("#laticoor"); //islaticoor
		this.check_longcoor("#longcoor"); //islongcoor
		this.check_shoptype('[id^=shoptype_]:checked'); //isshoptype
		this.check_paytype("input[name=paytype]"); //ispaytype
		this.check_paytype2("input[name=paytype2]"); //ispaytype2
		//当前状态
		this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
		
		this.check_shoprenttype('[id^=shoprenttype_]:checked'); //isshoprenttype
		//转让费
		if($("[id^=shoprenttype_]:checked").val() == 1 && $("[id^=transfertype_]:checked").val() == 0){
			this.check_istransferfee('#transferfee'); //istransferfee  仅出租
			transfer_status = this.istransferfee;
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
		//当前行业
		var cur_busstatus =  parseInt($('input[name=businessstatus]:checked').val());
		if(cur_busstatus == 1 || cur_busstatus == 2){
			this.check_businessindustry("#businessindustry"); //isbusinessindustry
			curbus_status = this.isbusinessindustry;
		}
	}

	

	var otherdom = false;

	
	if(typeid == 1){ //住宅
		if ( this.isvillagename  && this.isrenttype 
			   && this.ispaytype && this.ispaytype2 && this.isdecorate && this.isproperty && this.isroom && this.ishall && this.istoilet && this.isaspect
				  && this.ishouseage && this.isfloor && this.isflooragain
			) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 4){ //写字楼
		if ( this.isvillagename && this.isfloorarea) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 6){ //商铺
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
