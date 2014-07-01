<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'jquery.min.js"></script>
		<div id="leftMain">
		<h3 class="f14">phpsso';echo L('manage');echo '</h3>
		<ul>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/member/manage&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/member/manage');echo '" target="right">';echo L('member_manage');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/applications/init&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/applications/init');echo '" target="right">';echo L('application');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/messagequeue/manage&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/messagequeue/manage');echo '" target="right">';echo L('communication');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/credit/manage&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/credit/manage');echo '" target="right">';echo L('redeem');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/administrator/init&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/administrator/init');echo '" target="right">';echo L('administrator');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/system/init&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/system/init');echo '" target="right">';echo L('system_setting');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/cache/init&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/cache/init');echo '" target="right">';echo L('update_phpsso_cache');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/password/init&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/password/init');echo '" target="right">';echo L('change_password');echo '</a>
		</li>
		<li class="sub_menu">
		<a style="outline: medium none;" hidefocus="true" href="';echo $setting['phpsso_api_url'];echo '/index.php?s=admin/login/logout&forward=';echo urlencode($setting['phpsso_api_url'].'/index.php?s=admin/member/manage');echo '" target="right">';echo L('exit');echo 'phpsso</a>
		</li>
		</ul>
		</div>
		<script  type="text/javascript">
			$("#leftMain li").click(function() {
				var i =$(this).index() + 1;
				$("#leftMain li").removeClass();
				$("#leftMain li:nth-child("+i+")").addClass("on fb blue");
			});
		</script>';?>