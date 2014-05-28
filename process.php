<link rel="stylesheet" href="includes/stylesheets/main.css"/>
<?php
	include_once 'includes/extra/init.php';

	clear_temp_sessions();

	if(!empty($_POST)){
		array_walk_recursive($_POST, "sanitize");

		switch($_GET["action"]){
			case "login":

				$url= "index.php";
				break;

			case "register":


				$url= "register.php";
				break;

			case "logout":
				unset($_SESSION["user"]);

				echo "<span class='success'>logged out success</span>";
				echo "<span class='success'>redirect to index within 3 seconds...</span>";

				redirect("index.php", 3);

				break;

			case "updatetransactions":
				if($_SESSION['user']['role']=== "ADMIN"){

				}

				break;

			case "updateipblacklist":
				//if($_SESSION["user"]["role"]== "ADMIN"){
					switch($_POST["action"]){
						case "add":
							if(valid_require($_POST["ip"]) && valid_ip($_POST["ip"])){
								file_write_content(PATH."data/ip_blacklist.txt", $_POST["ip"]."\n", FILE_APPEND | LOCK_EX);

								echo "<span class='success'>new ip address is added</span>";
								echo "<span class='success'>redirect back within 3 seconds...</span>";
							}

							break;

						case "remove":

							if(empty($_POST["checked"])){
								$ips= get_ip_blacklist();

								foreach($_POST["checked"] as $k)
									unset($ips[$k]);

								file_write_content(PATH."data/ip_blacklist.txt", $ips);
							}


							break;
					}

				//}

				break;
		}

		if(has_errors()){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;
		}

		redirect($url);
	}else
		echo "<span class='error'>ERROR: invalid access</span>";