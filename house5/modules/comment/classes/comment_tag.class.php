<?php

class comment_tag {
private $comment_db,$comment_setting_db,$comment_data_db,$comment_table_db;
public function __construct() {
$this->comment_db = h5_base::load_model('comment_model');
$this->comment_setting_db = h5_base::load_model('comment_setting_model');
$this->comment_data_db = h5_base::load_model('comment_data_model');
$this->comment_table_db = h5_base::load_model('comment_table_model');
}
public function count($data) {
if($data['action']=='get_comment') return 0;
$commentid = $data['commentid'];
if (empty($commentid)) return false;
$siteid = $data['siteid'];
if (empty($siteid)) {
h5_base::load_app_func('global','comment');
list($module,$contentid,$siteid) = decode_commentid($commentid);
}
$comment = $this->comment_db->get_one(array('commentid'=>$commentid,'siteid'=>$siteid));
if (!$comment) return false;
$direction = isset($data['direction']) &&intval($data['direction']) ?intval($data['direction']) : 0;
switch ($direction) {
case 1:
return $comment['square'];
break;
case 2:
return $comment['anti'];
break;
case 3:
return $comment['neutral'];
break;
default:
return $comment['total'];
}
}
public function get_comment($data) {
$commentid = $data['commentid'];
if (empty($commentid)) return false;
return $this->comment_db->get_one(array('commentid'=>$commentid));
}
public function lists($data) {
$commentid = $data['commentid'];
if (empty($commentid)) return false;
$siteid = $data['siteid'];
if (empty($siteid)) {
h5_base::load_app_func('global','comment');
list($module,$contentid,$siteid) = decode_commentid($commentid);
}
$comment = $this->comment_db->get_one(array('commentid'=>$commentid,'siteid'=>$siteid));
if (!$comment) return false;
$this->comment_data_db->table_name($comment['tableid']);
$hot = 'id';
if (isset($data['hot']) &&!empty($data['hot'])) {
$hot = 'support desc, id';
}
$direction = isset($data['direction']) &&intval($data['direction']) ?intval($data['direction']) : 0;
if (!in_array($direction,array(0,1,2,3))) {
$direction = 0;
}
switch ($direction) {
case 1:
$sql = array('commentid'=>$commentid,'direction'=>1,'status'=>1);
break;
case 2:
$sql = array('commentid'=>$commentid,'direction'=>2,'status'=>1);
break;
case 3:
$sql = array('commentid'=>$commentid,'direction'=>3,'status'=>1);
break;
default:
$sql = array('commentid'=>$commentid,'status'=>1);
}
return $this->comment_data_db->select($sql,'*',$data['limit'],$hot.' desc ');
}
public function bang($data) {
$data['limit'] = intval($data['limit']);
if (!isset($data['limit']) ||empty($data['limit'])) {
$data['limit'] = 10;
}
$sql =  array();
$data['siteid'] = intval($data['siteid']);
if (isset($data['siteid']) &&!empty($data['siteid'])) {
$sql = array('siteid'=>$data['siteid']);
}
return $this->comment_db->select($sql,"*",$data['limit'],"total desc");
}
public function h5_tag() {
$sites = h5_base::load_app_class('sites','admin');
$sitelist = $sites->h5_tag_list();
return array(
'action'=>array('lists'=>L('list','','comment'),'get_comment'=>L('comments_on_the_survey','','comment'),'bang'=>L('comment_bang','','comment')),
'lists'=>array(
'commentid'=>array('name'=>L('comments_id','','comment'),'htmltype'=>'input','validator'=>array('min'=>1)),
'siteid'=>array('name'=>L('site_id','','comment'),'htmltype'=>'input_select','data'=>$sitelist,'validator'=>array('min'=>1)),
'direction'=>array('name'=>L('comments_direction','','comment'),'htmltype'=>'select','data'=>array('0'=>L('jiushishuo','','comment'),'1'=>L('tetragonal','','comment'),'2'=>L('cons','','comment'),'3'=>L('neutrality','','comment'))),
'hot'=>array('name'=>L('sort','','comment'),'htmltype'=>'select','data'=>array('0'=>L('new','','comment'),'1'=>L('hot','','comment'))),
),
'get_comment'=>array('commentid'=>array('name'=>L('comments_id','','comment'),'htmltype'=>'input','defaultdata'=>'$commentid')),
);
}
}?>