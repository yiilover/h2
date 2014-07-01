<?php

class format {
public static function date($timestamp,$showtime = 0) {
$times = intval($timestamp);
if(!$times) return true;
$lang = h5_base::load_config('system','lang');
if($lang == 'zh-cn') {
$str = $showtime ?date('Y-m-d H:i:s',$times) : date('Y-m-d',$times);
}else {
$str = $showtime ?date('m/d/Y H:i:s',$times) : date('m/d/Y',$times);
}
return $str;
}
public static function week($timestamp) {
$times = intval($timestamp);
if(!$times) return true;
$weekarray = array(L('Sunday'),L('Monday'),L('Tuesday'),L('Wednesday'),L('Thursday'),L('Friday'),L('Saturday'));
return $weekarray[date("w",$timestamp)];
}
public static function sgmdate($dateformat,$timestamp='',$format=0)
{
$times = intval($timestamp);
$result = '';
if($format) {
$time = time() -$times;
if($time >12*30*24*3600) {
$result = gmdate($dateformat,$times);
}
elseif($time >30*24*3600) {
$result = intval($time/30/24/3600).'��'.'ǰ';
}
elseif($time >7*24*3600) {
$result = intval($time/7/24/3600).'��'.'ǰ';
}
elseif($time >24*3600) {
$result = intval($time/24/3600).'��'.'ǰ';
}elseif ($time >3600) {
$result = intval($time/3600).'Сʱ'.'ǰ';
}else
{
$result = '1Сʱ��';
}
}else {
$result = gmdate($dateformat,$times +$timeoffset * 3600);
}
return $result;
}
}
?>