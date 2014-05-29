<?php
	$layout["title"]= "Transaction Page";
	include 'includes/layouts/header.php';
?>

<script src=<?php echo PATH."javascripts/tablesorter.min.js"?>></script>
<script>
	$(document).ready(function(){
		$("table").tablesorter();
	});
</script>

<?php
	if(valid_session_user("ADMIN")):
		html_table_form(get_transactions(), array("Transaction Id", "Username", "Date", "Amount", "Status"), "id",
			array("method"=> "post", "action"=> "process.php?action=updatetransactions"),
			array("<input type='submit' name='action' value='approve'/>",
				"<input type='submit' name='action' value='reject'/>",
				"<input type='submit' name='action' value='pending'/>"));

		html_link("HOME", "index.php");
		insert_tab();
		html_link("IP_BLACKLIST", "ipblacklist.php");
		insert_tab();
		html_logout_button();

	elseif(valid_session("user")):
		html_table(get_transactions_by_username($_SESSION["user"]["username"]), array("Transaction Id", "Username", "Date", "Amount", "Status"));

		html_link("HOME", "index.php");
		insert_tab();
		html_link("PROFILE", "profile.php");
		insert_tab();
		html_link("PURCHASE", "purchase.php");
		insert_tab();
		html_logout_button();
	else:
		html_span_error(INVALID_ACCESS);
	endif;

	include PATH."layouts/footer.php";
?>