(function($){
	var defaults= {
		require:	false,
		length:		false,
		range:		false,
		maxLength:	false,
		minLength:	false,
		email:		false,
		username:	false,
		name:		false,
		equals:		false,
		ip:			false,
		creditcard:	false
	};

	$.fn.validate= function(label, options){
		var options	= $.extend({}, defaults, options);
		var message	= "";
		var hasError= false;
		var val		= this.val().trim();
		var _this	= this;

		$.each(options, function(key, value){
			if(!hasError && value){
				switch(key){
					case "require":
						if(val.length<= 0)
							message= label+ " field is required";
						break;

					case "length":
						if(val.length!== value)
							message= "requires exact "+ value+ " characters";

						break;

					case "minLength":
						if(val.length< value)
							message= "requires "+ value+ " characters at least";
						break;

					case "maxLength":
						if(val.length> value)
							message= "requires "+ value+ " characters at most";
						break;

					case "range":
						if(val.length< value[0] || val.length> value[1])
							message= "requires between "+ value[0]+ " to "+ value[1]+ " characters";
						break;

					case "unsignedint":
						if(!/^[0-9]+$/.test(val))
							message= " requires unsigned digits only";

						break;

					case "equals":
						if(val!== value)
							message= label+ " is not matched";
						break;

					case "email":
						if(!/^(?:\w+\.?\+?)*\w+@(?:\w+\.)+\w+$/.test(val))
							message= "invalid email format";
						break;

					case "username":
						if(!/^[a-zA-Z0-9]+(?:[ _-][a-zA-Z0-9]+)*$/.test())
							message= "contained invalid characters, only accept ALPHABETS, SPACE, UNDERSCORE & HYPHEN";
						break;

					case "name":
						if(!/^[a-zA-Z0-9]+(?:[ '][a-zA-Z0-9]+)*$/.test(val))
							message= "contained invalid characters, only accept ALPHABETS, SPACE & SINGLE-QUOTE";
						break;

					case "ip":
						if(!/^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$/.test(val))
							message= "invalid ip address format";
						break;
					case "creditcard":
						_this.validateCreditCard(function(result){
							if(!result.luhn_valid || !result.length_valid)
								message= "invalid credit card number";
						});
						break;
				}

				if(message.length> 0)
					hasError= true;
			}
		});

		if(message.length> 0)
			setErrorMessage(this, message);

		return !hasError;
	};
}(jQuery));

function setErrorMessage(selector, message){
	selector.nextAll("span.error").html(message);
}

function clearErrorMessages(){
	$("span.error").html("");
};

function getResult(arr){
	var result= true;

	$.each(arr, function(key, value){ result= result && value; });

	return result;
}
