<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<div class="pad-10">
';$n=1;foreach ($menu as $key=>$v):if ($v['name']=='phpsso') continue;if($n==1) {echo '<div class="map-menu lf">';};echo '<ul>
<li class="title">';echo L($v['name']);echo '</li>
';foreach ($v['childmenus'] as $k=>$r):;echo '<li class="title2">';echo L($r['name']);echo '</li>
';$menus = admin::admin_menu($r['id']);foreach ($menus as $s=>$r):;echo '<li><a href="javascript:go(\'index.php?s=';echo $r['m'];echo '/';echo $r['c'];echo '/';echo $r['a'];echo '/h5_hash/';echo $_SESSION['h5_hash'];echo '/menuid/';echo $r['id'];echo '';echo isset($r['data']) ?$r['data'] : '';echo '\')">';echo L($r['name']);echo '</a></li>
';endforeach;endforeach;;echo '</ul>
';if($n%2==0) {echo '</div><div class="map-menu lf">';}$n++;endforeach;;echo '</div>
</div>
<script type="text/javascript">
<!--
 function go(url) {
	 window.top.document.getElementById(\'rightMain\').src=url;
	 window.top.art.dialog({id:\'map\'}).close();
}
//-->
</script>
</body>
</html>';?>