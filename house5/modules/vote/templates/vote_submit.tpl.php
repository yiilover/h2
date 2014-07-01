<?php

defined('IN_ADMIN') or exit('No permission resources.');
;echo '<form style="border: medium none;" id="voteform';echo $subjectid;;echo '" method="post" action="{APP_PATH}index.php?s=vote/index/post&subjectid=';echo $subjectid;;echo '">
 <dl>
      <dt>';echo $subject;;echo '</dt>
      </dl>
<dl>
';
if(is_array($options))
{
$i=0;
foreach($options as $optionid=>$option){
$i++;
;echo '<dd>
&nbsp;&nbsp;<input type="radio" value="';echo $option['optionid'];echo '" name="radio[]" id="radio">
';echo $option['option'];;echo ' 
</dd>
';}};echo '<input type="hidden" name="voteid" value="';echo $subjectid;;echo '">
</dl> 
<p> &nbsp;&nbsp; <input type="submit" value="';echo L('submit');echo '" name="dosubmit" />    &nbsp;&nbsp; <a href="';echo SITE_PROTOCOL.SITE_URL;echo '/index.php?s=vote/index/result&id=';echo $subjectid;;echo '">';echo L('vote_showresult');echo '</a> </p>
</form>';?>