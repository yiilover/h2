<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>';echo L('preview');echo '</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0" align="center" >

<tr align="center" valign="middle">
	<td align="center" valign="middle">';if($r['type']=='code') {echo $data;}else {;echo '<script language=\'javascript\' src=\'';echo $path;;echo '\'></script>';};echo '</td>
</tr>
</table>
</body>
</html>';?>