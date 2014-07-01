<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
';if($totalpage==0):;echo 'parent.progress(';echo $id;echo ', 100);
parent.$(\'#status_';echo $id;echo '\').html(\'';echo L("done");echo '\');
';else:;echo '';$progress = intval($page / $totalpage * 100);;echo 'parent.progress(';echo $id;echo ', ';echo $progress;echo ');
parent.$(\'#status_';echo $id;echo '\').html(\'<img src="';echo IMG_PATH;echo 'msg_img/loading.gif"> ';echo L("are_release_ing");echo ' ';echo $progress;echo '%\');
';if ($page <$totalpage) : ;echo 'location.href=\'?s=release/index/public_sync&page=';echo $page+1;;echo '&total=';echo $total;echo '&id=';echo $id;echo '&statuses=';echo $statuses;echo '\';
';else:;echo 'parent.$(\'#status_';echo $id;echo '\').html(\'';echo L("done");echo '\');
';endif;endif;;echo '//-->
</script>
</body>
</html>';?>