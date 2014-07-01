<?php

defined ( 'IN_ADMIN') or exit ( 'No permission resources.');
include $this->admin_tpl ( 'header','admin');
;echo '

<div class="pad-10">
    <form
        action="';echo $post_url ;echo '"
        name="myform" id="myform" method="post">
        
        <input type="hidden" name="action" id="action" value="update_rss" />
        <input type="hidden" name="domain" id="domain" value="';echo $row['domain'];echo '" />
        <input type="hidden" name="code" id="code" value="';echo $row['code'];echo '" />
        <input type="hidden" name="sdid" id="sdid" value="';echo $row['sdid'];echo '" />
        <input type="hidden" name="group_addr" id="group_addr" value="';echo $row['group_addr'];echo '" />
        <input type="hidden" name="hash" id="hash" value="';echo $hash;;echo '" />
        <input type="hidden" name="back_url" value="';echo $pos_url .'&url='.$en_url;;echo '" />
        
        
        <input type="hidden" name="menuid" id="menuid" value="';echo $menuid;;echo '" />
        <input type="hidden" name="h5_hash" id="h5_hash" value="';echo $h5_hash;;echo '" />
        <table border="0" cellpadding="1" cellspacing="1"
            class="table_form" width="100%">
            <tr>
                <td style="padding-left: 16%"><label>';echo L('rss_enabled');echo '</label>&nbsp;&nbsp;&nbsp;<input
                    type="radio" name="rss_enabled"
                    id="rss_enabled_true" ';echo $row['rss_enabled'] ?'checked': '';echo ' class="radio"
                    onchange="isEnabledRss()" value="1" />&nbsp;<label>';echo L('rss_enabled_open');echo '</label><input
                    onchange="isEnabledRss()" ';echo !$row['rss_enabled'] ?'checked': '';echo ' type="radio" value="0"
                    id="rss_enabled_false" name="rss_enabled"
                    class="radio" />&nbsp;<label>';echo L('rss_enabled_close');echo '</label></td>
            </tr>
            <tr>
                <td><table width="100%" border="0" cellspacing="0"
                        cellpadding="0" id="rss_setting">
                        <tr class="table_form">
                            <td width="15%">&nbsp;</td>
                            <td width="85%" style="color: #999999">';echo L('rss_enabled_tips');echo '</td>
                        </tr>
                        <!-- 
                        <tr class="table_form">
                            <td height="59">&nbsp;</td>
                            <td style="padding-bottom: 10px"><b>';echo L('rss_source');echo '£º</b><br />
                                <select name="sys_rss" id="sys_rss" onchange="getRssItem(this.value)">
                                    <option value="">-';echo L('rss_source_option');echo '-</option>
                            </select>
                                <div id="item_list"
                                    style="width: 300px; margin-top: 15px">
                                </div>
                                
                                </td>
                        </tr>
                         -->
                        <tr class="table_form">
                            <td valign="top">&nbsp;</td>
                            <td valign="top"><b>';echo L('rss_url');echo '£º</b><br>
                                <textarea name="rss_url" cols="" rows=""
                                    id="rss_url"
                                    style="width: 400px; height: ';$pos = substr_count($row['rss_url'],";");echo ($pos >0) ?($pos * 18) +10 : 50 ;echo 'px;">';echo str_replace(";",";\n",str_replace(array("\r\n","\r","\n"),"",$row['rss_url']));;echo '</textarea>
                                <!-- <br /> <span style="color: #999999">';echo L('rss_url_tips');echo '</span> --></td>
                        </tr>
                        <tr class="table_form">
                            <td style="line-height: 24px">&nbsp;</td>
                            <td style="line-height: 24px"><b>';echo L('rss_rate');echo '£º</b><br />
                    ';echo L('rss_rate_option');echo '£º
                    <select name="bind_rss_rate" id="bind_rss_rate">
                                    <option selected="" value="0">';echo L('rss_day');echo '</option>
                                    <option value="1">';echo L('rss_week');echo '</option>
                                    <option value="2">';echo L('rss_month');echo '</option>
                            </select> <br />
                    ';echo L('rss_number_option');echo '£º
                    <select name="bind_rss_number" id="bind_rss_number">
                                    <option value="1">';echo L('rss_one');echo '</option>
                                    <option selected="" value="2">';echo L('rss_two');echo '</option>
                                    <option value="3">';echo L('rss_three');echo '</option>
                                    <option value="4">';echo L('rss_four');echo '</option>
                                    <option value="5">';echo L('rss_five');echo '</option>
                                    <option value="6">';echo L('rss_six');echo '</option>
                                    <option value="7">';echo L('rss_seven');echo '</option>
                                    <option value="8">';echo L('rss_eight');echo '</option>
                                    <option value="9">';echo L('rss_nine');echo '</option>
                                    <option value="10">';echo L('rss_ten');echo '</option>
                            </select></td>
                        </tr>
                        <tr class="table_form">
                            <td>&nbsp;</td>
                            <td><br /> <input type="submit"
                                class="button"
                                id="dosubmit" name="dosubmit"
                                style="width: 90px"
                                value="';echo L('submit');echo '" />
                                <div
                                    style="background: #E2F0FF; padding: 20px; margin: 10px; width: 450px; line-height: 20px">
                                    <p>
                                        <strong>';echo L('rss_tips1');echo '£º</strong>
                                    </p>
                                    <p> ';echo L('rss_tips2');echo ' <a
                                            href="';echo L('o_web_url');echo '"
                                            target="_blank"
                                            style="color: #0066FF">o.sdo.com</a>
                                    </p>
                                    <p>';echo '';echo '</p>
                                </div></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table></td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript">
	var rss_enabled = \'';echo empty($row['rss_enabled']) ?'0': $row['rss_enabled'] ;echo '\';
	var rss_source = \'';echo $row['rss_sys_source'] ;echo '\';
	var rss_item = \'';echo $row['rss_sys_item'] ;echo ',\';
	var rss_rate = \'';echo $row['rss_rate'] ;echo '\';
	var rss_number = \'';echo $row['rss_number'] ;echo '\';
	var rss_url = \'';echo str_replace(array("\r\n","\n","\r"),'',join(';',$row['rss_array']));;echo '\'

	$(document).ready(function(){
		$(\'#bind_rss_rate\').val(rss_rate);
		$(\'#bind_rss_number\').val(rss_number);
		$(\'#sys_rss\').val(rss_source);
		isEnabledRss();
		//getRssItem(\'0\');
	});
	
	function isEnabledRss()
	{
		var is_disabled = true;
		var color = "#cccccc";
		if ($(\'#rss_enabled_true\').attr(\'checked\')) {
		 	is_disabled = false;
			color = "#333333";
		}

		$(\'#rss_setting input\').attr("disabled",  is_disabled).css("color",  color);
		$(\'#rss_setting textarea\').attr("disabled",  is_disabled).css("color", color);
		$(\'#rss_setting select\').attr("disabled",  is_disabled).css("color", color);
		$(\'#dosubmit\').attr(\'disabled\', false).css("color", \'#333333\');
	}

	function getRssItem(value)
	{
		if (value == \'\') {
			$(\'#item_list\').html(\'\');
			return false;
		}
		
		$(\'#item_list\').html(\'loading...\');
		$.ajax({
			dataType: "json",
    		url : $(\'#myform\').attr(\'action\'),
    		type: "POST",
    		data: {
	    		act: "get_rss_item", 
	    		cat_id: value
	    	},
    		success : function(data){
    			$(\'#item_list\').html(\'\');
    			var rss = data.rss_array;
        		if (value == \'0\') {
            		var id = 0;
        			var option = \'<option value="">-';echo L('rss_source_option');echo '-</option>\';
        			for (var i = 0; i < rss.length; i++) {
        				option += \'<option value="\'+ rss[i].id + \'"\';
        				option += \'>\' + rss[i].name + \'</option>\';
        			}
        			$(\'#sys_rss\').empty();
        			$(\'#sys_rss\').append(option);
       			
        			return;
        		}
    			
    			var html = \'\';
    			var urls = $("#rss_url").val();
    			var reg = new RegExp("\\n", "g");
    			urls = urls.replace(reg, "");
    			rss_url = urls + rss_url;
    			var rss_items = [];
    			if (rss_url != \'\') {
        			var items = rss_url.split(\';\');
        			for (var i = 0; i < items.length; i++) {
            			if (items[i] != \'\') {
            				rss_items.push(items[i]);
            			}
            		}
        		}
        
    			for (var i = 0; i < rss.length; i++) {
        			html += \'<div style="width: 150px; float: left"><input onchange="selectRss(this)" type="checkbox" name="rss_sys_item[]" value="\'+ rss[i].url +\'" \';
        			for (var k = 0; k < rss_items.length; k++) {
            			if (rss[i].url == rss_items[k]) {
            				html += \'checked \';
            				break;
            			}
        			}
        			html += \'/> \'+ rss[i].name + \'</div>\';
    			}	
    			$(\'#item_list\').html(html);
    			isEnabledRss();
    		}
		});
	}

	function selectRss(obj)
	{
		var urls = $(\'#rss_url\').val();
		if (urls == \'\') {
			$(\'#rss_url\').val(obj.value + ";\\n");
			return true;
		}
		var reg = new RegExp("\\n", "g");
		urls = urls.replace(reg, "");
		if (urls.substr(urls.length - 1, urls.length) != \';\') {
			urls += \';\';
		}
		var data = urls.split(\';\');
		var result = [];
		var flag = false;
		for (var i = 0; i < data.length; i++) {
			if (data[i] == obj.value) {
				flag = true;
				break;
			}
		}

		if (obj.checked && !flag) {
			$(\'#rss_url\').val(data.join(";\\n") + obj.value + ";\\n");
			$(\'#rss_url\').css(\'height\', data.length * 18 + 10);
		} else if (!obj.checked && flag) {
			data[i] = \'\';
			for (var k = 0; k < data.length; k++) {
				if (data[k] != \'\') {
					result.push(data[k]);
				}
			}
			$(\'#rss_url\').val(result.join(";\\n"));
			$(\'#rss_url\').val($(\'#rss_url\').val() + ";");
			$(\'#rss_url\').css(\'height\', result.length * 18 + 10);
		}

	}
	
	
</script>
';?>