<?php
	$layout["title"]= "Home Page";
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
			array("<input type='submit' name='result' value='approve'/>",
				"<input type='submit' name='result' value='reject'/>",
				"<input type='submit' name='result' value='pending'/>"));
	else:
		html_span_error(INVALID_ACCESS);
	endif;

	include PATH."layouts/footer.php";
?>