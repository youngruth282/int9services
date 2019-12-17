//www.blueshop.com.tw/show.asp 2009/9/9
function PageSizeChk(){
    if (!document.getElementById("right")){
	   RightwinW=0; }
	else
	   {RightwinW=210;}
     
	if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName=="Netscape") {
			winW = window.innerWidth - 170 - RightwinW;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) {
			winW = document.body.clientWidth - 150 - RightwinW;
		}
	}
	document.getElementById("midbox").style.width = winW;
}
