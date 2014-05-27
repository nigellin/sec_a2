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

	function html_span_error($id){
		echo "<span class=\"error\">".$_SESSION["errors"][$id]."</span>";
	}

	function html_table($data, $th= array(), $attr= array(), $to_string= false){
		$table= "<table ".to_attr_str($attr).">";

		if(!empty($th)){
			$head= "<tr>";
			foreach($th as $value)
				$head.= "<th>$value</th>";

			$head.= "</tr>";
		}

		foreach($data as $value){
			$body.= "<tr>";

			if(is_array($value)){
				foreach($value as $v)
					$body.= "<td>$v</td>";
			}else
				$body.= "<td>$value</td>";

			$body.= "</tr>";
		}

		$table.= $head.$body."</table>";

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

	function file_to_array($filename){
		$info= file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

		return $info;
	}

	function file_write_content($filename, $data, $flags= 0){
		if(is_array($data))
			$data= join(";;", $data);

		file_put_contents($filename, $data, $flags);
	}

	function is_assoc_array($array){
		if(!is_array($array))
			return false;

		return array_keys($array)!= range(0, count($array)- 1);
	}

	function redirect($url= "", $interval= 0){
		if($interval> 0){
			if(!empty($url))
				$url= "url= $url";

			header("refresh: $interval; $url");
		}else
			header("location: $url");
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

	function valid_session($id){
		if(isset($_SESSION[$id]) && !empty($_SESSION))
			return true;

		return false;
	}

	function insert_tab($to_string= false){
		$tab= "&nbsp;&nbsp;&nbsp;&nbsp;";

		if($to_string)
			return $tab;

		echo $tab;
	}