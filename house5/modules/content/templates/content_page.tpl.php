<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div id="closeParentTime" style="display:none"></div>
<SCRIPT LANGUAGE="JavaScript">
<!--
if(window.top.$("#current_pos").data(\'clicknum\')==1) {
	parent.document.getElementById(\'display_center_id\').style.display=\'none\';
	parent.document.getElementById(\'center_frame\').src = \'\';
	window.top.$("#current_pos").data(\'clicknum\',0);
}
$(document).ready(function(){
	setInterval(closeParent,3000);
});
function closeParent() {
	if($(\'#closeParentTime\').html() == \'\') {
		window.top.$(".left_menu").addClass("left_menu_on");
		window.top.$("#openClose").addClass("close");
		window.top.$("html").addClass("on");
		$(\'#closeParentTime\').html(\'1\');
		window.top.$("#openClose").data(\'clicknum\',1);
	}
}
//-->
</SCRIPT>
<div class="pad-lr-10">
<div class="pad-10">
<div class="content-menu ib-a blue line-x"><a href="javascript:;" class=on><em>';echo L('page_manage');;echo '</em></a><span>|</span> <a href="';if(strpos($category['url'],'http://')===false) echo siteurl($this->siteid);echo $category['url'];;echo '" target="_blank"><em>';echo L('click_vistor');;echo '</em></a> <span>|</span> <a href="?s=block/block_admin/public_visualization/catid/';echo $catid;;echo '/type/page"><em>';echo L('visualization_edit');;echo '</em></a> 
</div>
</div>

<form name="myform" action="?s=content/content/add" method="post" enctype="multipart/form-data">
<div class="pad_10">
<div style=\'overflow-y:auto;overflow-x:hidden\' class=\'scrolltable\'>
<table width="100%" cellspacing="0" class="table_form contentWrap">
<tr>
	 <th width="80"> ';echo L('title');;echo '	  </th>
      <td><input type="text" style="width:400px;" name="info[title]" id="title" value="';echo $title;echo '" style="color:';echo $style;;echo '" class="measure-input " onBlur="$.post(\'api.php?op=get_keywords&number=3&sid=\'+Math.random()*5, {data:$(\'#title\').val()}, function(data){if(data && $(\'#keywords\').val()==\'\') $(\'#keywords\').val(data); })"/>
		<input type="hidden" name="style_color" id="style_color" value="';echo $style_color;;echo '">
		<input type="hidden" name="style_font_weight" id="style_font_weight" value="';echo $style_font_weight;;echo '">
		<img src="statics/images/icon/colour.png" width="15" height="16" onclick="colorpicker(\'title_colorpanel\',\'set_title_color\');" style="cursor:hand"/> 
		<img src="statics/images/icon/bold.png" width="10" height="10" onclick="input_font_bold()" style="cursor:hand"/> <span id="title_colorpanel" style="position:absolute; z-index:200" class="colorpanel"></span>  </td>
    </tr>
<tr>
      <th width="80"> ';echo L('keywords');;echo '	  </th>
      <td><input type="text" name="info[keywords]" id="keywords" value="';echo $keywords;echo '" size="50">  ';echo L('explode_keywords');;echo '</td>
    </tr>

<tr>
 <th width="80"> ';echo L('content');;echo '	  </th>
<td>
<textarea name="info[content]" id="content">';echo $content;echo '</textarea>
';echo form::editor('content','full','','','',1,1);echo '</td></tr>
</table>
</div>
<div class="bk10"></div>
<div class="btn">
<input type="hidden" name="info[catid]" value="';echo $catid;;echo '" />
<input type="hidden" name="edit" value="';echo $title ?1 : 0;;echo '" />
<input type="submit" class="button" name="dosubmit" value="';echo L('submit');;echo '" />
</div> 
  </div>

</form>
</div>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'colorpicker.js"></script>
</body>
</html>';?>