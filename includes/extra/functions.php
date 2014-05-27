<?php
	function encrypt_array(&$value, $key){ $value= encrypt($value, $key); }

	function decrypt_array(&$value, $key){ $value= decrypt($value, $key); }

	function get_transactions(){
		$infos= file_to_array(PATH."data/transactions.txt");

		for($i= 0; $i< count($infos); $i++){
			$info= explode(";;", $infos[$i]);
			$trasactions[$info[0]]= array(
				"username"	=> $info[1],
				"time"		=> $info[2],
				"amount"	=> $info[3],
				"status"	=> $info[4]);
		}

		return $trasactions;
	}

	function get_transaction($id){
		$infos= get_transactions();

		return $infos[$id];
	}

	function get_trasactions_by_status($username= "", $status= ""){
		if(empty($username))
			$infos= get_transactions();
		else
			$infos= get_transaction_by_username($username);

		if(empty($status))
			return $infos;

		foreach($infos as $value)
			if($value["status"]== $status)
				$results[]= $value;

		return $results;
	}

	function get_transaction_by_username($username){
		$infos= get_transactions();

		foreach($infos as $value)
			if($value["username"]== $username)
				$results[]= $value;

		return $results;
	}

	function get_users(){
		$infos= file_to_array(PATH."data/users.txt");

		for($i= 0; $i< count($infos); $i++){
			$info= explode(";;", $infos[$i]);
			$users[$info[0]]= array(
				"username"	=> $info[0],
				"role"		=> $info[1],
				"name"		=> $info[2],
				"email"		=> $info[3],
				"password"	=> $info[4],
				"address"	=> $info[5],
				"postcode"	=> $info[6],
				"city"		=> $info[7],
				"holdername"=> $info[8],
				"cardNo"	=> $info[9],
				"cvv"		=> $info[10],
				"expirationDate"=> $info[11]);
		}

		return $users;
	}

	function get_user($username){
		$users= get_users();
		return $users[$username];
	}

	function valid_username($username){
		$user= get_user($username);
		return empty($user)=== true;
	}

	function valid_user($username, $password){
		$user= get_user($username);

		if(empty($user) || $user["password"]!== $password){
			$_SESSION["errors"]["message"]= "invalid username or password";
			return false;
		}

		return true;
	}

	function clear_temp_sessions(){
		unset($_SESSION["temp"]);
		unset($_SESSION["errors"]);
	}