<?php require_once dirname(__DIR__)."/includes/extra/functions.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo @$layout["title"]; ?></title>

		<link rel="stylesheet" href="includes/stylesheets/main.css" />

		<script src=<?php echo path_includes("javascripts/jquery-2.1.1.min.js"); ?>></script>
		<script src=<?php echo path_includes("javascripts/functions.js"); ?>></script>

		<?php echo @$layout["head_content"]; ?>
	</head>
	<body>