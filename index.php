<?php
	$layout["title"]= "Home Page";
	include 'includes/layouts/header.php';
?>

<script>
	$(document).ready(function(){
		submitLoginForm();
	});
</script>
	<?php if(!valid_session("user")): ?>
<form method="post" action="process.php?action=login" id="loginform">
	<span>
		<?php
			html_inputfield("username", array("maxLength"=> "20", "value"=> $_SESSION["temp"]["username"]), "Username");
			html_span_error_session("username");
		?>
	</span>
	<span>
		<?php
			html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password");
			html_span_error_session("password");
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
	<?php html_span_error_session("message"); ?>
</form>

<?php
	elseif(valid_session_user("ADMIN")):
		html_link("IP_BLACKLIST", "ipblacklist.php");
		insert_tab();
		html_link("TRANSACTION", "transaction.php");
		insert_tab();
		html_logout_button();
	else:
		html_link("PROFILE", "profile.php");
		insert_tab();
		html_link("TRANSACTION", "transaction.php");
		insert_tab();
		html_logout_button();
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';

