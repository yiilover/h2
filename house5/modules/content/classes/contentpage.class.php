<?php

class contentpage {
private $additems = array ();
private $bottonitems = array ();
private $html_tag = array ();
private $surplus;
public $content;
public function __construct() {
$this->html_tag = array ('p','div','h','span','strong','ul','ol','li','table','tr','tbody','dl','dt','dd');
$this->html_end_tag = array ('/p','/div','/h','/span','/strong','/ul','/ol','/li','/table','/tr','/tbody','/dl','/dt','/dd');
$this->content = '';
$this->data = array();
}
public function get_data($content = '',$maxwords = 10000) {
if (!$content) return '';
$this->data = array();
$this->content = '';
$this->surplus = $maxwords;
if (strpos($content,'<')!==false) {
$content_arr = explode('<',$content);
$this->total = count($content_arr);
foreach ($content_arr as $t =>$c) {
if ($c) {
$s = strtolower($c);
if ((strpos($c,' ')!==false) &&(strpos($c,'>')===false)) {
$min_point = intval(strpos($c,' '));
}elseif ((strpos($c,' ')===false) &&(strpos($c,'>')!==false)) {
$min_point = intval(strpos($c,'>'));
}elseif ((strpos($c,' ')!==false) &&(strpos($c,'>')!==false)) {
$min_point = min(intval(strpos($c,' ')),intval(strpos($c,'>')));
}
$find = substr($c,0,$min_point);
if (in_array(strtolower($find),$this->html_tag)) {
$str = '<'.$c;
$this->bottonitems[$t] = '</'.$find.'>';
if(preg_match('/<'.$find.'(.*)>/i',$str,$match)) {
$this->additems[$t] = $match[0];
}
$this->separate_content($str,$maxwords,$match[0],$t);
}elseif (in_array(strtolower($find),$this->html_end_tag)) {
ksort($this->bottonitems);
ksort($this->additems);
if (is_array($this->bottonitems) &&!empty($this->bottonitems)) array_pop($this->bottonitems);
if (is_array($this->additems) &&!empty($this->additems)) array_pop($this->additems);
$str = '<'.$c;
$this->separate_content($str,$maxwords,'',$t);
}else {
$tag = '<'.$c;
if ($this->surplus >= 0) {
$this->surplus = $this->surplus-strlen(strip_tags($tag));
if ($this->surplus<0) {
$this->surplus = 0;
}
}
$this->content .= $tag;
if (intval($t+1) == $this->total) {
$this->content .= $this->bottonitem();
$this->data[] = $this->content;
}
}
}
}
}else {
$this->content .= $this->separate_content($content,$maxwords);
}
return implode('[page]',$this->data);
}
private function separate_content($str = '',$max,$tag = '',$t = 0,$n = 1,$total = 0) {
$html = $str;
$str = strip_tags($str);
if ($str) $str = @str_replace(array('¡¡'),'',$str);
if ($str) {
if ($n == 1) {
$total = ceil((strlen($str)-$this->surplus)/$max)+1;
}
if ($total<$n) {
return true;
}else {
$n++;
}
if (strlen($str)>$this->surplus) {
$remove_str = str_cut($str,$this->surplus,'');
$this->content .= $tag.$remove_str;
$this->content .= $this->bottonitem();
$this->data[] = $this->content;
$this->content = '';
$this->content .= $this->additem();
$str = str_replace($remove_str,'',$str);
$this->surplus = $max;
return $this->separate_content($str,$max,'',$t,$n,$total);
}elseif (strlen($str)==$this->surplus) {
$this->content .= $html;
$this->content .= $this->bottonitem();
if (intval($t+1) != $this->total) {
$this->data[] = $this->content;
$this->content = '';
$this->content .= $this->additem();
}
$this->surplus = $max;
}else {
$this->content .= $html;
if (intval($t+1) == $this->total) {
$this->content .= $this->bottonitem();
$this->data[] = $this->content;
}
$this->surplus = $this->surplus-strlen($str);
}
}else {
$this->content .= $html;
if ($this->surplus == 0) {
$this->content .= $this->bottonitem();
if (intval($t+1) != $this->total) {
$this->data[] = $this->content;
$this->content = '';
$this->surplus = $max;
$this->content .= $this->additem();
}
}
}
if ($t==($this->total-1)) {
$pop_arr = array_pop($this->data);
if ($pop = strip_tags($pop_arr)) {
$this->data[] = $pop_arr;
}
}
return true;
}
private function additem() {
$content = '';
if (is_array($this->additems) &&!empty($this->additems)) {
ksort($this->additems);
foreach ($this->additems as $add) {
$content .= $add;
}
}
return $content;
}
private function bottonitem() {
$content = '';
if (is_array($this->bottonitems) &&!empty($this->bottonitems)) {
krsort($this->bottonitems);
foreach ($this->bottonitems as $botton) {
$content .= $botton;
}
}
return $content;
}
}
;echo ' ';?>