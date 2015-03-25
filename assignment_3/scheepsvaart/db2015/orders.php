<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
?>

 <?php
 require_once( "gb/mapper/OrderMapper.php" );
    $mapper = new gb\mapper\OrderMapper();//
    $allOrders = $mapper->findAll();
?>

<table>
    <tr>
        <td>Shipment id</td>
        <td>Ssn</td>
        <td>Ship broker name</td>      
		<td>Price</td>
		<td>Order date</td>
    </tr>

	
<?php
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
<?php
	require("template/bottom.tpl.php");
?>