//����������
;;;var iterate = function (obj){	s="��������"+obj+"�����ԣ�\n";	for(i in obj)	s+=i+":"+obj[i]+"\n";	return s;};


var $id=function (n)
{
	return (typeof n == "string") ? document.getElementById(n) : n;
};

var SFUtil =
{
	/**
	* ���ںϲ��������{'name':'value',..}�Ķ���
	* ��Ϊjs�����鲻֧���Զ���������ö���������������Ĺ���
	*/
	objMerge:function()
	{
		var result = {};
		for(var i=0; i<arguments.length; i++)
		{
			if('object' != typeof(arguments[i]))
			{
				//alert('argument '+i+' is not an object!');
				break;
			}
			for(j in arguments[i])
			{
				result[j] = arguments[i][j];
			}
		}
		return result;
	},
	getStrlen:function(str)
	{
		var len = str.length;
		var reLen = 0;
		for (var i = 0; i < len; i++)
		{
			if (str.charCodeAt(i) < 27 || str.charCodeAt(i) > 126)
			{
				// ȫ��
				reLen += 2;
			}
			else
			{
				reLen++;
			}
		}
		return reLen;
	},
	subStrcn:function(str,lencn)
	{
		var len = str.length;
		var reLen = 0;
		var ch = 0;
		for (var i = 0; i < len; i++)
		{
			if (str.charCodeAt(i) < 27 || str.charCodeAt(i) > 126)
			{
				ch = 2;
			}
			else
			{
				ch = 1;
			}
			reLen += ch;
			if(reLen > lencn)
			{
				//i -= 1;
				break;
			}
		}
		return str.substring(0,i);
	},
	/*
	* ��ȡget����
	*/
	/*args:{},
	getArgs:function()
	{
		var query = location.search.substring(1);
		var pairs = query.split("&");                 // Break at ampersand
		for(var i = 0; i < pairs.length; i++)
		{
			var pos = pairs[i].indexOf('=');          // Look for "name=value"
			if (pos == -1) continue;                  // If not found, skip
			var argname = pairs[i].substring(0,pos);  // Extract the name
			var value = pairs[i].substring(pos+1);    // Extract the value
			//value = decodeURIComponent(value);        // Decode it, if needed
			this.args[argname] = value;                    // Store as a property
		}
	},*/
	/*
	xml2json �ı���
	This work is licensed under Creative Commons GNU LGPL License.

	License: http://creativecommons.org/licenses/LGPL/2.1/
	Version: 0.9
	Author:  Stefan Goessner/2006
	Web:     http://goessner.net/
	������xml XML �ڵ����
	���أ�JSON ����
	*/
	xml2json:function(xml) {
		var X = {
			toObj: function(xml) {
				var o = {};
				if (xml.nodeType==1) {   // element node ..
					if (xml.attributes.length)   // element with attributes  ..
					for (var i=0; i<xml.attributes.length; i++)
					o["@"+xml.attributes[i].nodeName] = (xml.attributes[i].nodeValue||"").toString();
					if (xml.firstChild) { // element has child nodes ..
						var textChild=0, cdataChild=0, hasElementChild=false;
						for (var n=xml.firstChild; n; n=n.nextSibling) {
							if (n.nodeType==1) hasElementChild = true;
							else if (n.nodeType==3 && n.nodeValue.match(/[^ \f\n\r\t\v]/)) textChild++; // non-whitespace text
							else if (n.nodeType==4) cdataChild++; // cdata section node
						}
						if (hasElementChild) {
							if (textChild < 2 && cdataChild < 2) { // structured element with evtl. a single text or/and cdata node ..
								X.removeWhite(xml);
								for (var n=xml.firstChild; n; n=n.nextSibling) {
									if (n.nodeType == 3)  // text node
									o["#text"] = X.escape(n.nodeValue);
									else if (n.nodeType == 4)  // cdata node
									//�˳���ԭ��������� #cdata ��ǩ���ҵĺ�̨�������ݰ����нڵ㶼���� CDATA �ڵ��ˣ�����ȥ�� #cdata ��ǩ��
									//o["#cdata"] = X.escape(n.nodeValue);
									o = X.escape(n.nodeValue);
									else if (o[n.nodeName]) {  // multiple occurence of element ..
										if (o[n.nodeName] instanceof Array)
										o[n.nodeName][o[n.nodeName].length] = X.toObj(n);
										else
										o[n.nodeName] = [o[n.nodeName], X.toObj(n)];
									}
									else  // first occurence of element..
									o[n.nodeName] = X.toObj(n);
								}
							}
							else { // mixed content
								if (!xml.attributes.length)
								o = X.escape(X.innerXml(xml));
								else
								o["#text"] = X.escape(X.innerXml(xml));
							}
						}
						else if (textChild) { // pure text
							if (!xml.attributes.length)
							o = X.escape(X.innerXml(xml));
							else
							o["#text"] = X.escape(X.innerXml(xml));
						}
						else if (cdataChild) { // cdata
							if (cdataChild > 1)
							o = X.escape(X.innerXml(xml));
							else
							for (var n=xml.firstChild; n; n=n.nextSibling)
							//o["#cdata"] = X.escape(n.nodeValue);
							o = X.escape(n.nodeValue);
						}
					}
					if (!xml.attributes.length && !xml.firstChild) o = null;
				}
				else if (xml.nodeType==9) { // document.node
					o = X.toObj(xml.documentElement);
				}
				else {
				//alert("unhandled node type: " + xml.nodeType);
				}
				return o;
			},
			toJson: function(o, name, ind) {
				var json = name ? ("\""+name+"\"") : "";
				if (o instanceof Array) {
					for (var i=0,n=o.length; i<n; i++)
					o[i] = X.toJson(o[i], "", ind+"\t");
					json += (name?":[":"[") + (o.length > 1 ? ("\n"+ind+"\t"+o.join(",\n"+ind+"\t")+"\n"+ind) : o.join("")) + "]";
				}
				else if (o == null)
				json += (name&&":") + "null";
				else if (typeof(o) == "object") {
					var arr = [];
					for (var m in o)
					arr[arr.length] = X.toJson(o[m], m, ind+"\t");
					json += (name?":{":"{") + (arr.length > 1 ? ("\n"+ind+"\t"+arr.join(",\n"+ind+"\t")+"\n"+ind) : arr.join("")) + "}";
				}
				else if (typeof(o) == "string")
				json += (name&&":") + "\"" + o.toString() + "\"";
				else
				json += (name&&":") + o.toString();
				return json;
			},
			innerXml: function(node) {
				var s = "";
				if ("innerHTML" in node)
				s = node.innerHTML;
				else {
					var asXml = function(n) {
						var s = "";
						if (n.nodeType == 1) {
							s += "<" + n.nodeName;
							for (var i=0; i<n.attributes.length;i++)
							s += " " + n.attributes[i].nodeName + "=\"" + (n.attributes[i].nodeValue||"").toString() + "\"";
							if (n.firstChild) {
								s += ">";
								for (var c=n.firstChild; c; c=c.nextSibling)
								s += asXml(c);
								s += "</"+n.nodeName+">";
							}
							else
							s += "/>";
						}
						else if (n.nodeType == 3)
						s += n.nodeValue;
						else if (n.nodeType == 4)
						s += "<![CDATA[" + n.nodeValue + "]]>";
						return s;
					};
					for (var c=node.firstChild; c; c=c.nextSibling)
					s += asXml(c);
				}
				return s;
			},
			escape: function(txt) {
				return txt.replace(/[\\]/g, "\\\\")
				.replace(/[\"]/g, '\\"')
				.replace(/[\n]/g, '\\n')
				.replace(/[\r]/g, '\\r');
			},
			removeWhite: function(e) {
				e.normalize();
				for (var n = e.firstChild; n; ) {
					if (n.nodeType == 3) {  // text node
						if (!n.nodeValue.match(/[^ \f\n\r\t\v]/)) { // pure whitespace text node
							var nxt = n.nextSibling;
							e.removeChild(n);
							n = nxt;
						}
						else
						n = n.nextSibling;
					}
					else if (n.nodeType == 1) {  // element node
						X.removeWhite(n);
						n = n.nextSibling;
					}
					else                      // any other node
					n = n.nextSibling;
				}
				return e;
			}
		};
		if (xml.nodeType == 9) // document node
		xml = xml.documentElement;
		var json = X.toJson(X.toObj(X.removeWhite(xml)), xml.nodeName, "\t");

		//return "{\n" + tab + (tab ? json.replace(/\t/g, tab) : json.replace(/\t|\n/g, "")) + "\n}";
		//ԭ���Ƿ��ظ�ʽ�����ַ������Ҹ��ĳ�ֱ�Ӵ���� JSON �����ˣ���Ϊ�������Լ��ṩ�����ݣ�����ȷ����ȫ���Ӷ�����ʹ�����ݵ� eval�����ѱ�����д�� eval �Ĳ������Ҫʹ�����µ�д������ eval �Ĳ����ַ��������š�
		var obj = eval('({' + json + '})');
		return obj;
	},
	//���л� JSON ����Ϊ�ַ���
	obj2str : function(o)
	{
		var r = [];
		if(typeof o =="string")
		{
			return '"'+o.replace(/([\'\"\\])/g,"\\$1").replace(/(\n)/g,"\\n").replace(/(\r)/g,"\\r").replace(/(\t)/g,"\\t")+'"';
		}
		if(typeof o == "object")
		{
			if(!o.sort)
			{
				for(var i in o)
				{
					r.push(i+":"+this.obj2str(o[i]));
				}
				if(document.all && !/^\n?function\s*toString\(\)\s*\{\n?\s*\[native code\]\n?\s*\}\n?\s*$/.test(o.toString))
				{
					r.push("toString:"+o.toString.toString());
				}
				r="{"+r.join()+"}";
			}
			else
			{
				for(var i =0;i<o.length;i++)
				{
					r.push(this.obj2str(o[i]))
				}
				r="["+r.join()+"]";
			}
			return r;
		}
		return o.toString();
	},

	/**
	* ��ȡ cookie
	* cookieName, cookie ����
	*/
	getCookie:function(cookieName)
	{
		var allcookies = document.cookie;
		//alert(allcookies);
		//��ȡ����  bbsSearch=%E8%81%94%E6%83%B3; �� cookie ֵ��Ҫ���ַ������ʾһ�� \���͵�д \\��ע��������Ǳ�վΨһ�� cookie��ȡȫ�� cookie �ַ���ʱ��û�н�β�� ;������Ҫ�� ;?��
		var reCookieExtract = new RegExp(cookieName+'=(\\S+);?');
		//var arrHistory = [];
		var historyBbs = '';
		var arrMatch ;
		//alert(reCookieExtract.exec(allcookies));
		if (arrMatch = reCookieExtract.exec(allcookies))
		{
			historyBbs = decodeURIComponent(arrMatch[1]);
		}
		return historyBbs ;
	},
	/**
	���� cookie���˷�������� URI ����ͽ��룬���Դ���������ñ��롣
	Ҫ��� cookie���� daysToLive  ��Ϊ 0��

	cookieName, cookie ����
	str	cookie ���ݣ�
	daysToLive cookie ��Ч�ڣ�Ĭ��Ϊ 30 �죬��Ϊ 0 ʱ��� cookie
	path	·����Ĭ��Ϊ��ǰ·��
	domain	������Ĭ��Ϊ��ǰ����
	secure	�Ƿ�ȫ
	*/
	setCookie:function(cookieName, str, daysToLive, path, domain, secure)
	{
		var cookie = cookieName + '=' + encodeURIComponent(str);
		if (daysToLive || daysToLive == 0) {
			cookie += "; max-age=" + (daysToLive*24*60*60);
		}

		if (path) {
			cookie += "; path=" + path;
		}

		if (domain) {
			cookie += "; domain=" + domain;
		}
		if (secure) {
			cookie += "; secure";
		}
		document.cookie = cookie;
	},
	//���� IE �� FF ���¼�ע�ᡣ��û�õ�ע���¼����Ȳ�д�ˡ�
	eventAdd: function(element, eventType, handler)
	{
		if (document.addEventListener)
		{
			element.addEventListener(eventType, handler, false);
		}
		else if (document.attachEvent)
		{
			element.attachEvent("on" + eventType, handler);
		}
	},
	containNode:function(container, node)
	{
		//��� button ������� tag �ڵ㣬ֱ�ӷ���
		if (container == node)
		{
			return true;
		}
		//������������ң��ҵ������tag �ڵ�ֹͣ
		else
		{
			while(node = node.parentNode)
			{
				if (container == node)
				{
					return true;
				}
			}
		}
	}

};


var SFXHR = function(url, method, params, onComplete, onFailure, loading) {
	//var xhr;
	var me = this;
	var getHTTPObject = function() {
		var xmlhttp = false;
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else if(window.ActiveXObject) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}
		return xmlhttp;
	};

	var completeRequest = function() {
		if (me.XHR.readyState == 4)	{
			if (me.XHR.status == 200 || me.XHR.status == 304)	{
				if (onComplete)		{
					onComplete(me.XHR);
				}
			}
			else
			{
				if (onFailure)  {
					onFailure(me.XHR)
				};
			}
		}
	};

	var process = function()  {
		if (loading)
		{
			loading();
		}
		var query = '';
		for (var i in params)
		{
			//query+= i + '='+escape(params[i]) + '&';
			//query+= i + '='+encodeURIComponent(params[i]) + '&';
			query+= i + '='+params[i] + '&';
		}
		me.XHR.onreadystatechange = completeRequest;
		if ('post'==me.method)
		{
			me.XHR.open("POST", url, true);
			me.XHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			me.XHR.send(query);
		}
		else
		{
			url += '?'+ query + 'random='+Math.random();
			me.XHR.open("GET", url, true);
			me.XHR.send(null);
		}
	};
	me.XHR = getHTTPObject();
	me.method = ('get' == method.toLowerCase()) ? 'get':'post';
	process();

};