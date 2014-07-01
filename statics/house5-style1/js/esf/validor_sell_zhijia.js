jQuery(document).ready(function() {
	//房屋类型
	jQuery('input[name=renthouse]').click(function(){
		sell.checkRenthouse(this);
	})
	
	//小区
	jQuery('#villagename').focus(function(){
		sell.ShowWrong(this, "请填写小区的名称", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		sell.checkVillageName(this);
	})
	
	//所在区域
	$(".area_select").click(function(){
		sell.check_area("#shop_areaid");
	});
	
	//建筑面积
	jQuery('#buildarea').focus(function(){
		sell.ShowWrong(this, "请填写建筑面积", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		sell.check_buildarea(this);
	})
	

	
	//价格
	jQuery('#price').focus(function(){
		sell.ShowWrong(this, "请填写价格", "plus_d");
	})
	jQuery('#price').blur(function(){
		sell.check_price(this);
	})
	

	
	//装修情况
	jQuery('input[name=decorate]').click(function(){
		sell.check_decorate(this);
	})
	
	//房屋类型
	jQuery('[id^=property_]').click(function(){
		sell.checkProperty(this);
	})
	
	//检测楼层
	jQuery('input[name$=floor]').focus(function(){
		sell.ShowWrong('#floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		sell.check_floor(this);
	})
	jQuery('input[name=totalfloor]').blur(function(){
		sell.check_floor_again(this);
	})
	
	//楼层区域
	jQuery('input[name=floor]').click(function(){
		sell.check_floorarea(this);
	})
	
	//户型室
	jQuery('input[name=room]').focus(function(){
		sell.ShowWrong('#room', "请填写户型的居室", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		sell.checkRoom(this);
	})
	//户型厅
	jQuery('input[name=hall]').focus(function(){
		sell.ShowWrong('#room', "请填写户型的客厅", "plus_d");
	})
	jQuery('input[name=hall]').blur(function(){
		sell.checkHall(this);
	})
	//户型卫
	jQuery('input[name=toilet]').focus(function(){
		sell.ShowWrong('#room', "请填写户型的卫生间", "plus_d");
	})
	jQuery('input[name=toilet]').blur(function(){
		sell.checkToilet(this);
	})
	
	//房屋朝向
	jQuery('input[name=aspect]').click(function(){
		sell.check_aspect(this);
	})
	
	//房龄
	jQuery('#houseage').focus(function(){
		sell.ShowWrong(this, "请填写建造年代", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		sell.check_houseage(this);
	})
	
	//房源标题
	jQuery('#title').focus(function(){
		sell.ShowWrong(this, "请填写房源标题", "plus_d");
	})
	jQuery('#title').blur(function(){
		sell.check_title(this);
	})
	
	//联系人
	jQuery('#username').focus(function(){
		sell.ShowWrong(this, "请输入联系人", "plus_d");
	})
	jQuery('#username').blur(function(){
		sell.checkUsername(this);
	})
	
	//联系电话
	jQuery('#usertel').focus(function(){
		sell.ShowWrong(this, "请填联系电话", "plus_d");
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
	
	//认证码
	jQuery('#encode').focus(function(){
		sell.ShowWrong(this, "请填写认证码", "plus_d");
	})
	jQuery('#encode').blur(function(){
		sell.checkEncode(this);
	})

	//物业名称
	jQuery('#propertyname').focus(function(){
		sell.ShowWrong(this, "请输入物业名称", "plus_d");
	})
	jQuery('#propertyname').blur(function(){
		sell.checkPropertyname(this);
	})
	
	//所在区域
	
	//商铺地址
	jQuery('#address').focus(function(){
		sell.ShowWrong(this, "请填写商铺所在地址!", "plus_d");
	})
	jQuery('#address').blur(function(){
		sell.check_address(this);
	})
	
	//物业管理费
	jQuery('#manageprice').focus(function(){
		sell.ShowWrong(this, "请填写物业管理费", "plus_d");
	})
	jQuery('#manageprice').blur(function(){
		sell.check_manageprice(this);
	})
	
	//商铺类型
	jQuery('[id^=shoptype_]').click(function(){
		sell.check_shoptype(this);
	})
	
	//检测楼层->单层
	jQuery('#1floor').focus(function(){
		sell.ShowWrong(this, "请填写楼层", "plus_d");
	})
	jQuery('#1floor').blur(function(){
		sell.check_1floor(this);
	})
	//检测楼层->独栋
	jQuery('#3totalfloor').focus(function(){
		sell.ShowWrong(this, "请填写楼层", "plus_d");
	})
	jQuery('#3totalfloor').blur(function(){
		sell.check_3totalfloor(this);
	})
	//楼层 多层
	jQuery('input[name=2floor]').focus(function(){
		sell.ShowWrong('#2floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=2floor]').blur(function(){
		sell.check_2floor(this);
	})
	jQuery('input[name=2totalfloor]').focus(function(){
		sell.ShowWrong('#2floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=2totalfloor]').blur(function(){
		sell.check_2totalfloor(this);
	})
	
	//当前状态
	jQuery('[id^=businessstatus_]').click(function(){
		sell.check_businessstatus(this);
	})
	//当前行业
	jQuery('.industry_select').live("click",function(){
		sell.check_businessindustry('#businessindustry');
	})
	
	//提交
	jQuery("#dosubmit").click(function() {
		if (sell.check()) {
			jQuery("#myform").submit();
		}
		return false;
	});
});

//验证手机号码
function check_mobile(obj) {
	var objvar = val(obj);
    if (objvar == "") {
		sell.ShowWrong(obj, "请输入联系电话", "plus_c");
        return false;
    }else{
		var asktel = val((jQuery("#usertel")));
		var reg2=/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3|4|5|8][0-9]{9}$)/; 
		if(!reg2.test(asktel)){
			isusertel = false;
			sell.ShowWrong(jQuery("#usertel"), "手机号码不正确", "plus_c");
		}
		else
		{
			sell.isusertel = true; //用户名验证正确
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
					sell.isusertel = true; //用户名验证正确
					//显示成功
					sell.ShowWrong(jQuery("#usertel"), "", "pw_success");
				}else {
					isusertel = false;
					sell.ShowWrong(jQuery("#usertel"), req.tips, "plus_c");
				}
			}
		});*/
    }
}

//得到输入值，已过滤空格
function val(obj) {
    return jQuery.trim(jQuery(obj).val());
}

//出租房 验证对象
var sell = new validator();
sell.check = function(){
	var typeid = $("input[name=renthouse]:checked").val();
	if(typeid == "0" || typeid == ""){
		alert("请选择房源类型");
		return false;
	}
	
	/*共有*/
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
		/*二手房 写字楼*/
		this.checkVillageName("#villagename"); //isvillagename    二手房  写字楼
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
	
	if(typeid == 3){
		/*写字楼*/
		this.checkVillageName("#villagename"); //isvillagename    二手房  写字楼
		this.check_floorarea("[id^=floorarea_]:checked"); //isfloorarea
	}

	var floor_status = curbus_status  = true;
	if(typeid == 5){
		/*商铺*/
		this.checkPropertyname("#propertyname"); //ispropertyname
		this.check_area("#shop_areaid"); //isareaid
		this.check_address("#address"); //isaddress
		this.check_manageprice("#manageprice"); //ismanageprice
		this.check_laticoor("#laticoor"); //islaticoor
		this.check_longcoor("#longcoor"); //islongcoor
		this.check_shoptype('[id^=shoptype_]:checked'); //isshoptype
		//当前状态
		this.check_businessstatus('[id^=businessstatus_]:checked'); //isbusinessstatus
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
		if ( this.isvillagename  
			    && this.isdecorate && this.isproperty && this.isroom && this.ishall && this.istoilet && this.isaspect
				  && this.ishouseage && this.isfloor && this.isflooragain
			) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	if(typeid == 3){ //写字楼
		if ( this.isvillagename && this.isfloorarea) {
			otherdom = true;
		}else{
			otherdom = false;
		}
	}
	
	if(typeid == 5){ //商铺
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
