<?php

defined('IN_HOUSE5') or exit('No permission resources.');
if(empty($_GET['title']) ||empty($_GET['url'])) {
exit('-2');
}else {
$title = $_GET['title'];
$title = addslashes(urldecode($title));
if(CHARSET != 'utf-8') {
$title = iconv('utf-8',CHARSET,$title);
$title = addslashes($title);
}
$title = htmlspecialchars($title);
$url = safe_replace(addslashes(urldecode($_GET['url'])));
$url = trim_script($url);
}
$_GET['callback'] = safe_replace($_GET['callback']);
$house5_auth = param::get_cookie('auth');
if($house5_auth) {
$auth_key = md5(h5_base::load_config('system','auth_key').$_SERVER['HTTP_USER_AGENT']);
list($userid,$password) = explode("\t",sys_auth($house5_auth,'DECODE',$auth_key));
if($userid >0) {
}else {
exit(trim_script($_GET['callback']).'('.json_encode(array('status'=>-1)).')');
}
}else {
exit(trim_script($_GET['callback']).'('.json_encode(array('status'=>-1)).')');
}
$favorite_db = h5_base::load_model('favorite_model');
$data = array('title'=>$title,'url'=>$url,'adddate'=>SYS_TIME,'userid'=>$userid);
$is_exists = $favorite_db->get_one(array('url'=>$url,'userid'=>$userid));
if(!$is_exists) {
$favorite_db->insert($data);
}
exit(trim_script($_GET['callback']).'('.json_encode(array('status'=>1)).')');
?>