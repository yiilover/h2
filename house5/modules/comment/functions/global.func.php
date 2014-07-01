<?php

function decode_commentid($commentid) {
return explode('-',$commentid);
}
function direction($direction) {
switch($direction){
case 1:
return '<img src="'.IMG_PATH.'/icon/zheng.png" />';
break;
case 2:
return '<img src="'.IMG_PATH.'/icon/fan.png" />';
break;
case 3:
return '<img src="'.IMG_PATH.'/icon/zhong.png" />';
break;
}
}
function get_comment_api($commentid) {
list($modules,$contentid,$siteid) = id_decode($commentid);
if (empty($modules) ||empty($siteid) ||empty($contentid)) {
return false;
}
$comment_api = '';
$module = explode('_',$modules);
$comment_api = h5_base::load_app_class('comment_api',$module[0]);
if (empty($comment_api)) return false;
return $comment_api->get_info($modules,$contentid,$siteid);
}?>