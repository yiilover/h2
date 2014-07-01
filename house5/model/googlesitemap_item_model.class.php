<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class googlesitemap_item_model extends model {
public function __construct() {
$this->items = array();
parent::__construct();
}
function google_sitemap_item($loc,$lastmod = '',$changefreq = '',$priority = '')
{
$this->loc = $loc;
$this->lastmod = $lastmod;
$this->changefreq = $changefreq;
$this->priority = $priority;
}
}
?>