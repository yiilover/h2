var globalSaleFloors = null;
var currentComm = null;
var commID = null;
var dialogFilter = null;
function getNewFloors(e, b, c, a, d, m, n, f) {
	bounds = map.getBounds();//实例化边界
	var max_y = bounds.getNorthEast().lng;
	var max_x = bounds.getNorthEast().lat;
	var min_y = bounds.getSouthWest().lng;
	var min_x = bounds.getSouthWest().lat;
	if(module == 'ershoufang'){
		var ajaxurl = ESF_URL + "api.php?op=get_esf_house";
	}else if(module == 'zufang'){
		var ajaxurl = RENT_URL + "api.php?op=get_esf_house&type=rent";
	}
	$.ajax({
		type : "GET",
		url : ajaxurl + "&operate=getNewHouses&areaid=" + e
				+ "&circleid=" + b + "&price=" + c + "&roomtype=" + a + "&area=" + d
				+ "&houseage=" + m + "&project=" + n + "&keywords=" + (params.keyword != '' ? encodeURIComponent(params.keyword) : '')
				+ "&minX=" + min_x + "&maxX=" + max_x + "&minY=" + min_y + "&maxY=" + max_y + '&random=' + Math.random(),
		dataType: 'json',
		success : function(h) {
			if(h.xiaoqu){
				if (arguments.length == 8 || f == true) {
					var g = new BMap.Point(params.l2, params.l1);
					map.centerAndZoom(g, params.l3);
				}
				if (h.xiaoqu != null) {
					globalSaleFloors = h.xiaoqu;
					ShowLabel();
				}
			}else{
				map.clearOverlays();
				alert('没有相应条件的小区存在，请尝试其他条件！');
			}
		}
	})
}
function getKeyHouse(k) {
	if(module == 'ershoufang'){
		var ajaxurl = ESF_URL + "api.php?op=get_esf_key_house";
	}else if(module == 'zufang'){
		var ajaxurl = RENT_URL + "api.php?op=get_esf_key_house&type=rent";
	}
	$.ajax({
		type : "GET",
		url : ajaxurl + "&operate=getNewHouses&keywords=" + encodeURIComponent(k),
		dataType : 'json',
		success : function(h) {
			if(h){
				params.l1 = h.xiaoqu.bmapy;
				params.l2 = h.xiaoqu.bmapx;
				params.l3 = 15;
				location.hash = $.param(params);
				var g = new BMap.Point(h.xiaoqu.bmapx, h.xiaoqu.bmapy);
				map.centerAndZoom(g, params.l3);
				globalSaleFloors = h.xiaoqu;
				ShowLabel();
				searchHouse();
			}else{
				alert('没有找到该小区');
			}
		}
	})
}
function getCurrentHouses(type){
	bounds = map.getCenter();//实例化边界
	params.l1 = bounds.lat;//当前中心点X
	params.l2 = bounds.lng;//当前的中心点Y
	params.l3 = map.getZoom();//当前缩放级别
	if(type == 'dragend'){
		params.a1 = 0;
		params.a2 = 0;
		params.h  = '';
	}	
	//拖动时区域变化 但是其它搜索条件不变化，故上面只重置区域和商圈
	initSearchStyle(params);
}
function searchHouse(){
	initBmap(params);//初始化url参数
	getNewFloors(filter.areaid, filter.circleid, filter.price, filter.roomtype, filter.area, filter.houseage, filter.project, true);
}
function keywordSearch(){
	getKeyHouse(params.keyword);
}
var chk6 = true, chk4 = true, chk3 = true, chk2 = true, chk1 = true;
function ShowLabel() {
	if(module == 'ershoufang'){
		var schedule = 1;
	}else if(module == 'zufang'){
		var schedule = 2;
	} 
	map.clearOverlays();
	var a = 0;
	var b = map.getBounds();
	if (globalSaleFloors != null) {
		bMapLabelList = [];
		$.each(globalSaleFloors, function(c) {
			if(parseInt(globalSaleFloors[c].bmapx) == 0 || parseInt(globalSaleFloors[c].bmapy == 0)){
				return true;
			}
			var d = new BMap.Point(globalSaleFloors[c].bmapx,globalSaleFloors[c].bmapy);
			if (b.containsPoint(d)) {
				createBmapLabel(
					globalSaleFloors[c].communityid,
					globalSaleFloors[c].housenums,
					globalSaleFloors[c].communityname,
					d,
					globalSaleFloors[c],
					schedule,
					globalSaleFloors[c].current
				);
				/*a++;
				if (map.getZoom() > 13) {
					if (a >= 49) {
						return false
					}	//暂不限制房源显示套数 
				} else {
					if (map.getZoom() > 10) {
						if (a >= 29) {
							return false
						}
					} else {
						if (a >= 9) {
							return false
						}
					}
				}*/
			}
		})
	}
}
function openTipFrame(c, b) {
	var a = $("#ppp");
	a.css("top", 110).css("left", ($("#container").width() - a.width()) / 2).css('overflow', 'hidden');
	a.show();
	dialogFilter = {"price": filter.price, 'roomtype': filter.roomtype, 'area': filter.area, 'houseage': filter.houseage, "project": filter.project, 'page': 1, 'areaorder': '', 'priceorder': ''};
	communityData(c, b);
}
function communityData(c, b)
{
	currentComm = b;
	commID = c;
	if(module == 'ershoufang'){
		var ajaxurl = ESF_URL + "api.php?op=houselist";
		var houseurl = COMMUNITY_URL;
		var unit = '万';
	}else if(module == 'zufang'){
		var ajaxurl = RENT_URL + "api.php?op=houselist&type=rent";
		var houseurl = COMMUNITY_URL+'rent-';
		var unit = '元/月';
	}
	$.ajax({
		type : "GET",
		url : ajaxurl + "&o=getHouse&communityid=" 
			+ c + "&price=" + dialogFilter.price + "&roomtype=" + dialogFilter.roomtype
			+ "&area=" + dialogFilter.area + "&houseage=" + dialogFilter.houseage 
			+ "&project=" + dialogFilter.project + "&curpage=" + dialogFilter.page
			+ "&areaorder=" + dialogFilter.areaorder + "&priceorder=" + dialogFilter.priceorder
		,
		beforeSend : function() {
			$('#property_list').html('');
			$(".map2_propwind_commname").html("<a target=\"_blank\" class=\"map2_propwind_listlink\" href='"+ COMMUNITY_URL
					+ b.communityid
					+ ".html'>"
					+ b.communityname + "</a>");
			$('.prop_pricetrend').html(b.sellprice);
			$("#dmsg").html("<div align='center' style='position:relative; top:40px;'><img src='"+ IMG_URL +"statics/default/img/esf/8-0.gif' /></div>");
			$('#dmsg').show();
			$('.map2_comm_moreinfo').attr('href', COMMUNITY_URL + 'xiaoqu-show-' + c + '.html');
			$('.map2_comm_fresh').attr('href', COMMUNITY_URL + 'xiaoqu-price-' + c + '.html');
		},
		dataType: 'json',
		success : function(e) {
			if(e.price){//价格dom
				if(dialogFilter.price == 0){
					var pricedom = '<li id="" class="selected"><a id="price_filter_0" priceid="0" href="javascript:;">不限</a></li>';
				}else{
					var pricedom = '<li id="" ><a id="price_filter_0" priceid="0" href="javascript:;">不限</a></li>';
				}
				$.each(e.price, function(i, n){
					if(n.fid == dialogFilter.price){
						pricedom += '<li id="" class="selected"><a id="price_filter_' + n.fid + '" priceid="' + n.fid + '" href="javascript:;">' + n.name + '</a></li>';
					}else{
						pricedom += '<li id=""><a id="price_filter_' + n.fid + '" priceid="' + n.fid + '" href="javascript:;">' + n.name + '</a></li>';
					}
				})
				$('#map2_filters_price').html(pricedom);
			}
			if(e.room){//房型dom
				if(dialogFilter.roomtype == 0){
					var roomdom = '<li id="" class="selected"><a id="room_filter_0" roomid="0" href="javascript:;">不限</a></li>';
				}else{
					var roomdom = '<li id="" ><a id="room_filter_0" roomid="0" href="javascript:;">不限</a></li>';
				}					
				$.each(e.room, function(i, n){
					if(n.fid == dialogFilter.roomtype){
						roomdom += '<li id="" class="selected"><a id="room_filter_' + n.fid + '" roomid="' + n.fid + '" href="javascript:;">' + n.name + '</a></li>';
					}else{
						roomdom += '<li id=""><a id="room_filter_' + n.fid + '" roomid="' + n.fid + '" href="javascript:;">' + n.name + '</a></li>';
					}
				})
				$('#map2_filters_roomtype').html(roomdom);
			}
			if (!$.isEmptyObject(e.house)) {//房源列表dom
				$("#dmsg").siblings('#noprops').hide();
				$('#dmsg').hide();
				$('.prop_num').html(e.nums);
				$('.total_pages').html(e.curpage + '/' + e.totalpage);
				var propertylist = '';
				
				$.each(e.house, function(i, n){
					propertylist += '<li class=""><div class="proimg"><a href="' + houseurl + 'show-'+n.hid + '.html"  target="_blank">'
						+ '<img width="53" height="40" border="0" src="' + n.titlepic + '"></a></div><div class="proname">'
						+ '<p class="title"><a title="' + n.title + '" href="' + houseurl + 'show-'+ n.hid + '.html" target="_blank">'+ n.title + '</a>';
					if(parseInt(n.pictag) == 1){
						propertylist += '<img alt="" src="' + IMG_URL + 'statics/default/img/esf/icon-more-28x16.gif">';
					}						
					propertylist += '</p><p>' + n.room + '室' + n.hall + '厅，' + n.area + '平米，' + n.floor + '/' + n.totalfloor +'层</p>'
						+ '</div><div class="price">' + n.price + '<span style="font-weight:normal;font-size:12px;color:#EB6100">' + unit + '</span></div><div style="clear:both;"></div></li>';
				});
				$('#property_list').html(propertylist);
				$('.prop_num').html(e.nums);
				if(e.curpage == 1 && e.curpage != e.totalpage){
					$('.page_prev').css('visibility', 'hidden');
					$('.page_next').css('visibility', 'visible');
				}else if(e.curpage > 1 && e.curpage < e.totalpage){
					$('.page_prev').css('visibility', 'visible');
					$('.page_next').css('visibility', 'visible');
				}else if(e.curpage > 1 && e.curpage == e.totalpage){
					$('.page_prev').css('visibility', 'visible');
					$('.page_next').css('visibility', 'hidden');
				}else if(e.curpage == 1 && e.curpage == e.totalpage){
					$('.page_prev').css('visibility', 'hidden');
					$('.page_next').css('visibility', 'hidden');
				}
				dialogFilter.totalpage = e.totalpage;
			} else {
				$("#dmsg").siblings('#noprops').show();
				$('#dmsg').hide();
				$('.prop_num').html(0);
				dialogFilter.totalpage = 1;
			}
		}
	})
}