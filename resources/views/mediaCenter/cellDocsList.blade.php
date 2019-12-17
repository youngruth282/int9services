<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主日信息小組材料</title>
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
<p><b>裝備中心主日信息小組材料管理系統</b> -- 上傳</p>
<table width=650 CELLSPACING=1 CELLPADDING=1 border=0 class=MsgList>
<tr>
<td bgcolor="#B9DCB9"></td>
<td bgcolor="#B9DCB9" nowrap>日期</td>
<td bgcolor="#B9DCB9">講　題</td>
<td bgcolor="#B9DCB9">講　員</td>
<td bgcolor="#B9DCB9"></td>
<td bgcolor="#B9DCB9"></td>
<!--<td bgcolor="#B9DCB9"></td>-->
</tr>
<?php
$num=0;
?>
@foreach($cdocs as $cdoc)
              <tr>
              <td>{{ $num+1 }}</td>
              <td>{{ $cdoc->wdate }}</td>
              <td>{{ $cdoc->wtitle }}</td>
              <td>{{ $cdoc->wauther }}</td>
              <?php
              /* define("UPLOAD_Equip_REALPATH", "/var/www/html/services/storage/app/public/celldocs"); */
              $fname=date("ymd", strtotime($cdoc->wdate)).".docx";
              /* $fname = public_path()."/celldocs/W".$fname.".docx";
              dd(storage_path()); */
              $fname1 = "/var/www/html/services/storage/app/public/celldocs/W".$fname;
              $fname2 = "/services/storage/celldocs/W".$fname;
              ?>
              @if (file_exists($fname1))
              <td>
              <a href="{{ $fname2 }}">下載</a>
              </td>
              <td>
              <a href="{{ route('services.clearFile', [$cdoc->wdate, $cdoc->wid] )}}">刪除</a></td>
              </td>
              @else
              <td>
              <font color="#cccccc">空白</font>
              </td>
              <td>
              <a href="#" onclick="window.open('{{ route('services.upload', [$cdoc->wdate, $cdoc->wid])}}', 'breadoflife', config='location=no,toolbar=no,location=0,toolbar=0,height=300,width=500')">上傳</a></td>
              </td>
              @endif
              <?php
              $num++;
              ?>
@endforeach
              </tr>
              <tr>
<td bgcolor="#B9DCB9"></td>
<td bgcolor="#B9DCB9" nowrap>日期</td>
<td bgcolor="#B9DCB9">講　題</td>
<td bgcolor="#B9DCB9">講　員</td>
<td bgcolor="#B9DCB9"></td>
<td bgcolor="#B9DCB9"></td>
<!--<td bgcolor="#B9DCB9"></td>-->
</tr>
</table>

</Center>
</body>
</html>
