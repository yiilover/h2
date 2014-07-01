<?php

class qqapi{
private $appid,$appkey,$callback;
public function __construct($appid,$appkey,$callback){
$this->appid = $appid;
$this->appkey = $appkey;
$this->callback = $callback;
h5_base::load_app_func('utils');
}
public function redirect_to_login()
{
$redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=$this->appid&";
$result = array();
$request_token = $this->get_request_token($this->appid,$this->appkey);
parse_str($request_token,$result);
$_SESSION["token"]        = $result["oauth_token"];
$_SESSION["secret"]       = $result["oauth_token_secret"];
if ($result["oauth_token"] == "")
{
exit;
}
$redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($this->callback);
header("Location:$redirect");
}
public function get_request_token($appid,$appkey)
{
$url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token?";
$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token")."&";
$params = array();
$params["oauth_version"]          = "1.0";
$params["oauth_signature_method"] = "HMAC-SHA1";
$params["oauth_timestamp"]        = time();
$params["oauth_nonce"]            = mt_rand();
$params["oauth_consumer_key"]     = $appid;
$normalized_str = get_normalized_string($params);
$sigstr        .= rawurlencode($normalized_str);
$key = $appkey."&";
$signature = get_signature($sigstr,$key);
$url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
return file_get_contents($url);
}
public function get_openid(){
if (!is_valid_openid($this->appkey,$_REQUEST["openid"],$_REQUEST["timestamp"],$_REQUEST["oauth_signature"]))
{
echo "###invalid openid\n";
echo "sig:".$_REQUEST["oauth_signature"]."\n";
exit;
}
$access_str = $this->get_access_token($this->appid,$this->appkey,$_REQUEST["oauth_token"],$_SESSION["secret"],$_REQUEST["oauth_vericode"]);
$result = array();
parse_str($access_str,$result);
if (isset($result["error_code"]))
{
echo "get access token error<br>";
echo "error msg: $request_token<br>";
echo "µã»÷<a href=\"http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91%E5%85%AC%E5%85%B1%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E\" target=_blank>²é¿´´íÎóÂë</a>";
exit;
}
$_SESSION["token"]   = $result["oauth_token"];
$_SESSION["secret"]  = $result["oauth_token_secret"];
$_SESSION["openid"]  = $result["openid"];
}
public function get_access_token($appid,$appkey,$request_token,$request_token_secret,$vericode)
{
$url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token?";
$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token")."&";
$params = array();
$params["oauth_version"]          = "1.0";
$params["oauth_signature_method"] = "HMAC-SHA1";
$params["oauth_timestamp"]        = time();
$params["oauth_nonce"]            = mt_rand();
$params["oauth_consumer_key"]     = $appid;
$params["oauth_token"]            = $request_token;
$params["oauth_vericode"]         = $vericode;
$normalized_str = get_normalized_string($params);
$sigstr        .= rawurlencode($normalized_str);
$key = $appkey."&".$request_token_secret;
$signature = get_signature($sigstr,$key);
$url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
return file_get_contents($url);
}
public function get_user_info()
{
$url    = "http://openapi.qzone.qq.com/user/get_user_info";
$info   = do_get($url,$this->appid,$this->appkey,$_SESSION["token"],$_SESSION["secret"],$_SESSION["openid"]);
$arr = array();
$arr = json_decode($info,true);
return $arr;
}
}
?>