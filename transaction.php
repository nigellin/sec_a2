<?php
	$layout["title"]= "Home Page";
	include 'includes/layouts/header.php';

	if(valid_session("user")):
?>

<?php
	else:

	endif;

	include PATH."layouts/footer.php";
?>