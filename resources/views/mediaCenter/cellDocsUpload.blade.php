<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主日信息小組材料</title>
<body bgcolor="#FFFFFF" text="#000000" topmargin="5" leftmargin="0">
<center>
<p>&nbsp;</p>
<p><b>裝備中心管理系統</b></p>
<div class="row" style="width:200px;padding:1px;background-color: #CEE;border-radius: 5px;">
<p>{{ $wdate }}主日信息<BR>小組材料 -- 上傳</p>


<div class="row">
{!! Form::open(['route'=>'services.savefile','files' => 'true','enctype'=>'multipart/form-data']) !!}
{{ Form::file('celldoc') }}
{!! Form::hidden('wid', $wid, ['class' => 'form-control']) !!}
{!! Form::hidden('wdate', $wdate, ['class' => 'form-control']) !!}

      <div class="col-lg-11 text-center" style="margin:20px ;">
            {{ Form::button('取消', array('class' => 'btn btn-secondary', 'onclick' => "window.close()")) }}
            {{ Form::submit('上傳檔案', array('class' => 'btn btn-primary')) }}
      </div>
</div>
{!! Form::close() !!}
            </div>

</Center>
</body>
</HTML>
