<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>发布个人出售房源-我要出售-<?php echo $SEO['site_title'];?></title>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link rel="shortcut icon" href="<?php echo APP_PATH;?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo APP_PATH;?>statics/default/css/esf/fabu-pub.css" />
<script>
var cookiepre = "";var cookiepath = "";var cookiedomain = "";var SiteUrl="<?php echo APP_PATH;?>";var imgUrl="<?php echo APP_PATH;?>statics/default/img/esf/";
var housetype;
var pubhousetype = 1;
var pubaction = "sell";
window.UEDITOR_HOME_URL = "<?php echo APP_PATH;?>statics/js/ueditor/";
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo h5_base::load_config('system','upload_url')?>';
//-->
</script>
<link href="<?php echo CSS_PATH;?>table_form.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH;?>dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<script src="<?php echo APP_PATH;?>statics/default/js/esf/common-jquery.cookie.js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/validor_base_zhijia.js" ></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/js/ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/js/ueditor/editor_all.js"></script>

	<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/validor_rent_zhijia.js" ></script>
<link rel="stylesheet" href="<?php echo APP_PATH;?>statics/default/css/esf/validor_style.css"  type="text/css" media="all" />
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/pub.js" ></script> 
<!--图上传-->
<script src="<?php echo APP_PATH;?>statics/default/js/esf/swfupload-swfupload.js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/community.js" ></script>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/jquery.autocomplete.js" ></script>
<link rel="stylesheet" href="<?php echo APP_PATH;?>statics/default/css/esf/styles.css"  type="text/css" />
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/manage.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>

</head>
<body>
<div id="wrap">
	<!--头部开始-->
   <?php include template("ssi","ssi_8"); ?>
	<!--头部结束-->
    <!--导航开始-->
    <div class="mt10 login_header">
    	<div class="logo"><img src="<?php echo APP_PATH;?>statics/default/img/logo.png" alt="<?php echo $SEO['site_title'];?>" width="150" height="50"/></div>
        <ul class="nav">
        	<li class="nav1"><a href="<?php echo ESF_PATH;?>chuzu.html" ></a><a href="<?php echo ESF_PATH;?>chushou.html" ></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!--导航结束-->
   	<script type="text/javascript">
