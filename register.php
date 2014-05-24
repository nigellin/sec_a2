<?php
	$layout["title"]= "Register";

	include 'includes/layouts/header.php';
?>

<div>
	<script src=<?php echo path_with_includes("javascripts/process.js"); ?>></script>

	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>
	<fieldset>
		<form method="post" action="process.php?action=register">
			<span>
				<?php html_inputfield("username", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["username"]), "Username"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["username"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("email", array("maxLength"=> "50", "value"=> $_SESSION["temp"]["email"]), "Email"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["email"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["password"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("passwordconf", array("maxLength"=> "25", "type"=> "password"), "Password Again"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["passwordconf"]; ?></span>
			</span>

			<span><br/></span>

			<span>
				<?php html_inputfield("name", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["name"]), "Full Name"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["name"]; ?></span>
			</span>

			<span>
				<?php html_inputfield("address", array("value"=> $_SESSION["temp"]["address"]), "Address"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["address"]; ?></span>
			</span>

			<span>
				<?php html_inputfield("postcode", array("maxLength"=> "4", "style"=>"width: 50px;", "value"=> $_SESSION["temp"]["name"]), "Post Code"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["postcode"]; ?></span>
			</span>

			<span>
				<?php html_inputfield("city", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["city"]), "City"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["name"]; ?></span>
			</span>

			<span><br/></span>

			<span>
				<?php html_inputfield("holdername", null, "Holder's Name"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["holdername"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("cardNo", array("maxLength"=> "16"), "Card Number"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["cardNo"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("cvv", array("maxLength"=> "4", "style"=>"width: 50px;"), "CVV"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["cvv"]; ?></span>
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

					echo "<span class='error'>".$_SESSION["errors"]["cvv"]."</span>";

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

			<span class="error"><?php echo $_SESSION["errors"]["message"]; ?></span>
		</form>
	</fieldset>
</div>

<?php include 'includes/layouts/footer.php'; ?>