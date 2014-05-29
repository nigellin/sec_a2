<?php
	require_once "includes/extra/functions.php";

	define("PATH", "includes/");
	define("INVALID_ACCESS", "ERROR: invalid access");
	define("ADMIN_REQUIRE", "ERROR: require admin permission");

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
				$tmp= "";

				if($selected== $key)
					$tmp= "selected='true'";
				else
					$tmp= "";

				$options.= "<option value='$key' $tmp>$value</option>";
			endforeach;
		else:
			foreach($values as $value):
				$tmp= "";
				if($selected== $value)
					$tmp= "selected='true'";

				$options.= "<option value='$value' $tmp>$value</option>";
			endforeach;
		endif;

		$options.= "</select>";

		if($to_string)
			return $options;

		echo $options;
	}

	function html_submit_button($value, $attr= array(), $to_string= false){
		$button= "<input type='submit' value='$value' ".to_attr_str($attr)."/>";

		if($to_string)
			return $button;

		echo $button;
	}

	function html_link($name, $href= "", $attr= array(), $to_string= false){
		$link= "<a href='$href' ".to_attr_str($attr).">$name</a>";

		if($to_string)
			return $link;

		echo $link;
	}

	function html_logout_button($to_string= false){
		$output= "<form action=\"process.php?action=logout\" method='post' id='logoutform'>";
		$output.= html_submit_button("logout", array("name"=> "logout"), true)."</form>";

		if($to_string)
			return $output;

		echo $output;
	}

	function html_span($message, $class){
		return "<span class='$class'>$message</span>";
	}

	function html_span_error($message, $to_string= false){
		$span= html_span($message, "error");

		if($to_string)
			return $span;

		echo $span;
	}

	function html_span_success($message, $to_string= false){
		$span= html_span($message, "success");

		if($to_string)
			return $span;

		echo $span;
	}

	function html_span_info($message, $to_string= false){
		$span= html_span($message, "info");

		if($to_string)
			return $span;

		echo $span;
	}

	function html_span_error_session($id, $to_string= false){
		$span= html_span($_SESSION["errors"][$id], "error");

		if($to_string)
			return $span;

		echo $span;
	}

	function html_table_form($data, $th, $arr_key, $form_attr, $tfoot_val){
		$form_attr= to_attr_str($form_attr);

		$form= "<form $form_attr>";
		$table= "<table>";

		$thead= "<thead><tr>";
		foreach($th as $value)
			$thead.= "<th>$value</th>";
		$thead.= "</tr></thead>";

		$tbody= "<tbody>";
		if(!empty($data))
			foreach($data as $value):
				$tbody.="<tr>";

				if(is_array($value))
					foreach($value as $v)
						$tbody.= "<td>$v</td>";
				else
					$tbody.="<td>$value</td>";

				$input_val= !empty($arr_key)? $value[$arr_key]: $value;

				$tbody.="<td><input type='checkbox' name='selected[]' value='".$input_val."'/></td></tr>";
			endforeach;
		else
			$tbody.= "<tr><td colspan='".count($th)."'><center><i>no data entry</i></center></td></tr>";

		$tbody.="</tbody>";

		$tfoot= "<tfoot><tr><td colspan='".(count($th)+ 1)."'><center>";
		foreach($tfoot_val as $value)
			$tfoot.= $value;
		$tfoot.= "</center></td></tr></tfoot>";

		$table.= $thead.$tbody.$tfoot."</table>";
		$form.=	$table."</form>";

		echo $form;
	}

	function html_table($data, $th= array(), $attr= array(), $to_string= false){
		$table= "<table ".to_attr_str($attr).">";

		if(!empty($th)){
			$thead= "<thead><tr>";
			foreach($th as $value)
				$thead.= "<th>$value</th>";

			$thead.= "</tr></thead>";
		}

		$tbody= "<tbody>";
		if(!empty($data))
			foreach($data as $value){
				$tbody.= "<tr>";

				if(is_array($value)){
					foreach($value as $v)
						$tbody.= "<td>$v</td>";
				}else
					$tbody.= "<td>$value</td>";

				$tbody.= "</tr>";
			}
		else
			$tbody.= "<tr><td colspan='".count($th)."'><center><i>no data entry</i></center></td></tr>";

		$tbody.= "</tbody>";

		$table.= $thead.$tbody."</table>";

		if($to_string)
			return $table;

		echo $table;
	}

	function to_attr_str($attr){
		$output= "";

		if(is_array($attr))
			foreach($attr as $key=> $value)
				$output.= "$key='$value' ";

		return $output;
	}

	function sanitize(&$value){ $value= htmlentities(trim($value)); }

	function valid_require($val){ return !empty($val); }
	function valid_email($val){ return filter_var($val, FILTER_VALIDATE_EMAIL); }
	function valid_length($val, $len){ return strlen($val)== $len; }
	function valid_range($val, $min, $max){ return strlen($val)>= $min && strlen($val)<= $max; }
	function valid_equals($val, $val1){ return $val=== $val1; }
	function valid_unsignedint($val){ return filter_var($val, FILTER_VALIDATE_INT) && $val>= 0; }
	function valid_username($val){ return preg_match("/^[a-zA-Z0-9]+(?:[ _-][a-zA-Z0-9]+)*$/", $val); }
	function valid_name($val){ return preg_match("/^[a-zA-Z0-9]+(?:[ '][a-zA-Z0-9]+)*$/", $val); }
	function valid_ip($val){ return filter_var($val, FILTER_VALIDATE_IP); }

	function validate($value, $key, $para= array()){
		foreach($para as $k=> $v):
			if(!has_error($k)){
				$m= "valid_".$k;

				switch($k){
					case "require":
						if(!$m($value))
							$msg= "value cannot be empty";
						break;

					case "email":
						if(!$m($value))
							$msg= "invalid email format";
						break;

					case "length":
						if(!$m($value, $v))
							$msg= "require exact $v characters";
						break;

					case "range":
						if(!$m($value, $v[0], $v[1]))
							$msg= "require between ".$v[0]." to ".$v[1]." characters";
						break;

					case "equals":
						if(!$m($value, $v))
							$msg= "is not matched";
						break;

					case "unsignedint":
						if(!$m($value))
							$msg= "require unsigned digits";
						break;

					case "username":
						if(!$m($value))
							$msg= "contained invalid characters, only accept ALPHABETS, SPACE, UNDERSCORE & HYPHEN";
						else{
							$user= get_user($value);
							if(!empty($user))
								$msg= "username is no available";
						}

						break;

					case "name":
						if(!$m($value))
							$msg= "contained invalid characters, only accept ALPHABETS, SPACE & SINGLE-QUOTE";
						break;
					case "ip":
						if(!$m($value))
							$msg= "invalid ip address format";
						break;
				}
			}

			if(!empty($msg))
				set_error($key, $msg);
		endforeach;
	}

	function file_to_array($filename){
		$info= file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

		return $info;
	}

	function file_write_array_contents($filename, $data, $flags= FILE_APPEND){
		if(is_array($data)){
			if(has_inner_array($data))
				foreach($data as $value)
					file_write_array_contents($filename, $value, $flags);
			else{
				$data = join(";;", $data);
				file_write_array_contents($filename, $data, $flags);
			}
		}else{
			$data.= PHP_EOL;
			file_put_contents($filename, $data, $flags);
		}
	}

	function file_write_contents($filename, $data, $flags= FILE_APPEND){
		if(is_array($data))
			foreach($data as $value)
				file_write_contents($filename, $value, $flags);
		else{
			$data.= PHP_EOL;
			file_put_contents($filename, $data, $flags);
		}
	}

	function file_clear_contents($filename){
		file_put_contents($filename, "");
	}

	function file_update_all($filename, $data, $flags= null){
		file_clear_contents($filename);
		file_write_array_contents($filename, $data, $flags);
	}

	function is_assoc_array($array){
		if(!is_array($array))
			return false;

		return array_keys($array)!= range(0, count($array)- 1);
	}

	function redirect($url= "", $interval= 0){
		if(empty($url))
			return;

		if($interval> 0){
			if(!empty($url))
				$url= "url= $url";

			header("refresh: $interval; $url");
		}else
			header("location: $url");
	}


	function has_errors(){ return !empty($_SESSION["errors"]); }
	function has_error($key){ return !empty($_SESSION["errors"][$key]); }
	function set_error($key, $message){
		$_SESSION["errors"][$key]= $message;
	}

	function valid_session_user($role= "NORMAL"){
		if(valid_session("user") && $_SESSION["user"]["role"]== $role)
			return true;

		return false;
	}

	function valid_session($id){
		if(!empty($_SESSION[$id]))
			return true;

		return false;
	}

	function insert_tab($to_string= false){
		$tab= "&nbsp;&nbsp;&nbsp;&nbsp;";

		if($to_string)
			return $tab;

		echo $tab;
	}

	function has_inner_array($arr){
		foreach($arr as $value)
			if(is_array($value))
				return true;

		return false;
	}