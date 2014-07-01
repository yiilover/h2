/*
 * jQuery UI iPicture 1.0.0
 *
 * Copyright 2011 D'Alia Sara
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.ui.position.js
 *	jquery.ui.draggable.js
 *	jquery.ui.droppable.js
 *  jquery.ui.effects.core.js
 */
 
 (function( $ ) {

  $.widget( "justmybit.iPicture", {
	options: {
		animation:false,
		animationBg: "bgblack",
		animationType:"ltr-slide",
		button: "moreblack",
		button1: "moreblack1",
		modify:false,
		initialize: false,
		moreInfos: {},
		pictures: []     
	},

	// Set up the widget
	_create: function() {
		var self = this;
		if(self.options.initialize){
			this.initialization();
		}else{
		
		//each picture
		$.each(self.options.pictures, function( index, value ) {
			var picture = $( '#'+value );
			var info = (self.options.moreInfos[value]);
			if(info!=undefined){
				// each more infos on that picture
				$.each(info, function( index, value ){
					var div = $('<div id="'+value.id+'" class="more more32"></div>' )
						.css('top',value.top).css('left',value.left).appendTo(picture);
					var imgButton;
					if(self.options.modify){
					  imgButton = $('<div class="imgButtonDrag1 '+self.options.button1+'" title="drag in the picture"></div>').appendTo(div);
					  var divInput = $('<div class="inputDiv"></div>').insertAfter(imgButton);
					  var input = $('<input type="hidden" id="hd'+value.id+'" value="'+value.sid+'"/><input type="text" id="zt'+value.id+'" readonly title="选择楼号" onclick="omnipotent(\'selectid\',\'?s=content/content/public_relationldlist/houseid/'+houseid+'/housename/'+housename+'/modelid/29/mid/'+value.id+'\',\'添加楼栋\',1)" value="'+value.descr+'" />').appendTo(divInput);
					  $('<p class="pDelete" title="删除标点"></p>').insertAfter(input).bind('click', function() {
					    $(div).remove();
					  });
					}else{
					  imgButton = $('<div class="imgButton '+self.options.button+'"></div>').appendTo(div);
					  $('<span class="descr">'+value.descr+'</span>').appendTo(div);
					}
					// href populating
					if(value.href){
						$('#'+value.id+' a').attr('href',value.href);
					}
					    
					//modify option management
					if(self.options.modify){
						var descr;
						$('#'+value.id).draggable({
						  //containment: picture,
						});
					}
				});
			}
		});
		//move option management
		if(self.options.modify){
		  
	    //add selected animationBg if animation set true
	    if(self.options.animation){
	      $(".more").addClass(self.options.animationBg);
	    }else{
	      $(".more").addClass('noAnimation');
	    }
	    //workaround for firefox issue on trimming border-radius content
		  $(".more32").css('overflow','visible');
			this.initialization();
			return;
		}
		//set animation
		if (self.options.animation) {
			this.animation();
		}
		}
	},

//animation for tooltips
	animation: function() {
		var self = this;
		switch( self.options.animationType ) {
			case "ltr-slide":
			$(".more").addClass('ltr-slide '+self.options.animationBg);
			//Animation function left to right sliding
			$(".more").hover(function(){  
				$(this).stop().animate({width: '225px'}, 200).css({'z-index' : '10'});  
			}, function () {  
				$(this).stop().animate({width: '32px' }, 200).css({'z-index' : '1'});  
			});
			break;
		}
	},
	
	initialization: function(){
		var self = this;
		
		$.each(self.options.pictures, function( index, value ) {
			var picture = $( '#'+value );

			// list of buttons to change tooltip color
			var listContainer = $('<div class="listContainer"><ul><li class="'+value+'-button '+self.options.button+'" title="drag in the picture"></li></ul></div>').appendTo('#'+value);
		
		// list of backgrounds to change tooltip background
		if (self.options.animation) {
		  $('.listContainer').addClass(self.options.animationBg);
			var bgDropp = $('<div class="bgDropp"></div>').insertAfter(listContainer);
			$('<ul class="inline bg">'
				+'<li id="bgblack" class="bgblack noborder"></li>'
			  +'<li id="bgwhite" class="bgwhite noborder"></li>'
			  +'</ul>').appendTo(bgDropp);
			chooseBg = $('ul.bg').find('li');
			$.each(chooseBg, function( index, bg ){
				$(bg).bind('click', function(){
				  $('.listContainer').removeClass(self.options.animationBg);
				  $('.listContainer').addClass(bg.id);
					$(bgDropp).css('display','none');
					more = self.element.find('.more');
				  $.each(more, function( index, value ){
					  $(value).removeClass(self.options.animationBg);
					  $(value).addClass(bg.id);
				  });
					self.options.animationBg=bg.id;
				  
					clickCounter2=0;
					return false;
				});
				$(bg).bind('mouseover', function(){
					$(bg).css('border','1px solid red');
					$(bg).css('z-index','10');
				});
				$(bg).bind('mouseout', function(){
				  $(bg).css('border','0');
					$(bg).css('z-index','1');
				});
			});
			var clickCounter2=0;
			$('#'+value +' .bgList').bind('click', function(){
			  if(clickCounter2==0){
			   $(bgDropp).css('display','block');
			   clickCounter2=1;
			  }else if(clickCounter2==1){
			    $(bgDropp).css('display','none');
			    clickCounter2=0;
			  }
			  return false;
			});
		} else{
		  $('#'+value +' .bgList').bind('click', function(){
			  alert('animation is off, set animation:true');
			});
		}
			
			//Create a new tooltip
			$('.'+value+'-button').draggable({
				helper:'clone',
				//containment: picture,
				stop: function(event, ui){
					$('<p class="top">'+ui.position.top+'</p><p class="left">'+ui.position.left+'</p>').appendTo(this);
				}
			});
			var plus=0;
			$('#'+value).droppable({
				accept: '.'+value+'-button',
				drop: function( event, ui ) {
					plus++;
					var div = $('<div id="'+value+'-more'+plus+'" class="'+value+' more more32"></div>' )
						.css('top',ui.position.top+"px").css('left',ui.position.left+"px").draggable(
						//{containment: picture}
						).appendTo(picture);
					//add selected animationBg if animation set true
		      if(self.options.animation){
		        $(".more").addClass(self.options.animationBg);
		      }else{
		        $(".more").addClass('noAnimation');
		      }
		      //workaround for firefox issue on trimming border-radius content
		      $(".more32").css('overflow','visible');
					var imgButton = $('<div class="imgButtonDrag1 '+self.options.button1+'" title="drag in the picture"></div>').appendTo(div);
					var divInput = $('<div clas="inputDiv" style="width:65px;position:relative;top:-42px;left:10px;"></div>').insertAfter(imgButton);
					var input = $('<input type="hidden" id="hd'+value+'-more'+plus+'" /><input type="text" id="zt'+value+'-more'+plus+'" readonly title="选择楼号" value="选择楼号" onclick="omnipotent(\'selectid\',\'?s=content/content/public_relationldlist/houseid/'+houseid+'/housename/'+housename+'/modelid/29/mid/'+value+'-more'+plus+'\',\'添加楼栋\',1)"/>').appendTo(divInput).focus();
					$('<p class="pDelete" title="删除标点"></p>').insertAfter(input).bind('click', function() {
					  $(div).remove();
					});
				}
			});
		});
		if(self.options.initialize){
			$('<div class="buttonSave"><p>Initialization mode</p><input type="button" value="保存标点" class="save" title="保存标点"/></div>').prependTo(self.element);
			$('<div class="buttonSave"><p>Initialization mode</p><input type="button" value="保存标点" class="save" title="保存标点"/></div>').appendTo(self.element);
		}
		if(self.options.modify){
			$('<div class="buttonSave"><input type="button" value="保存标点" class="save" title="保存标点"/></div>').prependTo(self.element);
			$('<div class="buttonSave"><input type="button" value="保存标点" class="save" title="保存标点"/></div>').appendTo(self.element);
		}
		$('#'+self.element.attr('id')+' .save').bind('click', function() {
		var moreInfos = '{';
			//each picture
		$.each(self.options.pictures, function( index, value ) {
			if(index>0){
				moreInfos=moreInfos+',';
			}
			var picture = $( '#'+value );
			var divs = $(picture).find('.more32');
			moreInfos = moreInfos+'"'+value+'":[';
			// each more infos on that picture
			$.each(divs, function( index, value ){
				if(index>0){
					moreInfos=moreInfos+',';
				}
				bid=$(value).find('input').val();
				if(bid==undefined){
					bid="";
				}
				topPosition=$(value).css('top');
				if(value.id.indexOf("picture1-more")!=-1)
				{
				//	var num = value.id.substring(13);
				//	var num1 = parseInt("35")* parseInt(num);
					topPosition = parseInt("35") + parseInt(topPosition) + "px";
				}
				leftPosition=$(value).css('left');
				moreInfos = moreInfos+'{"id":"'+value.id+'","bid":"'+bid+'","top":"';
				moreInfos = moreInfos+topPosition+'","left":"'+leftPosition+'"';
				
				if(value.href){
					moreInfos=moreInfos+',"href":"'+$('#'+value.id+' a').attr('href')+'"';
				}
				moreInfos=moreInfos+'}';
			});
			moreInfos=moreInfos+']';
		});
		moreInfos=moreInfos+'}';
		if(self.options.animation){
		 $("#result").val(moreInfos);
		save();
		 // alert('animation: true, animationType: "'+self.options.animationType+'", animationBg: "'+self.options.animationBg+'", button: "'+self.options.button+'", '+moreInfos);
		}else{
		  alert('animation: false, button: "'+self.options.button+'", '+moreInfos);
		}
		});
	},
	
	// Use the _setOption method to respond to changes to options
	
	_setOption: function( key, value ) {

	// In jQuery UI 1.8, you have to manually invoke the _setOption method from the base widget	
	$.Widget.prototype._setOption.apply( this, arguments );
		// In jQuery UI 1.9 and above, you use the _super method instead
		//this._super( "_setOption", key, value );
	},
	 
	// Use the destroy method to clean up any modifications your widget has made to the DOM
	destroy: function() {
		// In jQuery UI 1.8, you must invoke the destroy method from the base widget
		$.Widget.prototype.destroy.call( this );
		// In jQuery UI 1.9 and above, you would define _destroy instead of destroy and not call the base method
		}
	});
  
}( jQuery ) );

