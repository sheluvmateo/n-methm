var utils = {};

utils.displaySuccessMessage = function (parentElement, message) {
	$(".alert-success").remove();
	$(".alert-warning").remove();
	var div = ("<div class='alert alert-success'>"+message+"</div>");
	parentElement.append(div);
};

utils.displayErrorMessageEx = function (parentElement, message) {
	$(".alert-success").remove();
	$(".alert-warning").remove();
	var div = ("<div class='alert alert-warning'>"+message+"</div>");
	parentElement.append(div);
};

utils.displayErrorMessage = function(element, message) {
	/*var controlGroup = element.parents(".control-group");
	controlGroup.addClass("error").addClass("has-error");
	if(typeof message !== "undefined") {
		var helpBlock = $("<span class='help-inline text-error'>"+message+"</span>");
		controlGroup.find(".controls").append(helpBlock);
	}*/
	var element = document.getElementById("hiddenNotification");
	var helpBlock = "<div class='alert alert-danger' role='alert'>"+message+"</div>";
	element.innerHTML += helpBlock;
};

utils.removeErrorMessages = function () {
	//$(".control-group").removeClass("error").removeClass("has-error");
	//$(".help-inline").remove();

	var node = document.getElementById('hiddenNotification');
	while (node.hasChildNodes()) {
		node.removeChild(node.firstChild);
	}
};

utils.validateEmail = function (email) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
};

// jquery extend function
$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
    }
});