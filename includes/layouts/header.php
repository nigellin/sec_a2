<?php
	require_once dirname(__DIR__)."/includes/extra/functions.php";
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $layout["title"]; ?></title>

		<link rel="stylesheet" href="<?php echo path_with_includes("stylesheets/main.css"); ?>" />

		<script src=<?php echo path_with_includes("javascripts/jquery-2.1.1.min.js"); ?>></script>
		<script src=<?php echo path_with_includes("javascripts/functions.js"); ?>></script>
		<script src=<?php echo path_with_includes("javascripts/crypto.js"); ?>></script>
		
		<?php echo $layout["head_content"]; ?>
	</head>
	<body>