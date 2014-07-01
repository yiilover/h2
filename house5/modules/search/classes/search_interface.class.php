<?php

class search_interface {
public function __construct() {
h5_base::load_app_class('sphinxapi','',0);
$this->cl = new SphinxClient();
$siteid = get_siteid();
$search_setting = getcache('search');
$setting = $search_setting[$siteid];
$mode = SPH_MATCH_EXTENDED2;
$host = $setting['sphinxhost'];
$port = intval($setting['sphinxport']);
$ranker = SPH_RANK_PROXIMITY_BM25;
$this->cl->SetServer($host,$port);
$this->cl->SetConnectTimeout(1);
$this->cl->SetArrayResult(true);
$this->cl->SetMatchMode($mode);
$this->cl->SetRankingMode($ranker);
}
public function search($q,$siteids=array(1),$typeids='',$adddate='',$offset=0,$limit=20,$orderby='@id desc') {
if(CHARSET != 'utf-8') {
$utf8_q = iconv(CHARSET,'utf-8',$q);
}
if($orderby) {
$this->cl->SetSortMode(SPH_SORT_EXTENDED,$orderby);
}
if($limit) {
$this->cl->SetLimits($offset,$limit,($limit>1000) ?$limit : 1000);
}
if($typeids) {
$this->cl->SetFilter('typeid',$typeids);
}
if($siteids) {
$this->cl->SetFilter('siteid',$siteids);
}
if($adddate) {
$this->cl->SetFilterRange('adddate',$adddate[0],$adddate[1],false);
}
$res = $this->cl->Query($utf8_q,'main, delta');
return $res;
}
}?>