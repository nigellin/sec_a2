var crypto= {
	decrypt: function(data, key){ return this.encrypt(data, -key); },
	encrypt: function(data, key){
		encrypted= "";

		asciis= getShiftableAscii();
		length= asciis.length;

		for(var i= 0; i< data.length; i++){
			if(data[i].match(/[a-z]/i) || data[i].match(/[0-9]/)){
				asciiValue= getAscii(data[i]);

				if(asciiValue> getAscii('Z'))
					asciiValue-= 13;
				else if(asciiValue> getAscii('9'))
					asciiValue-= 7;

				index= asciiValue- getAscii('0');

				index= getRemainder((index+ caesarKey), length);

				encrypted+= asciis[index];
			}else
				encrypted+= data[i];
		}

		return encrypted;
	}
};

function getChar(code){ return String.fromCharCode(code); }
function getAscii(string){ return string.charCodeAt(0); }

function getRemainder(x, y){
	if(x< 0)
		return getRemainder(x+ y, y);

	return x% y;
}

function getShiftableAscii(){
	asciiArray= [];

	for(var i= getAscii('0'); i<= getAscii('9'); i++)
		asciiArray.push(getChar(i));

	for(var i= getAscii('A'); i<= getAscii('Z'); i++)
		asciiArray.push(getChar(i));

	for(var i= getAscii('a'); i<= getAscii('z'); i++)
		asciiArray.push(getChar(i));

	return asciiArray;
}