 $(document).ready(function () {

	$("#activateButton").click(function () {
		var key = $("#enteredKey");


		if(premium.validateKey(key) === true) { 

			var data = {
				key: key.val(),
				id: {
					key: "key"
				}
			};
			
			premium.activateKey(data);

		}

	});

	$("#enteredKey").focus();
});

var premium = {};

premium.activateKey = function (data) {
	$.ajax({
		url: "Core/Ajax.php",
		type: "POST",
		data: {
			action : "activateSMSKey",
			key: data.key,
			id: data.id
		},
		success: function (result) {
			if (result == "true") {
				alertify.success("The code has been successfully activated!");
			} else {
				alertify.error("The selected code is invalid!");
			}
		}
	});
};

premium.validateKey = function (key) {
	var valid = true;

	if($.trim(key.val()) == "") {
		alertify.error("The code input cannot be empty!");
		valid = false;
	}
	return valid;
};


