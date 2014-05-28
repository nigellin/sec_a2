<?php
	session_start();

	require_once dirname(__DIR__)."/includes/extra/functions.php";
	require_once dirname(__DIR__)."/includes/extra/utils.php";

	is_blocked_ip($_SERVER["REMOTE_ADDR"]) and
		die("<span style='color: red; font-weight: 600;'>ERROR: your IP address is denied by admin</span>");