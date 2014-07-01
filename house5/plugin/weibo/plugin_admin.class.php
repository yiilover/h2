<?php
	defined('IN_HOUSE5') or exit('No permission resources.');
class plugin_admin {
function __construct($pluginid) {
$this->pluginid = $pluginid;
$this->op = h5_base::load_app_class('plugin_op');
$this->auth_db = h5_base::load_plugin_model('weibo_auth_info_model');
}
public function oauth() {
h5_base::load_plugin_class('weibooauth','',0);
$setting = getcache('weibo_var','plugins');
if(!isset($_REQUEST['oauth_verifier']) ||$_REQUEST['oauth_verifier'] == '') {
if($this->auth_db->get_one(array('source'=>'sina'))) {
$txt = '授权成功，<a href="?s=admin/plugin/config&pluginid='.$this->pluginid.'&module=removeauth&h5_hash='.$_SESSION['h5_hash'].'">解除绑定</a>';
}else {
$o = new WeiboOAuth( $setting['wb_akey'] ,$setting['wb_skey']);
$keys = $o->getRequestToken();
print_r($keys);
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false ,get_url());
$_SESSION['keys'] = $keys;
$txt = '<a href="'.$aurl.'">点击进行授权</a>';
}
}else {
$o = new WeiboOAuth( $setting['wb_akey'] ,$setting['wb_skey'] ,$_SESSION['keys']['oauth_token'] ,$_SESSION['keys']['oauth_token_secret']  );
$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
$c = new WeiboClient( $setting['wb_akey'] ,$setting['wb_skey'] ,$last_key['oauth_token'] ,$last_key['oauth_token_secret']  );
$ms  = $c->home_timeline();
$me = $c->verify_credentials();
$this->auth_db->insert(array('uid'=>$me['id'],'token'=>$last_key['oauth_token'],'tsecret'=>$last_key['oauth_token_secret'],'source'=>'sina'));
$txt = '授权成功，'.$me['name'].'<a href="?s=admin/plugin/config&pluginid='.$this->pluginid.'&module=removeauth&h5_hash='.$_SESSION['h5_hash'].'">解除绑定</a>';
}
include $this->op->plugin_tpl('oauth',PLUGIN_ID);
}
public function removeauth() {
if($this->auth_db->delete(array('source'=>'sina'))) {
showmessage('ok');
}else {
showmessage('fail');
}
}
public function pushtoweibo() {
prnt_r($_GET);
}
}
?>