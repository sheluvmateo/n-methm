$(document).ready(function () {
	//button login click
	$("#loginButton").click(function () {
		//validation passed
		var loginUsername     = $("#loginUsername").val(),
			loginPassword     = $("#loginPassword").val(),
			onetimePassword   = $("#onetimePassword").val();

		//create data that will be sent to server
		var data = { 
			userData: {
				username           : loginUsername,
				password           : loginPassword,
				onetimePassword    : onetimePassword
			},
			fieldId: {
				username           : "loginUsername",
				password           : "loginPassword",
				onetimePassword    : "onetimePassword"
			}
		};
		
		//send data to server
		login.processLogin(data);                   
	});
});

var login = {};

login.processLogin = function (data) {
	$.ajax({
		url: "Core/Ajax.php",
		type: "POST",
		data: {
			action  : "loginRequest",
			user    : data,
			captcha : grecaptcha.getResponse()
		},
		success: function (result) {
			var res = JSON.parse(result);

			if (res.status == "success") {
				location.reload();
			} else {
				alertify.error(res.msg);
				grecaptcha.reset();
			}
		}
	});
};
