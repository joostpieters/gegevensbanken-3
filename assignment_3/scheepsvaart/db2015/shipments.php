<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* ShipmentMapper handles all queries about shipments */
	require_once( "gb/mapper/ShipmentMapper.php" );
    $mapper = new gb\mapper\ShipmentMapper();
	
	/* Collection containing all shipments */
    $allShipments = $mapper->findAll();
?>

	<!-- Table displaying all shipments -->
	<table>
		<tr>
			<td>Shipment id</td>
			<td>Volume</td>
			<td>Weight</td>        
		</tr>

		<?php
			foreach($allShipments as $shipments) {
		?>
       <tr>
			<td><?php echo $shipments->getShipmentID(); ?></td>
			<td><?php echo $shipments->getVolume(); ?></td>
			<td><?php echo $shipments->getWeight(); ?></td>   
		</tr>             
		<?php        
			}
		?>
	</table> 
	<!-- Table displaying all shipments -->
	
<?php
	require("template/bottom.tpl.php");
?>