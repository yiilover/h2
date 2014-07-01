	function setmodel(value, id, siteid, q) {
		$("#typeid").val(value);
		$("#search a").removeClass();
		id.addClass('on');
		if(q!=null && q!='') {
			window.location='?s=search/index/init/siteid/'+siteid+'/typeid/'+value+'/q/'+q;
		}
	}