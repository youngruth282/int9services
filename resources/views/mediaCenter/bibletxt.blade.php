<html>
<head>
<title>中文和合本聖經經文</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../func/css/web.css" type="text/css">
<script language=javascript src="../func/js/web.js"></script>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<table border="0" cellspacing="1" cellpadding="0" align="center" width=95% bgcolor="#FF8040">
	<tr>
		<td align=center bgcolor="#FFFFFF" height=30><img src="/services/picture/mark/icon_02.gif"> <font color="#FF8040"><b>　中　文　和　合　本　聖　經　經　文　</b></font> <img src="/services/picture/mark/icon_02.gif"></td>
	</tr>
	<tr>
		<td bgcolor="#FF8040"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
		<table border="0" cellspacing="2" cellpadding="0" align="center" width=95%  class="smallTxt">
@foreach ($ctexts as $ctext)
			<tr>
				<td valign=top align=center nowrap><font color="#FF8040">{{ $ctext->BibleCode->cname }}<br><b>{{ $ctext->chapter }} : {{ $ctext->number }}</b></font></td>
				<td valign=top>{{ $ctext->ctext }}</td>
			</tr>
			<tr>
				<td colspan=2 bgcolor="#CCCCCC"></td>
			</tr>
@endforeach
		</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FF8040"></td>
	</tr>
</table>
<p><a href="javascript:window.close();">關閉</a></p>
</center>
</Body>
</Html>
