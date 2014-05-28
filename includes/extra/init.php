<?php
	session_start();

	require_once "includes/extra/functions.php";
	require_once "includes/extra/utils.php";

	if(is_blocked_ip($_SERVER["REMOTE_ADDR"]) || is_blocked_ip($_SERVER["REMOTE_HOST"]))
		die("<span style='color: red; font-weight: 600;'>ERROR: your ip address is denied by admin</span>");
