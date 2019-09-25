@extends('layouts.master')
@section('title', '台北靈糧堂_裝備課程')

@section('content')

@if (count($errors) > 0)
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <div class="alert alert-danger">
            <strong>抱歉!</strong> 資料有錯誤，請填妥後重送，謝謝。<br><br>
        </div>
    </div>
@endif

<!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
  <div id="showmsg"></div>
</div> -->
{{ Form::open(['route' => 'services.check', 'method'=>'POST', 'id' => 'form1']) }}
    {{ Form::hidden('no',  $tran_no) }}
    {{ Form::hidden('id2', $tran_id2) }}
    {{ Form::hidden('nid', $tran_nid) }}
    <div class="form-group">
      <label for="email">Email</label>
      {{ Form::text('email',  old('email'), ['id'=>'email', 'onfocus' => 'clearmsg()', 'placeholder' => '請輸入您已登記的Email','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:40']) }}
      @if ($errors->has('email'))
        <span class="help-block">
            <!-- <strong style='font-size:12px' class='text-danger'>錯誤，格式錯誤!!</strong> -->
        </span>
      @endif                        
    </div><!-- end of form-group -->
    <div class="form-group">
      <label for="id">身份證末四碼</label>
      {{ Form::number('id4',  old('id4'), ['id'=>'id4', 'onfocus' => 'clearmsg()', 'placeholder' => '請輸入您的身份證末四碼','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:4']) }}
      @if ($errors->has('id4'))
        <span class="help-block">
            <!-- <strong style='font-size:12px' class='text-danger'>錯誤，格式錯誤!!</strong> -->
        </span>
      @endif                        
    </div><!-- end of form-group -->
    <div class="form-group">
      <label for="code">驗證碼</label>
        <img src="{{captcha_src('mission')}}" onclick="this.src='/services/captcha/mission?'+Math.random()" id="captchaCode" alt="" class="captcha">
        <a rel="nofollow" href="javascript:;" onclick="document.getElementById('captchaCode').src='/services/captcha/mission?'+Math.random()" class="reflash"></a>
        <!-- <input class="tt-text" id="captcha" name="captcha" class="form-control" placeholder="請輸入左側驗證數碼" required> -->
        {{ Form::number('captcha',  null, ['id'=>'captcha', 'onfocus' => 'clearmsg()', 'placeholder' => '請輸入左側驗證數碼','class' => 'form-control tt-text', 'requried'=>'required', 'style' => 'maxlength:3']) }}
        @if ($errors->has('captcha'))
          <span class="help-block">
              <!-- <strong style='font-size:12px' class='text-danger'>錯誤!!</strong> -->
          </span>
        @endif                        
    </div><!-- end of form-group -->
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <div class="alert alert-danger" style="display:none" id="show_msg">
            
        </div>
    </div>

    <div style="margin-top:35px">
    {{ Form::button('送出', ['id' => 'submit_btn',  'onclick'=>"checkSel()", 'class' => 'btn btn-primary']) }}
    <!-- <input style="margin-top: 1em" type="button" value="送出" class="btn btn-orange" id="tosubmit" /> -->
    </div>
  {{ Form::close() }}
<script type="text/javascript">
    function clearmsg(){
        $("#show_msg").html('').hide();
    }

  	function checkSel()
    {
      // clearmsg();

      var errmsg = '';
      if ($("#email").val()==''){
        errmsg += '請輸入您的Email<BR>';
      }else if (IsEmail($("#email").val())==false){
        errmsg += 'email 格式錯誤<BR>';
      }
      if ($("#id4").val()==''){
        errmsg += '請輸入您的身份證末四碼<BR>';
      }else{
          len =$("#id4").val().length;
          if (len != 4 ){
              errmsg += '請正確輸入您的身份證末四碼<BR>';
          }
      }
      if ($("#captcha").val()==''){
        errmsg += '請輸入驗證碼<BR>';
      }else{
          len =$("#captcha").val().length;
          if (len != 3 ){
              errmsg += '請正確輸入驗證碼<BR>';
          }
      }
        if (errmsg != ''){
          $("#show_msg").html("【錯誤訊息】<BR>"+errmsg).show();
    			return false;
        }else $("#form1").submit();
    }
    function IsEmail(email) { 
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
        return false;
      }else{
        return true;
      }
    }

</script>

@endsection
