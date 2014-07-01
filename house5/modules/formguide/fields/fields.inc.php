<?php

$fields = array('text'=>'单行文本',
'textarea'=>'多行文本',
'editor'=>'编辑器',
'box'=>'选项',
'image'=>'图片',
'images'=>'多图片',
'number'=>'数字',
'datetime'=>'日期和时间',
'linkage'=>'联动菜单',
);
$not_allow_fields = array('catid','typeid','title','keyword','posid','template','username');
$unique_fields = array('pages','readpoint','author','copyfrom','islink');
$forbid_fields = array('catid','title','updatetime','inputtime','url','listorder','status','template','username');
$forbid_delete = array('catid','typeid','title','thumb','keywords','updatetime','inputtime','posids','url','listorder','status','template','username');
$att_css_js = array('text','textarea','box','number','keyword','typeid');
?>