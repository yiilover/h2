<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="workflow blue">
	<div class="col ';if($steps==1) echo 'off';;echo '">
    	<div class="content fillet">
            <div class="title">
                <div class="fillet">';echo L('steps_1');;echo '<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span><span class="line"></span></div>
            </div>
            <div class="name">';echo $checkadmin1;;echo '</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
    <div class="col ';if($steps==2) echo 'off';;echo '" style="display:';if($steps<2) echo 'none';;echo '">
    	<div class="content fillet">
            <div class="title">
                <div class="fillet">';echo L('steps_2');;echo '<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span><span class="line"></span></div>
            </div>
            <div class="name">';echo $checkadmin2;;echo '</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
	<div class="col ';if($steps==3) echo 'off';;echo '" style="display:';if($steps<3) echo 'none';;echo '">
    	<div class="content fillet">
            <div class="title">
                <div class="fillet">';echo L('steps_3');;echo '<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span><span class="line"></span></div>
            </div>
            <div class="name">';echo $checkadmin3;;echo '</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
    <div class="col ';if($steps==4) echo 'off';;echo '" style="display:';if($steps<4) echo 'none';;echo '">
    	<div class="content fillet">
            <div class="title">
                <div class="fillet">';echo L('steps_4');;echo '<span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span><span class="line"></span></div>
            </div>
            <div class="name">';echo $checkadmin4;;echo '</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>

</div>
</body>
</html>';?>