/**
* ʵ����MapApi�����������Ȳ���
*/
var SFMap = {
	map:null,
	zoomMax:19,
	zoomMin:12,
	metaMarkers:null,
	dragSearch:true,
	isDragend:true,
	mapDragTimeOut:null,
	//�����洢��ǰҳ�������е����Ϣ
	markerList:{},
	keyPointMarker:null,
	firstLoad:true,
	autoView:false,
	titleText:'',

	openTipById:function(newCode)
	{
		var mNode = $id('tip'+newCode);
		if(mNode)
		{
			if(document.all)
			{
				mNode.click();
			}
			else
			{
				var evt = document.createEvent('MouseEvents');
				evt.initEvent('click', true, true);
				mNode.dispatchEvent(evt);
			}
		}
	},
	closeTip:function()
	{
		this.map.closeTip();
	},
	toggleDrag:function(node, isClick)
	{
		if(node.checked)
		{
			this.dragSearch = false;
		}
		else
		{
			this.dragSearch = true;
			if(isClick) this.searchResult();
		}
	},
	setDragSearch:function(flg)
	{
		this.dragSearch = flg;
	//	$id('lock').checked = (!flg);
	},
	getDragSearch:function()
	{
		return this.dragSearch;
	},
	desName:'¥��',
	init:function()
	{
		this.map = new MapApi('map_canvas', cityy, cityx, mapsize);
		if(filePath.indexOf('zhuangshi') > -1)
		{
			this.desName = 'װ�ι�˾';
			this.cookieName = 'map_fav_zs';
		}
		if(filePath.indexOf('jiancaicheng') > -1)
		{
			this.desName = '����';
			this.cookieName = 'map_fav_jcc';
		}
	},

	//���غ���Ȧ���������ػ���Ȧ������������ĵ㣬�ѵ�ͼ�ƶ���Ȼ������������
	getCenter:function(dname,pname) {
		var me = this;
		var pname = pname || '';
		me.isDragend = false;
		if('' == dname || 'ȫ������' == dname)
		{
			//me.map.panTo(cityy,cityx);
			//me.map.setZoom(mapsize);
			me.map.setCenter(cityy,cityx,mapsize);
			me.searchResult();
			return;
		}
		if ('װ�ι�˾' == me.desName || '����' == me.desName)
		{
			if (DistrictCenter[dname])
			{
				var disCenter = DistrictCenter[dname].split(',');
				me.map.setCenter(disCenter[1],disCenter[0],mapsize);
				me.searchResult();
			}
			else
			{
				alert('�޷����'+dname+'��λ��');
			}
			return;
		}
		var showGetCenter = function (originalRequest)	{
			var objxml = originalRequest.responseXML;
			var result = objxml.getElementsByTagName("result")[0];
			if(!result) return;
			var status = result.getElementsByTagName("status")[0].firstChild.data;
			if(status == 0)
			{
				return;
			}
			else
			{
				var x = 181;
				if(result.getElementsByTagName("x")[0].firstChild != null)
				{
					x = result.getElementsByTagName("x")[0].firstChild.data;
				}
				var y = 91;
				if(result.getElementsByTagName("y")[0].firstChild != null)
				{
					y = result.getElementsByTagName("y")[0].firstChild.data;
				}
				if(Math.abs(y*1)<=90&&Math.abs(x*1)<=180)
				{
					//me.map.panTo(y,x);
					//me.map.setZoom(mapsize);
					me.map.setCenter(y,x,mapsize);
					me.searchResult();
				}
			}
		};

		//var url = urldemo + 'getcenter.php';
		var url = filePath + 'op=getcenter';
		var method = 'post';
		var params = {'cname':searchcondition['cityname'],'dname':dname,'pname':pname,'random':Math.random()};

		var xhr = new SFXHR(url, method, params, showGetCenter);

	},
	keepkw:false,
	kwHouse:false,
	gotosearch:function(page)
	{
		var me = this;
		var page = page || 0;
		page = parseInt(page);
		if(me.keepkw)
		{
			me.searchResult(page,1);
		}
		else if(me.kwHouse)
		{
			me.searchKeyword(page);
		}
		else
		{
			me.searchResult(page);
		}
	},
	//ִ������
	searchResult:function(page,keepKeyword,keepSort)
	{
		var me = this;
		var page = page || 0;
		me.kwHouse = false;
		me.isDragend = true;
		SFUI.hideId('jczbresult');
	//	SFUI.showPeer('rightmenu1');

		var searchBounds = this.map.gethdBounds();
		var params = {'city':city,'cname':searchcondition['cityname'],'citycode':curCity,'page':page,'output':'json','random':Math.random()};
		var type_cn = '¥��';

		if ('װ�ι�˾' == me.desName)
		{
			type_cn = '��˾';
			var url = filePath + 'search_zs.php';
			params.cid = zssearch.cid;
			if(zssearch.dealerid > 0 && me.firstLoad) params.dealerid = zssearch.dealerid;
			params.dearlertype = 2;
			params = SFUtil.objMerge(searchBounds,params);
		}
		else if ('����' == me.desName)
		{
			type_cn = '����';
			var url = filePath + 'search_jcc.php';
			params.cid = zssearch.cid;
			if(zssearch.dealerid > 0 && me.firstLoad) params.dealerid = zssearch.dealerid;
			params.dearlertype = 2;
			//var keyword = inputKeyword.value;
			if(keepKeyword)
			{
				/*if ('' == keyword || keyword == inputKeyword.defaultValue)
				{
					alert('������ؼ���');
					return ;
				}*/
				me.setDragSearch(false);
				//url = filePath + 'searchkey_jcc.php';
				//params.keyword = keyword;
			}
			else if($id('subway').value)// && SFMap.map.viewAuto)
			{
				params.subway = $id('subway').value;
			}
			var district = $id('district').value;
			var len = (district.indexOf(',') > 0) ? district.indexOf(',') : district.length;
			params.district = district.substring(0,len);
			params.did = district.substring(len+1);
			params = SFUtil.objMerge(searchBounds,params);
		}
		else
		{
			var url = filePath + 'op=search';
			if(searchcondition.newcodes)
			{
				params.newcode_list = searchcondition.newcodes;
			}
		
		//	$id('lock').checked = true;
			//û�л��߻�������ʱ���ٴ��ݵ�ǰ��ͼ��Χ����Ĳ�����GET ������ʱ����ͻ��߲��ӷ�Χ���������غ���Ȧ��Ҫ�ӷ�Χ
			//if(!((params.round || params.subway) && SFMap.map.viewAuto) && (!me.firstLoad || (''==searchcondition.round && ''==searchcondition.subwayname))) {
			me.autoView = !me.firstLoad && !params.districts && !params.round && !params.subway && !keepKeyword && me.autoView;
			if(!me.autoView && !(params.round && SFMap.map.viewAuto) && (!me.firstLoad || (''==searchcondition.round && ''==searchcondition.subwayname))) {
				params = SFUtil.objMerge(searchBounds,params);
				SFMap.map.setViewAuto(false);
			}
			if(me.autoView)
			{
				me.toggleDrag(false);
				me.autoView = false;
				me.map.setCenter(cityy,cityx,9);
				if(!me.dragSearch) me.searchResult();
				return;
			}
		}
		var method = 'post';
		var titleword = '';
		var words = '<li>���ŵ�ͼ��</li><li>����ѡ������</li><li>��������ؼ��֡�</li>';
		if(me.keepkw)
		{
			titleword = (SFUtil.getStrlen(keyword) > 4) ? SFUtil.subStrcn(keyword,4)+'.' : keyword;
			me.titleText = '<div onclick="SFMap.searchKeyword(0,\'house\',\''+keyword+'\')" class="s5">��Ϊ<strong>'+titleword
				+'</strong>��'+type_cn+'</div><div onclick="SFMap.searchKeyword(0,\'key\',\''+keyword+'\')" class="s4"><strong>'+titleword+'</strong>������'+type_cn+'</div>';
			words = '<li>ѡ������</li><li>���Բ�ͬ�ؼ��֡�</li>';
		}
		else if('undefined' != typeof params.params && params.params.length > 0)
		{
			titleword = (SFUtil.getStrlen(params.params) > 12) ? SFUtil.subStrcn(params.params,12)+'.' : params.params;
			me.titleText = '<div class="s1"></div><div class="s2"><strong>'+titleword+'</strong>������'+type_cn+'</div><div class="s3"></div>';
		}
		/*else if('undefined' != typeof params.round && params.round.length > 0)
		{
		}
		else if('undefined' != typeof params.subway && params.subway.length > 0)
		{
		}*/
		else
		{
			me.titleText = '<div class="s1"></div><div class="s2">�������'+type_cn+'</div><div class="s3"></div>';
		}

		var onComplete = function(origRequest)
		{
//			SFUI.showId('map_total');
			SFUI.hideId('map_loading');
			try
			{
				var json = origRequest.responseText;
				//alert(json);
				var result = eval('(' + json + ')');
				var status = result.status;
			}
			catch(e)
			{
				alert('ϵͳ���������ԣ�');
				return;
			}

			//���������ŵ���������ʾ�������ĵط�
			me.markerList = {};
			me.map.clearMarkers();
			if($id('subway') && '' == $id('subway').value)
			{
				me.map.clearOverlays();
			}

			result.words = words;
			result.title = me.titleText;

			if(0 == status)
			{
				var allnum = 0;
				result.allnum = 0;
			}
			else
			{
				var allnum = result.allnum;
			}
			//�Ѷ����ݵĴ����ŵ�������
			if(allnum > 0)
			{
				if(result.hits.hit.newCode) result.hits.hit = [result.hits.hit];
				var hits = result.hits.hit;
				//var hits = result.hits;
				var metaMarkers = me.getMetaMarkers(hits);
				me.showResult(metaMarkers);
				result.hits.hit = metaMarkers;
			}
			if(me.keyPointMarker)
			{
				me.map.addKeyMarker(me.keyPointMarker);
				me.keyPointMarker = null;
			}

			//���������ʱ���ٰѹ���ߺ�վ������� drawSubWay(); �� search_subway.js ��
			/*if (filePath.indexOf('jiancaicheng') < 0 && $id('subway').value!='') {
				SFMap.drawSubWay();
			}*/

			//������������� showList ���������󣬲����� map_total �� showList

			//�����������������ʾ��
			//SFUI.showId('map_total');
			me.showList(result);

			//������֮�������ת���ݳ������ܱߵĶ���
			if(!me.firstLoad)
			{
				return true;
			}
			me.firstLoad = false;
			//listtype �� searchcondition.listtype�õ���ͬһ��ֵ
			if(!listtype || (!searchcondition.newcode && !zssearch.dealerid))
			{
				return true;
			}
			var infoId = searchcondition.newcode || zssearch.dealerid
			var info = SFMap.markerList[infoId];
			if(!info)
			{
				alert('�޷����' + me.desName + '��λ��');
				return true;
			}
			if('jc' == listtype)
			{
				if('' != searchcondition.drivertype && 'end' != searchcondition.drivertype)
				{
					SearchOther.filltempdrive(info.title, info.newCode, 's');
					$id('tempdriverend').value = searchcondition.driverpoint;
				}
				else
				{
					SearchOther.filltempdrive(info.title, info.newCode);
					$id('tempdriverstart').value = searchcondition.driverpoint;
				}
			}
			else
			{
				SearchOther.filltempsearch(info.title,info.newCode);
				var searchName = searchcondition.searchname || '';
				if (searchName)
				{
					$id('tempneartype').value = searchName;
					SearchOther.gotosearchnear();
				}
			}
		};
		var onFailure = function()
		{
			alert('ϵͳ����');
		};
		var xhr = new SFXHR(url, method, params, onComplete, onFailure, me.onLoading);
		//alert(v);
	},
	onLoading:function()
	{
	//	SFUI.hideId('map_total');
		SFUI.showId('map_loading');
		var titleText = SFMap.titleText ? SFMap.titleText : '�������¥��';
		$id('tab_div0').innerHTML = '<div class="searchinfobt">'+titleText+'</div><div class="inforightnr">'+
			'<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center"><tr><td style="padding: 20px 0pt;"><img width="18" height="18" align="absmiddle" src="./img/load_18x18.gif" alt="">&nbsp;&nbsp;�������������Ժ�...</td></tr></table></div>';
	},
	info2url:
	{
		//�������Ϻ������ݡ����ڡ���򡢳ɶ������졢���ݡ����ݡ�����
		officeCity:(city == "bj" || city == "sh" || city == "cd" || city == "gz" || city == "sz" || city == "tj" || city == "cq" || city == "sy" || city == "hz" || city == "suzhou"),
		//�������Ϻ������ڡ�����人�����ݡ����ݡ���ݸ
		shopCity:(city == "bj" || city == 'hz' || city == "sh" || city == "dg" || city == "sz" || city == "tj" || city == "wuhan" || city == "suzhou"
		//���ݡ����졢�ɶ����Ͼ����ൺ����������ɳ���������������Ϸʡ�������ʯ��ׯ�����ϡ���������������ɽ���ϲ�����ɽ�����ݡ����ϡ�������������֣��
		 || city == 'gz' || city == 'cq' || city == 'cd' || city == 'nanjing' || city == 'qd' || city == 'sy' || city == 'cs' || city == 'xian' || city == 'nb' || city == 'hf' || city == 'dl' || city == 'sjz' || city == 'jn' || city == 'wuxi' || city == 'changchun' || city == 'ks' || city == 'nc' || city == 'ts' || city == 'cz' || city == 'hn' || city == 'nn' || city == 'km' || city == 'zz'),
		shopBbs:{},
		picAddress:function(info)
		{
			var pic = info.picAddress;
			if('' == pic)
			{
				pic = '';
			}
			else
			{
				pos = pic.lastIndexOf('.');
				pic = pic.substr(0, pos) + '_s'+pic.substr(pos);
			}
			return pic;
		},
		houseImg:function(info)
		{
			var purpose = info.purpose;
			var serverUrl = 'http://';
			serverUrl += houseurl;
			serverUrl += info.newCode + '/xiangce.html';
			return serverUrl;
		},
		activUrl:function(info)
		{
			var purpose = info.purpose;
			var serverUrl = 'http://';
			serverUrl += houseurl+ info.newCode+'/dongtai.html';
			return serverUrl;
		},
		detailUrl:function(info)
		{
			var purpose = info.purpose;
			var serverUrl = 'http://';			
			serverUrl = houseurl;
			serverUrl += info.newCode+'/';
			return serverUrl;
		},
		jiucuoUrl:function(info)
		{
			var serverUrl = 'http://';
			return serverUrl;
		},
		bbsUrl:function(info)
		{
			var purpose = info.purpose;
			if(purpose.indexOf('����') > -1 && 'undefined' != typeof(this.shopBbs[city]))
			{
				return this.shopBbs[city];
			}
			else if(purpose.indexOf('д��¥') > -1)
			{
				return '';
			}
			return info.bbs;
		}
	},
	getMetaMarkers:function(hits)
	{
		var me = this;
		var metaMarkers = [];
		if(!hits) return metaMarkers;
		var cookieStr = SFUtil.getCookie(me.cookieName);
		if ('װ�ι�˾' == me.desName)
		{
			for(var i=0; i<hits.length; i++)
			{
				var info = hits[i];
				if('' == info.surl) info.surl = 'javascript:alert(\'�޴˵�������\')';
				if('' == info.lurl) info.lurl = '';
				if('' == info.linkman) info.linkman = '����';
				if('' == info.phone) info.phone = '����';
				if('' == info.add) info.add = '����';
				info.title_s = info.title;
				if('' == info.title)
				{
					info.title = '����';
					info.title_s = '����';
				}
				else
				{
					var strlen = SFUtil.getStrlen(info.title);
					if(strlen > 36) info.title_s = SFUtil.subStrcn(info.title,36);
				}
				//�Ƿ����ղ�
				if (cookieStr.indexOf(info.newCode) > -1 )
				{
					info.fav = '<span style="color:#999">[���ղ�]</span>';
					//info.favd = '<span style="color:#999;">�ղظ�' + me.desName + '</span>';
				}
				else
				{
					info.fav = '[<a href="javascript:;" onclick="SFMap.addFavorite(\'' + info.newCode + '\',this);//Clickstat.optClickHandler(\'list\',\'addfavorite\',\''+info.newCode+'\',\''+info.title+'\');">�ղ�</a>]';
					//info.favd = '<a href="javascript:;" onclick="SFMap.addFavorite(\'' + info.newCode + '\',this);Clickstat.optClickHandler(\'tip\',\'addfavorite\',\''+info.newCode+'\',\''+info.title+'\');">�ղظ�' + me.desName + '</a>';
				}
				me.markerList[info.newCode] = info;
				metaMarkers.push(info);
				//if(0 == i) alert(iterate(info));
			}
		}
		else
		{
			for(var i=0; i<hits.length; i++)
			{
				var info = hits[i];
				var scArr = {'0':'����', '1':'����','2':'��������', '3':'β��', '4':'����'};
				info.saling_cn = '';
				if('undefined' != typeof info.saling && 'undefined' != typeof scArr[info.saling])
				{
					info.saling_cn = '��'+scArr[info.saling]+'��';
				}
			//	info.picAddress = me.info2url.picAddress(info);
				info.bbs = me.info2url.bbsUrl(info);
				if('' != info.bbs) info.bbs = '[<a href="'+info.bbs+'" target="_blank" onclick="//Clickstat.optClickHandler(\'tip\',\'bbs\',\''+info.newCode+'\',\''+info.title+'\');">ҵ����̳</a>]';
				info.detailUrl = me.info2url.detailUrl(info);
				info.jiucuoUrl = me.info2url.jiucuoUrl(info);
				info.houseImg = me.info2url.houseImg(info);
				info.imgTitle = (info.purpose.indexOf('д��¥') > -1 || info.purpose.indexOf('����') > -1) ? '¥�����' : '����ͼ';
				info.activUrl = me.info2url.activUrl(info);
				info.tel=info.tel400 || info.tel;
				if('' == info.tel) info.tel = '����';
				if('' == info.purpose) info.purpose = '����';
				if(('' == info.startTime)||('0000-00-00'== info.startTime)) info.startTime = '����';
				if('' == info.developer) info.developer = '����';
				if('' == info.address) info.address = '����';
				if('' == info.price_type) info.price_type = '�۸�';
				if('' == info.price_num || '' == info.price_unit)
				{
					info.price_num = 'һ��һ��';
					info.price_unit = '';
					info.price_d = '<li class="link1">'+info.price_type+'��'+info.price_num+info.price_unit+'</li>';
				}
				else
				{
					info.price_d = '<li class="link1">'+info.price_type+'��<span>'+info.price_num+'</span>'+info.price_unit+'</li>';
				}
				info.title_s = info.title;
				if('' == info.title)
				{
					info.title = '����';
					info.title_s = '����';
				}
				else
				{
					var strlen = SFUtil.getStrlen(info.title);
					if(strlen > 36) info.title_s = SFUtil.subStrcn(info.title,36);
				}
				//�Ƿ����ղ�
				if (cookieStr.indexOf(info.newCode) > -1 )
				{
					info.fav = '<span style="color:#999">[���ղ�]</span>';
					//info.favd = '<span style="color:#999;">�ղظ�' + me.desName + '</span>';
				}
				else
				{
					info.fav = '[<a href="javascript:;" onclick="SFMap.addFavorite(\'' + info.newCode + '\',this);//Clickstat.optClickHandler(\'list\',\'addfavorite\',\''+info.newCode+'\',\''+info.title+'\');">�ղ�</a>]';
					//info.favd = '<a href="javascript:;" onclick="SFMap.addFavorite(\'' + info.newCode + '\',this);Clickstat.optClickHandler(\'tip\',\'addfavorite\',\''+info.newCode+'\',\''+info.title+'\');">�ղظ�' + me.desName + '</a>';
				}
				me.markerList[info.newCode] = info;
				if(me.keyPointMarker && me.keyPointMarker.name == info.title)
				{
					metaMarkers.unshift(info);
				}
				else
				{
					metaMarkers.push(info);
				}
			}
		}
		return metaMarkers;
	},
	showResult:function(metaMarkers)
	{
		//alert('showResult');
		var isDragendSave = this.isDragend;
		this.isDragend = false;
		this.map.drawMarkers(metaMarkers);
		//alert(this.isDragend);
		this.isDragend = isDragendSave;
	},
	showList:function(dataAll)
	{
		//alert('showList');
		var me = this;
		var allCount = parseInt(dataAll.allnum);
		if (dataAll.status != 0 && allCount > 0) {
			var dataList = dataAll.hits.hit;
			//var dataList = dataAll.hits;
			var pagenow = parseInt(dataAll.pagenow)+1;
			var pagemax = parseInt(dataAll.maxpage);
			//alert('showList');
			var result = {};
			result.title = dataAll.title;
			result.allcount = '��<span>' + allCount + '</span>�����';
			if ('¥��' != me.desName)
			{
				result.sortStr = '';
			}
			
			var view = '';
			var templateList = $id('template_list').value;
			var templateResult = $id('template_result').value;
			for(var i=0; i<dataList.length; i++)
			{
				var v = dataList[i];
				view += SFUI.templateFetch(templateList, v);
			}
			//alert(view);
			result.list = view;
			var pager = '';
			if(pagenow > 2)
			{
				pager += '<span>[<a href="javascript:;" onclick="SFMap.gotosearch('+(pagenow-2)+');">��һҳ</a>]</span>';
			}
			if(pagenow > 2 && pagemax > 3)
			{
				pager += '<span>[<a href="javascript:;" onclick="SFMap.gotosearch(0);">1</a>]</span>...';
				if(pagenow==pagemax) pager += '<span>[<a href="javascript:;" onclick="SFMap.gotosearch(\''+(pagenow-2)+'\');">'+(pagenow-1)+'</a>]</span>'+pagenow;
				else pager += pagenow+' <span>[<a href="javascript:;" onclick="SFMap.gotosearch('+pagenow+');">'+(pagenow+1)+'</a>]</span>';
			}
			else if(pagemax > 1)
			{
				var end = (pagemax > 3) ? 3 : pagemax;
				for(i=1; i<=end; i++)
				{
					if(i==pagenow) pager += pagenow;
					else pager += '<span>[<a href="javascript:;" onclick="SFMap.gotosearch('+(i-1)+');">'+i+'</a>]</span>';
				}
			}
			if(pagenow < pagemax)
			{
				pager += '<span>[<a href="javascript:;" onclick="SFMap.gotosearch('+pagenow+');">��һҳ</a>]</span>';
			}
			pager += ' ��'+pagemax+'ҳ';
			result.pager = pager;
			var resultView = SFUI.templateFetch(templateResult, result);
			$id('tab_div0').innerHTML = resultView;
			var showName = (me.desName.length > 2) ? '��˾' : me.desName;
			var tipTotal = '�������ҵ���'+allCount+'��'+showName;
//			$id('map_total').innerHTML = tipTotal;
			var cookieStr = SFUtil.getCookie('com_s');
			if (allCount > 50 && !cookieStr) {
				var fdtip = {};
				fdtip.words = '������ѡ�����򡱿��ٶ�λ';
				fdtip.iknow = 'SFMapUI.iKnow(\'com_s\');';
				var templatefdtip = $id('template_fdtips').value;
				var fdtipValue = SFUI.templateFetch(templatefdtip, fdtip);
				var fdtipDiv = $id('fdtip');
				fdtipDiv.innerHTML = fdtipValue;
				var pos = SFUI.getAbsPoint($id('district_a'));
				fdtipDiv.style.display = 'block';
				fdtipDiv.style.top = (pos.y-fdtipDiv.offsetHeight)+'px';
				fdtipDiv.style.left = (pos.x+15)+'px';
			}
			//filePath ���������� index_header.html ��
			//tipTotal += '&nbsp;&nbsp;<a href="javascript:;" onclick="SFUI.hideId(\'map_total\');"><img src="'+imgPath+'img/icon_title10.gif" alt="�ر�" /></a>';
			SFMapUI.autoResize();
		}
		else
		{
			var showName = (me.desName.length > 2) ? '��˾' : me.desName;
//			$id('map_total').innerHTML = '�������ҵ���0��'+showName;
			var templateResult = $id('template_notfound').value;
			var resultView = SFUI.templateFetch(templateResult, dataAll);
			$id('tab_div0').innerHTML = resultView;
		}
	},
	cookieName:'map_fav',
	cookieMax: 10,
	cookieDays: 30,
	//�����ȫ������, 4 ��¥�̾ͽӽ� 4KB ��,ֻ�ܼ���Ҫ��Ϣ��
	addFavorite:function(newCode,item)
	{
		var me = this;
		//var mNode = $id('tip'+newCode);
		var detail = this.markerList[newCode];
		//if(mNode)
		if(detail)
		{
			//var detail = mNode.provalue;
			var info = {'newCode':detail.newCode, 'title':detail.title};
			//alert(iterate(info ));
			var cookieStr = SFUtil.getCookie(this.cookieName);

			if (cookieStr.indexOf(SFUtil.obj2str(info)) > -1 ) {
				alert('�����ղش�' + me.desName + '!');
			}
			else {
				var cookieValue = ('' == cookieStr) ? [] : eval(cookieStr);
				var favNum = cookieValue.length;
				//alert(favNum );
				if (favNum >= this.cookieMax) {
					alert('���������ղ�'+this.cookieMax+'��' + me.desName + '�����������ղ��б���ɾ���������ղص�' + me.desName + '��');
				}
				else {
					cookieValue.push(info);
					cookieStr = SFUtil.obj2str(cookieValue);
					SFUtil.setCookie(this.cookieName,cookieStr, this.cookieDays);
					if(item)
					{
						var itemParent = item.parentNode;
						itemParent.innerHTML = '<span style="color:#999">[���ղ�]</span>';
						/*if('s2' == itemParent.className)
						{
							itemParent.innerHTML = '<span style="color:#999">[�ղ�]</span>';
						}
						else
						{
							itemParent.innerHTML = '<span style="color:#999">�ղظ�' + me.desName + '</span>';
						}*/
					}
					//alert('�ղسɹ�!');
				}
			}
		}
		else
		{
			alert('�޷��ղش�' + me.desName + '��');
		}
	},
	delFavorite:function(newCode, aLink)
	{
		if(!newCode) return;
		//��ɾ���ڵ�
		var barFav = aLink.parentNode.parentNode;
		var listFav = barFav.parentNode;
		listFav.removeChild(barFav);
		//�����ر��
		this.map.hideMarker(newCode);

		//��ɾ�� cookie
		var cookieStr = SFUtil.getCookie(this.cookieName);

		var cookieValue = ('' == cookieStr) ? [] : eval(cookieStr);
		var cookieNow = [];
		for(var i=0; i<cookieValue.length; i++)
		{
			if(newCode == cookieValue[i].newCode) {
				continue;
			}
			else {
				cookieNow.push(cookieValue[i]);
			}
		}
		cookieStr = SFUtil.obj2str(cookieNow);
		SFUtil.setCookie(this.cookieName,cookieStr, this.setCookie);
	},
	clearFavorite:function()
	{
		if(!confirm('ȷ��Ҫ����ղأ�'))
		{
			return;
		}
		var container = $id('map_fav');
		var checkboxes = container.getElementsByTagName('input');
		//alert(checkboxes.length);
		var newCode = '';
		for (var i=0; i<checkboxes.length;i++ ) {
			newCode = checkboxes[i].value;
			//�����ر��
			this.map.hideMarker(newCode);
		}
		container.innerHTML = '����û���ղ�';
		SFUtil.setCookie(this.cookieName,'',0);
	},
	//�б�ȫ���ղ�
	showFavorite:function()
	{
		var me = this;
		me.map.clearMarkers();
		me.map.clearOverlays();
		me.isDragend = false;
		var cookieStr = SFUtil.getCookie(this.cookieName);
		var cookieValue = ('' == cookieStr) ? [] : eval(cookieStr);
		var favNum = cookieValue.length;
		//alert(favNum );
		var view = '';
		if (0 == favNum) {
			view = '';
		}
		else {
			var template = $id('template_fav').value;
			var idList = [];
			for (var i=0;i < favNum; i++) {
				//alert(i + cookieValue[i].title);
				view += SFUI.templateFetch(template, cookieValue[i]);
				idList.push(cookieValue[i].newCode);
			}
			//alert(idList.join());
			//ִ������
			//var searchBounds = this.map.gethdBounds();
			var params = {'cname':searchcondition['cityname'],'newcode_list':idList.join(),'output':'json','random':Math.random()};
			//params = SFUtil.objMerge(searchBounds,params);

			var url = filePath + 'op=search';
			if ('װ�ι�˾' == me.desName)
			{
				params.cid = zssearch.cid;
				url = filePath + 'search_zs.php';
			}
			else if ('����' == me.desName)
			{
				params.cid = zssearch.cid;
				url = filePath + 'search_jcc.php';
			}

			var method = 'post';
			var me = this;
			var onComplete = function(origRequest)
			{
				var json = origRequest.responseText;
				try
				{
					var result = eval('(' + json + ')');
					var status = result.status;
					me.markerList = {};
				}
				catch(e)
				{
					alert('ϵͳ���������ԣ�');
					return;
				}
				if(0 == status)
				{
					var allnum = 0;
				}
				else
				{
					var allnum = result.allnum;
				}
				//��������
				if(allnum > 0)
				{
					if(result.hits.hit.newCode) result.hits.hit = [result.hits.hit];
					var hits = result.hits.hit;
					var metaMarkers = me.getMetaMarkers(hits);
					me.showResult(metaMarkers);
				}
			};
			var onFailure = function()
			{
				alert('ϵͳ�������Ժ����ԡ�');
			};
			var xhr = new SFXHR(url, method, params, onComplete, onFailure);
		}
		//$id('map_fav').innerHTML = (''==view) ? '����û���ղ�' : '<table>' + view + '</table>';
		if(''==view)
		{
			SFUI.hideId('haveFav');
			SFUI.showId('noFav');
		}
		else
		{
			SFUI.hideId('noFav');
			if($id('map_fav')) $id('map_fav').innerHTML = '<table>' + view + '</table>';
			SFUI.showId('haveFav');
		}
	},
	//�л�ĳ���ղص���ʾ������
	toggleFav:function(checkbox) {
		var newCode = checkbox.value;
		var detail = this.markerList[newCode];
		var nodeId = 'tip'+newCode;
		var mNode = $id(nodeId);
		if(mNode)
		{
			var domMark = mNode.parentNode;
			var nodeFav = $id('map_fav'+newCode);
			var show = '';
			var titleLink = '';
			//var detail = mNode.provalue;
			//ѡ��ʱ���ӿɵ㣬δѡ��ʱ���ӱ���ͨ�ı�
			if (checkbox.checked) {
				show = 'block';
				//SFUtil.eventAdd(nodeFav, 'click', function() { alert(nodeFav );SFMap.openTipById(newCode);});�������¼�����δ���������� innerHTMl ��
				titleLink = '<a href="javascript:;" onclick="SFMap.openTipById('+newCode+');">'+detail.title+'</a>';
			}
			else {
				show = 'none';
				titleLink = detail.title;
				//SFUtil.eventAdd(nodeFav, 'click', function() { alert(nodeFav ); return false;});
			}
			domMark.style.display = show;
			nodeFav.innerHTML = titleLink;
		}
	},
	condInit:function()
	{
		if (searchcondition.purpose){
			var val = '';
			for (var i=0;i<Purposes.length;i++)
			{
				if (Purposes[i].name == searchcondition.purpose)
				{
					val = Purposes[i].name +','+Purposes[i].index;
					break;
				}
			}
			//alert(val);
			SFUI.setInputA('purposes',val,searchcondition.purpose);
		}
		if (searchcondition.price){
			var pricecondition= '';
			if(searchcondition.price.indexOf('����')>-1)
			{
				pricecondition = "[,"+searchcondition.price.substr(0,searchcondition.price.indexOf('����'))+"]";
			}
			else if(searchcondition.price.indexOf('����')>-1)
			{
				pricecondition = "["+searchcondition.price.substr(0,searchcondition.price.indexOf('����'))+",]";
			}
			else
			{
				var tempprice = searchcondition.price.split("-");
				pricecondition = "["+tempprice[0]+","+tempprice[1]+"]";
			}
			//alert(val);
			SFUI.setInputA('price',pricecondition,searchcondition.price);
		}
		if (searchcondition.district){
			var val = '';
			for (var i=0;i<Districts.length;i++)
			{
				if (Districts[i].name == searchcondition.district)
				{
					val = Districts[i].name +','+Districts[i].index;
					break;
				}
			}
			if (searchcondition.area){
				SFUI.setA('district_a',searchcondition.area);
				SFUI.setInput('district',val);
				SFUI.setInput('area',searchcondition.area);
				SFMap.getCenter(searchcondition.district,searchcondition.area);
			}
			else{
				SFUI.setInputA('district',val,searchcondition.district);
				SFMap.getCenter(searchcondition.district);
			}
		}
		if (searchcondition.round){
			SFUI.setInputA("round",searchcondition.round,searchcondition.round);
		}
		if (!searchcondition.district && !searchcondition.round && searchcondition.subwayname){
			SFUI.setInputA("subway",searchcondition.subwayname,searchcondition.subwayname);
		}
		if (searchcondition.keyword){
			SFUI.setInput('keyword',searchcondition.keyword);
			SFMap.searchKeyword();
		}
	},
	drawSubWay:function(pan)
	{
		//�ж�Ҫ��Ҫ��������Ӧ��
		var pan = pan ? true : false;
		//�Ƿ���վ����Ϣ
		var station = $id('subwaystation').value;
		var real_pan = pan && ('' == station);
		var me = this;
		if(pan)
		{
			me.isDragend = false;
			me.map.clearOverlays();
		}
		//��������·
		if(!$id('subway_a'))
		{
			return;
		}
		var subway = $id('subway').value;
		subway = ('undefined' == typeof subway) ? '' : subway;
		if('' == subway || 'ѡ�����' == subway)
		{
			if(pan)
			{
				//me.map.panTo(cityy,cityx);
				//me.map.setZoom(mapsize);
				me.map.setCenter(cityy,cityx,mapsize);
				me.searchResult();
			}
			return;
		}
		/*if($id('tab3_div1'))
		{
			if($id('tab3_div1').style.display == "none")
			{
				return;
			}
		}*/
		var url = filePath + 'getsubway.php';
		var method = 'post';
		var params = {'subname':subway,'cityid':curCity,'random':Math.random()};
		//����·�ص�
		var showSubWayResult = function(originalRequest)
		{
			//�ȱȿ���ʼ��
			var objxml = originalRequest.responseXML;
			var result = objxml.getElementsByTagName("result")[0];
			if(result != null)
			{
				var status = result.getElementsByTagName("status")[0];
			}
			else
			{
				alert("ϵͳ���������ԣ�");
				return;
			}
			var status = status.firstChild.data;
			if(status == 0)
			{
				return;
			}
			else
			{
				if(result.getElementsByTagName("linexy")[0].firstChild.data)
				{
					var linexy = result.getElementsByTagName("linexy")[0].firstChild.data;
					SFMap.map.drawLine(linexy, real_pan);
					//û�е���վ��Ϣ�����ھͿ���������
					if(real_pan) me.gotosearch();
				}
				else
				{
					me.gotosearch();
					return;
				}
				if(result.getElementsByTagName("siteList")[0].firstChild != null)
				{
					var siteList = result.getElementsByTagName("siteList")[0];
					var sites = siteList.getElementsByTagName("site");
					var len = sites.length;
					var subwayLineSites = new Array();
					for(var i = 0;i<len;i++)
					{
						var site = sites[i].firstChild.data.split(',');
						if(site[0] == station || site[0]+'վ' == station || site[0] == station+'վ')
						{
							//SFMap.map.panTo(site[2],site[1]);
							//me.map.setZoom(mapsize);
							me.map.setCenter(site[2],site[1],mapsize);
							me.searchResult();
							site.center = 1;
						}
						subwayLineSites.push(site);
					}
					SFMap.map.drawSubwayStation(subwayLineSites);
				}
				else
				{
					return;
				}
			}
		};
		var xhr = new SFXHR(url, method, params, showSubWayResult);
	}
};

