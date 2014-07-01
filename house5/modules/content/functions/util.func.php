<?php

function content_pages($num,$curr_page,$pageurls) {
$multipage = '';
$page = 11;
$offset = 4;
$pages = $num;
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
if($curr_page>0) {
$perpage = $curr_page == 1 ?1 : $curr_page-1;
$multipage .= '<a class="a1" href="'.$pageurls[$perpage][0].'">'.L('previous').'</a>';
if($curr_page==1) {
$multipage .= ' <span>1</span>';
}elseif($curr_page>6 &&$more) {
$multipage .= ' <a href="'.$pageurls[1][0].'">1</a>..';
}else {
$multipage .= ' <a href="'.$pageurls[1][0].'">1</a>';
}
}
for($i = $from;$i <= $to;$i++) {
if($i != $curr_page) {
$multipage .= ' <a href="'.$pageurls[$i][0].'">'.$i.'</a>';
}else {
$multipage .= ' <span>'.$i.'</span>';
}
}
if($curr_page<$pages) {
if($curr_page<$pages-5 &&$more) {
$multipage .= ' ..<a href="'.$pageurls[$pages][0].'">'.$pages.'</a> <a class="a1" href="'.$pageurls[$curr_page+1][0].'">'.L('next').'</a>';
}else {
$multipage .= ' <a href="'.$pageurls[$pages][0].'">'.$pages.'</a> <a class="a1" href="'.$pageurls[$curr_page+1][0].'">'.L('next').'</a>';
}
}elseif($curr_page==$pages) {
$multipage .= ' <span>'.$pages.'</span> <a class="a1" href="'.$pageurls[$curr_page][0].'">'.L('next').'</a>';
}
$multipage .= ' <a href="'.showall_page($pageurls[1][0]).'">'.L('showall').'</a>';
return $multipage;
}
function content_pages_mobile($num,$curr_page,$pageurls) {
$multipage = '<ul class="pages">';
$page = 11;
$offset = 4;
$pages = $num;
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
$multipage .= '<li><a class="ablack load" url="'.$pageurls[1].'" class="ablack" href="javascript://">首页</a></li>';
$multipage .= '<li><a class="ablack load" url="'.$pageurls[$curr_page-1].'" class="ablack" href="javascript://">上一页</a></li>';
}
else
{
$multipage .= '<li>首页</li>';
$multipage .= '<li>上一页</li>';
}
if($curr_page>0) {
$perpage = $curr_page == 1 ?1 : $curr_page-1;
$multipage .= '<div class="curpage" ><span class="fora">'.$curr_page.'</span>/'.$pages.'</div>';
}
if($pages>1 &&$curr_page<$pages)
{
$multipage .= '<li><a class="ablack load" url="'.$pageurls[$curr_page+1].'" class="ablack" href="javascript://">下一页</a></li>';
$multipage .= '<li><a class="ablack load" url="'.$pageurls[$pages].'" class="ablack" href="javascript://">尾页</a></li>';
}
else
{
$multipage .= '<li>下一页</li>';
$multipage .= '<li>尾页</li>';
}
$multipage .= '</ul>';
if($pages>1 &&$curr_page<$pages)
{
$multipage .= '<div class="info-btnallcont"> <a class="ablack load" url="'.showall_page_mobile($pageurls[1]).'" href="javascript://">单页阅读</a> </div>';
}
return $multipage;
}
function showall_page($url)
{
if(strpos($url,'.html')!==false)
{
$newurl = str_replace('.html','',$url);
}
return $newurl.'_all.html';
}
function showall_page_mobile($url)
{
if(strpos($url,'-p1.html')!==false)
{
$newurl = str_replace('-p1.html','',$url);
}
return $newurl.'-all.html';
}
?>