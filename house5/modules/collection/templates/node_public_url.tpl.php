<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li class="on" id="tab_1">';echo L('url_list');echo '</li>
</ul>
<div class="content pad-10" id="show_div_1" style="height:auto">
';while ($pagesize_start <= $pagesize_end):;echo '';echo str_replace('(*)',$pagesize_start,$urlpage);$pagesize_start=$pagesize_start+$par_num;;echo '<hr size="1" />
';endwhile;;echo '</div>
</div>
</div>
</body>
</html>';?>