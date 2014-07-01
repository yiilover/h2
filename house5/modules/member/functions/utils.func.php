<?php

function get_normalized_string($params)
{
ksort($params);
$normalized = array();
foreach($params as $key =>$val)
{
$normalized[] = $key."=".$val;
}
return implode("&",$normalized);
}
function get_signature($str,$key)
{
$signature = "";
if (function_exists('hash_hmac'))
{
$signature = base64_encode(hash_hmac("sha1",$str,$key,true));
}
else
{
$blocksize	= 64;
$hashfunc	= 'sha1';
if (strlen($key) >$blocksize)
{
$key = pack('H*',$hashfunc($key));
}
$key	= str_pad($key,$blocksize,chr(0x00));
$ipad	= str_repeat(chr(0x36),$blocksize);
$opad	= str_repeat(chr(0x5c),$blocksize);
$hmac 	= pack(
'H*',$hashfunc(
($key^$opad).pack(
'H*',$hashfunc(
($key^$ipad).$str
)
)
)
);
$signature = base64_encode($hmac);
}
return $signature;
}
function get_urlencode_string($params)
{
ksort($params);
$normalized = array();
foreach($params as $key =>$val)
{
$normalized[] = $key."=".rawurlencode($val);
}
return implode("&",$normalized);
}
function is_valid_openid($appkey,$openid,$timestamp,$sig)
{
$key = $appkey;
$str = $openid.$timestamp;
$signature = get_signature($str,$key);
return $sig == $signature;
}
function do_get($url,$appid,$appkey,$access_token,$access_token_secret,$openid)
{
$sigstr = "GET"."&".rawurlencode("$url")."&";
$params = $_GET;
$params["oauth_version"]          = "1.0";
$params["oauth_signature_method"] = "HMAC-SHA1";
$params["oauth_timestamp"]        = time();
$params["oauth_nonce"]            = mt_rand();
$params["oauth_consumer_key"]     = $appid;
$params["oauth_token"]            = $access_token;
$params["openid"]                 = $openid;
unset($params["oauth_signature"]);
$normalized_str = get_normalized_string($params);
$sigstr        .= rawurlencode($normalized_str);
$key = $appkey."&".$access_token_secret;
$signature = get_signature($sigstr,$key);
$url      .= "?".$normalized_str."&"."oauth_signature=".rawurlencode($signature);
return file_get_contents($url);
}
function do_multi_post($url,$appid,$appkey,$access_token,$access_token_secret,$openid)
{
$sigstr = "POST"."&"."$url"."&";
$params = $_POST;
$params["oauth_version"]          = "1.0";
$params["oauth_signature_method"] = "HMAC-SHA1";
$params["oauth_timestamp"]        = time();
$params["oauth_nonce"]            = mt_rand();
$params["oauth_consumer_key"]     = $appid;
$params["oauth_token"]            = $access_token;
$params["openid"]                 = $openid;
unset($params["oauth_signature"]);
foreach ($_FILES as $filename =>$filevalue)
{
if ($filevalue["error"] != UPLOAD_ERR_OK)
{
}
$params[$filename] = file_get_contents($filevalue["tmp_name"]);
}
$sigstr .= get_normalized_string($params);
$key = $appkey."&".$access_token_secret;
$signature = get_signature($sigstr,$key);
$params["oauth_signature"] = $signature;
foreach ($_FILES as $filename =>$filevalue)
{
$tmpfile = dirname($filevalue["tmp_name"])."/".$filevalue["name"];
move_uploaded_file($filevalue["tmp_name"],$tmpfile);
$params[$filename] = "@$tmpfile";
}
$ch = curl_init();
curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch,CURLOPT_POST,TRUE);
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_URL,$url);
$ret = curl_exec($ch);
curl_close($ch);
unlink($tmpfile);
return $ret;
}
function do_post($url,$appid,$appkey,$access_token,$access_token_secret,$openid)
{
$sigstr = "POST"."&".rawurlencode($url)."&";
$params = $_POST;
$params["oauth_version"]          = "1.0";
$params["oauth_signature_method"] = "HMAC-SHA1";
$params["oauth_timestamp"]        = time();
$params["oauth_nonce"]            = mt_rand();
$params["oauth_consumer_key"]     = $appid;
$params["oauth_token"]            = $access_token;
$params["openid"]                 = $openid;
unset($params["oauth_signature"]);
$sigstr .= rawurlencode(get_normalized_string($params));
$key = $appkey."&".$access_token_secret;
$signature = get_signature($sigstr,$key);
$params["oauth_signature"] = $signature;
$postdata = get_urlencode_string($params);
$ch = curl_init();
curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch,CURLOPT_POST,TRUE);
curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
curl_setopt($ch,CURLOPT_URL,$url);
$ret = curl_exec($ch);
curl_close($ch);
return $ret;
}
?>