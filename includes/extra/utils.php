<?php
	define("PATH", "includes/");

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

	function html_span_error($id, $to_string= false){
		$span= "<span class=\"error\">".$_SESSION["errors"][$id]."</span>";

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
		foreach($data as $value):
			$tbody.="<tr>";

			if(is_array($value))
				foreach($value as $v)
					$tbody.= "<td>$v</td>";
			else
				$tbody.="<td>$value</td>";

			$input_val= !empty($arr_key)? $value[$arr_key]: $value;

			$tbody.="<td><input type='checkbox' name='checked[]' value='".$input_val."'/></td></tr>";
		endforeach;
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
	function valid_range($val, $min, $max){ return strlen($val)>= $min && strlne($val)<= $max; }
	function valid_equals($val, $val1){ return $val=== $val1; }
	function valid_unsignedint($val){ return filter_var($val, FILTER_VALIDATE_INT) && $val>= 0; }
	function valid_username($val){ return preg_match("/^[a-zA-Z0-9]+(?:[ _-][a-zA-Z0-9]+)*$/", $val); }
	function valid_name($val){ return preg_match("/^[a-zA-Z0-9]+(?:[ '][a-zA-Z0-9]+)*$/", $val); }
	function valid_ip($val){ return filter_var($val, FILTER_VALIDATE_IP); }

	// array_walk($_POST, "validate_array_values", array());
	function validate_value($value, $key, $para= array()){

	}

	function file_to_array($filename){
		$info= file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

		return $info;
	}

	function file_write_content($filename, $data, $flags= 0){
		if(is_array($data))
			$data= join(";;", $data."\n");

		return file_put_contents($filename, $data, $flags);
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