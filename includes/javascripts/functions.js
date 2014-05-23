(function($){
	var label	= "";
	var message	= "";
	var hasError= false;

	$.fn.setLabel= function(l){
		label= l;
		return this;
	};

	$.fn.require= function(){
		if(!hasError && !this.val().length> 0){
			message= label+ " field is required";
			hasError= true;
		}

		return this;
	};

	$.fn.maxLength= function(length){
		if(!hasError && !this.val().length<= length){
			message	= label+ " field required "+ length+ " characters at most";
			hasError= true;
		}

		return this;
	};

	$.fn.minLength= function(length){
		if(!hasError && !this.val().length>= length){
			message	= label+ " field required "+ length+ " characters at least";
			hasError= true;
		}

		return this;
	};

	$.fn.length= function(min, max){
		if(!hasError && !(this.minLength(min) && this.maxLength(max))){
			message	= label+ " field required between "+ min+ " to "+ max+ " characters";
			hasError= true;
		}

		return this;
	};

	$.fn.email= function(){
		if(!hasError && !/^(?:\w+\.?\+?)*\w+@(?:\w+\.)+\w+$/.test(this.val())){
			message	= "invalid email format";
			hasError= true;
		}

		return this;
	};

	$.fn.username= function(){
		if(!hasError && !/^[a-zA-Z]\w*$/.test(this.val())){
			message= label+ " field contained invalid characters";
			hasError= true;
		}

		return this;
	};

	$.fn.name= function(){
		if(!hasError && !/^[a-zA-Z][a-zA-Z'\- ]+$/.test(this.val())){
			message	= label+ " field contains invalid characters";
			hasError= true;
		}

		return this;
	};

	$.fn.equals= function(id){
		if(!hasError && $(id).val()!== this.val()){
			message	= label+ " is not matched";
			hasError= true;
		}

		return this;
	};

	$.fn.showError= function(){
		alert(message);
		this.after("<span class='error'>"+ message+"</span>");
		return hasError;
	};
}(jQuery));

function clear_errors(){
	$(".error").remove();
};