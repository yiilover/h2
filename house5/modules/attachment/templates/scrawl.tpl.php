<?php
 $show_header = $show_validator = $show_scroll = 1;include $this->admin_tpl('header','attachment');;echo '<link rel="stylesheet" type="text/css" href="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH ;echo 'ueditor/dialogs/scrawl/scrawl.css">
<div class="main" id="J_wrap">
    <div class="hot">
        <div class="drawBoard border_style1">
            <canvas id="J_brushBoard" class="brushBorad" width="360" height="300"></canvas>
            <div id="J_picBoard" class="picBoard" style="width: 360px;height: 300px"></div>
        </div>
        <div id="J_operateBar" class="operateBar">
            <span id="J_previousStep" class="previousStep">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_previousStep"></var></em>
            </span>
            <span id="J_nextStep" class="nextStep">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_nextsStep"></var></em>
            </span>
            <span id="J_clearBoard" class="clearBoard">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_clear"></var></em>
            </span>
            <span id="J_sacleBoard" class="scaleBoard">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_ScalePic"></var></em>
            </span>
        </div>
    </div>
    <div class="drawToolbar border_style1">
        <div id="J_colorBar" class="colorBar"></div>
        <div id="J_brushBar" class="sectionBar">
            <em class="brushIcon"></em>
            <a href="javascript:void(0)" class="size1">1</a>
            <a href="javascript:void(0)" class="size2">3</a>
            <a href="javascript:void(0)" class="size3">5</a>
            <a href="javascript:void(0)" class="size4">7</a>
        </div>
        <div id="J_eraserBar" class="sectionBar">
            <em class="eraserIcon"></em>
            <a href="javascript:void(0)" class="size1">1</a>
            <a href="javascript:void(0)" class="size2">3</a>
            <a href="javascript:void(0)" class="size3">5</a>
            <a href="javascript:void(0)" class="size4">7</a>
        </div>
        <div class="sectionBar">
            <div class="addImgH">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_addPic"></var></em>
                <form method="post" id="fileForm" enctype="multipart/form-data" class="addImgH_form" target="up">
                    <input type="file" name="upfile" id="J_imgTxt"
                           accept="image/gif,image/jpeg,image/png,image/jpg,image/bmp"/>
                </form>
                <iframe name="up" style="display: none"></iframe>
            </div>
        </div>
        <div class="sectionBar">
            <span id="J_removeImg" class="removeImg">
                <em class="icon"></em>
                <em class="text"><var id="lang_input_removePic"></var></em>
            </span>
        </div>
    </div>
</div>
<div id="J_maskLayer" class="maskLayerNull"></div>

<script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/internal.js"></script>
<script type="text/javascript" src="';echo ADMIN_PATH!="http:///"?ADMIN_JS_PATH:JS_PATH;echo 'ueditor/dialogs/scrawl/scrawl.js"></script>
<script type="text/javascript">
    var settings = {
        drawBrushSize:3, //���ʳ�ʼ��С
        drawBrushColor:"#4bacc6", //���ʳ�ʼ��ɫ
        colorList:[\'c00000\', \'ff0000\', \'ffc000\', \'ffff00\', \'92d050\', \'00b050\', \'00b0f0\', \'0070c0\', \'002060\', \'7030a0\', \'ffffff\',
            \'000000\', \'eeece1\', \'1f497d\', \'4f81bd\', \'c0504d\', \'9bbb59\', \'8064a2\', \'4bacc6\', \'f79646\'], //����ѡ����ɫ
        saveNum:10  //��������
    };

    var scrawlObj = new scrawl( settings );
    scrawlObj.isCancelScrawl = false;

    dialog.onok = function () {
        exec( scrawlObj );
        return false;
    };
    dialog.oncancel = function () {
        scrawlObj.isCancelScrawl = true;
    };
</script>
</body>
</html>';?>