
function chknum(txt)
{
for (i=0;i<txt.length;i++)
{
  c = txt.charAt(i);
  if ("0123456789".indexOf(c,0) < 0)
  {alert("請輸入數字"); return '';}
}
  return txt;
}
function cleanString(upLow, halfWhole, trim, str){
  var half = new Array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
                        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
						'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
					    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
						'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
  var whole = new Array( '１', '２', '３', '４', '５', '６', '７', '８', '９', '０',
                         'ａ', 'ｂ', 'ｃ', 'ｄ', 'ｅ', 'ｆ', 'ｇ', 'ｈ', 'ｉ', 'ｊ', 'ｋ', 'ｌ', 'ｍ', 
						 'ｎ', 'ｏ', 'ｐ', 'ｑ', 'ｒ', 'ｓ', 'ｔ', 'ｕ', 'ｖ', 'ｗ', 'ｘ', 'ｙ', 'ｚ',
					     'Ａ', 'Ｂ', 'Ｃ', 'Ｄ', 'Ｅ', 'Ｆ', 'Ｇ', 'Ｈ', 'Ｉ', 'Ｊ', 'Ｋ', 'Ｌ', 'Ｍ', 
						 'Ｎ', 'Ｏ', 'Ｐ', 'Ｑ', 'Ｒ', 'Ｓ', 'Ｔ', 'Ｕ', 'Ｖ', 'Ｗ', 'Ｘ', 'Ｙ', 'Ｚ' );
      
  upLow = upLow.toLowerCase();
  halfWhole = halfWhole.toLowerCase();
  trim = trim.toLowerCase();
	  
  if(upLow=='up')
	str = str.toUpperCase(); 
  else if(upLow=='low')
	str = str.toLowerCase();
	  
  if(halfWhole=='half'){
	for(var i=0; i<str.length; i++){
	  for(var j=0; j<whole.length; j++){
	    if(str.charAt(i)==whole[j])
		  str = str.replace(whole[j], half[j]);
	  }
	}
  } else if(halfWhole=='whole') {
	for(var i=0; i<str.length; i++){
	  for(var j=0; j<half.length; j++){
	    if(str.charAt(i)==half[j])
		  str = str.replace(half[j], whole[j]);
	  }
	}
  }
	  
  if(trim=='trim'){
	while(str.charAt(0)==' ' || str.charAt(0)=='　'){
	  str = str.substr(1);
	}
    while(str.charAt((str.length-1))==' ' || str.charAt((str.length-1))=='　'){
	  str = str.substr(0, (str.length-1));
	}
  }
	  
  return str;
}

