<?php
echo '
<!doctype html>
<html>
	<head>
		<meta charset="GBK" />
		<title>';echo L('house5_logon');echo '</title>
		<meta name="robots" content="noindex,nofollow">
		<link href="';echo IMG_PATH;echo 'admin_img/css/admin_login.css?v20130107" rel="stylesheet" />
		<script>
			if (window.parent !== window.self) {
					document.write = \'\';
					window.parent.location.href = window.self.location.href;
					setTimeout(function () {
							document.body.innerHTML = \'\';
					}, 0);
			}
		</script>
	</head>
<body>
	<div class="wrap">
		<h1><a href="';echo APP_PATH;echo '">house5 ��̨��������</a></h1>
		<form method="post" name="login" action="index.php?s=admin/index/login&dosubmit=1" autoComplete="off">
			<div class="login">
				<ul>
					<li>
						<input class="input" id="J_admin_name" required name="username" type="text" placeholder="�ʺ���" title="�ʺ���" />
					</li>
					<li>
						<input class="input" id="admin_pwd" type="password" required name="password" placeholder="����" title="����" />
						<input type="hidden" name="gotopage" value="';if(!empty($gotopage)) echo $gotopage;;echo '" />
						<input type="hidden" name="dopost" value="login" />
					</li>
									</ul>
				<button type="submit" name="dosubmit" class="btn">��¼</button>
			</div></form>
	</div>

<script language="JavaScript">
<!--
	if(top!=self)
	if(self!=top) top.location=self.location;
//-->
</script>
<script>
;(function(){
	document.getElementById(\'J_admin_name\').focus();

	getVerifyTemp({wrap : $(\'#J_verify_code\')});

	function getVerifyTemp(options){
		//��֤��ģ��
		var _this = this,
			wrap = options.wrap,				//��֤������
			afterClick = options.afterClick,	//�����һ����ص�
			clone = options.clone;				//��ȡʧ�ܺ�ָ�����
		if(!wrap.length) {
			return;
		}

		wrap.html(\'<span class="tips_loading">��֤��loading</span>\');
		var url = \'http://localhost/phpwind9/admin.php?a=showVerify\';
		$.post(url, {
			csrf_token : GV.TOKEN
		}, function(data){
			if(data.state == \'success\') {
				wrap.html(data.data);
			}else if(data.state == \'fail\') {
				if(clone) {
					//�ָ�ԭ����
					wrap.html(clone.html());
				}else{
					//����
					wrap.html(\'<a href="#" role="button" id="J_verify_update_a">���»�ȡ</a>\');
				}

				alert(data.message);
				/*_this.resultTip({
					error : true,
					elem : $(\'#J_verify_update_a\'),
					follow : true,
					msg : data.message
				});*/
			}

		}, \'json\');

		wrap.off(\'click\').on(\'click\', \'#J_verify_update_a\', function(e){
			//��һ��
			e.preventDefault();

			if(wrap.find(\'.tips_loading\').length) {
				//����ε��
				return false;
			}

			var clone = wrap.clone();
			wrap.html(\'<span class="tips_loading">��֤��loading</span>\');
			getVerifyTemp({
				wrap : wrap,
				clone : clone
			});

			if(afterClick) {
				afterClick();
			}
		}).on(\'click\', \'#J_verify_update_img\', function(e){
			//���ͼƬ
			$(\'#J_verify_update_a\').click();
		});
	}
})();
</script>
</body>
</html>
';?>