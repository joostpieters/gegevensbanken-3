<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customer search";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	/* Controller handles input for a new shipment */
    require_once( "gb/controller/CustomerLookupController.php" );
	$customerLookupController = new gb\controller\CustomerLookupController();
    $allCustomer =  $customerLookupController->process();
	
	  
?>    

<!-- User form displaying all information about the customer and the new order and shipment -->
<form method="post">
	<table style="width: 100%">
		<tr>
			<td colspan="6">Customer search form</td>
		</tr>
		
		<tr>
		
		<!-- Look up customers in the database -->
			<td colspan="6">
			<table style="width: 100%">
			
				<tr>
					<td>Customer ssn</td>
					<td><input type="text" name="ssn"></td>
					<td><input type ="submit" value = "Look up"></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>First name</td>
					<td><input type="text" name="first_name"></td>
					<td><input type="submit" value = "Look up"></td>
				</tr>
				<tr>
					<td>Last name</td>
					<td><input type ="text" name = "last_name"></td>
					<td><input type="submit" value = "Look up"></td>
				</tr>
			</table>
			</td>
			<!-- Look up customers in the database -->
		
		</tr> 		
		<tr>
			<td colspan="6">Customer information</td>
		</tr>
		
		<tr>
			<td colspan="6">
			<table style="width: 100%">
					<!-- Table with overview of all customers in the database -->
	
			<tr>
				<td>Ssn</td>
				<td>First name</td>
				<td>Last name</td>
				<td>Address</td>
				<td>City</td>
			</tr>
	
		<!-- Iterate over all customers -->
			<?php
				if(isset($_POST["ssn"]) || isset($_POST["first_name"]) || isset($_POST["last_name"])){
					foreach($allCustomer as $customer) {
						
			?>
			
			<tr>
				<td><?php echo $customer->getSsn(); ?></td>
				<td><?php echo $customer->getFirstName(); ?></td>
				<td><?php echo $customer->getLastName(); ?></td>
				<td><?php echo $customer->getAddress(); ?></td>
				<td><?php echo $customer->getCity(); ?></td>
			</tr>  			
			<?php        
				}
			}
			?>
			</TABLE>
			</td>    
			<!-- Enter shipment and order information -->
			
			</tr>
			
	</table>
</form>
<!-- User form displaying all information about the customer and the new order and shipment -->    

<?php
	require("template/bottom.tpl.php");
?>