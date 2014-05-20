<?php
	include "./includes/layouts/init.php";

	$layout["title"]= "Home Page";

	include 'includes/layouts/header.php';
?>

<div>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
	</script>
	<fieldset>
		<form method="post" action="">
			<span>
				<?php html_inputfield("username", array("maxLength"=> "25"), "Username"); ?>
			</span>
			<span>
				<?php html_inputfield("password", array("maxLength"=> "25", "type"=> "password"), "Password"); ?>
			</span>
			<span>
				<?php
					html_submit_button("Login");
					echo "&nbsp;&nbsp;";
					html_link("Register", "register.php");
				?>
			</span>
		</form>
	</fieldset>
</div>

<?php include 'includes/layouts/footer.php'; ?>
