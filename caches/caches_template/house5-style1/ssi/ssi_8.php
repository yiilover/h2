<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><div id="topBar">
<div class="fl">
</div>
<div class="fr">
<div class="panl" id="topBarPanl">
  ��������
<i></i>
<div>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>">�·�</a>
                        <a target="_blank" href="<?php echo catlink(6);?>" rel="nofollow"><?php echo catname(6);?></a>
<a target="_blank" href="<?php echo ESF_PATH;?>" rel="nofollow">���ַ�</a>
                        <a target="_blank" href="<?php echo ESF_PATH;?>rent-list.htmL}" rel="nofollow">��ͼ</a>
                        <a target="_blank" href="<?php echo catlink(53);?>" rel="nofollow"><?php echo catname(53);?></a>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>list-t6.html" rel="nofollow">����</a>
<a target="_blank" href="<?php echo TUAN_PATH;?>" rel="nofollow">������</a>
 <a target="_blank" href="<?php echo BBS_PATH;?>" rel="nofollow">ҵ����̳</a>
<a target="_blank" href="<?php echo APP_PATH;?>wenfang-p1.html" rel="nofollow">�ʷ�</a>

</div>
</div>
<!-- <span>��վ����:</span> -->
<a href="<?php echo ESF_PATH;?>chushou.html" class="send" target="_blank">������ѷ�����Դ</a>
</div>
</div>
<script type="text/javascript">
seajs.use(["jquery","topbarlogin"],function($,login){
login("<?php echo APP_PATH;?>index.php?s=member/index/loginbar")
$("#topBarPanl").hover(function(){
$(this).find("div").show()
},function(){
$(this).find("div").hide()
})
})
</script>