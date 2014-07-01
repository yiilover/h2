<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class vote_option_model extends model {
function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'vote_option';
parent::__construct();
}
function add_options($data,$subjectid,$siteid)
{
if(!is_array($data)) return FALSE;
if(!$subjectid) return FALSE;
foreach($data as $key=>$val)
{
if(trim($val)=='') continue;
$newoption=array(
'subjectid'=>$subjectid,
'siteid'=>$siteid,
'option'=>$val,
'image'=>'',
'listorder'=>0
);
$this->insert($newoption);
}
return TRUE;
}
function update_options($data)
{
if(!is_array($data)) return FALSE;
foreach($data as $key=>$val)
{
if(trim($val)=='') continue;
$newoption=array(
'option'=>$val,
);
$this->update($newoption,array('optionid'=>$key));
}
return TRUE;
}
function set_listorder($data)
{
if(!is_array($data)) return FALSE;
foreach($data as $key=>$val)
{
$val = intval($val);
$key = intval($key);
$this->db->query("update $tbname set listorder='$val' where {$keyid}='$key'");
}
return $this->db->affected_rows();
}
function del_options($subjectid)
{
if(!$subjectid) return FALSE;
$this->delete(array('subjectid'=>$subjectid));
return TRUE;
}
function get_options($subjectid)
{
if(!$subjectid) return FALSE;
return $this->select(array('subjectid'=>$subjectid),'*','',$order = 'optionid ASC');
}
function del_option($optionid)
{
if(!$optionid) return FALSE;
return $this->delete(array('optionid'=>$optionid));
}
}
?>