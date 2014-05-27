<?php
	$layout["title"]= "Home Page";
	include 'includes/layouts/header.php';

	html_table(get_transactions(), array("Username", "Date", "Amount", "Status"), array("border"=> 1));
	if(valid_session("user")):
?>

<?php
	else:

	endif;

	include PATH."layouts/footer.php";
?>