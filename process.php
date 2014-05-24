<?php
	$layout["title"]= "Process Action";

	include 'includes/layouts/header.php';

	clear_temp_sessions();

	if(!empty($_POST)){
		array_walk_recursive($_POST, "sanitize");

		switch($_REQUEST["action"]){
			case "login":

				validate_required($_POST, array("key"));

				if(!has_errors() && valid_user($_POST["username"], $_POST["password"])){
					
				}

				$redirect= "index.php";
				break;

			case "register":
				validate_required($_POST);

				$redirect= "register.php";
				break;
		}

		print_r($_SESSION["errors"]);

		if(has_errors()){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;

			header("location: $redirect");
		}

	}else
		echo "<h1 class='error'>invalid access</h1>";

	include 'includes/layouts/footer.php';