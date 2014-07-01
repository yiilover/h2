/*
* �ܱߺͼݳ���ѯ
* ����
*/
var SearchOther ={
	//�ݳ���ѯ�Ĳ���
	searchdrive:{
		start: '',
		x1: '',
		y1: '',
		end: '',
		x2: '',
		y2: '',
		type: ''
	},
	//�������е�ľ��α߽�
	markerBounds:[],
	//��ǰ��׼�����Ϣ
	markerNow:null,
	//�Ҳ�˵��ļݳ�����
	gotosearchdrive:function(btype)
	{
		SFMap.isDragend = false;
		SFMapUI.toggleRight(false);
		SFUI.hideId('map_total');
		this.listname(btype);
	},
	minBar:function(id)
	{
		try
		{
			var idMin = id+'min';
			var objMin = $id(idMin);
			var objMax = $id(id);
			var top = objMax.style.top;
			var left = objMax.style.left;
			if(left.length > 0) left = (parseInt(left.substring(0,left.indexOf('px')))+108)+'px';
			SFUI.hideId(id);
			SFUI.showId(idMin);
			objMin.style.top = top;
			objMin.style.left = left;
		}
		catch(e){}
	},
	maxBar:function(id)
	{
		try
		{
			var idMax = id.substring(0,id.lastIndexOf('min'));
			var objMin = $id(id);
			var objMax = $id(idMax);
			var top = objMin.style.top;
			var left = objMin.style.left;
			if(left.length > 0)
			{
				left = parseInt(left.substring(0,left.indexOf('px')))-108;
				left = (left > 0) ? left+'px' : '0px';
			}
			SFUI.hideId(id);
			SFUI.showId(idMax);
			$id(idMax).style.top = top;
			$id(idMax).style.left = left;
		}
		catch(e){}
	},
	exchangeDrivePoint:function()
	{
		var me = this;
		var temp = {};
		temp.x = me.searchdrive.x1;
		temp.y = me.searchdrive.y1;
		temp.s = me.searchdrive.start;
		me.searchdrive.x1 = me.searchdrive.x2;
		me.searchdrive.y1 = me.searchdrive.y2;
		me.searchdrive.start = me.searchdrive.end;
		me.searchdrive.x2 = temp.x;
		me.searchdrive.y2 = temp.y;
		me.searchdrive.end = temp.s;
		var s = me.searchdrive;
		$id('tempdriverstart').value = s.start;
		$id('tempdriverend').value = s.end;
		$id('startList').innerHTML = s.start;
		me.startonclick(s.start,s.x1,s.y1);
		$id('endList').innerHTML = s.end;
		me.endonclick(s.end,s.x2,s.y2);
	},
	showLocalbar:function()
	{
		$id('jczbf010').className = 'a_off';
		$id('jczbf011').className = 'a_on';
		if(this.markerNow && this.markerNow.title)
		{
			$id("tempnearname").value = this.markerNow.title;
		}
		SFUI.hideId('jczbli010');
		SFUI.showId('jczbli011');
		SFUI.showId('hotzb');
		SFUI.hideId('jczbresult');
	},
	showDrivebar:function()
	{
		$id('jczbf011').className = 'a_off';
		$id('jczbf010').className = 'a_on';
		if(this.markerNow && this.markerNow.title)
		{
			$id("tempdriverend").value = this.markerNow.title;
		}
		SFUI.hideId('hotzb');
		SFUI.hideId('jczbli011');
		SFUI.showId('jczbli010');
		SFUI.hideId('jczbresult');
	},
	filltempdrive:function(cname,newCode,se)
	{
		var se = se || 'e';
		this.markerNow = this.getMarkerInfoById(newCode);
		if(this.markerNow && this.markerNow.x && this.markerNow.y)
		{
			var hitx = this.markerNow.x;
			var hity = this.markerNow.y;
		}
		else
		{
			var hitx = '';
			var hity = '';
		}
		//SFMapUI.toggleRight(false);
		if('e' == se)
		{
			this.searchdrive.x2 = hitx;
			this.searchdrive.y2 = hity;
			this.searchdrive.end = cname;
			$id("tempdriverend").value = cname;
			var cookieStr = SFUtil.getCookie('com_s');
			if(!cookieStr)
			{
				var fdtip = {};
				fdtip.words = '���������';
				fdtip.iknow = 'SFMapUI.iKnow(\'com_s\');';
				var templatefdtip = $id('template_fdtips').value;
				var fdtipValue = SFUI.templateFetch(templatefdtip, fdtip);
				var fdtipDiv = $id('fdtip');
				fdtipDiv.innerHTML = fdtipValue;
				var pos = SFUI.getAbsPoint($id('jczbsearch'));
				fdtipDiv.style.display = 'block';
				fdtipDiv.style.top = (pos.y-fdtipDiv.offsetHeight)+'px';
				fdtipDiv.style.left = (pos.x-15>0) ? (pos.x-15)+'px' : '0px';
			}
		}
		else
		{
			this.searchdrive.x1 = hitx;
			this.searchdrive.y1 = hity;
			this.searchdrive.start = cname;
			$id("tempdriverstart").value = cname;
		}
		this.showDrivebar();
	},
	//��ʾ�ܱ������ұ���
	filltempsearch:function(cname,newCode)
	{
		//SFMapUI.toggleRight(false);
		this.showLocalbar();
		$id('tempneartype').value = '';
		$id("tempnearname").value = cname;
		this.markerNow = this.getMarkerInfoById(newCode);
	},
	backToHouseSearch:function()
	{
		SFUI.hideId('jczbresult');
		SFMapUI.toggleRight(true);
		SFMap.map.clearOverlays();
		SFMap.isDragend = true;
		SFMap.gotosearch();
	},
	getMarkerInfoById:function(newCode)
	{
		if(!newCode) return;
		var detail = SFMap.markerList[newCode];
		if(detail)
		{
			return detail;
		}
		return null;
	},
	panMap:function(bounds)
	{
		
		var bounds = bounds || new MLngLatBounds(this.markerBounds[0],this.markerBounds[1]);
		SFMap.map._map.setLngLatBounds(bounds);
	},
	gotosearchnear:function(page)
	{
		var me = this;
		var nearType = $id("tempneartype").value;
		var nearName = $id("tempnearname").value;
		nearType = nearType.replace(/(^\s*)|(\s*$)/g, "");
		nearType = nearType.replace(/\s/g,"");
		nearName = nearName.replace(/(^\s*)|(\s*$)/g, "");
		nearName = nearName.replace(/\s/g,"");
		if('' == nearName || '' == nearType)
		{
			alert("�������ܱ߲�ѯ�ؼ��ʣ�");
			return false;
		}
		SFMap.isDragend = false;
		SFUI.hideId('map_total');
		SFMapUI.toggleRight(false);
		SFUI.showId('jczbresult');
		SFUI.hideId('hotzb');
		SFUI.showPeer('searching');
		var page = page || 0;
		var btype = 'house';
		if(me.markerNow && 'undefined' != typeof me.markerNow.title && me.markerNow.title == nearName)
		{
			me.searchNear(nearName, nearType, page);
		}
		else
		{
			var url = filePath + 'data/1.php';
			var pars = {'city':searchcondition['cityname'],'keyword':nearName,'btype':btype,'output':'json','random':Math.random()};
			var getNearPoint = function(originalRequest) {
				var json = originalRequest.responseText;
				try
				{
					var result = eval('(' + json + ')');
					if(!result.name || !result.x || !result.y || Math.abs(result.y*1) > 90 || Math.abs(result.x*1) > 180)
					{
						throw 'error';
					}
				}
				catch(e)
				{
					alert('�������ĵ���Ϣ����');
					return;
				}
				me.markerNow = {};
				me.markerNow.title = result.name;
				me.markerNow.x = result.x;
				me.markerNow.y = result.y;
				me.searchNear(nearName, nearType, page);
			};
			var ajax = new SFXHR(url, 'post', pars, getNearPoint, me.showFailure);
		}
	},
	searchNearType:function(obj)
	{
		var nearType = obj.innerHTML;
		$id("tempneartype").value = nearType;
		this.gotosearchnear(0);
	},
	searchNear:function(nearName, nearType, page)
	{
		var me = this;
		SFMap.isDragend = false;
		$id("searchNearResult").innerHTML = "";
		$id("searchnearname").innerHTML = nearName;
		$id("searchneartype").innerHTML = nearType;
		$id("searchnearnum").innerHTML = "0��";
		//SFUI.hideId('hotzb');
		SFUI.showId('jczbresult');
		$id('jczbtitle').innerHTML="�ܱ߲�ѯ���";
		SFUI.showPeer('searching');
		if('¥��' == nearType && filePath.indexOf('zhuangshi') == -1 && filePath.indexOf('jiancaicheng') == -1)
		{
			var url = filePath + 'data/1.php';
			//havecenter = 1;
			var pars = {
				'random':Math.random(),
				'cname':searchcondition['cityname'],
				'citycode':curCity,
				'page':page,
				'output':'json'
			};
			SFMap.map.setCenter(me.markerNow.y,me.markerNow.x,mapsize);
			var searchBounds = SFMap.map.gethdBounds();
			pars = SFUtil.objMerge(searchBounds,pars);
			var ajax = new SFXHR(url, 'post', pars, me.showSearchNearHouse, me.showFailure);
		}
		else
		{
			me.nearpage = page;
			var mlsp = new MLocalSearchOptions();
			mlsp.recordsPerPage = 8;
			mlsp.pageNum = page+1;
			if(me.markerNow.x != '' && me.markerNow.y != '' && Math.abs(me.markerNow.x*1) < 180 && Math.abs(me.markerNow.y*1) < 90)
			{
				me.gLocalSearch.poiSearchByCenterXY(new MLngLat(me.markerNow.x,me.markerNow.y),$id("tempneartype").value,curCity,mlsp);
			}
			else
			{
				me.gLocalSearch.poiSearchByCenterKeywords($id("tempnearname").value,$id("tempneartype").value,curCity,mlsp);
			}
	  }
	},
	//ajax����ʧ�ܻص�����
	showFailure:function()
	{
		alert("ϵͳæ��������");
	},
	init:function()
	{
		var me = this;
		for(var si in me.searchdrive) me.searchdrive[si] = '';
		me.markerBounds = [];
		me.markerNow = null;
		me.qidian = '';
		me.zhongdian = '';
		me.polyline = [];
		me.gLocalSearch = new MLocalSearch();
		me.gSelectedResults = [];
		me.gCurrentResults = [];
		me.gSearchForm;
		me.nearpage = 0;
		me.nearhouseResults = [];
		var OnLocalSearch = function(resData)
		{
			//alert('OnLocalSearch');
			if (!resData.poilist)
			{
				return;
			}
			//�������marker�Ͳ�
			SFMap.map.clearMarkers();
			SFMap.map.clearOverlays();
			SFMap.closeTip();
			var maxpage = 1;
			var maxnum = 0;
			var len = resData.poilist.length;
			//alert(resData.count);
			if(resData.count)
			{
				maxnum = resData.count;
			}
			else
			{
				maxnum = len;
			}
			if(maxnum > 32)
			{
				maxnum = 32;
			}
			maxpage = Math.ceil(maxnum/8);
			me.setnspage(me.nearpage,maxpage,'gotonearpage');
		
			for(var i=0; i<me.gCurrentResults.length; i++)
			{
			  //if (!me.gCurrentResults[i].selected())
			  //{
			  	SFMap.map.removeOverlay(me.gCurrentResults[i].marker());
			  //}
			}
			var bounds = new MLngLatBounds();
			me.gCurrentResults = [];
			for (var i = 0; i < len; i++)
			{
				bounds.extend(new MLngLat(resData.poilist[i].x,resData.poilist[i].y));
			  me.gCurrentResults.push(new LocalResult(resData.poilist[i],i));
			}
			var v_html = "<ul>";
			$id("searchnearnum").innerHTML = maxnum+"��";
			for(var i=0; i<len; i++)
			{
				var result = resData.poilist[i];
				var name = "";
				if('undefined' != typeof result.name)
				{
					name = result.name;
				}
				var tel = "";
				if('undefined' != typeof result.tel)
				{
					tel = result.tel;
				}
				var address = "";
				if('undefined' != typeof result.address)
				{
					address = result.address;
				}
				//��֯�Ҳ��б�����
				/*var sContent = '<div><b>'+parseInt(i+1)+'.'+name.replace(/&#39;/g, '&acute;')+'</b></div>';
				sContent += "<div><b>��ַ��</b>"+address.replace(/&#39;/g, '&acute;')+"</div>";
				if(tel != "")
				{
					sContent += "<div><b>�绰��</b>"+tel+"</div>";
				}*/
				v_html += '<li><div class="searchNearL"><div class="s2">'+parseInt(i+1)+'</div></div>';
				v_html += '<div class="searchNearR"><div class="s1"><a href="javascript:void(0);" onclick="SearchOther.gCurrentResults['+i+'].openInfoWindow()">'+name+'</a></div>';
				v_html += '<div class="s2">��ַ��'+address+'</div></div>';
				v_html += '<div class="clear"></div></li><li class="line"></li>';
			}
			v_html += "</ul>";
			if(v_html != "<ul></ul>")
			{
				$id("searchNearResult").innerHTML = v_html;
			  SFUI.showPeer('loca_result');
			}
			else
			{
			  SFUI.showPeer('local_notfound');
			}
			// move the map to the first result
		  //����ҳ��ߴ�
		  SFMapUI.autoResize();
			//�����ĵ�
			if(me.markerNow)
			{
				var m = me.markerNow;
				if(Math.abs(m.y*1)>90||Math.abs(m.x*1)>180) return;
				SFMap.map.drawMarkers([m]);
				//SFMap.map.addKeyMarker(m);
				bounds.extend(new MLngLat(m.x,m.y));
			}
			if(len > 0)
			{
				me.panMap(bounds);
			}
			else if(me.markerNow)
			{
				SFMap.map._map.setCenter(new MLngLat(me.markerNow.x,me.markerNow.y));
			}
		}
		me.gLocalSearch.setCallbackFunction(OnLocalSearch);
	},
	//�ܱ߲�ѯ
	gotonearpage:function(page)
	{
		var page = parseInt(page);
		var me = this;;
		me.nearpage = page;
		var mlsp = new MLocalSearchOptions();
		mlsp.recordsPerPage = 8;
		mlsp.pageNum = page+1;
		if(me.markerNow.x != '' && me.markerNow.y != '' && Math.abs(me.markerNow.x*1) < 180 && Math.abs(me.markerNow.y*1) < 90)
		{
			me.gLocalSearch.poiSearchByCenterXY(new MLngLat(me.markerNow.x,me.markerNow.y),$id("tempneartype").value,curCity,mlsp);
		}
		else
		{
			me.gLocalSearch.poiSearchByCenterKeywords($id("tempnearname").value,$id("tempneartype").value,curCity,mlsp);
		}
	},
	showSearchNearHouse:function(originalRequest)
	{
		var me = SearchOther;
		var json = originalRequest.responseText;
		try
		{
			var result = eval('(' + json + ')');
			var status = result.status;
		}
		catch(e)
		{
			SFUI.showPeer('local_notfound');
			return;
		}
	  if(status == 0)
		{
			SFUI.showPeer('local_notfound');
			return;
		}
		else
		{
			var allnum = (result.allnum) ? result.allnum : '';
			var maxpage = (result.maxpage) ? result.maxpage : '';
			var pagenow = (result.pagenow) ? result.pagenow : '';
	  	me.setnspage(pagenow,maxpage,'gotosearchnear');
	  	$id("searchnearnum").innerHTML = allnum+"��";
	  	//�������marker�Ͳ�
	  	SFMap.map.clearMarkers();
			SFMap.map.clearOverlays();
			SFMap.closeTip();
	    me.nearhouseResults = [];
	    var hits = result.hits;
			var hit = hits.hit;
			if(hit.newCode) hit = [hit];
			var len = hit.length;
			var houseBounds = new MLngLatBounds();
			var v_html = "<ul>";
			var counter = 0;
			for(var i=0; i<len; i++)
			{
				var V = hit[i];
				V.number = i;
				if("" == V.pic)
				{
					V.pic = "nogif.gif";
				}
				var dotphoto = "mf/img/near";
				dotphoto += parseInt(i+1)+".png";
				var httpaddress = null;
				if(V.purpose)
				{
					httpaddress = SFMap.info2url.detailUrl({'purpose':V.purpose,'newCode':V.newCode});
				}
				/*var sContent = '<div><b>'+V.title.replace(/&#39;/g, '&acute;')+'</b></div>';
				if(httpaddress)
				{
	   			sContent += '<div><a href=\\\''+httpaddress+'\\\' target=\\\'_blank\\\'>>>�鿴����</a></div>';
	    	}
	    	sContent += "<div><b>��ַ��</b>"+V.address.replace(/&#39;/g, '&acute;')+"</div>";
	   		sContent += "<div><b>�绰��</b>"+V.tel+"</div>";*/
				//��֯�Ҳ��б�����
				v_html += '<li><div class="searchNearL"><div class="s2">'+parseInt(i+1)+'</div></div>';
				if(V.y && V.x)
				{
					v_html += '<div class="searchNearR"><div class="s1"><a href="javascript:void(0);" onclick="SearchOther.nearhouseResults['+i+'].openInfoWindow()">'+V.title+'</a></div>';
					houseBounds.extend(new MLngLat(V.x,V.y));
					counter ++;
				}
				else
				{
					v_html += '<div class="searchNearR"><div class="s1">'+V.title+'</div>';
				}
				v_html += '<div class="s3">�绰��'+V.tel+'</div>';
				v_html += '<div class="s2">��ַ��'+V.address+'</div></div>';
				v_html += '<div class="clear"></div></li><li class="line"></li>';
				me.nearhouseResults.push(new LocalResult(V,i));
	    }
	    v_html += "</ul>";
	    if(v_html != "<ul></ul>")
	    {
	    	$id("searchNearResult").innerHTML = v_html;
	    	SFUI.showPeer('loca_result');
	    }
	    else
	    {
	    	SFUI.showPeer('local_notfound');
	    }
	    //����ҳ��ߴ�
	    SFMapUI.autoResize();
			if(me.markerNow)
	    {
	      if(Math.abs(me.markerNow.y*1)>90 || Math.abs(me.markerNow.x*1)>180) return;
	      houseBounds.extend(new MLngLat(me.markerNow.x,me.markerNow.y));
	      SFMap.map.drawMarkers([me.markerNow]);
	      //SFMap.map.addKeyMarker(me.markerNow);
	    }
	    if(counter > 0)
	    {
	    	if(me.markerNow && 'undefined' != typeof me.markerNow.district)
	    	{
	    		me.panMap(houseBounds);
	    	}
	    }
	    else if(me.markerNow)
	    {
	    	SFMap.map._map.setCenter(new MLngLat(me.markerNow.x,me.markerNow.y));
	    }
		}
	},
	//�ܱ߲�ѯ
	setnspage:function(page,maxpage,funcName)
	{
		var page = parseInt(page);
		var maxpage = parseInt(maxpage);
		var pager = 'ҳ�룺';
		if(page > 0)
		{
			pager += '<span onclick="SearchOther.' + funcName + '(\'' + (page-1) + '\')" style="cursor:pointer;">[��һҳ]</span> ';
		}
		if(page > 1 && maxpage > 3)
		{
			pager += '<span onclick="SearchOther.' + funcName + '(\'0\')" style="cursor:pointer;">[1]</span>... ';
			if((page+1)==maxpage) pager += '<span onclick="SearchOther.' + funcName + '(\'' + (page-1) + '\')" style="cursor:pointer;">['+page+']</span> '+(page+1)+' ';
			else pager += (page+1)+' <span onclick="SearchOther.' + funcName + '(\'' + (page+1) + '\')" style="cursor:pointer;">['+(page+2)+']</span> ';
		}
		else
		{
			var end = (maxpage > 3) ? 3 : maxpage;
			for(i=1; i<=end; i++)
			{
				if(i==(page+1)) pager += i+' ';
				else pager += '<span onclick="SearchOther.' + funcName + '(\'' + (i-1) + '\')" style="cursor:pointer;">['+i+']</span> ';
			}
		}
		if(page+1 < maxpage)
		{
			pager += '<span onclick="SearchOther.' + funcName + '(\'' + (page+1) + '\')" style="cursor:pointer;">[��һҳ]</span> ';
		}
		pager += '��'+maxpage+'ҳ';
		$id("nearpagemenu").innerHTML = pager;
	},
	qidian:'',
	startonclick:function(name,hitX,hitY)
	{
		var me = this;
		//���ò�ѯ�������
		me.searchdrive.x1 = hitX;
		me.searchdrive.y1 = hitY;
		me.searchdrive.start = name;
		var point = new MLngLat(hitX,hitY);
		//�����
		if(me.qidian != '')
		{
			me.qidian.setLatLng(point);
		}
		else
		{
			var markerOpt = new MMarkerOptions();
			markerOpt.imageUrl = 'mf/img/qd.png';
			//markerOpt.anchor = new MPoint(-22, -27);
			markerOpt.imageSize = new MSize(43,27);
			markerOpt.hasShadow = true;
			var labelOpt = new MLabelOptions();
			labelOpt.content = '<div style="background:#00BD0A;color:#ffffff;padding:2px;font-size:1em;">'+name+'</div>';
			markerOpt.labelOption = labelOpt;
			me.qidian = new MMarker(point,markerOpt);
			SFMap.map.addOverlay(me.qidian);
		}
		SFMap.map._map.setCenter(point);
	},
	zhongdian:'',
	endonclick:function(name,hitX,hitY)
	{
		var me = this;
		//���ò�ѯ�յ�����
		me.searchdrive.x2 = hitX;
		me.searchdrive.y2 = hitY;
		me.searchdrive.end = name;
		var point = new MLngLat(hitX,hitY);
		//���յ�
		if(me.zhongdian != '')
		{
			me.zhongdian.setLatLng(point);
		}
		else
		{
			var markerOpt = new MMarkerOptions();
			markerOpt.imageUrl = 'mf/img/zd.png';
			//markerOpt.anchor = new MPoint(-22, -27);
			markerOpt.imageSize = new MSize(43,27);
			markerOpt.hasShadow = true;
			var labelOpt = new MLabelOptions();
			labelOpt.content = '<div style="background:#00BD0A;color:#ffffff;padding:2px;font-size:1em;">'+name+'</div>';
			markerOpt.labelOption = labelOpt;
			me.zhongdian = new MMarker(point,markerOpt);
			SFMap.map.addOverlay(me.zhongdian);
		}
		SFMap.map._map.setCenter(point);
	},
	searchDrivePoint:function(searchname,btype,seflg)
	{
		var me = this;
		var url = filePath + 'data/1.php';
		var pars = {'city':searchcondition['cityname'],'keyword':searchname,'btype':btype,'output':'json','random':Math.random()};
		var showSearchDrivePoint = function(originalRequest)
		{
			if('e' == seflg)
			{
				var xname = 'x2';
				var yname = 'y2';
				var pointname = 'end';
				var pointstr = '�յ�';
			}
			else
			{
				var xname = 'x1';
				var yname = 'y1';
				var pointname = 'start';
				var pointstr = '���';
			}
			var json = originalRequest.responseText;
			try
			{
				var result = eval('(' + json + ')');
			}
			catch(e)
			{
				me.searchdrive[xname] = '';
				me.searchdrive[yname] = '';
				me.searchdrive[pointname] = '';
				alert('����ʱ����');
				return;
			}
		  if(result)
			{
				var status = result.status;
			}
			else
			{
				me.searchdrive[xname] = '';
				me.searchdrive[yname] = '';
				me.searchdrive[pointname] = '';
				alert('ϵͳ���������ԣ�');
				return;
			}
		  if(0 == status)
			{
				me.searchdrive[xname] = '';
				me.searchdrive[yname] = '';
				me.searchdrive[pointname] = '';
				alert('������'+pointstr+'���ƹؼ��ʣ�');
				return;
			}
			else if(2 == status)
			{
				me.searchdrive[xname] = '';
				me.searchdrive[yname] = '';
				me.searchdrive[pointname] = '';
				$id(pointname+'List').innerHTML = 'û��������'+searchname+'��ص�ַ';
				return;
			}
			else
			{
				var s_name = (result.name) ? result.name : '';
				var s_x = (result.x) ? result.x : 181;
				var s_y = (result.y) ? result.y : 91;
				var v_html = '';
				if(Math.abs(s_y*1) <= 90 && Math.abs(s_x*1) <= 180)
				{
					v_html += '<a href="javascript:;" onclick="SearchOther.'+pointname+'onclick(\''+s_name+'\',\''+s_x+'\',\''+s_y+'\')">'+s_name+'</a>';
					if('start' == pointname)
					{
						me.startonclick(s_name,s_x,s_y);
					}
					else
					{
						me.endonclick(s_name,s_x,s_y);
					}
					$id(pointname+'List').innerHTML = v_html;
					SFUI.showPeer('drive_start');
				}
		    else
		    {
					me.searchdrive[xname] = '';
					me.searchdrive[yname] = '';
					me.searchdrive[pointname] = '';
		     	$id(pointname+'List').innerHTML = 'û��������'+searchname+'��ص�ַ';
		    }
			}
		};
		var ajax = new SFXHR(url, 'post', pars, showSearchDrivePoint, me.showFailure);
	},
	listname:function(btype)
	{
		var me = this;
		var str = defaultValue["startarea"]["text"];
		if($id("tempdriverstart").value == str)
		{
			var startname = defaultValue["startarea"]["value"];
		}
		else
		{
			var startname = $id("tempdriverstart").value;
			startname = startname.replace(/(^\s*)|(\s*$)/g, "");
			startname = startname.replace(/\s/g,"");
		}
		if(startname=="" || startname == $id("tempdriverstart").defaultValue)
		{
			alert("����д�����Ϣ");
			return;
		}
		var str = defaultValue["endarea"]["text"];
		if($id("tempdriverend").value == str)
		{
			var endname = defaultValue["endarea"]["value"];
		}
		else
		{
			var endname = $id("tempdriverend").value;
			endname = endname.replace(/(^\s*)|(\s*$)/g, "");
			endname = endname.replace(/\s/g,"");
		}
		if(endname=="" || startname == $id("tempdriverend").defaultValue)
		{
			alert("����д�յ���Ϣ");
			return;
		}
		SFUI.showId('jczbresult');
		$id('jczbtitle').innerHTML="�ݳ���ѯ���";
		SFUI.showPeer('searching');
		//�������marker�Ͳ�
		SFMap.map.clearMarkers();
		SFMap.map.clearOverlays();
		SFMap.closeTip();
		me.qidian = '';
		me.zhongdian = '';
		me.polyline = [];
		var s = me.searchdrive;
		if(s.x1 != '' && s.y1 != '' && s.start == startname)
		{
			var v_html = '<a href="javascript:;" onclick="SearchOther.startonclick(\''+startname+'\',\''+s.x1+'\',\''+s.y1+'\')">'+startname+'</a>';
			$id("startList").innerHTML = v_html;
			me.startonclick(startname,s.x1,s.y1);
			SFUI.showPeer('drive_start');
		}
		else
		{
			me.searchDrivePoint(startname,btype,'s');
		}
		if(s.x2 != "" && s.y2 != "" && s.end == endname)
		{
			var v_html = '<a href="javascript:;" onclick="SearchOther.endonclick(\''+endname+'\',\''+s.x2+'\',\''+s.y2+'\')">'+endname+'</a>';
			$id("endList").innerHTML = v_html;
			me.endonclick(endname,s.x2,s.y2);
		}
		else
		{
			me.searchDrivePoint(endname,btype,'e');
		}
	},
	getdriverdistance:function(le)
	{
		if(le<=1000){
			return le+"��";
		}else{
			le = le/1000;
			var l = this.float_n(le,2);
			return l+"����";
		}
	},
	float_n:function(num,n)
	{
		num=""+num;
		var pos=num.indexOf(".");
		return parseFloat(num.substr(0,pos+n+1));
	},
	//��ѯ�ݳ�·��
	polyline:[],
	searchdrivelist:function()
	{
		var me = this;
		var s = me.searchdrive;
		if(s.x1 == '' || s.y1 == '' || s.x2 == '' || s.y2 == '')
		{
			alert('�ݳ���ѯ��ʼ�����ô���������');
			return;
		}
		SFUI.showId('jczbresult');
		$id('jczbtitle').innerHTML="�ݳ���ѯ���";
		SFUI.showPeer('searching');
		$id("driveline").innerHTML = '';
		$id("startdrive").innerHTML = '��㣺'+me.searchdrive.start;
		$id("enddrive").innerHTML = '�յ㣺'+me.searchdrive.end;
		//var directionsPanel = $id('driveline1');
	  //var directions = new GDirections('',directionsPanel);
	  var driverlinelist = function(resData)
		{
			if(!resData.segmengList) return;
			var routelines = resData.segmengList;
			var v_html = '';
			var alllength = 0;
			for(var i=0; i<routelines.length; i++)
			{
				v_html += '<div class="carSearchtr02" id="driver_step_'+i+'">'+(i+1)+'.'+routelines[i].textInfo+'</div>';
				alllength += routelines[i].roadLength.substring(0,routelines[i].roadLength-1)*1;
				var coords = routelines[i].coor.split(',');
				var plcoords = [];
				for(var j=0; j<coords.length; j+=2)
				{
					plcoords.push(new MLngLat(coords[j],coords[j+1]));
				}
				var plOpt = new MLineOptions();
				var plStyle = new MLineStyle();
				plStyle.thickness = 6;
				plStyle.color = '#ff0000';
				plOpt.lineStyle = plStyle;
				me.polyline[i] = new MPolyline(plcoords, plOpt);
				SFMap.map.addOverlay(me.polyline[i]);
			}
	  	if(v_html != '')
	  	{
	  		v_html = '<div class="carSearchtr01">����̣�'+me.getdriverdistance(alllength)+'</div>'+v_html;
	  		$id("driveline").innerHTML = v_html;
				SFUI.showPeer('drive_result');
	  	}
	  	else
	  	{
				$id("driveline").innerHTML = "";
				SFUI.showPeer('drive_notfound');
	  	}
		};
	  var routSearch = new MRoutSearch();
		var routSearchOpt = new MRoutSearchOptions();
		routSearchOpt.recordsPerPage = 1;
		routSearch.setCallbackFunction(driverlinelist);
		routSearch.routSearchByStartXYAndEndXY('drive',me.qidian.lnglat,me.zhongdian.lnglat,curCity,routSearchOpt);
	},
	foldline:function(num,count)
	{
		//����·����������б�.numΪ�ڼ�����·,countȫ����·��.
		try{
			for(var i=0;i<count;i++){
				var id = "driver_step_"+i;
				if($id(id)) $id(id).style.backgroundColor ='';
				if(me.polyline[i])
				{
					me.polyline[i].setStrokeStyle({color: "#ff0000"});
				}
			}
			var tr_id = "driver_step_"+num;
			if($id(tr_id)) $id(tr_id).style.backgroundColor ='#EEEEEE';
			if(me.polyline[num]) me.polyline[num].setStrokeStyle({color: "#00BD0A"});
		}catch(e){}
	},
	clearHint:function(formitem) {
		if (formitem.value == formitem.defaultValue) {
			formitem.value = '';
		}
	},
	showHint:function(formitem) {
		if ('' == formitem.value) {
			formitem.value = formitem.defaultValue;
		}
	}
};