$(document).ready(function(){
$(".leftarrow").live("click",function(){
	var parent = $(this).parent().parent();
	parent.prev().before(parent)
	});
$(".rightarrow").live("click",function(){
	var parent = $(this).parent().parent();
	parent.next().after(parent); 
	});
});
</script>
<form id="myform" method="post" action="<?php echo APP_PATH;?>index.php?s=content/index/esf_rent_save" >
<table width="960" border="0" cellspacing="0" cellpadding="0" class="tabSty" >
      <tr>
        <th><span><em>*</em> 房源类型：</span></th>
        <td><label for="renthouse_1"><input name="renthouse" type="radio"  value="1" id="renthouse_1" checked >&nbsp;住宅&nbsp;&nbsp;&nbsp;</label>
            <!-- <label for="renthouse_3"><input name="renthouse" type="radio" value="3" id="renthouse_3" >&nbsp;写字楼&nbsp;&nbsp;&nbsp;</label>
        <label for="renthouse_5"><input name="renthouse" type="radio" value="5"  id="renthouse_5" >&nbsp;商铺</label> -->
        <span id="renthouse" style="display:none;"></span><span id="div_renthouse" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th valign="top"><span><em>*</em> 所在<font class="com_office">小区</font>：</span></th>
        <td>
            <input type="hidden" id="vid" name="cid"  value="" />
            <input id="villagename" name="communityname_vo" type="text"   style="width: 300px;color:#999;" class="fl default_color input_bg input_border_def" onkeyup="CommunitySearch(this.value)" autocomplete="off" >
            <span id="div_villagename" class="other" style="position:relative;" ></span>
            <div class="clear"></div>
            <div id="divSearchResult" style="display: none;" class="community_pop_box">
                <div id="divShow" class="divshow"></div>
            </div>
            <div id="addCommunity" class="addCommunity" style="display: none;">
                <div class="add_title">未匹配到相关<font class="com_office">小区</font>信息，您可以在此添加新<font class="com_office">小区</font>！</div>
                <div class="add_box">
                    <ul>
                    <li><font class="com_office">小区</font>名称：<input name="txtCommunityName" id="txtCommunityName" class="textinput" style="width: 150px;" type="text"></li>
                    <li>所在区县：
                    <select id="areaid_com" name="areaid"><option value="">选择区域</option>
					 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" h5_action=\"content\" data=\"op=content&tag_md5=1169c1088f6c4950c1f4cf9ee68e7753&action=getlinkage&keyid=3360&parentid=0&order=listorder+ASC&cache=86400\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC',)).'1169c1088f6c4950c1f4cf9ee68e7753');if(!$data = tpl_cache($tag_cache_name,86400)){$content_tag = h5_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getlinkage')) {$data = $content_tag->getlinkage(array('keyid'=>'3360','parentid'=>'0','order'=>'listorder ASC','limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
					 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php $reg = explode('$$', $r);?>
	    <option value=<?php echo $reg['0'];?>><?php echo $reg['1'];?></option>

			<?php $n++;}unset($n); ?>
			</select>
                    <select id="circleid_com" name="circleid">
                        <option>选择所在商圈</option>
                                            </select>
                    </li>
                    <li>详细地址：<input name="txtCommunityAddress" id="txtCommunityAddress" class="textinput" style="width: 260px;" type="text"></li>
                    <li style="padding-left:60px;"><input name="btnAddCommunity" value="添加新小区" onclick='saveComtwo()' id="btnAddCommunity" class="body_btn" type="button"></li>
                    </ul>
                </div>
                <div class="add_bot"><strong>注意</strong>：如果创建的<font class="com_office">小区</font>叫<span class="red">长安区盛世长安<font class="com_office">小区</font></span>那么请您在<font class="com_office">小区</font>名称那里填写<span class="red">盛世长安</span>就可以，<font class="com_office">小区</font>的名称中不可出现无关的文字和符号，如果不符合标准,您的房源信息可能会被处理为违规房源。</div>
            </div>
            <div class="clear"></div>
            <span class="gray" style="display:inline-block;">请输入<font class="com_office">小区</font>名称，如："祥云国际"或"xygj"，然后在下面打开的列表中选择即可。</span>
        </td>
      </tr>
	  <tr>
        <th><span><em>*</em> 建筑面积：</span></th>
        <td><input id="buildarea" type="text"  style="width:60px;color:#999;" class="default_color input_bg input_border_def"  name="area"  >&nbsp;平米<span id="div_buildarea" class="other"></span>
        </td>
      </tr>
	  <tr class="form_element house1" style="display: table-row;">
        <th><span><em>*</em> 出租方式：</span></th>
        <td>
			<input name="renttype" id="renttype_1" type="radio" value="1"> <label for="renttype_1">整租</label>
			<input name="renttype" type="radio" id="renttype_2" value="2"> <label for="renttype_2">合租</label>
			<input name="renttype" type="radio" id="renttype_3" value="3"> <label for="renttype_3">日租</label>
            <span id="renttype" style="display:none;"></span><span id="div_renttype" class="other"></span>
        </td>
      </tr>
      <tr>
        <th><span><em>*</em> 租金：</span></th>
        <td>
        	<div style="font-size:12px;float:left;"><input id="price" name="price" type="text" value="" style="width:100px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" size="40"  autocomplete="off" >&nbsp;元/月</div>
            <span id="div_price" class="other"></span>
        </td>
      </tr>
	  <tr class="form_element house1" style="display: table-row;">
        <th><span><em>*</em> 付款方式：</span></th>
        <td>
        	押&nbsp;<input id="" name="paytype" type="text" value="" style="width:50px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" autocomplete="off">
            &nbsp;付&nbsp;<input id="" name="paytype2" type="text" value="" style="width:50px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" autocomplete="off">
            <span class="gray">面议或无需押金请输入0</span>
            <span id="paytype" style="display:none;"></span><span id="div_paytype" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th><span><em>*</em> 装修：</span></th>
        <td>
                					<input name="decorate" id="decorate_1" type="radio"  value="1" /> <label for="decorate_1">毛坯</label>
							<input name="decorate" id="decorate_2" type="radio"  value="2" /> <label for="decorate_2">精装</label>
							<input name="decorate" id="decorate_3" type="radio"  value="3" /> <label for="decorate_3">中等装修</label>
							<input name="decorate" id="decorate_4" type="radio"  value="4" /> <label for="decorate_4">简装</label>
							<input name="decorate" id="decorate_5" type="radio"  value="5" /> <label for="decorate_5">豪华装修</label>
							<input name="decorate" id="decorate_6" type="radio"  value="6" /> <label for="decorate_6">原房</label>
			                <span id="decorate" style="display:none;"></span><span id="div_decorate" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th><span><em>*</em> 房屋类型：</span></th>
        <td>
        	                                	<input name="property" id="property_1" type="radio" value="1" /> <label for="property_1">普通住宅</label>
                                	<input name="property" id="property_3" type="radio" value="3" /> <label for="property_3">别墅</label>
                                	<input name="property" id="property_2" type="radio" value="2" /> <label for="property_2">公寓</label>
                                	<input name="property" id="property_4" type="radio" value="4" /> <label for="property_4">平房</label>
                                	<input name="property" id="property_5" type="radio" value="5" /> <label for="property_5">其它</label>
                                        <span id="property" style="display:none;"></span><span id="div_property" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th><span><em>*</em> 楼层：</span></th>
        <td><div style="font-size:14px;">第&nbsp;<input type="text" value="" style="width:20px;color:#999;" class="default_color input_bg input_border_def" maxlength="20"  name="floor" autocomplete="off">&nbsp;层，共&nbsp;<input type="text" value="" style="width:20px;color:#999;" class="default_color input_bg input_border_def" maxlength="20"  name="totalfloor" autocomplete="off">&nbsp;层<span id="floor" style="display:none;"></span><span id="div_floor" class="other"></span></div></td>
      </tr>
      <tr class="form_element house1">
        <th><span><em>*</em> 户型：</span></th>
        <td><div style="font-size:14px;"><input type="text" value="" style="width:20px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" size="40" name="room" autocomplete="off">&nbsp;室&nbsp;<input type="text" value="" style="width:20px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" size="40" name="hall" autocomplete="off">&nbsp;厅&nbsp;<input type="text" value="" style="width:20px;color:#999;" class="default_color input_bg input_border_def" maxlength="20" size="40" name="toilet" autocomplete="off">&nbsp;卫<span id="room" style="display:none;"></span><span id="div_room" class="other"></span></div></td>
      </tr>
      <tr class="form_element house1">
        <th><span><em>*</em> 朝向：</span></th>
        <td>
        					<input id="aspect1" name="aspect" type="radio" value="1" /> <label for="aspect1">东</label>
							<input id="aspect2" name="aspect" type="radio" value="2" /> <label for="aspect2">南</label>
							<input id="aspect3" name="aspect" type="radio" value="3" /> <label for="aspect3">西</label>
							<input id="aspect4" name="aspect" type="radio" value="4" /> <label for="aspect4">北</label>
							<input id="aspect9" name="aspect" type="radio" value="9" /> <label for="aspect9">南北</label>
							<input id="aspect5" name="aspect" type="radio" value="5" /> <label for="aspect5">东南</label>
							<input id="aspect6" name="aspect" type="radio" value="6" /> <label for="aspect6">东北</label>
							<input id="aspect7" name="aspect" type="radio" value="7" /> <label for="aspect7">西南</label>
							<input id="aspect8" name="aspect" type="radio" value="8" /> <label for="aspect8">西北</label>
							<input id="aspect10" name="aspect" type="radio" value="10" /> <label for="aspect10">东西</label>
			            <span id="aspect" style="display:none"></span><span id="div_aspect" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th><span>建筑年代：</span></th>
        <td>
        	<input type="text" id="houseage" name="houseage"  value="" style="width:60px;color:#999;" class="default_color input_bg input_border_def"    >
            <span class="gray">例:2000年</span>
            <span id="div_houseage" class="other"></span>
        </td>
      </tr>
      <tr class="form_element house1">
        <th><span>配套设施：</span></th>
        <td>
        	                        <input name="assort[]" id="assort18" type="checkbox" value="18" /> <label for="assort18">有线电视</label>
                                	<input name="assort[]" id="assort17" type="checkbox" value="17" /> <label for="assort17">双人床</label>
                                	<input name="assort[]" id="assort16" type="checkbox" value="16" /> <label for="assort16">家电</label>
                                	<input name="assort[]" id="assort15" type="checkbox" value="15" /> <label for="assort15">灶具</label>
                                	<input name="assort[]" id="assort14" type="checkbox" value="14" /> <label for="assort14">小房</label>
                                	<input name="assort[]" id="assort12" type="checkbox" value="12" /> <label for="assort12">家具</label>
                                	<input name="assort[]" id="assort10" type="checkbox" value="10" /> <label for="assort10">电话</label>
                                	<input name="assort[]" id="assort9" type="checkbox" value="9" /> <label for="assort9">宽带</label>
                                	<input name="assort[]" id="assort2" type="checkbox" value="2" /> <label for="assort2">天然气</label>
                                	<input name="assort[]" id="assort1" type="checkbox" value="1" /> <label for="assort1">煤气</label>
                                	<input name="assort[]" id="assort3" type="checkbox" value="3" /> <label for="assort3">暖气</label>
                                	<input name="assort[]" id="assort4" type="checkbox" value="4" /> <label for="assort4">电梯</label>
                                	<input name="assort[]" id="assort5" type="checkbox" value="5" /> <label for="assort5">车位</label>
                                	<input name="assort[]" id="assort6" type="checkbox" value="6" /> <label for="assort6">储藏室/地下室</label>
                                	<input name="assort[]" id="assort7" type="checkbox" value="7" /> <label for="assort7">防盗门</label>
                                	<input name="assort[]" id="assort8" type="checkbox" value="8" /> <label for="assort8">空调</label>
                                	<input name="assort[]" id="assort11" type="checkbox" value="11" /> <label for="assort11">阳台封闭</label>
                                	<input name="assort[]" id="assort13" type="checkbox" value="13" /> <label for="assort13">热水</label>
                                    </td>
      </tr>
      <tr>
        <th><span><em>*</em> 房源标题：</span></th>
        <td><div><br>
                <input type="text" id="title" name="title"  style="width:300px;color:#999;" class="fl default_color input_bg input_border_def" maxlength="20" size="40"  autocomplete="off">
                <span id="div_title" class="other"></span>
                <div class="clear"></div>
                <span class="red">描述出售房源特色，让房源出售的更快！</span>限4-30个汉字。<br />
        </div></td>
      </tr>
      <tr>
        <th valign="top"><span><em>*</em> 房源描述：</span></th>
        <td>
        <span class="red"><br>例如对求购者的要求，房源情况，附近环境，周边配套信息...</span>200-500字效果为最佳。<br /><span style="color:#0000FF">请不要从word,wps,网页上直接复制内容,可能会出现排版混乱现象。</span><br><span class="gray">请勿留联系电话，请勿添加其他房源广告，请勿添加其它网站网址，违者将按[违规房源]处理。</span><br />
		<script type="text/plain" id="content" name="content"></script>
        <span id="div_content" class="other"></span>
        <br> 
			<script type="text/javascript">
