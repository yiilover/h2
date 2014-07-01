<?php

defined ( 'IN_ADMIN') or exit ( 'No permission resources.');
include $this->admin_tpl ( 'header','admin');
;echo '

<div class="pad-10">
    <form
        action="?s=maillist/maillist/maillist_mgr/menuid/';echo $menuid;;echo '/h5_hash/';echo $h5_hash;;echo '"
        name="myform" id="myform" method="post">
        <input name="menuid" type="hidden" value="';echo $menuid;;echo '" />
        <table border="0" cellpadding="1" cellspacing="1"
            class="table_form" width="100%">

            <tr>
                <td align="right" width=180>';echo L('group_name');;echo '£º</td>
                <td><input name="group_name" type="text"
                    class="input-text" id="group_name" value="';echo $row['group_name'];echo '" size="30" /></td>
            </tr>
            <tr>
                <td align="right">';echo L('group_addr');;echo '£º</td>
                <td><input name="addr" type="text" class="input-text"
                    id="addr" size="30" value="';echo $row['group_addr'];echo '" disabled /> </td>
            </tr>
            <tr>
                <td align="right">';echo L('send_email');;echo '£º</td>
                <td><input name="email" type="text" class="input-text"
                    id="email" size="30" value="';echo $row['email'];echo '"  disabled />
                    </span>
                    </td>
            </tr>
            <tr>
                <td align="right" valign="top">';echo L('group_intro');;echo '£º</td>
                <td valign="top"><textarea name="descs" cols="" rows=""
                        id="descs" style="width: 300px; height: 60px;">';echo $row['descs'];echo '</textarea></td>
            </tr>
            <tr>
                <td height="64" align="right" class="t">&nbsp;</td>
                <td><input type="submit" class="button"
                    onclick="return checkSubmit()" id="dosubmit"
                    name="dosubmit" style="width:90px" value="';echo L('submit');;echo '" />
                    <span style="color:#ff0000; padding-left:20px">';
$email = explode('@',$row['email']);
$domain = $email[1];
echo $row['is_activate'] == 0 ?L('has_activate') .' <a target="_blank" style="color:#0033FF" href="http://'.((strtolower($domain) == 'gmail.com') ?'www.': 'mail.').$domain .'">'.L('now_activate') .'</a>': ''
;echo '                    </td>
            </tr>
			<tr>
                <td height="77" align="right" class="t">&nbsp;</td>
                <td><a style="color: #2279D4" target="_blank" href="';echo L('o_web_url') ;echo '">';echo L('maillist_url_tips');;echo '</a></td>
            </tr>
        </table>
    </form>
</div>
<script language="javascript" type="text/javascript"
    src="';echo JS_PATH;;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript"
    src="';echo JS_PATH;;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
	function trim(str){
	    return str ? str.replace(/^\\s+|\\s+$/g, "") : str;
	}
	
    $(document).ready(function(){
		var group_name_tips = "';echo L('group_name_tips') ;echo '";
		var descs_tips = "';echo L('group_intro_tips') ;echo '";

        $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
		$("#group_name").formValidator({onshow: group_name_tips,onfocus: group_name_tips}).inputValidator({min:1, max:20,onerror:group_name_tips});
        $("#descs").formValidator({onshow: descs_tips,onfocus: descs_tips}).inputValidator({min:1,max:200,onerror: descs_tips});
    });

    function checkSubmit()
    {
        var flag = $(\'#username\').val() == \'\' || $(\'#password\').val() == \'\' || $(\'#group_name\').val() == \'\' || $(\'#addr\').val() == \'\' || $(\'#email\').val() == \'\';
		if (flag) {
			return true;
		}
		/*
		flag = false;
		$(\'#dosubmit\').attr(\'disabled\', true);
		$(\'#dosubmit\').val("loading...");
		$.ajax({
				dataType: "json",
				timeout: 40,
				async : false,
	    		url : $(\'#myform\').attr(\'action\'),
	    		type: "POST",
	    		data: {
		    		act: "update", 
		    		check_object: "username",
		    		snda_user_has: $(\'#snda_user\').val(),
		    		pwd: $(\'#password\').val(),
		    		pwd2: $(\'#password2\').val()
		    	},
	    		success : function(data){
	                if (data.status) {
	                   
	                }
	                flag = data.status;
	    		}
		});
		$(\'#dosubmit\').attr(\'disabled\', false);
		$(\'#dosubmit\').val("';echo L('submit') ;echo '");
		alert(flag);
		return false;*/
    }
	
	function isSndaUser() {
		var snda_user = "';echo L('snda_user') ;echo '";
		var not_snda_user = "';echo L('not_snda_user') ;echo '";
		if ($(\'#pass_confirm\').css(\'display\') == \'table-row\') {
			$(\'#is_snda_user_tips\').html(not_snda_user);
			$(\'#pass_confirm\').css(\'display\', \'none\');
			$(\'#snda_user\').val(1);
			$("#password2").attr("disabled",true).unFormValidator(true);
		} else {
			$(\'#is_snda_user_tips\').html(snda_user);
			$(\'#pass_confirm\').css(\'display\', \'table-row\');
			$(\'#snda_user\').val(0);
			$("#password2").attr("disabled",false).unFormValidator(false);
		}
		
		function submitCheck()
		{
			if ($(\'#snda_user\').val() == \'1\') {
				
			}
		}
	}
</script>
';?>