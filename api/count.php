<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$db = $content_db = '';
$db = h5_base::load_model('hits_model');
$content_db = h5_base::load_model('content_model');
if($_GET['modelid'] &&$_GET['id']) {
$model_arr = array();
$model_arr = getcache('model','commons');
$modelid = intval($_GET['modelid']);
$hitsid = 'c-'.$modelid.'-'.intval($_GET['id']);
$r = get_count($modelid,intval($_GET['id']));
if(!$r) exit;
$r['views'] = $r['views'];
extract($r);
hits($hitsid);
if($modelid=='13') 
{
$id = intval($_GET['id']);
$rt = get_tuangoucount($id);
if(!$rt) exit;
extract($rt);
}
echo "\$('#todaydowns').html('$dayviews');";
echo "\$('#weekdowns').html('$weekviews');";
echo "\$('#monthdowns').html('$monthviews');";
}elseif($_GET['module'] &&$_GET['id']) {
$module = $_GET['module'];
if((preg_match('/([^a-z0-9_\-]+)/i',$module))) exit('1');
$hitsid = $module.'-'.intval($_GET['id']);
$r = get_count($hitsid);
if(!$r) exit;
extract($r);
hits($hitsid);
}
function get_count($modelid,$id) {
global $db,$content_db;
$hitsid = 'c-'.$modelid.'-'.$id;
$r = $db->get_one(array('hitsid'=>$hitsid));
if(!$r) return false;
return $r;
}
function hits($hitsid) {
global $db;
$r = $db->get_one(array('hitsid'=>$hitsid));
if(!$r) return false;
$views = $r['views'] +1;
$yesterdayviews = (date('Ymd',$r['updatetime']) == date('Ymd',strtotime('-1 day'))) ?$r['dayviews'] : $r['yesterdayviews'];
$dayviews = (date('Ymd',$r['updatetime']) == date('Ymd',SYS_TIME)) ?($r['dayviews'] +1) : 1;
$weekviews = (date('YW',$r['updatetime']) == date('YW',SYS_TIME)) ?($r['weekviews'] +1) : 1;
$monthviews = (date('Ym',$r['updatetime']) == date('Ym',SYS_TIME)) ?($r['monthviews'] +1) : 1;
$sql = array('views'=>$views,'yesterdayviews'=>$yesterdayviews,'dayviews'=>$dayviews,'weekviews'=>$weekviews,'monthviews'=>$monthviews,'updatetime'=>SYS_TIME);
return $db->update($sql,array('hitsid'=>$hitsid));
}
function get_tuangoucount($id) {
global $content_db;
$db = h5_base::load_model('sitemodel_field_model');
$tablename = 'form_tuangou';
$db->change_table($tablename);
$r = $db->get_one(array('relation'=>$id),"COUNT(dataid) total");
$content_db->set_model(13);
$rs = $content_db->get_one(array('id'=>$id));
if(!$r ||empty($r['total'])) 
{
$r['total']= $rs['initialtuan'];
}
else
{
$r['total']+=$rs['initialtuan'];
}
return $r;
}
;echo '$(\'#hits\').html(\'';echo $views;echo '\');
$(\'#tuang\').html(\'';echo $total;echo '\');
$(\'#tuangou\').html(\'';echo $total;echo '\');';?>