var editor_content = new baidu.editor.ui.Editor({toolbars:[['Source','Bold', 'Italic', '|', 'InsertOrderedList', 'InsertUnorderedList', '|', 'Link', 'Unlink' ]],minFrameHeight:80});
editor_content.render('content');
</script> 
        </td>
      </tr>
      <tr>
         <th valign="top"><span>房源照片：</span></th>
         <td>
    <div  style="color:#666666;"><p> 1. 请注意上传图片的类型，例如：室内图中只能上传室内图片。 <br />
      2. 限JPEG、PNG格式，图像分辨率应大于400X300像素，文件小于2MB。 <br />
      3. 严禁上传的图片带有任何水印，包括其他网站logo、水印以及带有任何网站链接的图片。 <br />
      4. 上传1张房型图，3张室内图，就能获得<img src="<?php echo APP_PATH;?>statics/default/img/esf/icon-more-28x16.gif"  />标签。<img src="<?php echo APP_PATH;?>statics/default/img/esf/icon-more-28x16.gif"  />房源能获得比一般房源高出 <font color="red"><b>27.3</b>%</font> 的点击率。</p>
      </div>
         	<div class="upload_album">
                 <div class="file_wrap" >
		<span>
		<fieldset class="blue pad-10">
        <legend>室内图</legend><center><div class='onShow' id='nameTip'>您最多可以同时上传 <font color='red'>5</font> 张</div></center><div id="house_room" class="picList"></div>
		</fieldset>
		<div class="bk10"></div>
		<script type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script><div class='picBut cu'><a herf='javascript:void(0);' onclick="javascript:flashupload('house_room_images', '附件上传','house_room',change_images,'5,gif|jpg|jpeg|png|bmp,0','content','112','<?php echo $authkey;?>')"/> 选择图片 </a></div>  </span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="upload_album">
                 <div class="file_wrap" >
                     <span>
					<fieldset class="blue pad-10">
					<legend>户型图</legend><center><div class='onShow' id='nameTip'>您最多可以同时上传 <font color='red'>5</font> 张</div></center><div id="house_pic" class="picList"></div>
					</fieldset>
					<div class="bk10"></div>
					<script type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script><div class='picBut cu'><a herf='javascript:void(0);' onclick="javascript:flashupload('house_pic_images', '附件上传','house_pic',change_images,'5,gif|jpg|jpeg|png|bmp,0','content','112','<?php echo $authkey;?>')"/> 选择图片 </a></div>  </span>
                </div>

                <div class="clear"></div>
            </div>
            <div class="upload_album" id="albumbox3">
                 <div class="file_wrap" >
                     <span>
					<fieldset class="blue pad-10">
					<legend>室外图</legend><center><div class='onShow' id='nameTip'>您最多可以同时上传 <font color='red'>5</font> 张</div></center><div id="house_outdoor" class="picList"></div>
					</fieldset>
					<div class="bk10"></div>
					<script type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script><div class='picBut cu'><a herf='javascript:void(0);' onclick="javascript:flashupload('house_outdoor_images', '附件上传','house_outdoor',change_images,'5,gif|jpg|jpeg|png|bmp,0','content','112','<?php echo $authkey;?>')"/> 选择图片 </a></div>  </span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="upload_album">
                 <div class="album_title">标题图</div>
                <div class="houseImg">
                <ul class="mt10">
                  <li id="title_pic" ><input type="hidden" value="" name="titlepic"></li>
                </ul>
                </div>
            </div>
        </td>
      </tr>            <tr>
        <td colspan="2"><p style="height:10px;border-bottom:1px solid #ddd;"></p></td>
      </tr>
      <tr>
        <th><span><em>*</em> 联系人：</span></th>
        <td><div>
                <input type="text" value="" style="width:150px;color:#999;" class="fl default_color input_bg input_border_def" maxlength="20"  name="username" id="username" autocomplete="off"><span id="div_username" class="other"></span>
        </div></td>
      </tr>
      <tr>
        <th><span><em>*</em> 手机号码：</span></th>
        <td><div>
                <input type="text" value="" style="width:150px;color:#999;" class="fl default_color input_bg input_border_def" maxlength="20"  name="usertel" id="usertel" autocomplete="off"><span id="div_usertel" class="other"></span>
        </div></td>
      </tr>
      <tr>
        <th><span><em>*</em> 管理密码：</span></th>
        <td><div>
                <input type="text" style="width:100px;color:#999;" class="fl default_color input_bg input_border_def" maxlength="20"  name="encode" id="encode" autocomplete="off" /><span id="div_encode" class="other"></span>
        </div></td>
      </tr>
      <tr>
        <th></th>
        <td>
            <input name="dosubmit" type="hidden"  value="true" />
            <input id="dosubmit" type="button" onclick="ue.sync();" name="" class="btnStyle"  value="" />
        </td>
      </tr>
    </table>
