<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<h2 class="title-1 f14 lh28">�Ź���������</h2>
<div class="bk10"></div>

<fieldset>
<textarea name="jscode1" id="jscode1" style="width:550px;height:300px;"><form method="post" action="';echo APP_PATH;;echo 'index.php?s=formguide/index/show/formid/17/siteid/1/flag/act" name="myform" id="myform">
  <li>
<span class="td_1" style="width:240px;">�� ����<input id="truename" name="truename" maxlength="20" type="text" class="inputText" style="width:150px;"> <font style="color:#f00;">*</font></span>
<span class="td_2" style="width:240px;">�� ����<input id="phone" name="phone" type="text" maxlength="11" class="inputText" style="width:150px;" onkeyup="this.value=this.value.replace(/[^\\d]/g,\'\')"> <font style="color:#f00;">*</font></span>
<span class="td_1" style="width:240px;">�� ����<input id="num" name="num" maxlength="20" type="text" value="1" class="inputText" style="width:30px;"> <font style="color:#f00;">*</font></span>
<input type="hidden" name="from" id="from" value="����ĳ�ר���url">
<input type="hidden" name="fromurl" id="fromurl" value="����ĳ�ר�������">
  </li>
  <li><span class="td_1" style="width:240px;">�� ��
 <label><input type="radio" name="sex" id="sex_1" value="1" checked=""></label>��
 <label><input type="radio" name="sex" id="sex_2" value="2"></label>Ů</span>
<span class="td_2" style="width:240px;">QQ�ţ�<input id="QQ" name="qq" type="text" maxlength="12" class="inputText" onkeyup="this.value=this.value.replace(/[^\\d]/g,\'\')" style="width:150px;"></span> </li>
<li>��ע��<textarea name="description" rows="8" cols="25">&lt/textarea>
  </li><li>
<span class="td_3"><input type="submit" name="dosubmit" id="dosubmit" value="�� ��" class="smb_btn3"></span>
   </li>
   </form></textarea> <BR><BR><input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="����" class="button" style="width:114px">
</fieldset>
</div>
</body>
</html>';?>