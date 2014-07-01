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

	
	//����ʵ���з����л���ʾ�����ص��ô�����,����ֱ������Ϊ��ʾ�����رȽ�����
	show:function(node) {
		if(!node) return;
		var display ;
		//SPAN ֮����м�Ԫ�أ�ʹ�� inline�������鼶Ԫ��ʹ�� block
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
	//����ʵ���з����л���ʾ�����ص��ô�����,����ֱ������Ϊ��ʾ�����رȽ�����
	showId:function(nodeId) {
		var node = document.getElementById(nodeId);
		this.show(node);
	},
	hideId:function(nodeId) {
		var node = document.getElementById(nodeId);
		this.hide(node);
	},
	//ȡҳ��Ԫ����Դ��ڵľ���λ��
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
	//ȡԪ�ص�ʵ����ʽ
	getRealStyle : function(node)
	{
		var RealStyle;
		if (node.currentStyle)                            /*���� IE �� ��API */
		{
			RealStyle = node.currentStyle;
		}
		else if (window.getComputedStyle)              /* ���� W3C API */
		{
			RealStyle = window.getComputedStyle(node, null);
		}
		return RealStyle;
	},
	//���� RealStyle ȡ�õ�ֵ����Щ�������֣�Ҫ��תΪ��ֵ
	getStyleNum:function(value)
	{
		var num = parseInt(value);
		return ( num > 0) ? num : 0;
	},
	oldDocumentHeight:0,
	//ȡ������ҳ���
	getWindowWidth:function()
	{
		return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	},
	//ȡ������ҳ���
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
		//��������������ʾ���֣�������ʾ����ʽ��inputHint�����趨��ֵ
		//formitem.className='';
		//��Ϊ���˵���ĵ��κε����������ز˵��������趨ֵʱ�Ͳ����ٶ������ز˵��ˡ�
		//this.hide(event);
	},
	setA:function(itemid, val)
	{
		//		alert(itemid);
		if(!$id(itemid)) return;
		$id(itemid).innerHTML = val;
	},
	/*
	��ͨ��һ�� a ��һ�� input �����á�
	����:
	itemid �� input �� ID
	val ��� input ��ֵ
	hint ��� a ����ʾ����
	*/
	setInputA:function(itemid, val, hint)
	{
		this.setInput(itemid, val);
		this.setA(itemid+'_a', hint);
	},
	//str ģ������
	//obj �滻�õĶ��󣬼򵥵�����ֵ�ԣ��� {'key1':'val1','key2':'val2'}�����ģ�������е� {$key1}��{$key2} �滻�� {val1}��{val2}
	templateFetch:function (str, obj)
	{
		var retval = str;
		//��ʵ��˳�ζ� str ִ��������ʽ���滻
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
		//deltaX �� deltaY ��Ҫ�����������λ�ú�Ԫ�����Ͻǵ�ƫ��������ͨ�����պò������Ԫ�ص����Ͻǣ�������Ԫ�ص�ĳλ��ʱҲҪ�����϶���
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
			//����ʹ����һ������Χ�� elementToDrag ������ȡ�϶�Ԫ�ص�ʵ�ʿ�͸�
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
			//���ƶ��ķ�Χ�ĳ�ֱ��ȡ���ڿ���ˣ�����������ϼ� relative Ԫ�ص��ƶ���Χ�Ͳ����ˣ��Ժ��ٴ���һ��
			var leftMax = contWidth - dragWidth;
			//Firefox �Ĵ��ڿ�Ȼ�����������������ٶ��ȥһ��
			/*if (self.innerHeight) {
			leftMax = leftMax - 16;
			};*/
			var dragLeft = (leftMin < 0 ) ? 0 : (leftMax < leftMin) ? leftMax : leftMin;

			var topMin = e.clientY - deltaY;
			//���ĵ��ɸ߶�Ϊ�ƶ���Χ
			//alert();
			var topMax = contHeight - dragHeight;

			var dragTop = (topMin < 0 ) ? 0 : (topMax < topMin) ? topMax : topMin;

			//alert(blockheight );
			//showDebug('getDocumentHeight='+SFUI.getDocumentHeight()+', SFUI.oldDocumentHeight='+SFUI.oldDocumentHeight +', topMin ='+topMin+', topMax='+topMax);
			// Move the element to the current mouse position, adjusted as
			// necessary by the offset of the initial mouse-click.
			//var leftMax = e.clientX - deltaX;
			//��ס���ұߺ����±ߡ������ƶ������ĳߴ������չΪ�� getRealStyle ���õ���
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
	//ͬ������ DIV ����ʾ��ǰһ���������������ɸ�
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
		//��ʼ���߶�
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

		//ע�����ĵ��κεط��رղ˵�
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
		//��ͣ���˵���رղ˵���һ��˼·�Ǹ��ĵ��� mouseover �¼����ѷ���˵���Ԫ�� ID ��ס������� mouseover �Ľڵ��Ƿ��ڲ˵��� ID ���ʱά�֣����ڹرա�

		//�����ϲ��ʱ���ĵ��߶Ȼ᲻�ϱ���ڳ�ʼ��ʱ���ĵ�ԭ�߶ȴ��� SFUI ������
		SFUI.oldDocumentHeight = SFUI.getDocumentHeight();

		//û����Ȧ�����ߡ����ʱ������Ӧ�˵����ص�
		//��ʹ����û����Ȧ��Ҳ�� Area ������
		/*if (!Area || 0 == Area.length) {
			SFUI.hideId('area_a');
		}*/
		//û�й���ͻ���ʱ�������û���� 2 ������������Ҫ�� typeof �ж�
		if ('undefined'==typeof(Railways) || filePath.indexOf('zhuangshi') > -1) {
			SFUI.hideId('subway_a');
		} else {
			me.config.leveledMenu.subway = {
				id:'subway',
				subId:'subwaystation',
				data:Railways,
				subData:railway_station,
				defaultVal:'��·����',
				title:'ѡ�����'
			};
			me.newSubway();
		}

		if ('undefined'==typeof(mapcityround) || ''==mapcityround || filePath.indexOf('zhuangshi') > -1 || filePath.indexOf('jiancaicheng') > -1) {
			SFUI.hideId('round_a');
		} else {
			me.config.menu.round = {
				id:'round',
				data:mapcityround,
				defaultVal:'���߲���',
				title:'ѡ����'
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

		str = '���ͣ�';
		if('' == currentPurpose || currentPurpose == '0')
		{
			str += '<span>����</span>';
		}
		else
		{
			str += '<span><a href="javascript:;" onclick="SFMapUI.newPurpose(\'0\');SFMap.autoView=false;SFMap.searchResult();return false;">����</a></span>';
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
		var str1 = '<span class="top_zt">¥��״̬:'
			+'<label><input name="sell_now" id="sell_now" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" checked="checked"/><li class="bule">����</li></label>'
			+'<label><input name="sell_hop" id="sell_hop" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" checked="checked"/><li class="rede">��������</li></label>'
			+'<label><input name="sell_pre" id="sell_pre" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="green">����</li></label>'
			+'<label><input name="sell_wei" id="sell_wei" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="were">β��</li></label>'
			+'<label><input name="sell_out" id="sell_out" type="checkbox" value="1" onclick="SFMap.searchResult(0,1);" /><li class="grey">����</li></label>'
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
		purpose = ('' == purpose) ? '����,-1' : purpose;		
		var arrPurpose = purpose.split(",");
		var purposeId = arrPurpose[1];

		
		//var str = '<table cellspacing="0" style="width:100%"><tr><td class="selectInfo" style="line-height:22px;padding-left:7px;">��ѡ��۸�Χ</td></tr><tr>';
		var objPrice = Price[purposeId];		
		if(!objPrice && Price[1]) objPrice = Price[1];
		//
		//���и�������������������еĳ��У��г������ݵĲ�����������
		var str = '<div class="s1">�۸�';
		if('0' == currentPrice || '' == currentPrice)
		{
			str += '<span>����</span>';			
		}
		else
		{			
			str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'0\');SFMap.autoView=false;SFMap.searchResult();return false;">����</a></span>';
		}
		if (objPrice)
		{
			//str +='<td><a href="javascript:;" onclick="SFUI.setInputA(&quot;price&quot;,&quot;&quot;,&quot;����&quot;);SFMap.searchResult();return false;">����</a></td></tr><tr>';
			//�����ɼ۸�Ԫ����ظ��Ͷ��򵥷�װһ�£���������ڲ��� currentPrice ��δ����ı����������ŷ�Χ��ȡ����һ����Χ�� currentPrice ֵ���� currentPrice = $('price').value; ��ֵ
			var priceTable = function (tbhead, arrayPriceText, arrayPriceValue)
			{
				var pricecondition = "";
				var priceSuffix= '����';
				if(tbhead.indexOf('��')>-1)
				{
					priceSuffix='��';
				}
				else if(tbhead.indexOf('��')>-1)
				{
					priceSuffix='��';
				}
				else if(tbhead.indexOf('��')>-1)
				{
					priceSuffix='�׼�';
				}
				//��д��ͷ�ĵ�λ
				//var str = '</tr><tr><td class="tbheadmore">'+tbhead+'</td>';
				var str = '';
				var priceDis = '';
				var priceNum = 0;
				var priceFormat = function(num){
					num = parseInt(num);
					if(num==0) return '';
					if(num/1000 >= 1 && num/1000 < 10) return num/1000+'ǧ';
					if(num/10000 >= 1 && num/10000 < 10) return num/10000+'��';
					if(num/10000 >= 1000) return '';
					return num;
				};
				for (i=0; i<arrayPriceValue.length; i++)
				{
					/*if(arrayPriceValue[i].indexOf('10-5000')>-1)
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = tempprice[1]+'����';
					}
					else if(arrayPriceValue[i].indexOf('10000-10000000')>-1)
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						priceDis = '1������';
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
						priceDis = tempprice[1]+'����';

					}else if(i == (arrayPriceValue.length - 1) )
					{
						var tempprice = arrayPriceValue[i].split("-");
						pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
						if(tempprice[0] >= 10000)
						{
							priceDis = '1������';
						}else{
							priceDis = tempprice[0]+'����';
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
				//str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'[0,0]\');SFMap.autoView=false;SFMap.searchResult();return false;">�۸����</a></span>';
				str += tbhead;
				return str;
			};
			
			
			
			
			
			//�������ۿ϶���
			str += priceTable(objPrice.unit, objPrice.text, objPrice.value);
			if('[0,0]' == currentPrice)
			{
				str += '<span class="font01">�۸����</span>';
			}
			else
			{
				str += '<span><a href="javascript:;" onclick="SFMapUI.newPrice(\'[0,0]\');SFMap.autoView=false;SFMap.searchResult();return false;">�۸����</a></span>';
			}
			
			//���Ӽ۸�� ID �Ȼ����۸� ID �� 10���� ���� �����۸��� Price[3]�����Ӽ۸��� Price[13] ��
			var extraPriceId = 10+parseInt(purposeId);
			var objPrice = Price[extraPriceId];
			
			
			if (objPrice) {
				str += '</div><div class="s2">'+priceTable(objPrice.unit, objPrice.text, objPrice.value);
			}
		}
		//alert(str);
		str += '&nbsp;<!--span id="moreoptions" onmouseover="SFMapUI.showMoreOptions();" onmouseout="SFMapUI.hideMoreOptions();" class="font02 alink">[��������]</span--></div>';
		itemTarget.innerHTML = str;
	},
	/*
	//��ʾʱ��һ���˵�
	menuOpentime:function(event) {
		var str = $id('template_opentime').value;
		var opentimesyear = ($id('opentimesyear').value) ? $id('opentimesyear').value : '��';
		var opentimesmonth = $id('opentimesmonth').value ? $id('opentimesmonth').value : '��';
		var opentimeeyear = $id('opentimeeyear').value ? $id('opentimeeyear').value : '��';
		var opentimeemonth = $id('opentimeemonth').value ? $id('opentimeemonth').value : '��';
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
			leftPx = pos.x + hw - 540; //540�ǿ���ʱ�����Ŀ��
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
		SFUI.setA('opentimetitle_a','����ʱ��');
	},
	clearAllOption:function()
	{
		var me = this;
		var inputA = [{id:'district', hint:'ѡ������'},{id:'area', hint:''}, {id:'round', hint:'ѡ����'}, {id:'subway', hint:'ѡ�����'}];
		for(var i=0; i<inputA.length; i++)
		{
			var itemThis = inputA[i];
			SFUI.setInputA(itemThis.id, '',itemThis.hint);
		}
		me.resetOpentime();
		me.newPurpose();
	},
	//ȡ��ĳ��ĳ�µ����һ��
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
			alert("��ѡ��ʼ���");
			return false;
		}
		if(emonth != "" && eyear== "")
		{
			alert("��ѡ��������");
			return false;
		}
		if(syear >= eyear)
		{
			if(((parseInt(syear+smonth) > parseInt(eyear+emonth)) && (parseInt(eyear+emonth) != 0)))
			{
				alert("����ʱ�������ڿ�ʼʱ��");
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
				defaultVal:'������',
				title:'ѡ������'
			}
		},
		menu: {
		}
	},
	clearOtherOpts:function(id)
	{
		var inputA = [{id:'district', hint:'ѡ������'},{id:'area', hint:''}, {id:'round', hint:'ѡ����'}, {id:'subway', hint:'ѡ�����'}];
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

		//menu�������ʽ��Ĭ��Ϊ����ʾ
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

		//menu�������ʽ��Ĭ��Ϊ����ʾ
		var panel = document.createElement('div');
		var sourceItem = $id(menuData.id+'_a');
		if(!sourceItem) return;
		var pos = SFUI.getAbsPoint(sourceItem);
		panel.id = 'panel_'+menuData.id+'_a';
		panel.className = 'paneltable';
		panel.style.width = mWidth+'px';

		//dl������㣬ÿ��dd��һ��ּ���menu
		//ol��һ��menu��ul�Ƕ���menu
		var dl = document.createElement('dl');
		var dd = document.createElement('dd');
		//ol��һ��menu��div�����ݣ�������һ����㹻�ˣ�����IE�����ֱȽ϶�ʱ������С��ͷ��λ���������Է�������
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
			'':'����ʽ',
			'pa':'�۸�����',
			'pd':'�۸���'
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

	/*�ؼ�����ʾ����
	������
	e		DOM 2 ��׼���¼����󡣵������ж������ʱ������¼����������ȫ�ֱ�����������̶�Ϊ event���Ҵ��ĵ������ú����ĵط����ݽ��������Ե� onkeyup="SearchMenu.suggest(event, this, '/suggest/extend?action=tip&scope=news', {q:this.value});" ���������� FF ���á�
	poper	����Ԫ��
	args	����ֵ�ԣ�ÿ���������ǲ�������ÿ��ֵ�ǲ�����ֵ������ַ����� {city:$('form_2nd').City.value, q:this.value}����ת���� city=��form_2nd��City���ֵ&q=��ǰ���ֵ
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
		panel.innerHTML = '<!--span>��������/ƴ��/ƴ������ĸ�������¼�ѡ��</span-->';
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
		////�س���ֱ������
		if(!panel)
		{
			me.newSuggest();
			panel = $id('panel_keyword');
		}
		if(code == 13 || /^\s*$/.test(poper.value))
		{
			panel.style.display='none';
		}
		//���Ĳ��Ƿ����ʱȡ�ؼ�����ʾ���������37:"left", 38:"up",	39:"right", 40:"down"
		else if ((code < 37) ||  (code > 40))
		{
			//ÿ�������²˵�ʱ���Ѱ���ѡ�����������ԭ
			this.suggest_selected = 0;

			var method = 'post';
			var params = {'cname':searchcondition['cityname'], 'q':poper.value, 'random':Math.random()};

			//���������� IE 6 �� AJAX �Ļص������ﲻ���ܻ�ȡ��ǰ���¼�������ͨ����������Ҳ���顣���Դ�ǰ����ֻ�����¼����󣬶����ٴ��ݷ���Ԫ�ض������ڿ��������ˣ����ðѷ���Ԫ�ض���Ҳ�����ˡ�
			var onComplete = function(originalRequest) {
				var xmlObj = originalRequest.responseXML;
				var json = SFUtil.xml2json(xmlObj);

				var suggestwords = json.result.msg;
				//����ʾ����ʱ����ʾ�˵�
				if (''!=suggestwords) {
					var arrWords = suggestwords.split(',');
					var str = '<!--span>��������/ƴ��/ƴ������ĸ�������¼�ѡ��</span-->';
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
				//û������ʱ������ʾ�Ĳ˵��رյ������ﲻ���� me.hideFlyer �� menu.hide ��������Ϊ�����Ľڵ㻹�ڶ�������ڵ㣬�������ز˵���ֻ��ֱ���� style
				/*else if(panel) {
					panel.style.display='none';
				}*/
			};
			var xhr = new SFXHR(this.suggest_url, method, params, onComplete);
		}
		//�����Ƿ����ʱ���Ʋ˵���ѡ��
		else
		{
			if (panel && 'none'!=panel.style.display)
			{
				var nodes = $id('panel_keyword').childNodes;

				//��ʾ���Ĺؼ��ֽڵ����������м���
				var suggestNum = nodes.length;
				//�ؼ�����ʾ���ѡ����Ҫ���ܸ��水���仯��ѡ���������ɵ�ǰ�ľֲ��������飬ÿ�ΰ����������»ص��ֲ������ĳ�ʼֵ��Ҳ���ø��˺�����Χ��ı����������� SearchWord �������ټӸ����� suggest_selected ȥ��¼����ѡ�еĲ����ͳ��в˵���һ���ˡ�
				if ((38 == code) || (40 == code))
				{
					//���ϼ�����
					if ((38 == code) && (2 < this.suggest_selected))
					{
						this.suggest_selected--;
					}
					//���¼�����
					if ((40 == code) && (this.suggest_selected < suggestNum))
					{
						this.suggest_selected += (0 == this.suggest_selected) ? 2 : 1;
					}
					//�� suggestsearch �ڵ��ڵ����� a �����ǵ� class ����գ��ѵ�ǰѡ���е� class ��� suggest_selected��
					for (i=1; i< suggestNum; i++)
					{
						//�����Ǵ�1����ģ����ڵ�������Ǵ�0�����
						nodes[i].className = (i == (this.suggest_selected-1)) ? 'suggest_selected':'';
					}
					//�������������ʱ�����س����ǿ϶�Ҫ�ύ���ģ������Ϊ��ֹ���ύ����������ָ������ύ���ɴ���ѡ��ʱֱ�Ӹ���������ֵ
					var itemselected = nodes[this.suggest_selected-1].childNodes;
					//���ַ�������Ŀ��A ��ͳһ����һ�� span��������������һ���ӽڵ�
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
	//ҳ��߶�����Ӧ
	autoResize:function(init,fistload)
	{
		var init = init || false;
		var fistload = fistload || false;
		var MINHEIGHT = 500;	//������������С�߶�
		//var MINWIDTH = 900;	//������������С���
		var TOPHEIGHT = (filePath.indexOf('zhuangshi') > -1 || filePath.indexOf('jiancaicheng') > -1) ? 129 : 153;		//����ͨ���ĸ߶� 111 52+8+59(35)+10+24
		if($id('condition_bar') && $id('topmenu'))
		{
			var h = $id('condition_bar').offsetHeight+$id('topmenu').offsetHeight+40;
			TOPHEIGHT = (h > TOPHEIGHT && h < 200) ? h : TOPHEIGHT;
		}
		//var BOTTOMHEIGHT = 25;		//�ײ���Ϣ���ĸ߶� 20
		var BOTTOMHEIGHT = 0;
		//var RESULTHEIGHT = 90;	//����������͵ײ��ĺ�
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
		//resize��ʱ��Ҫ�����ݳ����ܱ߿��λ��
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