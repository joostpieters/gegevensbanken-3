<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* ShipBrokerMapper handles all queries about ship brokers */
    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();//

	/* Collection containing all routes and the ship brokers involved and their revenues */
	$fullQuery = $mapper->getShipBrokerRevenues();
	?>

	<!-- Table displaying the revenues of the ship brokers, from last month -->
	<table>
		<tr>
			<td>Ship broker name</td>
			<td>From port</td>
			<td>To port</td>
			<td>Revenue</td>
			<td>Date (mm/yyyy)</td>
		</tr>
	
		<?php
			/* Iterate through all routes to display ship broker information and revenue */
			foreach($fullQuery as $subQuery) {
		?>
       <tr>
			<td><?php echo $subQuery['ship_broker_name']; ?></td>
			<td><?php echo $subQuery['from_port_name'] ?></td>
			<td><?php echo $subQuery['to_port_name'] ?></td>
			<td><?php echo $subQuery['price'] ?></td>
			<td><?php echo $subQuery['date']?></td>
		</tr>   
		<?php        
			}
		?>
	</table>
	<!-- Table displaying the revenues of the ship brokers, from last month -->
	
<?php
	require("template/bottom.tpl.php");
?>



