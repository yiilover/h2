var sqlArray=new Array("","","","","");		//����������ɵĲ�ѯ����

/////////////////////////////////////////////
///removeSql���Ƴ�ָ��������
///index:����������,���磺0:��ҵ��1�ܼ�....
/////////////////////////////////////////////
function removeSql(index){
	sqlArray[index] = "";
}
/////////////////////////////
///clearSql��������е�����
/////////////////////////////
function clearSql(){
	for(var i = 0;i < sqlArray.length;i++){
		sqlArray[i]	 = "";
	}
}

/////////////////////////
///addSql�����ָ��������
///value:ָ��������ֵ
/////////////////////////
function addSql(index,value){
	//removeSql(index);
	sqlArray[index] = value;
	if(index == 1){
		loadRegion();
	}
	if(index == 2){
		loadBusiArea();
	}
	if(index == 4){
		loadHouseView();
	}
}

//////////////////////////////////////////
///loadBusiArea:����ǰ��ѡ�����������������
//////////////////////////////////////////
function loadRegion(){
	$(".b3 ul").html('<span>���ڼ��ء�������</span>');
	var url = "api.php?op=getBusiArea&top=1";
	var params = {"AreaID":sqlArray[2]};
	$.post(url,params,function(data){
		if(data.Rows.length > 0){
			var html = "";
			for(var i = 0;i < data.Rows.length;i++){
				html += '<li><a href="javascript:addSql(2,'+data.Rows[i].BusiAreaID+');">'+data.Rows[i].BusiName+'</a></li>';
			}
			$(".b3 ul").html(html);
		}else{
			$(".b3 ul").html("<span>��ǰϵͳû�а��</span>");
		}
	},'json');
}

//////////////////////////////////////////
///loadBusiArea:����ǰ��ѡ�����������������
//////////////////////////////////////////
function loadBusiArea(){
	if(sqlArray[2] == ""){
		$(".b5 ul").html('<span>���û��ѡ��λ����û�а��</span>');
		return;
	}
	$(".b5 ul").html('<span>���ڼ��ء�������</span>');
	var url = "api.php?op=getBusiArea";
	var params = {"AreaID":sqlArray[2]};
	$.post(url,params,function(data){
		if(data.Rows.length > 0){
			var html = "";
			for(var i = 0;i < data.Rows.length;i++){
				html += '<li><a href="javascript:addSql(3,'+data.Rows[i].BusiAreaID+');">'+data.Rows[i].BusiName+'</a></li>';
			}
			$(".b5 ul").html(html);
		}else{
			$(".b5 ul").html("<span>��ѡ��ķ�λ��û�а��</span>");
		}
	},'json');
}

function loadHouseView(){
	$("#buildList").html("");
	$("#prompt").html("���ڲ���¥�̣����Ե�......");
	var url = "api.php?op=getHouseViewListByOne";
	var params = new Array();
	params.push({"name":"start","value":1});
	params.push({"name":"limit","value":15});
	for(var i=0;i < sqlArray.length;i++){
		if(sqlArray[i] != ""){
			params.push({"name":"item_"+i,"value":sqlArray[i]});
		}
	}
	var character="";
	if(sqlArray[4])
	{
		if(sqlArray[4]=='7')
		{
			character='������';
		}
		if(sqlArray[4]=='4')
		{
			character='ѧ����';
		}
		if(sqlArray[4]=='5')
		{
			character='���εز�';
		}
		if(sqlArray[4]=='6')
		{
			character='Ͷ�ʵز�';
		}
		if(sqlArray[4]=='9')
		{
			character='�˾ӵز�';
		}
		if(sqlArray[4]=='8')
		{
			character='���÷�';
		}
		if(sqlArray[4]=='3')
		{
			character='��԰';
		}
	}
	$.post(url,params,function(data){
		if(data.Rows.length > 0){
			if(data.Rows.length==15)
			{
				$("#prompt").html("����ֻ��ʾ������������ǰ15��¥�̣����˽����¥�̣���������¥��");
			}
			else
			{
				$("#prompt").html("��������Ҫ���ҵ���"+data.Rows.length+"��¥�̣����˽����¥�̣����Գ�����������");
			}
			var html = "";
			var housestr = '';
			for(var i = 0;i < data.Rows.length;i++){
				if(i<12)
				{
					housestr+= '@'+data.Rows[i].BuildingName+' ';
				}
				html +='<li><a href="'+data.Rows[i].BuildingUrl+'/" target="_blank" class="img">';
				if(data.Rows[i].BuildDefaultPic != ""){
					html += '<img src="'+data.Rows[i].BuildDefaultPic+'"/>';
				}else{
					html +='<img src="/statics/default/img/index/nopic.jpg"/>';
				}
				html +='</a><h2><a href="'+data.Rows[i].BuildingUrl+'/" target="_blank">'+data.Rows[i].BuildingName+'</a></h2>���ۣ�';
				if(data.Rows[i].AvgPrice > 0){
					html += data.Rows[i].AvgPrice+ data.Rows[i].AvgPriceUnit;
				}else{
					html += '����';
				}
			    html +='<p>��ַ��'+data.Rows[i].Address+'</p><a href="'+data.Rows[i].BuildingUrl+'/" class="detail" target="_blank">¥������</a>&nbsp;<a href="'+data.Rows[i].BuildingUrl+'/peitao.html" class="gomap" target="_blank">�鿴��ͼ</a></li>';
			}
			$("#share").html("<a href=\"javascript:void(0)\" onclick=\"var _t = encodeURI('�Ҹո���ʹ����һ�����ҷ����ܣ��ҵ���"+character+"¥�̣�"+housestr+"');var _url = encodeURIComponent(document.location);var _appkey = encodeURI('1266317589');var _ralateUid=encodeURI('');var _pic = encodeURI('"+data.Rows[0].BuildDefaultPic+"');var _site = '';var _u = 'http://v.t.sina.com.cn/share/share.php?url='+_url+'&appkey='+_appkey+'&ralateUid='+_ralateUid+'&site='+_site+'&pic='+_pic+'&title='+_t;window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );\" title=\"��������΢��\"><img src=\"http://www.venfang.com/images/sina.gif\" title=\"��������΢��\" border=\"0\" style=\"margin-top:10px;\"/></a>");
			$("#buildList").html(html);
			$.slideView.init({panelWrapper:'panelWrapper', prevButton:'prevButton', prevMore:'prevMore', nextButton:'nextButton', nextMore:'nextMore', img:'.img'});//�ֲ�
		}else{
			$("#prompt").html("");
			$("#buildList").html("û���ҵ�����������¥�̣��������ʵ��ſ���������");
		}
	},'json')
}





