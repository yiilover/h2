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
<!--细化搜索 begin -->

function Search(num){
for(i=0;i<100;i++){
if(document.getElementById('s'+i)){
document.getElementById('s'+i).className='SearchA';
document.getElementById('b'+i).style.display='none';
}
}
document.getElementById('s'+num).className='SearchB';
document.getElementById('b'+num).style.display='block';

}

<!--业主交流群+购房宝典 begin-->		

function Search3(num){
for(i=0;i<100;i++){
if(document.getElementById('g'+i)){
document.getElementById('g'+i).className='searchE';
document.getElementById('h'+i).style.display='none';
}
}
document.getElementById('g'+num).className='searchF';
document.getElementById('h'+num).style.display='block';
}
<!--楼市快报+楼市预告 begin-->


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
<!--热点楼盘+最新楼盘 begin-->

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
<!--周边楼盘+同价位楼盘 begin-->

function Search4(num){
for(i=0;i<100;i++){
if(document.getElementById('i'+i)){
document.getElementById('i'+i).className='SearchC';
document.getElementById('j'+i).style.display='none';
}
}
document.getElementById('i'+num).className='SearchD';
document.getElementById('j'+num).style.display='block';
}


<!--户型 begin-->

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

<!--楼盘列表 begin-->

function Search6(num){
for(i=0;i<100;i++){
if(document.getElementById('m'+i)){
document.getElementById('m'+i).className='SearchI';
document.getElementById('n'+i).style.display='none';
}
}
document.getElementById('m'+num).className='SearchJ';
document.getElementById('n'+num).style.display='block';
}

<!--地图 begin-->

function Search7(num){
for(i=0;i<100;i++){
if(document.getElementById('gg'+i)){
document.getElementById('gg'+i).className='searchK';
document.getElementById('hh'+i).style.display='none';
}
}
document.getElementById('gg'+num).className='searchL';
document.getElementById('hh'+num).style.display='block';
}