<?php
	$layout["title"]= "Block IPs";
	include 'includes/layouts/header.php';
?>

<script>
	$(document).ready(function(){
		$("input[value='add']").on("click", function(){
			clearErrorMessages();

			if($("#ip").validate("ip address", {require: true, ip: true}))
				return true;
			return false;
		});
	});
</script>
<?php
	if(valid_session_user("ADMIN")):
		html_table_form(get_ip_blacklist(), array("IP Addresses"), null,
			array("method"=> "post", "action"=> "process.php?action=updateipblacklist", "id"=> "ipform"),
			array(
				"<input type='text' name='ip' id='ip'/>",
				"<input type='submit' value='add' name='action'/>|",
				"|<input type='submit' value='remove' name='action'/>",
				html_span_error_session("ip", true)));

		html_link("HOME", "index.php");
		insert_tab();
		html_link("TRANSACTION", "transaction.php");
		insert_tab();
		html_logout_button();
	else:
		html_span_error(ADMIN_REQUIRE);
	endif;

	clear_temp_sessions();
	include "includes/layouts/footer.php";
