<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}}); 
	$("#tv_title").formValidator({onshow:"';echo L("input");echo L("tv_title");;echo '",onfocus:"';echo L("input");echo L("tv_title");;echo '"}).inputValidator({min:1,onerror:"';echo L("input");echo L("tv_title");;echo '"});
	$("#video_url").formValidator({onshow:"';echo L("input");echo L("video_url");;echo '",onfocus:"';echo L("input");echo L("video_url");;echo '"}).inputValidator({min:1,onerror:"';echo L("input");echo L("video_url");;echo '"});
	})
//-->
</script>

<div class="pad_10">
<form action="?s=house5_player/house5_player/init/h5_hash/';echo $_SESSION['h5_hash'];;echo '" method="post" name="myform" id="myform">
 
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
<style type="text/css">
.gare{color:#BCBCBC}
</style>

	<tr>
		<th width="100">����˵����</th>
		<td width="300">
			�����ģ���ֶ����潨��һ������Ϊtext���ı��ֶ�,�ֶ���Ϊ<b>video_src</b>,����ǩ<span style="color: red">{template  "video_src","show"}</span>����������ò�����������ģ������,�������ݵ�ʱ����д����Ƶ��ַ������ַ��ʽ����Ƶ��ַ����
		</td>
	</tr>
	<tr>
		<th width="100">�����Ƶ��</th>
		<td width="300">
			<input name="info[video_type]" type="radio" value="3" ';if($info['video_type']==3)echo 'checked="checked"';echo ' /><label>����</label> <input name="info[video_type]"  type="radio" value="2" ';if($info['video_type']==2)echo 'checked="checked"';echo ' /><label>�ر�</label>
			<span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������Ƶ���Ž�������Զ���ʾ�����Ƶ</span>
		</td>
	</tr>
	<tr>
		<th width="100">��ƵĬ���Ƿ񲥷ţ�</th>
		<td width="300">
			<input name="info[video_default_status]" type="radio" value="0" ';if($info['video_default_status']==0)echo 'checked="checked"';echo ' /><label>��ͣ</label> <input name="info[video_default_status]"  type="radio" value="1" ';if($info['video_default_status']==1)echo 'checked="checked"';echo ' /><label>����</label>
			<span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�򿪲��Ž����Ƿ��Զ�����</span>
		</td>
	</tr>
	
	<tr>
		<th width="100">��Ƶ�϶���ʽ��</th>
		<td width="300">
			<input name="info[ck_http_set]" type="radio" value="0" ';if($info['ck_http_set']==0)echo 'checked="checked"';echo ' /><label>���϶�</label> 
			<input name="info[ck_http_set]"  type="radio" value="1" ';if($info['ck_http_set']==1)echo 'checked="checked"';echo ' /><label>���ؼ�֡</label>
			<input name="info[ck_http_set]"  type="radio" value="2" ';if($info['ck_http_set']==2)echo 'checked="checked"';echo ' /><label>��ʱ���</label>
			<input name="info[ck_http_set]"  type="radio" value="3" ';if($info['ck_http_set']==3)echo 'checked="checked"';echo ' /><label>��ʽ�Զ�</label>
			<input name="info[ck_http_set]"  type="radio" value="4" ';if($info['ck_http_set']==4)echo 'checked="checked"';echo ' /><label>�ؼ����Զ�</label>
			<br /><br /><span class="gare">����http��Ƶ��ʱ���ú����϶�������=0��ʹ�������϶���=1��ʹ�ð��ؼ�֡��=2�ǰ�ʱ��㣬=3���Զ��жϰ�ʲô(�����Ƶ��ʽ��.mp4�Ͱ��ؼ�֡��.flv�Ͱ��ؼ�ʱ��)��=4Ҳ���Զ��ж�(ֻҪ�����ַ�mp4�Ͱ�mp4����ֻҪ�����ַ�flv�Ͱ�flv��)</span>
		</td>
	</tr>
	
	
	<!-- <tr>
		<th width="100">����������Զ���·��:</th>
		<td><input type="text" name="info[ck_style]" id="ck_style" value="';echo $info['ck_style'];echo '" size="30" class="input-text"> <span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����xml���·����Ϊ�յĻ���ʹ��ckplayer.js������</span></td>
	</tr> -->
	
	<tr id="task_info">
		<th width="100">Ĭ��������</th>
		<td>
		<input type="text" name="info[ck_volume]" id="ck_volume" size="10"  value="';echo $info['ck_volume'];echo '"  class="input-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gare">��Χ:1-100</span>
		</td>
	</tr>
	<tr>
		<th width="100">�������ߴ�:</th>
		<td><input type="text" name="info[ck_size]" id="ck_size" size="30"  value="';echo $info['ck_size'];echo '"  class="input-text"><span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ʽ: 600|400  (��|��)</span></td> 
		
	</tr>
	<tr>
		<th width="100">�Ƿ�����HTML5�������Զ��л���</th>
		<td width="300">
			<input name="info[ck_html5]" type="radio" value="0" ';if($info['ck_html5']==0)echo 'checked="checked"';echo ' /><label>����</label> <input name="info[ck_html5]"  type="radio" value="1" ';if($info['ck_html5']==1)echo 'checked="checked"';echo ' /><label>�ر�</label>
			<span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����ͻ��˲�֧��FLASHʱ�Զ��л�HTML5������</span>
		</td>
	</tr>

	
	<tr>
		<th width="100">���صȴ�ͼƬ��</th>
		<td width="300">
			';echo form::upfiles('info[thumb_load]','thumb_load',$info[thumb_load],'house5_player','',30,'','',"jpg|png|gif");echo '
		</td>
	</tr>
    
    <tr>
		<th width="100">��ͣ��棺</th>
		<td width="300">
			';echo form::upfiles('info[thumb_pause_ad]','thumb_pause_ad',$info[thumb_pause_ad],'house5_player','',30,'','',"jpg|png|gif");echo '			URL���ӵ�ַ: <input type="text" name="info[url_pause_ad]" id="ck_volume" size="40"  value="';echo $info['url_pause_ad'];;echo '"  class="input-text"> <br /><span class="gare">��ͣ�Ͳ�ǰ���ͼƬ�͵�ַ�ɶ�д ,��ʽ:http://www.house5.net/1.jpg|http://www.house5.net/2.jpg</span>
		</td>
	</tr>
	<tr>


		<th width="100">����ǰ��棺</th>
		<td width="300" id="task_step">
			<li>
			';echo form::upfiles('info[thumb_qz_ad]','thumb_qz_ad',$info[thumb_qz_ad],'thumb_qz_ad','',30,'','',"jpg|png|gif");echo '			URL���ӵ�ַ: <input type="text" name="info[url_qz_ad]"  size="40"  value="';echo $info['url_qz_ad'];;echo '"  class="input-text">
			���ʱ��: <input type="text" name="info[time_qz_ad]"  size="10"  value="';echo $info['time_qz_ad'];;echo '"  class="input-text">��
			</li>
		</td>
	</tr>
	
	<tr>
		<th width="100">�����棺</th>
		<td width="300">
			';echo form::upfiles('info[beff_ad]','beff_ad',$info[beff_ad],'house5_player','',30,'','',"swf");echo ' <span class="gare">ֻ֧��SWF��ʽ</span>

		</td>
	</tr>
	
	<tr>
		<th width="100">���ֹ��:</th>
		<td><input type="text" name="info[text_ad]" id="ck_size" size="60"  value=\'';echo $info['text_ad'];echo '\'  class="input-text"><span class="gare">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ʽ:{a href="http://www.house5.net"}{font color="#FFFFFF" size="12"}������Է����ֹ�档{/font}{/a}</span></td> 
		
	</tr>
    
    <tr>
		<th width="100">������Ƶ�����ֶ�:</th>
		<td><span style="color: red">{video_src2}</span>�ж������ҳ�治ͬ���������,��������ֶκ͵����ֶ���һ�����÷�,����ģ��.��{video_src}�ֶ�û��д����������ֶ�</td> 
		
	</tr>
    
	<tr>
	
	
<style type="text/css">
	.aui_state_highlight{margin-left: 15px;padding: 6px 12px;cursor: pointer;display: inline-block;text-align: center;line-height: 1;letter-spacing: 2px;font-family: Tahoma, Arial/9!important;width: auto;overflow: visible;color: #333;border: solid 1px #999;border-radius: 5px;background: #DDD;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#FFFFFF\', endColorstr=\'#DDDDDD\');background: linear-gradient(top, #FFF, #DDD);text-shadow: 0px 1px 1px rgba(255, 255, 255, 1);box-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0 -1px 0 rgba(0, 0, 0, .09);}
</style>
<tr>
		<th></th>
		<td>
		<input type="submit" name="dosubmit" id="dosubmit"  class="aui_state_highlight" value=" ';echo L('submit');echo ' " />
		</td>
	</tr>

</table>
</form>
</div>


</body>
</html> ';?>