$(document).ready(function() {
	var passwdEqual = false;
	var mail = false;

	$("#mail").change(function(){
		var mailObj = $("#mail");
		
		var request = $.ajax({
			url: "verify.php",
			method:"POST",
			data: {mail:mailObj.val()},
			dataType: "json",
			context: document.body
			});

		request.done(function(resp){
			var answer = JSON.parse(resp);
			if(answer.status == "ok"){
				mailObj.removeClass("has-error");
				mailObj.addClass("has-success");
				window.mail = true;
			}
			else{
				mailObj.removeClass("has-success");
				mailObj.addClass("has-error");
				window.mail = false;
			}
		});

		request.fail(function(jqXHR, status){
			alert("Request error" + status);
		});
	});

	$("#passwd1").keyup(function(){
		var passwd1 = $("#passwd1");
		var passwd2 = $("#passwd2");

		if(passwd1.val() != passwd2.val()){
			window.passwdEqual = false;
			passwdError();
		}
		else if(passwd1.val() == passwd2.val()){
			window.passwdEqual = true;
			passwdError();
		}
		
	});


	$("#passwd2").keyup(function(){
		var passwd1 = $("#passwd1");
		var passwd2 = $("#passwd2");
		
		if(passwd1.val() != passwd2.val()){
			window.passwdEqual = false;
			passwdError();
		}
		else if(passwd1.val() == passwd2.val()){
			window.passwdEqual = true;
			passwdSuccess();
		}		
	});

	function passwdSuccess(){
		$("#passwd1_group").removeClass("has-error");
		$("#passwd2_group").removeClass("has-error");
		$("#passwd1_group").addClass("has-success");
		$("#passwd2_group").addClass("has-success");
	}

	function passwdError(){
		$("#passwd1_group").removeClass("has-success");
		$("#passwd2_group").removeClass("has-success");
		$("#passwd1_group").addClass("has-error");
		$("#passwd2_group").addClass("has-error");
	}

	$("#reg_btn").click(function(){
		if(!window.mail || !window.passwdEqual)
			alert("Неверно заполнено одно из полей");
		else
			$("#reg_form").submit();
	});
});