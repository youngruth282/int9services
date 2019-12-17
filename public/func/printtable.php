<?php
/*2006/1/9 下午 02:08:37
轉載自 http://timteam.org/?TIM=DEVELOPER&DocID=16&ROOT_ID=1&SHOWID=45 

網頁預覽列印、設定列印功能 

代碼: 
這是常用分頁列印，以及Web設定印表機，預覽列印，以及設定列印功能。 */
?>
<script> 
var tag = 'H1'; // 內定以標籤<H1>為分頁開頭 
function printpage(tag){ 
var coll = document.all.tags(tag); 
for (i=0; i<coll.length; i++) { 
coll(i).style.pageBreakBefore = "always"; 
} 
} 
</script>

<object id="WebBrowser" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object> 
<A HREF=# onclick="javascript:WebBrowser.ExecWB(6,1)">設定印表機</A> 
<A HREF=# onclick="javascript:WebBrowser.ExecWB(7,1)">預覽列印</A> 
<A HREF=# onclick="javascript:WebBrowser.ExecWB(8,1)">設定列印</A> 
<A HREF=# onclick="javascript:printpage('H1')">設定換頁列印</A> 
