<?php

class reviews_tag {
private $reviews_db,$reviews_setting_db,$reviews_data_db,$reviews_table_db;
public function __construct() {
$this->reviews_db = h5_base::load_model('reviews_model');
$this->reviews_setting_db = h5_base::load_model('reviews_setting_model');
$this->reviews_data_db = h5_base::load_model('reviews_data_model');
$this->reviews_table_db = h5_base::load_model('reviews_table_model');
}
public function count($data) {
if($data['action']=='get_reviews') return 0;
$reviewsid = $data['reviewsid'];
if (empty($reviewsid)) return false;
$siteid = $data['siteid'];
if (empty($siteid)) {
h5_base::load_app_func('global','comment');
list($module,$contentid,$siteid) = decode_reviewsid($reviewsid);
}
$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid,'siteid'=>$siteid));
if (!$reviews) return false;
$direction = isset($data['direction']) &&intval($data['direction']) ?intval($data['direction']) : 0;
switch ($direction) {
case 1:
return $reviews['square'];
break;
case 2:
return $reviews['anti'];
break;
case 3:
return $reviews['neutral'];
break;
default:
return $reviews['total'];
}
}
public function get_reviews($data) {
$reviewsid = $data['reviewsid'];
if (empty($reviewsid)) return false;
$this->reviews_db->table_name = 'h5_reviews';
return $this->reviews_db->get_one(array('reviewsid'=>$reviewsid));
}
public function get_reviewscount($data) {
$reviewsid = $data['reviewsid'];
if (empty($reviewsid)) return false;
$info = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid));
if($info)
{
return $info['total'];
}
else
return 0;
}
public function lists($data) {
$reviewsid = $data['reviewsid'];
if (empty($reviewsid)) return false;
$siteid = $data['siteid'];
if (empty($siteid)) {
h5_base::load_app_func('global','reviews');
list($module,$contentid,$siteid) = decode_reviewsid($reviewsid);
}
$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid,'siteid'=>$siteid));
if (!$reviews) return false;
$this->reviews_data_db->table_name($reviews['tableid']);
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
$sql = array('reviewsid'=>$reviewsid,'direction'=>1,'status'=>1);
break;
case 2:
$sql = array('reviewsid'=>$reviewsid,'direction'=>2,'status'=>1);
break;
case 3:
$sql = array('reviewsid'=>$reviewsid,'direction'=>3,'status'=>1);
break;
default:
$sql = array('reviewsid'=>$reviewsid,'status'=>1);
}
return $this->reviews_data_db->select($sql,'*',$data['limit'],$hot.' desc ');
}
public function impression_lists($data) {
$houseid = $data['houseid'];
if (empty($houseid)) return false;
$data['limit'] = intval($data['limit']);
if (!isset($data['limit']) ||empty($data['limit'])) {
$data['limit'] = 10;
}
$siteid = $data['siteid'];
$this->reviews_db->table_name = 'h5_impression';
$sql = array('houseid'=>$houseid,'siteid'=>$siteid);
return $this->reviews_db->select($sql,'impression,count(id) as counts',$data['limit'],'count(id) desc ','impression');
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
return $this->reviews_db->select($sql,"*",$data['limit'],"total desc");
}
public function h5_tag() {
$sites = h5_base::load_app_class('sites','admin');
$sitelist = $sites->h5_tag_list();
return array(
'action'=>array('lists'=>L('list','','comment'),'get_comment'=>L('comments_on_the_survey','','comment'),'bang'=>L('comment_bang','','comment')),
'lists'=>array(
'reviewsid'=>array('name'=>L('comments_id','','comment'),'htmltype'=>'input','validator'=>array('min'=>1)),
'siteid'=>array('name'=>L('site_id','','comment'),'htmltype'=>'input_select','data'=>$sitelist,'validator'=>array('min'=>1)),
'direction'=>array('name'=>L('comments_direction','','comment'),'htmltype'=>'select','data'=>array('0'=>L('jiushishuo','','comment'),'1'=>L('tetragonal','','comment'),'2'=>L('cons','','comment'),'3'=>L('neutrality','','comment'))),
'hot'=>array('name'=>L('sort','','comment'),'htmltype'=>'select','data'=>array('0'=>L('new','','comment'),'1'=>L('hot','','comment'))),
),
'get_comment'=>array('reviewsid'=>array('name'=>L('comments_id','','comment'),'htmltype'=>'input','defaultdata'=>'$reviewsid')),
);
}
}?>