function menu(vii)
{if($('#menu_'+vii).css("display")=="none"){$("#titlebg_"+vii).removeClass('tittle_fold');$("#titlebg_"+vii).addClass('tittle');$('#menu_'+vii).css("display",'block');$("#menua_"+vii).show();$("#menub_"+vii).hide();if(get_cookie("menu_c_"+vii)!="1"){set_cookie("menu_c_"+vii,'1',30);}}else{$("#titlebg_"+vii).removeClass('tittle');$("#titlebg_"+vii).addClass('tittle_fold');$("#menua_"+vii).hide();$("#menub_"+vii).show();$('#menu_'+vii).css("display","none");if(get_cookie("menu_c_"+vii)!="2"){set_cookie("menu_c_"+vii,'2',30);}}
vii="";}
function get_menu(n){var min_i=n;for(i=1;i<=min_i;i++){if(get_cookie("menu_c_"+i)=="2"&&get_cookie("menu_c_"+i)!=""){menu(i);}}}