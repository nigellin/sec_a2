<?php
	$layout["title"]= "Profile";

	include PATH.'layouts/header.php';

	if(valid_session("user")):
?>

<?php
	else:
		html_span_error(INVALID_ACCESS);
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';
?>