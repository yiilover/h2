var pricefalg = 0;
var flagstr   = '';
var load_id   = 'load_app';

function initFloat(type, region, showid, btnid)
{
	LoadAppend(btnid);
	var flag = 1;
	var url = '/api.php?op=baojia_ajax';	
	$.ajax({
		type:'GET',
		url:url,		
		dataType:'json',
		data:'region='+region+'&refetime=' + Math.random()*100,
		success:function(list)
		{			
						
			if(list.msg == 'no')
			{
				CloseAppen(1, region, showid, btnid);
			}else if(list.msg == 'null')
			{
				CloseAppen(1, region, showid, btnid);
			}else if(list.msg == 'ok')
			{				
				ShowListAppend(list, showid);
				ChangeBtn(region, showid, btnid);
			}else{
				CloseAppen(1, region, showid, btnid);
			}

		},
		error:function(){
			alert('失败');
			//flag = 0;
			//loadmessage(flag, loadid);
		}
	});
	
}
function ShowListAppend(list, showid)
{	

	var str = '';
	var L = list.content.length;
	for(var i = 1; i < L ; i++)
	{
		
			str += '<li>';
			str += '<span>';
			str += '<h2><a href="'+list.content[i].gid+'/" target="_blank" title="'+list.content[i].subject+'">·'+list.content[i].subject_short+'</a>';
				if(list.content[i].sdurl == 'yes')
				{
					str += '<i><a class="3d" href="'+list.content[i].gid+'/quanjing.html" target="_blank"><img src="/images/3D.png" /></a></i>';	
				}
			str += '</h2>';
			str += '<b>';
				if(list.content[i].price_avr){
					if(list.content[i].price_unit=="2")
					{
						str += list.content[i].price_avr+'元';
					}
					else
					{
						str += list.content[i].price_avr+'元/M<sup>2</sup>';
					}
				}else{
					str += '一房一价';
				}
			str += '</b>';
			/*str += '<em>'+list.content[i].baifenbi+'</em>';*/
			str += '<strong><img src="http://www.venfang.com/statics/css/static/images/';
				if(list.content[i].img){
					str += list.content[i].img;
				}else{
					str += 'line';
				}
			str += '.gif" /></strong></span>';			
			str += '</li>';
		
	}	
	flagstr = str;
	$("#"+showid).append(str);
	//$("#"+showid).html(str);

}

function LoadAppend(btnid)
{
	$("#"+btnid).html('正在装载中...');
}

function ChangeBtn(region, showid, btnid)
{
	$("#"+btnid).html('<div class="pmore" id="'+btnid+'"><a href="javascript:;" onclick="CloseAppen(1, '+region+', \''+showid+'\', \''+btnid+'\');"><img src="http:\/\/www.venfang.com\/statics\/css\/static\/images\/ycmore.png" \/><\/a><\/div>');
}

function CloseAppen(closetype, region, showid, btnid)
{
	if(closetype == 0)
	{
		//关闭
		$("#"+showid).append(flagstr);
		$("#"+btnid).html('<div class="pmore" id="'+btnid+'"><a href="javascript:;"><img src="http:\/\/www.venfang.com\/statics\/css\/static\/images\/ycmore.png" \/><\/a><\/div>');
	}else if(closetype == 1)
	{
		//开启
		$("#"+showid).html('');
		$("#"+btnid).html('<div class="pmore" id="'+btnid+'"><a href="javascript:;" onclick="initFloat(0, '+region+', \''+showid+'\', \''+btnid+'\');"><img src="http:\/\/www.venfang.com\/statics\/css\/static\/images\/more.png" \/><\/a><\/div>');
	}
	
}


