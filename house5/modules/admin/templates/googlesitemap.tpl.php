<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<div class="pad_10">
<div class="table-list">
<form method="post" name="myform" id="myform" action="?s=admin/googlesitemap/set">
<input type="hidden" name="tabletype" value="house5tables" id="house5tables">
<table width="100%" cellspacing="0">
<thead>
  	<tr>
    	<th class="tablerowhighlight" colspan=2>';echo L('google_info');echo '</th>
  	</tr>
</thead> 
	<tr> 
      <td align="right" width="100">';echo L('explain');echo ': </td> 
      <td> 
';echo L('google_infos');echo ' </td> 
    </tr>
</table>     

<table width="100%" cellspacing="0">    
<thead>
  	<tr>
    	<th class="tablerowhighlight" colspan=2>';echo L('google_sitemaps');echo '</th>
  	</tr>
</thead> 
  	<tr>
	    <td align="right" width="100"> ';echo L('google_rate');echo ' : </td>
	    <td colspan=1>
		    <select name="content_priority">
		    <option value="1">1</option><option value="0.9">0.9</option>
		    <option value="0.8">0.8</option><option selected="" value="0.7">0.7</option>
		    <option value="0.6">0.6</option><option value="0.5">0.5</option>
		    <option value="0.4">0.4</option><option value="0.3">0.3</option>
		    <option value="0.2">0.2</option><option value="0.1">0.1</option>
		    </select>
		    <select name="content_changefreq">
		    <option value="always">';echo L('google_update');echo '</option><option value="hourly">';echo L('google_hour');echo '</option>
		    <option value="daily">';echo L('google_day');echo '</option><option selected="" value="weekly">';echo L('google_week');echo '</option>
		    <option value="monthly">';echo L('google_month');echo '</option><option value="yearly">';echo L('google_year');echo '</option>
		    <option value="never">';echo L('google_noupdate');echo '</option>
		    </select>
	    </td>
  	</tr>
   	<tr>
    <td  align="right">';echo L('google_nums');echo ' : </td>
    <td colspan=3>  
    <input type=text name="num" value="20" size=5>
    </td>
  	</tr> 
</table>

<table width="100%" cellspacing="0">    
<thead>
  	<tr>
    	<th class="tablerowhighlight" colspan=2>';echo L('google_baidunews');echo '</th>
  	</tr>
</thead> 
<tr>
	    <td  align="right">';echo L('google_ismake');echo ' : </td>
	    <td colspan=1><input type="radio" name="mark" value="1" checked> ';echo L('setting_yes');echo ' &nbsp; <input type="radio" name="mark" value="0"> ';echo L('setting_no');echo ' &nbsp;</td>
  	</tr>
  	
  	<tr>
	    <td align="right" width="100"> ';echo L('google_select_db');echo ' : </td>
<td colspan=1>
<select name=\'catids[]\' id=\'catids\'  multiple="multiple"  style="height:200px;" title="';echo L('push_ctrl_to_select','','content');;echo '">
';echo $string;;echo '</select>

</td>
  	</tr> 
  	
  	<tr>
	    <td align="right" width="100"> ';echo L('google_period');echo ' : </td>
	    <td colspan=1><input type=text name="time" value="40" size=20> </td>
  	</tr>
  	<tr>
	    <td align="right" width="100"> Email : </td>
	    <td colspan=3><input type=text name="email" value="house5@house5.net" size=20></td>
  	</tr>
  	<tr>
	    <td align="right" width="100"> ';echo L('google_nums');echo ' : </td>
	    <td colspan=3><input type=text name="baidunum" value="20" size=5> </td>
  	</tr>
   	 
  	<tr>
    	<th class="tablerowhighlight" colspan=2>
    	<br>
    	<input type="submit" name="dosubmit" value=" ';echo  L('google_startmake');echo ' " class="button">
    	<br>
    	</th>
  	</tr>
</table>  
</form>
</div>
</div> 
</body> 
</html>
';?>