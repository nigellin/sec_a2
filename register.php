<?php
	$layout["title"]= "Register";

	include 'includes/layouts/header.php';
	if(!valid_session("user")):
?>
<script src=<?php echo PATH."javascripts/process.js"; ?>></script>

<script type="text/javascript">
	$(document).ready(function(){
		submitRegisterForm();
	});
</script>
<form method="post" action="process.php?action=register" id="registerform">
	<span>
		<?php
			html_inputfield("username", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["username"]), "Username");
			html_span_error_session("username");
		?>
	</span>
	<span>
		<?php
			html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password");
			html_span_error_session("password");
		?>
	</span>
	<span>
		<?php
			html_inputfield("passwordconf", array("maxLength"=> "25", "type"=> "password"), "Password Confirm");
			html_span_error_session("passwordconf");
		?>
	</span>

	<span><br/></span>

	<span>
		<?php
			html_inputfield("name", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["name"]), "Full Name");
			html_span_error_session("passwordconf");
		?>
	</span>

	<span>
		<?php
			html_inputfield("email", array("maxLength"=> "50", "value"=> $_SESSION["temp"]["email"]), "Email");
			html_span_error_session("email");
		?>
	</span>

	<span>
		<?php
			html_inputfield("address", array("value"=> $_SESSION["temp"]["address"]), "Address");
			html_span_error_session("address");
		?>
	</span>

	<span>
		<?php
			html_inputfield("postcode", array("maxLength"=> "4", "style"=>"width: 50px;", "value"=> $_SESSION["temp"]["name"]), "Post Code");
			html_span_error_session("postcode");
		?>
	</span>

	<span>
		<?php
			html_inputfield("city", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["city"]), "City");
			html_span_error_session("city");
		?>
	</span>

	<span><br/></span>

	<span>
		<?php
			html_inputfield("holdername", null, "Holder's Name");
			html_span_error_session("holdername");
		?>
	</span>
	<span>
		<?php
			html_inputfield("cardno", array("maxLength"=> "16"), "Card Number");
			html_span_error_session("cardno");
		?>
	</span>
	<span>
		<?php
			html_inputfield("cvv", array("maxLength"=> "4", "style"=>"width: 50px;"), "CVV");
			html_span_error_session("cvv");
		?>
	</span>
	<span>
		<?php
			html_label("Expiration Date");
			$date	= date("Y");
			$month	= array_merge(array("Month"), range(1, 12));;
			$year	= array_merge(array("Year"), range($date, $date+ 20));

			html_dropdownbox("month", $month, "Month");
			echo "&nbsp;/&nbsp;";
			html_dropdownbox("year", $year, "Year");

			html_inputfield("expirationDate", array("type"=> "hidden"));
		?>
	</span>

	<span style="width: 200px;"><hr/></span>

	<span>
		<?php
			html_submit_button("Register");
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			html_link("LOGIN", "index.php");
		?>
	</span>

	<?php html_span_error_session("message"); ?>
</form>
<?php
	else:
		html_span_error(INVALID_ACCESS);
	endif;

	clear_temp_sessions();
	include 'includes/layouts/footer.php';
?>