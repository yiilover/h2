$(document).ready(function(){
	 $(".first").children(".house_info").show().end();
	 $(".first").children(".house_name").hide().end();
	 $("li").hover(function(){
		$(this).children(".house_name").hide().end()		
		.siblings().children(".house_name").show();	
	});
	$("li").hover(function(){
		$(this)	.children(".house_info").show().end()			
		.siblings().children(".house_info").hide();				
	});
	
});