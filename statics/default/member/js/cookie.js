function set_cookie(name,value,expireDays){name=cookiepre+name;var expires=new Date();if(!expireDays)expireDays=1;expires.setTime(expires.getTime()+expireDays*24*3600*1000);var cookiestr='';cookiestr=name+'='+escape(value)+'; path='+cookiepath;if(cookiedomain!=''){cookiestr+='; domain='+cookiedomain;}
cookiestr+='; expires='+expires.toGMTString();document.cookie=cookiestr;}
function get_cookieval(start){var end=document.cookie.indexOf(";",start);if(end==-1){end=document.cookie.length;}
return unescape(document.cookie.substring(start,end));}
function get_cookie(name){name=cookiepre+name;var arg=name+"=";var alen=arg.length;var clen=document.cookie.length;var i=0;while(i<clen){var j=i+alen;if(document.cookie.substring(i,j)==arg)return get_cookieval(j);i=document.cookie.indexOf(" ",i)+1;if(i==0)break;}
return null;}
function del_cookie(name){var expires=new Date();expires.setTime(expires.getTime()-1);var cval=get_cookie(name);name=cookiepre+name;document.cookie=name+"="+cval+"; expires="+expires.toGMTString();}