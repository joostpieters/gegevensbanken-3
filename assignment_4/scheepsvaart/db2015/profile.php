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
	require_once( "gb/mapper/OrderMapper.php" );
	require_once("gb/mapper/ShipmentMapper.php");
	
    $mapper = new gb\mapper\CustomerMapper();
	$orderMapper = new gb\mapper\OrderMapper();
	$shipmentMapper = new gb\mapper\ShipmentMapper();
	
?>
<?php

	
	if(isset($_GET["object"]))
	{
		
		$object = $_GET["object"];
		$customer = $mapper->getCustomer($object);
		
		if($customer[0]->getConnected() == 1){
		/* Collection containing all customers */
			echo "\n     ";
			echo $customer[0]->getFirstName();
			echo " ";
			echo $customer[0]->getLastName();
			echo " has logged in ." ?> <p></p><?php
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
		<legend> Your orders</legend>
		
			<!-- Table displaying all orders in the database -->
	<table>
		<tr>
			<td>Shipment id</td>
			<td>Ship broker name</td>      
			<td>Price</td>
			<td>Order date</td>
			<td>Volume</td>
			<td>Weight</td>
		</tr>
	
		<?php
			$allOrders = $orderMapper->getOrdersFromCustomer($customer[0]->getSsn());
			$numberOfOrders = 0;
			$amount = 0;
			$amountVolume = 0;
			$amountWeight = 0;
			$min = 100000000000;
			$max = 0;
			/* Iterate trough all orders to display their attributes */
			foreach($allOrders as $order) {
				$numberOfOrders++;
				$amount = $amount + $order->getPrice();
				if($order->getPrice() < $min) $min = $order->getPrice();
				if($order->getPrice() > $max) $max = $order->getPrice();
				
				$shipment = $shipmentMapper->getShipmentInformation($order->getShipmentID());
				$amountVolume = $amountVolume + $shipment[0]->getVolume();
				$amountWeight = $amountWeight + $shipment[0]->getWeight();
		?>
       <tr>
			<td><?php echo $order->getShipmentID(); ?></td>
			<td><?php echo $order->getShipBrokerName(); ?></td>
			<td><?php echo $order->getPrice(); ?></td>
			<td><?php echo $order->getOrderDate(); ?></td>          
			<td><?php echo $shipment[0]->getVolume(); ?></td>
			<td><?php echo $shipment[0]->getWeight(); ?></td>
			         
		</tr>             
		<?php        
			}
			$average = $amount/$numberOfOrders;
			$averageVolume = $amountVolume/$numberOfOrders;
			$averageWeight = $amountWeight/$numberOfOrders;
		?>
		
		
	</table> 
	<br></br>
	<table>
		<tr>
			<td>Average price of your orders: </td>
			<td><?php echo number_format($average, 2, ",", " "); ?></td>
			<td>EURO</td>
		</tr>
		<?php if($numberOfOrders > 0){ ?>
		<tr>
			<td>Minimum price of your orders: </td>
			<td><?php echo number_format($min, 2, ",", " "); ?></td>
			<td>EURO</td>
		</tr>
		<tr>
			<td>Maximum price of your orders: </td>
			<td><?php echo number_format($max, 2, ",", " "); ?></td>
			<td>EURO</td>
		</tr>
		</table>
		<br></br>
		<table>
		<tr>
			<td>Average volume of your shipments: </td>
			<td><?php echo number_format($averageVolume, 2, ",", " "); ?></td>
		</tr>
		<tr>
			<td>Average weight of your shipments: </td>
			<td><?php echo number_format($averageWeight, 2, ",", " "); ?></td>
			<td>kg</td>
		</td>
		<?php } ?>
	</table>
	<!-- Table displaying all orders in the database -->
		
		
		</fieldset>
		
		<?php 
			$p_controller = new gb\controller\ProfileController($customer[0]->getUsername());
			$p_controller->process();
		?>
		
		
	<form method="post">
			<p></p>
			<td >&emsp;</td>
			<td >&emsp;</td>
			<td><input type ="submit" name="disconnect" value="Log out" ></td>
	</form>    
			
			
	<!-- Table with overview of all customers in the database -->
		
		<?php		
		} else  {?> Acces denied. <a href="login.php">Log in</a> to see customer information <?php }
	}
	
	?>

<br /> 