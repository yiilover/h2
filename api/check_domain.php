<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$data = trim($_POST['data']);
$number = intval($_GET['sid']);
$id = intval($_POST['id']);
if(empty($data))
{
echo 1;
exit();
}
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$where = "`domain`='$data'";
if($id)
{
$where.=" and id<>$id";
}
$is_exists = $db->get_one($where);
if($is_exists) {
echo 1;
exit();
}
else
{
echo 0;
exit();
}
?>