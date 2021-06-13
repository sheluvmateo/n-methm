$(document).ready(function () {
	
	$("#continueButton").click(function () {
		var userName = $("#username").val();
		var email = $("#email").val();

		if(lostPassword.validateData(userName, email)) {
			lostPassword.forgotPassword(userName, email);
		}
	});
});


var lostPassword = {};

lostPassword.validateData = function(userName, email) {
	var valid = true;

	if(userName == "") {
		alertify.error("A felhasználónév mező nem lehet üres.");
		valid = false;
	}

	if(email == "") {
		alertify.error("Az email mező nem lehet üres.");
		valid = false;
	}

	return valid;
};

lostPassword.forgotPassword = function (userName, email) {
	$.ajax({
		url: "Core/Ajax.php",
		type: "POST",
		data: {
			action  : "forgotPassword",
			userName : userName,
			email : email
		},
		success: function (result) {
			//console.log(result)
			if ($.trim(result) == "true") {
				alertify.success("A jelszóemlékeztető levelet kiküldtük a megadott email címre.");
			} else {
				alertify.error("A megadott felhasználónév és email kombináció érvénytelen, vagy az elmúlt órában már kértél egy jelszóemlékeztetőt.");
			}
		}
	});
};



