<?php
	function path_includes($pathname){
		return dirname(__DIR__)."/includes/".$pathname;
	}

	function html_inputfield($id, $attr= array(),  $label= "", $label_atrr= array(), $to_string= false){
		$field= "<input name=\"".$id."\" id=\"".$id."\" ";

		if($label)
			$label= html_label($label, $id, $label_atrr, true);

		$output= $label.$field.to_attr_str($attr)."/>";

		if($to_string)
			return $output;

		echo $output;
	}

	function html_label($name, $for, $attr= array(), $to_string= true){
		$label= "<label for=\"".$for."\" ";

		$output= $label.to_attr_str($attr).">".$name."</lable>";

		if($to_string)
			return $output;

		echo $output;
	}

	function html_submit_button($value, $attr= array()){
		echo "<input type='submit' value='".$value."' ".to_attr_str($attr)."/>";
	}

	function to_attr_str($attr){
		$output= "";

		if(is_array($attr))
			foreach($attr as $key=> $value)
				$output.= $key."=\"".$value."\" ";

		return $output;
	}

	function html_link($name, $href= "", $attr= array()){
		echo "<a href=\"".$href."\" ".to_attr_str($attr).">".$name."</a>";
	}