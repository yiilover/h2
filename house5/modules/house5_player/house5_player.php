<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
class house5_player extends admin {
private $db;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('house5_player_model');
}
public function init(){
if(isset($_POST['dosubmit'])) {
$_POST['info']['video_type'] = intval($_POST['info']['video_type']);
$_POST['info']['video_default_status'] = intval($_POST['info']['video_default_status']);
$_POST['info']['ck_http_set'] = intval($_POST['info']['ck_http_set']);
$_POST['info']['ck_style'] =  safe_replace($_POST['info']['ck_style']);
$_POST['info']['ck_volume'] = intval($_POST['info']['ck_volume']);
$_POST['info']['ck_size'] =   safe_replace($_POST['info']['ck_size']);
$_POST['info']['ck_html5'] = intval($_POST['info']['ck_html5']);
$_POST['info']['thumb_load'] = safe_replace($_POST['info']['thumb_load']);
$_POST['info']['thumb_pause_ad'] = safe_replace($_POST['info']['thumb_pause_ad']);
$_POST['info']['url_pause_ad'] = safe_replace($_POST['info']['url_pause_ad']);
$_POST['info']['beff_ad'] = safe_replace($_POST['info']['beff_ad']);
$_POST['info']['time_qz_ad'] = safe_replace($_POST['info']['time_qz_ad']);
$_POST['info']['thumb_qz_ad'] = safe_replace($_POST['info']['thumb_qz_ad']);
$_POST['info']['url_qz_ad'] = safe_replace($_POST['info']['url_qz_ad']);
if($_POST['info']['ck_volume']<0){
$_POST['info']['ck_volume'] = 0;
}elseif ($_POST['info']['ck_volume']>100){
$_POST['info']['ck_volume'] = 100;
}
if(empty($_POST['info']['ck_size'])) {
showmessage(L('播放器尺寸不能为空'),HTTP_REFERER);
}
if(empty($_POST['info']['ck_volume'])) {
showmessage(L('默认音量不能为空'),HTTP_REFERER);
}
$ckid = $this->db->update($_POST['info'],array('id'=>1));
if(!$ckid){
showmessage(L('更新失败!'),HTTP_REFERER);
}
showmessage(L('operation_success'),'?s=house5_player/house5_player/init','','edit');
}else{
$info = $this->db->get_one();
if(!$info) showmessage('数据不存在!');
extract($info);
include $this ->admin_tpl('appqy_edit');
}
}
}
?>