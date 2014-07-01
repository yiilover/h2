<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $housename;;echo '-沙盘标点</title>
<link href="';echo CSS_PATH;echo 'dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'dialog.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="';echo CSS_PATH;echo 'jQuery.iPicture.css"/>
<script type="text/javascript" src="';echo JS_PATH;echo 'jquery-1.6.2.min.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'admin_common.js"></script>
<script type="text/javascript" src="';echo JS_PATH;echo 'jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
var houseid = "';echo $relation;;echo '";
var housename = "';echo $housename;;echo '";
</script>
<script type="text/javascript" src="';echo JS_PATH;echo 'jQuery.iPicture.js"></script>
<style type="text/css">
#slideshow {
	position:relative;
}
#slideshow #iPicture {
  margin:0 auto;
  width:1000px;
  /*height:263px;*/
  overflow:auto; /* allow scrollbar */
  position:relative;
}
#slideshow #iPicture .slide {
  margin:0 auto;
  width:540px; /* reduce by 20 pixels of #iPicture to avoid horizontal scroll */
  /*height:263px;*/
}

/** 
 * Slideshow controls style rules.
 */
.control {
  display:block;
  width:74px;
  height:128px;
  text-indent:-10000px;
  position:absolute;
  cursor: pointer;
  z-index:100;
}
#leftControl {
  top:40%;
  left:0;
  background:transparent url(';echo IMG_PATH;echo 'left-gold.png) no-repeat 0 0;
}
#rightControl {
  top:40%;
  right:0;
  background:transparent url(';echo IMG_PATH;echo 'right-gold.png) no-repeat 0 0;
}
#pageContainer {
  margin:0 auto;
  width: 1000px;
}
body{
  background-color: #393737;
  color: #ffffff;
}
.buttonSave{
  color: #ffffff;
  border-bottom: 1px dashed #ffffff;
  border-top: 1px dashed #ffffff;
}
</style>

<script type="text/javascript">
//override animation methods:
/*$.widget("justmybit.iPicture", $.extend({}, $.justmybit.iPicture.prototype, {
  animation: function(){
      //write your custom animation function like this:
       $(".more span").css(\'display\',\'none\');
        //Animation function left to right sliding
        $(".more").hover(function(){  
          $(this).css(\'display\',\'\').find(\'span\').show( \'pulsate\', 400 );  
        }, function () {  
          $(this).find(\'span\').css(\'display\',\'none\');
        });
  }
}));*/
jQuery(document).ready(function(){
';
$priceA = Array();
$date = Array();
foreach ($key_array as $key=>$value)
{
$key++;
list($top,$left) = explode('|',$value[shapan]);
$xszt = getbox_val('29','xszt',$value['xszt']);
$priceA[]= "{\"id\":\"tooltip$key\",\"sid\":\"".$value[id]."\",\"descr\":\"".$value[title].$xszt."\",\"top\":\"".$top."\",\"left\":\"".$left."\"}";
}
$ids = implode(',',$priceA);
;echo '	$( "#iPicture" ).iPicture({
		animation: true,
		animationBg: "bgblack",
		animationType: "ltr-slide",
		pictures: ["picture1"],
		button: "moreblack",
		moreInfos:{"picture1":[';echo $ids;echo ']},
		modify: true,
		initialize: false
	});

  var currentPosition = 0;
  var slideWidth = 1000;
  var slides = $(\'.slide\');
  var numberOfSlides = slides.length;

  // Remove scrollbar in JS
  $(\'#iPicture\').css(\'overflow\', \'hidden\');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll(\'<div id="slideInner"></div>\')
    // Float left to display horizontally, readjust .slides width
	.css({
      \'float\' : \'left\',
      \'width\' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $(\'#slideInner\').css(\'width\', slideWidth * numberOfSlides);

  // Insert controls in the DOM
  $(\'#slideshow\')
    .prepend(\'<span class="control" id="leftControl" title="go to previous picture">Clicking moves left</span>\')
    .append(\'<span class="control" id="rightControl" title="go to next picture">Clicking moves right</span>\');

  // Hide left arrow control on first load
  manageControls(currentPosition);

  // Create event listeners for .controls clicks
  $(\'.control\')
    .bind(\'click\', function(){
    // Determine new position
	currentPosition = ($(this).attr(\'id\')==\'rightControl\') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $(\'#slideInner\').animate({
      \'marginLeft\' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $(\'#leftControl\').hide() } else{ $(\'#leftControl\').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $(\'#rightControl\').hide() } else{ $(\'#rightControl\').show() }
  }
  
});
function save() {
	var result = $("#result").val();
	var houseid = "';echo $relation;;echo '";
	$.ajax({
		type: "POST",
		url: "?s=content/content/public_ajax_shapan/houseid/"+houseid,
		data: "result=" + result,
		success: function(data){
			if(data) {
				alert(\'标注成功\');
			}
		}
	});
}
</script>
</head>
<body>
<div id="pageContainer">
	<h1>沙盘标点</h1>
	<div id="slideshow">
    <div id="iPicture">
    <div class="slide"><div id="picture1" style="background: url(\'';echo $shapan;;echo '\') no-repeat scroll 0 0 #393737; width: 900px; height: ';echo $arr[1];;echo 'px;position: relative; margin:0 auto;"></div></div>
	<div><input type="hidden" id="result"></div>
	</div>	
  </div>
</div>
</body>
</html>
';?>