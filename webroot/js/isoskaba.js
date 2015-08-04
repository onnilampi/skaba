
function simpleValidate(someText) {
/* this function is for example purposes */
	if (someText.length <= 20) {
		true;
	} else {
		false;
	};
};

function validatePassword(passwordText) {
	var result = true; 
	if (passwordText.length < 6 || passwordText.length > 20) {
		result = false;
	};
	var allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZÅÄÖ1234567890";
	var i = 0;
	var upper = passwordText.toUpperCase();
	while (i <  upper.length) {
		if (allowed.search(upper[i]) == -1) {
			result = false;
		};
		i++;
	};
	return result
};
