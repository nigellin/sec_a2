<?php require_once 'includes/extra/init.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $layout["title"]; ?></title>

		<link rel="stylesheet" href="<?php echo PATH."stylesheets/main.css"; ?>" />

		<script src=<?php echo PATH."javascripts/jquery-2.1.1.min.js"; ?>></script>
		<script src=<?php echo PATH."javascripts/functions.js"; ?>></script>
		<script src=<?php echo PATH."javascripts/crypto.js"; ?>></script>

		<?php echo $layout["head_content"]; ?>
	</head>
	<body>
		<fieldset>