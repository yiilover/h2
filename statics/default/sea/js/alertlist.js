define(function(require, exports, module) {
	var $ = require('jquery');
	var alertM = require('alert');
	var arr = ['<ul id="pricechange">', '<li><b>��Ѷ���', '������¥����Ϣ�ͼ۸�䶯֪ͨ����</b></li>', '<li>���������ֻ�������, ���', '������¥����Ϣ��۸�䶯, ���ǻ��һʱ��֪ͨ��.</li>', '<li><b>����', '�ķ�Դ��Ϣ�������ֻ�</b></li><li>�������յ�������Ϣ��</li><li class="gray9">', '</li>', '<li>��ѡ���ķ���:</li><li><input name="flagprice" id="flagprice" type="checkbox" style="width:20px;" value="1"><label for="flagprice">�۸�䶯֪ͨ</label><input name="flaginfo" id="flaginfo" type="checkbox" value="2"><label for="flaginfo">¥��������Ϣ</label></li>', '<li>����������Email��ַ:��<a href="javascript:void(0)" id="contact_tel">��Ҫ���ֻ�����</a>��</li><li><input type="text" name="email" id="email"></li>', '<li>�����������ֻ�����:</li><li><input type="text" name="mobile" id="dymobile"></li>', '<li>���������յ�����֤��:</li><li><input type="text" name="mobile" id="dyencode" style="width:50px">&nbsp;<a href="javascript:void(0)" class="dycheck">�����ѻ�ȡ��֤��</a></li>', '<li id="minfo"></li></ul>'];
	var mobileArr = ['<ul id="mobilea"></li><li>ϵͳ�Ⱥ��������ٽ�ͨ<b class="red">', '</b>�绰</li><li class="red">����ͨ�����</li><li>���ĵ绰����ʾ���� 010-**** ������</li><li>��δ�ɹ������Ժ����ԡ�</li><li>���������ĵ绰����:</li><li><input type="text" name="mobile" id="mpH"></li><li id="minfo">�绰��ʽ��0311********��138********</li></ul>'];
	var messageArr = ['<ul><li><span></span>�� <b class="red">', '</b> ����վ�ڶ���Ϣ</li><li><span>������</span><input type="text" id="uname"></li> <li><span>��ϵ��ʽ��</span><input type="text" id="ucon"></li> <li><span>��Ϣ���ݣ�</span><textarea id="utext"></textarea></li> <li id="minfo"></li>'];
	var favoriteArr = ['<ul><li><span></span><a target="_blank" href="', '" id="saveToDesk">���浽����</a></li> <li><span></span><a href="javascript:void(0)" id="saveToFav">��ӵ�������ղؼ�</a></li> <li><span></span><a href="javascript:void(0)" id="saveToCopy">���Ƶ�ǰҳ������</a></li><li id="minfo"></li></ul>']
	var reportArr = ['<form><input type="hidden" name="hid" value="', '" /> <ul style="padding:0 32px"> <li> <input type="radio" value="1" name="slt" id="slt_1" class="radio"> <label for="slt_1">�÷�Դ���ۻ򲻴���</label> </li> <li> <input type="radio" value="2" name="slt" id="slt_2" class="radio"> <label for="slt_2">�÷�Դ�ۼ���ʵ�ʼ۸����ز���</label> </li> <li> <input type="radio" value="3" name="slt" id="slt_3" class="radio"> <label for="slt_3">�÷�Դ��Ϣ��������Ƭ��ʵ�ʲ���</label> </li> <li> <b>��������ѡ�</b> </li> <li> <input type="text" name="wronginfo" id="wronginfo"></li> <li id="minfo"></li> </ul></form>']
	return {
		sendToMobile: function(name, info, hid, checkurl, murl) {
			alertM(arr[0] + arr[5] + name + arr[6] + info + arr[7] + arr[10] + arr[11] + arr[12], {
				title: "���ͷ�Դ��Ϣ���ֻ�",
				time: "y",
				width: 400,
				btnN: 1,
				btnYT: '����',
				yf: function() {
					var $m = $("#dymobile");
					var $e = $("#dyencode");
					var $i = $("#minfo");
					if(!/^1[3458]\d{9}$/.test($m.val())) {
						$i.html("����д��ȷ���ֻ������ʽ<br>��ʽ��138********");
						$m.focus();
					} else if($e.val() == "") {
						$i.html("����д��֤��");
						$e.focus();
					} else {
						$.ajax({
							url: murl,
							dataType: 'jsonp',
							data: {
								id: hid,
								mobile: $m.val(),
								encode: $e.val()
							}
						}).done(function(data) {
							if(data.state == "succ") alertM(data.alert, {
								cName: data.state
							})
							else $i.html(data.alert);
						}).fail(function() {
							$i.html("����ʧ��<br>�������������Ƿ��ѶϿ�");
						});
					}
					return false;
				}
			})
			var $m = $("#dymobile");
			var $i = $("#minfo");
			$("#pricechange").on("click", "a.dycheck", function() {
				var $t = $(this);
				if(!/^1[3458]\d{9}$/.test($m.val())) {
					$i.html("����д��ȷ���ֻ������ʽ");
					$m.focus();
				} else {
					$.ajax({
						url: checkurl,
						dataType: 'jsonp',
						data: {
							mobile: $m.val()
						}
					}).done(function(data) {
						if(data.state == "succ") {
							$t.attr("class", "dywaite").html("�ȴ�120����ٴε��");
							var i = 119;
							var setin = setInterval(function() {
								$t.html("�ȴ�" + i + "����ٴε��")
								if(--i < 0) {
									$t.attr("class", "dycheck").html("�����ѻ�ȡ��֤��");
									clearInterval(setin);
								}
							}, 999)
						}
						$i.html(data.alert);
					}).fail(function() {
						$i.html("��֤�뷢��ʧ��<br>�������������Ƿ��ѶϿ�");
					});
				}
			})
			$m.keydown(function(e) {
				if(e.which == 9 || e.which == 8) return;
				if(e.which < 48 || e.which > 105 || (e.which > 57 && e.which < 96)) return false;
			})
		},
		callMobile: function(name, hid, url) {
			alertM(mobileArr[0] + name + mobileArr[1], {
				title: '��ӭ�µ�<b class="red">' + name + "</b>",
				width: 400,
				time: "y",
				btnYT: '����',
				btnN: 1,
				yf: function() {
					var $mph = $("#mpH");
					var $i = $("#minfo");
					if(/^1[3458]\d{9}$|^0\d{2,3}\d{7,8}?$/.test($mph.val())) {
						$.ajax({
							url: url,
							dataType: 'text',
							data: {
								hid: hid,
								phone: $mph.val()
							}
						}).done(function(data) {
							$i.html(data);
						}).fail(function() {
							$i.html("�绰ת��ʧ��<br>�������������Ƿ��ѶϿ�");
						});
					} else $i.html("�绰��ʽ����<br>��ʽ��0311********��138********<br>����������")
					return 0
				}
			});
			$("#mpH").keydown(function(e) {
				if(e.which == 9 || e.which == 8) return;
				if(e.which < 48 || e.which > 105 || (e.which > 57 && e.which < 96)) return false;
			})
		},
		sendMessage: function(name, uid, url) {
			alertM(messageArr[0] + name + messageArr[1], {
				width: 420,
				title: "����վ�ڶ���Ϣ",
				time: "y",
				btnN: 1,
				yf: function() {
					var $n = $("#uname"),
						$c = $("#ucon"),
						$t = $("#utext"),
						$i = $("#minfo");
					$("#alertM").on("focus", "input,textarea", function() {
						$i.html("")
					})
					if($n.val() == "") $i.html("��������Ϊ��");
					else if($c.val() == "") $i.html("��ϵ��ʽ����Ϊ��");
					else if($t.val() == "") $i.html("��Ϣ���ݲ���Ϊ��");
					else {
						$.ajax({
							url: url,
							type: "POST",
							dataType: 'jsonp',
							data: {
								uid: uid,
								name: $n.val(),
								contact: $c.val(),
								message: $t.val()
							}
						}).done(function(data) {
							if(data.state == "succ") alertM(data.alert, {
								cName: data.state
							});
							else $i.html(data.alert);
						}).fail(function() {
							$i.html("������Ϣʧ��<br>�������������Ƿ��ѶϿ�");
						});
					}
				}
			})
		},
		favorite: function(downurl) {
			require("copy");
			alertM(favoriteArr[0] + downurl + favoriteArr[1], {
				title: "�ղط�Դ��Ϣ",
				time: "y",
				btnN: 1,
				btnY: 0
			})
			var $i = $("#minfo");
			$("#saveToFav").click(function() {
				var sURL = window.location.href;
				var sTitle = document.title;
				try {
					window.external.addFavorite(sURL, sTitle);
				} catch(e) {
					try {
						window.sidebar.addPanel(sTitle, sURL, "");
					} catch(e) {
						$i.html("�����ղ�ʧ��<br>��ʹ��Ctrl+D�������");
					}
				}
			})
			setTimeout(function() {
				$("#saveToCopy").zclip({
					copy: window.location.href,
					afterCopy: function() {
						$i.html("���Ƴɹ�")
					}
				});
			}, 400)
		},
		report: function(hid, url) {
			alertM(reportArr[0] + hid + reportArr[1], {
				title: "�ٱ��÷�Դ��Ϣ",
				time: "y",
				btnN: 1,
				width: 400,
				yf: function() {
					var $c = $("#alertM :radio"),
						$t = $("#wronginfo"),
						$i = $("#minfo");
					$("#alertM").on("focus", "input", function() {
						$i.html("")
					})
					if(!$c.is(":checked") && $t.val() == "") $i.html("��������дһ��Ͷ�߾ٱ����ݣ�");
					else {
						$.ajax({
							url: url,
							type: "POST",
							dataType: 'jsonp',
							data: $("#alertM form").serialize()
						}).done(function(data) {
							if(data.state == "succ") alertM(data.alert, {
								cName: data.state
							});
							else $i.html(data.alert);
						}).fail(function() {
							$i.html("������Ϣʧ��<br>�������������Ƿ��ѶϿ�");
						});
					}
				}
			})
		}
	}
})