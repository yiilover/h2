/**
 * @author Administrator
 */
 (function(scope){
 	var o = null,
		timer = 0,
		d = document,
		//��ͼ����li
		li_items = null,
		//����ͼ��<div class='thumb' >
		thumb_box = null,
		//����ͼ�������� <div class='now-status'>
		thumb_bg = null,
		//���е�����ͼͼƬ{array}
		thumb_img = null,
		//����ͼ�����ĵ��ξ���
		thumb_space = 0,
		//����ͼ������4��λ������[0, 76, 152, 228]
		thumb_spaces = [],
		//������<h3 class="h3 pos-a"><a href="" title="">���������㱬����ɽ1</a></h3>
		title = null,
		//��ǰ����ֵ��Ĭ����0
		now_i = 0,
		//�Զ����ŵļ��ʱ��,Ĭ��6��
		interval_t = 6000,
		//����ͼ����
		max_len = 0,
		// ����ͼ�����ķ���Ĭ���Ǵ�ֱv
		aspect = 'top';
	
	//��ʼ������
	var init = function(c){
			o = c['id'];
			aspect = (c['way'] && c['way'] == 'left') ? 'left' : 'top';
			title = o.find('.title a');
			thumb_box = o.find('.thumb');
			thumb_img = thumb_box.find('img');
			max_len = thumb_img.size();
			thumb_bg = thumb_box.find('.now-status');
			li_items = o.find('.img li');
			interval_t = c['interval'];
			//thumb_space = thumb_bg.height();
			thumb_space = aspect == 'left' ? thumb_bg.outerWidth() : thumb_bg.outerHeight();
			cacheSpace();
			autoPlay();
			handle();
	}
	//��������ͼ���
	var cacheSpace = function(){
			for(var i = 0 ; i < thumb_img.size();i++){
				if(i == 0){
					thumb_spaces.push(0);
					continue;
				} 
				if( i > 0) thumb_spaces.push(i*thumb_space);
			}
	}
	//����ͼ����
	var changeThumb = function(o,end) {
			aspect =='left' ? thumb_bg.animate({'left': end}) : thumb_bg.animate({'top': end});
			//thumb_bg.animate({'top': end});
	}
	//��ͼ�л�Ч��
	var changeImg = function(i){
			li_items.fadeOut();
			$(li_items[i]).fadeIn();
	}
	//�л�����
	var updateTitle = function(o,i){
			o.text(getTitle(i)).attr('href',getUrl(i));
	}
	//��ȡ��ͼalt�����ϵ���������Ϊ��ʾ�ı���
	var getTitle = function(i){
			return $(li_items[i]).find('img').attr('alt');
	}
	//��ȡurl
	var getUrl = function( i ){
			return $(li_items[i]).find('a').attr('href');
	}
	var t = null;
	//���¼�
	var handle = function(){
			thumb_img.hover(function( e ){
				thumb_bg.stop();
				clearInterval(timer);
				var i = thumb_img.index($(this));
				if(i == now_i) return;
				if(t) clearTimeout(t);
				t = setTimeout(function(){
					run(i);
				},100);
			},function( e ){
				autoPlay();
			});
	}
	var run = function( i ){
			//ִ������ͼ����
			changeThumb(thumb_bg,thumb_spaces[i]);
			//��ͼ�л�
			changeImg(i);
			//�л�����
			updateTitle(title,i);
			//���µ�ǰ����ֵ
			now_i = i;
	}
	var autoPlay = function(){
			timer = window.setInterval(function(){
				now_i = now_i == max_len-1 ? -1 : now_i;
				now_i += 1;
				run(now_i);
			},interval_t);
	}
	
	if(!scope['slider']) scope['slider'] = {init: init}
	return slider;
 })(this);
 
  
 
 