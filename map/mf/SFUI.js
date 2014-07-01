var SFUI =
{
	checkPurpose:function(v_kaede){
		for(i=0;i<Purposes.length;i++){
			if(Purposes[i].name==v_kaede){
				return Purposes[i].index;
			}
		}
	},
	checkRound:function(v_kaede){
		var datas = mapcityround.split(',');
		for(i=0;i<datas.length;i++){
			if(datas[i].split('|')[0]==v_kaede){
				return datas[i].split('|')[1];
			}
		}
	},
	checkDistricts:function(v_kaede){
		for(i=0;i<Districts.length;i++){
			if(Districts[i].name==v_kaede){
				return Districts[i].index;
			}
		}
	},
	checkArea:function(fid,v_kaede){
		for(i=0;i<Area[fid].length;i++){
			var temp=Area[fid][i].split(',');
			if(temp[1]==v_kaede){
				if(temp[2]){return temp[2];}else{return 0;}
				
			}
		}
	},

	
	//后来实用中发现切换显示或隐藏的用处很少,还是直接设置为显示或隐藏比较有用
	show:function(node) {
		if(!node) return;
		var display ;
		//SPAN 之类的行间元素，使用 inline，其它块级元素使用 block
		var nodeName = node.tagName.toLowerCase();
		//alert(nodeName);
		if ('span' == nodeName) {
			display = 'inline';
		}
		else
		{
			display = 'block';
		}

		node.style.display = display ;
	},
	hide:function(node) {
		if(!node) return;
		node.style.display = 'none';
	},
	//后来实用中发现切换显示或隐藏的用处很少,还是直接设置为显示或隐藏比较有用
	showId:function(nodeId) {
		var node = document.getElementById(nodeId);
		this.show(node);
	},
	hideId:function(nodeId) {
		var node = document.getElementById(nodeId);
		this.hide(node);
	},
	//取页面元素相对窗口的绝对位置
	getAbsPoint : function (e)
	{
		var x = e.offsetLeft;
		var y = e.offsetTop;
		while(e = e.offsetParent)
		{
			x += e.offsetLeft;
			y += e.offsetTop;
		}
		return {'x': x, 'y': y};
	},
	//取元素的实际样式
	getRealStyle : function(node)
	{
		var RealStyle;
		if (node.currentStyle)                            /*先试 IE 的 简单API */
		{
			RealStyle = node.currentStyle;
		}
		else if (window.getComputedStyle)              /* 再试 W3C API */
		{
			RealStyle = window.getComputedStyle(node, null);
		}
		return RealStyle;
	},
	//上述 RealStyle 取得的值，有些不是数字，要再转为数值
	getStyleNum:function(value)
	{
		var num = parseInt(value);
		return ( num > 0) ? num : 0;
	},
	oldDocumentHeight:0,
	//取窗口内页面宽
	getWindowWidth:function()
	{
		return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	},
	//取窗口内页面高
	getWindowHeight:function()
	{
		return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
	},
	getDocumentWidth:function() {
		return document.documentElement.scrollWidth || document.body.scrollWidth;
	},
	getDocumentHeight:function() {
		return document.documentElement.scrollHeight || document.body.scrollHeight;
	},
	setInput: function (itemid, val)
	{
		//	alert(itemid);
		var formitem = $id(itemid);
		if(!formitem) return;
		formitem.value = val;
		//如果输入格里有提示文字，就有提示的样式“inputHint”，设定了值
		//formitem.className='';
		//因为有了点击文档任何地主都会隐藏菜单，所以设定值时就不用再额外隐藏菜单了。
		//this.hide(event);
	},
	setA:function(itemid, val)
	{
		//		alert(itemid);
		if(!$id(itemid)) return;
		$id(itemid).innerHTML = val;
	},
	/*
	普通的一个 a 配一个 input 的设置。
	参数:
	itemid 是 input 的 ID
	val 设给 input 的值
	hint 设给 a 的显示文字
	*/
	setInputA:function(itemid, val, hint)
	{
		this.setInput(itemid, val);
		this.setA(itemid+'_a', hint);
	},
	//str 模板内容
	//obj 替换用的对象，简单的属性值对，如 {'key1':'val1','key2':'val2'}，会把模板中所有的 {$key1}、{$key2} 替换成 {val1}、{val2}
	templateFetch:function (str, obj)
	{
		var retval = str;
		//其实是顺次对 str 执行正则表达式的替换
		for (i in obj)
		{
			var re = new RegExp('\\{'+i+'\\}', 'g');
			retval = retval.replace(re, obj[i]);
		}
		return retval;
	},
	/**
	* Drag.js: drag absolutely positioned HTML elements.
	*
	* This module defines a single drag( ) function that is designed to be called
	* from an onmousedown event handler. Subsequent mousemove events will
	* move the specified element. A mouseup event will terminate the drag.
	* If the element is dragged off the screen, the window does not scroll.
	* This implementation works with both the DOM Level 2 event model and the
	* IE event model.
	*
	* Arguments:
	*
	*   elementToDrag: the element that received the mousedown event or
	*     some containing element. It must be absolutely positioned. Its
	*     style.left and style.top values will be changed based on the user's
	*     drag.
	*
	*   event: the Event object for the mousedown event.
	**/
	drag:function(elementToDrag, event, container)
	{
		// The mouse position (in window coordinates)
		// at which the drag begins
		var startX = event.clientX, startY = event.clientY;
		var container = container || null;
		if(container) container = $id(container);

		// The original position (in document coordinates) of the
		// element that is going to be dragged. Since elementToDrag is
		// absolutely positioned, we assume that its offsetParent is the
		// document body.
		var origX = elementToDrag.offsetLeft, origY = elementToDrag.offsetTop;

		// Even though the coordinates are computed in different
		// coordinate systems, we can still compute the difference between them
		// and use it in the moveHandler( ) function. This works because
		// the scrollbar position never changes during the drag.
		//deltaX 和 deltaY 主要是用来记鼠标位置和元素左上角的偏移量，即通常鼠标刚好不会点在元素的左上角，但点在元素的某位置时也要触发拖动。
		var deltaX = startX - origX, deltaY = startY - origY;
		//showDebug('origX='+origX+', origY='+origY+', startX='+startX+', startY='+startY+', deltaX='+deltaX+', deltaY='+deltaY);
		//console.log('origX='+origX+', origY='+origY+', startX='+startX+', startY='+startY+', deltaX='+deltaX+', deltaY='+deltaY);
		// Register the event handlers that will respond to the mousemove events
		// and the mouseup event that follow this mousedown event.
		if (document.addEventListener) {  // DOM Level 2 event model
			// Register capturing event handlers
			document.addEventListener("mousemove", moveHandler, true);
			document.addEventListener("mouseup", upHandler, true);
		}
		else if (document.attachEvent) {  // IE 5+ Event Model
			// In the IE event model, we capture events by calling
			// setCapture( ) on the element to capture them.
			elementToDrag.setCapture( );
			elementToDrag.attachEvent("onmousemove", moveHandler);
			elementToDrag.attachEvent("onmouseup", upHandler);
			// Treat loss of mouse capture as a mouseup event.
			elementToDrag.attachEvent("onlosecapture", upHandler);
		}
		else {  // IE 4 Event Model
			// In IE 4 we can't use attachEvent( ) or setCapture( ), so we set
			// event handlers directly on the document object and hope that the
			// mouse events we need will bubble up.
			var oldmovehandler = document.onmousemove; // used by upHandler( )
			var olduphandler = document.onmouseup;
			document.onmousemove = moveHandler;
			document.onmouseup = upHandler;
		}

		// We've handled this event. Don't let anybody else see it.
		if (event.stopPropagation) event.stopPropagation( );  // DOM Level 2
		else event.cancelBubble = true;                      // IE

		// Now prevent any default action.
		if (event.preventDefault) event.preventDefault( );   // DOM Level 2
		else event.returnValue = false;                     // IE

		/**
		* This is the handler that captures mousemove events when an element
		* is being dragged. It is responsible for moving the element.
		**/
		function moveHandler(e) {
			if (!e) e = window.event;  // IE Event Model
			//var eventSource = e.target || e.srcElement;
			//这里使用上一变量范围的 elementToDrag 变量，取拖动元素的实际宽和高
			var realStyle = SFUI.getRealStyle(elementToDrag);
			var dragWidth = elementToDrag.offsetWidth;
			var dragHeight = elementToDrag.offsetHeight;
			if(container)
			{
				var contWidth = container.offsetWidth;
				var contHeight = container.offsetHeight;
			}
			else
			{
				var contWidth = SFUI.getDocumentWidth();
				var contHeight = SFUI.oldDocumentHeight;
			}
			//var dragWidth = SFUI.getStyleNum(realStyle.borderLeftWidth) + SFUI.getStyleNum(realStyle.paddingLeft) + SFUI.getStyleNum(realStyle.width) + SFUI.getStyleNum(realStyle.paddingRight) + SFUI.getStyleNum(realStyle.borderRightWidth);
			//alert(blockwidth );
			//var dragHeight = SFUI.getStyleNum(realStyle.borderTopWidth) + SFUI.getStyleNum(realStyle.paddingTop) + SFUI.getStyleNum(realStyle.height) + SFUI.getStyleNum(realStyle.paddingBottom) + SFUI.getStyleNum(realStyle.borderBottomWidth);
			var leftMin = e.clientX - deltaX;
			//可移动的范围改成直接取窗口宽高了，现在相对于上级 relative 元素的移动范围就不灵了，以后再处理一下
			var leftMax = contWidth - dragWidth;
			//Firefox 的窗口宽度会包括滚动条，所以再多减去一点
			/*if (self.innerHeight) {
			leftMax = leftMax - 16;
			};*/
			var dragLeft = (leftMin < 0 ) ? 0 : (leftMax < leftMin) ? leftMax : leftMin;

			var topMin = e.clientY - deltaY;
			//以文档旧高度为移动范围
			//alert();
			var topMax = contHeight - dragHeight;

			var dragTop = (topMin < 0 ) ? 0 : (topMax < topMin) ? topMax : topMin;

			//alert(blockheight );
			//showDebug('getDocumentHeight='+SFUI.getDocumentHeight()+', SFUI.oldDocumentHeight='+SFUI.oldDocumentHeight +', topMin ='+topMin+', topMax='+topMax);
			// Move the element to the current mouse position, adjusted as
			// necessary by the offset of the initial mouse-click.
			//var leftMax = e.clientX - deltaX;
			//限住左右边和上下边。这里移动的外块的尺寸可以扩展为由 getRealStyle 来得到。
			//leftMax = (0 > leftMax) ? 0 :( (leftMax > blockwidth) ? blockwidth : leftMax );
			elementToDrag.style.left = dragLeft  + "px";
			elementToDrag.style.top = dragTop + "px";

			// And don't let anyone else see this event.
			if (e.stopPropagation) e.stopPropagation( );  // DOM Level 2
			else e.cancelBubble = true;                  // IE
		}

		/**
		* This is the handler that captures the final mouseup event that
		* occurs at the end of a drag.
		**/
		function upHandler(e) {
			if (!e) e = window.event;  // IE Event Model

			// Unregister the capturing event handlers.
			if (document.removeEventListener) {  // DOM event model
				document.removeEventListener("mouseup", upHandler, true);
				document.removeEventListener("mousemove", moveHandler, true);
			}
			else if (document.detachEvent) {  // IE 5+ Event Model
				elementToDrag.detachEvent("onlosecapture", upHandler);
				elementToDrag.detachEvent("onmouseup", upHandler);
				elementToDrag.detachEvent("onmousemove", moveHandler);
				elementToDrag.releaseCapture( );
			}
			else {  // IE 4 Event Model
				// Restore the original handlers, if any
				document.onmouseup = olduphandler;
				document.onmousemove = oldmovehandler;
			}

			// And don't let the event propagate any further.
			if (e.stopPropagation) e.stopPropagation( );  // DOM Level 2
			else e.cancelBubble = true;                  // IE
		}
	},
	clearHint:function(formitem) {
		formitem.className = 'guestbook02';
		if (formitem.value == formitem.defaultValue) {
			formitem.value = '';
		}
	},
	toggleHint:function(formitem) {
		formitem.className = 'guestbook02';
		if ('' == formitem.value) {
			formitem.value = formitem.defaultValue;
			formitem.className = 'guestbook01';
		}
	},
	//同级几个 DIV 中显示当前一个，隐藏其它若干个
	showPeer:function(nodeId)
	{
		var pearThis = $id(nodeId);
		if(!pearThis) return;
		var peers = pearThis.parentNode.childNodes;
		for (var i = 0;i<peers.length;i++)
		{
			if ('div'==peers[i].nodeName.toLowerCase())
			{
				if (peers[i] == pearThis)
				{
					peers[i].style.display = 'block';
				}
				else if(peers[i].className == pearThis.className || peers[i].className == pearThis.className+' noshow'  || peers[i].className+' noshow' == pearThis.className)
				{
					peers[i].style.display = 'none';
				}
			}
		}
	}
};

