
function submitLoginForm(){
	$("form").on("submit", function(){
		clearErrorMessages();
		var results= [];

		results.push($("#username").validate("username", { require:	true, username:	true, minLength: 4 }));
		results.push($("#password").validate("password", { require:	true }));

		var result= getResult(results);

		return result;
	});
}

function submitRegisterForm(){
	$("form").on("submit", function(){
		clearErrorMessages();

		
	});
}