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
<!--ϸ������ begin -->

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

<!--ҵ������Ⱥ+�������� begin-->		

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
<!--¥�п챨+¥��Ԥ�� begin-->


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
<!--�ȵ�¥��+����¥�� begin-->

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
<!--�ܱ�¥��+ͬ��λ¥�� begin-->

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


<!--���� begin-->

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

<!--¥���б� begin-->

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

<!--��ͼ begin-->

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