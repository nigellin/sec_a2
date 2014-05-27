<link rel="stylesheet" href="includes/stylesheets/main.css"/>
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

				echo "<h3 class='success'>logged out success</h3>";
				echo "<h3 class='success'>redirect to index within 3 seconds...</h3>";

				redirect("index.php", 3);

				break;
		}

		if(has_errors()){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;

			redirect($url);
		}
	}else
		echo "<h3 class='error'>ERROR: invalid access</h3>";