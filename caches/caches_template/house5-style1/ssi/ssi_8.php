<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><div id="topBar">
<div class="fl">
</div>
<div class="fr">
<div class="panl" id="topBarPanl">
  快速连接
<i></i>
<div>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>">新房</a>
                        <a target="_blank" href="<?php echo catlink(6);?>" rel="nofollow"><?php echo catname(6);?></a>
<a target="_blank" href="<?php echo ESF_PATH;?>" rel="nofollow">二手房</a>
                        <a target="_blank" href="<?php echo ESF_PATH;?>rent-list.htmL}" rel="nofollow">地图</a>
                        <a target="_blank" href="<?php echo catlink(53);?>" rel="nofollow"><?php echo catname(53);?></a>
                        <a target="_blank" href="<?php echo HOUSE_PATH;?>list-t6.html" rel="nofollow">别墅</a>
<a target="_blank" href="<?php echo TUAN_PATH;?>" rel="nofollow">看房团</a>
 <a target="_blank" href="<?php echo BBS_PATH;?>" rel="nofollow">业主论坛</a>
<a target="_blank" href="<?php echo APP_PATH;?>wenfang-p1.html" rel="nofollow">问房</a>

</div>
</div>
<!-- <span>网站热线:</span> -->
<a href="<?php echo ESF_PATH;?>chushou.html" class="send" target="_blank">个人免费发布房源</a>
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