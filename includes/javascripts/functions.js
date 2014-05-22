var validate= {
	require:	function(val){ return val.length> 0; },
	maxLength:	function(val, length){ return val.length<= length; },
	minLength:	function(val, length){ return val.length>= length; },
	length:		function(val, min, max){ return this.maxLength(val, max) && this.minLength(val, min); },
	email:		function (val) { return /^(?:\w+\.?\+?)*\w+@(?:\w+\.)+\w+$/.test(val); },
	equals:		function(val1, val2){ return val1=== val2; },
	username:	function(val){ return /^[a-zA-Z]\w*$/.test(val); },
	name:		function(val){ return /^[a-zA-Z][a-zA-Z'\- ]+$/.test(val); }
};

function submitRegister(){
	$("form").on("submit", function(){
		
	});
}

function submitLogin(){
	$("form").on("submit", function(){

	});
}