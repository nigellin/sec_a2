<?php

	function shiftable_asciis(){
		$ascii_array = array();

		for($i = ord('0'); $i <= ord('9'); $i++)
			array_push($ascii_array, chr($i));

		for($i = ord('A'); $i <= ord('Z'); $i++)
			array_push($ascii_array, chr($i));

		for($i = ord('a'); $i <= ord('z'); $i++)
			array_push($ascii_array, chr($i));

		return ($ascii_array);
	}

	function get_remainder($x, $y){
		if($x < 0)
			return get_remainder($x + $y, $y);

		return $x % $y;
	}

	function decrypt($data, $key){ return encrypt($data, -$key); }
	function encrypt($data, $key){
		$asciis	 = shiftable_asciis();
		$length	 = count($asciis);

		for($i = 0; $i < strlen($data); $i++){
			if(preg_match('/[a-z]/i', $data[$i]) || preg_match('/[0-9]/', $data[$i])){
				$index = get_remainder(array_search($data[$i], $asciis) + $key, $length);

				$encrypted.= $asciis[$index];
			}else
				$encrypted.= $data[$i];
		}

		return $encrypted;
	}
