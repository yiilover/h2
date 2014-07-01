<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class googlesitemap_model extends model {
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->header = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n\t<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
$this->charset = "UTF-8";
$this->footer = "\t</urlset>\n";
$this->items = array();
parent::__construct();
}
function add_item($new_item) {
$this->items[] = $new_item;
}
function build( $file_name = null ) {
$map = $this->header ."\n";
foreach ($this->items AS $item) {
$map .= "\t\t<url>\n\t\t\t<loc>$item->loc</loc>\n";
if ( !empty( $item->lastmod ) )
$map .= "\t\t\t<lastmod>$item->lastmod</lastmod>\n";
if ( !empty( $item->changefreq ) )
$map .= "\t\t\t<changefreq>$item->changefreq</changefreq>\n";
if ( !empty( $item->priority ) )
$map .= "\t\t\t<priority>$item->priority</priority>\n";
$map .= "\t\t</url>\n\n";
}
$map .= $this->footer ."\n";
if (!is_null($file_name))
{
return file_put_contents($file_name,$map);
}
else
{
return $map;
}
}
}
?>