<?php
 $show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','attachment');;echo '<style type="text/css">
    *{padding: 0;margin: 0}
    body {font-size: 12px;overflow: hidden;padding: 10px;margin: 0;color: #838383;}
    .wrapper{width: 600px;height: 352px;overflow: hidden;position: relative;border-bottom: 1px solid #d7d7d7}
    .localPath input{float: left;width: 350px;line-height: 20px;height: 20px;}
    #clipboard{float:left;width: 70px;height: 30px;}
    .description{ color: #0066cc; margin-top: 2px; width: 450px; height: 45px;float: left;line-height: 22px}
    #upload{width: 100px;height: 30px;float: right; margin:10px 2px 0 0;cursor: pointer;}
    #msg{ width: 140px; height: 30px; line-height:25px;float: left;color: red}
</style>
</head>
<body>
    <div class="wrapper">
        <div style="position: relative;float:right;margin-right: 10px;z-index: 999"><input type="checkbox" id="watermark_enable" name="watermark_enable"  checked="';echo $watermark_enable;echo '" />�Ƿ����ˮӡ</div>
        <div class="localPath">
            <input id="localPath" type="text" readonly />
            <div id="clipboard"></div>
            <div id="msg"></div>
        </div>
        <div id="flashContainer"></div>
        <div>
            <div id="upload" style="display: none" ><img id="uploadBtn"></div>
            <div class="description">
                <span style="color: red">ͼƬת�沽�裺</span>1������������ư�ť������ַ���Ƶ������壻2����������Ƭ��ť���ڵ����ĶԻ�����ʹ��Ctrl+Vճ����ַ��3������򿪺�ѡ��ͼƬ�ϴ����̡�
            </div>
        </div>
    </div>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/internal.js"></script>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/tangram.js"></script>
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/wordimage/wordimage.js"></script>    
    <script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/json2.js"></script>
    <script type="text/javascript">
        //ȫ�ֱ���
        var imageUrls = [],          //���ڱ���ӷ��������ص�ͼƬ��Ϣ����
        selectedImageCount = 0,  //��ǰ��ѡ��ĵ�δ�ϴ���ͼƬ����
        flashOptionsExt = {';echo $ext;echo '};
        window.onload = function(){
            //����Flash��صĲ�������
            var flashOptions = {
                container:"flashContainer",                                                    //flash����id
                url:\'';echo ADMIN_PATH!="http:///"?ADMIN_PATH:APP_PATH;echo 'index.php?s=attachment/ueditor/imgswfupload\',             // �ϴ�����ҳ���url��ַ
                ext:JSON.stringify(flashOptionsExt),          //����������ύ���Զ�������б�
                fileType:\'{"description":"ͼƬ", "extension":"*.gif;*.jpeg;*.png;*.jpg;*.bmp"}\',     //�ϴ��ļ���ʽ����
                flashUrl:\'';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/image/imageUploader.swf\',            //�ϴ��õ�flash�����ַ
                width:600,          //flash�Ŀ��
                height:272,         //flash�ĸ߶�
                gridWidth:120,     // ÿһ��Ԥ��ͼƬ��ռ�Ŀ��
                gridHeight:120,    // ÿһ��Ԥ��ͼƬ��ռ�ĸ߶�
                picWidth:100,      // ����Ԥ��ͼƬ�Ŀ��
                picHeight:100,     // ����Ԥ��ͼƬ�ĸ߶�
                uploadDataFieldName:\'picdata\',    // POST������ͼƬ���ݵ�key
                picDescFieldName:\'pictitle\',      // POST������ͼƬ������key
                maxSize:';echo $file_size_limit;echo ',                         // �ļ���������,��λM
                compressSize:1,                   // �ϴ�ǰ���ͼƬ���������ֵ������ѹ��,��λM
                maxNum:32,                         // ���������ϴ����ٸ��ļ�
                compressSide:editor.options.compressSide,                 //�ȱ�ѹ���Ļ�׼��0Ϊ������ߣ�1Ϊ���տ�ȣ�2Ϊ���ո߶�
                compressLength:editor.options.maxImageSideLength        //�ܽ��ܵ����߳���������ֵFlash���Զ��ȱ�ѹ��
            };
            //�ص��������ϣ�֧�ִ��ݺ��������ַ�������������Լ�����������������
            var callbacks={
                selectFileCallback: function(selectFiles){                // ѡ���ļ��Ļص�
                    selectedImageCount += selectFiles.length;
                    if(selectedImageCount) baidu.g("upload").style.display = "";
                    dialog.buttons[0].setDisabled(true); //��ʼ��ʱ�û�ȷ����ť
                },
                deleteFileCallback: function(delFiles){                 // ɾ���ļ��Ļص�
                    selectedImageCount -= delFiles.length;
                    if (!selectedImageCount) {
                        baidu.g("upload").style.display = "none";
                        dialog.buttons[0].setDisabled(false);         //û��ѡ��ͼƬʱ���µ�����ť
                    }
                },
                uploadCompleteCallback: function(data){               // �����ļ��ϴ���ɵĻص�
                    try{var info = eval("(" + data.info + ")");
                        info && imageUrls.push(info);
                        selectedImageCount--;
                        $.get(\'index.php?s=attachment/ueditor/swfupload_json/aid/\'+info.aid+\'&src=\'+info.url+\'&filename=\'+info.filename);
                    }catch(e){}
                },
                uploadErrorCallback: function (data){         // �����ļ��ϴ�ʧ�ܵĻص�,
                    console && console.log(data);
                },
                allCompleteCallback: function(){              // ȫ���ϴ����ʱ�Ļص�
                    dialog.buttons[0].setDisabled(false);    //�ϴ���Ϻ������ť
                }
                //exceedFileCallback: \'exceedFileCallback\',   // �ļ��������Ƶ�������ʱ�Ļص�
                //startUploadCallback: startUploadCallback    // ��ʼ�ϴ�ĳ���ļ�ʱ�Ļص�
            };
            wordImage.init(flashOptions,callbacks);
            var watermark_enable=$G("watermark_enable");
            watermark_enable.addEventListener( "change", function () {
                if (this.checked ) {
                    flashOptionsExt.watermark_enable="1";
                }else{
                    flashOptionsExt.watermark_enable="0";
                }
                flashOptions.ext=JSON.stringify(flashOptionsExt);
                wordImage.reInit(flashOptions,callbacks);
            }, false );
        }

    </script>

</body>
</html>
';?>