</form>
  <!--底部 这是新手引导效果的js-->
  
  <script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/jquery.dialog.iframetools.js" ></script>
  <link href="<?php echo APP_PATH;?>statics/default/css/esf/opera.css"  type="text/css" rel="stylesheet" />
  <script>
$(function(){
	//楼层
	var floortype = $('input[name=floortype]:checked').val();
	$(".floornum").hide();
	$(".floornum_" + floortype).show();
  	$('input[name=floortype]').click(function(){
		var floortype = $('input[name=floortype]:checked').val();
		$(".floornum").find("input").val('');
		$(".floornum").hide();
		$(".floornum_" + floortype).show();
	})
	
	/*当前行业*/
	var cur_bussines =  parseInt($('input[name=businessstatus]:checked').val());
	if(cur_bussines == 1 || cur_bussines == 2){
		$('#cur_industry').show();
	}else{
		$('#cur_industry').hide();
	}
	$('input[name=businessstatus]').click(function(){
		var cur_status = parseInt($(this).val());
		if(cur_status == 1 || cur_status == 2){
			$('#cur_industry').show();
		}else{
			$('#cur_industry').hide();
		}
	})
	
	/*经营限制*/
	$("#restrict_3").click(function(){
		var restrictother = document.getElementById("restrictother");
		if(document.getElementById("restrict_3").checked == true){
			restrictother.disabled = false;
		}else{
			restrictother.disabled = true;
			$("#restrictother").val("");
		}
	});
})
</script></div>
<div style="clear:both"></div>
<?php include template("content","footer"); ?>
<div class="new-guide" id="fixed"></div>
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/new-guide.js" ></script>   
<script type="text/javascript" src="<?php echo APP_PATH;?>statics/default/js/esf/scroll.js" ></script>
<script>
	var myzbj=$("#tl_myzbj"),
		myzbjc=$("#tl_myzbj .more_con"),
		fuwu=$("#tl_fuwu"),
		fuwuc=$("#tl_fuwu .more_fuwu"),
		tl_nav=$("#tl_nav"),
		tl_navlist=$("#tl_nav .more_nav");
		//time_good=$("#time_good");
	myzbj.hover(function(){
		myzbjc.show();
	},function () {
		myzbjc.hide();
	});
	fuwu.hover(function(){
		fuwuc.show();
	},function () {
		fuwuc.hide();
	});
	tl_nav.hover(function(){
		tl_navlist.show();
	},function () {
		tl_navlist.hide();
	});
</script>
</body>
</html>