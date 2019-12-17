<?php
$msgArr=["Y"=>"<font size=4px>完成登記，待同工確認報名資格後，教會系統會自動發送「裝備課程報名成功通知信」電子郵件，表示您已報名成功。  <BR />請留意：<BR />您的電子信箱有可能因為擋信、設定問題無法順利收信，報名後三個工作天內未收到信，建議先查找是否被歸入垃圾信件，或直接來電教會分機8293洽詢是否報名成功。謝謝！</font>", 
"NC" => "很抱歉，<BR />找不到課程!", 
"ND" => "很抱歉，<BR />找不到此課程!或者已過報名日期，<BR />請確認後重新輸入！", 
"NP" => "很抱歉，<BR />此email尚未登記使用！", 
"NM" => "輸入資料不正確！<BR />找不到該學員，<BR />請確認後重新輸入！", 
"OK"=>"很抱歉，<BR />處理有誤", 
"ER"=>"很抱歉，驗證碼有誤"];

$msg=$msgArr[$m];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>台北靈糧堂_會友系統</title>
<script type="text/javascript" src="/services/func/js/jquery-1.3.1utf8.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Main Site -->
<link rel="stylesheet" href="/servicescss/llc-form.css">

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