/*
function checknum(column)
{
var txt=column.value;
alert(txt);
for (i=0;i<txt.length;i++)
{
  c = txt.charAt(i);
  if ("0123456789".indexOf(c,0) < 0)
  {alert("請輸入數字"); column.value='';column.focus();return;}
}
//	var data=column.match(/\d{1,9}$/i);
//	if (!data) return false;
//	return true;
}
function fillIfDisplay(currentObj){
  if(currentObj.style.display!='none'){
    if(currentObj.value=='')
	  return false;
  }
  return true;
}

function rand (n){
  return ( Math.floor ( Math.random ( ) * n + 1 ) );
}

function idValidation(obj){
  var num = new Array(11); //用來存轉換碼加九個數字 
  var table=new Array(10,11,12,13,14,15,16,17,34,18,19,20,21,22,35,23,24,25,26,27,28,29,32,30,31,33); //轉換的對照表
  var pass = 0; //為了通過後面的防呆所以...
  var sum = 0; //計算經過公式後的加總
  var input = obj.value; //存文字框的內容
  var returnMsg = "";
  
  if(input.length!=10)
    returnMsg = "長度不符";
  else if(input.charCodeAt(0)<"A".charCodeAt(0)||input.charCodeAt(0)>"Z".charCodeAt(0))
    returnMsg = "第一個字母要大寫英文";
  else if(input.charCodeAt(1)!="1".charCodeAt(0)&&input.charCodeAt(1)!="2".charCodeAt(0))
    returnMsg = "第一個數字必須是1或2";
  else {
    for(p=2;p<10;p++){
      if(input.charCodeAt(p)<"0".charCodeAt(0)||input.charCodeAt(p)>"9".charCodeAt(0)){
        returnMsg = "後九碼要皆為數字";
        break;
      } else
        pass++;
    }
  }
  if(returnMsg!="") 
    return returnMsg;
  if(pass!=8)
    return false;
  
  num[1]=table[input.charCodeAt(0)-65]%10;
  num[0]=(table[input.charCodeAt(0)-65]-num[1])/10;
  
  for(p=1;p<10;p++)
    num[p+1]=input.charCodeAt(p)-48;
  for(p=1;p<9;p++)
    num[p]=num[p]*(10-p); //套用公式
  for(p=0;p<11;p++)
    sum+=num[p];
  if(sum%10==0) //檢查
    returnMsg = true;
  else
    returnMsg = (sum%10)+"這個身分證是錯的";
  return returnMsg;
}

function checkemail(currentObj){
  var str=currentObj.value;
  var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (filter.test(str))
    return true;
  else{
    return false;
  }
}
function addOption(targetObj, str){
  var currentLen = targetObj.length;
  var newOption;
    
  newOption = str.split("|");
  targetObj.options[currentLen] = new Option(newOption[1], newOption[0]);
  
  targetObj.selectedIndex = 0;
}
function delOption(targetObj, str){
  for(var i=0; i<targetObj.length; i++){
    if(targetObj.options[i].value==str){
	  targetObj.options[i] = null;
	}
  }
}

function afterIdInput(currentObj){
  currentObj.value=cleanString('up', 'half', 'trim', currentObj.value);
  if(currentObj.name=='user_id'){
    if(currentObj.value!=''){
      $('is_foreign').checked=false;
	  $('user_id_foreign').value='';
    }
  } else if(currentObj.name=='user_id_foreign'){
    if(currentObj.value!=''){
	  $('is_foreign').checked=true;
	  $('user_id').value='';
	}
  }
  if(currentObj.name=='user_id' || currentObj.name=='user_id_foreign'){
    $('isRegisteredResult').innerHTML = '等待檢查...';
	if(currentObj.value!=''){
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  for(var i=0; i<fake_db.length; i++){
	    if(fake_db[i]!=undefined){
		  if(fake_db[i][5]==currentObj.value || fake_db[i][6]==currentObj.value){
	        $('isRegisteredResult').innerHTML = '<font color=\"red\">本帳號剛剛輸入過了！</font>';  
			isRegistered = true;
			currentObj.value = '';
			return false;
		  }
		}
	  }
	  var qstr = 'action=isRegistered&user_id='+currentObj.value+'&objName='+currentObj.name;
  	  doValidate('register.php', qstr);
	}
  }
}

function notEqual2(currentObj){
  var objName = currentObj.name;
  for(var i=0; i<fields.length; i++){
    if(fields[i]==objName){
	  if(currentObj.value==unequal_if_display[i])
	    return false;
	}
  }
  return true;
}
function validForm(){
  var errorMsg='', errorObj, idIsValid, tmp;
  if(isRegistered==true){
	alert('報名表格尚未填完，或者這個身份已經報名過了。');
	return false;
  }
  for(var i=0; i<fields.length; i++){
    // 身分證字號檢查空值
    if(i==5 || i==6){
	  if(!$(fields[7]).checked){	// 如果外國人radio沒有選取，檢查國內身分證號碼
		if(!fillIfDisplay($(fields[5]))){
		  errorMsg = '［'+field_chinese[5]+'］ 請填選內容';
	 	  errorObj = fields[5];
		  break;
		}
		idIsValid = idValidation($(fields[5]));
		if(idIsValid!=true){
		  errorMsg = '［'+field_chinese[5]+'］ 有誤：'+idIsValid;
	 	  errorObj = fields[5];
		  break;
		}
	  } else {
		if(!fillIfDisplay($(fields[6]))){
		  errorMsg = '［'+field_chinese[6]+'］ 請填選內容';
		  errorObj = fields[6];
		  break;
		}
	  }
	}
	for(var j=0; j<check_on_display.length; j++){
	  tmp = check_on_display[j].split("|");
	  if(tmp[0]==i){
	    if($(tmp[1]).style.display!='none'){	// 特殊block顯示出來，就應該要有預設值以外的值
		  if($(fields[i]).value==unequal_if_display[i]){
		    errorMsg = '［'+field_chinese[i]+'］ 請填選內容';
			errorObj = fields[i];
			break;
		  }
		}
	  }
	}
	if(i!=2 && i!=5 && i!=6 && i!=12 && i!=14 && i!=15){
	  if((i==0 && $(fields[i]).value=='gg') || (i==0 && $(fields[i]).value=='')){
	    i = 1;
		continue;
	  }
	  if($(fields[i]).value==unequal_if_display[i]){
	    if(i==11 && $(fields[10]).value=='s25') break; // 學校區域若選：台灣以外，則學校名稱選項不用選，直接輸入newschool的值即可
		errorMsg = '［'+field_chinese[i]+'］ 請填選內容';
		errorObj = fields[i];
		break;
	  }
	  if(fields[i]=='email'){
	    if(!checkemail($(fields[i]))){
		  errorMsg = '［'+field_chinese[i]+'］ 不合乎格式';
		  errorObj = fields[i];
		  break;
		}
	  } else if(fields[i]=='date_field'){
	  
	  }
	}
	if(errorMsg!='') break;
  }
  if(errorMsg!=''){
    alert(errorMsg);
    $(errorObj).focus();
	return false;
  }
  return true;
}

function getNow(){
  var Hours, Mins, Secs, Time;
  var now = '';
  var stamp = new Date();

  now = stamp.getYear()+"/"+(stamp.getMonth() + 1) +"/"+stamp.getDate();
  Hours = stamp.getHours();
  if (Hours >= 12)
	Time = " P.M.";
  else
	Time = " A.M.";
  
  if (Hours > 12)
	Hours -= 12;
  
  if (Hours == 0)
	Hours = 12;
  
  Mins = stamp.getMinutes();
  if (Mins < 10)
    Mins = "0" + Mins;
	
  Secs = stamp.getSeconds();
  if (Secs < 10)
    Secs = "0" + Secs;

  now = now+" "+Hours+":"+Mins+":"+Secs+Time;
  return now;
}
*/