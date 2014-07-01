<?php
 
class OAuthException extends Exception {
}
class OAuthConsumer {
public $key;
public $secret;
function __construct($key,$secret) {
$this->key = $key;
$this->secret = $secret;
}
function __toString() {
return "OAuthConsumer[key=$this->key,secret=$this->secret]";
}
}
class OAuthToken {
public $key;
public $secret;
function __construct($key,$secret) {
$this->key = $key;
$this->secret = $secret;
}
function to_string() {
return "oauth_token=".
OAuthUtil::urlencode_rfc3986($this->key) .
"&oauth_token_secret=".
OAuthUtil::urlencode_rfc3986($this->secret);
}
function __toString() {
return $this->to_string();
}
}
class OAuthSignatureMethod {
public function check_signature(&$request,$consumer,$token,$signature) {
$built = $this->build_signature($request,$consumer,$token);
return $built == $signature;
}
}
class OAuthSignatureMethod_HMAC_SHA1 extends OAuthSignatureMethod {
function get_name() {
return "HMAC-SHA1";
}
public function build_signature($request,$consumer,$token) {
$base_string = $request->get_signature_base_string();
$request->base_string = $base_string;
$key_parts = array( 
$consumer->secret,
($token) ?$token->secret : ""
);
$key_parts = OAuthUtil::urlencode_rfc3986($key_parts);
$key = implode('&',$key_parts);
return base64_encode(hash_hmac('sha1',$base_string,$key,true));
}
}
class OAuthSignatureMethod_PLAINTEXT extends OAuthSignatureMethod {
public function get_name() {
return "PLAINTEXT";
}
public function build_signature($request,$consumer,$token) {
$sig = array( 
OAuthUtil::urlencode_rfc3986($consumer->secret) 
);
if ($token) {
array_push($sig,OAuthUtil::urlencode_rfc3986($token->secret));
}else {
array_push($sig,'');
}
$raw = implode("&",$sig);
$request->base_string = $raw;
return OAuthUtil::urlencode_rfc3986($raw);
}
}
class OAuthSignatureMethod_RSA_SHA1 extends OAuthSignatureMethod {
public function get_name() {
return "RSA-SHA1";
}
protected function fetch_public_cert(&$request) {
throw Exception("fetch_public_cert not implemented");
}
protected function fetch_private_cert(&$request) {
throw Exception("fetch_private_cert not implemented");
}
public function build_signature(&$request,$consumer,$token) {
$base_string = $request->get_signature_base_string();
$request->base_string = $base_string;
$cert = $this->fetch_private_cert($request);
$privatekeyid = openssl_get_privatekey($cert);
$ok = openssl_sign($base_string,$signature,$privatekeyid);
openssl_free_key($privatekeyid);
return base64_encode($signature);
}
public function check_signature(&$request,$consumer,$token,$signature) {
$decoded_sig = base64_decode($signature);
$base_string = $request->get_signature_base_string();
$cert = $this->fetch_public_cert($request);
$publickeyid = openssl_get_publickey($cert);
$ok = openssl_verify($base_string,$decoded_sig,$publickeyid);
openssl_free_key($publickeyid);
return $ok == 1;
}
}
class OAuthRequest {
private $parameters;
private $http_method;
private $http_url;
public $base_string;
public static $version = '1.0a';
public static $POST_INPUT = 'php://input';
function __construct($http_method,$http_url,$parameters=NULL) {
@$parameters or $parameters = array();
$this->parameters = $parameters;
$this->http_method = $http_method;
$this->http_url = $http_url;
}
public static function from_request($http_method=NULL,$http_url=NULL,$parameters=NULL) {
$scheme = (!isset($_SERVER['HTTPS']) ||$_SERVER['HTTPS'] != "on") 
?'http'
: 'https';
@$http_url or $http_url = $scheme .
'://'.$_SERVER['HTTP_HOST'] .
':'.
$_SERVER['SERVER_PORT'] .
$_SERVER['REQUEST_URI'];
@$http_method or $http_method = $_SERVER['REQUEST_METHOD'];
if (!$parameters) {
$request_headers = OAuthUtil::get_headers();
$parameters = OAuthUtil::parse_parameters($_SERVER['QUERY_STRING']);
if ($http_method == "POST"
&&@strstr($request_headers["Content-Type"],
"application/x-www-form-urlencoded") 
) {
$post_data = OAuthUtil::parse_parameters( 
file_get_contents(self::$POST_INPUT) 
);
$parameters = array_merge($parameters,$post_data);
}
if (@substr($request_headers['Authorization'],0,6) == "OAuth ") {
$header_parameters = OAuthUtil::split_header( 
$request_headers['Authorization'] 
);
$parameters = array_merge($parameters,$header_parameters);
}
}
return new OAuthRequest($http_method,$http_url,$parameters);
}
public static function from_consumer_and_token($consumer,$token,$http_method,$http_url,$parameters=NULL) {
@$parameters or $parameters = array();
$defaults = array("source"=>$consumer->key,
"oauth_version"=>OAuthRequest::$version,
"oauth_nonce"=>OAuthRequest::generate_nonce(),
"oauth_timestamp"=>OAuthRequest::generate_timestamp(),
"oauth_consumer_key"=>$consumer->key);
if ($token) 
$defaults['oauth_token'] = $token->key;
$parameters = array_merge($defaults,$parameters);
return new OAuthRequest($http_method,$http_url,$parameters);
}
public function set_parameter($name,$value,$allow_duplicates = true) {
if ($allow_duplicates &&isset($this->parameters[$name])) {
if (is_scalar($this->parameters[$name])) {
$this->parameters[$name] = array($this->parameters[$name]);
}
$this->parameters[$name][] = $value;
}else {
$this->parameters[$name] = $value;
}
}
public function get_parameter($name) {
return isset($this->parameters[$name]) ?$this->parameters[$name] : null;
}
public function get_parameters() {
return $this->parameters;
}
public function unset_parameter($name) {
unset($this->parameters[$name]);
}
public function get_signable_parameters() {
$params = $this->parameters;
if (isset($params['pic'])) {
unset($params['pic']);
}
if (isset($params['image'])) 
{
unset($params['image']);
}
if (isset($params['oauth_signature'])) {
unset($params['oauth_signature']);
}
return OAuthUtil::build_http_query($params);
}
public function get_signature_base_string() {
$parts = array( 
$this->get_normalized_http_method(),
$this->get_normalized_http_url(),
$this->get_signable_parameters() 
);
$parts = OAuthUtil::urlencode_rfc3986($parts);
return implode('&',$parts);
}
public function get_normalized_http_method() {
return strtoupper($this->http_method);
}
public function get_normalized_http_url() {
$parts = parse_url($this->http_url);
$port = @$parts['port'];
$scheme = $parts['scheme'];
$host = $parts['host'];
$path = @$parts['path'];
$port or $port = ($scheme == 'https') ?'443': '80';
if (($scheme == 'https'&&$port != '443') 
||($scheme == 'http'&&$port != '80')) {
$host = "$host:$port";
}
return "$scheme://$host$path";
}
public function to_url() {
$post_data = $this->to_postdata();
$out = $this->get_normalized_http_url();
if ($post_data) {
$out .= '?'.$post_data;
}
return $out;
}
public function to_postdata( $multi = false ) {
if( $multi )
return OAuthUtil::build_http_query_multi($this->parameters);
else 
return OAuthUtil::build_http_query($this->parameters);
}
public function to_header() {
$out ='Authorization: OAuth realm=""';
$total = array();
foreach ($this->parameters as $k =>$v) {
if (substr($k,0,5) != "oauth") continue;
if (is_array($v)) {
throw new OAuthException('Arrays not supported in headers');
}
$out .= ','.
OAuthUtil::urlencode_rfc3986($k) .
'="'.
OAuthUtil::urlencode_rfc3986($v) .
'"';
}
return $out;
}
public function __toString() {
return $this->to_url();
}
public function sign_request($signature_method,$consumer,$token) {
$this->set_parameter( 
"oauth_signature_method",
$signature_method->get_name(),
false 
);
$signature = $this->build_signature($signature_method,$consumer,$token);
$this->set_parameter("oauth_signature",$signature,false);
}
public function build_signature($signature_method,$consumer,$token) {
$signature = $signature_method->build_signature($this,$consumer,$token);
return $signature;
}
private static function generate_timestamp() {
return time();
}
private static function generate_nonce() {
$mt = microtime();
$rand = mt_rand();
return md5($mt .$rand);
}
}
class OAuthServer {
protected $timestamp_threshold = 300;
protected $version = 1.0;
protected $signature_methods = array();
protected $data_store;
function __construct($data_store) {
$this->data_store = $data_store;
}
public function add_signature_method($signature_method) {
$this->signature_methods[$signature_method->get_name()] = 
$signature_method;
}
public function fetch_request_token(&$request) {
$this->get_version($request);
$consumer = $this->get_consumer($request);
$token = NULL;
$this->check_signature($request,$consumer,$token);
$new_token = $this->data_store->new_request_token($consumer);
return $new_token;
}
public function fetch_access_token(&$request) {
$this->get_version($request);
$consumer = $this->get_consumer($request);
$token = $this->get_token($request,$consumer,"request");
$this->check_signature($request,$consumer,$token);
$new_token = $this->data_store->new_access_token($token,$consumer);
return $new_token;
}
public function verify_request(&$request) {
$this->get_version($request);
$consumer = $this->get_consumer($request);
$token = $this->get_token($request,$consumer,"access");
$this->check_signature($request,$consumer,$token);
return array($consumer,$token);
}
private function get_version(&$request) {
$version = $request->get_parameter("oauth_version");
if (!$version) {
$version = 1.0;
}
if ($version &&$version != $this->version) {
throw new OAuthException("OAuth version '$version' not supported");
}
return $version;
}
private function get_signature_method(&$request) {
$signature_method = 
@$request->get_parameter("oauth_signature_method");
if (!$signature_method) {
$signature_method = "PLAINTEXT";
}
if (!in_array($signature_method,
array_keys($this->signature_methods))) {
throw new OAuthException( 
"Signature method '$signature_method' not supported ".
"try one of the following: ".
implode(", ",array_keys($this->signature_methods)) 
);
}
return $this->signature_methods[$signature_method];
}
private function get_consumer(&$request) {
$consumer_key = @$request->get_parameter("oauth_consumer_key");
if (!$consumer_key) {
throw new OAuthException("Invalid consumer key");
}
$consumer = $this->data_store->lookup_consumer($consumer_key);
if (!$consumer) {
throw new OAuthException("Invalid consumer");
}
return $consumer;
}
private function get_token(&$request,$consumer,$token_type="access") {
$token_field = @$request->get_parameter('oauth_token');
$token = $this->data_store->lookup_token( 
$consumer,$token_type,$token_field 
);
if (!$token) {
throw new OAuthException("Invalid $token_type token: $token_field");
}
return $token;
}
private function check_signature(&$request,$consumer,$token) {
$timestamp = @$request->get_parameter('oauth_timestamp');
$nonce = @$request->get_parameter('oauth_nonce');
$this->check_timestamp($timestamp);
$this->check_nonce($consumer,$token,$nonce,$timestamp);
$signature_method = $this->get_signature_method($request);
$signature = $request->get_parameter('oauth_signature');
$valid_sig = $signature_method->check_signature( 
$request,
$consumer,
$token,
$signature 
);
if (!$valid_sig) {
throw new OAuthException("Invalid signature");
}
}
private function check_timestamp($timestamp) {
$now = time();
if ($now -$timestamp >$this->timestamp_threshold) {
throw new OAuthException( 
"Expired timestamp, yours $timestamp, ours $now"
);
}
}
private function check_nonce($consumer,$token,$nonce,$timestamp) {
$found = $this->data_store->lookup_nonce( 
$consumer,
$token,
$nonce,
$timestamp 
);
if ($found) {
throw new OAuthException("Nonce already used: $nonce");
}
}
}
class OAuthDataStore {
function lookup_consumer($consumer_key) {
}
function lookup_token($consumer,$token_type,$token) {
}
function lookup_nonce($consumer,$token,$nonce,$timestamp) {
}
function new_request_token($consumer) {
}
function new_access_token($token,$consumer) {
}
}
class OAuthUtil {
public static $boundary = '';
public static function urlencode_rfc3986($input) {
if (is_array($input)) {
return array_map(array('OAuthUtil','urlencode_rfc3986'),$input);
}else if (is_scalar($input)) {
return str_replace( 
'+',
' ',
str_replace('%7E','~',rawurlencode($input)) 
);
}else {
return '';
}
}
public static function urldecode_rfc3986($string) {
return urldecode($string);
}
public static function split_header($header,$only_allow_oauth_parameters = true) {
$pattern = '/(([-_a-z]*)=("([^"]*)"|([^,]*)),?)/';
$offset = 0;
$params = array();
while (preg_match($pattern,$header,$matches,PREG_OFFSET_CAPTURE,$offset) >0) {
$match = $matches[0];
$header_name = $matches[2][0];
$header_content = (isset($matches[5])) ?$matches[5][0] : $matches[4][0];
if (preg_match('/^oauth_/',$header_name) ||!$only_allow_oauth_parameters) {
$params[$header_name] = OAuthUtil::urldecode_rfc3986($header_content);
}
$offset = $match[1] +strlen($match[0]);
}
if (isset($params['realm'])) {
unset($params['realm']);
}
return $params;
}
public static function get_headers() {
if (function_exists('apache_request_headers')) {
return apache_request_headers();
}
$out = array();
foreach ($_SERVER as $key =>$value) {
if (substr($key,0,5) == "HTTP_") {
$key = str_replace( 
" ",
"-",
ucwords(strtolower(str_replace("_"," ",substr($key,5)))) 
);
$out[$key] = $value;
}
}
return $out;
}
public static function parse_parameters( $input ) {
if (!isset($input) ||!$input) return array();
$pairs = explode('&',$input);
$parsed_parameters = array();
foreach ($pairs as $pair) {
$split = explode('=',$pair,2);
$parameter = OAuthUtil::urldecode_rfc3986($split[0]);
$value = isset($split[1]) ?OAuthUtil::urldecode_rfc3986($split[1]) : '';
if (isset($parsed_parameters[$parameter])) {
if (is_scalar($parsed_parameters[$parameter])) {
$parsed_parameters[$parameter] = array($parsed_parameters[$parameter]);
}
$parsed_parameters[$parameter][] = $value;
}else {
$parsed_parameters[$parameter] = $value;
}
}
return $parsed_parameters;
}
public static function build_http_query_multi($params) {
if (!$params) return '';
$keys = array_keys($params);
$values = array_values($params);
$params = array_combine($keys,$values);
uksort($params,'strcmp');
$pairs = array();
self::$boundary = $boundary = uniqid('------------------');
$MPboundary = '--'.$boundary;
$endMPboundary = $MPboundary.'--';
$multipartbody = '';
foreach ($params as $parameter =>$value) {
if( in_array($parameter,array("pic","image")) &&$value{0}== '@')
{
$url = ltrim( $value ,'@');
$content = file_get_contents( $url );
$filename = reset( explode( '?',basename( $url ) ));
$mime = self::get_image_mime($url);
$multipartbody .= $MPboundary ."\r\n";
$multipartbody .= 'Content-Disposition: form-data; name="'.$parameter .'"; filename="'.$filename .'"'."\r\n";
$multipartbody .= 'Content-Type: '.$mime ."\r\n\r\n";
$multipartbody .= $content."\r\n";
}
else
{
$multipartbody .= $MPboundary ."\r\n";
$multipartbody .= 'content-disposition: form-data; name="'.$parameter."\"\r\n\r\n";
$multipartbody .= $value."\r\n";
}
}
$multipartbody .=  $endMPboundary;
return $multipartbody;
}
public static function build_http_query($params) {
if (!$params) return '';
$keys = OAuthUtil::urlencode_rfc3986(array_keys($params));
$values = OAuthUtil::urlencode_rfc3986(array_values($params));
$params = array_combine($keys,$values);
uksort($params,'strcmp');
$pairs = array();
foreach ($params as $parameter =>$value) {
if (is_array($value)) {
natsort($value);
foreach ($value as $duplicate_value) {
$pairs[] = $parameter .'='.$duplicate_value;
}
}else {
$pairs[] = $parameter .'='.$value;
}
}
return implode('&',$pairs);
}
public static function get_image_mime( $file )
{
$ext = strtolower(pathinfo( $file ,PATHINFO_EXTENSION ));
switch( $ext )
{
case 'jpg':
case 'jpeg':
$mime = 'image/jpg';
break;
case 'png';
$mime = 'image/png';
break;
case 'gif';
default:
$mime = 'image/gif';
break;
}
return $mime;
}
}
class WeiboClient 
{
function __construct( $akey ,$skey ,$accecss_token ,$accecss_token_secret ) 
{
$this->oauth = new WeiboOAuth( $akey ,$skey ,$accecss_token ,$accecss_token_secret );
}
function public_timeline() 
{
return $this->oauth->get('http://api.t.sina.com.cn/statuses/public_timeline.json');
}
function friends_timeline() 
{
return $this->home_timeline();
}
function home_timeline() 
{
return $this->oauth->get('http://api.t.sina.com.cn/statuses/home_timeline.json');
}
function mentions( $page = 1 ,$count = 20 ) 
{
return $this->request_with_pager( 'http://api.t.sina.com.cn/statuses/mentions.json',$page ,$count );
}
function update( $text ) 
{
$param = array();
$param['status'] = $text;
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/update.json',$param );
}
function upload( $text ,$pic_path ) 
{
$param = array();
$param['status'] = $text;
$param['pic'] = '@'.$pic_path;
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/upload.json',$param ,true );
}
function show_status( $sid ) 
{
return $this->oauth->get( 'http://api.t.sina.com.cn/statuses/show/'.$sid .'.json');
}
function delete( $sid ) 
{
return $this->destroy( $sid );
}
function destroy( $sid ) 
{
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/destroy/'.$sid .'.json');
}
function show_user( $uid_or_name = null ) 
{
return $this->request_with_uid( 'http://api.t.sina.com.cn/users/show.json',$uid_or_name );
}
function friends( $cursor = false ,$count = false ,$uid_or_name = null ) 
{
return $this->request_with_uid( 'http://api.t.sina.com.cn/statuses/friends.json',$uid_or_name ,false ,$count ,$cursor );
}
function followers( $cursor = false ,$count = false ,$uid_or_name = null ) 
{
return $this->request_with_uid( 'http://api.t.sina.com.cn/statuses/followers.json',$uid_or_name ,false ,$count ,$cursor );
}
function follow( $uid_or_name ) 
{
return $this->request_with_uid( 'http://api.t.sina.com.cn/friendships/create.json',$uid_or_name ,false ,false ,false ,true  );
}
function unfollow( $uid_or_name ) 
{
return $this->request_with_uid( 'http://api.t.sina.com.cn/friendships/destroy.json',$uid_or_name ,false ,false ,false ,true);
}
function is_followed( $uid_or_name ) 
{
$param = array();
if( is_numeric( $uid_or_name ) ) $param['target_id'] = $uid_or_name;
else $param['target_screen_name'] = $uid_or_name;
return $this->oauth->get( 'http://api.t.sina.com.cn/friendships/show.json',$param );
}
function user_timeline( $page = 1 ,$count = 20 ,$uid_or_name = null ) 
{
if( !is_numeric( $page ) ) 
return $this->request_with_uid( 'http://api.t.sina.com.cn/statuses/user_timeline.json',$page );
else 
return $this->request_with_uid( 'http://api.t.sina.com.cn/statuses/user_timeline.json',$uid_or_name ,$page ,$count );
}
function list_dm( $page = 1 ,$count = 20  ) 
{
return $this->request_with_pager( 'http://api.t.sina.com.cn/direct_messages.json',$page ,$count );
}
function list_dm_sent( $page = 1 ,$count = 20 ) 
{
return $this->request_with_pager( 'http://api.t.sina.com.cn/direct_messages/sent.json',$page ,$count );
}
function send_dm( $uid_or_name ,$text ) 
{
$param = array();
$param['text'] = $text;
if( is_numeric( $uid_or_name ) ) $param['user_id'] = $uid_or_name;
else $param['screen_name'] = $uid_or_name;
return $this->oauth->post( 'http://api.t.sina.com.cn/direct_messages/new.json',$param  );
}
function delete_dm( $did ) 
{
return $this->oauth->post( 'http://api.t.sina.com.cn/direct_messages/destroy/'.$did .'.json');
}
function repost( $sid ,$text = false ) 
{
$param = array();
$param['id'] = $sid;
if( $text ) $param['status'] = $text;
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/repost.json',$param  );
}
function send_comment( $sid ,$text ,$cid = false ) 
{
$param = array();
$param['id'] = $sid;
$param['comment'] = $text;
if( $cid ) $param['cid '] = $cid;
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/comment.json',$param  );
}
function comments_by_me( $page = 1 ,$count = 20 ) 
{
return $this->request_with_pager( 'http://api.t.sina.com.cn/statuses/comments_by_me.json',$page ,$count );
}
function comments_timeline( $page = 1 ,$count = 20 ) 
{
return $this->request_with_pager( 'http://api.t.sina.com.cn/statuses/comments_timeline.json',$page ,$count );
}
function get_comments_by_sid( $sid ,$page = 1 ,$count = 20 ) 
{
$param = array();
$param['id'] = $sid;
if( $page ) $param['page'] = $page;
if( $count ) $param['count'] = $count;
return $this->oauth->get('http://api.t.sina.com.cn/statuses/comments.json',$param );
}
function get_count_info_by_ids( $sids ) 
{
$param = array();
$param['ids'] = $sids;
return $this->oauth->get( 'http://api.t.sina.com.cn/statuses/counts.json',$param );
}
function reply( $sid ,$text ,$cid ) 
{
$param = array();
$param['id'] = $sid;
$param['comment'] = $text;
$param['cid '] = $cid;
return $this->oauth->post( 'http://api.t.sina.com.cn/statuses/reply.json',$param  );
}
function get_favorites( $page = false ) 
{
$param = array();
if( $page ) $param['page'] = $page;
return $this->oauth->get( 'http://api.t.sina.com.cn/favorites.json',$param );
}
function add_to_favorites( $sid ) 
{
$param = array();
$param['id'] = $sid;
return $this->oauth->post( 'http://api.t.sina.com.cn/favorites/create.json',$param );
}
function remove_from_favorites( $sid ) 
{
return $this->oauth->post( 'http://api.t.sina.com.cn/favorites/destroy/'.$sid .'.json');
}
function verify_credentials() 
{
return $this->oauth->get( 'http://api.t.sina.com.cn/account/verify_credentials.json');
}
function update_avatar( $pic_path )
{
$param = array();
$param['image'] = "@".$pic_path;
return $this->oauth->post( 'http://api.t.sina.com.cn/account/update_profile_image.json',$param ,true );
}
protected function request_with_pager( $url ,$page = false ,$count = false ) 
{
$param = array();
if( $page ) $param['page'] = $page;
if( $count ) $param['count'] = $count;
return $this->oauth->get($url ,$param );
}
protected function request_with_uid( $url ,$uid_or_name ,$page = false ,$count = false ,$cursor = false ,$post = false ) 
{
$param = array();
if( $page ) $param['page'] = $page;
if( $count ) $param['count'] = $count;
if( $cursor )$param['cursor'] =  $cursor;
if( $post ) $method = 'post';
else $method = 'get';
if( is_numeric( $uid_or_name ) ) 
{
$param['user_id'] = $uid_or_name;
return $this->oauth->$method($url ,$param );
}elseif( $uid_or_name !== null ) 
{
$param['screen_name'] = $uid_or_name;
return $this->oauth->$method($url ,$param );
}
else 
{
return $this->oauth->$method($url ,$param );
}
}
}
class WeiboOAuth {
public $http_code;
public $url;
public $host = "http://api.t.sina.com.cn/";
public $timeout = 30;
public $connecttimeout = 30;
public $ssl_verifypeer = FALSE;
public $format = 'json';
public $decode_json = TRUE;
public $http_info;
public $useragent = 'Sae T OAuth v0.2.0-beta2';
function accessTokenURL()  {return 'http://api.t.sina.com.cn/oauth/access_token';}
function authenticateURL() {return 'http://api.t.sina.com.cn/oauth/authenticate';}
function authorizeURL()    {return 'http://api.t.sina.com.cn/oauth/authorize';}
function requestTokenURL() {return 'http://api.t.sina.com.cn/oauth/request_token';}
function lastStatusCode() {return $this->http_status;}
function lastAPICall() {return $this->last_api_call;}
function __construct($consumer_key,$consumer_secret,$oauth_token = NULL,$oauth_token_secret = NULL) {
$this->sha1_method = new OAuthSignatureMethod_HMAC_SHA1();
$this->consumer = new OAuthConsumer($consumer_key,$consumer_secret);
if (!empty($oauth_token) &&!empty($oauth_token_secret)) {
$this->token = new OAuthConsumer($oauth_token,$oauth_token_secret);
}else {
$this->token = NULL;
}
}
function getRequestToken($oauth_callback = NULL) {
$parameters = array();
if (!empty($oauth_callback)) {
$parameters['oauth_callback'] = $oauth_callback;
}
$request = $this->oAuthRequest($this->requestTokenURL(),'GET',$parameters);
$token = OAuthUtil::parse_parameters($request);
$this->token = new OAuthConsumer($token['oauth_token'],$token['oauth_token_secret']);
return $token;
}
function getAuthorizeURL($token,$sign_in_with_Weibo = TRUE ,$url) {
if (is_array($token)) {
$token = $token['oauth_token'];
}
if (empty($sign_in_with_Weibo)) {
return $this->authorizeURL() ."?oauth_token={$token}&oauth_callback=".urlencode($url);
}else {
return $this->authenticateURL() ."?oauth_token={$token}&oauth_callback=".urlencode($url);
}
}
function getAccessToken($oauth_verifier = FALSE,$oauth_token = false) {
$parameters = array();
if (!empty($oauth_verifier)) {
$parameters['oauth_verifier'] = $oauth_verifier;
}
$request = $this->oAuthRequest($this->accessTokenURL(),'GET',$parameters);
$token = OAuthUtil::parse_parameters($request);
$this->token = new OAuthConsumer($token['oauth_token'],$token['oauth_token_secret']);
return $token;
}
function get($url,$parameters = array()) {
$response = $this->oAuthRequest($url,'GET',$parameters);
if ($this->format === 'json'&&$this->decode_json) {
return json_decode($response,true);
}
return $response;
}
function post($url,$parameters = array() ,$multi = false) {
$response = $this->oAuthRequest($url,'POST',$parameters ,$multi );
if ($this->format === 'json'&&$this->decode_json) {
return json_decode($response,true);
}
return $response;
}
function delete($url,$parameters = array()) {
$response = $this->oAuthRequest($url,'DELETE',$parameters);
if ($this->format === 'json'&&$this->decode_json) {
return json_decode($response,true);
}
return $response;
}
function oAuthRequest($url,$method,$parameters ,$multi = false) {
if (strrpos($url,'http://') !== 0 &&strrpos($url,'http://') !== 0) {
$url = "{$this->host}{$url}.{$this->format}";
}
$request = OAuthRequest::from_consumer_and_token($this->consumer,$this->token,$method,$url,$parameters);
$request->sign_request($this->sha1_method,$this->consumer,$this->token);
switch ($method) {
case 'GET': 
return $this->http($request->to_url(),'GET');
default: 
return $this->http($request->get_normalized_http_url(),$method,$request->to_postdata($multi) ,$multi );
}
}
function http($url,$method,$postfields = NULL ,$multi = false) {
$this->http_info = array();
$ci = curl_init();
curl_setopt($ci,CURLOPT_USERAGENT,$this->useragent);
curl_setopt($ci,CURLOPT_CONNECTTIMEOUT,$this->connecttimeout);
curl_setopt($ci,CURLOPT_TIMEOUT,$this->timeout);
curl_setopt($ci,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ci,CURLOPT_SSL_VERIFYPEER,$this->ssl_verifypeer);
curl_setopt($ci,CURLOPT_HEADERFUNCTION,array($this,'getHeader'));
curl_setopt($ci,CURLOPT_HEADER,FALSE);
switch ($method) {
case 'POST': 
curl_setopt($ci,CURLOPT_POST,TRUE);
if (!empty($postfields)) {
curl_setopt($ci,CURLOPT_POSTFIELDS,$postfields);
}
break;
case 'DELETE': 
curl_setopt($ci,CURLOPT_CUSTOMREQUEST,'DELETE');
if (!empty($postfields)) {
$url = "{$url}?{$postfields}";
}
}
$header_array = array();
$header_array2=array();
if( $multi ) 
$header_array2 = array("Content-Type: multipart/form-data; boundary=".OAuthUtil::$boundary ,"Expect: ");
foreach($header_array as $k =>$v) 
array_push($header_array2,$k.': '.$v);
curl_setopt($ci,CURLOPT_HTTPHEADER,$header_array2 );
curl_setopt($ci,CURLINFO_HEADER_OUT,TRUE );
curl_setopt($ci,CURLOPT_URL,$url);
$response = curl_exec($ci);
$this->http_code = curl_getinfo($ci,CURLINFO_HTTP_CODE);
$this->http_info = array_merge($this->http_info,curl_getinfo($ci));
$this->url = $url;
curl_close ($ci);
return $response;
}
function getHeader($ch,$header) {
$i = strpos($header,':');
if (!empty($i)) {
$key = str_replace('-','_',strtolower(substr($header,0,$i)));
$value = trim(substr($header,$i +2));
$this->http_header[$key] = $value;
}
return strlen($header);
}
}
?>