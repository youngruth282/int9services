	browser = navigator.appName;
	browserNum = parseInt(navigator.appVersion);

	if ((browser == "Netscape") && (browserNum < 5))
	{
		// Netscape 4.x
		layerRef = "document.layers['";
		endLayerRef = "']";
		styleRef = "";
		version = "e4";
	}
	else if ((browser == "Netscape") && (browserNum >= 5))
	{
		// Netscape 6
		layerRef = "document.getElementById('";
		endLayerRef = "')";
		styleRef = ".style";
		version = "e6";
	}
	else
	{
		// Internet Explorer
		layerRef = "document.all['";
		endLayerRef = "']";
		styleRef = ".style";
		version = "ie";
	}

function setDH()
{
	myLink.setHomePage("http://www.llc.org.tw");
}

function init()
{

	// adjuest the layer of index_menu
	for ( var i=1 ; i<=8 ; i++)
	{
		layerName="index_head_0" + i + "_desc";
		originX = eval(layerRef + layerName + endLayerRef + ".offsetLeft");
		if ( screen.width >= 1024)
			eval(layerRef + layerName + endLayerRef + styleRef + ".left  = originX + 100");//100

}
}

function changeImg()
{
	num = (num+1) % adURL.length;
	document.banner.src = adIMG[num];
	setTimeout('changeImg()',5000);//5000
}

function jump()
{
	window.open(adURL[num]);
}

function changeImg2()
{
	num2 = (num2+1) % adURL2.length;
	document.banner2.src = adIMG2[num2];
	setTimeout('changeImg2()',5000);//5000
}

function jump2()
{
	window.open(adURL2[num2]);
}


function showMenu(layerNum)
{
	// show the layer the user wants to see
	if ((layerNum != "00") && (layerNum != "bk")) {
		layerName="index_head_"+layerNum+"_desc";
		eval(layerRef + layerName + endLayerRef + styleRef + ".visibility = 'visible'");
	}
	imgName="menu_"+layerNum;
	if (document.images) {
		document[imgName].src=eval(imgName+"_OVER");
	}
}

function UnshowMenu(layerNum)
{
	// hide other window
	if ((layerNum != "00") && (layerNum != "bk")) {
		layerName="index_head_"+layerNum+"_desc";
		eval(layerRef + layerName + endLayerRef + styleRef + ".visibility = 'hidden'");
	}
	imgName="menu_"+layerNum;
	if (document.images) {
		document[imgName].src=eval(imgName+"_ON");
	}
}

function showLayer(layerNum)
{
	// show the layer the user wants to see
	layerName="layer_"+layerNum;
	eval(layerRef + layerName + endLayerRef + styleRef + ".display = 'block'");
}

function UnshowLayer(layerNum)
{
	// show the layer the user wants to see
	layerName="layer_"+layerNum;
	eval(layerRef + layerName + endLayerRef + styleRef + ".display = 'none'");

}

function fnDispThis(Lname,Lvalue)
{

	    if (Lvalue)
	        {
	        layerName="layer_"+Lname;
		eval(layerRef + layerName + endLayerRef + styleRef + ".display = 'block'");
	        }
	    else
	        {
	        layerName="layer_"+Lname;
		eval(layerRef + layerName + endLayerRef + styleRef + ".display = 'none'");
	        }
}

function openWin(url){
	aWindow=window.open(url,"thewindow","width=800,height=600,scrollbars=yes");
	aWindow.focus();
}
function openMenuWin(url){
	aWindow=window.open(url,"thewindow","menubar,width=800,height=600,scrollbars=yes");
	aWindow.focus();
}
function openPage(url,size_w,size_h){
	aWindow=window.open(url,"thewindow","width="+size_w+",height="+size_h+",scrollbars=yes");
	aWindow.focus();
}

function closeWin(win){
	win.close();
}

function InitScr() {
	 SCRH=SDIV.offsetHeight;
	 SCH=SDIV.parentNode.offsetHeight;
	 SCY = 0;
	 MODD=SCH/5;
	 SDIV.innerHTML = SDIV.innerHTML + SDIV.innerHTML;
	 setInterval("SSDIV()",50);//200
}
function SCROFF() {
 	SCR=0;
}
function SCRON() {
 	SCR=1;
}
function SSDIV() {
	 if (SCR) {
		 SCY-=1;
		 SDIV.style.top=SCY+'px';
		 if (SCRH+SCY<=0) SCY+=SCRH;
	 }
}

function MultiLink(fm,obj,n){
	eval('document.'+fm+'.'+obj+'['+n+'].click();');
	document.body.focus();
}

function SingleLink(fm,obj){
	eval('document.'+fm+'.'+obj+'.click();');
	document.body.focus();
}