var SFMapUI = {
	init:function() {
		var me = this;
		//me.menu = new Flyer('SFmenu');
		//me.submenu = new Flyer('SFsubmenu');
		//初始化高度
		SFMapUI.autoResize(false,true);
		//SFMapUI.clearAllOption();
		if (filePath.indexOf('zhuangshi') == -1 && filePath.indexOf('jiancaicheng') == -1)
		{
			me.newPurpose();
			me.newOpenyear('opentimesyear');
			me.newOpenyear('opentimeeyear');
			me.newOpenmonth('opentimesmonth');
			me.newOpenmonth('opentimeemonth');
			me.newSort();
		}
		me.newDistrict();
		//if($id('area').value || $id('district').value) $id('district_a').innerHTML = searchcondition.area || searchcondition.district;

		SFUtil.eventAdd(window, 'resize', function()
		{
			if(me.resizeTimeout) clearTimeout(me.resizeTimeout);
			me.resizeTimeout = setTimeout(function(){SFMapUI.autoResize();},100);
		});

		//注册点击文档任何地方关闭菜单
		SFUtil.eventAdd(document, 'click', function(e)
		{
			var e = e || window.event;
			var eventSource = e.target || e.srcElement;
			var expt = $id('panel_moreoptions');
			var expt1 = $id('panel_keyword');
			if(expt1 && !SFUtil.containNode(expt1, eventSource) && !SFUtil.containNode($id('showsuggest'), eventSource) && !SFUtil.containNode($id('keyword'), eventSource)) expt1.style.display = 'none';
			if(!expt || SFUtil.containNode(expt, eventSource)) return;
			var yearMonth = ['panel_opentimesyear_a', 'panel_opentimeeyear_a', 'panel_opentimesmonth_a', 'panel_opentimeemonth_a'];
			for(var i=0; i<yearMonth.length; i++)
			{
				var ele = $id(yearMonth[i]);
				if(!ele) continue;
				else if(SFUtil.containNode(ele, eventSource)) return;
				else ele.style.display = 'none';
			}
			expt.style.display = 'none';
		});
		//悬停出菜单后关闭菜单，一个思路是给文档加 mouseover 事件，把发起菜单的元素 ID 记住，看鼠标 mouseover 的节点是否在菜单体 ID 里，在时维持，不在关闭。

		//由于拖层层时，文档高度会不断变大，在初始化时把文档原高度存在 SFUI 属性里
		SFUI.oldDocumentHeight = SFUI.getDocumentHeight();

		//没有商圈、环线、轨道时，把相应菜单隐藏掉
		//即使城市没有商圈，也有 Area 空数组
		/*if (!Area || 0 == Area.length) {
			SFUI.hideId('area_a');
		}*/
		//没有轨道和环线时，则根本没有这 2 个变量，所以要用 typeof 判断
		if ('undefined'==typeof(Railways) || filePath.indexOf('zhuangshi') > -1) {
			SFUI.hideId('subway_a');
		} else {
			me.config.leveledMenu.subway = {
				id:'subway',
				subId:'subwaystation',
				data:Railways,
				subData:railway_station,
				defaultVal:'线路不限',
				title:'选择地铁'
			};
			me.newSubway();
		}

		if ('undefined'==typeof(mapcityround) || ''==mapcityround || filePath.indexOf('zhuangshi') > -1 || filePath.indexOf('jiancaicheng') > -1) {
			SFUI.hideId('round_a');
		} else {
			me.config.menu.round = {
				id:'round',
				data:mapcityround,
				defaultVal:'环线不限',
				title:'选择环线'
			};
			me.newRound();
		}
	},
	newPurpose:function(purpose) {
		var itemTarget = document.getElementById('purposes_a');
		if(!itemTarget) return;
		//var purpose = purpose || '';
		if(!purpose && SFMap.firstLoad && searchcondition.purpose && $id('purposes').value)
		{
			currentPurpose = $id('purposes').value;
		}
		else
		{
			var currentPurpose = purpose || '0';
			$id('purposes').value = currentPurpose;
		}

		str = '类型：';
		if('' == currentPurpose || currentPurpose == '0')
		{
			str += '<span>不限</span>';
		}
		else
		{
			str += '<span><a href="javascript:;" onclick="SFMapUI.newPurpose(\'0\');SFMap.autoView=false;SFMap.searchResult();return false;">不限</a></span>';
		}
		for(var i=0; i<Purposes.length; i++)
		{
			var itemThis = Purposes[i];
			str += '<span';
			if(currentPurpose == itemThis.index)
			{
				str += ' class="font01">'+itemThis.name;
			}
			else
			{
				str += '><a href="javascript:;" onclick="SFMapUI.newPurpose(\''+itemThis.index+'\');SFMap.autoView=false;SFMap.searchResult();return false;">'+itemThis.name+'</a>';
			}
			str += '</span>';
		}
		var str1 = '<span class="top_zt">楼盘状态:'
			+'<label><input name="sell_now" id="sell_now" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" checked="checked"/><li class="bule">在售</li></label>'
			+'<label><input name="sell_hop" id="sell_hop" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" checked="checked"/><li class="rede">即将上市</li></label>'
			+'<label><input name="sell_pre" id="sell_pre" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="green">待售</li></label>'
			+'<label><input name="sell_wei" id="sell_wei" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="were">尾盘</li></label>'
			+'<label><input name="sell_out" id="sell_out" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="grey">售完</li></label>'
			+'</span>';
		itemTarget.innerHTML = str+str1;
		this.newPrice('');
	},
	newPrice:function(price) {
		
		if(!price && SFMap.firstLoad && searchcondition.price && $id('price').value)
		{
			var currentPrice = $id('price').value;
		}
		else
		{
			var currentPrice = price || '';
			$id('price').value = currentPrice;
		}
		//alert(currentPrice);
		var itemTarget = document.getElementById('price_a');

		var purpose = document.getElementById('purposes').value;
		purpose = ('' == purpose) ? '不限,-1' : purpose;		
		var arrPurpose = purpose.split(",");
		var purposeId = arrPurpose[1];

		
		//var str = '<table cellspacing="0" style="width:100%"><tr><td class="selectInfo" style="line-height:22px;padding-left:7px;">请选择价格范围</td></tr><tr>';
		var objPrice = Price[purposeId];		
		if(!objPrice && Price[1]) objPrice = Price[1];
		//
		//城市格里必须是现有数据中有的城市，有城市数据的才有其它数据
		var str = '<div class="s1">价格：';
		if('0' == currentPrice || '' == currentPrice)
		{
			str += '<span>不限</span>';			
		}
		else
		{			
			str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'0\');SFMap.autoView=false;SFMap.searchResult();return false;">不限</a></span>';
		}
		if (objPrice)
		{
			//str +='<td><a href="javascript:;" onclick="SFUI.setInputA(&quot;price&quot;,&quot;&quot;,&quot;不限&quot;);SFMap.searchResult();return false;">不限</a></td></tr><tr>';
			//把生成价格单元格的重复劳动简单封装一下，这个函数内部的 currentPrice 是未定义的变量，会沿着范围链取其上一级范围的 currentPrice 值，即 currentPrice = $('price').value; 的值
			var priceTable = function (tbhead, arrayPriceText, arrayPriceValue)
			{
				var pricecondition = "";
				var priceSuffix= '单价';
				if(tbhead.indexOf('天')>-1)
				{
					priceSuffix='天';
				}
				else if(tbhead.indexOf('月')>-1)
				{
					priceSuffix='月';
				}
				else if(tbhead.indexOf('万')>-1)
				{
					priceSuffix='套价';
				}
				//先写表头的单位
				//var str = '</tr><tr><td class="tbheadmore">'+tbhead+'</td>';
				var str = '';
				var priceDis = '';
				var priceNum = 0;
				var priceFormat = function(num){
					num = parseInt(num);
					if(num==0) return '';
					if(num/1000 >= 1 && num/1000 < 10) return num/1000+'千';
					if(num/10000 >= 1 && num/10000 < 10) return num/10000+'万';
					if(num/10000 >= 1000) return '';
					return num;
				};
				for (i=0; i<arrayPriceValue.length; i++)
				{
					/*if(arrayPriceValue[i].indexOf('10-5000')>-1)
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = tempprice[1]+'以下';
					}
					else if(arrayPriceValue[i].indexOf('10000-10000000')>-1)
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = '1万以上';
					}
					else
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = priceFormat(tempprice[0])+'-'+priceFormat(tempprice[1]);
					}*/
					if(i == 0)
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = tempprice[1]+'以下';

					}else if(i == (arrayPriceValue.length - 1) )
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						if(tempprice[0] >= 10000)
						{
							priceDis = '1万以上';
						}else{
							priceDis = tempprice[0]+'以上';
						}
						

					}else{

						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = priceFormat(tempprice[0])+'-'+priceFormat(tempprice[1]);

					}

					//var thisPrice = pricecondition+priceSuffix;
					var thisPrice = pricecondition;
					str += '<span';
					if(thisPrice == currentPrice || pricecondition == currentPrice)
					{
						str += ' class="font01">'+priceDis+'</span>';
					}
					else
					{
						str += '><a href="javascript:;" onclick="SFMapUI.newPrice(\''+thisPrice+'\');SFMap.autoView=false;SFMap.searchResult();return false;">'+priceDis+'</a></span>';
					}
				}
				//str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'[0,0]\');SFMap.autoView=false;SFMap.searchResult();return false;">价格待定</a></span>';
				str += tbhead;
				return str;
			};
			
			
			
			
			
			//基本单价肯定有
			str += priceTable(objPrice.unit, objPrice.text, objPrice.value);
			if('[0,0]' == currentPrice)
			{
				str += '<span class="font01">价格待定</span>';
			}
			else
			{
				str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'[0,0]\');SFMap.autoView=false;SFMap.searchResult();return false;">价格待定</a></span>';
			}
			
			//附加价格的 ID 比基本价格 ID 多 10，如 别墅 基本价格是 Price[3]，附加价格是 Price[13] 。
			var extraPriceId = 10+parseInt(purposeId);
			var objPrice = Price[extraPriceId];
			
			
			if (objPrice) {
				str += '</div><div class="s2">'+priceTable(objPrice.unit, objPrice.text, objPrice.value);
			}
		}
		//alert(str);
		str += '&nbsp;<!--span id="moreoptions" onmouseover="SFMapUI.showMoreOptions();" onmouseout="SFMapUI.hideMoreOptions();" class="font02 alink">[更多条件]</span--></div>';
		itemTarget.innerHTML = str;
	},
	/*
	//显示时间一级菜单
	menuOpentime:function(event) {
		var str = $id('template_opentime').value;
		var opentimesyear = ($id('opentimesyear').value) ? $id('opentimesyear').value : '年';
		var opentimesmonth = $id('opentimesmonth').value ? $id('opentimesmonth').value : '月';
		var opentimeeyear = $id('opentimeeyear').value ? $id('opentimeeyear').value : '年';
		var opentimeemonth = $id('opentimeemonth').value ? $id('opentimeemonth').value : '月';
		var objTime =
		{
			'opentimesyear':opentimesyear,
			'opentimesmonth':opentimesmonth,
			'opentimeeyear':opentimeeyear,
			'opentimeemonth':opentimeemonth
		};
		str = SFUI.templateFetch(str, objTime);
		//this.makeMenu(event, this.menu, str);
		//return;
		var eve = event || window.event;
		var eventSource = eve.target || eve.srcElement;
		var panelId = 'panel_'+ (eventSource.id);
		str = '<div id="'+panelId+'" class="conditionsearch">' + str + '</div>';
		//this.showFlyer(event, this.menu, str);
		var flyer = this.menu;
		flyer.setContent(str);
		var topPx = 65;
		var leftPx = 370;
		if(eventSource)
		{
			var pos = SFUI.getAbsPoint(eventSource);
			var hw = eventSource.offsetWidth;
			var hh = eventSource.offsetHeight;
			//var pw = 540;
			topPx = pos.y + hh;
			leftPx = pos.x + hw - 540; //540是开盘时间条的宽度
		}
		flyer.show(event, null, leftPx, topPx);
	},
	*/
	newOpenyear:function(id) {
		var p = $id('panel_moreoptions');
		if(!p) return;
		var panel = document.createElement('div');
		panel.id = 'panel_'+id+'_a';
		panel.className = 'paneltable';
		panel.style.width = '39px';

		var myDate = new Date();
		var yearStart = myDate.getFullYear();
		for(var i=0; i<8; i++)
		{
			var a = document.createElement('a');
			a.innerHTML = yearStart-i;
			a.onclick = function(){
				SFUI.setInputA(id,this.innerHTML,this.innerHTML);
				panel.style.display = 'none';
				p.style.display = 'block';
			};
			a.onmouseover = function(){this.id = 'hover';};
			a.onmouseout = function(){this.id = '';};
			panel.appendChild(a);
		}
		document.body.appendChild(panel);
	},
	newOpenmonth:function(id) {
		var p = $id('panel_moreoptions');
		if(!p) return;
		var panel = document.createElement('div');
		panel.id = 'panel_'+id+'_a';
		panel.className = 'paneltable';
		panel.style.width = '39px';

		for(var i=1; i<13; i++)
		{
			var a = document.createElement('a');
			a.innerHTML = (i<10) ? '0'+i : i;
			a.onclick = function(){
				SFUI.setInputA(id,this.innerHTML,this.innerHTML);
				panel.style.display = 'none';
				//p.style.display = 'block';
			};
			a.onmouseover = function(){this.id = 'hover';};
			a.onmouseout = function(){this.id = '';};
			panel.appendChild(a);
		}
		document.body.appendChild(panel);
	},
	clearOpentime:function() {
		var me = this;
		me.resetOpentime();
		//SFMap.searchResult();
	},
	resetOpentime:function() {
		SFUI.setInputA('opentimesyear','','');
		SFUI.setInputA('opentimesmonth','','');
		SFUI.setInputA('opentimeeyear','','');
		SFUI.setInputA('opentimeemonth','','');
		SFUI.setInput('opentime','');
		SFUI.setA('opentimetitle_a','开盘时间');
	},
	clearAllOption:function()
	{
		var me = this;
		var inputA = [{id:'district', hint:'选择区域'},{id:'area', hint:''}, {id:'round', hint:'选择环线'}, {id:'subway', hint:'选择地铁'}];
		for(var i=0; i<inputA.length; i++)
		{
			var itemThis = inputA[i];
			SFUI.setInputA(itemThis.id, '',itemThis.hint);
		}
		me.resetOpentime();
		me.newPurpose();
	},
	//取得某年某月的最后一天
	getLastdayofMonth:function(year, month)
	{
		if(!year || !month) return;
		var day30 = ['04', '06', '09', '11'];
		if('02' == month)
		{
			if(0 == year % 4 && ((0 != year % 100) && (0 == year % 400)))
			{
				return '29';
			}
			else
			{
				return '28';
			}
		}
		for(var i=0; i<day30.length; i++)
		{
			if(month == day30[i]) return '30';
		}
		return '31';
	},
	searchOpentime:function(event) {
		var syear = $id('opentimesyear').value;
		var smonth = $id('opentimesmonth').value;
		var eyear = $id('opentimeeyear').value;
		var emonth = $id('opentimeemonth').value;

		var titlestr = "";

		var searchdate = "[";

		if(smonth != "" && syear == "")
		{
			alert("请选择开始年份");
			return false;
		}
		if(emonth != "" && eyear== "")
		{
			alert("请选择结束年份");
			return false;
		}
		if(syear >= eyear)
		{
			if(((parseInt(syear+smonth) > parseInt(eyear+emonth)) && (parseInt(eyear+emonth) != 0)))
			{
				alert("结束时间必须大于开始时间");
				return false;
			}
		}

		if(smonth != "")
		{

			titlestr += syear+"."+smonth.substring(0,2);
			searchdate += syear+smonth+"01";
		}
		else
		{
			if(syear != "")
			{
				titlestr += syear;
				searchdate += syear+"0101";
			}
			else
			{
				searchdate += "";
			}
		}
		searchdate += ",";
		titlestr += "-";

		if(emonth != "")
		{
			titlestr += eyear+"."+emonth.substring(0,2);
			searchdate += eyear+emonth+this.getLastdayofMonth(eyear,emonth);
		}
		else
		{
			if(eyear != "")
			{
				titlestr += eyear;
				searchdate += eyear+"1231";
			}
			else
			{
				searchdate += "";
			}
		}
		searchdate += "]";

		//this.hideFlyer(event, this.menu);
		SFUI.setInput('opentime',searchdate);
		if("-" != titlestr) SFUI.setA('opentimetitle_a',titlestr);
		//alert(searchdate);
		SFMap.searchResult();
	},
	newDistrict:function() {
		this.newLeveledMenu('district');
	},
	newSubway:function() {
		this.newLeveledMenu('subway');
	},
	newRound:function() {
		this.newMenu('round');
	},
	config:
	{
		leveledMenu: {
			district: {
				id:'district',
				subId:'area',
				data:Districts,
				subData:Area,
				defaultVal:'区域不限',
				title:'选择区域'
			}
		},
		menu: {
		}
	},
	clearOtherOpts:function(id)
	{
		var inputA = [{id:'district', hint:'选择区域'},{id:'area', hint:''}, {id:'round', hint:'选择环线'}, {id:'subway', hint:'选择地铁'}];
		for(var i=0; i<inputA.length; i++)
		{
			var itemThis = inputA[i];
			if(id == itemThis.id || ('district' == id && 'area' == itemThis.id)) continue;
			SFUI.setInputA(itemThis.id, '',itemThis.hint);
		}
	},
	newMenu:function(mType, mWidth)
	{
		var me = this;
		var mWidth = mWidth || 80;
		if('undefined' == typeof me.config.menu[mType]) return;
		var menuData = me.config.menu[mType];

		//menu的外框样式，默认为不显示
		var panel = document.createElement('div');
		var sourceItem = $id(menuData.id+'_a');
		if(!sourceItem) return;
		var pos = SFUI.getAbsPoint(sourceItem);
		panel.id = 'panel_'+menuData.id+'_a';
		panel.className = 'paneltable';
		panel.style.top = (pos.y + 12) + 'px';
		panel.style.left = (pos.x - 1) + 'px';
		panel.style.width = mWidth+'px';

		var ddMouseEvent = function(sItem, flg){
			sItem.id = flg ? 'hover' : '';
		};
		var clickEvent = function(sItem) {
			var tagname = sItem.tagName.toLowerCase();
			var vals = sItem.innerHTML;
			var val=SFUI.checkRound(vals);
			//kaede
			
			SFUI.hideId('panel_'+menuData.id+'_a');
			SFMapUI.clearOtherOpts(menuData.id);
			if(val == menuData.defaultVal)
			{
				SFUI.setA(menuData.id+'_a', menuData.title);
				SFUI.setInput(menuData.id, '');
				//SFMap.map.panTo(cityy,cityx);
				//SFMap.map.setZoom(mapsize);
				SFMap.map.setCenter(cityy,cityx,mapsize);
			}
			else
			{
				SFUI.setA(menuData.id+'_a', vals);
				SFUI.setInput(menuData.id, val);
				SFMap.map.setViewAuto(true);
			}
			SFMap.searchResult();
		};
		var div = document.createElement('div');
		div.innerHTML = menuData.defaultVal;
		div.onclick = function(){clickEvent(this);};
		div.onmouseover = function(){ddMouseEvent(this,true);};
		div.onmouseout = function(){ddMouseEvent(this,false);};
		panel.appendChild(div);

		if(mType == 'round') {
			var datas = menuData.data.split(',');
		} else {
			var datas = menuData.data;
		}
		
		var dataLen = datas.length;
		for (var i=0; i<dataLen; i++)
		{
			div = document.createElement('div');
			div.innerHTML = datas[i].split('|')[0];
			div.onclick = function(){clickEvent(this);};
			div.onmouseover = function(){ddMouseEvent(this,true);};
			div.onmouseout = function(){ddMouseEvent(this,false);};
			panel.appendChild(div);
		}
		panel.onmouseover = function(){this.style.display="block";};
		panel.onmouseout = function(){this.style.display="none";};
		document.body.appendChild(panel);
	},
	newLeveledMenu:function(mType,mWidth)
	{
		var mWidth = mWidth || 80;
		var me = this;
		if('undefined' == typeof me.config.leveledMenu[mType]) return;
		var menuData = me.config.leveledMenu[mType];

		//menu的外框样式，默认为不显示
		var panel = document.createElement('div');
		var sourceItem = $id(menuData.id+'_a');
		if(!sourceItem) return;
		var pos = SFUI.getAbsPoint(sourceItem);
		panel.id = 'panel_'+menuData.id+'_a';
		panel.className = 'paneltable';
		panel.style.width = mWidth+'px';

		//dl是最外层，每个dd是一组分级的menu
		//ol是一级menu，ul是二级menu
		var dl = document.createElement('dl');
		var dd = document.createElement('dd');
		//ol是一级menu，div是内容，本来用一层就足够了，但在IE下文字比较多时出现了小箭头错位的现象，所以分了两层
		var ol = document.createElement('ol');
		var div = document.createElement('div');
		div.innerHTML = menuData.defaultVal;

		var ddMouseEvent = function(sItem, flg){
			var display = 'none';
			var id = '';
			if(flg) {
				display = 'block';
				id = 'hover';
			}
			var childNodes = sItem.childNodes;
			var count = 0;
			var cTagname = '';
			for(var c=0; c<childNodes.length; c++)
			{
				if(count > 1) break;
				cTagname = childNodes[c].tagName.toLowerCase();
				if('ul' == cTagname)
				{
					childNodes[c].style.display = display;
					count += 1;
				}
				else if('ol' == cTagname)
				{
					childNodes[c].id = id;
					count += 1;
				}
			}
		};
		var clickEvent = function(sItem) {
			var tagname = sItem.tagName.toLowerCase();
			var val = sItem.innerHTML;
			//kaede shuzi
			var shuzi=SFUI.checkDistricts(val);
			
			SFMapUI.clearOtherOpts(menuData.id);
			SFUI.setA(menuData.id+'_a', val);
			var v1 = '';
			var v2 = '';
			if('div' == tagname)
			{
				SFUI.setInput(menuData.id, shuzi);
				SFUI.setInput(menuData.subId, '');
				v1 = val;
				var childNodes = sItem.parentNode.parentNode.childNodes;
				var cTagname = '';
				for(var c=0; c<childNodes.length; c++)
				{
					cTagname = childNodes[c].tagName.toLowerCase();
					if('ul' == cTagname)
					{
						SFUI.hide(childNodes[c]);
						break;
					}
				}
			}
			else if('li' == tagname)
			{
			
				
				SFUI.hide(sItem.parentNode);
				v2 = val;
				var childNodes = sItem.parentNode.parentNode.childNodes;
				var cTagname = '';
				for(var c=0; c<childNodes.length; c++)
				{
					cTagname = childNodes[c].tagName.toLowerCase();
					if('ol' == cTagname)
					{
						v1 = childNodes[c].childNodes[0].innerHTML;
						//kaede
						var shuzi=SFUI.checkDistricts(v1);
						var shuzi1=SFUI.checkArea(shuzi,val);
						SFUI.setInput(menuData.subId, shuzi1);
						SFUI.setInput(menuData.id, shuzi);
						break;
					}
				}
			}
			SFUI.hideId('panel_'+menuData.id+'_a');
			SFMap.getCenter(shuzi1, shuzi);
			//if('district' == menuData.id) SFMap.getCenter(shuzi1, shuzi);
			if('subway' == menuData.id) SFMap.drawSubWay(true);
		};
		div.onclick = function(){
			SFMapUI.clearOtherOpts(menuData.id);
			SFUI.setA(menuData.id+'_a',menuData.title);
			SFUI.setInput(menuData.id, '');
			SFUI.setInput(menuData.subId, '');
			SFUI.hideId('panel_'+menuData.id+'_a');
			if('district' == menuData.id) SFMap.getCenter('', '');
			if('subway' == menuData.id) SFMap.drawSubWay(true);
		};
		ol.appendChild(div);
		dd.appendChild(ol);
		dd.onmouseover = function(){ddMouseEvent(this,true);};
		dd.onmouseout = function(){ddMouseEvent(this,false);};
		dl.appendChild(dd);

		var dataLen = menuData.data.length;
		for (var i=0; i<dataLen; i++)
		{
			var itemThis = menuData.data[i];
			dd = document.createElement('dd');
			ol = document.createElement('ol');
			div = document.createElement('div');
			div.innerHTML = (mType == 'subway') ? itemThis.value : itemThis.name;
			div.onclick = function(){clickEvent(this);};
			ol.appendChild(div);
			dd.appendChild(ol);
			var subDataArr = menuData.subData[itemThis.index];
			if(subDataArr)
			{
				var ul = document.createElement('ul');
				var topPx = (i+1)*20;
				ul.style.left = mWidth+'px';
				var subDataLen = subDataArr.length;
				if(subDataLen < 3) ul.style.width = mWidth*subDataLen +'px';
				var submenuLines = Math.ceil(subDataLen/3);
				if(submenuLines+i>dataLen && dataLen+1>submenuLines) topPx = (dataLen-submenuLines+1)*20;
				ul.style.top = (topPx-1)+'px';
				for(var j=0; j<subDataLen; j++)
				{
					ol.className = 'menur';
					var subData = (mType == 'district') ? subDataArr[j].split(',')[1] : subDataArr[j];
					var li = document.createElement('li');
					li.innerHTML = subData;
					li.onmouseover = function(){this.id='hover';};
					li.onmouseout = function(){this.id='';};
					li.onclick = function(){clickEvent(this);};
					ul.appendChild(li);
				}
				dd.appendChild(ul);
			}
			dd.onmouseover = function(){ddMouseEvent(this,true);};
			dd.onmouseout = function(){ddMouseEvent(this,false);};
			dl.appendChild(dd);
		}
		panel.appendChild(dl);
		panel.onmouseover = function(){this.style.display='block';};
		panel.onmouseout = function(){this.style.display='none';};
		document.body.appendChild(panel);
	},
	newSort:function () {
		var option = {
			'':'排序方式',
			'pa':'价格升序',
			'pd':'价格降序'
		};
		var panel = document.createElement('div');
		panel.id = 'panel_sort_a';
		panel.className = 'paneltable';
		panel.style.width = '62px';
		var str = '';
		for(var i in option)
		{
			var a = document.createElement('a');
			a.innerHTML = option[i];
			a.provalue = i;
			a.onclick = function(){
				SFUI.setInputA('sort',this.provalue,this.innerHTML);
				//SFMap.searchResult(0,false,1);
				SFMap.gotosearch();
				return false;
			};
			a.onmouseover = function() {this.id='hover';};
			a.onmouseout = function() {this.id='';};
			panel.appendChild(a);
		}
		panel.onmouseover = function() {this.style.display='block';};
		panel.onmouseout = function() {this.style.display='none';};
		document.body.appendChild(panel);
	},
	showTip:function(content, left, top) {
		var node = $id('maptip');
		content = $id('template_maptip').value;
		node.innerHTML = content;
		node.style.display = 'block';
		node.style.left = left+'px';
		node.style.top = top +'px';
	},
	suggest_selected:0,
	suggest_url: filePath+'data/2.xml',

	/*关键字提示方法
	参数：
	e		DOM 2 标准的事件对象。当函数有多个参数时，这个事件对象必须是全局变量，变更名固定为 event，且从文档最顶层调用函数的地方传递进来，所以得 onkeyup="SearchMenu.suggest(event, this, '/suggest/extend?action=tip&scope=news', {q:this.value});" 这样才能在 FF 里用。
	poper	发起元素
	args	参数值对，每个属性名是参数名，每个值是参数的值，如二手房的用 {city:$('form_2nd').City.value, q:this.value}，会转化成 city=表单form_2nd中City项的值&q=当前格的值
	*/
	newSuggest:function()
	{
		var panel = $id('panel_keyword');
		if(panel) return;
		panel = document.createElement('div');
		panel.id = 'panel_keyword';
		panel.className = 'paneltable';
		var sItem = $id('keyword');
		//alert($id('keyword').offsetWidth);
		panel.style.width = (sItem && sItem.offsetWidth-2>0)? (sItem.offsetWidth-2)+'px' : '285px';
		panel.style.borderTop = 'none';
		panel.innerHTML = '<!--span>输入中文/拼音/拼音首字母或用上下键选择</span-->';
		panel.onmouseover = function(){this.style.display='block';};
		panel.onmouseout = function(){this.style.display='none';};
		document.body.appendChild(panel);
	},
	showSuggest:function()
	{
		var me = this;
		var panel = $id('panel_keyword');
		if(!panel)
		{
			me.newSuggest();
			panel = $id('panel_keyword');
		}
		SFMapUI.showMenu('keyword');
	},
	suggest: function(event, poper)
	{
		var event = event || window.event;
		var code = event.keyCode;
		var itemId = poper.id;
		var panel = $id('panel_keyword');
		var me = this;
		////回车，直接搜索
		if(!panel)
		{
			me.newSuggest();
			panel = $id('panel_keyword');
		}
		if(code == 13 || /^\s*$/.test(poper.value))
		{
			panel.style.display='none';
		}
		//按的不是方向键时取关键字提示。方向键是37:"left", 38:"up",	39:"right", 40:"down"
		else if ((code < 37) ||  (code > 40))
		{
			//每次生成新菜单时都把按键选中项的索引复原
			this.suggest_selected = 0;

			var method = 'post';
			var params = {'cname':searchcondition['cityname'], 'q':poper.value, 'random':Math.random()};

			//终于明白了 IE 6 在 AJAX 的回调函数里不再能获取此前的事件，并且通过参数传递也不灵。所以此前设想只传递事件对象，而不再传递发起元素对象，现在看来不灵了，还得把发起元素对象也传递了。
			var onComplete = function(originalRequest) {
				var xmlObj = originalRequest.responseXML;
				var json = SFUtil.xml2json(xmlObj);

				var suggestwords = json.result.msg;
				//有提示数据时再显示菜单
				if (''!=suggestwords) {
					var arrWords = suggestwords.split(',');
					var str = '<!--span>输入中文/拼音/拼音首字母或用上下键选择</span-->';
					panel.innerHTML = str;
					for (var i=0; i<arrWords.length; i++) {
						var a = document.createElement('a');
						a.innerHTML = arrWords[i];
						a.onclick = function(){
							$id(itemId).value = this.innerHTML;
							panel.style.display = 'none';
						}
						a.onmouseover = function(){this.className='suggest_selected';};
						a.onmouseout = function(){this.className='';};
						panel.appendChild(a);
					}
					//panel.onmouseover = function(){this.style.display='block';};
					//panel.onmouseout = function(){this.style.display='none';};
				}
				SFMapUI.showMenu('keyword');
				//没有数据时把已显示的菜单关闭掉。这里不能用 me.hideFlyer 或 menu.hide 方法，因为按键的节点还在动作发起节点，不会隐藏菜单，只能直接用 style
				/*else if(panel) {
					panel.style.display='none';
				}*/
			};
			var xhr = new SFXHR(this.suggest_url, method, params, onComplete);
		}
		//按的是方向键时控制菜单中选项
		else
		{
			if (panel && 'none'!=panel.style.display)
			{
				var nodes = $id('panel_keyword').childNodes;

				//提示出的关键字节点数，即共有几行
				var suggestNum = nodes.length;
				//关键字提示层的选中行要想能跟随按键变化，选中行数做成当前的局部变量不灵，每次按键都会重新回到局部变量的初始值，也得用个此函数范围外的变量，于是在 SearchWord 对象里再加个属性 suggest_selected 去记录，则选行的操作和城市菜单都一样了。
				if ((38 == code) || (40 == code))
				{
					//向上减行数
					if ((38 == code) && (2 < this.suggest_selected))
					{
						this.suggest_selected--;
					}
					//向下加行数
					if ((40 == code) && (this.suggest_selected < suggestNum))
					{
						this.suggest_selected += (0 == this.suggest_selected) ? 2 : 1;
					}
					//找 suggestsearch 节点内的所有 a 把它们的 class 都清空，把当前选中行的 class 设成 suggest_selected。
					for (i=1; i< suggestNum; i++)
					{
						//行数是从1数起的，而节点数组的是从0数起的
						nodes[i].className = (i == (this.suggest_selected-1)) ? 'suggest_selected':'';
					}
					//焦点在输入格里时，按回车键是肯定要提交表单的，如果人为阻止表单提交，还得另外恢复表单的提交，干脆在选择时直接更新输入格的值
					var itemselected = nodes[this.suggest_selected-1].childNodes;
					//二手房加了数目后，A 里统一多了一层 span，所以再向内找一层子节点
					//itemselected = itemselected[0].childNodes;
					SFUI.setInput('keyword',itemselected[0].data);
				}
			}
		}
	},
	toggleRight:function(flg) {
		//if($id('map_result_main').style.display == 'none')
		if(flg)
		{
			$id('map_result_main').style.display='block';
			$id('map_body_box').style.marginRight = '218px';
			SFUI.hideId('map_result_barimg_open');
			SFUI.showId('map_result_barimg_hide');
		}
		else
		{
			$id('map_result_main').style.display='none';
			$id('map_body_box').style.marginRight = '0px';
			SFUI.hideId('map_result_barimg_hide');
			SFUI.showId('map_result_barimg_open');
		}
		this.autoResize(true);
	},
	//页面高度自适应
	autoResize:function(init,fistload)
	{
		var init = init || false;
		var fistload = fistload || false;
		var MINHEIGHT = 500;	//浏览器允许的最小高度
		//var MINWIDTH = 900;	//浏览器允许的最小宽度
		var TOPHEIGHT = (filePath.indexOf('zhuangshi') > -1 || filePath.indexOf('jiancaicheng') > -1) ? 129 : 153;		//顶部通栏的高度 111 52+8+59(35)+10+24
		if($id('condition_bar') && $id('topmenu'))
		{
			var h = $id('condition_bar').offsetHeight+$id('topmenu').offsetHeight+40;
			TOPHEIGHT = (h > TOPHEIGHT && h < 200) ? h : TOPHEIGHT;
		}
		//var BOTTOMHEIGHT = 25;		//底部信息栏的高度 20
		var BOTTOMHEIGHT = 0;
		//var RESULTHEIGHT = 90;	//结果栏顶部和底部的和
		var FIXHEIGHT = 0;
		var UA = navigator.userAgent.toLowerCase();
		if(UA.indexOf('360se') > -1) FIXHEIGHT += 3;
		else if(UA.indexOf('firefox') > -1) FIXHEIGHT += 1;
		else if(UA.indexOf('msie 6') > -1) FIXHEIGHT += 0;
		else FIXHEIGHT += 2;
		var viewHeight = SFUI.getWindowHeight();
		if(viewHeight < MINHEIGHT){
			viewHeight = MINHEIGHT;
		}
		var contentHeight = viewHeight - TOPHEIGHT - FIXHEIGHT - BOTTOMHEIGHT;
		var content1minus = contentHeight - 1;
		var obj_heights = {
			map_body_box:contentHeight,
			map_canvas:contentHeight,
			map_result_barimg_hide:content1minus,
			map_result_barimg_open:content1minus,
			listfav:contentHeight - 9,
			//tab_div0:contentHeight - 47,
			map_fav:contentHeight - 201,
			rightmenu1:contentHeight - 9,
			rightmenu2:contentHeight - 9,
			rightmenu4:contentHeight - 9,
			carsteplistmenu:contentHeight - 72
		};
		for (var id in obj_heights)
		{
			var ele = $id(id);
			if(ele)
			{
				var h = ele.style.height.substring(0,ele.style.height.length-2);
				/*if(id == 'map_canvas')
				{
					alert(h+' : '+obj_heights[id]);
				}*/
				if(h == obj_heights[id]) continue;
				ele.style.height = obj_heights[id]+'px';
			}
		}

		//9 20 28 36 resultPage 40 
		if($id('resultlist'))
		{
			var pageHeight = $id('resultpage') ? $id('resultpage').offsetHeight+20 : 40;
			var listHeight = contentHeight - 110 - pageHeight;
			$id('resultlist').style.height = (listHeight > 0) ? listHeight+'px' : '10px';
		}
		//resize的时候要调整驾车和周边框的位置
		var jczbList = ['jczbsearch', 'jczbresult', 'jczbsearchmin', 'jczbresultmin'];
		var container = $id('map_canvas');
		if(fistload) SFUI.showId('jczbsearch');
		for(var i=0; i<jczbList.length; i++)
		{
			var tItem = $id(jczbList[i]);
			var tWidth = (tItem.offsetWidth > 0) ? tItem.offsetWidth : 234;
			var tHeight = tItem.offsetHeight;
			var cWidth = container.offsetWidth;
			var cHeight = container.offsetHeight;
			var isResult = (jczbList[i].indexOf('result') > -1);
			if(!tItem) continue;
			var topPx = tItem.style.top;
			var topNum = (topPx.length > 0) ? parseInt(topPx.substr(0,topPx.indexOf('px'))) : 0;
			var leftPx = tItem.style.left;
			var leftNum = (leftPx.length > 0) ? parseInt(leftPx.substr(0,leftPx.indexOf('px'))) : 0;
			try
			{
				tItem.style.top = isResult ? '69px' : '10px';
			}
			catch(e)
			{
				tItem.style.top = isResult ? '69' : '10';
			}
			try
			{
				tItem.style.left = (cWidth-tWidth-15 > 0) ? (cWidth-tWidth-15)+'px' : '0px';
			}
			catch(e)
			{
				tItem.style.left = (cWidth-tWidth-15 > 0) ? (cWidth-tWidth-15) : '0';
			}
		}
	},
	showMoreOptions:function()
	{
		var panel = $id('panel_moreoptions');
		var handler = $id('price_a');
		if(panel)
		{
			var topPx = 65;
			var leftPx = 370;
			var s3w = 526;
			var pw = 540;
			panel.style.display = 'block';
			if(handler)
			{
				//handler.className = 'more_options_show';
				var pos = SFUI.getAbsPoint(handler);
				var hw = handler.offsetWidth;
				var hh = handler.offsetHeight;
				s3w = (hw-14 > 0) ? hw-14 : s3w;
				pw = (hw > 0) ? hw : pw;
				topPx = pos.y + hh - 5;
				leftPx = pos.x;
			}
			panel.style.top = topPx + 'px';
			panel.style.left = leftPx + 'px';
			panel.style.width = pw + 'px';
			if($id('panel_moreoptions_s3')) $id('panel_moreoptions_s3').style.width = s3w + 'px';
		}
	},
	hideMoreOptions:function()
	{
		var panel = $id('panel_moreoptions');
		if(!panel || 'none' == panel.style.display) return;
		var yearMonth = ['panel_opentimesyear_a', 'panel_opentimeeyear_a', 'panel_opentimesmonth_a', 'panel_opentimeemonth_a'];
		for(var i=0; i<yearMonth.length; i++)
		{
			var submenu = $id(yearMonth[i]);
			if(submenu && 'block' == submenu.style.display)
			{
				return;
			}
		}
		panel.style.display = 'none';
	},
	iKnow:function(cookiename)
	{
		SFUtil.setCookie(cookiename,'1','365');
		SFUI.hideId('fdtip');
	},
	showMenu:function(id)
	{
		//alert(!$id(id) || !$id('panel_'+id));
		if(!$id(id) || !$id('panel_'+id)) return;
		var sItem = $id(id);
		var tItem = $id('panel_'+id);
		var pos = SFUI.getAbsPoint(sItem);
		tItem.style.top = (pos.y+sItem.offsetHeight)+'px';
		tItem.style.left = pos.x+'px';
		var arr = ['opentimesyear_a','opentimeeyear_a','opentimesmonth_a','opentimeemonth_a'];
		if(0 == id.indexOf('opentime'))
		{
			for(var i=0; i<arr.length; i++) SFUI.hideId('panel_'+arr[i]);
		}
		SFUI.show(tItem);
	}
};