<?php
 $show_header = $show_validator = $show_scroll = 1;include $this->admin_tpl('header','attachment');;echo '<link rel="stylesheet" href="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/image/image.css" type="text/css" />
<div class="wrapper">    
        <div style="position: relative;float:right;margin-right: 10px;z-index: 999"><input type="checkbox" id="watermark_enable" name="watermark_enable"  checked="';echo $watermark_enable;echo '" />是否添加水印</div>
        <div id="imageTab">            
            <div id="tabHeads" class="tabhead">
                <span tabSrc="remote" class="focus">网络图片</span>
                <span tabSrc="local">本地上传</span>
                <span tabSrc="imgManager">在线管理</span>
                <span tabSrc="imgSearch">图片搜索</span>                
            </div>            
            <div id="tabBodys" class="tabbody">
                <div id="remote" class="panel">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="label"><label for="url">地 址：</label></td>
                            <td><input id="url" type="text"/></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="width">宽 度：</label></td>
                            <td><input type="text" id="width"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="height">高 度：</label></td>
                            <td><input type="text" id="height"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="border">边 框：</label></td>
                            <td><input type="text" id="border"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="vhSpace">边 距：</label></td>
                            <td><input type="text" id="vhSpace"/> px</td>
                        </tr>
                        <tr>
                            <td class="label"><label for="title">描 述：</label></td>
                            <td><input type="text" id="title"/></td>
                        </tr>
                        <tr>
                            <td class="label">对 齐：</td>
                            <td id="remoteFloat"></td>
                        </tr>
                    </table>

                    <div id="preview"></div>
                    <div class="lock"><input id="lock" type="checkbox" title="锁定宽高比例" checked="checked"></div>
                </div>
                <div id="local" class="panel">
                    <div id="flashContainer"></div>
                    <div><div id="upload" style="display: none" ></div><div class="duiqi"></div><div id="localFloat"></div></div>
                </div>
                <div id="imgManager" class="panel">
                    <div id="imageList">&nbsp;&nbsp;图片加载中……</div>
                    <!--<p id="pageControler">分页控制器</p>-->
                </div>
                <div id="imgSearch" class="panel">
                    <table style="margin-top: 5px;">
                        <tr>
                            <td width="200"><input id="imgSearchTxt" value="请输入搜索关键词" type="text" /></td>
                            <td width="65">
                                <select id="imgType">
                                    <!--<option value="&s=0&z=0">全部</option>-->
                                    <option value="/s/4/z/0">新闻</option>
                                    <option value="/s/1/z/19">壁纸</option>
                                    <option value="/s/2/z/0">表情</option>
                                    <option value="/s/3/z/0">头像</option>
                                </select>
                            </td>
                            <td width="80"><input id="imgSearchBtn" type="button" value="百度一下" /></td>
                            <td width="80"><input id="imgSearchReset" type="button" value="清空搜索" /></td>
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
        //全局变量
        var imageUrls = [],          //用于保存从服务器返回的图片信息数组
            selectedImageCount = 0,  //当前已选择的但未上传的图片数量
            flashOptionsExt = {';echo $ext;echo '};
			editor.setOpt({
            imageFieldName:"upfile",
            compressSide:0,
            maxImageSideLength:900
        });

        window.onload = function(){
            //创建Flash相关的参数集合
            var flashOptions = {
                container:"flashContainer",                                                    //flash容器id
                url:\'';echo ADMIN_PATH!="http:///"?ADMIN_PATH:APP_PATH;echo 'index.php?s=attachment/ueditor/imgswfupload\',             // 上传处理页面的url地址
                ext:JSON.stringify(flashOptionsExt),          //可向服务器提交的自定义参数列表
                fileType:\'{"description":"图片", "extension":"*.gif;*.jpeg;*.png;*.jpg;*.bmp"}\',     //上传文件格式限制
                flashUrl:\'';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/image/imageUploader.swf\',            //上传用的flash组件地址
                width:608,          //flash的宽度
                height:272,         //flash的高度
                gridWidth:121,     // 每一个预览图片所占的宽度
                gridHeight:120,    // 每一个预览图片所占的高度
                picWidth:100,      // 单张预览图片的宽度
                picHeight:100,     // 单张预览图片的高度
                uploadDataFieldName:\'picdata\',    // POST请求中图片数据的key
                picDescFieldName:\'pictitle\',      // POST请求中图片描述的key
                maxSize:';echo $file_size_limit;echo ',                         // 文件的最大体积,单位M
                compressSize:2,                   // 上传前如果图片体积超过该值，会先压缩,单位M
                maxNum:32,                         // 单次最大可上传多少个文件
                compressSide:editor.options.compressSide,                 //等比压缩的基准，0为按照最长边，1为按照宽度，2为按照高度
                compressLength:editor.options.maxImageSideLength        //能接受的最大边长，超过该值Flash会自动等比压缩
            };
            //回调函数集合，支持传递函数名的字符串、函数句柄以及函数本身三种类型
            var callbacks={
                // 选择文件的回调
                selectFileCallback: function(selectFiles){
                    selectedImageCount += selectFiles.length;
                    if(selectedImageCount) baidu.g("upload").style.display = "";
                    dialog.buttons[0].setDisabled(true); //初始化时置灰确定按钮
                },
                // 删除文件的回调
                deleteFileCallback: function(delFiles){
                    selectedImageCount -= delFiles.length;
                    if (!selectedImageCount) {
                        baidu.g("upload").style.display = "none";
                        dialog.buttons[0].setDisabled(false);         //没有选择图片时重新点亮按钮
                    }
                },
                // 单个文件上传完成的回调
                uploadCompleteCallback: function(data){
                    try{
                        var info = eval("(" + data.info + ")");
                        info && imageUrls.push(info);
                        selectedImageCount--;
                        $.get(\'index.php?s=attachment/ueditor/swfupload_json/aid/\'+info.aid+\'&src=\'+info.url+\'&filename=\'+info.filename);
                    }catch(e){}

                },
                // 单个文件上传失败的回调,
                uploadErrorCallback: function (data){
                    if(!data.info){
                        alert(lang.netError)
                    }
                    //console && console.log(data);
                },
                // 全部上传完成时的回调
                allCompleteCallback: function(){
                    dialog.buttons[0].setDisabled(false);    //上传完毕后点亮按钮                    
                },
                // 文件超出限制的最大体积时的回调
                //exceedFileCallback: \'exceedFileCallback\',
                // 开始上传某个文件时的回调
                //startUploadCallback: startUploadCallback
				startUploadCallback: function(){
                    var config = postConfig.shift();
                    //也可以在这里更改
                    //if(config.id==2){ //设置第三张图片的对应参数
                    //     config.data={"myParam":"value"}
                    // }
                    flashObj.addCustomizedParams(config.id,config.data);
                }
            };
            imageUploader.init(flashOptions,callbacks);
			$G("upload").onclick = function () {
                /**
                 * 接口imageUploader.setPostParams()可以在提交时设置本次上传提交的参数（包括所有图片）
                 * 参数为json对象{"key1":"value1","key2":"value2"}，其中key即为向后台post提交的name，value即为值。
                 * 其中有一个特殊的保留key值为action，若设置，可以更改本次提交的处理地址
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