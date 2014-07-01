<?php

defined('IN_HOUSE5') or exit('No permission resources.');
function del_queue() {
$times = SYS_TIME-2592000;
$queue = h5_base::load_model('queue_model');
$queue->delete("times <= $times");
}?>