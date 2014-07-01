String.prototype.toQueryParams = function(b){
    var a=this.strip().match(/([^?#]*)(#.*)?$/);
    if(!a){
        return {}
    }
    var getvalue = a[1].split(b||'&');    
	param = obj2Json(getvalue);
    params = eval('(' + param + ')');
    return params;
}
String.prototype.strip = function(){
	return this.replace(/^\s+/,"").replace(/\s+$/,"")
}
function obj2Json(obj){
	var ret = [];
	for (var a in obj){
		if(obj[a].split('=')[0]){
			ret.push(obj[a].split('=')[0] + ':' + (obj[a].split('=')[1] != '' ? '\'' + obj[a].split('=')[1] + '\'' : '\'\''));
		}
	}
	return '{' + ret.join(',') + '}';
}
function addDom(obj){
	obj.find('dl.DL1').first().removeClass('init_drop_list');
	obj.find('dl.DL1').first().addClass('over_drop_list');
}
function delDom(obj){
	obj.find('dl.DL1').first().removeClass('over_drop_list');
	obj.find('dl.DL1').first().addClass('init_drop_list');
}
function MM_showHideLayers(v) {
	var apDiv3 = $("#apDiv3"); 
	if(v=="show"){
		apDiv3.css("visibility","visible"); 
	}else{ 
		apDiv3.css("visibility","hidden");
	} 
}
function closeMapInfoDiv(){
	$("#ppp").hide();
	$("#chkMorePic").attr("checked",false);
	dialogFilter = {"price": 0, 'roomtype': 0, 'area': 0, 'houseage': 0, "project": 0, 'page': 1, 'areaorder': '', 'priceorder': ''};
	$('.sort_button').removeClass('sort_button_up');
	$('.sort_button').removeClass('sort_button_down');
}

function ShowWindowWidthHeight(title, url, _width, _height) {
	$.plugins.showDialog('closeDialog', title, url, _width, _height); 
} 
function dialog_close(){ 
	$.plugins.closeDialog("closeDialog");
}
function initBmap(params){
	if(!$.isEmptyObject(params)){
		//此下else分支控制url
		if (params.l1 != undefined && params.l1 > 0 && params.l2 != undefined && params.l2 > 0 && params.l3 != undefined && parseInt(params.l3)>0) {
            center.lat = parseFloat(params.l1);
            center.lng = parseFloat(params.l2);
            center.zoom = parseInt(params.l3);
        }else{
        	params.l1 = center.lat;
        	params.l2 = center.lng;
        	params.l3 = center.zoom;
        }
		var reset = new BMap.Point(params.l2, params.l1);
		map.setCenter(reset);
        if (params.a1 != undefined && parseInt(params.a1) >= 0) {
            filter.areaid = parseInt(params.a1);//区域ID
        }else{
        	params.a1 = '';
        	filter.areaid = 0;
        }

        if (params.a2 != undefined && parseInt(params.a2) >= 0) {
            filter.circleid = parseInt(params.a2);//商圈ID
        }else{
        	params.a2 = '';
        	filter.circleid = 0;
        }

        if (params.f1 != undefined && parseInt(params.f1) >= 0) {
            filter.price = parseInt(params.f1);//均价
        }else{
        	params.f1 = '';
        	filter.price = 0;
        }
        
        if (params.f2 != undefined && parseInt(params.f2) >= 0) {
            filter.roomtype = parseInt(params.f2);//户型
        }else{
        	params.f2 = '';
        	filter.roomtype = 0;
        }
        
        if (params.f3 != undefined && parseInt(params.f3) >= 0) {
            filter.area = parseInt(params.f3);//面积
        }else{
        	params.f3 = '';
        	filter.area = 0;
        }

        if (params.f4 != undefined && parseInt(params.f4) >= 0) {
            filter.houseage = parseInt(params.f4);//建筑年代
        }else{
        	params.f4 = '';
        	filter.houseage = 0;
        }

        if (params.f5 != undefined && parseInt(params.f5) >= 0) {
            filter.project = parseInt(params.f5);//项目类型
        }else{
        	params.f5 = '';
        	filter.project = 0;
        }
        
        if (params.h != undefined && parseInt(params.h) >= 0) {
            params.h = parseInt(params.h);//浏览记录
        }else{
        	params.h = '';
        }
        
        if (params.keyword != undefined && params.keyword != '\u8f93\u5165\u540d\u79f0\u6216\u5730\u6807'){
            filter.keyword = params.keyword;//搜索关键字
        }else{
        	params.keyword = '';
        	filter.keyword = '';
        }
    	location.hash = $.param(params);
	}else{
		//设置参数
		params.l1 = center.lat;
    	params.l2 = center.lng;
    	params.l3 = center.zoom;
    	params.a1 = '';
    	params.a2 = '';
    	params.f1 = '';
    	params.f2 = '';
    	params.f3 = '';
    	params.f4 = '';
    	params.f5 = '';
    	params.h = '';//浏览记录
    	params.keyword = '';
		var url = {'l1': center.lat, 'l2': center.lng, 'l3': center.zoom, 'a1': '', 'a2': '', 'f1': '', 'f2': '', 'f3': '', 'f4': '', 'f5': '', 'keyword': '', 'h': ''};
		location.hash = $.param(url);				
	}
}
function initSearchStyle(params){
	if($('#keyword').val() != "\u8f93\u5165\u540d\u79f0\u6216\u5730\u6807" && $('#keyword').val() != ''){
		keywordSearch();
		$('#keyword').val(params.keyword);
		return;
	}
	$.each($('#price a'), function(){//价格
		if(params.f1 == $(this).attr('fid')){
			$(this).addClass('onfocus');
		}else{
			$(this).removeClass('onfocus');
		}
	})
	$.each($('#roomtype a'), function(){//项目类型
		if(params.f2 == $(this).attr('fid')){
			$(this).addClass('onfocus');
		}else{
			$(this).removeClass('onfocus');
		}
	})
	$.each($('#sidebar_filter_area a'), function(){//面积
		if(params.f3 == $(this).attr('paramid')){
			$('#filter_area a').addClass('onfocus');
			$('#filter_area a').html($(this).html());
		}else{
			$('#filter_area').removeClass('onfocus');
		}
	})
	$.each($('#sidebar_filter_age a'), function(){//建筑年代
		if(params.f4 == $(this).attr('paramid')){
			$('#filter_age a').addClass('onfocus');
			$('#filter_age a').html($(this).html());
		}else{
			$('#filter_age').removeClass('onfocus');
		}
	})
	$.each($('#sidebar_filter_type a'), function(){//项目类型
		if(params.f5 == $(this).attr('paramid')){
			$('#filter_type a').addClass('onfocus');
			$('#filter_type a').html($(this).html());
		}else{
			$('#filter_type').removeClass('onfocus');
		}
	})
	$.each($('#areaList a'), function(){//区域
		if(params.a1 == $(this).attr('pid')){
			$('#currentArea').html($(this).html());
			return false;
		}
	})
	$.each($('#blockList a'), function(){//商圈
		if(params.a2 == $(this).attr('pid')){
			$('#currentCircle').html($(this).html());
			return false;
		}
	})
	/*$.each($('#recentList a'), function(){//浏览记录
		if(params.h == $(this).attr('hid')){
			$('#recent_select').html($(this).html());
		}
	})*/
	searchHouse();
}
function initDisplayStyle(){
	$('#area').find('dl.DL1').first().addClass('init_drop_list');
	$('#area').mouseover(function(){
		addDom($(this));
		$('#areaList').show();
	})
	$('#area').mouseout(function(){
		delDom($(this));
		$('#areaList').hide();
	})
	$('#block').find('dl.DL1').first().addClass('init_drop_list');
	$('#block').mouseover(function(){
		addDom($(this));
		$('#blockList').show();
	})
	$('#block').mouseout(function(){
		delDom($(this));
		$('#blockList').hide();
	})
	$('#recent').find('dl.DL1').first().addClass('init_drop_list');
	$('#recent').mouseover(function(){
		addDom($(this));
		$('#recentList').show();
	})
	$('#recent').mouseout(function(){
		delDom($(this));
		$('#recentList').hide();
	})
	$('#filter_area').hover(
		function(){			
			$(this).addClass('selected');
			$('#sidebar_filter_area').show();
		},  
		function(){			
			$('#sidebar_filter_area').hide();
			$(this).removeClass('selected');
		}
	)
	$('#sidebar_filter_area').hover(
		function(){			
			$('#filter_area').addClass('selected');
			$(this).show();
		},  
		function(){
			$(this).hide();
			$('#filter_area').removeClass('selected');
		}
	)
	$('#filter_age').hover(
		function(){
			$(this).addClass('selected');
			$('#sidebar_filter_age').show();
		},  
		function(){
			$('#sidebar_filter_age').hide();
			$(this).removeClass('selected');
		}
	)
	$('#sidebar_filter_age').hover(
		function(){
			$('#filter_age').addClass('selected');
			$(this).show();
		},  
		function(){
			$(this).hide();
			$('#filter_age').removeClass('selected');
		}
	)
	$('#filter_type').hover(
		function(){
			$(this).addClass('selected');
			$('#sidebar_filter_type').show();
		},  
		function(){
			$('#sidebar_filter_type').hide();
			$(this).removeClass('selected');
		}
	)
	$('#sidebar_filter_type').hover(
		function(){
			$('#filter_type').addClass('selected');
			$(this).show();
		},  
		function(){
			$(this).hide();
			$('#filter_type').removeClass('selected');
		}
	)
}
function initDomsSearch()
{
	$('[id^=price_filter_]').live('click', function(){
		dialogFilter.price = $(this).attr('priceid');
		dialogFilter.page = 1;
		communityData(commID, currentComm);
	})
	$('[id^=room_filter_]').live('click', function(){
		dialogFilter.roomtype = $(this).attr('roomid');
		dialogFilter.page = 1;
		communityData(commID, currentComm);
	})
	$('.page_prev').live('click', function(){
		if(dialogFilter.page > 1){
			--dialogFilter.page;
		}
		communityData(commID, currentComm);
	})
	$('.page_next').live('click', function(){
		if(dialogFilter.page < dialogFilter.totalpage){
			++dialogFilter.page;
		}		
		communityData(commID, currentComm);
	})
	$('.sort_button').click(function(){
		$('.sort_button').removeClass('sort_button_up');
		$('.sort_button').removeClass('sort_button_down');
		if($(this).attr('rel') == 'area'){
			dialogFilter.priceorder = '';
			if(dialogFilter.areaorder == '' || dialogFilter.areaorder == 'DESC'){
				dialogFilter.areaorder = 'ASC';
				$(this).addClass('sort_button_down');
				$(this).removeClass('sort_button_up');
			}else if(dialogFilter.areaorder == 'ASC'){
				dialogFilter.areaorder = 'DESC';
				$(this).addClass('sort_button_up');
				$(this).removeClass('sort_button_down');				
			}
		}else if($(this).attr('rel') == 'price'){
			dialogFilter.areaorder = '';
			if(dialogFilter.priceorder == '' || dialogFilter.priceorder == 'DESC'){
				dialogFilter.priceorder = 'ASC';
				$(this).addClass('sort_button_down');
				$(this).removeClass('sort_button_up');
			}else if(dialogFilter.priceorder == 'ASC'){
				dialogFilter.priceorder = 'DESC';
				$(this).addClass('sort_button_up');
				$(this).removeClass('sort_button_down');
			}
		}
		communityData(commID, currentComm);
	})
}