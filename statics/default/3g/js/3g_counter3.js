
function runjs3(obj){
	var q;
	dj3 = parseFloat(obj.dj3.value)
	mj3 = parseFloat(obj.mj3.value)
	fkz3 = dj3 * mj3
	yh = fkz3 * 0.0005
	if (dj3 <= 9432) 
		q = fkz3 * 0.015
	else 
		if (dj3 > 9432) 
			q = fkz3 * 0.03
	if (mj3 <= 120) 
		fw = 500;
	else 
		if (120 < mj3 <= 5000) 
			fw = 1500;
	if (mj3 > 5000) 
		fw = 5000
	gzh = fkz3 * 0.003
	obj.yh.value = Math.round(yh * 100, 5) / 100
	obj.fkz3.value = Math.round(fkz3 * 100, 5) / 100
	obj.qs.value = Math.round(q * 100, 5) / 100
	obj.gzh.value = Math.round(gzh * 100, 5) / 100
	obj.wt.value = Math.round(gzh * 100, 5) / 100
	obj.fw.value = Math.round(fw * 100, 5) / 100
	document.getElementById('calBeforeShow').style.display = 'none';
	document.getElementById('calAfterShow').style.display = 'block';
}
function runjs5(){
	document.getElementById('calBeforeShow').style.display = 'block';
	document.getElementById('calAfterShow').style.display = 'none';
	}