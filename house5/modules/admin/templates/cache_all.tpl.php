<?php
echo '<style type="text/css">
	.sbs{}
	.sbul{margin:10px;}
	.sbul li{line-height:30px;}
	.button{margin-top:20px;}
	.subnav,.ifm{display:none;}
	
</style>
';
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<form action="?s=admin/cache_all/init/h5_hash/';echo $_SESSION['h5_hash'];echo '" target="cache_if" method="post" id="myform" name="myform">
  <input type="hidden" name="dosubmit" value="1">
<div class="col-2">
<h6>';echo L('tip_zone');echo '</h6>
<div class="sbs" id="update_tips" style="height:360px; overflow:auto;">
	<ul id="file" class="sbul">
	</ul>
</div>
</div>
<!-- <input name="dosubmit" type="submit" class="dialog" id="dosubmit" value="';echo L('start_update');echo '" onclick="$(\'#file\').html(\'\');return true;" class="button"> -->
</form>
<iframe id="cache_if" name="cache_if" class="ifm"></iframe>
<iframe id="hidden" name="hidden"  width="0" height="0" frameborder=0></iframe>
</div>
<script type="text/javascript">

document.myform.submit();

function addtext(data) {
	$(\'#file\').append(data);
	document.getElementById(\'update_tips\').scrollTop = document.getElementById(\'update_tips\').scrollHeight;
}
</script>
</body>
</html>';?>