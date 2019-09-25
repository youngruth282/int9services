<?php
// $msgArr=array("0"=>"驗證碼錯誤！","1"=>"抱歉，沒有權限","2"=>"抱歉，權限尚未開啟，<BR>請洽牧區幹事！", "3"=>"平安！<BR>您若要更改個人資料，請洽小組長或牧區幹事！<BR>感謝您！", "4"=>"抱歉，資料不正確！", "5"=>"抱歉，資料重複！", "D2"=>"我們之前已收到您的回覆，已通知小組長處理。<BR>若有任何其他需要，請與您的小組長連絡。<BR>感謝您，願神賜福您！","OK"=>"感謝您的回覆，願神賜福您！");

$msgArr=["N2" => "平安！<BR>我們之前已收到您的回覆，已通知小組長處理。<BR>您若要更改個人資料，或有任何其他需要，請洽小組長或牧區幹事！<BR>感謝您！願神賜福您！", "NQ"=>"感謝您的回覆，願神賜福您！", "NS"=>"抱歉，權限尚未開啟，<BR>請洽牧區幹事！", "SS"=>"抱歉，權限尚未開啟，<BR>請洽牧區幹事！", "S2"=>"這個身分帳號已登入，<BR>請洽牧區幹事！", "Y"=>"<font size=4px>完成登記，感謝您的回覆，願神賜福您！</font>", "OK"=>"很抱歉，<BR />處理有誤"];
$msg=$msgArr[$m];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>台北靈糧堂_會友系統</title>
<script type="text/javascript" src="../func/js/jquery-1.3.1utf8.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Main Site -->
<link rel="stylesheet" href="css/llc-form.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
 
div.rounded {
    background-color: #00FFCC;/*e9601a;*/
    color: #000;/*fff;*/
    padding: 15px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
 font-family: Tahoma, Geneva, sans-serif;
 font-size: 1.5em;
 word spacing: 12pt;
 letter-spacing: 3px;
}

div.rounded2 {
    background-color: #e9601a;/*e9601a;*/
    color: #FFF;/*fff;*/
    padding: 15px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
 font-family: Tahoma, Geneva, sans-serif;
 font-size: 1.5em;
 word spacing: 12pt;
 letter-spacing: 3px;
}
</style>
<body>
    <div class="<?=$class?>" style="margin:40px 40px">
      <?php echo $msg;?>
    </div>
    
</body>
</html>
