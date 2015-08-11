/* Functions for ISOSKABA */


function validatePassword(passwordText) {
    /* validates a passwords syntax */
	var result = true; 
	if (passwordText.length !== 0 && (passwordText.length < 6 || passwordText.length > 20)) {
		result = false;
	};
	var allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	var i = 0;
	var upper = passwordText.toUpperCase();
	while (i <  upper.length) {
		if (allowed.search(upper[i]) === -1) {
			result = false;
		};
		i++;
	};
	return result;
};
