<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '		    
<script type="text/javascript" src="';echo JS_PATH;echo 'crop/swfobject.js"></script>
<script>
			// ��ȡҳ���ϵ�flashʵ����
			// @param flashID ��������ǣ�flash �� ID �������ӵ�flash ID�� "myFlashID" ���ڱ�ҳ������һ�� "myFlashID" �ɿ�����
			function getFlash(flashID) 
			{
				// �ж����������
				if (navigator.appName.indexOf("Microsoft") != -1) 
				{
					return window[flashID];
				} 
				else 
				{
					return document[flashID];
				}
			}
			
			// flash �ϴ�ͼƬ���ʱ�ص��ĺ�����
			function uploadComplete(pic)
			{
				
				if(parent.document.getElementById(\'';echo $_GET['input'];echo '\')) {
					var input = parent.document.getElementById(\'';echo $_GET['input'];echo '\');
				} else {
					var input = parent.right.document.getElementById(\'';echo $_GET['input'];echo '\');
				}
				';if (!empty($_GET['preview'])):;echo '				if(parent.document.getElementById(\'';echo $_GET['preview'];echo '\')) {
					var preview = parent.document.getElementById(\'';echo $_GET['preview'];echo '\');
				} else {
					var preview = parent.right.document.getElementById(\'';echo $_GET['preview'];echo '\');
				}
				';else:;echo '				var preview = \'\';
				';endif;;echo '				if(pic) {
					input.value = pic;
					if (preview) preview.src = pic;
				}
				window.top.art.dialog({id:\'crop\'}).close();
			}

			function uploadfile() {
				getFlash(\'myFlashID\').upload();
			}
            var swfVersionStr = "10.0.0";
            var xiSwfUrlStr = "';echo JS_PATH;echo 'crop/images/playerProductInstall.swf";
			
            var flashvars = {};
			// ͼƬ��ַ
			flashvars.picurl = "';echo $picurl;echo '";
			// �ϴ���ַ��ʹ���� base64 ����
			flashvars.uploadurl = "';echo base64_encode("index.php?s=attachment/attachments/crop_upload/module/$module/catid/$catid&file=".urlencode($picurl));;echo '";
			
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "always";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "myFlashID";
            attributes.name = "myFlashID";
            attributes.align = "middle";
            swfobject.embedSWF(
                "';echo JS_PATH;echo 'crop/images/Main.swf", "flashContent", 
                "680", "480", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
			<!-- JavaScript enabled so display the flashContent div in case it is not replaced with a swf object. -->
			swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>
    </head>
    <body>
        <div id="flashContent">
        	<p>
	        	To view this page ensure that Adobe Flash Player version 
				10.0.0 or greater is installed. 
			</p>
			<script type="text/javascript"> 
				var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://"); 
				document.write("<a href=\'http://www.adobe.com/go/getflashplayer\'><img src=\'" 
								+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif\' alt=\'Get Adobe Flash player\' /></a>" ); 
			</script> 
        </div>
	   	
       	<noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="680" height="480" id="myFlashID">
                <param name="movie" value="';echo JS_PATH;echo 'crop/images/Main.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="allowScriptAccess" value="always" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="';echo JS_PATH;echo 'crop/images/Main.swf" width="680" height="480">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#ffffff" />
                    <param name="allowScriptAccess" value="always" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                	<p> 
                		Either scripts and active content are not permitted to run or Adobe Flash Player version
                		10.0.0 or greater is not installed.
                	</p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
	    </noscript>
       </body>
       </html>
';?>