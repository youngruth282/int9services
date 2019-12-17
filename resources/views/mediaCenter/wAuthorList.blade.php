<?php
define("UPLOAD_WAP_PATH", "/WAuthor");//int2

define("UPLOAD_WAP_URL", "https://int9.bolcc.taipei/services/storage/celldoc");//15
define("UPLOAD_WAP_REALPATH", "/var/www/html/serivces/storage/celldoc");//int2

$WAP_width=300;
$WAP_height=180;
$WAPL_width=400;
$WAPL_height=390;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>崇拜信息講員照片</title>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<p>&nbsp;</p>
<p><b>崇拜信息管理系統</b></p>
<div class="row" style="width:{{ ($WAPL_width+10) }};padding:1px;">
<p>{{ $wdate }}崇拜信息<BR>講員照片</p>


<div class="row">
<table border="0" cellspacing="1" cellpadding="0" width="{{ ($WAPL_width+10) }}" bgcolor="#AAAAAA">
<tr>
<td bgcolor="#FFFFFF" align=center>
	<table border="0" cellspacing="2" cellpadding="2" width="{{ ($WAPL_width+10) }}">
		<TR>
			<TD ALIGN=center bgcolor="#E4E4E4">照片</TD>
			<TD><font color="#555555">尺寸：<font color=red><b><?=$WAP_width?> X <?=$WAP_height?></b></font>
			，上傳存於 {{ UPLOAD_WAP_REALPATH.'/'.$fileNameToStore }} </font>
			<img src='{{ UPLOAD_WAP_URL.'/'.$fileNameToStore }}' width='<?=$WAP_width?>'>
		</TD>
		</TR>
		<TR>
			<TD ALIGN=center bgcolor="#E4E4E4">大照片</TD>
			<TD><font color="#555555">尺寸：<font color=red><b><?=$WAPL_width?> X <?=$WAPL_height?></b></font>
			，上傳存於 {{ UPLOAD_WAP_REALPATH.'/'.$fileNameToStore2 }} </font>
			<img src='{{ UPLOAD_WAP_URL.'/'.$fileNameToStore2 }}' width='<?=$WAPL_width?>'>
			</TD>
		</TR>
	</table>
</td>
</tr>
</table>

      <div class="col-lg-11 text-center" style="margin:20px ;">
            {{ Form::button('關閉', array('class' => 'btn btn-secondary', 'onclick' => "window.close()")) }}
      </div>
</div>
            </div>

</Center>
</body>
</HTML>
