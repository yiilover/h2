/*
 *
 * Copyright (c) 2005-2011, Letfind.com.cn
 *
 * Common.js	整站公用类
 * #Create by Mudoo 2011-12-15#
 *
 * Change:	Time         Author    Note
 * 			----------   -------   -------------------------------------------
 *			2011.12.21   Mudoo     * 调整公用JS CSS为动态加载
 *			2011.12.25   Mudoo     + 验证码调用
 *			2012.1.5     Mudoo     + 表单验证、随机数获取等函数
 *			2012.2.10    Mudoo     + 邮箱自动完成功能，基于JQuery.AutoComplete
 *
 */
function Letfind() {
	var self = this;
	
	// 获取用户
	self.userInfo = function() {
		
	};
	
	// 验证码
	self.checkCode = function(e, t, d) {
		var $id = self.rand(5, 6);
		$(e).css("text-transform", "uppercase")
			.attr('autocomplete', 'off')
			.after('<span style="margin:0 5px" id="chkwrap_'+ $id +'"></span>');
		
		if(d) {
			self.checkCode.domain = 'http://'+ d +'.letfind.com.cn'
		}
		
		if(!t) {
			$(e).one('focus', function(){
				self.checkCode.init(e, $id);
			});
			$('#chkwrap_'+ $id).html('<a href="#" onclick="$(\''+e+'\').focus(); return false;">点击获取验证码</a>');
		}else{
			self.checkCode.init(e, $id);
		}
	};
	self.checkCode.domain = '';
	self.checkCode.init = function(e, id) {
		$('#chkwrap_'+ id).html('<a href="#" onclick="return lf.checkCode.update(\''+ e +'\', \''+ id +'\');"><img id="chkimg_'+ id +'" src="about:blank" style="vertical-align:middle" /></a> <a href="#" onclick="return lf.checkCode.update(\''+ e +'\', \''+ id +'\');">看不清？换一组</a>');
		self.checkCode.update(e, id);
		return false;
	};
	self.checkCode.update = function(e, id) {
		$('#chkimg_'+ id).attr('src', self.checkCode.domain +'/extend/checkcode.asp?r='+ Math.random());
		$(e).select().focus();
		return false;
	};
	
	// 统计输入字数
	self.inputStat = function(e, m, s) {
		$(e).bind('propertychange', function() {
			stat();
		}).bind('input', function() {
			stat();
		});
		stat();
		
		function stat() {
			var $e = $(e);
			var $len = 0;
			if($e.length>0) {
				$len = $e.val().length;
			}
			$(s).html(m-$len);
		}
	};
	
	// 表单验证
	self.validate = function(e, r, s, m, a) {
		var inited = false;
		
		self.load('http://img.letfind.com/base/js/jquery.validate.js', function(){
			set();
		});
		
		// 设置
		set = function() {
			if(!e || typeof r!='object') return;
			
			var V = $(e).validate({
				debug : false,
				errorClass : 'v_error',
				validClass : 'v_valid',
				errorElement: function(element, line) {
					return (element.next().length>0 && line? 'div' : 'span');
				},
				errorPlacement: function(error, element) {
					if(s==false) return false;
					
					if(a) {
						element.after(error);
					}else{
						var $e = element.parent();
						if($e.is('label')) $e = $e.parent();
						$e.append(error);
					}
				},
				success: function(box, element) {
					if(s==false) return false;
					box.html('&nbsp;').addClass('v_success');
					//box.remove();
				},
				rules : r,
				messages : m
			});
			
			return V;
		};
	};
	
	// 动态加载
	self.load = function(p, o) {
		var dl = new DynamicLoad();
		if(typeof(o)=='function') {
			if(typeof(p)=='string') {
				dl.LoadedCallback = o;
			}else{
				dl.DoneCallback = o;
			}
		}else{
			for(var t in o){
				if(t=='onload') {
					dl.LoadedCallback = o[t];
				}else if(t=='onerror') {
					dl.FailedCallback = o[t];
				}else if(t=='ondone') {
					dl.DoneCallback = o[t];
				}else{
					dl[t] = o[t];
				}
			}
		}
		
		dl.Load(p);
	}
	
	// 随机数
	self.rand = function(m, n) {
		var $str = '', $return = '';
		var $str_arr = [
			"ABCDEFGHIJKLMNOPQRSTUVWXYZ",
			"abcdefghijklmnopqrstuvwxyz",
			"0123456789"
		];
		
		if(m<=2) {
			$str = $str_arr[m];
		}else if(m==3) {
			$str = $str_arr[0]+$str_arr[2];
		}else if(m==4){
			$str = $str_arr[1]+$str_arr[2];
		}else{
			$str = $str_arr.join('');
		}
		
		for (i=0;i<n;i++) {
			$return += $str.substr(Math.round(Math.random()*($str.length-1)), 1);
		}
		return($return);
	};

	// 邮箱自动完成
	self.autoMail = function(e) {
		var $mailExt = ['', '@qq.com', '@163.com', '@126.com', '@sina.com', '@gmail.com', '@hotmail.com', '@sohu.com', '@yahoo.cn', '@yahoo.com.cn', '@139.com', '@msn.com'];
		self.load('http://img.letfind.com/base/js/jquery.autocomplete.js', function() {
			$(e).autocomplete($mailExt, {
				scrollHeight: 300,
				formatData: function(row, q) {
					var $val = row.value=='' ? q : q.split('@')[0];
					var $data = {
						value: $val + row.value,
						data: (typeof row.data == "string") ? [$val + row.data] : [$val + row.data[0]],
						result: $val + row.result
					}
					return $data;
				}
			});
		});
	};
	
	// 复选框选择
	self.select = function(s, t, w) {
		var chks = w ? $(s+' :checkbox') : $(":checkbox[name='"+ s +"']");
		var chked = chks.find(':checked');
		var chkval = false;
		
		chks.each(function() {
			chkval = $(this).attr("checked");
			
			switch(t) {
				case 1 :
					chkval = true;
					break;
				case 0 :
					chkval = !chkval;
					break;
				//case -1 :
				default :
					chkval = false;
					break;
			}
			
			$(this).attr("checked", chkval);
		});
	};
	
	// IM即时通讯连接
	self.im = function(im, sp, e) {
		if(!im || im=='') return;
		
		var $arr = [],
		$arrim = null,
		$imitem = null,
		$im = {
			'qq' : '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={im}&site=qq&menu=yes"><img border="0" src="http://img.letfind.com/base/images/qq.gif" alt="点击这里给我发消息" title="点击这里给我发消息"></a>'
		},
		$sp = sp ? sp : '';
		$t = '',
		$n = '';
		
		$arrim = im.split(',');
		for(var i in $arrim) {
			$imitem = $arrim[i].split(':');
			$t = $imitem[0].trim();
			$n = $imitem[1].trim();
			if($im[$t]) {
				$arr.push($im[$t].replace(/{im}/gi, $n));
			}
		}
		
		if(!e) e = document.body;
		$(e).append($arr.join($sp));
	};
	
	// 城市选择器
	self.CityBox = function(e, c) {
		var box = null,
		bind = null,
		inited = false,
		$ipt_id = null,
		$ipt_name = null,
		$a_hint = null;
		
		$(e).each(function() {
			var $tmp = $(this);
			if($(this).is('input:hidden')) $ipt_id = $tmp;
			if($(this).is('input:text')) $ipt_name = $tmp;
			if($(this).is('a')) $a_hint = $tmp;
		});
		
		if($ipt_id==null) return;
		
		if(typeof(c)!='function') {
			c = function(){}
		}
		
		// 初始化
		self.load('http://img.letfind.com/base/boxy/boxy.js', function() {
			$ipt_name.focus(show);
			$a_hint.click(show);
			bind = $ipt_id[0];
		});
		
		function getBox() {
			if(!box) box = Boxy.linkedTo(bind);
			return box;
		}
		
		function show() {
			if (inited) {
				getBox();
				box.show();
			}else{
				Boxy.load("/citylist.asp", {
					title:"选择城市",
					actuator:bind,
					cache:true,
					behaviours:function(e){
						$('#CityList a', e).bind('click', select);
						inited = true;
					}
				});
			}
			return false;
		}
		
		function select(e) {
			getBox();
			if(!box) return true;
			
			c(this);
			
			box.hide();
			return false;
		}
	};
	
	// 编辑器控件（CKEditor）
	self.editor = function(e, c) {
		if(!c) c={};
		var $c = 0;
		self.load('http://img.letfind.com/base/ckeditor/ckeditor.js', {
			charset : 'utf-8',
			ondone : function() {
				CKEDITOR.replace(e, c);
			}
		});
	};
	
	// 图片路径（统一到file域）
	self.filePath = function(f, s) {
		f = f.toLowerCase();
		if(!f || f=='noimg') {
			return 'http://img.letfind.com/base/images/nopic.jpg';
		}else if(f=='noface'){
			s = s.split('x')[0];
			if(s!='200' && s!='120' && s!='50') s='120'
			return 'http://img.letfind.com/base/images/noface_'+ s +'.jpg'
		}
	
		var ImgExt = "jpeg,gif,png,bmp,jpg";
		var Ext='';
		
		f = f.replace(/\\/g, '/').toLowerCase();
		
		if (f.indexOf("://")!=-1){
			if (f.indexOf("letfind.com")==-1) return f;
			f = f.replace(/.*?:\/\/.*?\//, '/');
		}
		
		if(f.substr(0,1)!='/') f = '/'+f;
		Ext = f.substr(f.lastIndexOf(".")+1);
		
		f = f.replace( "/house/uploadfile/", "/house/");
		f = f.replace( "/newhouse/uploadfiles/", "/newhouse/");
		f = f.replace( "/shop/uploadfiles", "/shop/");
		f = f.replace( "/forum/attachments/", "/forum/");
		f = f.replace( "/uploadfiles/", "/");
		f = f.replace( "/uploadface/", "/face/");
		
		if (ImgExt.indexOf(Ext)!=-1 && s){
			f = f.replace( '.'+Ext, '_'+s+'.'+Ext);
		}
		
		return "http://file.letfind.com"+f;
	}
	
	// 上传控件（Uploadify）
	self.upload = function(i) {
		if(!i || typeof(i)!='object') return;
		
		self.load(['js/swfobject.js', 'uploadify/uploadify.js', 'boxy/boxy.js'], {
			path : 'http://img.letfind.com/base/',
			ondone : init
		});
		
		function init() {
			i = $.extend({
				ext : '*.bmp;*.jpg;*.jpeg;*.gif;*.png',
				size : 1024*1024*2,
				data : {}
			}, i);
			if(!i.desc) {
				i.desc = '文件类型('+ i.ext +')';
			}
			
			var hintMsg = {
				"120" : "上传失败：表单设置错误",
				"121" : "上传失败：请选择要上传的文件",
				"122" : "上传失败：单次上传文件总大小超过限制",
				"123" : "上传失败：上传文件大小超过限制",
				"124" : "上传失败：受限制的内容或格式"
			};
			
			var errMsg = {
				"120" : "表单",
				"121" : "空文件",
				"122" : "总大小",
				"123" : "大小",
				"124" : "内容或格式"
			}
			
			// 使用Boxy显示上传进度
			var uBox = null;
			if(!i.queue) {
				uBox = new self.uploadBox(i.id);
				i.queue = uBox.id;
			}
			
			$(i.id).uploadify({
				'script'		: 'http://upload.letfind.com.cn/extend/upload.asp?from=uploadify&type='+ i.type +'&path='+ i.path,
				'fileDesc'		: i.desc,
				'fileExt'		: i.ext,
				'sizeLimit'		: i.size,
				'multi'			: (!!i.multi),
				'auto'			: (!!i.auto),
				'queueID'		: i.queue,
				'scriptData'	: i.data,
				'onSelect'		: function() {
					var args = arguments;
					if(i.select) {
						i.select(args);
					}
				},
				'onSelectOnce'	: function() {
					var args = arguments;
					if(uBox) {
						uBox.select(args);
					}
					if(i.selectOnce) {
						i.selectOnce(args);
					}
				},
				'onQueueFull'	: function() {
					return false;
				},
				'onError'		: function() {
					var args = arguments;
					if(uBox) {
						uBox.error(args);
					}
					if(i.error) {
						i.error(args);
					}
				},
				'onComplete'	: function() {
					var args = arguments;
					var err = false;
					var data;
					//alert(args[3]);
					try{
						data = jQuery.parseJSON(args[3]);
					}catch(e){}
					
					if(typeof(data)!='object') {
						alert((hintMsg[args[3]] || args[3]));
						return false;
					}else{
						if(data.Filedata.state!=0) {
							try{
								$(args[0].target).trigger('uploadifyError', [args[1], args[2], {type:(errMsg[data.Filedata.state] || data.Filedata.state), info:(hintMsg[data.Filedata.state] || data.Filedata.state)}]);
							}catch(e){
								alert('catch: '+ e);
							}
							//alert(hintMsg[data.Filedata.state]);
							return false;
						}else{
							if(i.complete) {
								i.complete(args[0].target, data);
							}
						}
					}
				},
				'onAllComplete'	: function() {
					var args = arguments;
					if(uBox) {
						uBox.done(args);
					}
					if(i.done) {
						i.done(args);
					}
				},
				'onCancel' : function() {
					var args = arguments;
					if(uBox) {
						uBox.cancel(args);
					}
					if(i.cancel) {
						i.cancel(args);
					}
				},
				'onClearQueue' : function() {
					var args = arguments;
					if(i.clear) {
						i.clear(args);
					}
				},
				'onSWFReady' : function() {
					var args = arguments;
					if(i.ready) {
						i.ready(args);
					}
				}
			});
		}
	};
	
	// Boxy上传进度
	self.uploadBox = function(e) {
		var my = this;
		my.e = $(e);
		/*
		my.box = Boxy.alert(
			'<div id="uploadProgress_'+ my.e.attr('id') +'" class="uploadifyBoxy"></div>', function(a) {
				
			},{
				title : '文件上传中，请稍后...',
				actuator : my.e[0],
				show : false,
				modal : true,
				closeable : true,
				unloadOnHide : false,
				afterHide : function() {my.clear()}
		});
		*/
		my.box = new Boxy(
			'<div id="uploadProgress_'+ my.e.attr('id') +'" class="uploadifyBoxy"></div>',
			{
				title : '文件上传中，请稍后...',
				actuator : my.e[0],
				show : false,
				modal : true,
				//closeable : true,
				unloadOnHide : false,
				afterHide : function() {my.clear()}
		});
	
		my.id = 'uploadProgress_'+ my.e.attr('id');
		my.cont = $('#'+ my.id);
		
		// 统计
		my.total = function() {
			var queueCount = $('.uploadifyQueueItem', my.cont).length;
			var errCount = $('.uploadifyError', my.cont).length;
			
			return [queueCount, errCount];
		};
		
		// 选择
		my.select = function(args) {
			var total = my.total();
			my.display(true);
			my.enable(total[0]==total[1]);
		};
		
		// 错误
		my.error = function(args) {
			var total = my.total();
			my.enable(total[0]-1==total[1]);
		};
		
		// 删除
		my.cancel = function(args) {
			var total = my.total();
			my.display(total[0]>1);
		};
		
		// 完成
		my.done = function(args) {
			var total = my.total();
			my.display(total[1]>0);
			my.enable(true);
		};
		
		// 清除
		my.clear = function() {
			//$('.uploadifyQueueItem', my.cont).remove();
			my.e.uploadifyClearQueue();
		};
		
		// 显示
		my.display = function(s) {
			if(s) {
				my.box.show();
				my.box.center();
			}else{
				my.box.hide();
			}
		};
		
		// 可用状态
		my.enable = function(s) {
			var btn = my.box.getInner().find('a.close');
			if(s) {
				btn.show();
			}else{
				btn.hide();
			}
			my.e.uploadifySettings('enabled', s);
		};
	};

	// 获取IP地址
	// var remote_ip_info = {"ret":1,"start":"120.35.2.59","end":"120.35.63.255","country":"\u4e2d\u56fd","province":"\u798f\u5efa","city":"\u798f\u5dde","district":"","isp":"\u7535\u4fe1","type":"","desc":""};
	self.ip = function(e, ip, f) {
		var $port = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js';
		$port += ip ? '&ip='+ip : '';
		var $str = f ? f : '{province} {city} {isp}';
		$.get($port,'',function(){
			if(remote_ip_info.ret!=1) return;
			for(var t in remote_ip_info) {
				$str = $str.replace('{'+ t +'}', remote_ip_info[t]);
			}
			
			$(e).html($str);
		}, 'script');
	};
	
	// 禁止复制
	self.nocopy = function(e) {
		$(e).each(function(i){});
	};

	// 统计代码
	self.stat = function() {
		var $url = window.location.href;
		//if($url.indexOf('letfind.com.cn')>-1) {
		//	self.load('http://hm.baidu.com/h.js?7d4dab51e487cbf4f2b2be0d9dea5692');
		//}else{
			self.load('http://hm.baidu.com/h.js?0799576f4be130eee97079a934946629');
		//}
		// 51统计
		//self.load('http://js.users.51.la/1163530.js');
	};
	
	// 分享代码
	self.share = function() {
		// Baidu Share
		var $html = '<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare" style="position:absolute; top:120px; width:40px; left:50%; margin-left:501px; z-index:9999">'+
				'<span style="padding-left:2px">分享到</span>'+
				'<a class="bds_qzone"></a>'+
				'<a class="bds_tqq"></a>'+
				'<a class="bds_tsina"></a>'+
				'<a class="bds_renren"></a>'+
				'<a class="bds_kaixin001"></a>'+
				'<a class="bds_baidu"></a>'+
				'<a class="bds_douban"></a>'+
				'<span class="bds_more" style="text-indent:-1000em">更多</span>'+
				'<a class="shareCount"></a>'+
			'</div>';
		
		$(document.body).append($html);
		
		var $script = document.createElement('script');
		$script.setAttribute('type', 'text/javascript');
		$script.setAttribute('id', 'bdshare_js');
		//$script.setAttribute('data', 'type=tools&amp;mini=1&amp;uid=382423');
		$script.setAttribute('data', 'type=tools&amp;uid=382423');
		document.getElementsByTagName("head")[0].appendChild($script);
		
		//self.load('http://bdimg.share.baidu.com/static/js/shell_v2.js?t='+ new Date().getHours());
		self.load('http://share.baidu.com/static/js/shell_v2.js?cdnversion='+ new Date().getHours())
		self.share.init();
	};
	self.share.init = function() {
		var
		container = $('#bdshare'),
		minTop = 5,
		//maxTop = parseInt(container.css('top'), 10);
		maxTop = 120;
		
		$(window).scroll(function() {
			var scrollT = document.body.scrollTop + document.documentElement.scrollTop;
			if (maxTop - scrollT < minTop) {
				container.css('top', minTop + scrollT);
			} else {
				container.css('top', maxTop);
			}
		});	
	};
	
	// 友荐推荐
	self.ujian = function() {
		self.load('http://v1.ujian.cc/code/ujian.js?type=slide&uid=1562560');
	};
	
	// 调试
	self.debug = function(msg, type) {
		if(!window.console) return;
		if(!self.debug.inited) self.debug.init();
		if(!msg || msg=='') return;
		type = type || 'log';
		msg = '['+ type.toUpperCase() +'] - '+ msg;
		try{
			self.debug[type](msg);
		}catch(e) {
			alert(e);
		}
	};
	self.debug.init = function() {
		//return;
		self.debug.log = window.console.log || function(){};
		self.debug.warn = window.console.warn || function(){};
		self.debug.error = window.console.error || function(){};
		self.debug.info = window.console.info || function(){};
		self.debug.debug = window.console.debug || function(){};
		self.debug.inited = true;
	};
}

// 动态加载类
function DynamicLoad(){var b=this;this.path="";this.list=[];this.charset="";this.loaded=[];this.error=[];this.Load=function(e){var c="";if(typeof(e)=="string"){b.list.push(e)}else{b.list=e}for(var a in b.list){c=b.getPath(b.list[a]);if(b.isLoaded(c)){b.onLoaded(c);return}else{b.__load(c)}}};this.__load=function(e){var a;var f=b.getSrcType(e);if(f=="js"||f=="vbs"){a=document.createElement("script");a.src=e;if(b.charset&&b.charset!=""){a.charset=b.charset}if(f=="js"){a.type="text/javascript";a.language="javascript"}else{a.type="text/vbscript";a.language="vbscript"}}else{if(f=="css"){a=document.createElement("link");a.rel="stylesheet";a.type="text/css";a.href=e}else{b.onFailed(e);return}}document.getElementsByTagName("head")[0].appendChild(a);a.onload=a.onreadystatechange=function(){if(this.readyState&&this.readyState=="loading"){return}else{b.onLoaded(e);this.onload=this.onreadystatechange=null}};a.onerror=function(){document.getElementsByTagName("head")[0].removeChild(a);b.onFailed(e);this.onerror=null}};this.isLoaded=function(h){var i=false;var j=b.getSrcType(h);var k;if(j=="js"||j=="vbs"){var a=document.getElementsByTagName("script");for(k=0;k<a.length;k++){if(a[k].src&&a[k].src.indexOf(h)!=-1){if(a[k].readyState=="loaded"||a[k].readyState=="complete"){i=true;break}}}}else{if(j=="css"){var l=document.getElementsByTagName("link");for(k=0;k<l.length;k++){if(l[k].href&&l[k].href.indexOf(h)!=-1){if(l[k].readyState=="loaded"||l[k].readyState=="complete"||l[k].readyState=="interactive"){i=true;break}}}}}return i};this.getSrcType=function(g){var a="";var f=g.lastIndexOf(".");if(f!=-1){a=g.substr(f+1)}var e=a.lastIndexOf("?");if(e!=-1){a=a.substr(0,e)}return(a=="js"||a=="vbs"||a=="css")?a:"js"};this.getPath=function(c){var a="";if(b.path&&b.path!=""){a=b.path;if(/.*\/$/.test(a)==false){a+="/"}}return a+c};this.onLoaded=function(a){b.loaded.push(a);b.LoadedCallback(a);if((b.loaded.length+b.error.length)==b.list.length){b.onDone()}};this.LoadedCallback=function(a){};this.onDone=function(){b.DoneCallback(b.list,b.loaded,b.error)};this.DoneCallback=function(c,a,d){};this.onFailed=function(a){b.error.push(a);b.FailedCallback(a);if((b.loaded.length+b.error.length)==b.list.length){b.onDone()}};this.FailedCallback=function(a){}}function testLoad(c,d){var a=new DynamicLoad();if(typeof(d)=="function"){if(typeof(c)=="string"){a.LoadedCallback=d}else{a.DoneCallback=d}}else{for(var b in d){if(b=="onload"){a.LoadedCallback=d[b]}else{if(b=="onerror"){a.FailedCallback=d[b]}else{if(b=="ondone"){a.DoneCallback=d[b]}else{a[b]=d[b]}}}}}a.Load(c)};

// Cookies类
var cookie=function(d,e,b){b=b||{};if(arguments.length>1&&String(e)!=="[object Object]"){if(e===null||e===undefined){b.expires=-1}if(typeof b.expires==="number"){var g=b.expires,c=b.expires=new Date();c.setDate(c.getDate()+g)}e=String(e);return(document.cookie=[escape(d),"=",b.raw?e:escape(e),b.expires?"; expires="+b.expires.toUTCString():"",b.path?"; path="+b.path:"; path=/",b.domain?"; domain="+b.domain:"",b.secure?"; secure":""].join(""))}b=e||{};var a,f=b.raw?function(h){return h}:unescape;return(a=new RegExp("(?:^|; )"+escape(d)+"=([^;]*)").exec(document.cookie))?f(a[1]):null};

// 增强函数继承
/*
 * 去除多余空格函数
 * trim:去除两边空格 ltrim:去除左空格 rtrim: 去除右空格
 */
String.prototype.trim = function(m) {
	var p = /^[\s\t]+|[\s\t]+$/g;
	if(m=='l') p=/^[\s\t]+/g;
	if(m=='r') p=/[\s\t]+$/g;
	return this.replace(p, '');
}
String.prototype.ltrim = function() {
	return this.replace(/^[\s\t]+/g, "");
}
String.prototype.rtrim = function() {
	return this.replace(/[\s\t]+$/g, "");
}

/*
 * 背投广告，支持重播
 */
function projectionAD() {
	$('.projection-ad').each(function(){
		var $this = $(this),
			delay = 3000,
			$replay = $this.find('.projection-ad-replay').click(init),
			to = parseInt(($replay.attr('timeout')||5000)/1000),
			toStart = to,
			replayText = $replay.text(),
			$close = $this.find('.projection-ad-close').click(close),
			$preview = $this.find('.projection-ad-preview').click(init),
			$content = $this.find('.projection-ad-content'),
			_t;
		
		function init(){
			if($replay.hasClass('countdown')){
				return;
			}
			$this.show();
			to = toStart;
			$replay.text(to).addClass('countdown');
			if($preview.length>0) {
				$preview.slideUp('normal',function(){
					$content.slideDown('slow',countdown);
				});
			}else{
				$content.slideDown('slow',countdown);
			}
		}
		
		function close(){
			clearInterval(_t);
			if($preview.length>0) {
				$preview.slideDown('normal',function(){
					$content.slideUp('slow',function(){
						$replay.text(replayText).removeClass('countdown');
					});
				});
			}else{
				$content.slideUp('slow',function(){
					$replay.text(replayText).removeClass('countdown');
				});
			}
		}
		
		function countdown(){
			_t = setInterval(function(){
				to--;
				$replay.text(to);
				if(to<=0){
					close();
				}
			},1000);
		}
		setTimeout(init,delay);
	});
	
	$(".lazyImage").each(function() {
		var self = $(this),
		_src = self.attr("lzsrc");
		self.attr({
			"src" : _src
		})
	});
}

// 广告嵌入
function siteAD() {
	var $ad = "<!-- 背投广告 Start -->"+
		"<div class='projection-ad'><a href='javascript:;' timeout='10000' class='projection-ad-replay' hidefocus>重播</a><div class='projection-ad-content'></div><div class='projection-ad-content' ><a href='javascript:;' class='projection-ad-close' hidefocus></a><a href='http://zt.letfind.com.cn/20130508kanfang/' target='_blank'><img width='948' height='300' class='lazyImage' lzsrc='http://file.letfind.com/2013-05/2013051314473071.jpg'/></a></div></div>"+
		"<!-- 背投广告 End -->";
	
	$ad = '<div style="margin-top:8px"><a href="http://zt.letfind.com.cn/20130508kanfang/" target="_blank"><img src="http://file.letfind.com/2013-05/20130515165603678.gif" /></a></div>';
	
	var $host = self.location.href;
	
	if($('div.projection-ad').length>0) {
		projectionAD();
		return;
	}
	
	// 福州二手房
	if(/sale\.letfind\.com\.cn/gi.test($host)) {
		$('#topbg_common + div.wrapper').append($ad);
	// 新闻详细页
	}else if(/news\.letfind\.com\.cn\/news\/[\d-]+\/\d+\.html/gi.test($host)) {
		$('#topbg_common ~ div.ADtopwrap').append($ad);
	// 楼盘详细页
	}else if(/newhouse\.letfind\.com\.cn\/[a-z]+\d+\.html/gi.test($host)) {
		$('#daohanglm_lp').before($ad);
	}
	
	projectionAD();
}

// 初始化
var lf = new Letfind();
$(document).ready(function(){
//	lf.load(['style/common.css', 'blackbird/blackbird.js'], {
//		path : 'http://img.letfind.com/base/'
//	});
	lf.load(['style/common.css'], {
		path : 'http://img.letfind.com/base/',
		ondone : function() {
			//siteAD();
		}
	});
	
	/*
	var $tip = '<div style="padding:10px 0; background:#fff8f1; border-bottom:solid 1px #e7b787; font-size:12px; font-weight:bold; color:#ed3801; text-align:center">注意：猎房网将于2013-03-13（星期三）18:00至19:00进行服务器维护升级，届时网站将无法访问，给您带来不便，敬请谅解。</div>';
	$(document.body).prepend($tip);
	*/
});
