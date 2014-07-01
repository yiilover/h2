<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<link href="';echo CSS_PATH;echo 'jquery.treeTable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="';echo JS_PATH;echo 'jquery.treetable.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#dnd-example").treeTable({
    	indent: 20
    	});
  });
  function checknode(obj)
  {
      var chk = $("input[type=\'checkbox\']");
      var count = chk.length;
      var num = chk.index(obj);
      var level_top = level_bottom =  chk.eq(num).attr(\'level\')
      for (var i=num; i>=0; i--)
      {
              var le = chk.eq(i).attr(\'level\');
              if(eval(le) < eval(level_top)) 
              {
                  chk.eq(i).attr("checked",true);
                  var level_top = level_top-1;
              }
      }
      for (var j=num+1; j<count; j++)
      {
              var le = chk.eq(j).attr(\'level\');
              if(chk.eq(num).attr("checked")==true) {
                  if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked",true);
                  else if(eval(le) == eval(level_bottom)) break;
              }
              else {
                  if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked",false);
                  else if(eval(le) == eval(level_bottom)) break;
              }
      }
  }
</script>
';if($siteid) {;echo '<div class="table-list" id="load_priv">
<table width="100%" cellspacing="0">
	<thead>
	<tr>
	<th class="text-l cu-span" style=\'padding-left:30px;\'><span onClick="javascript:$(\'input[name=menuid[]]\').attr(\'checked\', true)">';echo L('selected_all');;echo '</span>/<span onClick="javascript:$(\'input[name=menuid[]]\').attr(\'checked\', false)">';echo L('cancel');;echo '</span></th>
	</tr>
	</thead>
</table>
<form name="myform" action="?s=admin/role/role_priv" method="post">
<input type="hidden" name="roleid" value="';echo $roleid;echo '"></input>
<input type="hidden" name="siteid" value="';echo $siteid;echo '"></input>
<table width="100%" cellspacing="0" id="dnd-example">
<tbody>
';echo $categorys;;echo '</tbody>
</table>
    <div class="btn"><input type="submit"  class="button" name="dosubmit" id="dosubmit" value="';echo L('submit');;echo '" /></div>
</form>
</div>
';}else {;echo '<style type="text/css">
.guery{background: url(';echo IMG_PATH;echo 'msg_img/msg_bg.png) no-repeat 0px -560px;padding:10px 12px 10px 45px; font-size:14px; height:100px; line-height:96px}
.guery{background-position: left -460px;}
</style>
<center>
	<div class="guery" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;">
	';echo L('select_site');;echo '	</div>
</center>
';};echo '
</body>
</html>
';?>