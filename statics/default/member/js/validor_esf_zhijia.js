jQuery(document).ready(function() {
	//小区
	jQuery('#villagename').focus(function(){
		esf.ShowWrong(this, "请填写小区的名称", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		esf.checkVillageName(this);
		
	})
	//房屋类型
	jQuery('[id^=property_]').click(function(){
		esf.checkProperty(this);
		
	})
	//检测楼层
	jQuery('input[name$=floor]').focus(function(){
		esf.ShowWrong('#floor', "请填写具体的楼层", "plus_d");
	})
	jQuery('input[name=floor]').blur(function(){
		esf.check_floor(this);
		
	})
	jQuery('input[name=totalfloor]').blur(function(){
		esf.check_floor_again(this);
		
	})
	//建筑面积
	jQuery('#buildarea').focus(function(){
		esf.ShowWrong(this, "请填写建筑面积", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		esf.check_buildarea(this);
		
	})
	//户型室
	jQuery('input[name=room]').focus(function(){
		esf.ShowWrong('#room', "请填写户型的居室", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		esf.checkRoom(this);
		
	})	
	//价格
	jQuery('#price').focus(function(){
		esf.ShowWrong(this, "请填写价格", "plus_d");
	})
	jQuery('#price').blur(function(){
		esf.check_price(this);
		
	})
	//装修情况
	jQuery('input[name=decorate]').click(function(){
		esf.check_decorate(this);
		
	})
	//房屋朝向
	jQuery('input[name=aspect]').click(function(){
		esf.check_aspect(this);
		
	})
	//房龄
	/*jQuery('#houseage').focus(function(){
		esf.ShowWrong(this, "请填写建造年代", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		esf.check_houseage(this);
	})*/
	//房源标题
	jQuery('#title').focus(function(){
		esf.ShowWrong(this, "请填写房源标题", "plus_d");
	})
	jQuery('#title').blur(function(){
		
		esf.check_title(this);
	})
	//提交
	jQuery("#dosubmit").click(function() {
		if (esf.check()) {
			$("#postsubmit").css('display',"block").attr("disabled",true);											 
			$('#dosubmit').css('display',"none");
			jQuery("#myform").submit();
		}
	});
});