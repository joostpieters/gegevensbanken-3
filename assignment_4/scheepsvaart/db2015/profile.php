<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customer account management";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	/* CustomerMapper handles queries about customers */
	require_once("gb/mapper/CustomerMapper.php" );
	require_once( "gb/controller/ProfileController.php" );
    $mapper = new gb\mapper\CustomerMapper();
	
	
?>
<?php

	
	if(isset($_GET["object"]))
	{
		
		$object = $_GET["object"];
		$customer = $mapper->getCustomer($object);
		
		if($customer[0]->getConnected() == 1){
		/* Collection containing all customers */
			echo "\nCustomer is logged in ." ?> <p></p><?php
			?>
			<!-- Table with overview of all customers in the database -->
		<fieldset>
		<legend>Account Information </legend>
			<table>
				<tr>
					<td>Ssn</td>
					<td>First name</td>
					<td>Last name</td>
					<td>Address</td>
					<td>City</td>
					
				</tr>
		
				<tr>
					<td><?php echo $customer[0]->getSsn(); ?></td>
					<td><?php echo $customer[0]->getFirstName(); ?></td>
					<td><?php echo $customer[0]->getLastName(); ?></td>
					<td><?php echo $customer[0]->getAddress(); ?></td>
					<td><?php echo $customer[0]->getCity(); ?></td>
					
					
				</tr>     
			</table>
		</fieldset>
		
		<fieldset>
		<legend> Orders</legend>
		
		</fieldset>
		
		<?php 
			$p_controller = new gb\controller\ProfileController($customer[0]->getUsername());
			$p_controller->process();
		?>
		
		
	<form method="post">
			<p></p>
			<td >&emsp;</td>
			<td >&emsp;</td>
			<td><input type ="submit" name="disconnect" value="Disconnect" ></td>
	</form>    
			
			
	<!-- Table with overview of all customers in the database -->
		
		<?php		
		} else  {?> Acces denied. <a href="login.php">Log in</a> to see customer information <?php }
	}
	
	?>

<br /> 