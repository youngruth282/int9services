<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="/favicon.ico"/>
<link rel="bookmark" href="/favicon.ico"/>

<title>台北靈糧堂_裝備課程</title>
<script type="text/javascript" src="jquery-1.3.1utf8.min.js"></script>
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
    background-color: #FFCC00;/*e9601a;*/
    color: #000;/*fff;*/
    line-height: 10px;
    width: 80px;
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
{!! Form::open(array('route' => 'services.store','method'=>'POST')) !!}
    {{ Form::hidden('no',  $tran_no ) }}
    {{ Form::hidden('id2', $tran_id2 ) }}
    {{ Form::hidden('nid', $tran_nid ) }}
    <div class="form-group">
      <label for="email">Email</label>
      {!! Form::text('email',  old('email'), ['id'=>'code', 'placeholder' => '請輸入您已註冊的Email','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:40']) !!}
    </div><!-- end of form-group -->
    <div class="form-group">
      <label for="id">身份證末四碼</label>
      {!! Form::text('id4',  old('id4'), ['id'=>'id4', 'placeholder' => '請輸入您的身份證末四碼','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:4']) !!}
      <div id=id4error></div>
    </div><!-- end of form-group -->
    <div class="row justify-content-start mt-2 text-center">
            <div class="col">
                <img src="{{captcha_src('mission')}}" onclick="this.src='/captcha/mission?'+Math.random()" id="captchaCode" alt="" class="captcha">
                <a rel="nofollow" href="javascript:;" onclick="document.getElementById('captchaCode').src='captcha/mission?'+Math.random()" class="reflash"></a>
                <input class="tt-text" id="captcha" name="captcha" class="form-control" placeholder="請輸入左側驗證數碼" required onBlur="this.value=cleanString('', 'half', 'trim', this.value);" maxlength=3>
                @if ($errors->has('captcha'))
                  <span class="help-block">
                      <strong style='font-size:12px' class='text-danger'>錯誤，{{ $errors->first('captcha') }}!!</strong>
                  </span>
                @endif                        
            </div>
           </div>
    <div class="form-group">
      <label for="code">驗證碼</label>
      <div class="row">
        <div class="col-xs-6">
          {!! Form::text('code', null, ['id'=>'code', 'placeholder' => '','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:3']) !!}
        </div>
        <div class="col-xs-6">
<table><tr><td>
	  <div alt="點此刷新驗證碼" name="verify_code" width="120" height="60" border="0" id="verify_code" style="cursor:pointer;" class="rounded" /></div>
	<span id=vcode></span>
	  </td><th>為安全考量<BR>請輸入<BR>所顯示數字</th></tr></table>
        <div id="codeerror"></div>
        <div id="dataerror"></div>
	  </div>
	  </div>
      </div>
    </div><!-- end of form-group -->
    <div style="margin-top:35px">
    {{ Form::submit('送出', ['id' => 'submit_btn', 'class' => 'btn btn-orange','style'=>'height:60px']) }}
    <!-- <input style="margin-top: 1em" type="button" value="送出" class="btn btn-orange" id="tosubmit" /> -->
    </div>
  </form>
</body>
</html>

<script type="text/javascript">
//<![CDATA[
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form1').on('submit', function(e){
         e.preventDefault();
         var email=$('#email').val();
         var id4=$('#id4').val();
         var code=$('#code').val();
         if (email=="" || id4=="" || code=="") return false;
         $('#submit_tbn').hide();
         var data = $(this).serialize();
         console.log(data);
         $.ajax({
             type : "POST",
             url : "{{ route('services.check') }}"
             data : data, 
             dataTy : 'json',
             success: function(data)
             {
              if (response==0){
                      alert("該時段已被借用，請重新選擇");
                    }else{
                      alert("OK");
                    }
             }
         })
     })
     //]]>
</script>