(function() {
        var ie = ! -[1, ];
        var wk = /webkit\/(\d+)/i.test(navigator.userAgent) && (RegExp.$1 < 525);
        var fn = [];
        var run = function() { for (var i = 0; i < fn.length; i++) fn[i](); };
        var d = document;
        d.ready = function(f) {
            if (!ie && !wk && d.addEventListener)
                return d.addEventListener('DOMContentLoaded', f, false);
            if (fn.push(f) > 1) return;
            if (ie)
                (function() {
                    if (document.readyState=="complete") run();
                    else document.onreadystatechange = function(){ if(document.readyState=="complete") run();}
                })();
            else if (wk)
                var t = setInterval(function() {
                    if (/^(loaded|complete)$/.test(d.readyState))
                        clearInterval(t), run();
                }, 0);
        };
    })();

//SFUtil.eventAdd(window, 'load', function(){
document.ready(function() {
	//��index_header.html��ķŵ�������
	SFMap.condInit();
	SFMapUI.init();
	SFMap.init();
	SearchOther.init();
	var map = SFMap.map;
	//����� GET ������district��keyword������������ JS �����ڱ�ִ��������������������ͳһִ��
	if ((!searchcondition.district) && (!searchcondition.keyword)){
		SFMap.searchResult();
	}
	map.addEvent(map,'moveend',function(){
		//$id('debugger').innerHTML += SFMap.dragSearch+' vs '+SFMap.isDragend+'<br/>';
		SFMap.closeTip();
		SFUI.hideId('subway_station_tip');
		SFMap.toggleDrag(false);
		if(!SFMap.dragSearch || !SFMap.isDragend) return;
		if(null !== SFMap.mapDragTimeOut)
		{
			clearTimeout(SFMap.mapDragTimeOut);
		}
	//	SFMap.mapDragTimeOut = setTimeout(function(){SFMap.searchResult();},500);
	});
	/*map.addEvent(map,MOUSE_CLICK,function(){
		map.enableScrollWheel();
	});*/
	//map.hideMarker();
});

//�رմ���ʱ�ͷ��ڴ�
//SFUtil.eventAdd(window, 'unload', function(){GUnload();});