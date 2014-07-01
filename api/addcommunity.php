<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '40';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$address = trim(iconv('UTF-8','GBK',$_POST['address']));
$areaid = intval($_POST['areaid']);
$circleid = intval($_POST['circleid']);
$name = trim(iconv('UTF-8','GBK',$_POST['name']));
if($areaid==0)
{
echo 'error|请选择区域';
die;
}
if(empty($address))
{
echo 'error|请填写小区地址';
die;
}
if($circleid==0)
{
$region = $areaid;
}
else
{
$region = $circleid;
}
h5_base::load_sys_func('iconv');
$pinyin = gbk_to_pinyin($name);
if(is_array($pinyin)) {
$pinyin = implode('',$pinyin);
}
$_POST['info']['status'] = '1';
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = '110';
$_POST['info']['content'] = $name;
$_POST['info']['region'] = $region;
$_POST['info']['address'] = $address;
$_POST['info']['pinyin'] = $pinyin;
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
$_POST['info']['username'] = $username;
$id = $db->add_content($_POST['info']);
if($id)
{
$db->set_model($modelid);
$url = APP_PATH.'index.php?s=content/index/show/catid/110/id/'.$id;
$db->update(array('url'=>$url),"id = $id");
echo 'success|'.$id;
}
else
{
echo 'error|小区数据保存失败';
}
?>