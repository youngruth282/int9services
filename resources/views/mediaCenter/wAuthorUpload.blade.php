<?php
define("UPLOAD_WAP_PATH", "/WAuthor");//int2

define("UPLOAD_WAP_URL", "/WAuthor");//15
define("UPLOAD_WAP_REALPATH", "/WAuthor");//int2

$WAP_width=300;
$WAP_height=180;
$WAPL_width=400;
$WAPL_height=390;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>崇拜信息講員照片上傳</title>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<p>&nbsp;</p>
<p><b>崇拜信息管理系統</b></p>
<div class="row" style="width:400px;padding:1px;background-color: #CEE;border-radius: 5px;">
<p>{{ $wdate }}崇拜信息<BR>講員照片 -- 上傳</p>


<div class="row">
{!! Form::open(['route'=>'services.savePict','files' => 'true','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('wid', $wid, ['class' => 'form-control']) !!}
{!! Form::hidden('wno', $wno, ['class' => 'form-control']) !!}
{!! Form::hidden('wdate', $wdate, ['class' => 'form-control']) !!}
<table border="0" cellspacing="1" cellpadding="0" width="90%" bgcolor="#AAAAAA">
<tr>
<td bgcolor="#FFFFFF" align=center>
	<table border="0" cellspacing="2" cellpadding="2" width="100%">
		<TR>
			<TD ALIGN=center bgcolor="#E4E4E4">照片檔名</TD>
			<TD><font color="#555555">尺寸：<font color=red><b><?=$WAP_width?> X <?=$WAP_height?></b></font>
			，上傳存於 <?=UPLOAD_WAP_PATH?> </font>
			<br>{{ Form::file('wauthor') }}
			<br><font color=red>檔案大小不超過10K</font></TD>
		</TR>
		<TR>
			<TD ALIGN=center bgcolor="#E4E4E4">照片(大)檔名</TD>
			<TD><font color="#555555">尺寸：<font color=red><b><?=$WAPL_width?> X <?=$WAPL_height?></b></font>
			，上傳存於 <?=UPLOAD_WAP_PATH?> </font>
			<br>{{ Form::file('wauthorL') }}
			<br><font color=red>檔案大小不超過10K</font></TD>
		</TR>
	</table>
</td>
</tr>
</table>

      <div class="col-lg-11 text-center" style="margin:20px ;">
            {{ Form::button('取消', array('class' => 'btn btn-secondary', 'onclick' => "window.close()")) }}
            {{ Form::submit('上傳檔案', array('class' => 'btn btn-primary')) }}
      </div>
</div>
{!! Form::close() !!}
            </div>

</Center>
</body>
</HTML>
