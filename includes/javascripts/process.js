function logout(){
	$("a#logout").on("click", function(){});
}

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

		var results	= [];

		results.push($("#username").validate("username", { require: true, username: true }));
		results.push($("#password").validate("password", { require: true }));
		results.push($("#passwordconf").validate("password confirmation", { require: true, equals: $("#password").val() }));
		results.push($("#name").validate("name", { require: true, name: true }));
		results.push($("#email").validate("email", { require: true, email: true }));
		results.push($("#address").validate("address", { require: true}));
		results.push($("#postcode").validate("post code", { require: true, unsignedint: true, length: 4 }));
		results.push($("#city").validate("city", { require: true, name: true }));
		results.push($("#holdername").validate("holder's name", { require: true, name: true }));
		results.push($("#cardno").validate("cardno", { require: true, unsignedint: true, range: [12, 19] }));
		results.push($("#cvv").validate("cvv", { require: true, unsignedint: true, range: [3, 4] }));
		//results.push($("#").validate("", {}));

		var result	= getResult(results);

		return result;
	});
}