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
	if(valid_session("user")):
		if($_SESSION["user"]["role"]== "ADMIN"){
			html_table_form(get_transactions(), array("Transaction Id", "Username", "Date", "Amount", "Status", ""),
				array("method"=> "post", "action"=> "process.php?action=updatetransactions"),
				array("<input type='submit' name='result' value='approve'/>",
					"<input type='submit' name='result' value='reject'/>",
					"<input type='submit' name='result' value='pending'/>"));
		}else
			html_table(get_trasactions_by_status($_SESSION["user"]["username"]), array("Transaction Id", "Username", "Date", "Amount", "Status"));
	else:
		echo "<span class='error'>ERROR: invalid access</span>";
	endif;

	include PATH."layouts/footer.php";
?>