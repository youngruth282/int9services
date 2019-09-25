
<!-- Modal -->
<div class="modal fade modal-md" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel"> 【台北靈糧堂 組員資料登錄】 </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
    </div>
    <div class="modal-body" style="text-align:center;">
     <h5 id='showmsg1'>請確認資訊正確，<BR>送出後，資料將寄送通報給相關單位<BR>或按【回前】繼續編輯</h5>
     <h5 id='showmsg2' style='display:none'>已送出，傳送中，請稍候...</h5>
    </div>
    <div class="modal-footer">
        <a id='sendbtn0' class="btn btn-light" data-dismiss="modal">回前</a>
        <a id='sendbtn' class="btn btn-info" href="#" onclick='return submit_chk2();'>送出</a>
        <p id='showmsg3' style='display:none'></p>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

    function HideContent(d) {
        document.getElementById(d).style.display = "none";        
    }

    function ShowContent(d) {
        document.getElementById(d).style.display = "block";   
    }
    function submit_chk2(){
          document.getElementById('sendbtn0').style.display = "none"; 
          document.getElementById('sendbtn').style.display = "none"; 
          document.getElementById('showmsg1').style.display = "none"; 
          document.getElementById('showmsg2').style.display = "block"; 
          document.getElementById('form1').submit();
        }
</script>


