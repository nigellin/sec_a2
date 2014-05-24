<?php
	function path_with_includes($pathname){ return "includes/".$pathname; }

	function html_inputfield($id, $attr= array(),  $label= "", $label_atrr= array(), $to_string= false){
		if($label)
			$label= html_label($label, $id, $label_atrr);

		$field= "<input name='$id' id='$id' ";

		$field= $field.to_attr_str($attr)." />";

		if($to_string)
			return $field;

		echo $field;
	}

	function html_label($name, $for= "", $attr= array(), $to_string= false){
		$label= "<label for='$for' ";

		$label= $label.to_attr_str($attr).">$name</label>";

		if($to_string)
			return $label;

		echo $label;
	}

	function html_dropdownbox($id, $values= array(), $selected= "", $to_string= false){
		$options= "<select name='$id' id='$id'>";

		if(is_assoc_array($values)):
			foreach($values as $key=> $value):
				if($selected== $key)
					$selected= "selected='true'";

				$options.= "<option value='$key' $selected>$value</option>";
			endforeach;
		else:
			foreach($values as $value):
				if($selected== $key)
					$selected= "selected='true'";

				$options.= "<option value='$value' $selected>$value</option>";
			endforeach;
		endif;

		$options.= "</select>";

		if($to_string)
			return $options;

		echo $options;
	}

	function html_submit_button($value, $attr= array()){
		echo "<input type='submit' value='$value' ".to_attr_str($attr)."/>";
	}

	function to_attr_str($attr){
		$output= "";

		if(is_array($attr))
			foreach($attr as $key=> $value)
				$output.= $key."='$value' ";

		return $output;
	}

	function html_link($name, $href= "", $attr= array()){
		echo "<a href='$href' ".to_attr_str($attr).">$name</a>";
	}

	function sanitize(&$value){ $value= htmlentities(trim($value)); }

	function encrypt_array(&$value, $key){ $value= encrypt($value, $key); }

	function decrypt_array(&$value, $key){ $value= decrypt($value, $key); }

	function file_to_array($filename){
		$info= file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

		return serialize($info);
	}

	function file_write_content($filename, $data, $flags= 0){
		if(is_array($data))
			$data= join(";;", $data);

		file_put_contents($filename, $data, $flags);
	}

	function get_users(){
		$infos= unserialize(file_to_array("includes/extra/users.txt"));

		for($i= 0; $i< count($infos); $i++){
			$info= explode(";;", $infos[$i]);
			$users[$info[0]]= array(
				"username"	=> $info[0],
				"name"		=> $info[1],
				"email"		=> $info[2],
				"password"	=> $info[3],
				"address"	=> $info[4],
				"postcode"	=> $info[5],
				"city"		=> $info[6],
				"holdername"=> $info[7],
				"cardNo"	=> $info[8],
				"cvv"		=> $info[9],
				"expirationDate"=> $info[10]);
		}

		return serialize($users);
	}

	function is_assoc_array($array){
		if(!is_array($array))
			return false;

		return array_keys($array)!= range(0, count($array)- 1);
	}

	function get_user_info($username){
		$users= unserialize(get_users());
		return serialize($users[$username]);
	}

	function valid_username($username){
		$user= unserialize(get_user_info($username));
		return empty($user)=== true;
	}

	function valid_user($username, $password){
		$user= unserialize(get_user_info($username));

		if(empty($user) || $user["password"]!== $password){
			$_SESSION["errors"]["message"]= "invalid username or password";
			return false;
		}

		return true;
	}

	function has_errors(){
		return !empty($_SESSION["errors"]);
	}

	function validate_required($ids, $excluded= array()){
		if(is_assoc_array($ids))
			foreach($ids as $key=> $value){
				if(!in_array($key, $excluded) && empty($value))
					$_SESSION["errors"][$key]= "cannot contained empty value";
			}
		else
			if(empty($ids))
				$_SESSION["errors"]["message"]= "cannot contained empty value";

		return has_errors();
	}

	function clear_temp_sessions(){
		unset($_SESSION["temp"]);
		unset($_SESSION["errors"]);
	}