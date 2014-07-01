	function checkmobile($field, $value, $fieldinfo) {
		$errortips = L('please_input_mobile');
		if(defined('IN_ADMIN')) {
			$string = "<div id='mobile_div'><input type='text' name='info[mobile]' id='mobile' value='".$value."' size='36' class='input-text'></div>";
			$this->formValidator .= '$("#'.$field.'").formValidator({onshow:"'.$errortips.'",onfocus:"'.$errortips.'"}).inputValidator({min:1,onerror:"'.$errortips.'"});';
		} elseif($value && ROUTE_A!='register') {
			$string = "<div id='mobile_div'>".$value."</div>";
		} else {
			$string = "<input type='text' name='info[mobile]' id='mobile' value='' size='36' class='input-text' title='".L('sms_tips')."'> 
			<input type='button' id='GetVerify' onclick='get_verify()' value='".L('get_sms_code')."' class='button1'><div id='mobileTip' class='onShow'></div>
			<li><label>".L('receive_sms_code')."</label><input type='text' name='mobile_verify' id='mobile_verify' value='' size='14' class='input-text'></li>";
			
					$this->formValidator .= '$("#'.$field.'").formValidator({onshow:"'.$errortips.'",onfocus:"'.$errortips.'"}).inputValidator({min:1,onerror:"'.$errortips.'"});';
					$errortips = L('input_receive_sms_code');
					$this->formValidator .= '$("#mobile_verify").formValidator({onshow:"'.$errortips.'",onfocus:"'.$errortips.'"}).inputValidator({min:1,onerror:"'.$errortips.'"}).ajaxValidator({
					type : "get",
					url : "api.php",
					data :"op=sms_idcheck&action=id_code",
					datatype : "html",
					getdata:{mobile:"mobile"},
					async:"false",
					success : function(data){
						if( data == "1" ) {
							return true;
						} else {
							return false;
						}
					},
					buttons: $("#dosubmit"),
					onerror : "'.L('checkcode_wrong').'",
					onwait : "'.L('connecting_please_wait').'"
				});';
		}
			$string .= '
			<SCRIPT LANGUAGE="JavaScript">
			<!--
				var times = 90;
				var isinerval;
				function get_verify() {
					var mobile = $("#mobile").val();
					var partten = /^1[3-9]\d{9}$/;
					if(!partten.test(mobile)){
						alert("'.L('input_right_mobile').'");
						return false;
					}
					$.get("api.php?op=sms",{ mobile: mobile,random:Math.random()}, function(data){
						if(data=="0") {
							$("#mobile_send").html(mobile);
							$("#mobile_div").css("display","none");
							$("#mobile_send_div").css("display","");
							times = 90;
						//	$("#GetVerify").attr("value", "'.L('repeat_sms_code').'");
							$("#GetVerify").attr("class", "button2");
							$("#GetVerify").attr("disabled", true);
							$("#GetVerify").attr("value", "'.L('repeat_sms_code').'("+times+")");
							isinerval = setInterval("CountDown()", 1000);
						} else if(data=="-1") {
							alert("'.L('sms_have_reached_the_limit').'");
						} else {
							alert("'.L('sms_send_fail').'");
						}
					});
					
				}
				function CountDown() {
					if (times < 2) {
						$("#GetVerify").attr("disabled", false);
						$("#GetVerify").attr("value", "'.L('repeat_sms_code').'");
						$("#GetVerify").attr("class", "button1");
						$("#edit_mobile").css("display","");
						clearInterval(isinerval);
						return;
					}
					times--;
					$("#GetVerify").attr("value", "'.L('repeat_sms_code').'("+times+")");
					
				}
				function edit_mobile() {
					$("#mobile_div").css("display","");
					$("#mobile_send_div").css("display","none");
				}
			//-->
			</SCRIPT>
			';
			return $string;
	}
