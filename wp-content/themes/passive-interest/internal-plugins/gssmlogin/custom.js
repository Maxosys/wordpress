jQuery(function($){
	$(".gsfblogin").on("click", function(){
		fb_login();
	});
	$("#CEPLM").on("click", function(){
		fb_login();
	});
	$(".gstwlogin").on("click", function(){
		tw_login();
	});
});