var LocalResult = function(res,i)
{
	var result = {};
	for(var n in res)
	{
		switch(n)
		{
			case 'name':
				result.name = res.name;
				break;
			case 'title':
				result.name = res.title;
				break;
			case 'gridcode':
				result.type = 'local';
				break;
			case 'y':
				result.y = res.y;
				break;
			case 'x':
				result.x = res.x;
				break;
			case 'tel':
				result.tel = res.tel;
				break;
			case 'address':
				result.address = res.address;
				break;
			case 'purpose':
				result.purpose = res.purpose;
				break;
			case 'newCode':
				result.newCode = res.newCode;
				break;
		}
	}
	result.detailUrl = '';
	var list = ['name','y','x','tel','address','purpose','newCode'];
	for(var j=0; j<list.length; j++)
	{
		if('undefined' == typeof result[list.j])
		{
			result[list.j] = '';
		}
	}
	if('undefined' == typeof result.type || 'local' != result.type)
	{
		result.detailUrl = SFMap.info2url.detailUrl({'purpose':result.purpose,'newCode':result.newCode});
	}
	this.result_ = result;
	this.result_["num"] = i;
	this.resultNode_ = this.unselectedHtml();
	//document.getElementById("searchNearResult").appendChild(this.resultNode_);
	if(result.y != '' && result.x != '')
	{
		var nearicon = this.getnearphoto(i);
		SFMap.map.addOverlay(this.marker(nearicon));
	}
};
LocalResult.prototype.marker = function(opt_icon)
{
	if(this.marker_) return this.marker_;
	var markerOpt = new MMarkerOptions();
	markerOpt.imageUrl = opt_icon;
	markerOpt.imageSize = MSize(21,31);
	var tipOption = new MTipOptions();
	tipOption.tipType = HTML_BUBBLE_TIP;
	tipOption.content = this.unselectedHtml();
	tipOption.title = this.result_.name || '';
	var lineStyle = new MLineStyle();
	lineStyle.color = '#C0C0C0';
	tipOption.borderStyle = lineStyle;
	var tFillStyle = new MFillStyle();
	tFillStyle.color = '#7B7B7B';
	tipOption.titleFillStyle = tFillStyle;
	tipOption.tipWidth = 250;
	tipOption.tipHeight = 180;
	markerOpt.tipOption = tipOption;
	markerOpt.canShowTip = true;
  var marker = new MMarker(new MLngLat(parseFloat(this.result_.x),parseFloat(this.result_.y)),markerOpt);
  //GEvent.bind(marker, "click", this, function(){marker.openInfoWindow(this.unselectedHtml());});
  this.marker_ = marker;
  return marker;
};
LocalResult.prototype.openInfoWindow = function()
{
	SFMap.map._map.openOverlayTip(this.marker().id);
};
// Returns the HTML we display for a result before it has been "saved"
LocalResult.prototype.unselectedHtml = function()
{
	if(this.resultNode_) return this.resultNode_;
	var result = this.result_;
	//��֯�Ҳ��б�����
	var sContent = '<div style="padding:10px;line-height:20px;color:#00468C;">';//'<b>'+result.name.replace(/&#39;/g, '&acute;')+'</b><br/>';
	if(result.detailUrl)
	{
		sContent += '<a href="'+result.detailUrl+'" target="_blank">>>�鿴����</a><br/>';
	}
	sContent += '<b>��ַ��</b>'+result.address.replace(/&#39;/g, '&acute;')+'<br/>';
	if(result.tel)
	{
		sContent += '<b>�绰��</b>'+result.tel+'<br/>';
	}
	sContent += '</div>';
	return sContent;
};
/*
LocalResult.prototype.select = function()
{
	if (!this.selected()) {
	  this.selected_ = true;

	  // Remove the old marker and add the new marker
	  SFMap.map.removeOverlay(this.marker());
	  this.marker_ = null;
	  SFMap.map.addOverlay(this.marker(G_DEFAULT_ICON));

	  // Add our result to the saved set
	  document.getElementById("selected").appendChild(this.selectedHtml());

	  // Remove the old search result from the search well
	  this.resultNode_.parentNode.removeChild(this.resultNode_);
	}
};

// Returns the HTML we display for a result after it has been "saved"
LocalResult.prototype.selectedHtml = function()
{
  return this.result_.html.cloneNode(true);
};

// Returns true if this result is currently "saved"
LocalResult.prototype.selected = function()
{
  return this.selected_;
};
*/
LocalResult.prototype.getnearphoto = function(i)
{
	//var gSmallIcon = new GIcon();
	var dotphoto = "mf/img/near";
	dotphoto += parseInt(i+1)+".png";
	return dotphoto;
  /*gSmallIcon.image = dotphoto;
  gSmallIcon.shadow = dotphoto;
  gSmallIcon.iconSize = new GSize(21, 31);
  gSmallIcon.shadowSize = new GSize(22, 20);
  gSmallIcon.iconAnchor = new GPoint(6, 20);
  gSmallIcon.infoWindowAnchor = new GPoint(5, 1);
  return gSmallIcon;*/
};