function getXmlHttpHeight()
{
	xmlHttpHeight = '';
	try{
		//非ie
		new XMLHttpRequest();
		if(document.body.scrollTop == 0)
		{
			xmlHttpHeight = document.documentElement.scrollTop;
		}else{
			xmlHttpHeight = document.body.scrollTop;
		}
	}catch(e)
	{
		//ie
		xmlHttpHeight = document.documentElement.scrollTop;		
	}
	return xmlHttpHeight;
}

function ChangeMaodian(hashname, h)
{
	var hashname = hashname;
	var h     = h;	
	if(h)
	{
		var obj = $("#"+hashname);	
		var offset = obj.offset();
		var tempHeight = getXmlHttpHeight();
		if(offset.top > h)
		{	
			if(tempHeight < 100){
				scroll(0,offset.top - h -h -10);		
			}else{
				scroll(0,offset.top - h);
			}
		}else{
			scroll(0,offset.top );
		}
	}
}




function DeleteFlash(num,  div)
{
	var j=0;
	for(j = 0; j < num; j++)
	{		
		$("#"+div+j).css({display:'none'});		
		$("#alt_"+div+"_"+j).css({"width":"170px","line-height":"21px","height":"21px","border":"1px solid #FFFFFF","border-right":"none", "background-color":"#ffffff"});
	}
	
}
function ChangeFlash(i, num,  div, thisdiv, classid)
{
	var j=0;
	for(j = 0; j < num; j++)
	{
		if(i == j)
		{
			$("#"+thisdiv).css({display:'block'});
			$("#"+classid+j).css({"position":"relative","top":"1px","float":"left","background-color":"#f9f9f9", "border":"1px solid #cadbf1", "height":"21px", "line-height":"21px", "width":"130px", "border-right":"none"});
		}else{
			$("#"+div+j).css({display:'none'});
			$("#"+classid+j).css({"width":"170px","line-height":"21px","height":"21px","border":"1px solid #FFFFFF","border-right":"none", "background-color":"#ffffff"});
		}
	}
}















var down_s_height;
var down_e_height;
var down_s_width;
var down_e_width;

var up_s_height;
var up_e_height;
var up_s_width;
var up_e_width;

var scroll_height; 



function GetMouseDownXYZ(blockid)
{
	var obj    = $("#"+blockid);
	var offset = obj.offset();

	var width = obj.width(); 
	var height = obj.height(); 

	 down_s_height = offset.top;       //上
	 down_e_height = down_s_height + height;//下

	 down_s_width = offset.left;       //左
	 down_e_width = down_s_width + width;   //右
}

function GetMouseUpXYZ(blockid)
{
	var obj    = $("#"+blockid);
	var offset = obj.offset();

	var width = obj.width(); 
	var height = obj.height(); 

	 up_s_height = offset.top;       //上
	 up_e_height = up_s_height + height;//下

	 up_s_width = offset.left;       //左
	 up_e_width = up_s_width + width;   //右
}




function loadXYZ(e, down,dowmsg, up, upmsg)
{

	/**
	ie下，鼠标位置
	event.clientX
	event.clientY
	火狐需要事件传递
	**/

	var x,y;
	x = e.clientX;
	

	//浏览器判断
	try{
		//非ie
		new XMLHttpRequest();
		scroll_height = document.body.scrollTop;
		y = e.pageY;		
	}catch(e)
	{		
		scroll_height = document.documentElement.scrollTop;
		y = e.clientY;		
		y = y + scroll_height;
	}

	GetMouseDownXYZ(dowmsg);
	GetMouseUpXYZ(upmsg);


	if( x < down_s_width  || x > down_e_width)
	{		
		DeleteFlash(10,down);
		
	}
	if(y < down_s_height  || y > down_e_height)
	{
		DeleteFlash(10,down);		
	}


	if( x < up_s_width  || x > up_e_width)
	{		
		DeleteFlash(10,up);		
	}
	if(y < up_s_height  || y > up_e_height)
	{
		DeleteFlash(10,up);
	}
	//document.getElementById("myarea").innerHTML=event.clientX +" , "+event.clientY;
}


 