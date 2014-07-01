<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<div class="table-list">
<xmp>';echo $structure;echo '</xmp>
</div>
</div>
</body>
</html>';?>