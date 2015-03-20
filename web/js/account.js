$(document).ready(function() {
	$("#avatar").mouseover(function(){
		$(".avatar-menu").css("display", "block");
	});

	$("#avatar").mouseout(function(){
		$(".avatar-menu").css("display", "none");
	});

	$(".avatar-menu").mouseover(function(){
		$(".avatar-menu").css("display", "block");
	});

	$(".avatar-menu").mouseout(function(){
		$(".avatar-menu").css("display", "none");
	});

	$(".avatar-menu").click(function(){
		$("#avatar_upload").click();
	});
});