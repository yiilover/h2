jQuery(document).ready(function() {
	//小区
	jQuery('#villagename').focus(function(){
		rent.ShowWrong(this, "请填写小区的名称", "plus_d");
	})
	jQuery('#villagename').blur(function(){
		rent.checkVillageName(this);
	})
	//是否合租
	if($('input[name=renttype]:checked').val() == 3){
		$('#price_unit').html('元/日');
		$('input[name=paytype]').val('');
		$('input[name=paytype2]').val('');
		$('#pay_layer').hide();
		rent.ispaytype = true;
		rent.ispaytype2 = true;
	}else{
		$('#price_unit').html('元/月');
		$('#pay_layer').show();
		rent.ispaytype = false;
		rent.ispaytype2 = false;
	}
	jQuery('input[name=renttype]').click(function(){
		rent.check_rent(this);		
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
	//建筑面积
	jQuery('#buildarea').focus(function(){
		rent.ShowWrong(this, "请填写建筑面积", "plus_d");
	})
	jQuery('#buildarea').blur(function(){
		rent.check_buildarea(this);
	})
	//户型室
	jQuery('input[name=room]').focus(function(){
		rent.ShowWrong('#room', "请填写户型的居室", "plus_d");
	})
	jQuery('input[name=room]').blur(function(){
		rent.checkRoom(this);
	})
	//价格
	jQuery('#price').focus(function(){
		rent.ShowWrong(this, "请填写价格", "plus_d");
	})
	jQuery('#price').blur(function(){
		rent.check_price(this);
	})
	//装修情况
	jQuery('input[name=decorate]').click(function(){
		rent.check_decorate(this);
	})
	//房屋朝向
	jQuery('input[name=aspect]').click(function(){
		rent.check_aspect(this);
	})
	//房龄
	/*jQuery('#houseage').focus(function(){
		rent.ShowWrong(this, "请填写建造年代", "plus_d");
	})
	jQuery('#houseage').blur(function(){
		rent.check_houseage(this);
	})*/
	//房源标题
	jQuery('#title').focus(function(){
		rent.ShowWrong(this, "请填写房源标题", "plus_d");
	})
	jQuery('#title').blur(function(){
		rent.check_title(this);
	})
	//提交
	jQuery("#dosubmit").click(function() {
		if (rent.check()) {
			$("#postsubmit").css('display',"block").attr("disabled",true);											 
			$('#dosubmit').css('display',"none");
			jQuery("#myform").submit();
		}
	});
});