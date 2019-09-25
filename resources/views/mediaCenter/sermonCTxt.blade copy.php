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
<link rel="stylesheet" href="../func/css/web.css" type="text/css">
<script language=javascript src="../func/js/web.js"></script>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<?php
$dbnameBK="pgDBS";
	include_once("web.config.php");
	include_once("_config.php");

	include_once(ROOT_REALPATH."/func/phpfunc.php");
	include_once(ROOT_REALPATH."/func/psql.inc.php");
	$sermonArray=array("6"=>"S", "8"=>"M", "10"=>"T", "16"=>"K", "24"=>"Y", "15"=>"E");
	$sermonVal=array_values($sermonArray);
	$sermonKey=array_keys($sermonArray);
	$WCode = quote_smart($_GET["W"]);
	$WDate = quote_smart($_GET["D"]);

	$sql_str = "select A.WTitle,A.WAuther,B.WName,C.WContent, A.WNo";
	$sql_str.= " from WActivity A left join WAType B on A.WNo=B.WNo left join WAContent C";
	$sql_str.= " on A.WNo=C.WNo and A.WDate=C.WDate where B.WCode='$WCode'";
	$sql_str.= " and A.WDate='$WDate'";
	$rs2=select_sql($sql_str, $dbname);

	if ($rs2) {
		$fd=$rs2[0];
		$WTitle=$fd[0];
		$WAuther=$fd[1];
		$WName=$fd[2];
		$WContent=$fd[3];
		$WNo=$fd[4];
	
				$sql_str = "select A.CName,B.BibleNo,B.SChapter,";
				$sql_str.= "B.SNumber,B.EChapter,B.ENumber";
				$sql_str.= " from BibleCode A,WABible B";
				$sql_str.= " where B.WNo=$WNo";
				$sql_str.= " and B.WDate='$WDate'";
				$sql_str.= " and A.BibleNo=B.BibleNo";

				$rs1=select_sql($sql_str, $dbnameBK);
	$bible_content="";
	$BString1="";
				for ($ro1=0;$ro1<sizeof($rs1);$ro1++) {
					$fd1=$rs1[$ro1];
					$BCName=$fd1[0];
					$BNo=$fd1[1];
					$Sch=$fd1[2];
					$Snu=$fd1[3];
					$Ech=$fd1[4];
					$Enu=$fd1[5];
					$BString1 .= "<font color=\"#FF8040\"><b>".$BCName.NtoC($Sch).$Snu."~";
					if ($Sch==$Ech)
						$BString1 .= $Enu;
					else
						$BString1 .= NtoC($Ech).$Enu;
					$BString1 .= "</b></font>";
	$sql_str = "select A.CName,B.Chapter,B.number,B.CText";
	$sql_str.= " from BibleCode A,CBible B";
	$sql_str.= " where A.BibleNo=B.BibleNo and B.BibleNo='$BNo'";
	if ($Sch == $Ech) {
		$sql_str.= " and B.Chapter=$Sch and B.Number between $Snu and $Enu";
	} elseif ($Ech-$Sch == 1) {
		$sql_str.= " and ((B.Chapter=$Sch and B.Number>=$Snu";
		$sql_str.= ") or (B.Chapter=$Ech and B.Number<=$Enu))";
	} else {
		$sql_str.= " and ((B.Chapter=$Sch and B.Number>=$Snu";
		$sql_str.= ") or (B.Chapter=$Ech and B.Number<=$Enu)";
		$sql_str.= " or B.Chapter between ".($Sch+1)." and ".($Ech-1).")";
	}
	$sql_str.= " order by B.Chapter,B.Number";

	$rs_txt=select_sql($sql_str,$dbnameBK);
	for ($ro=0;$ro<sizeof($rs_txt);$ro++) {
		$fd_txt=$rs_txt[$ro];
		$CName=$fd_txt[0];
		$Chapter=$fd_txt[1];
		$Number=$fd_txt[2];
		$CText=$fd_txt[3];
		$bible_content.="<tr><td valign=top nowrap><font color=\"#FF8040\"><b>".$Chapter." : ".$Number."</b></font></td>";
		$bible_content.="<td valign=top align=left>".$CText."</td></tr><tr><td colspan=2 bgcolor=\"#CCCCCC\"></td></tr>";
	}
	$bible_content.="<tr><td colspan=2><hr></td></tr>";
				}
?>
<table width="90%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="120" bgcolor="3b3b3b"><p class="details_title"><strong><?php echo $WTitle;?></strong></p>
    <span class="details_day">日期： <?=$WDate?>　│　講員：<?php echo $WAuther;?></span></td>
  </tr>
<?php
if ($BString1){?>
  <tr>
    <td bgcolor="#3b3b3b"><table width="100%" bgcolor="#3b3b3b" border="0" align="center" cellpadding="5" cellspacing="0" id="bible">
      <tr>
        <td colspan="2"><B>經文：</B> <?=$BString1?></td>
        </tr>
					<tr>
						<td align=center colspan="2">
		<table border="0" cellspacing="2" align=center cellpadding="0"  width=95%  class="smallTxt">
<?=$bible_content?>

		</table>
						</td>
					</tr>
    </table></td>
  </tr>
<?}?>
</table>
<br />
<?php
if ($WContent){?>
<table width="90%" border="0" align="center" cellpadding="15" cellspacing="0" bgcolor="#FFFFFF" id="outline">
      <tr><td><h3>大綱</h3></td></tr>
		<tr><td><table width=90% align=center border=0><tr align=left><td><?php echo nl2br($WContent);?></td></tr></table></td>
      </tr>
</table>
<?}
}?>
<p><a href="javascript:window.close();">關閉</a></p>
</center>
</body>
</html>
