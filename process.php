<link rel="stylesheet" href="includes/stylesheets/main.css"/>
<?php
	include_once 'includes/extra/init.php';

	clear_temp_sessions();

	if(!empty($_POST)){
		array_walk_recursive($_POST, "sanitize");

		switch($_GET["action"]){
			case "login":

				validate($_POST["username"], "username", array("require"=> true, "username"=> true, "range"=> array(4, 20)));
				validate($_POST["password"], "password", array("require"=> true, "range"=> array(6, 25)));

				if(!has_errors()){
					if(valid_user($_POST["username"], $_POST["password"]))
						$_SESSION["user"]= get_user($_POST["username"]);
					else
						set_error("message", "invalid username or password");
				}

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
				if(valid_session_user("ADMIN")){
					switch($_POST["action"]){
						case "add":
							if(valid_require($_POST["ip"]) && valid_ip($_POST["ip"])){
								$ips= get_ip_blacklist();

								if(!in_array($_POST["ip"], $ips)){
									file_write_contents(PATH."data/ip_blacklist.txt", $_POST["ip"], FILE_APPEND);
									echo "<span class='success'>new ip address is added</span><br/>";
								}else
									html_span_error("the ip address already contained in blacklist</span><br/>");
							}

							break;

						case "remove":
							if(!empty($_POST["selected"])){
								$ips= get_ip_blacklist();

								foreach($_POST["selected"] as $value)
									foreach(array_keys($ips, $value) as $k)
										unset($ips[$k]);

								file_update_all(PATH."data/ip_blacklist.txt", $ips);
								html_span_error("removed selected ip addresses<br/>");
							}else
								html_span_error("no ip is been selected</span><br/>");

							break;
					}

					echo "<span class='info'>redirect back within 3 seconds...</span>";
					redirect("ipblacklist.php", 3);
				}else
					html_span_error(ADMIN_REQUIRE);

				break;
		}

		if(has_errors()){
			foreach($_POST as $key=> $value)
				$_SESSION["temp"][$key]= $value;
		}

		redirect($url);
	}else
		html_span_error(INVALID_ACCESS);