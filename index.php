<?php
	$layout["title"]= "Home Page";

	include 'includes/layouts/header.php';
?>

<div>
	<script src=<?php echo path_with_includes("javascripts/process.js"); ?>></script>
	<script>
		$(document).ready(function(){
			submitLoginForm();
		});
	</script>
	<fieldset>
		<form method="post" action="process.php?action=login">
			<span>
				<?php html_inputfield("username", array("maxLength"=> "25", "value"=> $_SESSION["temp"]["username"]), "Username"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["username"]; ?></span>
			</span>
			<span>
				<?php html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password"); ?>
				<span class='error'><?php echo $_SESSION["errors"]["password"]; ?></span>
			</span>
			<span style="width: 200px;"><hr/></span>
			<span>
				<?php
					html_inputfield("key", array("type"=> "hidden"));
					html_submit_button("Login");
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
					html_link("NEW MEMBER?!", "register.php");
				?>
			</span>
			<span class="error"><?php echo $_SESSION["errors"]["message"]; ?></span>
		</form>
	</fieldset>
</div>

<?php
	clear_temp_sessions();
	include 'includes/layouts/footer.php';
?>
