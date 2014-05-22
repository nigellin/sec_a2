<?php
	include "./includes/layouts/init.php";

	$layout["title"]= "Process Action";

	include 'includes/layouts/header.php';

	if(!empty($_POST)){
		array_walk_recursive($_POST, "sanitize");
		error_reporting();

		switch($_REQUEST["action"]){
			case "login":

				validate_required($_POST);

				$redirect= "index.php";
				break;

			case "register":
				validate_required($_POST);

				$redirect= "register.php";
				break;
		}

		if(!empty($_SESSION["errors"])){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;

			header("location: $redirect");
		}

	}else
		echo "<h1 class='error'>invalid access</h1>";

	include 'includes/layouts/footer.php';