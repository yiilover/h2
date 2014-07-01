<?php

class RSSBase {
function RSSBase() {
}
}
class RSSBuilder extends RSSBase {
var $encoding;
var $about;
var $title;
var $description;
var $publisher;
var $creator;
var $date;
var $language;
var $rights;
var $image_link;
var $coverage;
var $contributor;
var $period;
var $base;
var $category;
var $output;
var $frequency;
var $cache;
var $items = array();
var $use_dc_data = FALSE;
var $use_sy_data = FALSE;
function RSSBuilder($encoding = '',
$about = '',
$title = '',
$description = '',
$image_link = '',
$category = '',
$cache = '') {
$this->setEncoding($encoding);
$this->setAbout($about);
$this->setTitle($title);
$this->setDescription($description);
$this->setImageLink($image_link);
$this->setCategory($category);
$this->setCache($cache);
}
function addDCdata($publisher = '',
$creator = '',
$date = '',
$language = '',
$rights = '',
$coverage = '',
$contributor = '') {
$this->setPublisher($publisher);
$this->setCreator($creator);
$this->setDate($date);
$this->setLanguage($language);
$this->setRights($rights);
$this->setCoverage($coverage);
$this->setContributor($contributor);
$this->use_dc_data = (boolean) TRUE;
}
function addSYdata($period = '',$frequency = '',$base = '') {
$this->setPeriod($period);
$this->setFrequency($frequency);
$this->setBase($base);
$this->use_sy_data = (boolean) TRUE;
}
function setEncoding($encoding = '') {
if (!isset($this->encoding)) {
$this->encoding = (string) ((strlen(trim($encoding)) >0) ?trim($encoding) : 'UTF-8');
}
}
function setAbout($about = '') {
if (!isset($this->about) &&strlen(trim($about)) >0) {
$this->about = (string) trim($about);
}
}
function setTitle($title = '') {
if (!isset($this->title) &&strlen(trim($title)) >0) {
$this->title = (string) trim($title);
}
}
function setDescription($description = '') {
if (!isset($this->description) &&strlen(trim($description)) >0) {
$this->description = (string) trim($description);
}
}
function setPublisher($publisher = '') {
if (!isset($this->publisher) &&strlen(trim($publisher)) >0) {
$this->publisher = (string) trim($publisher);
}
}
function setCreator($creator = '') {
if (!isset($this->creator) &&strlen(trim($creator)) >0) {
$this->creator = (string) trim($creator);
}
}
function setDate($date = '') {
if (!isset($this->date) &&strlen(trim($date)) >0) {
$this->date = (string) trim($date);
}
}
function setLanguage($language = '') {
if (!isset($this->language) &&$this->isValidLanguageCode($language) === TRUE) {
$this->language = (string) trim($language);
}
}
function setRights($rights = '') {
if (!isset($this->rights) &&strlen(trim($rights)) >0) {
$this->rights = (string) trim($rights);
}
}
function setCoverage($coverage = '') {
if (!isset($this->coverage) &&strlen(trim($coverage)) >0) {
$this->coverage = (string) trim($coverage);
}
}
function setContributor($contributor = '') {
if (!isset($this->contributor) &&strlen(trim($contributor)) >0) {
$this->contributor = (string) trim($contributor);
}
}
function setImageLink($image_link = '') {
if (!isset($this->image_link) &&strlen(trim($image_link)) >0) {
$this->image_link = (string) trim($image_link);
}
}
function setPeriod($period = '') {
if (!isset($this->period) &&strlen(trim($period)) >0) {
switch ($period) {
case 'hourly':
case 'daily':
case 'weekly':
case 'monthly':
case 'yearly':
$this->period = (string) trim($period);
break;
default:
$this->period = (string) '';
break;
}
}
}
function setFrequency($frequency = '') {
if (!isset($this->frequency) &&strlen(trim($frequency)) >0) {
$this->frequency = (int) $frequency;
}
}
function setBase($base = '') {
if (!isset($this->base) &&strlen(trim($base)) >0) {
$this->base = (string) trim($base);
}
}
function setCategory($category = '') {
if (strlen(trim($category)) >0) {
$this->category = (string) trim($category);
}
}
function setCache($cache = '') {
if (strlen(trim($cache)) >0) {
$this->cache = (int) $cache;
}
}
function isValidLanguageCode($code = '') {
return (boolean) ((preg_match('(^([a-zA-Z]{2})$)',$code) >0) ?TRUE : FALSE);
}
function getEncoding() {
return (string) $this->encoding;
}
function getAbout() {
return (string) $this->about;
}
function getTitle() {
return (string) $this->title;
}
function getDescription() {
return (string) $this->description;
}
function getPublisher() {
return (string) $this->publisher;
}
function getCreator() {
return (string) $this->creator;
}
function getDate() {
return (string) $this->date;
}
function getLanguage() {
return (string) $this->language;
}
function getRights() {
return (string) $this->rights;
}
function getCoverage() {
return (string) $this->coverage;
}
function getContributor() {
return (string) $this->contributor;
}
function getImageLink() {
return (string) $this->image_link;
}
function getPeriod() {
return (string) $this->period;
}
function getFrequency() {
return (int) $this->frequency;
}
function getBase() {
return (string) $this->base;
}
function getCategory() {
return (string) $this->category;
}
function getCache() {
return (int) $this->cache;
}
function addItem($about = '',
$title = '',
$link = '',
$description = '',
$subject = '',
$date = '',
$author = '',
$comments = '',
$image = '') {
$item = new RSSItem($about,
$title,
$link,
$description,
$subject,
$date,
$author,
$comments,
$image);
$this->items[] = $item;
}
function deleteItem($id = -1) {
if (array_key_exists($id,$this->items)) {
unset($this->items[$id]);
return (boolean) TRUE;
}else {
return (boolean) FALSE;
}
}
function getItemList() {
return (array) array_keys($this->items);
}
function getItems() {
return (array) $this->items;
}
function getItem($id = -1) {
if (array_key_exists($id,$this->items)) {
return (object) $this->items[$id];
}else {
return (boolean) FALSE;
}
}
function createOutputV090() {
$this->createOutputV100();
}
function createOutputV091() {
$this->output  = (string) '<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">'."\n";
$this->output .= (string) '<rss version="0.91">'."\n";
$this->output .= (string) '<channel>'."\n";
if (strlen($this->rights) >0) {
$this->output .= (string) '<copyright>'.$this->rights .'</copyright>'."\n";
}
if (strlen($this->date) >0) {
$this->output .= (string) '<pubDate>'.$this->date .'</pubDate>'."\n";
$this->output .= (string) '<lastBuildDate>'.$this->date .'</lastBuildDate>'."\n";
}
if (strlen($this->about) >0) {
$this->output .= (string) '<docs>'.$this->about .'</docs>'."\n";
}
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
if (strlen($this->about) >0) {
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
}
if (strlen($this->title) >0) {
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
}
if (strlen($this->image_link) >0) {
$this->output .= (string) '<image>'."\n";
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
$this->output .= (string) '<url>'.$this->image_link .'</url>'."\n";
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
$this->output .= (string) '</image>'."\n";
}
if (strlen($this->publisher) >0) {
$this->output .= (string) '<managingEditor>'.$this->publisher .'</managingEditor>'."\n";
}
if (strlen($this->creator) >0) {
$this->output .= (string) '<webMaster>'.$this->creator .'</webMaster>'."\n";
}
if (strlen($this->language) >0) {
$this->output .= (string) '<language>'.$this->language .'</language>'."\n";
}
if (count($this->getItemList()) >0) {
foreach ($this->getItemList() as $id) {
$item =&$this->items[$id];
if (strlen($item->getTitle()) >0 &&strlen($item->getLink()) >0) {
$this->output .= (string) '<item>'."\n";
$this->output .= (string) '<title>'.$item->getTitle() .'</title>'."\n";
$this->output .= (string) '<link>'.$item->getLink() .'</link>'."\n";
if (strlen($item->getDescription()) >0) {
$this->output .= (string) '<description>'.$item->getDescription() .'</description>'."\n";
}
$this->output .= (string) '</item>'."\n";
}
}
}
$this->output .= (string) '</channel>'."\n";
$this->output .= (string) '</rss>'."\n";
}
function createOutputV100() {
$this->output  = (string) '<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:im="http://purl.org/rss/1.0/item-images/" ';
if ($this->use_dc_data === TRUE) {
$this->output .= (string) 'xmlns:dc="http://purl.org/dc/elements/1.1/" ';
}
if ($this->use_sy_data === TRUE) {
$this->output .= (string) 'xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" ';
}
$this->output .= (string) 'xmlns="http://purl.org/rss/1.0/">'."\n";
if (strlen($this->about) >0) {
$this->output .= (string) '<channel rdf:about="'.$this->about .'">'."\n";
}else {
$this->output .= (string) '<channel>'."\n";
}
if (strlen($this->title) >0) {
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
}
if (strlen($this->about) >0) {
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
}
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
if (strlen($this->publisher) >0) {
$this->output .= (string) '<dc:publisher>'.$this->publisher .'</dc:publisher>'."\n";
}
if (strlen($this->creator) >0) {
$this->output .= (string) '<dc:creator>'.$this->creator .'</dc:creator>'."\n";
}
if (strlen($this->date) >0) {
$this->output .= (string) '<dc:date>'.$this->date .'</dc:date>'."\n";
}
if (strlen($this->language) >0) {
$this->output .= (string) '<dc:language>'.$this->language .'</dc:language>'."\n";
}
if (strlen($this->rights) >0) {
$this->output .= (string) '<dc:rights>'.$this->rights .'</dc:rights>'."\n";
}
if (strlen($this->coverage) >0) {
$this->output .= (string) '<dc:coverage>'.$this->coverage .'</dc:coverage>'."\n";
}
if (strlen($this->contributor) >0) {
$this->output .= (string) '<dc:contributor>'.$this->contributor .'</dc:contributor>'."\n";
}
if (strlen($this->period) >0) {
$this->output .= (string) '<sy:updatePeriod>'.$this->period .'</sy:updatePeriod>'."\n";
}
if (strlen($this->frequency) >0) {
$this->output .= (string) '<sy:updateFrequency>'.$this->frequency .'</sy:updateFrequency>'."\n";
}
if (strlen($this->base) >0) {
$this->output .= (string) '<sy:updateBase>'.$this->base .'</sy:updateBase>'."\n";
}
if (strlen($this->image_link) >0) {
$this->output .= (string) '<image rdf:about="'.$this->image_link .'">'."\n";
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
$this->output .= (string) '<url>'.$this->image_link .'</url>'."\n";
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
$this->output .= (string) '</image>'."\n";
}
if (count($this->getItemList()) >0) {
$this->output .= (string) '<items><rdf:Seq>'."\n";
foreach ($this->getItemList() as $id) {
$item =&$this->items[$id];
if (strlen($item->getAbout()) >0) {
$this->output .= (string) ' <rdf:li resource="'.$item->getAbout() .'" />'."\n";
}
}
$this->output .= (string) '</rdf:Seq></items>'."\n";
}
$this->output .= (string) '</channel>'."\n";
if (count($this->getItemList()) >0) {
foreach ($this->getItemList() as $id) {
$item =&$this->items[$id];
if (strlen($item->getTitle()) >0 &&strlen($item->getLink()) >0) {
if (strlen($item->getAbout()) >0) {
$this->output .= (string) '<item rdf:about="'.$item->getAbout() .'">'."\n";
}else {
$this->output .= (string) '<item>'."\n";
}
$this->output .= (string) '<title>'.$item->getTitle() .'</title>'."\n";
$this->output .= (string) '<link>'.$item->getLink() .'</link>'."\n";
if (strlen($item->getDescription()) >0) {
$this->output .= (string) '<description>'.$item->getDescription() .'</description>'."\n";
}
if ($this->use_dc_data === TRUE &&strlen($item->getSubject()) >0) {
$this->output .= (string) '<dc:subject>'.$item->getSubject() .'</dc:subject>'."\n";
}
if ($this->use_dc_data === TRUE &&strlen($item->getDate()) >0) {
$this->output .= (string) '<dc:date>'.$item->getDate() .'</dc:date>'."\n";
}
if (strlen($item->getImage()) >0) {
$this->output .= (string) '<im:image>'.$item->getImage() .'</im:image>'."\n";
}
$this->output .= (string) '</item>'."\n";
}
}
}
$this->output .= (string) '</rdf:RDF>';
}
function createOutputV200() {
$this->output  = (string) '<rss version="2.0" xmlns:im="http://purl.org/rss/1.0/item-images/" ';
if ($this->use_dc_data === TRUE) {
$this->output .= (string) 'xmlns:dc="http://purl.org/dc/elements/1.1/" ';
}
if ($this->use_sy_data === TRUE) {
$this->output .= (string) 'xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" ';
}
$this->output .= (string) '>'."\n";
$this->output .= (string) '<channel>'."\n";
if (strlen($this->rights) >0) {
$this->output .= (string) '<copyright>'.$this->rights .'</copyright>'."\n";
}
if (strlen($this->date) >0) {
$this->output .= (string) '<pubDate>'.$this->date .'</pubDate>'."\n";
$this->output .= (string) '<lastBuildDate>'.$this->date .'</lastBuildDate>'."\n";
}
if (strlen($this->about) >0) {
$this->output .= (string) '<docs>'.$this->about .'</docs>'."\n";
}
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
if (strlen($this->about) >0) {
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
}
if (strlen($this->title) >0) {
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
}
if (strlen($this->image_link) >0) {
$this->output .= (string) '<image>'."\n";
$this->output .= (string) '<title>'.$this->title .'</title>'."\n";
$this->output .= (string) '<url>'.$this->image_link .'</url>'."\n";
$this->output .= (string) '<link>'.$this->about .'</link>'."\n";
if (strlen($this->description) >0) {
$this->output .= (string) '<description>'.$this->description .'</description>'."\n";
}
$this->output .= (string) '</image>'."\n";
}
if (strlen($this->publisher) >0) {
$this->output .= (string) '<managingEditor>'.$this->publisher .'</managingEditor>'."\n";
}
if (strlen($this->creator) >0) {
$this->output .= (string) '<webMaster>'.$this->creator .'</webMaster>'."\n";
$this->output .= (string) '<generator>'.$this->creator .'</generator>'."\n";
}
if (strlen($this->language) >0) {
$this->output .= (string) '<language>'.$this->language .'</language>'."\n";
}
if (strlen($this->category) >0) {
$this->output .= (string) '<category>'.$this->category .'</category>'."\n";
}
if (strlen($this->cache) >0) {
$this->output .= (string) '<ttl>'.$this->cache .'</ttl>'."\n";
}
if (strlen($this->publisher) >0) {
$this->output .= (string) '<dc:publisher>'.$this->publisher .'</dc:publisher>'."\n";
}
if (strlen($this->creator) >0) {
$this->output .= (string) '<dc:creator>'.$this->creator .'</dc:creator>'."\n";
}
if (strlen($this->date) >0) {
$this->output .= (string) '<dc:date>'.$this->date .'</dc:date>'."\n";
}
if (strlen($this->language) >0) {
$this->output .= (string) '<dc:language>'.$this->language .'</dc:language>'."\n";
}
if (strlen($this->rights) >0) {
$this->output .= (string) '<dc:rights>'.$this->rights .'</dc:rights>'."\n";
}
if (strlen($this->coverage) >0) {
$this->output .= (string) '<dc:coverage>'.$this->coverage .'</dc:coverage>'."\n";
}
if (strlen($this->contributor) >0) {
$this->output .= (string) '<dc:contributor>'.$this->contributor .'</dc:contributor>'."\n";
}
if (strlen($this->period) >0) {
$this->output .= (string) '<sy:updatePeriod>'.$this->period .'</sy:updatePeriod>'."\n";
}
if (strlen($this->frequency) >0) {
$this->output .= (string) '<sy:updateFrequency>'.$this->frequency .'</sy:updateFrequency>'."\n";
}
if (strlen($this->base) >0) {
$this->output .= (string) '<sy:updateBase>'.$this->base .'</sy:updateBase>'."\n";
}
if (count($this->getItemList()) >0) {
foreach ($this->getItemList() as $id) {
$item =&$this->items[$id];
if (strlen($item->getTitle()) >0 &&strlen($item->getLink()) >0) {
$this->output .= (string) '<item>'."\n";
$this->output .= (string) '<title>'.$item->getTitle() .'</title>'."\n";
$this->output .= (string) '<link>'.$item->getLink() .'</link>'."\n";
if (strlen($item->getDescription()) >0) {
$this->output .= (string) '<description>'.$item->getDescription() .'</description>'."\n";
}
if ($this->use_dc_data === TRUE &&strlen($item->getSubject()) >0) {
$this->output .= (string) '<category>'.$item->getSubject() .'</category>'."\n";
}
if ($this->use_dc_data === TRUE &&strlen($item->getDate()) >0) {
$this->output .= (string) '<pubDate>'.$item->getDate() .'</pubDate>'."\n";
}
if (strlen($item->getAbout()) >0) {
$this->output .= (string) '<guid>'.$item->getAbout() .'</guid>'."\n";
}
if (strlen($item->getAuthor()) >0) {
$this->output .= (string) '<author>'.$item->getAuthor() .'</author>'."\n";
}
if (strlen($item->getComments()) >0) {
$this->output .= (string) '<comments>'.$item->getComments() .'</comments>'."\n";
}
if (strlen($item->getImage()) >0) {
$this->output .= (string) '<im:image>'.$item->getImage() .'</im:image>'."\n";
}
$this->output .= (string) '</item>'."\n";
}
}
}
$this->output .= (string) '</channel>'."\n";
$this->output .= (string) '</rss>'."\n";
}
function createOutput($version = '') {
if (strlen(trim($version)) === 0) {
$version = (string) '1.0';
}
switch ($version) {
case '0.9':
$this->createOutputV090();
break;
case '0.91':
$this->createOutputV091();
break;
case '2.00':
$this->createOutputV200();
break;
case '1.0':
default:
$this->createOutputV100();
break;
}
}
function outputRSS($version = '') {
if (!isset($this->output)) {
$this->createOutput($version);
}
header ('content-type: text/xml');
header('Content-Disposition: inline; filename=rss_'.str_replace(' ','',$this->title) .'.xml');
$this->output = '<?xml version="1.0" encoding="'.$this->encoding .'"?>'."\n".
'<!--  RSS generated by house5.net RSS Builder ['.date('Y-m-d H:i:s')  .']  --> '."\n".$this->output;
echo $this->output;
}
function getRSSOutput($version = '') {
if (!isset($this->output)) {
$this->createOutput($version);
}
return (string) '<?xml version="1.0" encoding="'.$this->encoding .'"?>'."\n".
'<!--  RSS generated by house5.net RSS Builder ['.date('Y-m-d H:i:s')  .']  --> '.$this->output;
}
}
class RSSItem extends RSSBase {
var $about;
var $title;
var $link;
var $description;
var $subject;
var $date;
var $author;
var $comments;
var $image;
function RSSItem($about = '',
$title = '',
$link = '',
$description = '',
$subject = '',
$date = '',
$author = '',
$comments = '',
$image = '') {
$this->setAbout($about);
$this->setTitle($title);
$this->setLink($link);
$this->setDescription($description);
$this->setSubject($subject);
$this->setDate($date);
$this->setAuthor($author);
$this->setComments($comments);
$this->setImage($image);
}
function setAbout($about = '') {
if (!isset($this->about) &&strlen(trim($about)) >0) {
$this->about = (string) trim($about);
}
}
function setTitle($title = '') {
if (!isset($this->title) &&strlen(trim($title)) >0) {
$this->title = (string) trim($title);
}
}
function setLink($link = '') {
if (!isset($this->link) &&strlen(trim($link)) >0) {
$this->link = (string) trim($link);
}
}
function setDescription($description = '') {
if (!isset($this->description) &&strlen(trim($description)) >0) {
$this->description = (string) trim($description);
}
}
function setSubject($subject = '') {
if (!isset($this->subject) &&strlen(trim($subject)) >0) {
$this->subject = (string) trim($subject);
}
}
function setDate($date = '') {
if (!isset($this->date) &&strlen(trim($date)) >0) {
$this->date = (string) trim($date);
}
}
function setAuthor($author = '') {
if (!isset($this->author) &&strlen(trim($author)) >0) {
$this->author = (string) trim($author);
}
}
function setComments($comments = '') {
if (!isset($this->comments) &&strlen(trim($comments)) >0) {
$this->comments = (string) trim($comments);
}
}
function setImage($image = '') {
if (!isset($this->image) &&strlen(trim($image)) >0) {
$this->image = (string) trim($image);
}
}
function getAbout() {
return (string) $this->about;
}
function getTitle() {
return (string) $this->title;
}
function getLink() {
return (string) $this->link;
}
function getDescription() {
return (string) $this->description;
}
function getSubject() {
return (string) $this->subject;
}
function getDate() {
return (string) $this->date;
}
function getAuthor() {
return (string) $this->author;
}
function getComments() {
return (string) $this->comments;
}
function getImage() {
return (string) $this->image;
}
}
?>