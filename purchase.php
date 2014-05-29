<?php
	$layout["title"]= "Home Page";
	include 'includes/layouts/header.php';
	
?>
<script>
	$(document).ready(function(){
		$("form#purchaseform").on("submit", function(){
			var values= $("input[name='selected']").val();
			var result= false;
			var amount= 0;
			alert(values.join(", "));
			if(values.length< 0)
				setErrorMessage("not value is been selected");
			else{
				$.each(values, function(value){
					alert(value);
					amount+= value;
				});

				if(confirm("Confirm to purchase with total amonut: $"+ amount))
					result= true;
			}

			return result;
		});
	});
</script>
<?php

	if(valid_session("user")):
		$items= array(
			array("name"=> "HP Multifunction Printer", "amount"=> "599.99"),
			array("name"=> "Toshiba 1TB Portable Hard Drive", "amount"=> "119.50"),
			array("name"=> "iPhone 5s 16GB", "amount"=> "850.00"),
			array("name"=> "HP 7 Plus Tablet", "amount"=> "150.00"),
			array("name"=> "Microsoft Office 365 Personal", "amount"=> "85.49"),
			array("name"=> "Cannon Ink", "amount"=> "25.50"),
			array("name"=> "Ubisoft Watch Dogs PS3 Game", "amount"=> "70"),
			array("name"=> "Sony PlayStation 4 Console", "amount"=> "480"),
			array("name"=> "Samsung 60\"LED Smart TV", "amount"=> "2299.99"),
			array("name"=> "Olympus 14MP Camera", "amount"=> "119.49"),
			array("name"=> "Lenovo 10\" Wi-Fi Tablet", "amount"=> "348"),
			array("name"=> "Monster Earphone", "amount"=> "299.99"));

		html_table_form($items, array("Name", "Price ($)"), "amount",
			array("method"=> "post", "action"=> "process.php?action=purchase", "id"=> "purchaseform"),
			array("<input type='submit' name='action' value='buy'/>", html_span_error_session("message", true)));

		html_link("HOME", "index.php");
		insert_tab();
		html_link("PROFILE", "profile.php");
		insert_tab();
		html_link("TRANSACTION", "transaction.php");
		insert_tab();
		html_logout_button();
	else:
		html_span_error(INVALID_ACCESS);
	endif;

	clear_temp_sessions();

	include PATH."layouts/footer.php";
?>

