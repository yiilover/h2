<?php
return array (
  1 => 
  array (
    'urlruleid' => '1',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html',
    'example' => 'news/china/1000.html',
  ),
  6 => 
  array (
    'urlruleid' => '6',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'index.php?s=content/index/lists/catid/{$catid}|index.php?s=content/index/lists/catid/{$catid}/page/{$page}',
    'example' => 'index.php?s=content/index/lists/catid/1/page/1',
  ),
  11 => 
  array (
    'urlruleid' => '11',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html',
    'example' => '2010/catdir_0720/1_2.html',
  ),
  12 => 
  array (
    'urlruleid' => '12',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '1',
    'urlrule' => '{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html',
    'example' => 'it/product/2010/0720/1_2.html',
  ),
  16 => 
  array (
    'urlruleid' => '16',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'index.php?s=content/index/show/catid/{$catid}/id/{$id}|index.php?s=content/index/show/catid/{$catid}/id/{$id}/page/{$page}',
    'example' => 'index.php?s=content/index/show/catid/1/id/1',
  ),
  17 => 
  array (
    'urlruleid' => '17',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'show-{$catid}-{$id}-{$page}.html',
    'example' => 'show-1-2-1.html',
  ),
  18 => 
  array (
    'urlruleid' => '18',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => 'content-{$catid}-{$id}-{$page}.html',
    'example' => 'content-1-2-1.html',
  ),
  30 => 
  array (
    'urlruleid' => '30',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'list{$lst}-g{$page}.html',
    'example' => 'list-g1.html',
  ),
  31 => 
  array (
    'urlruleid' => '31',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'wenfang{$lst}-p{$page}.html',
    'example' => 'wenfang-p1.html',
  ),
  32 => 
  array (
    'urlruleid' => '32',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'list-{$page}.html',
    'example' => 'list-1.html',
  ),
  33 => 
  array (
    'urlruleid' => '33',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$id}',
    'example' => '{$id}',
  ),
  34 => 
  array (
    'urlruleid' => '34',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}company-{$id}.html',
    'example' => 'company-1.html',
  ),
  35 => 
  array (
    'urlruleid' => '35',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$relation}/huxing.html',
    'example' => '1/huxing.html',
  ),
  36 => 
  array (
    'urlruleid' => '36',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$relation}/dongtai.html',
    'example' => '1/dongtai.html',
  ),
  37 => 
  array (
    'urlruleid' => '37',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$relation}/xiangce.html',
    'example' => '1/xiangce.html',
  ),
  38 => 
  array (
    'urlruleid' => '38',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$relation}/jiage.html',
    'example' => '1/jiage.html',
  ),
  40 => 
  array (
    'urlruleid' => '40',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'piclist-{$page}.html',
    'example' => 'piclist-1.html',
  ),
  41 => 
  array (
    'urlruleid' => '41',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$xglp}/wenfang-p1.html',
    'example' => '1/wenfang-p1.html',
  ),
  42 => 
  array (
    'urlruleid' => '42',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'ybjlist{$lst}-p{$page}.html',
    'example' => 'ybjlist.html',
  ),
  43 => 
  array (
    'urlruleid' => '43',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'hxlist{$lst}-p{$page}.html',
    'example' => 'hxlist.html',
  ),
  44 => 
  array (
    'urlruleid' => '44',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}{$relation}/dianping.html',
    'example' => '1/dianping.html',
  ),
  45 => 
  array (
    'urlruleid' => '45',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'xclist{$lst}-p{$page}.html',
    'example' => 'xclist.html',
  ),
  46 => 
  array (
    'urlruleid' => '46',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$house_path}fangyuan/{$id}.html',
    'example' => 'fangyuan/1.html',
  ),
  47 => 
  array (
    'urlruleid' => '47',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$tuan_path}route_{$id}.html',
    'example' => 'route_1.html',
  ),
  48 => 
  array (
    'urlruleid' => '48',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'rent-list{$lst}-g{$page}.html',
    'example' => 'rent-list-g1.html',
  ),
  49 => 
  array (
    'urlruleid' => '49',
    'module' => 'content',
    'file' => 'category',
    'ishtml' => '0',
    'urlrule' => 'xiaoqu-list{$lst}-g{$page}.html',
    'example' => 'xiaoqu-list-g1.html',
  ),
  13 => 
  array (
    'urlruleid' => '13',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$esf_path}show-{$id}.html',
    'example' => 'esf/show-1.html',
  ),
  14 => 
  array (
    'urlruleid' => '14',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$esf_path}rent-show-{$id}.html',
    'example' => 'esf/rent-show-1.html',
  ),
  15 => 
  array (
    'urlruleid' => '15',
    'module' => 'content',
    'file' => 'show',
    'ishtml' => '0',
    'urlrule' => '{$esf_path}xiaoqu-show-{$id}.html',
    'example' => 'esf/xiaoqu-show-1.html',
  ),
);
?>