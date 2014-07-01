<?php

class formguide_input {
var $formid;
var $fields;
var $data;
function __construct($formid) {
$this->formid = $formid;
$this->fields = getcache('formguide_field_'.$formid,'model');
$this->siteid = get_siteid();
h5_base::load_sys_class('attachment','',0);
$this->siteid = param::get_cookie('siteid');
$this->attachment = new attachment('formguide','0',$this->siteid);
$this->site_config = getcache('sitelist','commons');
$this->site_config = $this->site_config[$this->siteid];
}
function get($data,$isimport = 0) {
$this->data = $data;
$info = array();
foreach($this->fields as $field) {
$name = $field['name'];
$minlength = $field['minlength'];
$maxlength = $field['maxlength'];
$pattern = $field['pattern'];
$errortips = $field['errortips'];
$value = $data[$field['field']];
if(empty($errortips)) $errortips = $name.' '.L('not_meet_the_conditions');
$length = is_array($value) ?(empty($value) ?0 : 1) : strlen($value);
if($minlength &&$length <$minlength) {
if($isimport) {
return false;
}else {
showmessage($name.' '.L('not_less_than').' '.$minlength.L('characters'));
}
}
if($maxlength &&$length >$maxlength) {
if($isimport) {
$value = str_cut($value,$maxlength,'');
}else {
showmessage($name.' '.L('not_more_than').' '.$maxlength.L('characters'));
}
}elseif($maxlength) {
$value = str_cut($value,$maxlength,'');
}
if($pattern &&$length &&!preg_match($pattern,$value) &&!$isimport) showmessage($errortips);
$func = $field['formtype'];
if(method_exists($this,$func)) $value = $this->$func($field['field'],$value);
$info[$field['field']] = $value;
if ($_POST['style_color']) $info['style'] = $_POST['style_color'];
if($_POST['style_font_weight']) $info['style'] = $info['style'].';'.strip_tags($_POST['style_font_weight']);
}
return $info;
}
}�U?>