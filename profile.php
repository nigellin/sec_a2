<?php
	$layout["title"]= "Profile";

	include 'includes/layouts/header.php';

	if(valid_session("user")):
?>
<form disabled="true">
	<span>
		<?php html_inputfield("username", array("maxLength"=> "25", "disabled"=> true, "value"=> $_SESSION["user"]["username"]), "Username"); ?>
	</span>

	<span><br/></span>

	<span>
		<?php html_inputfield("name", array("disabled"=> true, "value"=> $_SESSION["user"]["name"]), "Full Name"); ?>
	</span>

	<span>
		<?php html_inputfield("email", array("disabled"=> true, "value"=> $_SESSION["user"]["email"]), "Email"); ?>
	</span>

	<span>
		<?php html_inputfield("address", array("disabled"=> true, "value"=> $_SESSION["user"]["address"]), "Address"); ?>
	</span>

	<span>
		<?php html_inputfield("postcode", array("disabled"=> true, "style"=>"width: 50px;", "value"=> $_SESSION["user"]["postcode"]), "Post Code"); ?>
	</span>

	<span>
		<?php html_inputfield("city", array("disabled"=> true, "value"=> $_SESSION["user"]["city"]), "City"); ?>
	</span>
	<span style="width: 200px;"><hr/></span>
</form>
<?php
		html_link("HOME", "index.php");
		insert_tab();
		html_link("TRANSACTION", "transaction.php");
		insert_tab();
		html_link("PURCHASE", "purchase.php");
		insert_tab();
		html_logout_button();

	else:
		html_span_error(INVALID_ACCESS);
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';
?>