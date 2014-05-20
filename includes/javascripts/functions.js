var validate= {
	maxLength:	function(val, length){ return val.length<= length; },
	minLength:	function(val, length){ return val.length>= length; },
	length:		function(val, min, max){ return this.maxLength(val, max) && this.minLength(val, min); },
	email:		function (val) { return /^(?:\w+\.?\+?)*\w+@(?:\w+\.)+\w+$/.test(val); },
	equals:		function(val1, val2){ return val1=== val2; },
	username:	function(val){ return /^$/.test(val); },
	name:		function(val){ return /^\s?(')$/.test(val); }
};