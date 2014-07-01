<?php

function new_addslashes($string){
if(!is_array($string)) return addslashes($string);
foreach($string as $key =>$val) $string[$key] = new_addslashes($val);
return $string;
}
function new_stripslashes($string) {
if(!is_array($string)) return stripslashes($string);
foreach($string as $key =>$val) $string[$key] = new_stripslashes($val);
return $string;
}
function new_html_special_chars($string) {
if(!is_array($string)) return htmlspecialchars($string);
foreach($string as $key =>$val) $string[$key] = new_html_special_chars($val);
return $string;
}
function safe_replace($string) {
$string = str_replace('%20','',$string);
$string = str_replace('%27','',$string);
$string = str_replace('%2527','',$string);
$string = str_replace('*','',$string);
$string = str_replace('"','&quot;',$string);
$string = str_replace("'",'',$string);
$string = str_replace('"','',$string);
$string = str_replace(';','',$string);
$string = str_replace('<','&lt;',$string);
$string = str_replace('>','&gt;',$string);
$string = str_replace("{",'',$string);
$string = str_replace('}','',$string);
$string = str_replace('\\','',$string);
return $string;
}
function trim_unsafe_control_chars($str) {
$rule = '/['.chr ( 1 ) .'-'.chr ( 8 ) .chr ( 11 ) .'-'.chr ( 12 ) .chr ( 14 ) .'-'.chr ( 31 ) .']*/';
return str_replace ( chr ( 0 ),'',preg_replace ( $rule,'',$str ) );
}
function trim_textarea($string) {
$string = nl2br ( str_replace ( ' ','&nbsp;',$string ) );
return $string;
}
function format_js($string,$isjs = 1) {
$string = addslashes(str_replace(array("\r","\n","\t"),array('','',''),$string));
return $isjs ?'document.write("'.$string.'");': $string;
}
function trim_script($str) {
if(is_array($str)){
foreach ($str as $key =>$val){
$str[$key] = trim_script($val);
}
}else{
$str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si','&lt;\\1script\\2&gt;',$str );
$str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si','&lt;\\1iframe\\2&gt;',$str );
$str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si','&lt;\\1frame\\2&gt;',$str );
$str = preg_replace ( '/]]\>/si',']] >',$str );
}
return $str;
}
function get_url() {
$sys_protocal = isset($_SERVER['SERVER_PORT']) &&$_SERVER['SERVER_PORT'] == '443'?'https://': 'http://';
$php_self = $_SERVER['PHP_SELF'] ?safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
$path_info = isset($_SERVER['PATH_INFO']) ?safe_replace($_SERVER['PATH_INFO']) : '';
$relate_url = isset($_SERVER['REQUEST_URI']) ?safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ?'?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ?$_SERVER['HTTP_HOST'] : '').$relate_url;
}
function str_cut($string,$length,$dot = '...') {
$strlen = strlen($string);
if($strlen <= $length) return $string;
$string = str_replace(array(' ','&nbsp;','&amp;','&quot;','&#039;','&ldquo;','&rdquo;','&mdash;','&lt;','&gt;','&middot;','&hellip;'),array('∵',' ','&','"',"'",'“','”','—','<','>','·','…'),$string);
$strcut = '';
if(strtolower(CHARSET) == 'utf-8') {
$length = intval($length-strlen($dot)-$length/3);
$n = $tn = $noc = 0;
while($n <strlen($string)) {
$t = ord($string[$n]);
if($t == 9 ||$t == 10 ||(32 <= $t &&$t <= 126)) {
$tn = 1;$n++;$noc++;
}elseif(194 <= $t &&$t <= 223) {
$tn = 2;$n += 2;$noc += 2;
}elseif(224 <= $t &&$t <= 239) {
$tn = 3;$n += 3;$noc += 2;
}elseif(240 <= $t &&$t <= 247) {
$tn = 4;$n += 4;$noc += 2;
}elseif(248 <= $t &&$t <= 251) {
$tn = 5;$n += 5;$noc += 2;
}elseif($t == 252 ||$t == 253) {
$tn = 6;$n += 6;$noc += 2;
}else {
$n++;
}
if($noc >= $length) {
break;
}
}
if($noc >$length) {
$n -= $tn;
}
$strcut = substr($string,0,$n);
$strcut = str_replace(array('∵','&','"',"'",'“','”','—','<','>','·','…'),array(' ','&amp;','&quot;','&#039;','&ldquo;','&rdquo;','&mdash;','&lt;','&gt;','&middot;','&hellip;'),$strcut);
}else {
$dotlen = strlen($dot);
$maxi = $length -$dotlen -1;
$current_str = '';
$search_arr = array('&',' ','"',"'",'“','”','—','<','>','·','…','∵');
$replace_arr = array('&amp;','&nbsp;','&quot;','&#039;','&ldquo;','&rdquo;','&mdash;','&lt;','&gt;','&middot;','&hellip;',' ');
$search_flip = array_flip($search_arr);
for ($i = 0;$i <$maxi;$i++) {
$current_str = ord($string[$i]) >127 ?$string[$i].$string[++$i] : $string[$i];
if (in_array($current_str,$search_arr)) {
$key = $search_flip[$current_str];
$current_str = str_replace($search_arr[$key],$replace_arr[$key],$current_str);
}
$strcut .= $current_str;
}
}
return $strcut.$dot;
}
function ip() {
if(getenv('HTTP_CLIENT_IP') &&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')) {
$ip = getenv('HTTP_CLIENT_IP');
}elseif(getenv('HTTP_X_FORWARDED_FOR') &&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')) {
$ip = getenv('HTTP_X_FORWARDED_FOR');
}elseif(getenv('REMOTE_ADDR') &&strcasecmp(getenv('REMOTE_ADDR'),'unknown')) {
$ip = getenv('REMOTE_ADDR');
}elseif(isset($_SERVER['REMOTE_ADDR']) &&$_SERVER['REMOTE_ADDR'] &&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')) {
$ip = $_SERVER['REMOTE_ADDR'];
}
return preg_match ( '/[\d\.]{7,15}/',$ip,$matches ) ?$matches [0] : '';
}
function get_cost_time() {
$microtime = microtime ( TRUE );
return $microtime -SYS_START_TIME;
}
function execute_time() {
$stime = explode ( ' ',SYS_START_TIME );
$etime = explode ( ' ',microtime () );
return number_format ( ($etime [1] +$etime [0] -$stime [1] -$stime [0]),6 );
}
function random($length,$chars = '0123456789') {
$hash = '';
$max = strlen($chars) -1;
for($i = 0;$i <$length;$i++) {
$hash .= $chars[mt_rand(0,$max)];
}
return $hash;
}
function string2array($data) {
if($data == '') return array();
@eval("\$array = $data;");
return $array;
}
function array2string($data,$isformdata = 1) {
if($data == '') return '';
if($isformdata) $data = new_stripslashes($data);
return addslashes(var_export($data,TRUE));
}
function sizecount($filesize) {
if ($filesize >= 1073741824) {
$filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
}elseif ($filesize >= 1048576) {
$filesize = round($filesize / 1048576 * 100) / 100 .' MB';
}elseif($filesize >= 1024) {
$filesize = round($filesize / 1024 * 100) / 100 .' KB';
}else {
$filesize = $filesize.' Bytes';
}
return $filesize;
}
function sys_auth($string,$operation = 'ENCODE',$key = '',$expiry = 0) {
$key_length = 4;
$key = md5($key != ''?$key : h5_base::load_config('system','auth_key'));
$fixedkey = md5($key);
$egiskeys = md5(substr($fixedkey,16,16));
$runtokey = $key_length ?($operation == 'ENCODE'?substr(md5(microtime(true)),-$key_length) : substr($string,0,$key_length)) : '';
$keys = md5(substr($runtokey,0,16) .substr($fixedkey,0,16) .substr($runtokey,16) .substr($fixedkey,16));
$string = $operation == 'ENCODE'?sprintf('%010d',$expiry ?$expiry +time() : 0).substr(md5($string.$egiskeys),0,16) .$string : base64_decode(substr($string,$key_length));
$i = 0;$result = '';
$string_length = strlen($string);
for ($i = 0;$i <$string_length;$i++){
$result .= chr(ord($string{$i}) ^ord($keys{$i %32}));
}
if($operation == 'ENCODE') {
return $runtokey .str_replace('=','',base64_encode($result));
}else {
if((substr($result,0,10) == 0 ||substr($result,0,10) -time() >0) &&substr($result,10,16) == substr(md5(substr($result,26).$egiskeys),0,16)) {
return substr($result,26);
}else {
return '';
}
}
}
function L($language = 'no_language',$pars = array(),$modules = '') {
static $LANG = array();
static $LANG_MODULES = array();
static $lang = '';
if(defined('IN_ADMIN')) {
$lang = SYS_STYLE ?SYS_STYLE : 'zh-cn';
}else {
$lang = h5_base::load_config('system','lang');
}
if(!$LANG) {
require_once H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'system.lang.php';
if(defined('IN_ADMIN')) require_once H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'system_menu.lang.php';
if(file_exists(H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.ROUTE_M.'.lang.php')) require H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.ROUTE_M.'.lang.php';
}
if(!empty($modules)) {
$modules = explode(',',$modules);
foreach($modules AS $m) {
if(!isset($LANG_MODULES[$m])) require H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$m.'.lang.php';
}
}
if(!array_key_exists($language,$LANG)) {
return $language;
}else {
$language = $LANG[$language];
if($pars) {
foreach($pars AS $_k=>$_v) {
$language = str_replace('{'.$_k.'}',$_v,$language);
}
}
return $language;
}
}
function template($module = 'content',$template = 'index',$style = '') {
if(strpos($module,'plugin/')!== false) {
$plugin = str_replace('plugin/','',$module);
return p_template($plugin,$template,$style);
}
$module = str_replace('/',DIRECTORY_SEPARATOR,$module);
if(!empty($style) &&preg_match('/([a-z0-9\-_]+)/is',$style)) {
}elseif (empty($style) &&!defined('STYLE')) {
if(defined('SITEID')) {
$siteid = SITEID;
}else {
$siteid = param::get_cookie('siteid');
}
if (!$siteid) $siteid = 1;
$sitelist = getcache('sitelist','commons');
if(!empty($siteid)) {
$style = $sitelist[$siteid]['default_style'];
}
}elseif (empty($style) &&defined('STYLE')) {
$style = STYLE;
}else {
$style = 'default';
}
if(!$style) $style = 'default';
$template_cache = h5_base::load_sys_class('template_cache');
$compiledtplfile = HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.php';
if(file_exists(H5_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html')) {
if(!file_exists($compiledtplfile) ||(@filemtime(H5_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') >@filemtime($compiledtplfile))) {
$template_cache->template_compile($module,$template,$style);
}
}else {
$compiledtplfile = HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.php';
if(!file_exists($compiledtplfile) ||(file_exists(H5_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') &&filemtime(H5_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html') >filemtime($compiledtplfile))) {
$template_cache->template_compile($module,$template,'default');
}elseif (!file_exists(H5_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html')) {
showmessage('Template does not exist.'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html');
}
}
return $compiledtplfile;
}
function my_error_handler($errno,$errstr,$errfile,$errline) {
if($errno==8) return '';
$errfile = str_replace(HOUSE5_PATH,'',$errfile);
if(h5_base::load_config('system','errorlog')) {
error_log('<?php exit;?>'.date('m-d H:i:s',SYS_TIME).' | '.$errno.' | '.str_pad($errstr,30).' | '.$errfile.' | '.$errline."\r\n",3,CACHE_PATH.'error_log.php');
}else {
$str = '<div style="font-size:12px;text-align:left; border-bottom:1px solid #9cc9e0; border-right:1px solid #9cc9e0;padding:1px 4px;color:#000000;font-family:Arial, Helvetica,sans-serif;"><span>errorno:'.$errno .',str:'.$errstr .',file:<font color="blue">'.$errfile .'</font>,line'.$errline .'<br /><a href="http://faq.house5.net/?type=file&errno='.$errno.'&errstr='.urlencode($errstr).'&errfile='.urlencode($errfile).'&errline='.$errline.'" target="_blank" style="color:red">Need Help?</a></span></div>';
echo $str;
}
}
function showmessage($msg,$url_forward = 'goback',$ms = 1250,$dialog = '',$returnjs = '') {
if(defined('IN_ADMIN')) {
include(admin::admin_tpl('showmessage','admin'));
}else {
include(template('content','message'));
}
exit;
}
function str_exists($haystack,$needle)
{
return !(strpos($haystack,$needle) === FALSE);
}
function fileext($filename) {
return strtolower(trim(substr(strrchr($filename,'.'),1,10)));
}
function tpl_cache($name,$times = 0) {
$filepath = 'tpl_data';
$info = getcacheinfo($name,$filepath);
if (SYS_TIME -$info['filemtime'] >= $times) {
return false;
}else {
return getcache($name,$filepath);
}
}
function setcache($name,$data,$filepath='',$type='file',$config='',$timeout=0) {
h5_base::load_sys_class('cache_factory','',0);
if($config) {
$cacheconfig = h5_base::load_config('cache');
$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
}else {
$cache = cache_factory::get_instance()->get_cache($type);
}
return $cache->set($name,$data,$timeout,'',$filepath);
}
function getcache($name,$filepath='',$type='file',$config='') {
h5_base::load_sys_class('cache_factory','',0);
if($config) {
$cacheconfig = h5_base::load_config('cache');
$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
}else {
$cache = cache_factory::get_instance()->get_cache($type);
}
return $cache->get($name,'','',$filepath);
}
function delcache($name,$filepath='',$type='file',$config='') {
h5_base::load_sys_class('cache_factory','',0);
if($config) {
$cacheconfig = h5_base::load_config('cache');
$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
}else {
$cache = cache_factory::get_instance()->get_cache($type);
}
return $cache->delete($name,'','',$filepath);
}
function getcacheinfo($name,$filepath='',$type='file',$config='') {
h5_base::load_sys_class('cache_factory');
if($config) {
$cacheconfig = h5_base::load_config('cache');
$cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
}else {
$cache = cache_factory::get_instance()->get_cache($type);
}
return $cache->cacheinfo($name,'','',$filepath);
}
function to_sqls($data,$front = ' AND ',$in_column = false) {
if($in_column &&is_array($data)) {
$ids = '\''.implode('\',\'',$data).'\'';
$sql = "$in_column IN ($ids)";
return $sql;
}else {
if ($front == '') {
$front = ' AND ';
}
if(is_array($data) &&count($data) >0) {
$sql = '';
foreach ($data as $key =>$val) {
$sql .= $sql ?" $front `$key` = '$val' ": " `$key` = '$val' ";
}
return $sql;
}else {
return $data;
}
}
}
function pages($num,$curr_page,$perpage = 20,$urlrule = '',$array = array(),$setpages = 10) {
if(defined('URLRULE') &&$urlrule == '') {
$urlrule = URLRULE;
$array = $GLOBALS['URL_ARRAY'];
}elseif($urlrule == '') {
$urlrule = url_par('page={$page}');
}
$multipage = '';
if($num >$perpage) {
$page = $setpages+1;
$offset = ceil($setpages/2-1);
$pages = ceil($num / $perpage);
if (defined('IN_ADMIN') &&!defined('PAGES')) define('PAGES',$pages);
$from = $curr_page -$offset;
$to = $curr_page +$offset;
$more = 0;
if($page >= $pages) {
$from = 2;
$to = $pages-1;
}else {
if($from <= 1) {
$to = $page-1;
$from = 2;
}elseif($to >= $pages) {
$from = $pages-($page-2);
$to = $pages-1;
}
$more = 1;
}
$multipage .= '<a class="a1">'.$num.L('page_item').'</a>';
if($curr_page>0) {
if($curr_page>1)
{
$multipage .= ' <a href="'.pageurl($urlrule,$curr_page-1,$array).'" class="a1">'.L('previous').'</a>';
}
if($curr_page==1) {
$multipage .= ' <span>1</span>';
}elseif($curr_page>6 &&$more) {
$multipage .= ' <a href="'.pageurl($urlrule,1,$array).'">1</a>..';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,1,$array).'">1</a>';
}
}
for($i = $from;$i <= $to;$i++) {
if($i != $curr_page) {
$multipage .= ' <a href="'.pageurl($urlrule,$i,$array).'">'.$i.'</a>';
}else {
$multipage .= ' <span>'.$i.'</span>';
}
}
if($curr_page<$pages) {
if($curr_page<$pages-5 &&$more) {
$multipage .= ' ..<a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}
}elseif($curr_page==$pages) {
$multipage .= ' <span>'.$pages.'</span> <a href="'.pageurl($urlrule,$curr_page,$array).'" class="a1">'.L('next').'</a>';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}
}
return $multipage;
}
function housepages($num,$curr_page,$perpage = 20,$urlrule = '',$lst ,$setpages = 10) {
if(defined('URLRULE') &&$urlrule == '') {
$urlrule = URLRULE;
}elseif($urlrule == '') {
$urlrule = url_par('page={$page}');
}
$urlrule = str_replace('{$lst}',$lst,$urlrule);
$multipage .=  '<input type="hidden" id="nums" value="'.$num.'">';
if($num >$perpage) {
$page = $setpages+1;
$offset = ceil($setpages/2-1);
$pages = ceil($num / $perpage);
if (defined('IN_ADMIN') &&!defined('PAGES')) define('PAGES',$pages);
$from = $curr_page -$offset;
$to = $curr_page +$offset;
$more = 0;
if($page >= $pages) {
$from = 2;
$to = $pages-1;
}else {
if($from <= 1) {
$to = $page-1;
$from = 2;
}elseif($to >= $pages) {
$from = $pages-($page-2);
$to = $pages-1;
}
$more = 1;
}
$multipage .= '<a class="a1">'.$num.L('page_item').'</a>';
if($curr_page>0) {
if($curr_page>1)
{
$multipage .= ' <a href="'.pageurl($urlrule,$curr_page-1,$array).'" class="a1">'.L('previous').'</a>';
}
if($curr_page==1) {
$multipage .= ' <span>1</span>';
}elseif($curr_page>6 &&$more) {
$multipage .= ' <a href="'.pageurl($urlrule,1,$array).'">1</a>..';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,1,$array).'">1</a>';
}
}
for($i = $from;$i <= $to;$i++) {
if($i != $curr_page) {
$multipage .= ' <a href="'.pageurl($urlrule,$i,$array).'">'.$i.'</a>';
}else {
$multipage .= ' <span>'.$i.'</span>';
}
}
if($curr_page<$pages) {
if($curr_page<$pages-5 &&$more) {
$multipage .= ' ..<a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}
}elseif($curr_page==$pages) {
$multipage .= ' <span>'.$pages.'</span> <a href="'.pageurl($urlrule,$curr_page,$array).'" class="a1">'.L('next').'</a>';
}else {
$multipage .= ' <a href="'.pageurl($urlrule,$pages,$array).'">'.$pages.'</a> <a href="'.pageurl($urlrule,$curr_page+1,$array).'" class="a1">'.L('next').'</a>';
}
}
return $multipage;
}
function mobilepages($num,$curr_page,$perpage = 20,$urlrule = '',$lst,$setpages = 10) {
if(defined('URLRULE') &&$urlrule == '') {
$urlrule = URLRULE;
}elseif($urlrule == '') {
$urlrule = url_par('page={$page}');
}
$urlrule = str_replace('{$lst}',$lst,$urlrule);
if($num >$perpage) {
$page = $setpages+1;
$offset = ceil($setpages/2-1);
$pages = ceil($num / $perpage);
if (defined('IN_ADMIN') &&!defined('PAGES')) define('PAGES',$pages);
$from = $curr_page -$offset;
$to = $curr_page +$offset;
$more = 0;
if($page >= $pages) {
$from = 2;
$to = $pages-1;
}else {
if($from <= 1) {
$to = $page-1;
$from = 2;
}elseif($to >= $pages) {
$from = $pages-($page-2);
$to = $pages-1;
}
$more = 1;
}
if($pages>1 &&$curr_page>1)
{
$curr_page1 = $curr_page-1;
$multipage = '<a href="'.pageurl($urlrule,$curr_page1,$array).'" class="l_bn">上一页<i></i></a>';
}
if($pages>1 &&$curr_page<$pages)
{
$curr_page1 = $curr_page+1;
$multipage .= '<a href="'.pageurl($urlrule,$curr_page1,$array).'" class="r_bn">下一页<i></i></a>';
}
if($curr_page>0) {
$perpage = $curr_page == 1 ?1 : $curr_page-1;
$multipage .= '    '.$curr_page.'/'.$pages;
}
}
return $multipage;
}
function pageurl($urlrule,$page,$array = array()) {
if(strpos($urlrule,'~')) {
$urlrules = explode('~',$urlrule);
$urlrule = $page <2 ?$urlrules[0] : $urlrules[1];
}
$findme = array('{$page}');
$replaceme = array($page);
if (is_array($array)) foreach ($array as $k=>$v) {
$findme[] = '{$'.$k.'}';
$replaceme[] = $v;
}
$url = str_replace($findme,$replaceme,$urlrule);
$url = str_replace(array('http://','//','~'),array('~','/','http://'),$url);
return $url;
}
function url_par($par,$url = '') {
if($url == '') $url = get_url();
$pos = strpos($url,'?');
if($pos === false) {
$url .= '?'.$par;
}else {
$querystring = substr(strstr($url,'?'),1);
parse_str($querystring,$pars);
$query_array = array();
foreach($pars as $k=>$v) {
if($k != 'page') $query_array[$k] = $v;
}
$querystring = http_build_query($query_array).'&'.$par;
$url = substr($url,0,$pos).'?'.$querystring;
}
return $url;
}
function is_email($email) {
return strlen($email) >6 &&preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/",$email);
}
if (!function_exists('iconv')) {
function iconv($in_charset,$out_charset,$str) {
$in_charset = strtoupper($in_charset);
$out_charset = strtoupper($out_charset);
if (function_exists('mb_convert_encoding')) {
return mb_convert_encoding($str,$out_charset,$in_charset);
}else {
h5_base::load_sys_func('iconv');
$in_charset = strtoupper($in_charset);
$out_charset = strtoupper($out_charset);
if ($in_charset == 'UTF-8'&&($out_charset == 'GBK'||$out_charset == 'GB2312')) {
return utf8_to_gbk($str);
}
if (($in_charset == 'GBK'||$in_charset == 'GB2312') &&$out_charset == 'UTF-8') {
return gbk_to_utf8($str);
}
return $str;
}
}
}
function show_ad($siteid,$id) {
$siteid = intval($siteid);
$id = intval($id);
if(!$id ||!$siteid) return false;
$p = h5_base::load_model('poster_model');
$r = $p->get_one(array('spaceid'=>$id,'siteid'=>$siteid),'disabled, setting','`id` ASC');
if ($r['disabled']) return '';
if ($r['setting']) {
$c = string2array($r['setting']);
}else {
$r['code'] = '';
}
return $c['code'];
}
function get_siteid() {
static $siteid;
if (!empty($siteid)) return $siteid;
if (defined('IN_ADMIN')) {
if ($d = param::get_cookie('siteid')) {
$siteid = $d;
}else {
return '';
}
}else {
$data = getcache('sitelist','commons');
if(!is_array($data)) return '1';
$site_url = SITE_PROTOCOL.SITE_URL;
foreach ($data as $v) {
if ($v['url'] == $site_url.'/') $siteid = $v['siteid'];
}
}
if (empty($siteid)) $siteid = 1;
return $siteid;
}
function key_decode($key) {
return base64_decode(base64_decode($key));
}
function get_nickname($userid='',$field='') {
$return = '';
if(is_numeric($userid)) {
$member_db = h5_base::load_model('member_model');
$memberinfo = $member_db->get_one(array('userid'=>$userid));
if(!empty($field) &&$field != 'nickname'&&isset($memberinfo[$field]) &&!empty($memberinfo[$field])) {
$return = $memberinfo[$field];
}else {
$return = isset($memberinfo['nickname']) &&!empty($memberinfo['nickname']) ?$memberinfo['nickname'] : $memberinfo['username'];
}
}else {
if (param::get_cookie('_nickname')) {
$return .= '('.param::get_cookie('_nickname').')';
}else {
$return .= '('.param::get_cookie('_username').')';
}
}
return $return;
}

function get_memberinfo($userid,$field='') {
if(!is_numeric($userid)) {
return false;
}else {
static $memberinfo;
if (!isset($memberinfo[$userid])) {
$member_db = h5_base::load_model('member_model');
$memberinfo[$userid] = $member_db->get_one(array('userid'=>$userid));
}
if(!empty($field) &&!empty($memberinfo[$userid][$field])) {
return $memberinfo[$userid][$field];
}else {
return $memberinfo[$userid];
}
}
}
function get_memberinfo_buyusername($username,$field='') {
if(empty($username)){return false;}
static $memberinfo;
if (!isset($memberinfo[$username])) {
$member_db = h5_base::load_model('member_model');
$memberinfo[$username] = $member_db->get_one(array('username'=>$username));
}
if(!empty($field) &&!empty($memberinfo[$username][$field])) {
return $memberinfo[$username][$field];
}else {
return $memberinfo[$username];
}
}
function sms_getkeyord($i,$key){
$key=$key;
$key_max_index = strlen($key)-1;
if($i>$key_max_index) $i = $i%$key_max_index;
return ord($key[$i]);
}
function get_memberavatar($uid,$is_userid='',$size='30') {
if($is_userid) {
$db = h5_base::load_model('member_model');
$memberinfo = $db->get_one(array('userid'=>$uid));
if(isset($memberinfo['phpssouid'])) {
$uid = $memberinfo['phpssouid'];
}else {
return false;
}
}
h5_base::load_app_class('client','member',0);
define('APPID',h5_base::load_config('system','phpsso_appid'));
$phpsso_api_url = h5_base::load_config('system','phpsso_api_url');
$phpsso_auth_key = h5_base::load_config('system','phpsso_auth_key');
$client = new client($phpsso_api_url,$phpsso_auth_key);
$avatar = $client->ps_getavatar($uid);
if(isset($avatar[$size])) {
return $avatar[$size];
}else {
return false;
}
}
function menu_linkage($linkageid = 0,$id = 'linkid',$defaultvalue = 0) {
$linkageid = intval($linkageid);
$datas = array();
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
if($datas['style']=='1') {
$title = $datas['title'];
$container = 'content'.random(3).date('is');
if(!defined('DIALOG_INIT_1')) {
define('DIALOG_INIT_1',1);
$string .= '<script type="text/javascript" src="'.JS_PATH.'dialog.js"></script>';
}
if(!defined('LINKAGE_INIT_1')) {
define('LINKAGE_INIT_1',1);
$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/pop.js"></script>';
}
$var_div = $defaultvalue &&(ROUTE_A=='edit'||ROUTE_A=='account_manage_info'||ROUTE_A=='info_publish'||ROUTE_A=='orderinfo') ?menu_linkage_level($defaultvalue,$linkageid,$infos) : $datas['title'];
$var_input = $defaultvalue &&(ROUTE_A=='edit'||ROUTE_A=='account_manage_info'||ROUTE_A=='info_publish') ?'<input type="hidden" name="info['.$id.']" value="'.$defaultvalue.'">': '<input type="hidden" name="info['.$id.']" value="">';
$string .= '<div name="'.$id.'" value="" id="'.$id.'" class="ib">'.$var_div.'</div>'.$var_input.' <input type="button" name="btn_'.$id.'" class="button" value="'.L('linkage_select').'" onclick="open_linkage(\''.$id.'\',\''.$title.'\','.$container.',\''.$linkageid.'\')">';
$string .= '<script type="text/javascript">';
$string .= 'var returnid_'.$id.'= \''.$id.'\';';
$string .= 'var returnkeyid_'.$id.' = \''.$linkageid.'\';';
$string .=  'var '.$container.' = new Array(';
foreach($infos AS $k=>$v) {
if($v['parentid'] == 0) {
$s[]='new Array(\''.$v['linkageid'].'\',\''.$v['name'].'\',\''.$v['parentid'].'\')';
}else {
continue;
}
}
$s = implode(',',$s);
$string .=$s;
$string .= ')';
$string .= '</script>';
}elseif($datas['style']=='2') {
if(!defined('LINKAGE_INIT_1')) {
define('LINKAGE_INIT_1',1);
$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/jquery.ld.js"></script>';
}
$default_txt = '';
if($defaultvalue) {
$default_txt = menu_linkage_level($defaultvalue,$linkageid,$infos);
$default_txt = '["'.str_replace(' > ','","',$default_txt).'"]';
}
$string .= $defaultvalue &&(ROUTE_A=='edit'||ROUTE_A=='account_manage_info'||ROUTE_A=='info_publish') ?'<input type="hidden" name="info['.$id.']"  id="'.$id.'" value="'.$defaultvalue.'">': '<input type="hidden" name="info['.$id.']"  id="'.$id.'" value="">';
for($i=1;$i<=$datas['setting']['level'];$i++) {
$string .='<select class="pc-select-'.$id.'" name="'.$id.'-'.$i.'" id="'.$id.'-'.$i.'" width="100"><option value="">请选择菜单</option></select> ';
}
$string .= '<script type="text/javascript">
					$(function(){
						var $ld5 = $(".pc-select-'.$id.'");					  
						$ld5.ld({ajaxOptions : {"url" : "'.APP_PATH.'api.php?op=get_linkage&act=ajax_select&keyid='.$linkageid.'"},defaultParentId : 0,style : {"width" : 120}})	 
						var ld5_api = $ld5.ld("api");
						ld5_api.selected('.$default_txt.');
						$ld5.bind("change",onchange);
						function onchange(e){
							var $target = $(e.target);
							var index = $ld5.index($target);
							$("#'.$id.'-'.$i.'").remove();
							$("#'.$id.'").val($ld5.eq(index).show().val());
							index ++;
							$ld5.eq(index).show();								}
					})
		</script>';
}else {
$title = $defaultvalue ?$infos[$defaultvalue]['name'] : $datas['title'];
$colObj = random(3).date('is');
$string = '';
if(!defined('LINKAGE_INIT')) {
define('LINKAGE_INIT',1);
$string .= '<script type="text/javascript" src="'.JS_PATH.'linkage/js/mln.colselect.js"></script>';
if(defined('IN_ADMIN')) {
$string .= '<link href="'.JS_PATH.'linkage/style/admin.css" rel="stylesheet" type="text/css">';
}else {
$string .= '<link href="'.JS_PATH.'linkage/style/css.css" rel="stylesheet" type="text/css">';
}
}
$string .= '<input type="hidden" name="info['.$id.']" value="1"><div id="'.$id.'"></div>';
$string .= '<script type="text/javascript">';
$string .= 'var colObj'.$colObj.' = {"Items":[';
foreach($infos AS $k=>$v) {
$s .= '{"name":"'.$v['name'].'","topid":"'.$v['parentid'].'","colid":"'.$k.'","value":"'.$k.'","fun":function(){}},';
}
$string .= substr($s,0,-1);
$string .= ']};';
$string .= '$("#'.$id.'").mlnColsel(colObj'.$colObj.',{';
$string .= 'title:"'.$title.'",';
$string .= 'value:"'.$defaultvalue.'",';
$string .= 'width:100';
$string .= '});';
$string .= '</script>';
}
return $string;
}
function menu_linkage_level($linkageid,$keyid,$infos,$result=array()) {
if(array_key_exists($linkageid,$infos)) {
$result[]=$infos[$linkageid]['name'];
return menu_linkage_level($infos[$linkageid]['parentid'],$keyid,$infos,$result);
}
krsort($result);
return implode(' > ',$result);
}
function menu_level($menuid,$cache_file,$cache_path = 'commons',$key = 'catname',$parentkey = 'parentid',$linkstring = ' > ',$result=array()) {
$menu_arr = getcache($cache_file,$cache_path);
if (array_key_exists($menuid,$menu_arr)) {
$result[] = $menu_arr[$menuid][$key];
return menu_level($menu_arr[$menuid][$parentkey],$cache_file,$cache_path,$key,$parentkey,$linkstring,$result);
}
krsort($result);
return implode($linkstring,$result);
}
function get_linkage($linkageid,$keyid,$space = '>',$type = 1,$result = array(),$infos = array()) {
if($space==''||!isset($space))$space = '>';
if(!$infos) {
$datas = getcache($keyid,'linkage');
$infos = $datas['data'];
}
if($type == 1 ||$type == 3 ||$type == 4) {
if(array_key_exists($linkageid,$infos)) {
$result[]= ($type == 1) ?$infos[$linkageid]['name'] : (($type == 4) ?$linkageid :$infos[$linkageid]);
return get_linkage($infos[$linkageid]['parentid'],$keyid,$space,$type,$result,$infos);
}else {
if(count($result)>0) {
krsort($result);
if($type == 1 ||$type == 4) $result = implode($space,$result);
return $result;
}else {
return $result;
}
}
}else {
return $infos[$linkageid]['name'];
}
}
function is_ie() {
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
if((strpos($useragent,'opera') !== false) ||(strpos($useragent,'konqueror') !== false)) return false;
if(strpos($useragent,'msie ') !== false) return true;
return false;
}
function file_down($filepath,$filename = '') {
if(!$filename) $filename = basename($filepath);
if(is_ie()) $filename = rawurlencode($filename);
$filetype = fileext($filename);
$filesize = sprintf("%u",filesize($filepath));
if(ob_get_length() !== false) @ob_end_clean();
header('Pragma: public');
header('Last-Modified: '.gmdate('D, d M Y H:i:s') .' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header('Content-Transfer-Encoding: binary');
header('Content-Encoding: none');
header('Content-type: '.$filetype);
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-length: '.$filesize);
readfile($filepath);
exit;
}
function is_utf8($string) {
return preg_match('%^(?:
					[\x09\x0A\x0D\x20-\x7E] # ASCII
					| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
					| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
					| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
					| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
					)*$%xs',$string);
}
function id_encode($modules,$contentid,$siteid) {
return urlencode($modules.'-'.$contentid.'-'.$siteid);
}
function id_decode($id) {
return explode('-',$id);
}
function password($password,$encrypt='') {
$pwd = array();
$pwd['encrypt'] =  $encrypt ?$encrypt : create_randomstr();
$pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
return $encrypt ?$pwd['password'] : $pwd;
}
function create_randomstr($lenth = 6) {
return random($lenth,'123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}
function is_password($password) {
$strlen = strlen($password);
if($strlen >= 6 &&$strlen <= 20) return true;
return false;
}
function is_badword($string) {
$badwords = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n","#");
foreach($badwords as $value){
if(strpos($string,$value) !== FALSE) {
return TRUE;
}
}
return FALSE;
}
function is_username($username) {
$strlen = strlen($username);
if(is_badword($username) ||!preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/",$username)){
return false;
}elseif ( 20 <$strlen ||$strlen <2 ) {
return false;
}
return true;
}
function check_in($id,$ids = '',$s = ',') {
if(!$ids) return false;
$ids = explode($s,$ids);
return is_array($id) ?array_intersect($id,$ids) : in_array($id,$ids);
}
function array_iconv($data,$input = 'gbk',$output = 'utf-8') {
if (!is_array($data)) {
return iconv($input,$output,$data);
}else {
foreach ($data as $key=>$val) {
if(is_array($val)) {
$data[$key] = array_iconv($val,$input,$output);
}else {
$data[$key] = iconv($input,$output,$val);
}
}
return $data;
}
}
function thumb($imgurl,$width = 100,$height = 100 ,$autocut = 1,$smallpic = 'nopic.gif') {
global $image;
$upload_url = h5_base::load_config('system','upload_url');
$upload_path = h5_base::load_config('system','upload_path');
if(empty($imgurl)) return IMG_PATH.$smallpic;
$imgurl_replace= str_replace($upload_url,'',$imgurl);
if(!extension_loaded('gd') ||strpos($imgurl_replace,'://')) return $imgurl;
if(!file_exists($upload_path.$imgurl_replace)) return IMG_PATH.$smallpic;
list($width_t,$height_t,$type,$attr) = getimagesize($upload_path.$imgurl_replace);
if($width>=$width_t ||$height>=$height_t) return $imgurl;
$newimgurl = dirname($imgurl_replace).'/thumb_'.$width.'_'.$height.'_'.basename($imgurl_replace);
if(file_exists($upload_path.$newimgurl)) return $upload_url.$newimgurl;
if(!is_object($image)) {
h5_base::load_sys_class('image','','0');
$image = new image(1,0);
}
return $image->thumb($upload_path.$imgurl_replace,$upload_path.$newimgurl,$width,$height,'',$autocut) ?$upload_url.$newimgurl : $imgurl;
}
function watermark($source,$target = '',$siteid) {
global $image_w;
if(empty($source)) return $source;
if(!extension_loaded('gd') ||strpos($source,'://')) return $source;
if(!$target) $target = $source;
if(!is_object($image_w)){
h5_base::load_sys_class('image','','0');
$image_w = new image(0,$siteid);
}
$image_w->watermark($source,$target);
return $target;
}
function catpos($catid,$symbol=' > '){
$category_arr = array();
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category_arr = getcache('category_content_'.$siteid,'commons');
if(!isset($category_arr[$catid])) return '';
$pos = '';
$siteurl = siteurl($category_arr[$catid]['siteid']);
$arrparentid = array_filter(explode(',',$category_arr[$catid]['arrparentid'].','.$catid));
foreach($arrparentid as $catid) {
$url = $category_arr[$catid]['url'];
if(strpos($url,'://') === false) $url = $siteurl.$url;
$pos .= '<a href="'.$url.'">'.$category_arr[$catid]['catname'].'</a>'.$symbol;
}
return $pos;
}
function get_sql_catid($file = 'category_content_1',$catid = 0,$module = 'commons') {
$category = getcache($file,$module);
$catid = intval($catid);
if(!isset($category[$catid])) return false;
return $category[$catid]['child'] ?" `catid` IN(".$category[$catid]['arrchildid'].") ": " `catid`=$catid ";
}
function subcat($parentid = NULL,$type = NULL,$self = '0',$siteid = '') {
if (empty($siteid)) $siteid = get_siteid();
$category = getcache('category_content_'.$siteid,'commons');
foreach($category as $id=>$cat) {
if($cat['siteid'] == $siteid &&($parentid === NULL ||$cat['parentid'] == $parentid) &&($type === NULL ||$cat['type'] == $type)) $subcat[$id] = $cat;
if($self == 1 &&$cat['catid'] == $parentid &&!$cat['child'])  $subcat[$id] = $cat;
}
return $subcat;
}
function go($catid,$id,$allurl = 0) {
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$id = intval($id);
if(!$id ||!isset($category[$catid])) return '';
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$r = $db->get_one(array('id'=>$id),'`url`');
if (!empty($allurl)) {
if (strpos($r['url'],'://')===false) {
if (strpos($category[$catid]['url'],'://') === FALSE) {
$site = siteinfo($category[$catid]['siteid']);
$r['url'] = substr($site['domain'],0,-1).$r['url'];
}else {
$r['url'] = $category[$catid]['url'].$r['url'];
}
}
}
return $r['url'];
}
function atturl($path) {
if(strpos($path,':/')) {
return $path;
}else {
$sitelist = getcache('sitelist','commons');
$siteid =  get_siteid();
$siteurl = $sitelist[$siteid]['domain'];
$domainlen = strlen($sitelist[$siteid]['domain'])-1;
$path = $siteurl.$path;
$path = substr_replace($path,'/',strpos($path,'//',$domainlen),2);
return 	$path;
}
}
function module_exists($m = '') {
if ($s=='admin') return true;
$modules = getcache('modules','commons');
$modules = array_keys($modules);
return in_array($m,$modules);
}
function seo($siteid,$catid = '',$title = '',$description = '',$keyword = '') {
if (!empty($title))$title = strip_tags($title);
if (!empty($description)) $description = strip_tags($description);
if (!empty($keyword)) $keyword = str_replace(' ',',',strip_tags($keyword));
$sites = getcache('sitelist','commons');
$site = $sites[$siteid];
$cat = array();
if (!empty($catid)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$categorys = getcache('category_content_'.$siteid,'commons');
$cat = $categorys[$catid];
$cat['setting'] = string2array($cat['setting']);
}
$seo['site_title'] =isset($site['site_title']) &&!empty($site['site_title']) ?$site['site_title'] : $site['name'];
$seo['keyword'] = !empty($keyword) ?$keyword : $site['keywords'];
$seo['description'] = isset($description) &&!empty($description) ?$description : (isset($cat['setting']['meta_description']) &&!empty($cat['setting']['meta_description']) ?$cat['setting']['meta_description'] : (isset($site['description']) &&!empty($site['description']) ?$site['description'] : ''));
$seo['title'] =  (isset($title) &&!empty($title) ?$title.'_': '').(isset($cat['setting']['meta_title']) &&!empty($cat['setting']['meta_title']) ?$cat['setting']['meta_title'].'_': '');
foreach ($seo as $k=>$v) {
$seo[$k] = str_replace(array("\n","\r"),'',$v);
}
return $seo;
}
function siteinfo($siteid) {
static $sitelist;
if (empty($sitelist)) $sitelist  = getcache('sitelist','commons');
return isset($sitelist[$siteid]) ?$sitelist[$siteid] : '';
}
function tjcode() {
if(!module_exists('cnzz')) return false;
$config = getcache('cnzz','commons');
if (empty($config)) {
return false;
}else {
return '<script src=\'http://pw.cnzz.com/c.php?id='.$config['siteid'].'&l=2\' language=\'JavaScript\' charset=\'gb2312\'></script>';
}
}
function title_style($style,$html = 1) {
$str = '';
if ($html) $str = ' style="';
$style_arr = explode(';',$style);
if (!empty($style_arr[0])) $str .= 'color:'.$style_arr[0].';';
if (!empty($style_arr[1])) $str .= 'font-weight:'.$style_arr[1].';';
if ($html) $str .= '" ';
return $str;
}
function siteurl($siteid) {
static $sitelist;
if(!$siteid) return WEB_PATH;
if(empty($sitelist)) $sitelist = getcache('sitelist','commons');
return substr($sitelist[$siteid]['domain'],0,-1);
}
function upload_key($args) {
$h5_auth_key = md5(h5_base::load_config('system','auth_key').$_SERVER['HTTP_USER_AGENT']);
$authkey = md5($args.$h5_auth_key);
return $authkey;
}
function string2img($txt,$fonttype = 5,$fontsize = 16,$font = '',$fontcolor = 'FF0000',$transparent = '1') {
if(empty($txt)) return false;
if(function_exists("imagepng")) {
$txt = urlencode(sys_auth($txt));
$txt = '<img src="'.APP_PATH.'api.php?op=creatimg&txt='.$txt.'&fonttype='.$fonttype.'&fontsize='.$fontsize.'&font='.$font.'&fontcolor='.$fontcolor.'&transparent='.$transparent.'" align="absmiddle">';
}
return $txt;
}
function get_h5_version($type='') {
$version = h5_base::load_config('version');
if($type==1) {
return $version['h5_version'];
}elseif($type==2) {
return $version['h5_release'];
}else {
return $version['h5_version'].' '.$version['h5_release'];
}
}
function runhook($method) {
$time_start = getmicrotime();
$data  = '';
$getpclass = FALSE;
$hook_appid = getcache('hook','plugins');
if(!empty($hook_appid)) {
foreach($hook_appid as $appid =>$p) {
$pluginfilepath = H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$p.DIRECTORY_SEPARATOR.'hook.class.php';
$getpclass = TRUE;
include_once $pluginfilepath;
}
$hook_appid = array_flip($hook_appid);
if($getpclass) {
$pclass = new ReflectionClass('hook');
foreach($pclass->getMethods() as $r) {
$legalmethods[] = $r->getName();
}
}
if(in_array($method,$legalmethods)) {
foreach (get_declared_classes() as $class){
$refclass = new ReflectionClass($class);
if($refclass->isSubclassOf('hook')){
if ($_method = $refclass->getMethod($method)) {
$classname = $refclass->getName();
if ($_method->isPublic() &&$_method->isFinal()) {
$data .= $_method->invoke(null);
}
}
}
}
}
return $data;
}
}
function getmicrotime() {
list($usec,$sec) = explode(" ",microtime());
return ((float)$usec +(float)$sec);
}
function p_template($plugin = 'content',$template = 'index',$style='default') {
if(!$style) $style = 'default';
$template_cache = h5_base::load_sys_class('template_cache');
$compiledtplfile = HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_template'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$template.'.php';
if(!file_exists($compiledtplfile) ||(file_exists(H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html') &&filemtime(H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html') >filemtime($compiledtplfile))) {
$template_cache->template_compile('plugin/'.$plugin,$template,'default');
}elseif (!file_exists(H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html')) {
showmessage('Template does not exist.'.DIRECTORY_SEPARATOR.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.$template.'.html');
}
return $compiledtplfile;
}
function cache_page_start() {
$relate_url = isset($_SERVER['REQUEST_URI']) ?safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ?'?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
define('CACHE_PAGE_ID',md5($relate_url));
$contents = getcache(CACHE_PAGE_ID,'page_tmp/'.substr(CACHE_PAGE_ID,0,2));
if($contents &&intval(substr($contents,15,10)) >SYS_TIME) {
echo substr($contents,29);
exit;
}
if (!defined('HTML')) define('HTML',true);
return true;
}
function cache_page($ttl = 360,$isjs = 0) {
if($ttl == 0 ||!defined('CACHE_PAGE_ID')) return false;
$contents = ob_get_contents();
if($isjs) $contents = format_js($contents);
$contents = "<!--expiretime:".(SYS_TIME +$ttl)."-->\n".$contents;
setcache(CACHE_PAGE_ID,$contents,'page_tmp/'.substr(CACHE_PAGE_ID,0,2));
}
function h5_file_get_contents($url,$timeout=30) {
$stream = stream_context_create(array('http'=>array('timeout'=>$timeout)));
return @file_get_contents($url,0,$stream);
}
function get_typename($str,$style=0)
{
if(!empty($str) &&$str<>'0')
{
if(stripos($str,',')===false) {
$str = intval($str);
return get_typename_byid($str,$style);
}
else
{
$option = array('1'=>'住宅','2'=>'花园洋房','3'=>'酒店式公寓','4'=>'商住两用','5'=>'综合体','6'=>'别墅','7'=>'写字楼','8'=>'商铺','9'=>'公寓','10'=>'经济适用房');
$value_arr = explode(',',$str);
foreach($value_arr as $_v) {
if($_v) 
{
if($style=="1")
{
$string .='<div class="a3">'.$option[$_v].'</div>';
}
elseif($style=="2")
{
$string .='['.$option[$_v].'] ';
}
else
{
$string .= $option[$_v].' ';
}
}
}
return trim($string);
}
}
return 0;
}
function get_typename_byid($id,$style)
{
switch($id) {
case '1':
$typename = '住宅';
break;
case '2':
$typename = '花园洋房';
break;
case '3':
$typename = '酒店式公寓';
break;
case '4':
$typename = '商住两用';
break;
case '5':
$typename = '综合体';
break;
case '6':
$typename = '别墅';
break;
case '7':
$typename = '写字楼';
break;
case '8':
$typename = '商铺';
break;
case '9':
$typename = '公寓';
break;
case '10':
$typename = '经济适用房';
break;
default:
$typename = '住宅';
break;
}
if($style=="1")
{
$typename ='<div class="a3">'.$typename.'</div>';
}
elseif($style=="2")
{
$typename ='['.$typename.']';
}
return $typename;
}
function get_ztname($id)
{
switch($id) {
case '1':
$typename = '在售';
break;
case '2':
$typename = '即将上市';
break;
case '3':
$typename = '尾盘';
break;
case '4':
$typename = '售完';
break;
default:
$typename = '住宅';
break;
}
return $typename;
}
function get_charactername($str)
{
if(!empty($str) &&$str<>'0')
{
if(stripos($str,',')===false) {
$str = intval($str);
return get_charactername_byid($str);
}
else
{
$option = array('2'=>'小户型','3'=>'公园地产','4'=>'学区房','5'=>'旅游地产','6'=>'投资地产','7'=>'海景地产','8'=>'经济住宅','9'=>'宜居生态地产');
$value_arr = explode(',',$str);
foreach($value_arr as $k =>$_v) {
if($_v) 
{
if($k==count($value_arr)-1)
{
$string .= $option[$_v];
}
else
{
$string .= $option[$_v].'/';
}
}
}
return trim($string);
}
}
return '暂无资料';
}
function get_charactername_byid($id)
{
switch($id) {
case '2':
$typename = '小户型';
break;
case '3':
$typename = '公园地产';
break;
case '4':
$typename = '学区房';
break;
case '5':
$typename = '旅游地产';
break;
case '6':
$typename = '投资地产';
break;
case '7':
$typename = '海景地产';
break;
case '8':
$typename = '经济住宅';
break;
case '9':
$typename = '宜居生态地产';
break;
default:
$typename = '旅游地产';
break;
}
return $typename;
}
function get_fix($id)
{
switch($id) {
case '1':
$typename = '毛坯';
break;
case '2':
$typename = '简装修';
break;
case '3':
$typename = '精装修';
break;
case '4':
$typename = '豪华装修';
break;
default:
$typename = '毛坯';
break;
}
return $typename;
}
function menu_linkinfo($linkageid,$defaultvalue,$style = '')
{
$datas = array();
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
$default_txt = menu_linkage_level($defaultvalue,$linkageid,$infos);
if($style)
{
$default_txt = str_replace(' > ','/',$default_txt);
}
else
{
$default_txt = '['.str_replace(' > ','][',$default_txt).']';
}
return $default_txt;
}
function get_price($price)
{
if(($price=="一房一价")||empty($price))
{
return $price;
}
else return $price.'元/㎡';
}
function get_relationlp($id,$catid)
{
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$id),'xglp');
$returnstr = '';
if($r['xglp'])
{
if(stripos($r['xglp'],'|')===false) {
$r['xglp'] = intval($r['xglp']);
$str = get_relationinfo($r['xglp'],$catid);
}
else
{
$value_arr = explode('|',$r['xglp']);
foreach($value_arr as $_v) {
if($_v) 
{
$str.=get_relationinfo($_v,$catid);
}
}
}
$returnstr = '<div class="a4">切换到<span class="linkb">'.$str.'</span></div>';
}
return $returnstr;
}
function get_relationinfo($id,$catid,$style = '')
{
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$r = $db->get_one(array('id'=>$id),'url,title,type,map,region,address,jiaotong');
if($r)
{
if($style)
{
return $r;
}
else
return '[<a href="'.$r[url].'">'.get_typename($r[type]).'</a>]';
}
}
function get_relationxq($id,$catid,$xqcatid)
{
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$id),'relation');
$returnstr = '';
if($r['relation'])
{
if(stripos($r['relation'],'|')===false) {
$r['relation'] = intval($r['relation']);
$str = get_relationinfo($r['relation'],$xqcatid,1);
}
else
{
$value_arr = explode('|',$r['relation']);
foreach($value_arr as $_v) {
if($_v) 
{
$str=get_relationinfo($_v,$xqcatid,1);
}
}
}
$returnstr = $str;
}
return $returnstr;
}
function menu_links($linkageid,$defaultvalue,$style,$sitepath = '')
{
$datas = array();
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
$default_txt = menu_linkage_level_link($defaultvalue,$linkageid,$infos,$style,$sitepath);
return $default_txt;
}
function menu_linkage_level_link($linkageid,$keyid,$infos,$style,$sitepath,$result=array())
{
if(!$sitepath)
{
$sitepath = HOUSE_PATH;
}
if(array_key_exists($linkageid,$infos)) {
if($infos[$linkageid]['parentid']=="0")
{
$result[]=$infos[$linkageid]['name'].'$$'.$linkageid;
}
else
{
$result[]=$infos[$linkageid]['name'].'##'.$linkageid;
}
return menu_linkage_level_link($infos[$linkageid]['parentid'],$keyid,$infos,$style,$sitepath,$result);
}
krsort($result);
foreach($result as $_v) {
if($_v) 
{
if(stristr($_v,'$$')!=false)
{
$str = explode('$$',$_v);
if($style)
{
$return.='[<a href="'.$sitepath.'list-r'.$str[1].'.html" target="_blank">'.$str[0].'</a>]';
}
else
$return.='<a href="'.$sitepath.'list-r'.$str[1].'.html" target="_blank">'.$str[0].'</a> > ';
}
if(stristr($_v,'##')!=false)
{
$strstr = explode('##',$_v);
if($style)
{
$return.='[<a href="'.$sitepath.'list-r'.$str[1].'-b'.$strstr[1].'.html" target="_blank">'.$strstr[0].'</a>]';
}
else
$return.='<a href="'.$sitepath.'list-r'.$str[1].'-b'.$strstr[1].'.html" target="_blank">'.$strstr[0].'</a> > ';
}
}
}
return $return;
}
function get_trend($id)
{
switch($id) {
case '0':
$trend = '-';
break;
case '1':
$trend = '<font style="color:#c00;">↑</font>';
break;
case '2':
$trend = '<font style="color:#390;">↓</font>';
break;
default:
$trend = '-';
break;
}
return $trend;
}
function getcompany_name($id,$catid)
{
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$r = $db->get_one(array('id'=>$id),'title');
if($r)
return $r[title];
}
function deal_str($str,$s)
{
if(stripos($str,'-'.$s)!==false)
{
if($s=='e'||$s=='m')
{
$str = preg_replace ( '/\-'.$s.'[0-9_]+/','',$str );
}
else
{
$str = preg_replace ( '/\-'.$s.'[\d]+/','',$str );
}
if($s=='r')
{
$str = deal_str($str,'b');
}
elseif($s=='p')
{
$str = deal_str($str,'e');
}
elseif($s=='c')
{
$str = deal_str($str,'m');
}
}
elseif($s=='p')
{
$str = deal_str($str,'e');
}
elseif($s=='c')
{
$str = deal_str($str,'m');
}
elseif($s=='u')
{
$str = deal_str($str,'h');
}
return $str;
}
function deal_str2($str)
{
$str = preg_replace ( '/\-r[\d]+/','',$str );
$str = preg_replace ( '/\-k[^/]+/','',$str );
return $str;
}
function get_arrchildid($linkageid,$defaultvalue) {
$arrchildid = $defaultvalue;
$datas = array();
$datas = getcache($linkageid,'linkage');
$linkageinfo = $datas['data'];
if(is_array($linkageinfo)) {
foreach($linkageinfo as $linkage) {
if($linkage['parentid'] &&$linkage['linkageid'] != $defaultvalue &&$linkage['parentid']== $defaultvalue) 	{
$arrchildid .= ','.get_arrchildid($linkageid,$linkage['linkageid']);
}
}
}
return $arrchildid;
}
function uencode($u) {
return base64_encode(urlEncode($u));
}
function udecode($u) {
return urlDecode(base64_decode($u));
}
function get_typename_bytypeid($siteid,$typeid)
{
$types = array();
$types = getcache('type_content_'.$siteid,'commons');
foreach ($types as $_k=>$_v) 
{
if($typeid == $_v['typeid'])
$typename = $_v['name'];
}
return $typename;
}
function menu_info($linkageid,$defaultvalue)
{
$datas = array();
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
$default_txt = menu_info_level($defaultvalue,$linkageid,$infos);
$default_arr = explode('$$',$default_txt);
return $default_arr;
}
function menu_info_level($linkageid,$keyid,$infos,$result=array()) {
if(array_key_exists($linkageid,$infos)) {
if($infos[$linkageid]['parentid']=="0")
{
return $infos[$linkageid]['name'].'$$'.$linkageid;
}
return menu_info_level($infos[$linkageid]['parentid'],$keyid,$infos,$result);
}
}
function gethouse_thumb($id,$catid){
static $category;
if(empty($category)) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category = getcache('category_content_'.$siteid,'commons');
}
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$r = $db->get_one(array('id'=>$id),'thumb');
if($r['thumb'])
{
return '<img src="'.thumb($r[thumb],130,90).'" width="130" height="90" />';
}
else
{
return '<img src="'.APP_PATH.'statics/default/img/index/nopic.jpg" width="130" height="90" />';
}
}
function catname($catid){
$category_arr = array();
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category_arr = getcache('category_content_'.$siteid,'commons');
if(!isset($category_arr[$catid])) return '';
return $category_arr[$catid]['catname'];
}
function catnamelink($catid,$symbol='',$target=''){
$category_arr = array();
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category_arr = getcache('category_content_'.$siteid,'commons');
if(!isset($category_arr[$catid])) return '';
$siteurl = siteurl($category_arr[$catid]['siteid']);
$url = $category_arr[$catid]['url'];
if(strpos($url,'://') === false) $url = $siteurl.$url;
if($symbol)
{
$pos = '<a href="'.$url.'"><b>'.$category_arr[$catid]['catname'].'</b></a>';
}
else
{
$pos = '<a href="'.$url.'">'.$category_arr[$catid]['catname'].'</a>';
}
if($target)
{
$pos = '<a href="'.$url.'" target="_blank">'.$category_arr[$catid]['catname'].'</a>';
}
return $pos;
}
function catlink($catid){
$category_arr = array();
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category_arr = getcache('category_content_'.$siteid,'commons');
if(!isset($category_arr[$catid])) return '';
$siteurl = siteurl($category_arr[$catid]['siteid']);
$url = $category_arr[$catid]['url'];
if(strpos($url,'://') === false) 
{
$relative_path = h5_base::load_config('system','relative_path');
if(!$relative_path)
{
$url = $siteurl.$url;
}
}
return $url;
}
function topcat($catid){
$category_arr = array();
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$category_arr = getcache('category_content_'.$siteid,'commons');
if(!isset($category_arr[$catid])) return '';
$arrparentid = array_filter(explode(',',$category_arr[$catid]['arrparentid'].','.$catid));
$num = count($arrparentid);
if($num>2)
{
return $arrparentid[$num-1];
}
else
{
return 0;
}
}
function price_short($price)
{
$price = trim($price);
if(strpos($price,'-')!== false) {
$pricearr = explode('-',$price);
$pricea = (int)$pricearr[0];
$priceb = (int)$pricearr[1];
$pricea = (float)$pricea/10000;
$priceb = (float)$priceb/10000;
return $pricea.'-'.$priceb.'万元';
}
else
{
$price = (int)$price;
$price = (float)$price/10000;
return $price.'万元';
}
}
function menu_lastinfo($linkageid,$defaultvalue)
{
$datas = array();
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
return $infos[$defaultvalue]['name'];
}
function get_tuancount($id) {
$db = h5_base::load_model('sitemodel_field_model');
$f_db = h5_base::load_model('sitemodel_model');
$tablename = 'form_tuangou';
$db->change_table($tablename);
$r = $db->get_one(array('relation'=>$id),"COUNT(dataid) total");
if(!$r ||empty($r['total'])) 
{
$r['total']= 10;
}
else
{
$r['total']+=10;
}
return $r['total'];
}
function pay_decode()
{
$txt = h5_base::load_config('dcer','secret');
$key = h5_base::load_config('dcer','key');
if(!$txt||!$key) die('e');
$key = trim($key);
$txt=udecode(urldecode($txt));
for($i=0;$i<strlen($txt);$i++){
$txt[$i]=chr(ord($txt[$i])-sms_getkeyord($i,$key));
}
return $txt;
}
function get_routecount($id) {
$db = h5_base::load_model('sitemodel_field_model');
$f_db = h5_base::load_model('sitemodel_model');
$tablename = 'form_tuangou';
$db->change_table($tablename);
$r = $db->get_one(array('relatedid'=>$id,'type'=>1),"sum(num) total");
if(!$r ||empty($r['total'])) 
{
$r['total']= 10;
}
else
{
$r['total']+=10;
}
return $r['total'];
}
function hidden($str,$style='')
{
if($style)
{
$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
$replacement = "\$1****\$3";
return  preg_replace($pattern,$replacement,$str);
}
else
{
$start = substr($str,0,2);
return $start.'**';
}
}
function is_mobile(){
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if(trim($user_agent) == '')return true;
$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte",'Opera Mini','Kindle','Silk/','Mobile','baidu Transcoder');
$is_mobile = false;
foreach($mobile_agents as $device){
if(stristr($user_agent,$device) !== FALSE){
$is_mobile = true;
break;
}
}
return $is_mobile;
}
function count_info_nums($catid,$type,$admin)
{
$db = h5_base::load_model('content_model');
$siteid = get_siteid();
$categorys = getcache('category_content_'.$siteid,'commons');
$where = '';
if(!$catid)	return '';
$category = $categorys[$catid];
$modelid = $category['modelid'];
$db->set_model($modelid);
if($categorys[$catid]['child']) {
$catids_str = $categorys[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$where .= "AND `catid` IN ($catids_str) ";
}
else
{
$where .= "AND `catid`='$catid' ";
}
if($where) $where = substr($where,3);
$year = date('Y');
$month =  date('m');
$where.= "and `status`='99' and islink=0";
if($type=='3')
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year' and MONTH(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$month'";
}
else if($type=='2')
{
$where.= " and WEEKOFYEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = WEEKOFYEAR(now()) and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year'";
}
else if($type=='1')
{
$where.= " and DATEDIFF(now() , FROM_UNIXTIME(inputtime)) = 1";
}
if($admin)
{
$where.= " and username='$admin'";
}
return $db->count($where);
}
function count_info_hits($catid,$type,$admin)
{
$db = h5_base::load_model('content_model');
$siteid = get_siteid();
$categorys = getcache('category_content_'.$siteid,'commons');
$where = '';
if(!$catid)	return '';
$category = $categorys[$catid];
$modelid = $category['modelid'];
$db->set_model($modelid);
$tablename = $db->table_name;
if($categorys[$catid]['child']) {
$catids_str = $categorys[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$where .= "AND `catid` IN ($catids_str) ";
}
else
{
$where .= "AND `catid`='$catid' ";
}
if($where) $where = substr($where,3);
$year = date('Y');
$month =  date('m');
$where.= "and `status`='99' and islink=0";
if($type=='3')
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year' and MONTH(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$month'";
}
else if($type=='2')
{
$where.= " and WEEKOFYEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = WEEKOFYEAR(now()) and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year'";
}
else if($type=='1')
{
$where.= " and DATEDIFF(now() , FROM_UNIXTIME(inputtime)) = 1";
}
if($admin)
{
$where.= " and username='$admin'";
}
$rs = $db->query("SELECT id FROM $tablename where $where");
$infos = $db->fetch_array($rs);
if($infos)
{
foreach($infos as $info)
{
$ids_array[]= "'".'c-'.$modelid.'-'.$info['id']."'";
}
$ids = implode(',',$ids_array);
if($ids) {
$sql = "hitsid IN ($ids)";
}else {
$sql = '';
}
$db = '';
$db = h5_base::load_model('hits_model');
$r = $db->get_one($sql,"sum(views) total");
return $r['total'];
}
else
{
return 0;
}
}
function count_wenfang_nums($catid,$type,$reply)
{
$db = h5_base::load_model('content_model');
$siteid = get_siteid();
$categorys = getcache('category_content_'.$siteid,'commons');
$where = '1=1';
if(!$catid)	return '';
$category = $categorys[$catid];
$modelid = $category['modelid'];
$db->set_model($modelid);
$year = date('Y');
$month =  date('m');
if($type=='3')
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year' and MONTH(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$month'";
}
else if($type=='2')
{
$where.= " and WEEKOFYEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = WEEKOFYEAR(now()) and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year'";
}
else if($type=='1')
{
$where.= " and DATEDIFF(now() , FROM_UNIXTIME(inputtime)) = 1";
}
if($reply)
{
$where.= " and isreply='0'";
if($db->count($where)>0)
{
return '<a href="?s=content/content/init/menuid/822/catid/'.$catid.'/isreply/0/h5_hash/'.$_SESSION[h5_hash].'"><font color=red>'.$db->count($where).'</font></a>';
}
}
return $db->count($where);
}
function auth_key_decode()
{
global $INI;
$key_code = pay_decode();
if(!$key_code) die('e');
return $INI['authkey'] = key_decode($key_code);
}
function count_tuangouinfo_nums($formid,$type,$reply)
{
$db = h5_base::load_model('sitemodel_model');
$m_db = h5_base::load_model('sitemodel_field_model');
$formid = intval($formid);
$siteid =  get_siteid();
$r = $db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
$tablename = 'form_'.$r['tablename'];
$m_db->change_table($tablename);
$where = '1=1';
$year = date('Y');
$month =  date('m');
if($type=='3')
{
$where.= " and YEAR(FROM_UNIXTIME(datetime,'%y-%m-%d')) = '$year' and MONTH(FROM_UNIXTIME(datetime,'%y-%m-%d')) = '$month'";
}
else if($type=='2')
{
$where.= " and WEEKOFYEAR(FROM_UNIXTIME(datetime,'%y-%m-%d')) = WEEKOFYEAR(now()) and YEAR(FROM_UNIXTIME(datetime,'%y-%m-%d')) = '$year'";
}
else if($type=='1')
{
$where.= " and DATEDIFF(now() , FROM_UNIXTIME(datetime)) = 1";
}
return $m_db->count($where);
}
function get_domain_key()
{
$key = auth_key_decode();
$a = array();
$a[0] = substr($key,0,2);
$i = 1;
while ( $i <= 5 )
{
$au[$i] = substr($key,($i-1)*32+2,32);
++$i;
}
$au[7] = substr( $key,172,32);
return array($a[0],$au[1].$au[4].$au[5].$au[7]);
}
function getimages($field) {
$pictures = $_POST[$field.'_url'];
$pictures_alt = isset($_POST[$field.'_alt']) ?$_POST[$field.'_alt'] : array();
$array = $temp = array();
if(!empty($pictures)) {
foreach($pictures as $key=>$pic) {
$temp['url'] = $pic;
$temp['alt'] = $pictures_alt[$key];
$array[$key] = $temp;
}
}
$array = array2string($array);
return $array;
}
function getbox_val($modelid,$val,$value)
{
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field==$val)
{
if($v['formtype']=="box")
{
$setting = string2array($v['setting']);
$options = explode("\n",$setting['options']);
foreach($options as $_k) {
$v = explode("|",$_k);
$k = trim($v[1]);
$option[$k] = $v[0];
}
$string = '';
switch($setting['boxtype']) {
case 'radio':
$string = $option[$value];
break;
case 'checkbox':
$value_arr = explode(',',$value);
foreach($value_arr as $_v) {
if($_v) $string .= $option[$_v].' ';
}
break;
case 'select':
$string = $option[$value];
break;
case 'multiple':
$value_arr = explode(',',$value);
foreach($value_arr as $_v) {
if($_v) $string .= $option[$_v].' ';
}
break;
}
return $string;
}
}
}
return 1;
}
function getbox_name($modelid,$val)
{
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field==$val)
{
if($v['formtype']=="box")
{
$setting = string2array($v['setting']);
$options = explode("\n",$setting['options']);
foreach($options as $_k) {
$v = explode("|",$_k);
$k = trim($v[1]);
$option[$k] = $v[0];
}
return $option;
}
}
}
return 1;}
?>