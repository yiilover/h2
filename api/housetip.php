<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$id = intval($_GET['floorId']);
$newcode_list = $_POST['newcode_list'];
$keyword = safe_replace(iconv('utf-8','gbk',trim($_GET['keywords'])));
$sql = "status=99 and id=$id";
$result = $db->select($sql,'id,title,type,address,price,thumb,opentime,opentimetips,map,xszt,tel',$limit,$order,'','id');
if($result)
{
$num=0;
$json = array();
foreach($result AS $k=>$v) {
if (isset($keyword) &&!empty($keyword))
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$num++;
if(($v['priceunit']=="0")||empty($v['priceunit']))
{
$priceunit = '元/平方米';
}
else
{
$priceunit = '元/套';
}
if(empty($v['price'])||($v['price']==''))
{
$v['price'] = '待定';
$priceunit = '';
}
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$tablename = $db->table_name;
$table_name = $tablename.'_data';
$where = "where `relation` = '$v[id]'";
$rs = $db->query("SELECT id FROM `$table_name` $where");
$result = $db->fetch_array($rs);
$ids = array();
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql= "`status`=99 and `id` in ($ids)";
if (isset($price) &&!empty($price))
{
$sql.=" and `range` = '$price'";
}
if (isset($huxingshi) &&!empty($huxingshi))
{
$sql.=" and `huxingshi` = '$huxingshi'";
}
if (isset($area_range) &&!empty($area_range))
{
$sql.=" and `area_range` = '$area_range'";
}
if (isset($project) &&!empty($project))
{
$sql.=" and `type` = '$project'";
}
$db->table_name = $tablename;
$key_array = $db->select($sql,'id',$limit,$order,'','id');
$housenums = count($key_array);
}
else
{
continue;
}
if($housenums)
{
$r = array('communityid'=>$v['id'],'opentime'=>$v['opentime'],'communityname'=>$title,'housenums'=>$housenums,'sellprice'=>$v['price'],'bmapx'=>$lngX,'bmapy'=>$latY);
$json[] = JSON($r);
}
}
else 
{
$typename = getbox_val('13','type',$v['type']);
$typename = iconv('GBK','UTF-8',$typename);
$typename = unicode_encode($typename);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$v['id']),'developer');
$developer = getcompany_name($r[developer],12);
$company = iconv('GBK','UTF-8',$developer);
$company = unicode_encode($company);
$db->table_name = $tablename;
if(($v['priceunit']=="0")||empty($v['priceunit']))
{
$priceunit = '元/平方米';
}
else
{
$priceunit = '元/套';
}
if(empty($v['price'])||($v['price']==''))
{
$v['price'] = '待定';
$priceunit = '';
}
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
if(!empty($v['opentimetips']))
{
$openQuotation = $v['opentimetips'];
}
elseif(!empty($v['opentime'])&&$v['opentime']!="0000-00-00")
{
$openQuotation = $v['opentime'];
}
else
{
$openQuotation = '待定';
}
$openQuotation = iconv('GBK','UTF-8',$openQuotation);
$openQuotation = unicode_encode($openQuotation);
$address = iconv('GBK','UTF-8',$v['address']);
$address = unicode_encode($address);
$price = iconv('GBK','UTF-8',$v['price'].$priceunit);
$price = unicode_encode($price);
$phone = iconv('GBK','UTF-8',$v['tel']);
$phone = unicode_encode($phone);
$v['thumb'] = thumb($v['thumb'],400,300,0);
$issuePic = str_replace('/','\/',$v['thumb']);
$r = array('floorId'=>$v['id'],'floor'=>$title,'address'=>$address,'averageprice'=>$price,'floorUse'=>$typename,'companyid'=>$r['developer'],'company'=>$company,'issuePic'=>$issuePic,'aliasname'=>'noAlias','openQuotation'=>$openQuotation,'phone'=>$phone,'sellSchedule'=>$v['xszt']);
$json[] = JSON($r);
}
}
$json_str = implode(',',$json);
echo $json_str;
}
else
{
$json_str ="{\"newHouses\":null}";
echo $json_str;
}
function arrayRecursive(&$array,$function,$apply_to_keys_also = false)
{
foreach ($array as $key =>$value) {
if (is_array($value)) {
arrayRecursive($array[$key],$function,$apply_to_keys_also);
}else {
$array[$key] = $function($value);
}
if ($apply_to_keys_also &&is_string($key)) {
$new_key = $function($key);
if ($new_key != $key) {
$array[$new_key] = $array[$key];
unset($array[$key]);
}
}
}
}
function JSON($array) {
arrayRecursive($array,'urlencode',true);
$json = json_encode($array);
return urldecode($json);
}
function unicode_encode($name)
{
$name = urldecode($name);
$name = iconv('UTF-8','UCS-2',$name);
$len = strlen($name);
$str = '';
for ($i = 0;$i <$len -1;$i = $i +2)
{
$c = $name[$i];
$c2 = $name[$i +1];
if (ord($c) >0)
{
$str .= '\u'.base_convert(ord($c),10,16).str_pad(base_convert(ord($c2),10,16),2,0,STR_PAD_LEFT);
}
else
{
$str .= $c2;
}
}
return $str;
}
?>