var $ = function(id){
return document.getElementById(id);
}

/*热门板块滑动(3项选择)*/
function show_menua(num){
for(i = 1; i < 4; i ++){
if($('bjrmbkli0' + i)){
$('bjrmbkli0' + i).style.display = 'none';
$('bjrmbk0' + i).className = 'huadongbjrmbk03';
}
}
$('bjrmbkli0' + num).style.display = 'block';
$('bjrmbk0' + num).className = 'huadongbjrmbk02';
}
<!--热点楼盘+最新开盘 begin-->
function Search2(num){
for(i=0;i<100;i++){
if(document.getElementById('e'+i)){
document.getElementById('e'+i).className='SearchC';
document.getElementById('f'+i).style.display='none';
}
}
document.getElementById('e'+num).className='SearchD';
document.getElementById('f'+num).style.display='block';
}
<!--今日要闻+一周热点+月度排行 begin-->
<!--业界观点+地产招聘 begin-->
function Search1(num){
for(i=0;i<100;i++){
if(document.getElementById('c'+i)){
document.getElementById('c'+i).className='SearchC';
document.getElementById('d'+i).style.display='none';
}
}
document.getElementById('c'+num).className='SearchD';
document.getElementById('d'+num).style.display='block';
}
function Search5(num){
for(i=0;i<100;i++){
if(document.getElementById('k'+i)){
document.getElementById('k'+i).className='SearchG';
document.getElementById('l'+i).style.display='none';
}
}
document.getElementById('k'+num).className='SearchH';
document.getElementById('l'+num).style.display='block';
}