<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<style type="text/css">
.attachment-list{ width:480px}
.attachment-list .cu{dispaly:block;float:right; background:url(statics/images/admin_img/cross.png) no-repeat 0px 100%;width:20px; height:16px; overflow:hidden;}
.attachment-list li{ width:120px; padding:0 20px 10px; float:left}
</style>
<div class="pad-10">
<ul class="attachment-list">
	';foreach($thumbs as $thumb) {
;echo '    <li>
            <img src="';echo $thumb['thumb_url'];echo '" alt="';echo $thumb['width'];echo ' X ';echo $thumb['height'];echo '" width="120" />
            <span class="cu" title="';echo L('delete');echo '" onclick="thumb_delete(\'';echo urlencode($thumb['thumb_filepath']);echo '\',this)"></span>
            ';echo $thumb['width'];echo ' X ';echo $thumb['height'];echo '    </li>
    ';};echo '</ul>
</div>
<script type="text/javascript">
<!--
function thumb_delete(filepath,obj){
	 window.top.art.dialog({content:\'';echo L('del_confirm');echo '\', fixed:true, style:\'confirm\', id:\'att_delete\'}, 
	function(){
	$.get(\'?s=attachment/manage/pullic_delthumbs/filepath/\'+filepath+\'/h5_hash/';echo $_SESSION[h5_hash];echo '\',function(data){
				if(data == 1) $(obj).parent().fadeOut("slow");
			})
		 	
		 }, 
	function(){});
};
//-->
</script>
</html>';?>