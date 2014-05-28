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
		ip:			false
	};

	$.fn.validate= function(label, options){
		var options	= $.extend({}, defaults, options);
		var message	= "";
		var hasError= false;
		var val		= this.val();

		$.each(options, function(key, value){
			if(!hasError && value){
				switch(key){
					case "require":
						if(val.length<= 0)
							message= label+ " field is required";
						break;

					case "length":
						if(val.length!== value)
							message= label +" require exact "+ value+ " characters";

						break;

					case "minLength":
						if(val.length< value)
							message= label+ " require "+ value+ " characters at least";
						break;

					case "maxLength":
						if(val.length> value)
							message= label+ " require "+ value+ " characters at most";
						break;

					case "range":
						if(val.length< value[0] || val.length> value[1])
							message= label+ " require between "+ value[0]+ " to "+ value[1]+ " characters";
						break;

					case "unsignedint":
						if(!/^[0-9]+$/.test(val))
							message= label+ " require unsigned digits only";

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
							message= "contained invalid characters";
						break;

					case "name":
						if(!/^[a-zA-Z0-9]+(?:[ '][a-zA-Z0-9]+)*$/.test(val))
							message= "contained invalid characters";
						break;

					case "ip":
						if(!/^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$/.test(val))
							message= "invalid format for ip address";
						break;
				}

				if(message.length> 0)
					hasError= true;
			}
		});

		if(message.length> 0){
			this.nextAll("span.error").html(message);
		}

		return !hasError;
	};
}(jQuery));

function clearErrorMessages(){
	$("span.error").html("");
};

function getResult(arr){
	var result= true;

	$.each(arr, function(key, value){ result= result && value; });

	return result;
}
