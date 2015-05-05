<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* OrderMapper handles queries about orders */
	require_once( "gb/mapper/OrderMapper.php" );
    $mapper = new gb\mapper\OrderMapper();//
	
	/* Collection with all orders */
    $allOrders = $mapper->findAll();
?>

	<!-- Table displaying all orders in the database -->
	<table>
		<tr>
			<td>Shipment id</td>
			<td>Ssn</td>
			<td>Ship broker name</td>      
			<td>Price</td>
			<td>Order date</td>
		</tr>
	
		<?php
			/* Iterate trough all orders to display their attributes */
			foreach($allOrders as $orders) {
		?>
       <tr>
			<td><?php echo $orders->getShipmentID(); ?></td>
			<td><?php echo $orders->getSsn(); ?></td>
			<td><?php echo $orders->getShipBrokerName(); ?></td>
			<td><?php echo $orders->getPrice(); ?></td>
			<td><?php echo $orders->getOrderDate(); ?></td>          
		</tr>             
		<?php        
			}
		?>
	</table> 
	<!-- Table displaying all orders in the database -->
	
<?php
	require("template/bottom.tpl.php");
?>