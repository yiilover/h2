<?php

defined ( 'IN_HOUSE5') or exit ( 'No permission resources.');
class maillist_tag {
private $maillist;
public function __construct() {
$this->maillist = h5_base::load_model ( 'maillist_model');
}
public function get_wzz()
{
$cond = array(
'domain'=>SITE_URL
);
$maillist = $this->maillist->get_one($cond,'wzz, is_activate, group_name');
return $maillist;
}
}?>