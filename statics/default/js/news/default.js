var $ = function(id){
return document.getElementById(id);
}

/*���Ű�黬��(3��ѡ��)*/
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
<!--�ȵ�¥��+���¿��� begin-->
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
<!--����Ҫ��+һ���ȵ�+�¶����� begin-->
<!--ҵ��۵�+�ز���Ƹ begin-->
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