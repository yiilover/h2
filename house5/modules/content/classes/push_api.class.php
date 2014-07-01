<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class push_api {
private $db,$pos_data;
public function __construct() {
$this->db = h5_base::load_model('content_model');
}
public function category_list($param = array(),$arr = array()) {
if ($arr['dosubmit']) {
$id = $_POST['id'];
if(empty($id)) return true;
$id_arr = explode('|',$id);
if(count($id_arr)==0) return true;
$old_catid = intval($_POST['catid']);
if(!$old_catid) return true;
$ids = $_POST['ids'];
if(empty($ids)) return true;
$ids = explode('|',$ids);
$siteid = intval($_POST['siteid']);
$siteids = getcache('category_content','commons');
$oldsiteid = $siteids[$old_catid];
$this->categorys = getcache('category_content_'.$oldsiteid,'commons');
$modelid = $this->categorys[$old_catid]['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$this->hits_db = h5_base::load_model('hits_model');
foreach($id_arr as $id) {
$this->db->table_name = $tablename;
$r = $this->db->get_one(array('id'=>$id));
$linkurl = preg_match('/^http:\/\//',$r['url']) ?$r['url'] : siteurl($siteid).$r['url'];
foreach($ids as $catid) {
$siteid = $siteids[$catid];
$this->categorys = getcache('category_content_'.$siteid,'commons');
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
$newid = $this->db->insert(
array('title'=>$r['title'],
'style'=>$r['style'],
'thumb'=>$r['thumb'],
'keywords'=>$r['keywords'],
'description'=>$r['description'],
'status'=>$r['status'],
'catid'=>$catid,
'url'=>$linkurl,
'sysadd'=>1,
'username'=>$r['username'],
'inputtime'=>$r['inputtime'],
'updatetime'=>$r['updatetime'],
'islink'=>1
),true);
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert(array('id'=>$newid));
$hitsid = 'c-'.$modelid.'-'.$newid;
$this->hits_db->insert(array('hitsid'=>$hitsid,'catid'=>$catid,'updatetime'=>SYS_TIME));
}
}
return true;
}else {
$siteid = get_siteid();
$this->categorys = getcache('category_content_'.$siteid,'commons');
$tree = h5_base::load_sys_class('tree');
$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
$categorys = array();
$this->catids_string = array();
if($_SESSION['roleid'] != 1) {
$this->priv_db = h5_base::load_model('category_priv_model');
$priv_result = $this->priv_db->select(array('action'=>'add','roleid'=>$_SESSION['roleid'],'siteid'=>$siteid,'is_admin'=>1));
$priv_catids = array();
foreach($priv_result as $_v) {
$priv_catids[] = $_v['catid'];
}
if(empty($priv_catids)) return '';
}
foreach($this->categorys as $r) {
if($r['siteid']!=$siteid ||$r['type']!=0) continue;
if($_SESSION['roleid'] != 1 &&!in_array($r['catid'],$priv_catids)) {
$arrchildid = explode(',',$r['arrchildid']);
$array_intersect = array_intersect($priv_catids,$arrchildid);
if(empty($array_intersect)) continue;
}
if($r['child']) {
$r['checkbox'] = '';
$r['style'] = 'color:#8A8A8A;';
}else {
$checked = '';
if($typeid &&$r['usable_type']) {
$usable_type = explode(',',$r['usable_type']);
if(in_array($typeid,$usable_type)) {
$checked = 'checked';
$this->catids_string[] = $r['catid'];
}
}
$r['checkbox'] = "<input type='checkbox' name='ids[]' value='{$r[catid]}' {$checked}>";
$r['style'] = '';
}
$categorys[$r['catid']] = $r;
}
$str  = "<tr>
						<td align='center'>\$checkbox</td>
						<td style='\$style'>\$spacer\$catname</td>
					</tr>";
$tree->init($categorys);
$categorys = $tree->get_tree(0,$str);
return $categorys;
}
}
public function push_to_veryhome_news($param = array(),$arr = array()) {
if ($arr['dosubmit']) {
$id = $_POST['id'];
if(empty($id)) return true;
$id_arr = explode('|',$id);
if(count($id_arr)==0) return true;
$old_catid = intval($_POST['catid']);
if(!$old_catid) return true;
$ids = $_POST['ids'];
$flags = $_POST['flags'];
$sortup = $_POST['sortup'];
$flags = isset($flags) ?join(',',$flags) : '';
if(empty($ids)) return true;
$siteid = intval($_POST['siteid']);
$siteids = getcache('category_content','commons');
$oldsiteid = $siteids[$old_catid];
$this->categorys = getcache('category_content_'.$oldsiteid,'commons');
$modelid = $this->categorys[$old_catid]['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
foreach($id_arr as $id) {
$this->db->table_name = $tablename;
$r = $this->db->get_one(array('id'=>$id));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$r = $r2 ?array_merge($r,$r2) : $r;
if($r[copyfrom] &&strpos($r[copyfrom],'|')!==false) {
$arr = explode('|',$r[copyfrom]);
$r[copyfrom] = $arr[0];
}
if(isset($_POST['title'])&&!empty($_POST['title']))
{
$r[title] = $_POST['title'];
}
$r[content] = str_replace('[page]','#p#副标题#e#',$r[content]);
$r[content] = str_replace('&ldquo;','“',$r[content]);
$r[content] = str_replace('&rdquo;','”',$r[content]);
$r[content] = str_replace('&lsquo;','‘',$r[content]);
$r[content] = str_replace('&rsquo;','’',$r[content]);
$r[content] = str_replace('&middot;','·',$r[content]);
$r[content] = str_replace('&nbsp;',' ',$r[content]);
$r[content] = str_replace('&mdash;','—',$r[content]);
$r[content] = str_replace('&hellip;','…',$r[content]);
$r[content] = str_replace('&ge;','≥',$r[content]);
$r[content] = str_replace('&le;','≤',$r[content]);
$r[content] = str_replace('&permil;','‰',$r[content]);
$r[content] = str_replace('&deg;','°',$r[content]);
$r[content] = $r[content].'<p>》》》<a title="更多热点新闻" target="_blank" href="http://www.veryhome.com/today/"><span style="color: #ff0000">点击查看更多每日新闻</span></a></p>
<p>》》》<a title="更多楼盘动态" target="_blank" href="http://www.veryhome.com/news/loupandongtai/"><span style="color: #ff0000">点击查看更多楼盘动态</span></a></p>';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://www.veryhome.com/veryhome/article_add_vs.php");
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"dopost=save&channelid=1&typeid=".$ids."&title=".$r[title]."&writer=".$r[username]."&pubdate=".$r[inputtime]."&source=".$r[copyfrom]."&description=".$r[description]."&pwd=sdkerun0631&flag=".$flags."&sortup=".$sortup."&keywords=".$r[keywords]."&picname=".$r[thumb]."&ddisremote=1&body=".$r[content]);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_jar);
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
$str = curl_exec($ch);
curl_close($ch);
}
return true;
}
}
public function push_to_veryhome_house($param = array(),$arr = array()) {
if ($arr['dosubmit']) {
$id = $_POST['id'];
if(empty($id)) return true;
$id_arr = explode('|',$id);
if(count($id_arr)==0) return true;
$old_catid = intval($_POST['catid']);
if(!$old_catid) return true;
$ids = $_POST['ids'];
$dede_addonfields = $_POST['dede_addonfields'];
if(empty($ids)) return true;
$siteid = intval($_POST['siteid']);
$siteids = getcache('category_content','commons');
$oldsiteid = $siteids[$old_catid];
$this->categorys = getcache('category_content_'.$oldsiteid,'commons');
$modelid = $this->categorys[$old_catid]['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
foreach($id_arr as $id) {
$this->db->table_name = $tablename;
$r = $this->db->get_one(array('id'=>$id));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$r = $r2 ?array_merge($r,$r2) : $r;
$r[content] = strip_tags($r[content]);
$r[content] = str_replace('&ldquo;','“',$r[content]);
$r[content] = str_replace('&rdquo;','”',$r[content]);
$r[content] = str_replace('&lsquo;','‘',$r[content]);
$r[content] = str_replace('&rsquo;','’',$r[content]);
$r[content] = str_replace('&middot;','·',$r[content]);
$r[content] = str_replace('&nbsp;',' ',$r[content]);
$r[content] = str_replace('&mdash;','—',$r[content]);
$leixing = get_typename($r[type]);
if($leixing=='住宅')
{
$leixing='普通式住宅';
}
if($r[fix]=='1')
{
$fix = '毛坯';
}
elseif($r[fix]=='2')
{
$fix = '简装修';
}
elseif($r[fix]=='3')
{
$fix = '精装修';
}
$xiaoshouzhuangtai = get_ztname($r[xszt]);
if($xiaoshouzhuangtai == '即将上市')
{
$xiaoshouzhuangtai = '未开盘';
}
if($r[priceunit]=='2')
{
$r[price] = $r[price].'万';
}
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://www.veryhome.com/veryhome/archives_add_vs.php");
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"dopost=save&channelid=17&typeid=".$ids."&title=".$r[title]."&writer=".$r[username]."&pubdate=".$r[inputtime]."&source=".$r[copyfrom]."&description=".$r[description]."&pwd=sdkerun0631&dede_addonfields=".$dede_addonfields."&kaifashang=".getcompany_name($r[developer],12)."&wuyegongsi=".getcompany_name($r[property],12)."&housetel=".$r[tel]."&keywords=".$r[keywords]."&zuixinjiage=".$r[price]."&jiaotong=".$r[jiaotong]."&nianxian=".$r[fcznx]."&rongjilv=".$r[far]."&zhuangxiu=".$fix."&leixing=".$leixing."&xiaoshouzhuangtai=".$xiaoshouzhuangtai."&zhoubianpeitao=".$r[zbpt]."&shangquan=".menu_lastinfo('3360',$r[region])."&dizhi=".$r[address]."&kaipanriqi=".$r[opentime]."&xiangmujianjie=".$r[content]);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_jar);
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
$str = curl_exec($ch);
curl_close($ch);
}
return true;
}
}
}
?>