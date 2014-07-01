//收藏夹
function addBookmark(title,url) {
	try{
           window.external.addFavorite(url, title);			  
        }
        catch (e){
            try{
                window.sidebar.addPanel(title, url, "");
            }
            catch (e){				
                alert("加入收藏失败，请使用Ctrl+D进行添加");
            }
        }
}


//复制
function copysiteurl(title, txt) {   
     if(window.clipboardData) {   
             window.clipboardData.clearData();   
             window.clipboardData.setData("Text", txt);   
			 alert('已复制 '+title+' 楼盘链接地址，可发送给您的朋友');
     } else if(navigator.userAgent.indexOf("Opera") != -1) {   
          window.location = txt;   
     } else if (window.netscape) {   
          try {   
               netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");   
          } catch (e) {   
               alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");   
          }   
          var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);   
          if (!clip)   
               return;   
          var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);   
          if (!trans)   
               return;   
          trans.addDataFlavor('text/unicode');   
          var str = new Object();   
          var len = new Object();   
          var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);   
          var copytext = txt;   
          str.data = copytext;   
          trans.setTransferData("text/unicode",str,copytext.length*2);   
          var clipid = Components.interfaces.nsIClipboard;   
          if (!clip)   
               return false;   
          clip.setData(trans,null,clipid.kGlobalClipboard);   
          alert('已复制 '+title+' 楼盘链接地址，可发送给您的朋友');
     }   
} 



function deltr(tdid,tableid){
        var delID = document.getElementById(tdid);
        var target_=delID.cellIndex;
        var table = document.getElementById(tableid);
        var len = table.rows.length;
		//var tagslen = document.getElementsByName('delID').length;	
		var tagslen = del_getnum('td', 'delID');		
		if(tagslen > 2){
			for(var i = 0;i < len;i++){			
				table.rows[i].deleteCell(target_);
			}
		}else{
			alert('抱歉，至少选择2个以上的楼盘进行比较！');
		}		
}

function del_getnum(tags, name){
	var etags = document.getElementsByTagName(tags);
	var ename = document.getElementsByName(name);
	if(ename.length > 0) return ename.length;
	var templeng  = 0;
	for(var i = 0; i < etags.length; i++){
		if(etags[i].getAttribute('name') == name ){
			templeng = templeng + 1;
		}
	}
	return templeng;
}

//spacecomment
function startscroll_zhuye(num,s,item,div)
{
var s = s;
var n = num;
var o = document.getElementById(div);
var item = item;
var temp;
var tempitem;
var step;
var lh = 22;
o.style.marginTop = 0;
//o.innerHTML+=o.innerHTML;

function get_html(tags, name){
	var etags = document.getElementsByTagName(tags);	
	var templeng  = '';
	for(var i = 0; i < etags.length; i++){
		if(etags[i].getAttribute('id') == (name+i) ){
			templeng += '<div class="rig_b_a" id="item'+i+'">'+document.getElementById(name+i).innerHTML+'</div>';
		}
	}
	return templeng;
} 
function start(){
	
	step = getstep();	
	tempitem = item+step;		
	//h = getitemheight(tempitem);	
	t=setInterval(scrolling,s);	
	temp = '<div class="rig_b_a" id="item'+step+'">'+document.getElementById(tempitem).innerHTML+'</div>';	
	o.innerHTML+=temp;		
	var d2=document.getElementById('item'+step); 
	o.removeChild(d2); 		
}
 
function scrolling(){	
	clearInterval(t);
	setTimeout(start,s);			
}
 
function getitemheight(items){	
	var L = document.getElementById(items).clientHeight;
	return L;
}
 
function getstep(){	
	if(step < n ){
		step = step + 1;
	}else if(step == n){
		step = 0;
	}else{
		step = 0;
	}	
	return step;
}
setTimeout(start,s);
 
}
//getLinemore
function getLinemore(msgid,action,id1,id2){
	var getck = houselistGetCookie('houselist');
	if(action == 'show'){	
		houselistSetCookie('houselist');
		document.getElementById(msgid).style.display = 'block';					
	}else if(action == 'hidden'){		
		houselistClearCookie('houselist');
		document.getElementById(msgid).style.display = 'none';		
	}else if(action == 'loading'){			
		if(getck == 'houselist' || getck == 'houselisthouselist'){
			//alert(action);
			document.getElementById(msgid).style.display = 'block';	
			document.getElementById(id1).style.display = 'none';
			document.getElementById(id2).style.display = 'block';			
		}
		
		return true;
		//alert(action);
	}
	document.getElementById(id1).style.display = 'none';
	document.getElementById(id2).style.display = 'block';
	//alert(getck);
}
function houselistSetCookie(name){
	document.cookie = name + '=' + escape(name) ;
}
function houselistGetCookie(name){
	/*var temparr = document.cookie;
	var strarr  = temparr.split(';');
	var onearr  = strarr[0].split('=');
	var strone  = onearr[0];
	return strone;
	*/
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	if (arr != null){
		return unescape(arr[2]);
	}
	return null;

}
function houselistClearCookie(name){
	if(houselistGetCookie(name)){		
		 document.cookie = name + "=" + ";expires=Fri, 02-Jan-1970 00:00:00 GMT";
	}
}

// 提交团购，问题
function postquest(type,obj){
	var obj = obj;
	var type = type;
	var errmsg = '';	
	if(type == 'tuangou'){
		var realname = obj.realname.value;
		var mobile = obj.mobile.value;		
		if(realname.length < 2){
			errmsg = '请输入您的称谓！';
		}
		if (mobile.length < 11){
			errmsg = '请您正确填写您的手机号码！';			
		}		
	}	
	if(type == 'ask'){		
		var askcon = obj.askcon.value;
		var askname = obj.askname.value;
		var reg = /^\s*[\u4e00-\u9fa5]{1,}[\u4e00-\u9fa5.·]{0,15}[\u4e00-\u9fa5]{1,}\s*$/;
		
		 if(!reg.test(askname))
		{
			errmsg = '请输入您的中文姓名！';
			alert(errmsg);
			return false;
		}
		var asktel = obj.asktel.value;
		var reg2=/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3|4|5|8][0-9]{9}$)/; 
		if(!reg2.test(asktel)){
			errmsg = '请检查您输入的电话号码。';
			alert(errmsg);
			return false;
		}
		if(askcon.length < 6){
			errmsg = '您的问题太过于简单了或者问题不能为空。';
			alert(errmsg);
			return false;
		}
	}	
}
//houselist排序
function gethouselistnumeber(id, action, seofilename, filename, seourl ,weburl){
	var weburl = weburl;
	if(seourl == 1){
		if(id == 0){
			window.location.href = weburl + seofilename + '.html';
		}else{
			window.location.href = weburl + seofilename + '-n' + id + '.html';
		}
	}else{
		if(id == 0){
			window.location.href = weburl + filename + '.php';
		}else{
			window.location.href = weburl + filename + '.php?' + action + '=' + id;
		}
	}
}
