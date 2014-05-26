<?php
	include_once 'includes/extra/init.php';
	
	clear_temp_sessions();

	if(!empty($_POST)){
		array_walk_recursive($_POST, "sanitize");

		switch($_GET["action"]){
			case "login":

				validate_required($_POST, array("key"));

				if(!has_errors() && valid_user($_POST["username"], $_POST["password"])){

				}

				$url= "index.php";
				break;

			case "register":
				validate_required($_POST);

				$url= "register.php";
				break;

			case "logout":
				unset($_SESSION["user"]);
				echo "success";
				break;
		}

		if(has_errors()){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;

			redirect($url);
		}
	}else
		echo "<h3 class='error'>ERROR: invalid access</h3>";