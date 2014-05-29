<?php
	function encrypt_array(&$value, $key){ $value= encrypt($value, $key); }

	function decrypt_array(&$value, $key){ $value= decrypt($value, $key); }

	function get_transactions(){
		$infos= file_to_array(PATH."data/transactions.txt");

		for($i= 0; $i< count($infos); $i++){
			$info= explode(";;", $infos[$i]);
			$trasactions[$info[0]]= array(
				"id"		=> $info[0],
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
			$infos= get_transactions_by_username($username);

		if(empty($status))
			return $infos;

		foreach($infos as $value)
			if($value["status"]== $status)
				$results[]= $value;

		return $results;
	}

	function get_transaction_id(){
		$data	= get_transactions();
		$id		= 0;

		if(!empty($data))
			foreach($data as $value)
				$id= max($value["id"], $id);

		return $id+ 1;
	}

	function get_transactions_by_username($username){
		$infos= get_transactions();

		if(!empty($infos))
			foreach($infos as $value)
				if($value["username"]== $username)
					$results[]= $value;

		return $results;
	}

	function get_ip_blacklist(){
		$ips= file_to_array(PATH."data/ip_blacklist.txt");

		return $ips;
	}

	function is_blocked_ip($ip){
		if(in_array($ip, get_ip_blacklist(), false))
			return true;

		return false;
	}

	function get_users(){
		$infos= file_to_array(PATH."data/users.txt");

		for($i= 0; $i< count($infos); $i++){
			$info= explode(";;", $infos[$i]);
			$users[$info[0]]= array(
				"username"	=> $info[0],
				"password"	=> $info[1],
				"role"		=> $info[2],
				"name"		=> $info[3],
				"email"		=> $info[4],
				"address"	=> $info[5],
				"postcode"	=> $info[6],
				"city"		=> $info[7],
				"holdername"=> $info[8],
				"cardno"	=> $info[9],
				"cvv"		=> $info[10],
				"expirationdate"=> $info[11]);
		}

		return $users;
	}

	function get_user($username){
		$users= get_users();
		return $users[$username];
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

	function transaction($amount, $name= "", $cc="", $cvv="", $date= ""){
		$params['custid'] = 's3287015' ;
		$params['password'] = '2a20ebefea';
		$params['demo'] = 'y';

		$params['action'] = 'sale';
		$params['media'] = 'cc';
		$params['cc']	= !empty($cc)? $cc: $_SESSION["user"]["cardno"];
		$params["cvv"]	= !empty($cvv)? $cvv:$_SESSION["user"]["cvv"];
		$params['exp']	= !empty($date)? $date: $_SESSION["expirationdate"];
		$params['amount'] = $amount;
		$params['name'] = !empty($name)? $name: $_SESSION["user"]["holdername"];

		include PATH."extra/Snoopy.class.php";
		$snoopy = new Snoopy;
		$submit_url = "http://goanna.cs.rmit.edu.au/~ronvs/TCLinkGateway/process.php";

		if(!($snoopy->submit($submit_url, $params)))
			die("Failed fetching document: ".$snoopy->error."\n");

		return unserialize($snoopy->results);
	}
