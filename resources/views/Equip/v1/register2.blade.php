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
<body>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
  <div id="showmsg"></div>
</div>
{!! Form::open(array('route' => 'services.check2','method'=>'POST')) !!}
    {{ Form::hidden('no',  $tran_no ) }}
    {{ Form::hidden('id2', $tran_id2 ) }}
    {{ Form::hidden('nid', $tran_nid ) }}
    <div class="form-group">
      <label for="email">Email</label>
      {!! Form::text('email',  old('email'), ['id'=>'code', 'placeholder' => '請輸入您已註冊的Email','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:40']) !!}
      @if ($errors->has('email'))
        <span class="help-block">
            <strong style='font-size:12px' class='text-danger'>錯誤，格式錯誤!!</strong>
        </span>
      @endif                        
    </div><!-- end of form-group -->
    <div class="form-group">
      <label for="id">身份證末四碼</label>
      {!! Form::text('id4',  old('id4'), ['id'=>'id4', 'placeholder' => '請輸入您的身份證末四碼','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:4']) !!}
      @if ($errors->has('id4'))
        <span class="help-block">
            <strong style='font-size:12px' class='text-danger'>錯誤，格式錯誤!!</strong>
        </span>
      @endif                        
    </div><!-- end of form-group -->
    <div class="form-group">
      <label for="code">驗證碼</label>
        <img src="{{captcha_src('mission')}}" onclick="this.src='/services/captcha/mission?'+Math.random()" id="captchaCode" alt="" class="captcha">
        <a rel="nofollow" href="javascript:;" onclick="document.getElementById('captchaCode').src='/services/captcha/mission?'+Math.random()" class="reflash"></a>
        <input class="tt-text" id="captcha" name="captcha" class="form-control" placeholder="請輸入左側驗證數碼" required>
        @if ($errors->has('captcha'))
          <span class="help-block">
              <strong style='font-size:12px' class='text-danger'>錯誤!!</strong>
          </span>
        @endif                        
    </div><!-- end of form-group -->
    <div style="margin-top:35px">
    {{ Form::submit('送出', ['id' => 'submit_btn', 'class' => 'btn btn-success']) }}
    <!-- <input style="margin-top: 1em" type="button" value="送出" class="btn btn-orange" id="tosubmit" /> -->
    </div>
  {!! Form::close() !!}
</body>
</html>

