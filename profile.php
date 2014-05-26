<?php
	$layout["title"]= "Profile";

	include PATH.'layouts/header.php';

	if(empty($_SESSION["user"])):
?>

<?php
	else:
		echo "<h3 class='error'>ERROR: invalid access</h3>";
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';
?>