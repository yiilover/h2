var bMapLabelList = [];
function createBmapLabel(i, b, c, h, f, e, n) {
	var d = '<div id="m_'
			+ i
			+ '" class="marker_'
			+ e + (n ? ' marker_hover' : '')
			+ '"><div class="marker_word">'
			+ '<span style="font-weight:bold;">' 
			+ b + '</span>'
			+ '&nbsp;Ì×'
			+ '<span class="marker_name" style="' + (n ? 'display:inline-block' : 'display:none') + '">'
			+ c + '</span>'
			+ '%tip<em class="marker_r"></em></div><em class="marker_b"></em></div>';
	isIE6 = window.ActiveXObject && !window.XMLHttpRequest;
	if (isIE6 != null && isIE6 == true) {
		var j = 0;
		if (b != null && b != "") {
			j = b.length
		}
		var a = 0;		
		if (map.getZoom() >= 16) {
			d = '<div id="m_'
					+ i
					+ '" class="marker_'
					+ e + (n ? ' marker_hover' : '')
					+ '" oLen="'
					+ (j)
					+ '" mLen="'
					+ (j + a)
					+ '" style="width:'
					+ ((j + a) * 12)
					+ 'px;"><div class="marker_word" style="width:100%">'
					+ '<span style="font-weight:bold;">' 
					+ b + '</span>'
					+ '&nbsp;Ì×'
					+ '<span class="marker_name" style="' + (n ? 'display:inline-block' : 'display:none') + '">'
					+ c + '</span>'
					+ '%tip<em class="marker_r"></em></div><em class="marker_b"></em></div>'
		} else {
			d = '<div id="m_'
					+ i
					+ '" class="marker_'
					+ e + (n ? ' marker_hover' : '')
					+ '" oLen="'
					+ (j)
					+ '" mLen="'
					+ (j + a)
					+ '" style="width:'
					+ (j * 12)
					+ 'px;"><div class="marker_word" style="width:100%">'
					+ '<span style="font-weight:bold;">' 
					+ b + '</span>'
					+ '&nbsp;Ì×'
					+ '<span class="marker_name" style="' + (n ? 'display:inline-block' : 'display:none') + '">'
					+ c + '</span>'
					+ '%tip<em class="marker_r"></em></div><em class="marker_b"></em></div>'
		}
	}
	
	d = d.format({
		tip : ""
	})
	var c = new BMap.Label(d, {
		offset : new BMap.Size(-19, -25),
		position : h
	});
	if(n){
		c.setZIndex(bMapLabelList.length + 100);
	}else{
		c.setZIndex(bMapLabelList.length);
	}
	
	c._originalZIndex = bMapLabelList.length;
	c._originalClassName = "marker_" + e;
	c.setStyle({
		border : "none",
		backgroundColor : "transparent"
	});
	c.addEventListener("click", function() {
		openTipFrame(i, f)
	});
	
	c.addEventListener("mouseover", function() {
		if(!$("#m_" + i).hasClass('marker_hover')){
			c.setZIndex(bMapLabelList.length + 100);
			$("#m_" + i).addClass("marker_10");
			$("#m_" + i).find('.marker_name').show();
		}
	});
	c.addEventListener("mouseout", function() {
		if(!$("#m_" + i).hasClass('marker_hover')){
			c.setZIndex(c._originalZIndex);
			$("#m_" + i).removeClass('marker_10');
			$("#m_" + i).find('.marker_name').hide();
		}
	})
	bMapLabelList.push(c);
	map.addOverlay(c)
}
String.prototype.format = function(a) {
	var c = this, b;
	for (b in a) {
		c = c.replace("%" + b, a[b])
	}
	return c
};