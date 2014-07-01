
var FBrowser=(function(){var ua=navigator.userAgent;var isOpera=Object.prototype.toString.call(window.opera)=='[object Opera]';return{isIE:!!window.attachEvent&&!isOpera,isOpera:isOpera,isSafari:ua.indexOf('AppleWebKit/')>-1,isFirefox:ua.indexOf('Gecko')>-1&&ua.indexOf('KHTML')===-1,MobileSafari:/Apple.*Mobile.*Safari/.test(ua),isChrome:!!window.chrome};})();FBrowser.isIE6=FBrowser.isIE&&!window.XMLHttpRequest;FBrowser.isIE7=FBrowser.isIE&&!!window.XMLHttpRequest;String.prototype.lTrim=function(){return this.replace(/^\s*/,"");}
String.prototype.rTrim=function(){return this.replace(/\s*$/,"");}
String.prototype.trim=function(){return this.rTrim().lTrim();}
String.prototype.hasChinese=function(){return/[^\u00-\uff]/g.test(this);}
String.prototype.onlyChinese=function(){return/^[\u0391-\uffe5]+$/g.test(this);}
String.prototype.hash_filter=function(){return this.replace(/[^a-f0-9]/gi,'');}
String.prototype.bytes=function()
{return this.replace(/[^\x00-\xff]/gi,'xx').length;}
function Fstr_pad(s,n,pad)
{if(s.length>=n)return s;var p=n-s.length;for(var i=0;i<p;i++)
s=pad+''+s;return s;}
function Farray_exist(d,v)
{for(var i=0;i<d.length;i++)
{if(d[i]==v)return true;}
return false;}
window.clearRunInterval=window.clearInterval;window.clearRunTimeout=window.clearTimeout;function Fid(id)
{return document.getElementById(id);}
function Fname(name)
{if(document.all){var ret=[];var els=document.all(name);for(var i=0;i<els.length;i++){var el=els[i];if(el.getAttribute("name")==name){ret.push(el);}}
return ret;}
return document.getElementsByName(name);}
function FtagName(name)
{return document.getElementsByTagName(name);}
function Fempty(v){if(v!=null&&(typeof(v)=='object'||typeof(v)=='function'))return false;return((""==v||undefined==v||null==v)?true:false);}
function FisTagName(e,tagName)
{return((e.tagName.toUpperCase()==tagName.toUpperCase())?true:false);}
function FstrLeft(s,n)
{var s2=s.slice(0,n),i=s2.bytes();if(i<=n)return s2;i-=s2.length;switch(i)
{case 0:return s2;case n:return s.slice(0,n>>1);default:var k=n-i,s3=s.slice(k,n),j=s3.replace(/[\x00-\xff]/g,"").length;return j?s.slice(0,k)+FstrLeft(s3,j):s.slice(0,k);}}
window.setRunTimeout=function(fn,dt)
{if(typeof(fn)!='function')return false;var p=new Array();if(arguments.length>2)
{for(var i=2;i<arguments.length;i++)p[i-2]=arguments[i];}
var f=function(){fn.apply(null,p)}
return window.setTimeout(f,dt);}
window.setRunInterval=function(fn,dt)
{if(typeof(fn)!='function')return false;var p=new Array();if(arguments.length>2)
{for(var i=2;i<arguments.length;i++)p[i-2]=arguments[i];}
var f=function(){fn.apply(null,p)}
return window.setInterval(f,dt);}
function FgetURLArgs()
{var q=location.search.substring(1).replace("&amp;","&").split("&");var p=new Object();for(var i=0;i<q.length;i++)
{var pos=q[i].indexOf('=');if(-1==pos)continue;p[q[i].substring(0,pos)]=unescape(q[i].substring(pos+1));}
return p;}
var Cookie={setCookie:function(name,value,expires,path,domain,secure)
{if(window._testing)domain=location.host;document.cookie=name+"="+escape(value)+
((expires)?"; expires="+expires.toGMTString():"")+
((path)?"; path="+path:"; path=/")+
((domain)?"; domain="+domain:"; domain=www.venfang.com")+
((secure)?"; secure":"");},getCookie:function(name)
{var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));if(arr!=null)
{return unescape(arr[2]);}
return null;},clearCookie:function(name,path,domain)
{if(Cookie.getCookie(name))
{if(window._testing)domain=location.host;document.cookie=name+"="+
((path)?"; path="+path:"; path=/")+
((domain)?"; domain="+domain:"; domain=www.venfang.com")+";expires=Fri, 02-Jan-1970 00:00:00 GMT";}},clearAnyway:function(name,path,domain)
{document.cookie=name+"="+
((path)?"; path="+path:"; path=/")+
((domain)?"; domain="+domain:"; domain=www.venfang.com")+";expires=Fri, 02-Jan-1970 00:00:00 GMT";}};function FgetEventTarget(evt)
{return evt.target||evt.srcElement;}
function FgetEvent(evt)
{if(!evt){var ev=window.event;if(!ev)
{var c=this.getEvent.caller;while(c){evt=c.arguments[0];if(evt&&Event==evt.constructor){break;}
c=c.caller;}}else
{return ev;}}
return evt;}
function FisLeftKeyDown(evt)
{evt=evt||window.event;return(((evt.which)&&(evt.which==1))||((evt.button)&&(evt.button==1)));}
function FactClick(obj)
{if(Fempty(obj))return;if(document.all)
{obj.click();}else
{var evt=document.createEvent("MouseEvents");evt.initEvent("click",true,true);obj.dispatchEvent(evt);}}
function FaddEvent(e,evt,fn,isID)
{if(isID==true)e=Fid(e);if(!Fempty(e.attachEvent)&&(typeof(e.attachEvent)=="function"||typeof(e.attachEvent)=="object"))
e.attachEvent("on"+evt,fn);else if(!Fempty(e.addEventListener)&&(typeof(e.addEventListener)=="function"||typeof(e.addEventListener)=="object"))
e.addEventListener(evt,fn,false);}
function FremoveEvent(e,evt,fun,isID)
{if(isID==true)e=Fid(e);if(!Fempty(e.detachEvent)&&(typeof(e.detachEvent)=="function"||typeof(e.detachEvent)=="object"))
e.detachEvent("on"+evt,fun);else if(!Fempty(e.removeEventListener)&&(typeof(e.removeEventListener)=="function"||typeof(e.removeEventListener)=="object"))
e.removeEventListener(evt,fun,false);}
function FstopEventTransfer(evt)
{if(evt.preventDefault){evt.stopPropagation();evt.preventDefault();}else{evt.returnValue=false;evt.cancelBubble=true;}}
function FstopObjectEventTransfer(e,evts)
{if(Fempty(e)||Fempty(evts))return;var l=evts.split(",");for(var i=0;i<l.length;i++)
{var evt=l[i].trim();if(Fempty(evt))continue;var fn=function(event){event=FgetEvent(event);FstopEventTransfer(event);}
FaddEvent(e,evt,fn);}}
function FsetEventCapture(target)
{if(target.setCapture)
{target.setCapture();}else
{if(!FBrowser.isFirefox&&document.captureEvents)
{document.captureEvents(Event.MouseMove|Event.MouseUp);}}}
function FreleaseEventCapture(target)
{if(target.releaseCapture)
{target.releaseCapture();}else
{if(!FBrowser.isFirefox&&document.releaseEvents)
{document.releaseEvents(Event.MouseMove|Event.MouseUp);}}}
function FgetWindowSize()
{if(FBrowser.isIE6||FBrowser.isOpera)
return{width:document.body.clientWidth,height:document.documentElement.clientHeight||document.body.clientHeight||0};else
return{width:document.documentElement.clientWidth,height:document.documentElement.clientHeight};}
function FgetPageSize()
{if(FBrowser.isIE6)
return{width:document.body.scrollWidth,height:document.body.scrollHeight};if(document.documentElement)
return{width:document.documentElement.scrollWidth,height:document.documentElement.scrollHeight};else
return{width:document.body.scrollWidth,height:document.body.scrollHeight};}
function FgetScrollPosition()
{if(FBrowser.isIE6)
return{left:document.body.scrollLeft,top:document.body.scrollTop||document.documentElement.scrollTop};if(document.documentElement)
{return{left:document.documentElement.scrollLeft,top:document.body.scrollTop||document.documentElement.scrollTop};}
else
return{left:document.body.scrollLeft,top:document.body.scrollTop};}
function FgetPosition(e,isID)
{if(isID==true)e=Fid(e);var left=0,top=0,w=e.offsetWidth,h=e.offsetHeight;do{top+=e.offsetTop||0;left+=e.offsetLeft||0;e=e.offsetParent;}while(e);return{x:left,y:top,width:w,height:h};}
function FsetPosition(e,x,y,w,h,isID){if(isID==true)e=Fid(e);if(e.style.position=="absolute")
{e.style.left=x+"px";e.style.top=y+"px";}else if(e.style.position=="relative")
{var p=FgetPosition(e.offsetParent);e.style.left=(x-p.x)+"px";e.style.top=(y-p.y)+"px";}
if(w>=0)e.style.width=w+"px";if(h>=0)e.style.height=h+"px";}
function FgetOffsetPosition(e1,e2)
{var p1=FgetPosition(e1);var p2=FgetPosition(e2);return{x:(p1.x-p2.x),y:(p1.y-p2.y)};}
function FsetOffsetPosition(e1,e2,x,y,isID)
{if(isID==true){e1=Fid(e1);e2=Fid(e2);}
var p=FgetPosition(e2);FsetPosition(e1,x+p.x,y+p.y);}
function FsetOffsetPositionByRate(e1,e2,nx,ny,isID)
{if(isID==true){e1=Fid(e1);e2=Fid(e2);}
var s1=FgetPosition(e1);var s2=FgetPosition(e2);FsetPosition(e1,(s2.x+(s2.width-s1.width)/nx),(s2.y+(s2.height-s1.height)/ny),-1,-1);}
function FsetOffsetWindowPosition(e,x,y,isID)
{if(isID==true)e=Fid(e);var p=FgetScrollPosition();FsetPosition(e,x+p.left,y+p.top,-1,-1);}
function FsetOffsetWindowPositionByRate(e,nx,ny,isID)
{if(isID==true)e=Fid(e);var s=FgetWindowSize();FsetOffsetWindowPosition(e,(s.width-e.offsetWidth)/nx,(s.height-e.offsetHeight)/ny);}
function FgetAttr(e,name,isID)
{if(isID==true)e=Fid(e);return e.getAttribute(name);}
function array_search(arr,sw)
{for(var i=0;i<arr.length;i++)
{if(arr[i]==sw)
{return i;}}
return-1;}
function array_remove(arr,dx)
{if(isNaN(dx)||dx>arr.length){return arr;}
arr.splice(dx,1);return arr;}
function FremoveElement(eid)
{var e=Fid(eid);if(e)
{e.parentNode.removeChild(e);}}
var FObjId=function(s)
{return(typeof s=="object")?s:document.getElementById(s);};var FJsLoader={load:function(sId,sUrl,fCallback,chset)
{try
{FObjId(sId).parentNode.removeChild(FObjId(sId));}catch(e){}
var _script=document.createElement("script");_script.setAttribute("id",sId);_script.setAttribute("type","text/javascript");_script.setAttribute("src",sUrl);if(chset)
_script.setAttribute("charset",chset);else
_script.setAttribute("charset","gb2312");document.getElementsByTagName("head")[0].appendChild(_script);if(FBrowser.isIE)
{_script.onreadystatechange=function()
{if(this.readyState=="loaded"||this.readyState=="complete")
{try
{FObjId(_script).parentNode.removeChild(FObjId(_script));}catch(e){}
fCallback();}};}else if(FBrowser.isFirefox||FBrowser.isSafari||FBrowser.isOpera||FBrowser.isChrome)
{_script.onload=function()
{try
{FObjId(_script).parentNode.removeChild(FObjId(_script));}catch(e){}
fCallback();};}
else
{try
{FObjId(_script).parentNode.removeChild(FObjId(_script));}catch(e){}
fCallback();}}};function FCookieFrame(idPrefix,src,fun)
{this._cf=document.createElement("iframe");this._cf.id=idPrefix+"_cookie_frame";this._cf.name=idPrefix+"_cookie_frame";this._cf.style.display="none";document.getElementsByTagName("body")[0].appendChild(this._cf);this._cf.src=src;if(typeof fun=="function")
{FaddEvent(this._cf,'load',fun);}}
FCookieFrame.prototype.getCookie=function(name)
{try
{return this._cf.contentWindow.g(name);}catch(e){return null;}}
FCookieFrame.prototype.clearCookie=function(name,path,domain)
{if(this.getCookie(name))
{document.cookie=name+"="+
((path)?"; path="+path:"; path=/")+
((domain)?"; domain="+domain:"; domain=www.venfang.com")+";expires=Fri, 02-Jan-1970 00:00:00 GMT";}}
var PTLOGIN2_AID='638009104';function FvalidateUin(uin)
{var R=/^[1-9]\d{4,11}$/;return R.test(uin);}
function FgetUin()
{if(!Cookie.getCookie("uin"))
{return false;}
var uin_str=Cookie.getCookie("uin");var uin=parseInt(uin_str.substr(1,(uin_str.length-1)),10);if(FvalidateUin(uin))return uin;return false;}
function Flogout()
{Cookie.clearCookie('uin','/','venfang.com');Cookie.clearCookie('luin','/','venfang.com');Cookie.clearCookie('skey','/','venfang.com');Cookie.clearCookie('lskey','/','venfang.com');}
function FisLogon()
{if(Cookie.getCookie("skey"))
{return true;}
return false;}
function FInputOnFocus(obj)
{obj.style.color="#333";if(obj.value==obj.defaultValue)
{obj.value="";}}
function FInputOnBlur(obj)
{if(obj.value=="")
{obj.value=obj.defaultValue;obj.style.color="#666";}}
function scrollWord(id,speed,pagewidth,space,movespeed){var tiaoflag=null;var marflag=null;var ctp=gg(id);var ct1=ce('div');var ctc1=ce('div');var ctc2=ce('div');var yushu=pagewidth%space;var movespace=0;ctc1.innerHTML=ctc2.innerHTML=ctp.innerHTML;ctp.innerHTML="";ct1.appendChild(ctc1);ct1.appendChild(ctc2);ctp.appendChild(ct1);ct1.style.height="8888px";function marquee(){if(movespace<pagewidth){movespace+=space;ctp.scrollTop+=space;}else{if(yushu!=0)
ctp.scrollTop-=(space-yushu);clearInterval(marflag);marflag=null;}}
function tiaozhuang(){if(marflag==null){if(ctp.scrollTop>=ctc1.offsetHeight){ctp.scrollTop=0;}
movespace=0;marflag=setInterval(marquee,movespeed);}}
tiaoflag=setInterval(tiaozhuang,speed);ctp.onmouseover=function(){clearInterval(tiaoflag);}
ctp.onmouseout=function(){tiaoflag=setInterval(tiaozhuang,speed);}
function gg(id){return document.getElementById(id);}
function ce(tagname){return document.createElement(tagname);}}
scrollWord('bmList',2000,48,3,40);float_layer_ie6_bugfix();window.onload=function(){kft_gb_route_signup_success_close();kft_gb_route_signup_dup_close();kft_gb_house_attention_success_close();kft_gb_house_collect_dup_close();kft_close_mask();var ids=getChipId(1);var idstr=ids.join('|');FId('KFTFocusHouseIds').value=idstr;var ids=getChipId(2);var idstr=ids.join('|');FId('KFTSGCommendHouseIds').value=idstr;var ids=getChipId(3);var idstr=ids.join('|');FId('KFTSGAttentionHouseIds').value=idstr;bindOnclick(1);bindOnclick(2);bindOnclick(3);refresh_focus_house_gb_num();var XFDStrIds=FId('KFTUsrXFDIds').value;var GBHouseStrIds=FId('KFTUsrGBIds').value;var XFDIds=XFDStrIds.split('|').eachToNum();var GBHouseIds=GBHouseStrIds.split('|').eachToNum();focusIcons(0,GBHouseIds);collectIcons(0,XFDIds);groupIcons(0,GBHouseIds);favoriteIcons(0,GBHouseIds);kftSearchObj.init();}
var ____configArray;function __initDropDownList(configArray){____configArray=configArray;var existArray=configArray.split("|");for(var i=0;i<existArray.length;i++){if(existArray[i].length<1){return;}
var parentContainer=document.getElementById(existArray[i]);if(!parentContainer){return;}
var selectObj=parentContainer.getElementsByTagName("select");if(selectObj.length<1){return;}
var optionArray=selectObj[0].getElementsByTagName("option");var optionLength=optionArray.length;for(var j=0;j<optionLength;j++){var ulObj=parentContainer.getElementsByTagName("ul");if(ulObj.length<1){return;}
var spanObj=parentContainer.getElementsByTagName("span");if(spanObj.length<1){return;}
var liObj=document.createElement("li");var textNode=document.createTextNode(optionArray[j].firstChild.nodeValue);liObj.appendChild(textNode);liObj.setAttribute("currentIndex",j);liObj.onclick=function(){selectCurrentItem(this.parentNode,this);}
liObj.onmouseover=function(){this.className="over";}
liObj.onmouseout=function(){this.className="";}
ulObj[0].appendChild(liObj);spanObj[0].onclick=function(event){showHiddenUl(this);}
spanObj[0].onmouseover=function(){this.className='over';}
spanObj[0].onmouseout=function(){this.className="";};ulObj[0].onclick=function(){this.className="";}}
parentContainer.onclick=function(event){if(!event){event=window.event;}
event.cancelBubble=true;var eventUlObj=this.getElementsByTagName("ul")[0];bodyClickHiddenUl(eventUlObj);}}}
function selectCurrentItem(ulObj,currentObj){var parentObj=ulObj.parentNode;var spanObj=parentObj.getElementsByTagName("span")[0];spanObj.firstChild.nodeValue=currentObj.firstChild.nodeValue;var selectObj=parentObj.getElementsByTagName("select")[0];selectObj.selectedIndex=parseInt(currentObj.getAttribute("currentIndex"));if(selectObj.fireEvent){selectObj.fireEvent("onchange");}else{var evt=document.createEvent('HTMLEvents');evt.initEvent('change',true,true);selectObj.dispatchEvent(evt);}}
function showHiddenUl(currentObj){var parentNode=currentObj.parentNode;var ulObj=parentNode.getElementsByTagName("ul")[0];if(ulObj.className==""){ulObj.className="show";}else{ulObj.className="";}}
function addBodyClick(func){var bodyObj=document.getElementsByTagName("body")[0];var oldBodyClick=bodyObj.onclick;if(typeof bodyObj.onclick!='function'){bodyObj.onclick=func;}else{bodyObj.onclick=function(){oldBodyClick();func();}}}
function bodyClickHiddenUl(eventUlObj){var existArray=____configArray.split("|");for(var i=0;i<existArray.length;i++){if(existArray[i].length<1){return;}
var parentContainer=document.getElementById(existArray[i]);if(!parentContainer){return;}
var ulObj=parentContainer.getElementsByTagName("ul");if(eventUlObj!=ulObj[0]){ulObj[0].className="";}}}
var __dropDownList="dropDownList1|dropDownList2|dropDownList3|dropDownList4|dropDownList5|dropDownList6|dropDownList7|dropDownList8|dropDownList9";__initDropDownList(__dropDownList);addBodyClick(bodyClickHiddenUl);function G(s){return document.getElementById(s);}
function getStyle(obj,attr){if(obj.currentStyle){return obj.currentStyle[attr];}else{return getComputedStyle(obj,false)[attr];}}
function Animate(obj,json){obj.timer=setInterval(function(){for(var attr in json){var iCur=parseInt(getStyle(obj,attr));iCur=iCur?iCur:0;var iSpeed=(json[attr]-iCur)/5;iSpeed=iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);obj.style[attr]=iCur+iSpeed+'px';if(iCur==json[attr]){clearInterval(obj.timer);}}},30);}
function buildPage(btnId,conId,conEle){var con=G(conId);var cUl=con.getElementsByTagName(conEle);var len=cUl.length;con.style.width=714*len+"px";var btn=G(btnId);var bUl=btn.getElementsByTagName("ul")[0];var html=""
for(var i=0;i<len;i++){html+="<li>"+i+"</li>"}
bUl.innerHTML=html;var prev=getByClass(btn,"prevBtn")[0];var next=getByClass(btn,"nextBtn")[0];var temp=0;var w=714;var bLi=bUl.getElementsByTagName("li");function Change(temp){if(!con.timer){Animate(con,{left:-(temp*w)});}else{clearInterval(con.timer);Animate(con,{left:-(temp*w)});}
for(var i=0;i<len;i++){bLi[i].className="";if(temp==i){bLi[i].className="on";}}}
Change(temp);prev.onclick=function(){temp--;temp=temp>-1?temp:len-1;Change(temp);}
next.onclick=function(){temp++;temp=temp<len?temp:0;Change(temp);}
for(var i=0;i<len;i++){bLi[i].index=i;bLi[i].onclick=function(){temp=this.index;Change(temp);}}}
buildPage("page2","pageList2","ul");function setImg(dom,tagName){var img=dom.getElementsByTagName(tagName)[0];var srcurl=img.getAttribute("_src");if(srcurl){img.src=srcurl;img.removeAttribute('_src');}}
function isMouseLeave(evt,element){if(evt.type!='mouseout'&&evt.type!='mouseover')return false;var target=evt.relatedTarget?evt.relatedTarget:evt.toElement;while(target&&target!=element){target=target.parentNode;}
return(target!=element);}
var mainList=G("mainList");if(mainList!=null){var iconDot=getByClass(mainList,"iconDot");for(var i=0,len=iconDot.length;i<len;i++){iconDot[i].onmouseover=function(e){this.className="iconDot icons current";setImg(this,"img");}
iconDot[i].onmouseout=function(e){e=arguments[0]||window.event;if(isMouseLeave(e,this)){this.className="iconDot icons";}}}}
function resListHover(obj){var resList=G(obj);var resItem=getByClass(resList,"item");for(var i=0,len=resItem.length;i<len;i++){resItem[i].onmouseover=function(e){this.className="item hover";}
resItem[i].onmouseout=function(e){e=e||window.event;if(isMouseLeave(e,this)){this.className="item";}}}}
resListHover("resList");var yhFlag=null;var time_flag=null;var yhMod=G("yhMod");var yhItem=getByClass(yhMod,"rankItem");for(var i=0,len1=yhItem.length;i<len1;i++){yhItem[i].onmouseover=function(){yhFlag=this;(function(dom){time_flag=setTimeout(function(){if(yhFlag!=dom)
return;for(var j=0;j<len1;j++){yhItem[j].className="rankItem";}
dom.className="rankItem current";setImg(dom,"img");clearTimeout(time_flag);time_flag=null;},100);})(this);}}
var kpFlag=null;var kpMod=G("kpMod");var kpItem=getByClass(kpMod,"rankItem");for(var i=0,len=kpItem.length;i<len;i++){kpItem[i].onmouseover=function(){kpFlag=this;(function(dom){time_flag=setTimeout(function(){if(kpFlag!=dom)
return;for(var j=0;j<len;j++){kpItem[j].className="rankItem";}
dom.className="rankItem current";setImg(dom,"img");clearTimeout(time_flag);time_flag=null;},100);})(this);}}
var resBox=G("resBox");var iconDt=getByClass(resBox,"iconDt")[0];var iconList=getByClass(resBox,"iconList")[0];iconDt.onclick=function(){if(typeof kftSearchObj!=='undefined'){if(kftSearchObj.gotoMap()){resBox.className="resBox tabMap";}}}
iconList.onclick=function(){if(typeof kftSearchObj!=='undefined'){if(typeof kftSearchObj.map!=='undefined'){kftSearchObj.map.house_infowindow.close();}}
resBox.className="resBox tabList";}
var LazyLoad=function(config){var imgNodes=config.elem,imgArray=[],original=config.src;var index=0;for(var j=0;j<imgNodes.length;j++){var oE=imgNodes[j];if(oE){for(var t=0;t<oE.length;t++){imgArray.push(oE[t]);}}}
var loader=function(){var i=0,imgYPoint,elem,lazySrc,top=(document.body.scrollTop||document.documentElement.scrollTop),viewheight=document.documentElement.clientHeight||window.innerHeight;for(;i<imgArray.length;i++){elem=imgArray[i];lazySrc=elem.getAttribute(original);if(!lazySrc||elem.src===lazySrc){continue;}
imgYPoint=FgetPosition(elem).y;if(imgYPoint>=(top-200)&&imgYPoint<=(top+viewheight+100)){index++;elem.src=lazySrc;elem.removeAttribute(original);}}};var autocheck=function(e){loader();if(imgArray.length==index){window.onscroll=null;window.onresize=null;imgArray.length=0;}};window.onscroll=function(){autocheck();}
window.onresize=function(){autocheck();}
loader();function FgetPosition(e,isID)
{if(isID==true)e=Fid(e);var left=0,top=0,w=e.offsetWidth,h=e.offsetHeight;do{top+=e.offsetTop||0;left+=e.offsetLeft||0;e=e.offsetParent;}while(e);return{x:left,y:top,width:w,height:h};}};if(G("mainList")!=null){LazyLoad({elem:[G("mainList").getElementsByTagName("img"),G("resList").getElementsByTagName("img"),G("pageList2").getElementsByTagName("img")],src:'_src'});}else{LazyLoad({elem:[G("resList").getElementsByTagName("img"),G("pageList2").getElementsByTagName("img")],src:'_src'});}
var xmlHttp;function InitAjax()
{var ajax=false;try{ajax=new ActiveXObject("Msxml2.XMLHTTP");}catch(e){try{ajax=new ActiveXObject("Microsoft.XMLHTTP");}catch(E){ajax=false;}}
if(!ajax&&typeof XMLHttpRequest!='undefined'){ajax=new XMLHttpRequest();}
return ajax;}
function refresh_ungrouped_top10(){xmlHttp=InitAjax();url="/index.php?mod=kanfang&act=ungroupedtop10&cityid="+g_city_info.FId;xmlHttp.open("GET",url,true);xmlHttp.onreadystatechange=refresh_ungrouped_top10_callback;xmlHttp.send(null);}
function refresh_ungrouped_top10_callback(){if(xmlHttp.readyState==4){if(xmlHttp.status==200){var v=xmlHttp.responseText;document.getElementById('ungroup_top10').innerHTML=v;}}}
function SlideImage(){var that=this;that.moveSpeed=3;that.switchSpeed=6000;that.container=null;that.moveDiv=null;that.naviArr=null;that.currentA=null;that.index=0;that.moveFlag=null;that.switchFlag=null;that.returnFlag=null;that.pageTOFlag=null;that.left=0;that.movewidth=743;that.movespace=100;that.remainder=0;that.remainder1=0;that.remainder1Space=0;that.stepTotalSpace=0;}
SlideImage.prototype={stop:function(){var th=this;if(th.pageTOFlag!=null){clearInterval(th.pageTOFlag);th.pageTOFlag=null;}
th.cantainer.onmouseout=function(){};clearInterval(th.switchFlag);th.switchFlag=null;},init:function(cid,mid,iscontinue){var th=this;if(iscontinue){th.start();th.cantainer.onmouseout=function(){th.start()};return;}
th.cantainer=th.fId(cid);th.moveDiv=th.fId(mid);th.moveDiv.style.position="absolute";th.moveDiv.style.left=0;th.left=parseInt(th.moveDiv.style.left);th.remainder=th.movewidth%th.movespace;if(th.remainder>10){th.remainder1=th.remainder%10;}
th.cantainer.onmouseover=function(){clearInterval(th.switchFlag);th.switchFlag=null;};th.cantainer.onmouseout=function(){th.start()};var df=null;th.getNaviArr=function(cid){var act=th.fId(cid);th.naviArr=th.fTagName(act,'a');for(var i=0;i<th.naviArr.length;i++){(function(uu){th.naviArr[i].onmouseover=function(e){df=this;if(th.returnFlag==null&&th.moveFlag==null){clearInterval(th.pageTOFlag);th.pageTOFlag=null;th.currentA.className="";th.currentA=th.naviArr[uu];th.currentA.className="current";th.index=uu;clearInterval(th.switchFlag);th.switchFlag=null;(function(dom){setTimeout(function(){if(dom!=df)
return;th.pageto();},500)})(this);}}})(i);}};th.start=function(){if(th.switchFlag==null){th.switchFlag=window.setInterval(th.change,th.switchSpeed);}};th.change=function(){if(th.returnFlag==null&&th.moveFlag==null){clearInterval(th.pageTOFlag);th.pageTOFlag=null;th.stepTotalSpace=0;th.remainder1Space=0;if(th.left<=-th.movewidth*3){th.index=0;th.returnFlag=window.setInterval(th.returnStart,1);}else{th.index++;th.moveFlag=window.setInterval(th.move,th.moveSpeed);}}};th.move=function(){if(th.stepTotalSpace>(th.remainder-th.movewidth)){th.left-=th.movespace;th.stepTotalSpace-=th.movespace;th.moveDiv.style.left=th.left+"px";}else{if(th.remainder1Space<(th.remainder-th.remainder1)){th.left-=10;th.stepTotalSpace-=10;th.remainder1Space+=10;}else{th.left--;th.stepTotalSpace--;th.remainder1Space++;}
th.moveDiv.style.left=th.left+"px";if(th.stepTotalSpace+th.movewidth==0){window.clearInterval(th.moveFlag);th.moveFlag=null;th.currentA.className="";th.currentA=th.naviArr[th.index];th.currentA.className="current";}}};th.returnStart=function(){if(th.left>=-29){th.left++;}else{th.left+=th.movespace;}
th.moveDiv.style.left=th.left+"px";if(th.left>=0){window.clearInterval(th.returnFlag);th.returnFlag=null;th.left=0;th.index=0;th.moveDiv.style.left=th.left+"px";th.currentA.className="";th.currentA=th.naviArr[th.index];th.currentA.className="current";}};th.getNaviArr('E2fBt');th.currentA=th.naviArr[0];th.currentA.className="current";th.start();},pageto:function(){var th=this;var targetLeft=0;switch(th.index){case 0:targetLeft=0;break;case 1:targetLeft=-th.movewidth;break;case 2:targetLeft=-th.movewidth*2;break;case 3:targetLeft=-th.movewidth*3;break;}
var zl=Math.abs(targetLeft-th.left);var ys=zl%100;var fl=0;var fl2=0;var ysys=0;if(ys>10){ysys=ys%10;}
var toIndex=function(){if(th.left==targetLeft){return;}else if(th.left<targetLeft){if(fl<(zl-ys)){th.left+=100;fl+=100;th.moveDiv.style.left=th.left+"px";}else{if(ysys!=0&&fl2<(ys-ysys)){th.left+=10;fl+=10;fl2+=10;}else{th.left++;fl++;fl2++;}
th.moveDiv.style.left=th.left+"px";if(fl==zl){clearInterval(th.pageTOFlag);th.pageTOFlag=null;fl=0;}}}else if(th.left>targetLeft){if(fl<(zl-ys)){th.left-=100;fl+=100;th.moveDiv.style.left=th.left+"px";}else{if(ysys!=0&&fl2<(ys-ysys)){th.left-=10;fl+=10;fl2+=10;}else{th.left--;fl++;fl2++;}
th.moveDiv.style.left=th.left+"px";if(fl==zl){clearInterval(th.pageTOFlag);th.pageTOFlag=null;fl=0;}}}}
if(th.pageTOFlag==null&&th.returnFlag==null&&th.moveFlag==null){th.pageTOFlag=setInterval(toIndex,1);}},fId:function(id){return document.getElementById(id);},fTagName:function(e,tn){return e.getElementsByTagName(tn);}}
var si=new SlideImage();si.init('fsE2','E2pic1',false);function G(s){return typeof s=="object"?s:document.getElementById(s);}
function getByClass(oParent,sClass){var aTmp=[],aEle=oParent.getElementsByTagName('*');for(var i=0,l=aEle.length;i<l;i++){if(aEle[i].className.indexOf(sClass)!=-1){aTmp.push(aEle[i]);}}
return aTmp;}
var guideWrap=G("guideWrap");function exitGuide(){guideWrap.style.display="none";scroll(0,0);}
function guideStep(idx){guideWrap.style.display="block";var guideItem=getByClass(guideWrap,"guideItem");var item=idx?idx:0;var oTop="";for(var i=0,len=guideItem.length;i<len;i++){if(i==item){guideItem[i].style.display="block";oTop=guideItem[i].offsetTop-60;oTop=oTop>0?oTop:0;window.scrollTo(0,oTop);}else{guideItem[i].style.display="none";}}}
function refresh_focus_house_gb_num()
{var houseids=FId('KFTFocusHouseIds').value;if(''==houseids)
{alert('请确定楼盘');}
var url='/index.php?mod=kanfang&act=gethousegbnum&id_list='+houseids+'&'+Math.random();FJsLoader.load('gb_getnums',url,function()
{if('undefined'==typeof rst_data)
{return false;}
if(0==rst_data['code'])
{var data=rst_data['data'];for(var i=0,len=data.length;i<len;i++)
{numOfMembers(data[i].num,[Number(data[i].houseId)]);}}
else
{alert(rst_data['msg']);}
return false;});}
document.domain="venfang.com";var code_to_msg={201:'请确定楼盘/路线',202:'请正确填写姓名',203:'请正确选择性别',204:'请正确填写联系手机',205:'请正确填写邮箱地址',206:'请正确填写图片验证码',207:'请阅读活动声明'};var code_to_id={202:'gb_name',203:'gb_sex',204:'gb_mobile',205:'gb_email',206:'gb_authcode',207:'gb_announce'};var g_callback='';function kft_gb_route_signup(kftid,kftrtid,callback)
{kft_gb_kft_selected('',kftid,kftrtid,callback);FId('form_gb_signup').submit();return false;}
function kft_gb_house_signup(houseid,callback)
{kft_gb_kft_selected(houseid,'','',callback);FId('form_gb_signup').submit();return false;}
function kft_xfd_house_attention(houseid,callback)
{var cityid=FId('cityid').value;if(houseid<=0)
{alert('请确定楼盘');}
g_callback=callback;FId('xfd_houseid').value=houseid;var url='/index.php?mod=kanfang&act=xfdsubmit&houseid='+houseid+'&cityid='+cityid+'&'+Math.random();FJsLoader.load('xfd_add',url,function()
{if('undefined'==typeof rst_data)
{return false;}
if(0==rst_data['code'])
{if('function'==typeof callback)
{callback();}
g_callback='';FId('xfd_houseid').value='';}else if(1==rst_data['code'])
{kft_click_login(3);}else if(3==rst_data['code'])
{ahref="http://www.venfang.com/"+rst_data['data']['cityname']+"/kanfangtuan/mymsg";FId('collect_dup_ahref').href=ahref;kft_gb_house_collect_dup_open();if('function'==typeof callback)
{callback();}
g_callback='';FId('xfd_houseid').value='';}
else if(rst_data['code']<0)
{kft_gb_signup_err_open();return false;}
return false;});}
function kft_gb_signup_submit()
{kft_gb_signup_info_err_clear();var rst=kft_gb_signup_check();if(rst)
{FId('form_gb_signup').submit();}}
function kft_login()
{var cityid=FId('cityid').value;var url='/index.php?mod=kanfang&act=userlogin&cityid='+cityid;var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':var KFTFocusHouseIds=FId('KFTFocusHouseIds').value;var KFTRouteIds=FId('KFTRouteIds').value;var KFTSGCommendHouseIds=FId('KFTSGCommendHouseIds').value;var KFTSGSearchHouseIds=FId('KFTSGSearchHouseIds').value;var KFTSGTop10HouseIds=FId('KFTSGTop10HouseIds').value;var KFTSGAttentionHouseIds=FId('KFTSGAttentionHouseIds').value;url+='&KFTFocusHouseIds='+KFTFocusHouseIds;url+='&KFTRouteIds='+KFTRouteIds;url+='&KFTSGCommendHouseIds='+KFTSGCommendHouseIds;url+='&KFTSGSearchHouseIds='+KFTSGSearchHouseIds;url+='&KFTSGTop10HouseIds='+KFTSGTop10HouseIds;url+='&KFTSGAttentionHouseIds='+KFTSGAttentionHouseIds;break;case'kft_route':var KFTRouteIds=FId('KFTRouteIds').value;url+='&KFTRouteIds='+KFTRouteIds;break;default:break;}}
url+='&'+Math.random();FJsLoader.load('kft_login',url,function()
{if('undefined'==typeof rst_data)
{return false;}
if((0==rst_data['code'])||(101==rst_data['code']))
{if(!FEmpty(page))
{switch(page)
{case'kft_index':index_login_init(rst_data['data']);break;case'kft_route':route_login_init(rst_data['data']);break;default:break;}}}else if(rst_data['code']<0)
{kft_gb_signup_err_open();}
return false;});}
function kft_gb_submit_result(code,msg,data)
{if(0==code)
{var callback=g_callback;g_callback='';var houseid=FId('gb_houseid').value;var routeid=FId('gb_kftrtid').value;kft_gb_signup_close();json_data=eval('('+data+')');ahref="http://www.venfang.com/"+json_data['cityname']+"/kanfangtuan/mymsg";if(FEmpty(houseid))
{var signup_num_id="route_sign_num";if(!FEmpty(FId(signup_num_id)))
{FId(signup_num_id).innerHTML=json_data['routeSignupNum'];}
FId('signup_success_ahref_1').href=ahref;FId('signup_success_ahref_2').href=ahref;kft_gb_route_signup_success_open();}else
{var signup_num_id="house_attention_num";if(!FEmpty(FId(signup_num_id)))
{FId(signup_num_id).innerHTML=json_data['houseSignupNum'];}
msg="<em>"+json_data['houseName']+"</em>"+json_data['KFTHouseStatus'];FId('house_attention_success_span').innerHTML=msg;FId('attention_success_ahref_1').href=ahref;FId('attention_success_ahref_2').href=ahref;kft_gb_house_attention_success_open();}
var pageObj=FId('page');if(!FEmpty(pageObj))
{userKFTInfo(json_data);var page=FId('page').value;switch(page)
{case'kft_index':var houseids=[];var routeids=[];if(!FEmpty(routeid))
{routeids=[Number(routeid)];joinIcons(0,routeids);houseids=json_data['houseids'];id="kft_route_signup_num_"+routeid;if(!FEmpty(FId(id)))
{FId(id).innerHTML=json_data['routeSignupNum'];}}else
{houseids=[Number(houseid)];}
kft_gb_signup_succ_refresh(houseids);break;case'kft_route':if(!FEmpty(routeid))
{var id="kft_route_"+routeid;routeIcons(0,id);id="kft_route_signup_num_"+routeid;if(!FEmpty(FId(id)))
{FId(id).innerHTML=json_data['routeSignupNum'];}}
break;default:break;}}
if('function'==typeof callback)
{callback();}}else if(1==code)
{if(FEmpty(FId('gb_houseid').value))
{kft_click_login(1);}else
{kft_click_login(2);}}else if(2==code)
{kft_gb_signup_open();}else if(3==code)
{var houseid=FId('gb_houseid').value;var routeid=FId('gb_kftrtid').value;kft_gb_signup_close();json_data=eval('('+data+')');ahref="http://www.venfang.com/"+json_data['cityname']+"/kanfangtuan/mymsg";if(FEmpty(houseid))
{FId('signup_dup_ahref').href=ahref;kft_gb_route_signup_dup_open();}else{FId('attention_house_dup_ahref').href=ahref;kft_gb_house_attention_dup_open();}
var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':var houseids=[];var routeids=[];if(!FEmpty(routeid))
{routeids=[Number(routeid)];joinIcons(0,routeids);houseids=json_data['houseids'];}else
{houseids=[Number(houseid)];}
kft_gb_signup_succ_refresh(houseids);break;case'kft_route':if(!FEmpty(FId(routeid)))
{signup_num_id="route_signup_num";var id="kft_route_"+routeid;routeIcons(0,id);id="kft_route_signup_num_"+routeid;if(!FEmpty(FId(id)))
{FId(id).innerHTML=json_data['routeSignupNum'];}}
break;default:break;}}}else if(code<0)
{var isSignupInfoErr=0;var regInfoObj=FId('resgInfo');if(!FEmpty(regInfoObj)&&('none'!=regInfoObj.style.display))
{codeTmp=-1*code;if((typeof code_to_id[codeTmp]!="undefined"))
{isSignupInfoErr=1;}}
if(isSignupInfoErr)
{kft_gb_signup_msg_show(code);}else
{kft_gb_signup_close();kft_gb_signup_err_open();}}
return false;}
function kft_gb_kft_selected(houseid,kftid,kftrtid,callback)
{if(''!=houseid)
{FId('gb_houseid').value=houseid;}
if(''!=kftid)
{FId('gb_kftid').value=kftid;}
if(''!=kftrtid)
{FId('gb_kftrtid').value=kftrtid;}
g_callback=callback;FId('gb_cityid').value=FId('cityid').value;}
function kft_gb_signup_check()
{var check_result=kft_gb_check_param();if(check_result<0)
{kft_gb_signup_msg_show(check_result);return false;}
return true;}
function kft_gb_check_param()
{var obj_house=FId("gb_houseid");var obj_kft=FId("gb_kftid");var obj_kft_r=FId("gb_kftrtid");if((FEmpty(obj_house)||obj_house.value<=0)&&(FEmpty(obj_kft)||obj_kft.value<=0||FEmpty(obj_kft_r)||obj_kft_r.value<=0))
{return-201;}
obj=FId("gb_name");if(FEmpty(obj)||FEmpty(obj.value)||obj.value.bytes>40)
{return-202;}
obj=FId("gb_mobile");var reg_m=/^0?1\d{10}$/;if(FEmpty(obj)||!reg_m.test(obj.value))
{return-204;}
obj=FId("gb_authcode");if(FEmpty(obj)||FEmpty(obj.value))
{return-206;}
obj=FId("gb_announce");if(FEmpty(obj)||!obj.checked)
{return-207;}
return 0;}
function kft_change_img()
{FId('authcode_img').src="http://ptlogin2.qq.com/getimage?aid="+PTLOGIN2_AID+"&"+Math.random();return false;}
function kft_gb_signup_msg_show(code)
{code*=-1;var show_msg="输入信息错误";if(typeof code_to_msg[code]!="undefined")
{show_msg=code_to_msg[code];}
if((typeof code_to_id[code]!="undefined"))
{var obj=FId(code_to_id[code]);if(!FEmpty(obj))
{obj.focus();}}
kft_gb_signup_info_err_show(show_msg);}
function kft_gb_clear_param()
{FId("form_gb_signup").reset();}
function kft_gb_clear_info()
{FId('gb_name_info').innerHTML='';FId('gb_mobile_info').innerHTML='';FId('gb_sunum_info').innerHTML='';FId('gb_info').innerHTML='';FId('gb_name_info').style.display='none';FId('gb_mobile_info').style.display='none';FId('gb_sunum_info').style.display='none';FId('gb_info').style.display='none';}
function kft_gb_signup_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
kft_change_img();FId('resgInfo').style.left='50%';FId('resgInfo').style.display="block";kft_open_mask();}
function kft_gb_signup_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
kft_gb_clear_param();g_callback='';FId('gb_houseid').value='';FId('gb_kftid').value='';FId('gb_kftrtid').value='';FId('gb_cityid').value='';FId('resgInfo').style.left='-1000px';FId('resgInfo').style.display="none";kft_close_mask();kft_gb_signup_info_err_clear();return false;}
function kft_gb_route_signup_success_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('route_signup_success_div').style.left='50%';FId('route_signup_success_div').style.display="block";kft_open_mask();return false;}
function kft_gb_route_signup_success_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('route_signup_success_div').style.left='-1000px';FId('route_signup_success_div').style.display="none";kft_close_mask();return false;}
function kft_gb_route_signup_dup_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('route_signup_dup_div').style.left='50%';FId('route_signup_dup_div').style.display="block";kft_open_mask();return false;}
function kft_gb_route_signup_dup_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('route_signup_dup_div').style.left='-1000px';FId('route_signup_dup_div').style.display="none";kft_close_mask();return false;}
function kft_gb_house_attention_success_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('house_attention_success_div').style.left='50%';FId('house_attention_success_div').style.display="block";kft_open_mask();return false;}
function kft_gb_house_attention_success_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('house_attention_success_div').style.left='-1000px';FId('house_attention_success_div').style.display="none";kft_close_mask();return false;}
function kft_gb_house_collect_dup_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('house_collect_dup_div').style.left='50%';FId('house_collect_dup_div').style.display="block";kft_open_mask();return false;}
function kft_gb_house_collect_dup_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('house_collect_dup_div').style.left='-1000px';FId('house_collect_dup_div').style.display="none";kft_close_mask();return false;}
function kft_gb_signup_info_err_show(msg)
{var errRstObj=FId('kft_error_result');if(!FEmpty(errRstObj))
{errRstObj.innerHTML=msg;errRstObj.style.display='';}}
function kft_gb_signup_info_err_clear()
{var errRstObj=FId('kft_error_result');if(!FEmpty(errRstObj))
{errRstObj.innerHTML='';errRstObj.style.display='none';}}
function kft_gb_signup_err_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('gb_err_div').style.left='50%';FId('gb_err_div').style.display="block";kft_open_mask();}
function kft_gb_signup_err_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('gb_err_div').style.left='-1000px';FId('gb_err_div').style.display="none";kft_close_mask();}
function kft_gb_signup_succ_refresh(houseids)
{focusIcons(0,houseids);groupIcons(0,houseids);top10Icons(0,houseids);;favoriteIcons(0,houseids);refresh_focus_house_gb_num();}
function kft_gb_sg_xfd_refresh(){var houseid=FId('xfd_houseid').value;if(!FEmpty(houseid))
{collectIcons(0,[Number(houseid)]);}}
function kft_popup_error_info(info){var infoDiv=FId('popup_err_div_msg');var infoParent=Fid("popup_err_div");var floatDiv=Fid("alert_float_layer");if(!FEmpty(infoDiv)){infoDiv.innerHTML=info;infoParent.style.display="block";floatDiv.style.display="block";infoDiv=null;infoParent=null;floatDiv=null;}}
function kft_popup_error_close(){var infoParent=Fid("popup_err_div");var floatDiv=Fid("alert_float_layer");infoParent.style.display="none";floatDiv.style.display="none";infoParent=null;floatDiv=null;}
function kft_gb_house_attention_dup_open()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;default:break;}}
FId('house_attention_dup_div').style.left='50%';FId('house_attention_dup_div').style.display="block";kft_open_mask();return false;}
function kft_gb_house_attention_dup_close()
{var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;default:break;}}
FId('house_attention_dup_div').style.left='-1000px';FId('house_attention_dup_div').style.display="none";kft_close_mask();return false;}
document.domain="venfang.com";function kft_ptlogin(default_domain)
{default_domain=escape(default_domain.replace(/http:/,""));default_domain="http:"+default_domain;FId("login_frame").src="http://ui.ptlogin2.qq.com/cgi-bin/login?appid="+PTLOGIN2_AID+"&s_url="+default_domain+"&target=self";var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.stop();break;case'kft_zhuanti':FId('login_div').style.cssText='display: none; position: fixed; z-index: 1000000; padding: 0pt; width: 372px; height: 210px; top: 50%; left: -500px; margin: -105px 0px 0px -186px;_position:absolute;_bottom:auto; _top:expression(eval(document.documentElement.scrollTop)+210); _margin-top:expression((eval(document.documentElement.clientHeight)-210)/2));';if(FBrowser.isIE6)
{FId('login_div').style.top=document.documentElement.scrollTop+210+"px";}
if('undefined'!=typeof g_login_pos)
{g_login_pos=1;}
break;default:break;}}
FId('login_div').style.left='50%';FId('login_div').style.display="block";kft_open_mask();}
function kft_click_login(to)
{var default_domain='http://www.venfang.com/index.php?mod=user&act=login&to='+to;kft_ptlogin(default_domain);}
function ptlogin2_onClose(){if('undefined'==typeof g_login_pos)
{FId('login_div').style.left='-500px';FId('login_div').style.display="none";kft_close_mask();}else if(1==g_login_pos)
{FId('login_div').style.left='-500px';FId('login_div').style.display="none";kft_close_mask();g_login_pos=0;}else if('function'==typeof g_login_div_ptlogin_close)
{g_login_div_ptlogin_close();}
var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':si.init('fsE2','E2pic1',true);break;case'kft_zhuanti':if('undefined'!=typeof g_login_div_css)
{FId('login_div').style.cssText=g_login_div_css;}
break;default:break;}}}
function login_success(to)
{ptlogin2_onClose();boss_statistics(1563,'userlogin');boss_statistics(1563,'loginall');var pageObj=FId('page');if(!FEmpty(pageObj))
{var page=FId('page').value;switch(page)
{case'kft_index':if('function'==typeof kft_login)
{kft_login();}
break;case'kft_route':if('function'==typeof kft_login)
{kft_login();}
break;default:break;}}
var citySubname='bj';if(!FEmpty(FId('citySubname'))&&!FEmpty(FId('citySubname').value))
{citySubname=FId('citySubname').value;}
switch(to)
{case 1:callback=g_callback;kftid=FId('gb_kftid').value;kftrtid=FId('gb_kftrtid').value;if('function'==typeof kft_gb_route_signup)
{kft_gb_route_signup(kftid,kftrtid,callback);}
break;case 2:callback=g_callback;houseid=FId('gb_houseid').value;if('function'==typeof kft_gb_house_signup)
{kft_gb_house_signup(houseid,callback);}
break;case 3:callback=g_callback;houseid=FId('xfd_houseid').value;if('function'==typeof kft_xfd_house_attention)
{kft_xfd_house_attention(houseid,callback);}
break;case 11:window.location="http://www.venfang.com/"+citySubname+"/kanfangtuan/myhouse";break;case 12:window.location="http://www.venfang.com/"+citySubname+"/kanfangtuan/mymsg";break;case 13:window.location="http://www.venfang.com/"+citySubname+"/kanfangtuan/myhouse";if('function'==typeof moreFavHouses)
{moreFavHouses();}
break;case 14:window.location="http://www.venfang.com/"+citySubname+"/kanfangtuan/myhouse";if('function'==typeof moreGroupbuyHouses)
{moreGroupbuyHouses();}
break;case 15:if('function'==typeof moreMyMessages)
{moreMyMessages();}
break;default:break;}
return false;}
function kft_ptlogout()
{document.cookie="uin=; path=/; domain=venfang.com; expires=Fri, 02-Jan-1970 00:00:00 GMT";document.cookie="skey=; path=/; domain=venfang.com; expires=Fri, 02-Jan-1970 00:00:00 GMT";return false;}
function kft_myxfd_exit(cityname)
{window.location="/"+cityname+"/kanfangtuan";}
function kft_reload()
{window.location.href=window.location.href;window.location.reload;}
(function(){window.getElementsByClassName=function(node,className){var aTmp=[],aEle=node.getElementsByTagName('*');for(var i=0,l=aEle.length;i<l;i++){if(aEle[i].className.indexOf(className)!=-1){aTmp.push(aEle[i]);}}
return aTmp;};Array.prototype.eachToNum=function(){for(var i in this){this[i]=Number(this[i]);}
return this;};})();function arrayIndexOf(array,value){for(var i=0,len=array.length;i<len;i++){if(array[i]==value){return i;}}
return-1;}
function userSelfInfo(sampleData){var welBar=document.getElementById("welInfo");welBar.getElementsByTagName("span")[0].innerHTML=sampleData.userName+"，您好！";if(sampleData.myMsgNum.unread>0){welBar.getElementsByTagName("span")[1].style.display='inline';}else{welBar.getElementsByTagName("span")[1].style.display='none';}
welBar.style.display="block";var temp=getElementsByClassName(welBar.parentNode,"login");temp[0].style.display="none";}
function userKFTInfo(sampleData){var myDiv=document.getElementById("myInfo");var myDivH2=myDiv.getElementsByTagName("h2")[0];myDivH2.getElementsByTagName("a")[0].innerHTML=sampleData.userName+"的看房单";var fl=getElementsByClassName(myDiv,"fl")[0];fl.getElementsByTagName("a")[0].innerHTML=sampleData.myMsgNum.all;var fr=getElementsByClassName(myDiv,"fr")[1];fr.getElementsByTagName("a")[0].innerHTML=sampleData.myHouseNum;myDiv.style.display='block';var myGroupedDiv=document.getElementById("myGroupedHouses");myGroupedDiv.innerHTML="";if(sampleData.myGroupedHouses.length>0)
{var infoDiv=document.createElement("div");infoDiv.className="cf tuanList";var infoH=document.createElement("h2");infoH.className="bold f12";infoH.innerHTML="已成团楼盘";infoDiv.appendChild(infoH);myGroupedDiv.appendChild(infoDiv)}
for(var i=0;sampleData.myGroupedHouses[i];i++){var groupDiv=document.createElement("div");var groupA=document.createElement("a");var ahref="/"+sampleData.myGroupedHouses[i].citySubName+"/kanfangtuan/kft_"+sampleData.myGroupedHouses[i].KFTId;ahref+="/route_"+sampleData.myGroupedHouses[i].RouteId;groupA.href=ahref;groupA.target="_blank";var groupASpan=document.createElement("span");groupASpan.title=sampleData.myGroupedHouses[i].FName;groupASpan.innerHTML=sampleData.myGroupedHouses[i].FShowName+'已成团';groupA.appendChild(groupASpan);var groupSpan=document.createElement("span");groupSpan.className="date";groupSpan.innerHTML='&nbsp;('+sampleData.myGroupedHouses[i].FDate+')';groupDiv.appendChild(groupA);groupDiv.appendChild(groupSpan);myGroupedDiv.appendChild(groupDiv)}
myDiv.parentNode.getElementsByTagName("div")[0].style.display="none";}
function userInfo(sampleData){userSelfInfo(sampleData);userKFTInfo(sampleData);}
function joinIcons(type,targetID){var parent=document.getElementById("mainList");var id=getElementsByClassName(parent,"hide");for(var i=0,len=id.length;i<len;i++){if(arrayIndexOf(targetID,Number(id[i].innerHTML))!=-1){var tempClass=id[i].previousSibling.className;switch(type){case 0:tempClass=tempClass.replace(/btnBm/g,"btnRes");id[i].previousSibling.innerHTML="已报名";id[i].previousSibling.onclick=null;break;case 1:tempClass=tempClass.replace(/btnRes/g,"btnBm");id[i].previousSibling.innerHTML="立即报名";break;}
id[i].previousSibling.className=tempClass;}}}
function collectIcons(type,targetID){var parent=document.getElementById("search_result_list");var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p");if(arrayIndexOf(targetID,Number(div[div.length-1].innerHTML))!=-1){switch(type){case 0:var tempClass=the.getElementsByTagName("em")[0].className;tempClass=tempClass.replace(/hide/g,"");the.getElementsByTagName("em")[0].className=tempClass;btnPList[2].style.display="none";btnPList[3].style.display="inline-block";break;case 1:var tempClass=the.getElementsByTagName("em")[0].className;tempClass+=" hide";the.getElementsByTagName("em")[0].className=tempClass;btnPList[3].style.display="none";btnPList[2].style.display="inline-block";break;}}}
var parent=document.getElementById("search_result_list_2");if(FEmpty(parent)){return false;}
var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p");if(arrayIndexOf(targetID,Number(div[div.length-1].innerHTML))!=-1){switch(type){case 0:var tempClass=the.getElementsByTagName("em")[0].className;tempClass=tempClass.replace(/hide/g,"");the.getElementsByTagName("em")[0].className=tempClass;btnPList[2].style.display="none";btnPList[3].style.display="inline-block";break;case 1:var tempClass=the.getElementsByTagName("em")[0].className;tempClass+=" hide";the.getElementsByTagName("em")[0].className=tempClass;btnPList[3].style.display="none";btnPList[2].style.display="inline-block";break;}}}}
function groupIcons(type,targetID){var parent=document.getElementById("search_result_list");var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p");if(arrayIndexOf(targetID,Number(div[div.length-1].innerHTML))!=-1){switch(type){case 0:btnPList[4].style.display="none";btnPList[5].style.display="inline-block";break;case 1:btnPList[5].style.display="none";btnPList[4].style.display="inline-block";break;}}}
var parent=document.getElementById("search_result_list_2");if(FEmpty(parent)){return false;}
var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p");if(arrayIndexOf(targetID,Number(div[div.length-1].innerHTML))!=-1){switch(type){case 0:btnPList[4].style.display="none";btnPList[5].style.display="inline-block";break;case 1:btnPList[5].style.display="none";btnPList[4].style.display="inline-block";break;}}}}
function top10Icons(type,targetID){for(var i=0,len=targetID.length;i<len;i++){var ID="ungroup_top10_qiang_"+targetID[i];var target=document.getElementById(ID);if(FEmpty(target))
{continue;}
switch(type){case 0:var tempClass=target.className;tempClass+=' over';target.className=tempClass;target.innerHTML="已抢";break;case 1:var tempClass=target.className;tempClass=tempClass.replace(/ over/,"");target.className=tempClass;target.innerHTML="抢";break;}}}
function favoriteIcons(type,targetID){var ul=document.getElementById("favHouses").getElementsByTagName("ul")[0];var liList=ul.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var id=liList[i].getElementsByTagName("div")[1].innerHTML;if(arrayIndexOf(targetID,Number(id))!=-1){var target=liList[i].getElementsByTagName("span")[3];switch(type){case 0:var tempClass=target.className;tempClass+=' over';target.className=tempClass;target.innerHTML="已组团";target.onclick=null;break;case 1:var tempClass=target.className;tempClass=tempClass.replace(/ over/,"");target.className=tempClass;target.innerHTML="求组团";break;}}}}
function focusIcons(type,targetID){var aim="focus1_oper";for(var i=0,condition=document.getElementById(aim);condition;i++){var target=document.getElementById(aim);var id=target.getElementsByTagName("div")[1].innerHTML;if(arrayIndexOf(targetID,Number(id))!=-1){var targetBtn=target.getElementsByTagName("p")[0];switch(type){case 0:var tempClass=targetBtn.className;tempClass+=" btnRes";targetBtn.className=tempClass;targetBtn.innerHTML="已报名";targetBtn.onclick=null;break;case 1:var tempClass=targetBtn.className;tempClass=tempClass.replace(/ btnRes/,"");targetBtn.className=tempClass;targetBtn.innerHTML="立即报名";break;}}
aim="focus"+(i+2)+"_oper";condition=document.getElementById(aim);}}
function getChipId(type){var ids=new Array();switch(type)
{case 1:var aim="focus1_oper";for(var i=0,condition=document.getElementById(aim);condition;i++){var target=document.getElementById(aim);var id=target.getElementsByTagName("div")[1].innerHTML;ids.push(Number(id));aim="focus"+(i+2)+"_oper";condition=document.getElementById(aim);}
break;case 2:var parent=document.getElementById("search_result_list");var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p");ids.push(Number(div[div.length-1].innerHTML));}
break;case 3:var ul=document.getElementById("favHouses").getElementsByTagName("ul")[0];var liList=ul.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var id=liList[i].getElementsByTagName("div")[1].innerHTML;ids.push(Number(id));}
break;default:break;}
return ids;}
function bindOnclick(type){switch(type)
{case 1:var aim="focus1_oper";for(var i=0,condition=document.getElementById(aim);condition;i++){var target=document.getElementById(aim);var id=target.getElementsByTagName("div")[1].innerHTML;var targetBtn=target.getElementsByTagName("p")[0];if(targetBtn.innerHTML=="立即报名"){!function(id){targetBtn.onclick=function(){boss_statistics(1564,'signup','indexpage','indexfocuse');kft_gb_house_signup(id,'');}}(id);}
aim="focus"+(i+2)+"_oper";condition=document.getElementById(aim);}
break;case 2:var parent=document.getElementById("search_result_list");var liList=parent.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var the=liList[i];var div=the.getElementsByTagName("div");var btnPList=div[div.length-3].getElementsByTagName("p")
var id=Number(div[div.length-1].innerHTML);!function(id){btnPList[2].onclick=function(){boss_statistics(1566,'collect','indexpage','indexmainso');kft_xfd_house_attention(id,kft_gb_sg_xfd_refresh);}
btnPList[4].onclick=function(){boss_statistics(1565,'askforgroup','indexpage','indexmainso');kft_gb_house_signup(id,'');}}(id);}
break;case 3:var ul=document.getElementById("favHouses").getElementsByTagName("ul")[0];var liList=ul.getElementsByTagName("li");for(var i=0,len=liList.length;i<len;i++){var id=liList[i].getElementsByTagName("div")[1].innerHTML;var target=liList[i].getElementsByTagName("span")[3];if(target.innerHTML=="求组团"){!function(id){target.onclick=function(){boss_statistics(1565,'askforgroup','indexpage','indexfavhouse');kft_gb_house_signup(id,'');}}(id);}}
break;default:break;}}
function numOfMembers(num,targetID){var aim="focus1_oper";for(var i=0,condition=document.getElementById(aim);condition;i++){var target=document.getElementById(aim);var id=target.getElementsByTagName("div")[1].innerHTML;if(arrayIndexOf(targetID,Number(id))!=-1){var targetBtn=target.getElementsByTagName("span")[0];targetBtn.innerHTML=num;}
aim="focus"+(i+2)+"_oper";condition=document.getElementById(aim);}}
function routeIcons(type,id){var target=document.getElementById(id);if(!FEmpty(target)){switch(type){case 0:var tempClass=target.className;tempClass=tempClass.replace(/btnBm/,"btnBmed");target.className=tempClass;break;case 1:var tempClass=target.className;tempClass=tempClass.replace(/btnBmed/,"btnBm");target.className=tempClass;break;}}}
function index_login_init(userData){userInfo(userData);focusIcons(0,userData['signupFocusHouseIds']);joinIcons(0,userData['signupKFTRouteIds']);collectIcons(0,userData['collectSGCommendHouseIds']);groupIcons(0,userData['signupSGCommendHouseIds']);collectIcons(0,userData['collectSGSearchHouseIds']);groupIcons(0,userData['signupSGSearchHouseIds']);top10Icons(0,userData['signupSGTop10HouseIds']);;favoriteIcons(0,userData['signupSGAttentionHouseIds']);}
function route_login_init(userData){userInfo(userData);var len=userData['signupKFTRouteIds'].length;for(var i=0;i<len;i++)
{id="kft_route_"+userData['signupKFTRouteIds'][i];routeIcons(0,id);}}
function kft_open_mask(callback)
{var cur_size_arr=FgetPageSize();var tmp_size_arr=FgetWindowSize();if(cur_size_arr['height']<tmp_size_arr['height'])
{cur_size_arr['height']=tmp_size_arr['height'];}
FId('mask').style.width=cur_size_arr['width']+"px";FId('mask').style.height=cur_size_arr['height']+"px";FId('alert_float_layer').style.display="";if(typeof callback=="function")
{callback();}}
function kft_close_mask(callback)
{FId('alert_float_layer').style.display="none";if(typeof callback=='function')
{callback();}}
function float_layer_ie6_bugfix(){var SIPAUTO_RivalHeader=document.getElementById('alert_float_layer');function SIP_Rival_posHeader(){var scrollHeight=document.documentElement.scrollTop;var scrollLeft=document.documentElement.scrollLeft;SIPAUTO_RivalHeader.style.top=scrollHeight+'px';SIPAUTO_RivalHeader.style.left=scrollLeft+'px';};function SIP_Rival_PollCancel(tar){clearInterval(tar);};function SIP_Rival_CycDetector(){var _detector=setInterval(SIP_Rival_posHeader,50);setTimeout('SIP_Rival_PollCancel('+_detector+')',2000);};if(document.attachEvent&&window.ActiveXObject&&!window.XMLHttpRequest){window.attachEvent("onload",SIP_Rival_posHeader);window.attachEvent("onresize",SIP_Rival_posHeader);window.attachEvent("onscroll",SIP_Rival_posHeader);};}
function FId(id)
{return document.getElementById(id);}
function FEmpty(v){if(v!=null&&(typeof(v)=='object'||typeof(v)=='function'))return false;return((""==v||undefined==v||null==v)?true:false);}
function IsIE6()
{return(!!window.ActiveXObject&&!window.XMLHttpRequest);}
function getUin(){var arr=document.cookie.match(new RegExp("(^| )o_cookie=([^;]*)(;|$)"));var uin='';if(arr!=null){uin=arr[2];uin=uin.replace(new RegExp("[^0-9]","gm"),"");uin=uin.replace(new RegExp("^0+","gm"),"");}
return uin;};var g_boss_img=new Image(1,1);function boss_statistics()
{var iTy=arguments[0]?arguments[0]:1554;var sOp=arguments[1]?arguments[1]:"other";var oPage=arguments[2]?arguments[2]:"other";var oPosition=arguments[3]?arguments[3]:"other";var sIp=arguments[4]?arguments[4]:"";var iQQ=arguments[5]?arguments[5]:getUin();var sBiz=arguments[6]?arguments[6]:"";var iSta=arguments[7]?arguments[7]:"";var iFlow=arguments[8]?arguments[8]:"";var iCity='';if((typeof(g_city_info)!='undefined')&&(typeof(g_city_info['FSubName'])!='undefined'))
{iCity=g_city_info['FSubName'];}
g_boss_img.src='http://btrace.qq.com/collect?sIp='+sIp+'&iQQ='+iQQ+'&sBiz='+sBiz+'&sOp='+sOp+'&iSta='+iSta+'&iTy='+iTy+'&iFlow='+iFlow+'&oPage='+oPage+'&oPosition='+oPosition+'&iCity='+iCity+'&ftime='+new Date().getTime();}
if(typeof house_front_domain!=='undefined'){var g_search_domain=house_front_domain.replace('http://','');}else{var g_search_domain='www.venfang.com';}
var SmartBox={formId:'smartbox_form_1',inputBoxId:'search_keyword',resultListBoxId:'smartbox_result',resultListId:'smartbox_list',searchBtnId:'smartbox_search_1',inputBoxMsg:'',noResultMsg:'',itemIdPrefix:'smartbox_item_',curItemIdx:-1,itemCount:0,inputBoxMsgColor:'#000000',inputColor:'#000000',filterStr:"[^\u4e00-\u9fA5a-z0-9@]",promptMsg:'',citySubName:'bj',domain:g_search_domain,cache:null,lastIndex:'',input:'',sn:1,returyKeyValid:true,searchByHouseIdCallback:null,searchByConditionCallback:null,ajaxCallback:function(){var resultList=Fid(SmartBox.resultListId);if(typeof smartbox_data_json=='undefined'||Fempty(smartbox_data_json)||typeof smartbox_sn=='undefined'){SmartBox.closeResultBox();return;}else{if(SmartBox.sn!=smartbox_sn+1){return;}
inputVal=SmartBox.getInputStr();if(smartbox_data_json.length==1&&smartbox_data_json[0].houseName==inputVal){SmartBox.accurateCache=smartbox_data_json[0];SmartBox.closeResultBox();return;}
var list=smartbox_data_json;SmartBox.itemCount=list.length;if(SmartBox.itemCount<=0){SmartBox.closeResultBox();return;}
SmartBox.cache=list;SmartBox.hasData=true;resultList.innerHTML='';for(var i=0;i<list.length;i++){if(list[i].houseName.length>=14){var showName=list[i].houseName.substr(0,14);showName+='...';var li='<li id="'+SmartBox.itemIdPrefix+i
+'" title="'+list[i].houseName
+'" onclick="SmartBox.clickItem(event, '+i+')" onmouseover="SmartBox.mouseoverItem('+i
+')"><div>'+showName+'</div></li>';}else{var li='<li id="'+SmartBox.itemIdPrefix+i
+'" onclick="SmartBox.clickItem(event, '+i+')" onmouseover="SmartBox.mouseoverItem('+i
+')"><div>'+list[i].houseName+'</div></li>';}
resultList.innerHTML+=li;}
var resultBox=Fid(SmartBox.resultListBoxId);resultBox.style.display='block';resultBox.onmouseout=function(){SmartBox.mouseOutList();};}},ajax:function(inputValue){var url='http://'+SmartBox.domain
+'/api.php?op=lpsuggest&q='
+encodeURIComponent(inputValue)+'&c='+SmartBox.citySubName
+'&r='+Math.random()+'&sn='+SmartBox.sn;FJsLoader.load('smartbox_ajax',url,SmartBox.ajaxCallback);SmartBox.sn++;},keyup:function(e){var input=Fid(SmartBox.inputBoxId);var ev=e?e:window.event;if(ev.keyCode==27){SmartBox.closeResultBox();}else if(ev.keyCode==40){if(Fid(SmartBox.inputBoxId).value==''){return false;}
if(SmartBox.cache!=null){if(SmartBox.curItemIdx<SmartBox.itemCount-1){SmartBox.curItemIdx++;input.value=SmartBox.cache[SmartBox.curItemIdx].houseName;}else{SmartBox.curItemIdx=-1;input.value=SmartBox.input;}
SmartBox.focusItem(SmartBox.curItemIdx);}}else if(ev.keyCode==38){if(Fid(SmartBox.inputBoxId).value==''){return false;}
if(SmartBox.cache!=null){if(SmartBox.curItemIdx==-1){SmartBox.curItemIdx=SmartBox.itemCount-1;input.value=SmartBox.cache[SmartBox.curItemIdx].houseName;}else if(SmartBox.curItemIdx>0){SmartBox.curItemIdx--;input.value=SmartBox.cache[SmartBox.curItemIdx].houseName;}else{SmartBox.curItemIdx--;input.value=SmartBox.input;}
SmartBox.focusItem(SmartBox.curItemIdx);}}else if(ev.keyCode==13){if(SmartBox.returyKeyValid){SmartBox.input=input.value;if(''==input.value.trim()){SmartBox.closeResultBox();}else{SmartBox.openResultBox();}}else{SmartBox.returyKeyValid=true;}}else if(ev.keyCode==39||ev.keyCode==37){}else{SmartBox.input=input.value;if(''==input.value.trim()){SmartBox.closeResultBox();}else{SmartBox.openResultBox();}}
return false;},mouseOutList:function(){SmartBox.curItemIdx=-1;SmartBox.focusItem(SmartBox.curItemIdx);},click:function(event){var e=event?event:window.event;if(e.stopPropagation){e.stopPropagation();}else{e.cancelBubble=true;}
var input=Fid(SmartBox.inputBoxId);if((SmartBox.inputBoxMsg!=input.value)&&(''!=input.value.trim())){}else{input.value='';input.style.color=SmartBox.inputColor;}
SmartBox.openResultBox();},focusItem:function(itemIdx){for(var i=0;i<SmartBox.itemCount;i++){var item=Fid(SmartBox.itemIdPrefix+''+i);if(item==null){continue;}
if(i==itemIdx){item.className='focus';}else{item.className='';}}},mouseoverItem:function(itemIdx){for(var i=0;i<SmartBox.itemCount;i++){var item=Fid(SmartBox.itemIdPrefix+''+i);if(item==null){continue;}
if(i==itemIdx){item.className='focus';}else{item.className='';}}},clickItem:function(event,itemIdx){var e=event?event:window.event;if(e.stopPropagation){e.stopPropagation();}else{e.cancelBubble=true;}
SmartBox.itemIndex=itemIdx;Fid(SmartBox.inputBoxId).value=SmartBox.cache[itemIdx].houseName;SmartBox.closeResultBox();selectItemByValue(Fid('search_region_subway'),'');Fid('search_region_subway_show').innerHTML='选择区域';selectItemByValue(Fid('search_price'),'');Fid('search_price_show').innerHTML='选择价格';selectItemByValue(Fid('search_housetype'),'');Fid('search_housetype_show').innerHTML='选择物业类型';SmartBox.searchByHouseIdCallback(SmartBox.cache[itemIdx].houseId);boss_statistics(1567,'search','indexpage','mainso');return false;},initInputBoxMsg:function(){var input=Fid(SmartBox.inputBoxId);if(''==input.value.trim()){input.value=SmartBox.inputBoxMsg;input.style.color=SmartBox.inputBoxMsgColor;}},openResultBox:function(){document.onclick=function(){SmartBox.initInputBoxMsg();SmartBox.closeResultBox();document.onclick=null;};SmartBox.curItemIdx=-1;var inputValue=SmartBox.getInputStr(true);if(inputValue==''){return;}
inputValue=SmartBox.getInputStr();SmartBox.ajax(inputValue);},closeResultBox:function(){var resultBox=Fid(SmartBox.resultListBoxId);resultBox.style.display='none';var resultList=Fid(SmartBox.resultListId);resultList.innerHTML='';},getInputStr:function(needFilt){var input=Fid(SmartBox.inputBoxId);var inputVal=input.value;if(typeof needFilt!='undefined'&&needFilt===true){var reg=new RegExp(SmartBox.filterStr,'ig');inputVal=inputVal.replace(reg,' ');}
inputVal=inputVal.trim();return inputVal;},getHouseIdInCache:function(inputValue){if(SmartBox.cache!=null){for(var i=0,len=SmartBox.cache.length;i<len;i++){var houseInfo=SmartBox.cache[i];if(houseInfo.houseName==inputValue){return houseInfo.houseId;}}}
return null;},search:function(){var inputVal=SmartBox.getInputStr();SmartBox.sn++;var houseId=SmartBox.getHouseIdInCache(inputVal);SmartBox.searchByConditionCallback(inputVal);boss_statistics(1567,'search','indexpage','mainso');return false;},addEventSimple:function(obj,evt,fn){if(obj.attachEvent){obj.attachEvent('on'+evt,fn);}else if(obj.addEventListener){obj.addEventListener(evt,fn,false);}},init:function(searchByHouseIdCallback,searchByConditionCallback){SmartBox.searchByHouseIdCallback=searchByHouseIdCallback;SmartBox.searchByConditionCallback=searchByConditionCallback;if(typeof g_city_info=="undefined"||Fempty(g_city_info)){var path=location.pathname;if(0==path.indexOf('/index.php')){var search=location.search;var t=search.indexOf('city=');var t1=search.indexOf('&',t);if(-1==t1){SmartBox.citySubName=search.substr(t+5);}else{SmartBox.citySubName=search.substr(t+5,t1-t-5);}}else{var t=path.indexOf('_');SmartBox.citySubName=path.substr(1,t-1);}}else{SmartBox.citySubName=g_city_info.FSubName;}
var input=Fid(SmartBox.inputBoxId);if(!Fempty(input)){SmartBox.addEventSimple(window,'load',function(){input.blur();});input.onclick=function(event){SmartBox.click(event);};input.onkeyup=function(event){SmartBox.keyup(event);};}
var form=Fid(SmartBox.formId);if(!Fempty(form)){form.onsubmit=function(event){SmartBox.returyKeyValid=false;if(-1!=SmartBox.curItemIdx){SmartBox.itemIndex=SmartBox.curItemIdx;SmartBox.preInput=SmartBox.cache[SmartBox.curItemIdx].houseName;SmartBox.sn++;Fid(SmartBox.inputBoxId).value=SmartBox.cache[SmartBox.curItemIdx].houseName;SmartBox.closeResultBox();SmartBox.curItemIdx=-1;SmartBox.otherCache=SmartBox.cache;SmartBox.cache=null;SmartBox.isAccurateSearch=true;}else{SmartBox.search();}
return false;};}}};
function PageBarControl(initOption){this.containerId=initOption.containerId||null;if(Fempty(this.containerId)){return;}
this.curPageNo=initOption.curPageNo||1;this.totalPage=initOption.totalPage||0;this.totalPageMark=initOption.totalPageMark||5;this.renderCallback=initOption.renderCallback||function(){};this.gotoPageCallback=initOption.gotoPageCallback||function(){};var that=this;var containerObj=Fid(this.containerId);if(Fempty(containerObj)){return;}
this.getCurPage=function(){return that.curPageNo;};this.removeFromPage=function(){containerObj.innerHTML='';}
var eventBindMap={};var idPrefix='$$pageControl$$_';var idNext=idPrefix+'next';var idPre=idPrefix+'pre';var makeHtml=function(){var html='';if(that.totalPage<=0){return'';}
var hasPreMark=false;var hasNextMark=false;var hasPreBtn=false;var hasNextBtn=false;var pageMarkOffset=0;if(that.totalPage>1&&that.curPageNo<that.totalPage){hasNextBtn=true;}
if(that.curPageNo>1){hasPreBtn=true;}
var showMark=false;if(that.totalPage<=that.totalPageMark){showMark=false;}else{showMark=true;if(that.curPageNo>1){hasPreMark=true;pageMarkOffset=1;}
if(that.totalPage-that.curPageNo>=that.totalPageMark-pageMarkOffset){hasNextMark=true;}}
if(hasPreBtn){html+='<a href="" id="'+idPrefix+'" class="prev">上一页</a>&nbsp;';eventBindMap[idPrefix]=that.curPageNo-1;}else{html+='<span class="prev" href="">上一页</span>&nbsp;';}
if(hasPreMark){html+='<em>...</em>&nbsp;';}
var endHtml='';if(hasNextMark){endHtml+='<em>...</em>&nbsp;';}
if(hasNextBtn){endHtml+='<a href="" id="'+idNext+'" class="next">下一页</a>';eventBindMap[idNext]=that.curPageNo+1;}else{endHtml+='<span class="prev" href="">下一页</span>';}
var flag=true;var len=Math.min(that.totalPageMark,that.totalPage);if(hasPreMark){len--;}
if(hasNextMark){len--;}
var showPageNoArr=[];var showStartPageNo=1;if(showMark){var offset=Math.ceil(that.totalPageMark/2);showStartPageNo=that.curPageNo-offset;while(showStartPageNo<that.curPageNo){showStartPageNo++;}
while(showStartPageNo+len-1>that.totalPage){showStartPageNo--;}}
for(var i=0;i<len;i++){showPageNoArr[showPageNoArr.length]=showStartPageNo+i;}
var len=showPageNoArr.length;for(var i=0;i<len;i++){var page=showPageNoArr[i];var id=idPrefix+i;if(page==that.curPageNo){html+='<a href="javascript:void(0);" class="current">'+page+'</a>&nbsp;';}else{html+='<a href="javascript:void(0);" id="'+id+'">'+page+'</a>&nbsp;';eventBindMap[id]=page;}}
html+=endHtml;return html;};var rebind=function(){for(var id in eventBindMap){var page=eventBindMap[id];var obj=Fid(id);if(!Fempty(obj)){obj.onclick=(function(page){return function(){that.gotoPageCallback(page);setTimeout(function(){that.curPageNo=page;var html=makeHtml();containerObj.innerHTML=html;rebind();},0);return false;};})(page);}};};var html=makeHtml();containerObj.innerHTML=html;rebind();}
function selectItemByValue(obj,value){for(var i=0;i<obj.options.length;i++){if(obj.options[i].value==value){obj.options[i].selected=true;return true;}}
return false;}
function Search(){var that=this;this.domain=g_search_domain;this.initKeyword='请输入项目名称';this.initOrderPrice=2;this.initOrderOpendate=4;this.numPerPage=8;this.map=null;this.smartbox=SmartBox;this.smartbox.init(function(houseId){that.doSearchByHouseIdList(houseId);},function(){that.doSearch(true);});this.houseList=null;this.houseNumHasLatLng=0;this.initHouseList=null;this.initHouseNumHasLatLng=0;this.searchCondition=null;var selectOrder=Fid('search_order');var floatNoSearchResult=Fid('search_no_result');var floatSearchResult=Fid('resBox');var btnReturnFromNoResult=Fid('search_return_from_no_result');var initSearchResultList=Fid('search_result_list');var searchResultList=Fid('search_result_list_2');this.searchResultHasLatLng=false;var btnSearchOrderPrice=Fid('search_order_price');var btnSearchOrderOpendate=Fid('search_order_opendate');var selectSearchOrder=Fid('search_order');var btnSearchReturnToInitSearchResult=Fid('search_return_to_init_search_result');if(Fempty(btnSearchOrderPrice)||Fempty(btnSearchOrderOpendate)||Fempty(selectOrder)){return;}
btnSearchOrderPrice.onclick=function(){var icon=Fid('search_order_price_icon');if(icon.className.indexOf('down')!==-1){icon.className='icons up';selectItemByValue(selectOrder,1);that.doSearch(true);}else{icon.className='icons down';selectItemByValue(selectOrder,2);that.doSearch(true);}
return false;};btnSearchOrderOpendate.onclick=function(){var icon=Fid('search_order_opendate_icon');if(icon.className.indexOf('down')!==-1){icon.className='icons up';selectItemByValue(selectOrder,4);that.doSearch(true);}else{icon.className='icons down';selectItemByValue(selectOrder,3);that.doSearch(true);}
return false;};btnReturnFromNoResult.onclick=function(){that.hideNoSearchResult();that.searchReturnToInitSearchResult.apply(null);return false;};this.resetSearchConditionOnPage=function(){Fid('search_keyword').value='';Fid('search_region_subway').value='';Fid('search_region_subway_show').innerHTML='选择区域';Fid('search_price').value='';Fid('search_price_show').innerHTML='选择价格';Fid('search_housetype').value='';Fid('search_housetype_show').innerHTML='选择物业类型';}
this.searchReturnToInitSearchResult=function(){that.resetSearchConditionOnPage();that.showInitSearchResult();if(!Fempty(that.searchPageBarControl)){that.searchPageBarControl.removeFromPage();}
resBox.className="resBox tabList";Fid("search_title").innerHTML='备选楼盘';that.houseList=that.initHouseList;Fid('search_tips_on_map').innerHTML='搜索到的楼盘';Fid('search_house_num_on_map').innerHTML=that.initHouseNumHasLatLng;Fid("search_bottom_toolbar").style.display='none';};btnSearchReturnToInitSearchResult.onclick=function(){that.searchReturnToInitSearchResult.apply(null);return false;};selectSearchOrder.onchange=function(){var val=selectSearchOrder.value;switch(val){case'1':case'2':var icon=Fid('search_order_price_icon');if(icon.className.indexOf('down')!==-1){icon.className='icons up';that.doSearch(true);}else{icon.className='icons down';that.doSearch(true);}
break;case'3':case'4':var icon=Fid('search_order_opendate_icon');if(icon.className.indexOf('down')!==-1){icon.className='icons up';that.doSearch(true);}else{icon.className='icons down';that.doSearch(true);}
break;default:}
return true;};this.popupNoSearchResult=function(){floatNoSearchResult.className='resBox resEmpty';};this.hideNoSearchResult=function(){floatNoSearchResult.className='resBox resEmpty hide';};
this.hideInitSearchResult=function(){initSearchResultList.className='cf hide';searchResultList.className='cf';};this.showInitSearchResult=function(){initSearchResultList.className='cf';searchResultList.className='cf hide';};this.hideMapModuleBtn=function(){Fid('search_btn_map_module').style.display='none';};this.showMapModuleBtn=function(){Fid('search_btn_map_module').style.display='';};this.showSearchResult=function(){that.searchResultHasLatLng=false;var data=that.houseList;var row1MaxLen=10;var row2MaxLen=9;var row3MaxLen=9;if(!Fempty(data)&&data.length>=1){var html='';var len=data.length;for(var i=0;i<len;i++){var houseInfo=data[i];var houseNameMaxLen=row1MaxLen-houseInfo.FRegionName.length;var houseName=houseInfo.FName;var showHouseName=houseName;if(houseName.length>houseNameMaxLen){showHouseName='<span title="'+houseName+'">'+houseName.substr(0,houseNameMaxLen)+'...</span>';}
var regionHref='http://house.venfang.com/list-r'+houseInfo.FRegionId+'.html';var houseHref='http://house.venfang.com/'+houseInfo.FId+'/';var priceDiscount=houseInfo.FPriceDisplayStr;priceDiscount=priceDiscount.replace('元/平方米','元/平米');var showPriceDiscount=priceDiscount;if(priceDiscount.bytes()/2>row2MaxLen){showPriceDiscount='<span title="'+priceDiscount+'">'+priceDiscount.substr(0,row2MaxLen)+'...</span>';}
var feature=houseInfo.featureString;var showFeature=feature;if(showFeature.length>row3MaxLen){showFeature='<span title="'+feature+'">'+feature.substr(0,row3MaxLen)+'...</span>';}
if(!that.searchResultHasLatLng&&(houseInfo.FLongitude!=0||houseInfo.FLatitude!=0)){that.searchResultHasLatLng=true;}
var btnId='map_overlay_id_'+i;var xfdHtml='';var starHtml='';if(houseInfo.isXFD){xfdHtml+='<p class="btn scBtn over "  >已收藏</p><p class="hide">abc</p>';starHtml='<em class="icons iconSc"></em>';}else{xfdHtml+='<p id="'+btnId+'" class="btn icons scBtn favHouse" onclick="kft_xfd_house_attention('+houseInfo.FId+', function(){changeBtnHouseXFD(\''+btnId+'\', ['+houseInfo.FId+']);});boss_statistics(1566,\'collect\',\'indexpage\',\'mainso\');">收藏</p>';xfdHtml+='<p class="btn scBtn over " style="display:none;">已收藏</p>';starHtml='<em class="icons iconSc hide"></em>';}
var groupbuyHtml='';if(houseInfo.isGroupbuy){groupbuyHtml+='<p class="btn ztBtn over">已参与</p><p class="hide">abc</p>';}else{groupbuyHtml+='<p id="'+btnId+'" class="btn icons ztBtn signUpHouse" onclick="var addr=\'<input type=hidden name=relation id=relation value='+houseInfo.FId+'><input type=hidden name=subject id=subject value='+houseInfo.FName+'><input type=hidden name=price id=price value='+houseInfo.FPriceDisplayStr+'><input type=hidden name=region id=region value='+houseInfo.FRegionName+'><input type=hidden name=regionid id=regionid value='+houseInfo.FRegionId+'>\';Box(\'msg1\',502,345,vf_box1,footerhtml1,addr);">求组团</p>';groupbuyHtml+='<p class="btn ztBtn over" style="display:none;">已参与</p>';}
html+='<li class="item">\
                            <div class="picBox">\
                                '+starHtml+'\
                                <img width="155" height="103" alt="'+houseInfo.FName+'" src="'+houseInfo.FCover+'">\
                                <div class="picShade">\
                                    <p>优惠：'+houseInfo.FShortDiscount+'</p>\
                                    <!--<p>收藏：1062人</p>-->\
                                    <!--<p>求组团：802人</p>-->\
                                </div>\
                            </div>\
                            <div class="txtBox">\
                                <p>[<a href="'+regionHref+'" target="_blank">'+houseInfo.FRegionName+'</a>]<a href="'+houseHref+'" target="_blank">'+showHouseName+'</a></p>\
                                <p><span class="ca">价格：</span><span class="num">'+showPriceDiscount+'</span></p>\
                                <p><span class="ca">特色：</span>'+showFeature+'</p>\
                            </div>\
                            <div class="btnBox">\
                            <div class="hide"><p>埋入楼盘id:</p><div id="recommend_house_'+(i+1)+'" class="recommend_house" style="display:inline;">'+houseInfo.FId+'</div><p></p></div>\
                                    '+xfdHtml+groupbuyHtml+'\
                            </div>\
                        </li>';}
searchResultList.innerHTML=html;resListHover("resList");if(that.searchResultHasLatLng){that.showMapModuleBtn();}else{that.hideMapModuleBtn();}}else{that.hideMapModuleBtn();}
Fid("search_bottom_toolbar").style.display='block';Fid("search_title").innerHTML='搜索结果';floatSearchResult.className='resBox tabList';that.hideInitSearchResult();};this.getHouseInfoAndShowOnMap=function(){};this.hideSearchResult=function(){floatSearchResult.className='resBox tabList hide';};this.resetConditionOnPage=function(){};this.getSearchCondition=function(){var condition={};var city=(!Fempty(Fid('search_city')))?Fid('search_city').value:'';if(Fempty(city)){alert('城市参数错误');return condition;}
var regionSubway=(!Fempty(Fid('search_region_subway')))?Fid('search_region_subway').value:'';var price=(!Fempty(Fid('search_price')))?Fid('search_price').value:'';var housetype=(!Fempty(Fid('search_housetype')))?Fid('search_housetype').value:'';var order=(!Fempty(Fid('search_order')))?Fid('search_order').value:'';var keyword=(!Fempty(Fid('search_keyword')))?Fid('search_keyword').value:'';if(keyword==that.initKeyword){keyword='';}
condition.city=city;condition.regionSubway=regionSubway;condition.price=price;condition.housetype=housetype;condition.order=order;condition.keyword=keyword;return condition;};this.doSearch=function(resetCondition,page){
var url='http://'+that.domain
+'/api.php?op=searchbycondition';if(typeof resetCondition!=='undefined'&&resetCondition==true){if(!Fempty(that.searchPageBarControl)){that.searchPageBarControl.removeFromPage();}
that.searchPageBarControl=null;that.searchCondition=that.getSearchCondition();}else{that.searchCondition.page=page;}
for(var param in that.searchCondition){url+='&'+param+'='+that.searchCondition[param];}
FJsLoader.load('search_jsload',url,that.doSearchResult);};this.doSearchByHouseIdList=function(houseIdListString,isInitData){
var url='http://'+that.domain
+'/api.php?op=searchbyhouseidlist&id_list='+houseIdListString;if(typeof isInitData!=='undefined'&&isInitData){url+='&is_init=1';}
if(!Fempty(that.searchPageBarControl)){that.searchPageBarControl.removeFromPage();}
FJsLoader.load('search_jsload',url,that.doSearchResult);};this.searchPageBarControl=null;this.doSearchResult=function(){if(typeof kftSearchResultJson==='undefined'){return;}
var curPageNo=1;if(!Fempty(that.searchPageBarControl)){curPageNo=that.searchPageBarControl.getCurPage();}
var totalPage=kftSearchResultJson.totalPage;var totalNum=kftSearchResultJson.totalNum;Fid('KFTSGSearchHouseIds').value='';if(totalPage<1){that.popupNoSearchResult();that.hideSearchResult();return;}else{that.houseList=kftSearchResultJson.curPageData;that.houseNumHasLatLng=0;var houseIdArr=[];var len=that.houseList.length;for(var i=0;i<len;i++){var houseInfo=that.houseList[i];houseIdArr[houseIdArr.length]=houseInfo.FId;if(houseInfo.FLongitude!=0||houseInfo.FLatitude!=0){that.houseNumHasLatLng++;}}
Fid('KFTSGSearchHouseIds').value=houseIdArr.join('|');if(typeof isInitData==='undefined'){var searchString='';if(!Fempty(Fid('search_region_subway_show').innerHTML)&&Fid('search_region_subway_show').innerHTML!='选择区域'){searchString+='<em class="keyWord">'+Fid('search_region_subway_show').innerHTML+'</em>';}
if(!Fempty(Fid('search_price_show').innerHTML)&&Fid('search_price_show').innerHTML!='选择价格'){searchString+='<em class="keyWord">'+Fid('search_price_show').innerHTML+'</em>';}
if(!Fempty(Fid('search_housetype_show').innerHTML)&&Fid('search_housetype_show').innerHTML!='选择物业类型'){searchString+='<em class="keyWord">'+Fid('search_housetype_show').innerHTML+'</em>';}
if(!Fempty(Fid('search_keyword').value)){searchString+='<em class="keyWord">'+Fid('search_keyword').value+'</em>';}
Fid('search_tips_on_map').innerHTML='搜索到'+searchString+'的楼盘';that.hideNoSearchResult();that.showSearchResult();}else{that.initHouseList=that.houseList;that.initHouseNumHasLatLng=that.houseNumHasLatLng;}
Fid('search_house_num_on_map').innerHTML=that.houseNumHasLatLng;}
if(typeof isInitData==='undefined'&&Fempty(that.searchPageBarControl)){that.searchPageBarControl=null;that.searchPageBarControl=new PageBarControl({curPageNo:curPageNo,totalPage:totalPage,containerId:'search_pagebar',gotoPageCallback:function(page){that.doSearch(false,page);}});}
isInitData=undefined;};this.init=function(){var initIdList=getHouseIDListOnInitSearchResult();if(initIdList.length<1){that.hideMapModuleBtn();return false;}
Fid('search_tips_on_map').innerHTML='搜索到的楼盘';var idListString=initIdList.join(',');that.doSearchByHouseIdList(idListString,true);};}
function getHouseIDListOnInitSearchResult(){var houseIdListStr=Fid('KFTSGCommendHouseIds').value;return houseIdListStr.split('|');}
var kftSearchObj=new Search();function changeBtnStatusOnMapOverlay(btnId,houseIdArr){var o=Fid(btnId);o.onclick=function(){};o.className="btn scBtn over";o.style.color="#A6A6A6";o.style.cursor="auto";o.style.backgroundColor="#F8F8F8";o.style.backgroundPosition="100px 100px";o.style.border="1px solid #D8D8D8";if(typeof houseIdArr!=='undefined'){collectIcons(0,houseIdArr);}}
function changeBtnHouseXFD(btnId,houseIdArr){var o=Fid(btnId);o.onclick=function(){};collectIcons(0,houseIdArr);}
function changeBtnHouseGroupbuy(btnId){var o=Fid(btnId);o.onclick=function(){};o.className="btn scBtn over";o.style.color="#A6A6A6";o.style.cursor="auto";o.style.backgroundColor="#F8F8F8";o.style.backgroundPosition="100px 100px";o.style.border="1px solid #D8D8D8";var heart=o.parentNode.parentNode.getElementsByTagName("div")[0].getElementsByTagName("em")[0];var tempClass=heart.className;tempClass=tempClass.replace(/ hide/,"");heart.className=tempClass;}/*  |xGv00|21c396e0c7fc39c16fcb9896a68f3157 */