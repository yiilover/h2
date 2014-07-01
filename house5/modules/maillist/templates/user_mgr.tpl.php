<?php

defined ( 'IN_ADMIN') or exit ( 'No permission resources.');
include $this->admin_tpl ( 'header','admin');
;echo '<div class="pad-10">
    <form
        action="';echo $post_url;;echo '"
        method="post" enctype="multipart/form-data" name="myform"
        id="myform">
        <input type="hidden" name="action" id="action" value="batch_insert" />
        <input type="hidden" name="domain" id="domain" value="';echo $rows['domain'];echo '" />
        <input type="hidden" name="code" id="code" value="';echo $rows['code'];echo '" />
        <input type="hidden" name="sdid" id="sdid" value="';echo $rows['sdid'];echo '" />
        <input type="hidden" name="group_addr" id="group_addr" value="';echo $rows['group_addr'];echo '" />
        <input type="hidden" name="hash" id="hash" value="';echo $hash;;echo '" />
        <input type="hidden" name="back_url" value="';echo $pos_url .'&url='.$en_url;;echo '" />
        <input name="menuid" type="hidden" value="';echo $menuid;;echo '" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
            id="rss_setting">
            <tr class="table_form">
                <td width="4%">&nbsp;</td>
                <td width="96%"><b>';echo L('subscribe_user');echo ':</b></td>
            </tr>
            <tr class="table_form">
                <td height="59">&nbsp;</td>
                <td><div
                        style="background: none repeat scroll 0 0 #FFF8DB; padding: 10px 20px 5px; width: 600px; line-height: 30px">
				  ';echo L('base');echo '
                      <br />
                    ';echo L('subscribe_count');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['base_total_account'];echo '</font>';echo L('p');echo '   ';echo L('unsubscribe_count');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['base_total_unsubscriber'];echo '</font>';echo L('p');echo '   ';echo L('theme');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['base_total_issued'];echo '</font>';echo L('a');echo '   ';echo L('send_count');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['base_total_success_mail'];echo '</font>
                        <hr size="1" color="#CCCCCC" />
					';echo L('week_data');echo ' £¨<font color="#999999">';echo $row['brief_info']['weekly_start_date'] .L('to') .$row['brief_info']['weekly_end_date'];;echo '</font>£©<br>

';echo L('week_add_user');echo '£º<font color="#2279D4">';echo $row['brief_info']['weekly_new_account'];echo '</font>';echo L('p');echo '   ';echo L('week_unsubscribe_user');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['weekly_unsubscriber'];echo '</font>';echo L('p');echo '   ';echo L('week_theme');echo '£º<font
                            color="#2279D4">';echo $row['brief_info']['weekly_issued'];echo '</font>
                        <br>
                    </div></td>
            </tr>
            <tr class="table_form">
                <td height="42" valign="top">&nbsp;</td>
                <td><b>';echo L('batch_import');echo '£º</b></td>
            </tr>
            <tr class="table_form">
                <td style="line-height: 24px">&nbsp;</td>
                <td style="line-height: 30px"><input type="file"
                    name="user_list" /> &nbsp; <input type="submit"
                    id="dosubmit"
                    name="dosubmit" style="width: 90px; height: 20px"
                    value="';echo L('upload');echo '" /> <br> <font
                    color="#999999">';echo L('batch_import_tips');echo '</font>
                    <br />
                <a href="';echo L('o_web_url');echo '" target="_blank"
                    style="color: #0066FF">';echo L('o_web_tips');echo '</a></td>
            </tr>
            <tr class="table_form">
                <td>&nbsp;</td>
                <td><br /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>
</div>';?>