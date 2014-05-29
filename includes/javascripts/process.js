function submitLoginForm(){
	$("form#loginform").on("submit", function(){
		clearErrorMessages();
		var results= [];

		results.push($("#username").validate("username", { require:	true, username:	true, range: [ 4, 20 ] }));
		results.push($("#password").validate("password", { require:	true, range: [ 6, 25 ] }));

		var result= getResult(results);

		return result;
	});
}

function submitRegisterForm(){
	$("form#registerform").on("submit", function(){
		clearErrorMessages();

		var results	= [];

		results.push($("#username").validate("username", { require: true, username: true, range: [ 4, 20 ] }));
		results.push($("#password").validate("password", { require: true, range: [ 6, 25 ] }));
		results.push($("#passwordconf").validate("password confirmation", { require: true, equals: $("#password").val() }));
		results.push($("#name").validate("name", { require: true, name: true }));
		results.push($("#email").validate("email", { require: true, email: true }));
		results.push($("#address").validate("address", { require: true}));
		results.push($("#postcode").validate("post code", { require: true, unsignedint: true, length: 4 }));
		results.push($("#city").validate("city", { require: true, name: true }));
		results.push($("#holdername").validate("holder's name", { require: true, name: true }));
		results.push($("#cardno").validate("card number", { require: true, unsignedint: true, range: [12, 19] }));
		results.push($("#cvv").validate("cvv", { require: true, unsignedint: true, range: [3, 4] }));

		if($("#month").val()=== "Month" || $("#year").val()=== "Year"){
			setErrorMessage($("#month"), "require a value");
			results.push(false);
		}else{
			var date= new Date();
			var expDate= [$("#month").val(), $("#year").val()];

			if(expDate[0]<= date.getUTCMonth()+ 1 && expDate[1]== date.getUTCFullYear()){
				setErrorMessage($("#month"), "the date already expired");

				results.push(false);
			}
		}

		var result	= getResult(results);

		return result;
	});
}