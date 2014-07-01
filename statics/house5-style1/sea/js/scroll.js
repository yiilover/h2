var ph=(document.body.offsetHeight -70)+"px";
var pw=(document.documentElement.offsetWidth -70)+"px";
var position = function(){
var isIE6 = !-[1,] && !window.XMLHttpRequest,
html = document.getElementsByTagName('html')[0],
dd = document.documentElement,
db = document.body,
dom = dd || db,
// 获取滚动条位置
getScroll = function(win){
return {
right: Math.max(dd.scrollright, db.scrollright),
top: Math.max(dd.scrollTop, db.scrollTop)
};
};
if (isIE6 && document.body.currentStyle.backgroundAttachment !== 'fixed') {
html.style.backgroundImage = 'url(about:blank)';
html.style.backgroundAttachment = 'fixed';
};
return {
fixed: isIE6 ? function(elem){
var style = elem.style,
doc = getScroll(),
dom = '(document.documentElement || document.body)',
right = parseInt(style.right) - doc.right,
top = parseInt(style.top) - doc.top;
this.absolute(elem);
style.setExpression('right', 'eval(' + dom + '.scrollright + ' + right + ') + "px"');
style.setExpression('top', 'eval(' + dom + '.scrollTop + ' + top + ') + "px"');
} : function(elem){
elem.style.position = 'fixed';
},
absolute: isIE6 ? function(elem){
var style = elem.style;
style.position = 'absolute';
style.removeExpression('right');
style.removeExpression('top');
} : function(elem){
elem.style.position = 'absolute';
}
};
}();
//获取浏览器高度
function func()
{
var elem = document.getElementById('fixed');
var btop = document.documentElement.clientHeight - 345;
elem.style.right = '0px';
elem.style.top = btop+'px';
position.fixed(elem);
}
func()
window.onresize=func;