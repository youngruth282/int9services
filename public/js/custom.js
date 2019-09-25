$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
	$.ajax({
		type:"POST",
		url:"fn_getVCode.php",
		cache:false,
		error: errorHandler,
		success: successchkHandler
	});
	$("#verify_code").click(clickHandler);
});
function successchkHandler(XML){
	var data = "";
	var txt="";
		$('item',XML).each(function(i){
			txt = $(this).find("vcode").text();
			data = data + txt ;
		});
	$("#verify_code").text(data);
	data="<input type=hidden name=chkcode value='"+txt+"' />";
	alert(data);
	$("#vcode").html(data);

}
function clickHandler(){
	$.ajax({
		type:"POST",
		url:"fn_getVCode.php",
		cache:false,
		error: errorHandler,
		success: successchkHandler
	});
}
function errorHandler(){
	alert("load有誤");
}

