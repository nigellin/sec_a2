<?php
	$layout["title"]= "Home Page";
	include 'includes/layouts/header.php';
?>

<script src=<?php echo PATH."javascripts/process.js"; ?>></script>
<script>
	$(document).ready(function(){
		submitLoginForm();
	});
</script>
	<?php if(!valid_session("user")): ?>
<form method="post" action="process.php?action=login">
	<span>
		<?php
			html_inputfield("username", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["username"]), "Username");
			html_span_error("username");
		?>
	</span>
	<span>
		<?php
			html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password");
			html_span_error("password");
		?>
	</span>
	<span style="width: 200px;"><hr/></span>
	<span>
		<?php
			html_inputfield("key", array("type"=> "hidden"));
			html_submit_button("Login");
			insert_tab();
			html_link("REGISTER", "register.php");
		?>
	</span>
	<?php html_span_error("message"); ?>
</form>

<?php
	else:
		html_link("profile", "profile.php", array("style"=> "text-decoration: underline"));
		insert_tab();
		html_link("transactions", "transaction.php");
		insert_tab();
		html_logout_link();
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';

