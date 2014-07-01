/**
*  Ajax Autocomplete for jQuery, version 1.1.3
*  (c) 2010 Tomas Kirda
*
*  Ajax Autocomplete for jQuery is freely distributable under the terms of an MIT-style license.
*  For details, see the web site: http://www.devbridge.com/projects/autocomplete/jquery/
*
*  Last Review: 04/19/2010
*/

/*jslint onevar: true, evil: true, nomen: true, eqeqeq: true, bitwise: true, regexp: true, newcap: true, immed: true */
/*global window: true, document: true, clearInterval: true, setInterval: true, jQuery: true */
/*newCr: true(新建小区), backval: Array(需要返回的参数), mainid(返回ID)*/

(function($) {

  function Autocomplete(el, options) {
    this.el = $(el);
    this.el.attr('autocomplete', 'off');
	this.mainids = [];
    this.suggestions = [];
    this.badQueries = [];
    this.selectedIndex = -1;
    this.currentValue = this.el.val();
    this.intervalId = 0;
    this.cachedResponse = [];
    this.onChangeInterval = null;
    this.ignoreValueChange = false;
    this.serviceUrl = options.serviceUrl;
    this.isLocal = false;
    this.options = {
      autoSubmit: false,
      minChars: 1,
      maxHeight: 500,
      deferRequestBy: 0,
      width: 0,
	  urlCr: '',
      params: {},
	  mainid: 'vid',
	  backval: {},
	  newCr: false,
      delimiter: null,
      zIndex: 9999,
      dataType: 'text'
    };
    this.initialize();
    this.setOptions(options);
  }
  
  $.fn.autocomplete = function(options) {
    return new Autocomplete(this.get(0)||$('<input />'), options);
  };


  Autocomplete.prototype = {

    killerFn: null,

    initialize: function() {

      var me, uid, autocompleteElId;
      me = this;
      uid = Math.floor(Math.random()*0x100000).toString(16);
      autocompleteElId = 'Autocomplete_' + uid;

      this.killerFn = function(e) {
        if ($(e.target).parents('.autocomplete').size() === 0) {
          me.killSuggestions();
          me.disableKillerFn();
        }
      };

      if (!this.options.width) { this.options.width = this.el.width(); }
      this.mainContainerId = 'AutocompleteContainter_' + uid;

      $('<div id="' + this.mainContainerId + '" style="position:absolute;z-index:9999;"><iframe id="autocomplete-iframe-' + this.mainContainerId + '" frameborder="0" scrolling="no" style="height:0px;position:absolute;z-index:10px;width:400px;left:0px;"></iframe><div class="autocomplete-w1"><div class="autocomplete" id="' + autocompleteElId + '" style="display:none; width:300px;"></div></div></div>').appendTo('body');

      this.container = $('#' + autocompleteElId);
      this.fixPosition();
      if (window.opera) {
        this.el.keypress(function(e) { me.onKeyPress(e); });
      } else {
        this.el.keydown(function(e) { me.onKeyPress(e); });
      }
      this.el.keyup(function(e) { me.onKeyUp(e); });
      this.el.blur(function() { me.enableKillerFn(); });
      this.el.focus(function() { me.fixPosition(); });
    },
    
    setOptions: function(options){
      var o = this.options;
      $.extend(o, options);
      if(o.lookup){
        this.isLocal = true;
        if($.isArray(o.lookup)){ o.lookup = { suggestions:o.lookup, data:[] }; }
      }
      $('#'+this.mainContainerId).css({ zIndex:o.zIndex });
      this.container.css({ maxHeight: o.maxHeight + 'px', width:o.width + 'px' });
    },
    
    clearCache: function(){
      this.cachedResponse = [];
      this.badQueries = [];
    },
    
    disable: function(){
      this.disabled = true;
    },
    
    enable: function(){
      this.disabled = false;
    },

    fixPosition: function() {
      var offset = this.el.offset();
      $('#' + this.mainContainerId).css({ top: (offset.top + this.el.innerHeight()) + 'px', left: offset.left + 'px' });
    },

    enableKillerFn: function() {
      var me = this;
      $(document).bind('click', me.killerFn);
    },

    disableKillerFn: function() {
      var me = this;
      $(document).unbind('click', me.killerFn);
    },

    killSuggestions: function() {
      var me = this;
      this.stopKillSuggestions();
      this.intervalId = window.setInterval(function() { me.hide(); me.stopKillSuggestions(); }, 300);
    },

    stopKillSuggestions: function() {
      window.clearInterval(this.intervalId);
    },

    onKeyPress: function(e) {
      if (this.disabled || !this.enabled) { return; }
      // return will exit the function
      // and event will not be prevented
      switch (e.keyCode) {
        case 27: //KEY_ESC:
          this.el.val(this.currentValue);
          this.hide();
          break;
        case 9: //KEY_TAB:
        case 13: //KEY_RETURN:
          if (this.selectedIndex === -1) {
            this.hide();
            return;
          }
          this.select(this.selectedIndex);
          if(e.keyCode === 9){ return; }
          break;
        case 38: //KEY_UP:
          this.moveUp();
          break;
        case 40: //KEY_DOWN:
          this.moveDown();
          break;
        default:
          return;
      }
      e.stopImmediatePropagation();
      e.preventDefault();
    },

    onKeyUp: function(e) {
      if(this.disabled){ return; }
      switch (e.keyCode) {
        case 38: //KEY_UP:
        case 40: //KEY_DOWN:
          return;
      }
      clearInterval(this.onChangeInterval);
      if (this.currentValue !== this.el.val()) {
        if (this.options.deferRequestBy > 0) {
          // Defer lookup in case when value changes very quickly:
          var me = this;
          this.onChangeInterval = setInterval(function() { me.onValueChange(); }, this.options.deferRequestBy);
        } else {
          this.onValueChange();
        }
      }
    },

    onValueChange: function() {
      clearInterval(this.onChangeInterval);
      this.currentValue = this.el.val();
      var q = this.getQuery(this.currentValue);
      this.selectedIndex = -1;
      if (this.ignoreValueChange) {
        this.ignoreValueChange = false;
        return;
      }
      if (q === '' || q.length < this.options.minChars) {
        this.hide();
      } else {
        this.getSuggestions(q);
      }
    },

    getQuery: function(val) {
      var d, arr;
      d = this.options.delimiter;
      if (!d) { return $.trim(val); }
      arr = val.split(d);
      return $.trim(arr[arr.length - 1]);
    },

    getSuggestionsLocal: function(q) {
      var ret, arr, len, val, i;
      arr = this.options.lookup;
      len = arr.suggestions.length;
      ret = { suggestions:[], data:[] };
      q = q.toLowerCase();
      for(i=0; i< len; i++){
        val = arr.suggestions[i];
        if(val.toLowerCase().indexOf(q) === 0){
          ret.suggestions.push(val);
          ret.data.push(arr.data[i]);
        }
      }
      return ret;
    },
    
    getSuggestions: function(q) {
      var cr, me, bn;
	  me = this;
      cr = me.isLocal ? me.getSuggestionsLocal(q) : me.cachedResponse[q];
      if (cr && $.isArray(cr.suggestions)) {
        this.suggestions = cr.suggestions;
        this.mainids = cr.mainids;
		///////////////////////

		var t = me.options.backval;
		if(typeof(t) == 'object'){
				$.each(t,function(k,v) { 
					var h = eval("cr." + k);
					t[k] = h;
				});
		}
		///////////////////////
        this.suggest();
      } else if (!this.isBadQuery(q)) {
        me.options.params.query = q;
        $.ajax({
        	type:'get',
        	url:this.serviceUrl,
        	data:me.options.params,
        	dataType:me.options.dataType,
        	success:function(txt) {
        		me.processResponse(txt); 
    		}
        });
      }
    },

    isBadQuery: function(q) {
      var i = this.badQueries.length;
      while (i--) {
        if (q.indexOf(this.badQueries[i]) === 0) { return true; }
      }
      return false;
    },

    hide: function() {
      this.enabled = false;
      this.selectedIndex = -1;
      this.container.hide();
	  $("#autocomplete-iframe-"+this.mainContainerId).css({ height:0+'px', width:0+'px'});
	  $("#autocomplete-iframe-"+this.mainContainerId).hide();
    },

    suggest: function() {
      

      var me, len, div, f, v, i, s, n, mOver, mClick;
      me = this;
      len = this.suggestions.length;
	  
	  if (len === 0) {
		  if(this.options.newCr){
			div = '<div style="height:35px;line-height:35px;">暂无该小区内容，点此<a onclick="show_form();" href="#"><font color="#FF0000">添加新小区</font></a>。</div>';
			  this.container.html(div);
			  $("#autocomplete-iframe-"+this.mainContainerId).show();
			  this.container.show();
			  $("#autocomplete-iframe-"+this.mainContainerId).css({ height:this.container.height() + 'px', width:this.container.width() + 'px'});
			  $('#'+me.options.mainid).val('');
			   return;
		  }else{
			  this.hide();
			  return;
		  }
	  }
		  v = this.getQuery(this.currentValue);
		  mOver = function(xi) { return function() { me.activate(xi); }; };
		  mClick = function(xi) { return function() { me.select(xi); }; };
		  this.container.hide().empty();
		  for (i = 0; i < len; i++) {
			s = this.suggestions[i];
			n = s.replace(/<span>.*<\/span>/gi, '');
			div = $((me.selectedIndex === i ? '<div class="selected"' : '<div') + ' title="' + n + '">' + s + '</div>');
			div.mouseover(mOver(i));
			div.click(mClick(i));
			this.container.append(div);
		  }
		  this.enabled = true;
		  $("#autocomplete-iframe-"+this.mainContainerId).show();
		  this.container.show();
		  $("#autocomplete-iframe-"+this.mainContainerId).css({ height:this.container.height() + 'px', width:this.container.width() + 'px'});
	 	  $('#'+me.options.mainid).val('');
    },

    processResponse: function(text) {
      var response;
      try {
    	  if(typeof(text) === 'object' && this.options.dataType == 'jsonp'){
    		  response = text;
    	  }else{
    		  response = eval('(' + text + ')');
    	  }		  
      } catch (err) {alert(err);return; }
      if (!$.isArray(response.data)) { response.data = []; }
      if(!this.options.noCache){
        this.cachedResponse[response.query] = response;
        if (response.suggestions.length === 0) { this.badQueries.push(response.query); }
      }
      if (response.query === this.getQuery(this.currentValue)) {
        this.suggestions = response.suggestions;
        this.mainids = response.mainids;
		var t = this.options.backval;
		if((typeof(t) == 'object')){
			$.each(t,function(k,v) { 
				var h = eval("response." + k);
				t[k] = h;
         });
		}
        this.suggest(); 
      }
    },

    activate: function(index) {
      var divs, activeItem;
      divs = this.container.children();
      // Clear previous selection:
      if (this.selectedIndex !== -1 && divs.length > this.selectedIndex) {
        $(divs.get(this.selectedIndex)).removeClass();
      }
      this.selectedIndex = index;
      if (this.selectedIndex !== -1 && divs.length > this.selectedIndex) {
        activeItem = divs.get(this.selectedIndex);
        $(activeItem).addClass('selected');
      }
      return activeItem;
    },

    deactivate: function(div, index) {
      div.className = '';
      if (this.selectedIndex === index) { this.selectedIndex = -1; }
    },

    select: function(i) {
      var selectedValue, f, me;
	  me = this;
      selectedValue = this.suggestions[i];
	  var n = selectedValue.replace(/<span>.*<\/span>/gi, '');
      if (selectedValue) {
		this.el.val(n);
		/////////
		d = me.mainids[i];
		$('#'+me.options.mainid).val(d);
		//////////////////
        if (this.options.autoSubmit) {
          f = this.el.parents('form');
          if (f.length > 0) { f.get(0).submit(); }
        }
        this.ignoreValueChange = true;
        this.hide();
        this.onSelect(i);
		$("#autocomplete-iframe-"+this.mainContainerId).css({ height:0+'px', width:0+'px'});
	    $("#autocomplete-iframe-"+this.mainContainerId).hide();
      }
    },

    moveUp: function() {
      if (this.selectedIndex === -1) { return; }
      if (this.selectedIndex === 0) {
        this.container.children().get(0).className = '';
        this.selectedIndex = -1;
        this.el.val(this.currentValue.replace(/<span>.*<\/span>/gi, ''));
        return;
      }
      this.adjustScroll(this.selectedIndex - 1);
    },

    moveDown: function() {
      if (this.selectedIndex === (this.suggestions.length - 1)) { return; }
      this.adjustScroll(this.selectedIndex + 1);
    },

    adjustScroll: function(i) {
      var activeItem, offsetTop, upperBound, lowerBound;
      activeItem = this.activate(i);
      offsetTop = activeItem.offsetTop;
      upperBound = this.container.scrollTop();
      lowerBound = upperBound + this.options.maxHeight - 25;
      if (offsetTop < upperBound) {
        this.container.scrollTop(offsetTop);
      } else if (offsetTop > lowerBound) {
        this.container.scrollTop(offsetTop - this.options.maxHeight + 25);
      }
      this.el.val(this.getValue(this.suggestions[i].replace(/<span>.*<\/span>/gi, '')));
    },

    onSelect: function(i) {
      var me, fn, s, d;
      me = this;
      fn = me.options.onSelect;
      s = me.suggestions[i].replace(/<span>.*<\/span>/gi, '');
      d = me.mainids[i];
      me.el.val(me.getValue(s));
	  $('#'+me.options.mainid).val(d);
		////////////////////
		var t = this.options.backval;
		if((typeof(t) == 'object')){
			$.each(t,function(k,v) { 
				
					///--------------------------------------
					if(v[i]){
						if(k == 'circleid'){
							get_hot_circle($('#areaid').val(), v[i]);
						}else{
							$('#' + k).val(v[i]);
						}
					}

					///----------------------------------
         });
		}
		///////////////////
      if ($.isFunction(fn)) { fn(s, d, me.el); }
    },
    
    getValue: function(value){
        var del, currVal, arr, me;
        me = this;
        del = me.options.delimiter;
        if (!del) { return value; }
        currVal = me.currentValue;
        arr = currVal.split(del);
        if (arr.length === 1) { return value; }
        return currVal.substr(0, currVal.length - arr[arr.length - 1].length) + value;
    }

  };

}(jQuery));
