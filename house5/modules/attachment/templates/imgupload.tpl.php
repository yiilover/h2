<?php
 $show_header = $show_validator = $show_scroll = 1;include $this->admin_tpl('header','attachment');;echo '<link rel="stylesheet" href="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/image/image.css" type="text/css" />
<div class="wrapper">    
        <div style="position: relative;float:right;margin-right: 10px;z-index: 999"><input type="checkbox" id="watermark_enable" name="watermark_enable"  checked="';echo $watermark_enable;echo '" />�Ƿ����ˮӡ</div>
        <div id="imageTab">            
            <div id="tabHeads" class="tabhead">
                <span tabSrc="remote" class="focus">����ͼƬ</span>
                <span tabSrc="local">�����ϴ�</span>
                <span tabSrc="imgManager">���߹���</span>
                <span tabSrc="imgSearch">ͼƬ����</span>                
            </div>            
            <div id="tabBodys" class="tabbody">
                <div id="remote" class="panel">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="label"><label for="url">�� ַ��</label></td>
                            <td><input id="url" type="text"/></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="width">�� �ȣ�</label></td>
                            <td><input type="text" id="width"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="height">�� �ȣ�</label></td>
                            <td><input type="text" id="height"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="border">�� ��</label></td>
                            <td><input type="text" id="border"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="vhSpace">�� �ࣺ</label></td>
                            <td><input type="text" id="vhSpace"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="title">�� ����</label></td>
                            <td><input type="text" id="title"/></td>
                        </tr>
                        <tr>
                            <td class="label">�� �룺</td>
                            <td id="remoteFloat"></td>
                        </tr>
                    </table>

                    <div id="preview"></div>
                    <div class="lock"><input id="lock" type="checkbox" title="������߱���" checked="checked"></div>
                </div>
                <div id="local" class="panel">
                    <div id="flashContainer"></div>
                    <div><div id="upload" style="display: none" ></div><div class="duiqi"></div><div id="localFloat"></div></div>
                </div>
                <div id="imgManager" class="panel">
                    <div id="imageList">&nbsp;&nbsp;ͼƬ�����С���</div>
                    <!--<p id="pageControler">��ҳ������</p>-->
                </div>
                <div id="imgSearch" class="panel">
                    <table style="margin-top: 5px;">
                        <tr>
                            <td width="200"><input id="imgSearchTxt" value="�����������ؼ���" type="text" /></td>
                            <td width="65">
                                <select id="imgType">
                                    <!--<option value="&s=0&z=0">ȫ��</option>-->
                                    <option value="/s/4/z/0">����</option>
                                    <option value="/s/1/z/19">��ֽ</option>
                                    <option value="/s/2/z/0">����</option>
                                    <option value="/s/3/z/0">ͷ��</option>
                                </select>
                            </td>
                            <td width="80"><input id="imgSearchBtn" type="button" value="�ٶ�һ��" /></td>
                            <td width="80"><input id="imgSearchReset" type="button" value="�������" /></td>
                        </tr>
                    </table>
                    <div id="searchList"></div>
                </div>
                <iframe id="maskIframe" src="about:blank" scrolling="no" frameborder="no"></iframe>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/internal.js"></script>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/tangram.js"></script>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/image/image.js"></script>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/json2.js"></script>

    <script type="text/javascript">
        function changeCatcherUrl(num){
            var i=editor.options.catcherUrl.indexOf("/watermark_enable/")
            if(i>0){
                editor.options.catcherUrl=editor.options.catcherUrl.substr(0,i+18)+num;
            }else{
                editor.options.catcherUrl=editor.options.catcherUrl+"/watermark_enable/"+num;
            }
            
        }
        //ȫ�ֱ���
        var imageUrls = [],          //���ڱ���ӷ��������ص�ͼƬ��Ϣ����
            selectedImageCount = 0,  //��ǰ��ѡ��ĵ�δ�ϴ���ͼƬ����
            flashOptionsExt = {';echo $ext;echo '};
			editor.setOpt({
            imageFieldName:"upfile",
            compressSide:0,
            maxImageSideLength:900
        });

        window.onload = function(){
            //����Flash��صĲ�������
            var flashOptions = {
                container:"flashContainer",                                                    //flash����id
                url:\'';echo ADMIN_PATH!="http:///"?ADMIN_PATH:APP_PATH;echo 'index.php?s=attachment/ueditor/imgswfupload\',             // �ϴ�����ҳ���url��ַ
                ext:JSON.stringify(flashOptionsExt),          //����������ύ���Զ�������б�
                fileType:\'{"description":"ͼƬ", "extension":"*.gif;*.jpeg;*.png;*.jpg;*.bmp"}\',     //�ϴ��ļ���ʽ����
                flashUrl:\'';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/image/imageUploader.swf\',            //�ϴ��õ�flash�����ַ
                width:608,          //flash�Ŀ��
                height:272,         //flash�ĸ߶�
                gridWidth:121,     // ÿһ��Ԥ��ͼƬ��ռ�Ŀ��
                gridHeight:120,    // ÿһ��Ԥ��ͼƬ��ռ�ĸ߶�
                picWidth:100,      // ����Ԥ��ͼƬ�Ŀ��
                picHeight:100,     // ����Ԥ��ͼƬ�ĸ߶�
                uploadDataFieldName:\'picdata\',    // POST������ͼƬ���ݵ�key
                picDescFieldName:\'pictitle\',      // POST������ͼƬ������key
                maxSize:';echo $file_size_limit;echo ',                         // �ļ���������,��λM
                compressSize:2,                   // �ϴ�ǰ���ͼƬ���������ֵ������ѹ��,��λM
                maxNum:32,                         // ���������ϴ����ٸ��ļ�
                compressSide:editor.options.compressSide,                 //�ȱ�ѹ���Ļ�׼��0Ϊ������ߣ�1Ϊ���տ�ȣ�2Ϊ���ո߶�
                compressLength:editor.options.maxImageSideLength        //�ܽ��ܵ����߳���������ֵFlash���Զ��ȱ�ѹ��
            };
            //�ص��������ϣ�֧�ִ��ݺ��������ַ�������������Լ�����������������
            var callbacks={
                // ѡ���ļ��Ļص�
                selectFileCallback: function(selectFiles){
                    selectedImageCount += selectFiles.length;
                    if(selectedImageCount) baidu.g("upload").style.display = "";
                    dialog.buttons[0].setDisabled(true); //��ʼ��ʱ�û�ȷ����ť
                },
                // ɾ���ļ��Ļص�
                deleteFileCallback: function(delFiles){
                    selectedImageCount -= delFiles.length;
                    if (!selectedImageCount) {
                        baidu.g("upload").style.display = "none";
                        dialog.buttons[0].setDisabled(false);         //û��ѡ��ͼƬʱ���µ�����ť
                    }
                },
                // �����ļ��ϴ���ɵĻص�
                uploadCompleteCallback: function(data){
                    try{
                        var info = eval("(" + data.info + ")");
                        info && imageUrls.push(info);
                        selectedImageCount--;
                        $.get(\'index.php?s=attachment/ueditor/swfupload_json/aid/\'+info.aid+\'&src=\'+info.url+\'&filename=\'+info.filename);
                    }catch(e){}

                },
                // �����ļ��ϴ�ʧ�ܵĻص�,
                uploadErrorCallback: function (data){
                    if(!data.info){
                        alert(lang.netError)
                    }
                    //console && console.log(data);
                },
                // ȫ���ϴ����ʱ�Ļص�
                allCompleteCallback: function(){
                    dialog.buttons[0].setDisabled(false);    //�ϴ���Ϻ������ť                    
                },
                // �ļ��������Ƶ�������ʱ�Ļص�
                //exceedFileCallback: \'exceedFileCallback\',
                // ��ʼ�ϴ�ĳ���ļ�ʱ�Ļص�
                //startUploadCallback: startUploadCallback
				startUploadCallback: function(){
                    var config = postConfig.shift();
                    //Ҳ�������������
                    //if(config.id==2){ //���õ�����ͼƬ�Ķ�Ӧ����
                    //     config.data={"myParam":"value"}
                    // }
                    flashObj.addCustomizedParams(config.id,config.data);
                }
            };
            imageUploader.init(flashOptions,callbacks);
			$G("upload").onclick = function () {
                /**
                 * �ӿ�imageUploader.setPostParams()�������ύʱ���ñ����ϴ��ύ�Ĳ�������������ͼƬ��
                 * ����Ϊjson����{"key1":"value1","key2":"value2"}������key��Ϊ���̨post�ύ��name��value��Ϊֵ��
                 * ������һ������ı���keyֵΪaction�������ã����Ը��ı����ύ�Ĵ����ַ
                 */
                flashObj.upload();
                this.style.display = "none";
            };

            var watermark_enable=$G("watermark_enable");
            if (watermark_enable.checked ) {
                changeCatcherUrl("1");
            }else{       
                changeCatcherUrl("0");
            }
            watermark_enable.addEventListener( "change", function () {
                if (this.checked ) {
                    flashOptionsExt.watermark_enable="1";
                    changeCatcherUrl("1");
                }else{
                    flashOptionsExt.watermark_enable="0";         
                    changeCatcherUrl("0");
                }
                flashOptions.ext=JSON.stringify(flashOptionsExt);
                imageUploader.reInit(flashOptions,callbacks);
            }, false );
        };
    </script>
</body>
</html>
';?>