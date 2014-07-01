// JavaScript Document
//获取dom对象
    function getId(id){return typeof id=="string"?document.getElementById(id):id;}
	function getTag(id,tag){
	  return arguments.length==2?getId(id).getElementsByTagName(tag):document.getElementsByTagName(arguments[0]);
	}