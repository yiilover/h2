window.onscroll=function(){var nav_box=document.getElementById('index_nav_box');
var nav=document.getElementById('index_nav');
var thetop=document.documentElement.scrollTop+document.body.scrollTop;var to_top=getTop(nav_box);
if(thetop>=to_top)
{
if(nav.className=='fixed_top')
return false;nav.className='fixed_top';
}
else
{
if(nav.className=='')
return false;nav.className='';
}
}
window.onload=function()
{
var url=location.href.split('='),id='',span_position='',objs=document.getElementsByName('price_region'),nav=document.getElementById('index_nav'),yHeight=$('index_nav').getHeight(),x=0,y=0
;
if(!!url[1]){id='r_'+url[1];
span_position=document.getElementById(id);
if(!!span_position)
{
goTo();
}
}
for(var i=0,l=objs.length;i<l;i++){objs[i].onclick=function(){yHeight=$('index_nav').getHeight();
id=this.getAttribute('rel');
span_position=document.getElementById(id);goTo();
}
}
function goTo(){if(nav.className=='fixed_top'){y=getTop(span_position);
}
else
{
y=getTop(span_position)-yHeight-15
}

y-=yHeight;window.scrollTo(x,y);
}

}
function getTop(el){var offset=el.offsetTop;if(el.offsetParent!=null){offset+=getTop(el.offsetParent);
}
return offset;
}