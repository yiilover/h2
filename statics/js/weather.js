//ÌìÆøÏÔÊ¾
function loadScript(src){
	var head = document.getElementsByTagName("head")[0];
	var js = document.createElement("script");
	js.setAttribute("src",src);
	head.appendChild(js);
}
function weather_city_callback(_weather_city){
	weather_city = _weather_city;
	get_weather();
}
function get_weather(){
	loadScript("http://news.ifeng.com/weather/js/"+weather_city+".js");
	//loadScript("http://news.ifeng.com/weather/js/sd_wh.js");
}
function weather_callback(_weather_yb){
	document.getElementById("weather").innerHTML = "<span>"+_weather_yb.city+"</span><span><img src='"+_weather_yb.icon1+"' height='15' width='22' style='vertical-align: top;'></span><span>"+_weather_yb.weather1+"</span><span>"+_weather_yb.temperature1+"¡æ¡«"+_weather_yb.temperature2+"¡æ</span>";
}

if(weather_city)weather_city_callback(weather_city);