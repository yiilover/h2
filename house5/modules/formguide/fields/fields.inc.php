<?php

$fields = array('text'=>'�����ı�',
'textarea'=>'�����ı�',
'editor'=>'�༭��',
'box'=>'ѡ��',
'image'=>'ͼƬ',
'images'=>'��ͼƬ',
'number'=>'����',
'datetime'=>'���ں�ʱ��',
'linkage'=>'�����˵�',
);
$not_allow_fields = array('catid','typeid','title','keyword','posid','template','username');
$unique_fields = array('pages','readpoint','author','copyfrom','islink');
$forbid_fields = array('catid','title','updatetime','inputtime','url','listorder','status','template','username');
$forbid_delete = array('catid','typeid','title','thumb','keywords','updatetime','inputtime','posids','url','listorder','status','template','username');
$att_css_js = array('text','textarea','box','number','keyword','typeid');
?>