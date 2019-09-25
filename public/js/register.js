// JavaScript Document
$(document).ready(init);
function init(){
}
function showHandler(){
	$("#ifbap").show();
}
function hideHandler(){
	$("#ifbap").hide();
}

function ifpassHandler(){
	$("#idspan").hide();
	$("#passspan").show();
}
function ifidHandler(){
	$("#idspan").show();
	$("#passspan").hide();
}
function chk2num(n,txt)
{
	for (i=n;i<txt.length;i++)
	{
	  c = txt.charAt(i);
	  if ("0123456789".indexOf(c,0) < 0)
	  {alert("請按正確格式輸入"); return '';}
	}
  return txt;
}
function chk3num(txt)
{
	for (i=0;i<txt.length;i++)
	{
	  c = txt.charAt(i);
	  if ("-/,0123456789".indexOf(c,0) < 0)
	  {alert("請按正確格式輸入"); return '';}
	}
  return txt;
}
function checkBirth(){
	var data,txt;
	data = $(this).val();
	txt=cleanString('', 'half', 'trim', data);
	data = chk3num(txt);
	//if (data=="") data="19";
	$(this).val(data).focus();
}
function checkBap(){
	var data,txt;
	data = $(this).val();
	txt=cleanString('', 'half', 'trim', data);
	data = chk3num(txt);
	$(this).val(data).focus();
}
function errorHandler(){
	alert("load有誤");
}
function successHandler(XML){
	var data = "<option value=''> -- 請選擇 -- </option>";
	var txt="";
		$('item',XML).each(function(i){
			txt = $(this).find("area_no").text();
			data = data +"<option value="+txt +">";
//			txt = txt + $(this).find("area_name").text();
			txt = $(this).find("area_name").text();
			data = data + txt + " </option> ";
		});
	$(":input[name='selectarea']").html(data);
	$(":input[name='selectgroup']").html("");
}
