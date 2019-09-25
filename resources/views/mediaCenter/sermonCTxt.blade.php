<?php
// http://www.llc.org.tw/mediaCenter/Details.php?W=W2&D=2019/09/08
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>詳細內容</title>
<style type="text/css">
<!--
body {
	background: url(images/bg.png) repeat;
	font-family: "Droid Sans", Helvetica, Arial, sans-serif;
	margin-top: 0px;
}

#bible {
color: #FFFFFF;
}
#bible h3 {
	text-transform: uppercase;
	padding: 0 0 5px 0;
	border-bottom: 1px dotted #ccc;
	margin: 10px 0 20px 0;
	color: #FFFFFF;}
	

#outline {
	line-height: 25px;
	color:#333;
}

#in {
	line-height: 25px;
	color:#333;
}


h3 {
    font-family: 'Droid Sans', sans-serif;
	text-transform: uppercase;
	padding: 0 0 5px 0;
	border-bottom: 1px dotted #ccc;
	margin: 10px 0 20px 0;
	color:#333;
}
.details_title {color: #FFFFFF}
.details_day {font-size: 12px; color: #ccc;}
	
-->
</style></head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/services/css/web.css" type="text/css">
<script language=javascript src="../func/js/web.js"></script>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<table width="90%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="120" bgcolor="3b3b3b"><p class="details_title"><strong>{{ $wactiv->wtitle }}</strong></p>
    <span class="details_day">日期： {{ $wactiv->wdate }}　│　講員：{{ $wactiv->wauther }}</span></td>
  </tr>
  @if ($BString1)
  <tr>
    <td bgcolor="#3b3b3b"><table width="100%" bgcolor="#3b3b3b" border="0" align="center" cellpadding="5" cellspacing="0" id="bible">
      <tr>
        <td colspan="2"><B>經文：</B> {!! $BString1 !!}</td>
        </tr>
					<tr>
						<td align=center colspan="2">
		<table border="0" cellspacing="2" align=center cellpadding="0"  width=95%  class="smallTxt">
        @for ($j=0;$j<$i;$j++)
            <tr>{!! $bible_content[$j] !!}</tr>
        @endfor
		</table>
						</td>
					</tr>
    </table></td>
  </tr>
  @endif
</table>
<br />
<table width="90%" border="0" align="center" cellpadding="15" cellspacing="0" bgcolor="#FFFFFF" id="outline">
      <tr><td><h3>大綱</h3></td></tr>
		<tr><td><table width=90% align=center border=0><tr align=left><td>{!! nl2br($wacont->wcontent) !!}</td></tr></table></td>
      </tr>
</table>
<p><a href="javascript:window.close();">關閉</a></p>
</center>
</body>
</html>
