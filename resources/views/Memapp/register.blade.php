@extends('layouts.master')
@section('title', '台北靈糧堂_組員資料登錄')

@section('content')

@include('Memapp.sendConfirmModal')
@include('Memapp.alertModal')
<style>
	div.rounded {
		background-color: #FFCC00;/*e9601a;*/
		color: #000;/*fff;*/
		line-height: 10px;
		width: 100px;
		padding: 15px;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 1.5em;
		// word spacing: 12pt;
		letter-spacing: 3px;
	}
</style>

	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="/services/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom and plugin javascript -->
	<link href="/services/css/custom.css" rel="stylesheet">
	<link href="/services/css/font-awesome.css" rel="stylesheet">
	<!-- Custom Theme files -->
	<link href="/services/css/style.css" rel='stylesheet' type='text/css' />
	<link href="/services/css/sh_style.css" rel='stylesheet' type='text/css' />

    {!! Form::open(['route' => 'services.memsend','method'=>'POST', 'id' => 'form1']) !!}
    {{ Form::hidden('A', $tid ) }}
    {{ Form::hidden('B', $mlid ) }}
    {{ Form::hidden('C', $req_id ) }}
	<div class="register gray-bg dashbard-1" style="max-width:80%;margin:0 auto;">
		<div class="col-md-12 title purple">
			<h2><img src="/services/logo-w.png" width=40px>　台北靈糧堂 組員資料登錄</h2>
		</div>
        @if (count($errors) > 0)
		<div class="col-md-12 text-center alert alert-danger">
            @if ($errors->has('reg_name'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，姓名長度錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_email'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，電子信箱格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_pid'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，身分證號格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_sex'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，性別格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_birth'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，生日格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_mobil'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，行動電話格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_zip'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，郵遞區號錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('reg_address'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，聯絡地址格式錯誤!!</strong>
                </span>
            @endif                        
            @if ($errors->has('captcha'))
                <span class="help-block">
                    <strong style='font-size:12px' class='text-danger'>錯誤，驗證碼錯誤!!</strong>
                </span>
            @endif                        
            <strong>抱歉!</strong> 資料有錯誤，請填妥後重送，謝謝。
		</div>
        @endif
		<!--主要內容start-->
		<div class="grid_3 grid_5">
			<div class="bs-example">
					<div class="txt_s_18">
						<p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" ><font color=red>*</font>牧 區</label>
                            <div class="col-lg-3 col-md-3 control-label">{{ $team[0]['area_name'] }}
                            </div>
                            <label style="text-align: right;" class="col-lg-3 col-md-3 control-label" ><font color=red>*</font>小 組</label>
                            <div class="col-lg-3 col-md-3 control-label">{{ $team[0]['team_name'] }}
                            </div>
                        </div></p>
						<p><div class="row control-group">
							<label style="text-align: right;" class="col-lg-2 col-md-2 control-label" ><font color=red>*</font>組員姓名</label>
							<div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_name',  $memapp[0]['newmem_name'], ['id'=>'reg_name', 'onfocus' => 'clearmsg()',  'placeholder' => '請輸入您的姓名','class' => 'form-control txt_s_18', 'requried'=>'required', 'style' => 'maxlength:30']) !!}
							</div>
							<label style="text-align: right;" class="col-lg-3 col-md-3 control-label" ><font color=red>*</font>身份證字號</label>
							<div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_pid',  $memapp[0]['reg_pid'], ['id'=>'reg_pid', 'onfocus' => 'clearmsg()', 'placeholder' => '身份證字號','class' => 'form-control txt_s_18', 'requried'=>'required', 'style' => 'maxlength:10']) !!}
                            </div>
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" ><font color=red>*</font>性 別</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                <input name="reg_sex" type="radio" value="M"><font color="blue">男</font>　
                                <input name="reg_sex" type="radio" value="F" checked><font color="red">女</font>
                            </div>  
                            <label style="text-align: right;" class="col-lg-3 col-md-3 control-label" ><font color=red>*</font>生 日</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_birth',  old('reg_birth'), ['id'=>'reg_birth', 'onfocus' => 'clearmsg()', 'placeholder' => '西元年/月/日','class' => 'form-control txt_s_18', 'requried'=>'required', 'style' => 'maxlength:30']) !!}
                            </div>
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" ><font color=red>*</font>行動電話</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_mobil',  old('reg_mobil'), ['id'=>'reg_mobil', 'onfocus' => 'clearmsg()', 'placeholder' => '行動電話','class' => 'form-control txt_s_18', 'requried'=>'required', 'style' => 'maxlength:30']) !!}
                            </div>
                            <label style="text-align: right;" class="col-lg-3 col-md-3 control-label" >住家電話</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_htel',  old('reg_htel'), ['id'=>'reg_htel', 'onfocus' => 'clearmsg()', 'placeholder' => '住家電話','class' => 'form-control txt_s_18', 'style' => 'maxlength:30']) !!}
                            </div>
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label">公司電話</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                {!! Form::text('reg_otel',  old('reg_otel'), ['id'=>'reg_otel', 'onfocus' => 'clearmsg()', 'placeholder' => '公司電話','class' => 'form-control txt_s_18', 'style' => 'maxlength:30']) !!}
                            </div>
                            <label style="text-align: right;" class="col-lg-3 col-md-3 control-label" ><font color=red>*</font>電子信箱</label>
                            <div class="col-lg-3 col-md-3 control-label">
                                
                                {!! Form::email('reg_email',  $memapp[0]->newmem_email, ['id'=>'reg_email', 'onfocus' => 'clearmsg()', 'placeholder' => '電子信箱','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:100']) !!}
							</div>
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label">已受洗</label>
                            <div class="col-lg-2 col-md-2">
                                <input name="reg_ifbap" type="radio" value="N" onclick="HideContent('reg_bapdate_str')">否　　
                                <input name="reg_ifbap" type="radio" value="Y" onclick="ShowContent('reg_bapdate_str')" checked>是
                            </div>
                            <div id="reg_bapdate_str">
	                            <label style="text-align: right;" class="col-lg-4 col-md-4 control-label">受洗日期</label>
	                            <div class="col-lg-6 col-md-6 control-label">
                                    {!! Form::text('reg_bapdate_str',  old('reg_bapdate_str'), ['id'=>'reg_bapdate_str', 'onfocus' => 'clearmsg()', 'placeholder' => '西元年/月/日','class' => 'form-control txt_s_18', 'style' => 'maxlength:30']) !!}
	                            </div>
	                        </div>    
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label"><font color=red>*</font>聯絡地址</label>
                            <div class="col-lg-2 col-md-2">
                                {!! Form::text('reg_zip',  old('reg_zip'), ['id'=>'reg_zip', 'onfocus' => 'clearmsg()', 'placeholder' => '郵遞區號','class' => 'form-control txt_s_18', 'requried'=>'required', 'style' => 'maxlength:6']) !!}
                                <a href="#" onclick="window.open('http://c2e.ezbox.idv.tw/address.php',760,800);"><i class="fa fa-search" aria-hidden="true"></i>查詢郵遞區號</a>
                            </div>
                            <div class="col-lg-7 col-md-7 control-label">
                                {!! Form::text('reg_address',  old('reg_address'), ['id'=>'reg_address', 'onfocus' => 'clearmsg()', 'placeholder' => '聯絡地址','class' => 'form-control', 'requried'=>'required', 'style' => 'maxlength:100']) !!}
                            </div>
                        </div></p>
                        <p><div class="row control-group">
                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" >職場類別</label>
                            <div class="col-lg-9 col-md-9 control-label">
                                <input name="job_class" type="radio" value="A">政治、法律　
                                <input name="job_class" type="radio" value="B">教育、學術　
                                <input name="job_class" type="radio" value="C">媒體、傳播　
                                <input name="job_class" type="radio" value="D">藝術、演藝　
                                <input name="job_class" type="radio" value="E">社會福利、公務　
                                <input name="job_class" type="radio" value="F">金融保險　
                                <input name="job_class" type="radio" value="G">服務、商業　
                                <input name="job_class" type="radio" value="H">醫療　
                                <input name="job_class" type="radio" value="I">營建、製造、環保　
                                <input name="job_class" type="radio" value="J">科技研發　
                                <input name="job_class" type="radio" value="Z">其他：<input type="text" name="jobother" size=20 maxlength=50 value="">
                            </div>
                        </div></p>
                        <?php 
                        if(substr($team[0]->team_no,0,2)=='AG' || substr($team[0]->team_no,0,2)=='DL'){
                        	//青年裝備
                        ?>
                            <div id="youth">
                                <p><div class="row control-group">
                                    <label style="text-align: right;" class="col-lg-2 col-md-2 control-label">就學資料</label>
                                    <div class="col-lg-9 col-md-9 control-label">
                                        <input name="reg_edu" type="radio" value="A">國中　
                                        <input name="reg_edu" type="radio" value="B">教育、學術　
                                        <input name="reg_edu" type="radio" value="C">媒體、傳播　
                                        <input name="reg_edu" type="radio" value="D">藝術、演藝
                                        <BR>學校名稱：<input type="text" name="reg_school"  size=20 maxlength=50 value="">
                                    </div>
                                </div></p>
                            
                                <p><div class="row control-group">
                                    <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" >裝備資料</label>
                                    <div class="col-lg-9 col-md-9 control-label">
                                        <!-- <input name="reg_equip51" type="checkbox" value="M">第0站　
                                        <input name="reg_equip52" type="checkbox" value="N">第1站　
                                        <input name="reg_equip53" type="checkbox" value="O">第2站　
                                        <input name="reg_equip54" type="checkbox" value="P">第3站　
                                        <input name="reg_equip55" type="checkbox" value="Q">遇見神營會　
                                        <input name="reg_equip56" type="checkbox" value="R">好同工教戰守則　
                                        <input name="reg_equip57" type="checkbox" value="S">門訓的籌碼　
                                        <input name="reg_equip58" type="checkbox" value="T">小組長訓練 -->
                                        <!-- //===2019/01/17 改變=================================================== -->
                                        <input name="reg_equip61" type="checkbox" value="U">慕道班
                                        <input name="reg_equip62" type="checkbox" value="V">啟動天國人生
                                        <input name="reg_equip63" type="checkbox" value="W">遇見神營會
                                        <input name="reg_equip64" type="checkbox" value="X">小組長訓練課程

                                    </div>
                                </div></p>
                                    
                                <p><div class="row control-group">
                                    <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" >服事團隊</label>
                                    <div class="col-lg-9 col-md-9 control-label">
                                        <input name="reg_serv1" type="checkbox" value="A">Prophetic Art　
                                        <input name="reg_serv2" type="checkbox" value="B">小驢駒劇團　
                                        <input name="reg_serv3" type="checkbox" value="C">JD舞團　
                                        <input name="reg_serv4" type="checkbox" value="D">黑手黨　
                                        <input name="reg_serv5" type="checkbox" value="E">Holywood影視團隊　
                                        <input name="reg_serv6" type="checkbox" value="F">犢報社　
                                        <input name="reg_serv7" type="checkbox" value="G">得勝者　
                                        <input name="reg_serv8" type="checkbox" value="H">YOUNG CLUB　
                                        <input name="reg_serv9" type="checkbox" value="I">幼兒事工　
                                        <input name="reg_serv10" type="checkbox" value="J">招待　
                                        <input name="reg_serv11" type="checkbox" value="K">新人接待　
                                        <input name="reg_serv12" type="checkbox" value="L">聖餐
                                        <input name="reg_serv13" type="checkbox" value="M">禱告陪談　
                                        <input name="reg_serv14" type="checkbox" value="N">Healing room　
                                        <input name="reg_serv15" type="checkbox" value="O">FUN團　
                                        <input name="reg_serv16" type="checkbox" value="P">敬拜團　
                                        <input name="reg_serv17" type="checkbox" value="Q">講員接待　
                                        <input name="reg_serv99" type="checkbox" value="Z">其他：<input type=text name=serv_more  size=20 maxlength=50 value="">
                                    </div>
                                </div></p>
                            </div>
                    	<?php
                        }else{
            	            //成人裝備
                        ?>
	                        <p><div class="row control-group" id="adult">
	                            <label style="text-align: right;" class="col-lg-2 col-md-2 control-label" >裝備資料</label>
	                            <div class="col-lg-9 col-md-9 control-label">
	                                <input name="reg_equip1" type="checkbox" value="A">慕道課程　
	                                <input name="reg_equip2" type="checkbox" value="B">遇見神營會　
	                                <input name="reg_equip3" type="checkbox" value="C">初信造就　
	                                <input name="reg_equip4" type="checkbox" value="D">長大成熟　
	                                <br><font color="red">** 請勾選您已完成的基礎裝備課程。只要您上過類似上列基礎裝備課程內容者（經小組長認證），均可勾選。</font>
	                            </div>
	                        </div></p>
                        <?php
                        }
						?>
						<div align="center">
                            <label for="code">驗證碼</label>
                            <img src="{{captcha_src('mission')}}" onclick="this.src='/services/captcha/mission?'+Math.random()" id="captchaCode" alt="" class="captcha">
                            <a rel="nofollow" href="javascript:;" onclick="document.getElementById('captchaCode').src='/services/captcha/mission?'+Math.random()" class="reflash"></a>
                            <input type=number class="tt-text" id="captcha" onfocus = 'clearmsg()' name="captcha" class="form-control" placeholder="請輸入左側驗證數碼" required>
                            @if ($errors->has('captcha'))
                            <span class="help-block">
                                <!-- <strong style='font-size:12px' class='text-danger'>錯誤!!</strong> -->
                            </span>
                            @endif                        
                        </div>
                        <div class="text-center">
                            <div class="alert alert-danger" style="display:none" id="show_msg">
                                
                            </div>
                        </div>
                        <div align="center" style="padding:10px;">
                            {{ Form::reset('重填', ['class' => 'btn btn-lg btn-default']) }}
                            {{ Form::button('確認', ['id' => 'submit_btn',  'onclick'=>"checkSel()", 'class' => 'btn btn-lg btn-primary']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
   	</div>
    <!--主要內容end-->
<!---->
<!--scrolling js-->
</form>

<script>
	$(function() {
	$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

	if (!screenfull.enabled) {
		return false;
	}

	$('#toggle').click(function() {
		screenfull.toggle($('#container')[0]);
	});

	});
</script>

<!--//scrolling js-->
<script type="text/javascript">
    function clearmsg(){
        $("#show_msg").html('').hide();
    }
	/*function check_id(column, name){
		var data=column.match(/^[a-z]\d{9}$/i);
		if (!data) return name + "錯誤 !\n";
		return '';
	}*/

	//**************************************
    // 台灣身份證檢查簡短版 for Javascript
    //**************************************
    function check_id(){
        //建立字母分數陣列(A~Z)
        var column = document.getElementsByName('reg_pid')[0];
        // var column = document.getElementsByID('reg_pid');

        id=column.value;
        if(id==""){
            return " 身份證必填！";
        }
        var city = new Array(
        1,10,19,28,37,46,55,64,39,73,82, 2,11,
        20,48,29,38,47,56,65,74,83,21, 3,12,30
        )
        id = id.toUpperCase();
        // 使用「正規表達式」檢驗格式
        if (id.search(/^[A-Z](1|2)\d{8}$/i) == -1) {
            return " 身份證格式錯誤！";
        } else {
            //將字串分割為陣列(IE必需這麼做才不會出錯)
            id = id.split('');
            //計算總分
            var total = city[id[0].charCodeAt(0)-65];
            for(var i=1; i<=8; i++){
            total += eval(id[i]) * (9 - i);
            }
            //補上檢查碼(最後一碼)
            total += eval(id[9]);
            //檢查比對碼(餘數應為0);
            if(total%10 == 0){
                return '';
            }else{
                return " 身份證驗證失敗！";
            }
        }
    }

	function checkSel()
    {
        // clearmsg();
      var errmsg = '';
      var len = 0;

      if ($("#reg_name").val()==''){
        errmsg += '請輸入您的姓名<BR>';
      }else{
          len =$("#reg_name").val().length;
          if (len < 3 || len > 30 ){
              errmsg += '請正確輸入您的姓名<BR>';
          }
      }
      if ($("#reg_pid").val()==''){
        errmsg += '請輸入您的身份證號碼<BR>';
      }else{
          len =$("#reg_pid").val().length;
          if (len != 10 ){
              errmsg += '請正確輸入您的身份證號碼<BR>';
          }
      }
      if ($("#reg_birth").val()==''){
        errmsg += '請輸入您的生日<BR>';
    //   }else{
    //       len =$("#reg_birth").val().length;
    //       if (len < 3 || len > 10 ){
    //           errmsg += '請按格式輸入您的生日<BR>';
    //       }
      }
      if ($("#reg_mobil").val()==''){
        errmsg += '請輸入您的行動電話<BR>';
      }else{
          len =$("#reg_mobil").val().length;
          if (len < 10 || len > 30 ){
              errmsg += '請正確輸入您的行動電話<BR>';
          }
      }
      if ($("#reg_email").val()==''){
        errmsg += '請輸入聯絡您的Email<BR>';
      }else if (IsEmail($("#reg_email").val())==false){
        errmsg += 'email 格式錯誤<BR>';
      }
      if ($("#reg_zip").val()==''){
        errmsg += '請輸入您的聯絡地址郵遞區號<BR>';
      }else{
          len =$("#reg_zip").val().length;
          if (len < 3 || len > 6 ){
              errmsg += '請正確輸入您的聯絡地址郵遞區號<BR>';
          }
      }
      if ($("#reg_address").val()==''){
        errmsg += '請輸入您的聯絡地址<BR>';
      }else{
          len =$("#reg_address").val().length;
          if (len < 3 || len > 100 ){
              errmsg += '請正確輸入您的聯絡地址<BR>';
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
