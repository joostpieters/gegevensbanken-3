<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	/* ShipMapper handles all queries about ships */
	require_once( "gb/mapper/ShipMapper.php" );
    $mapper = new gb\mapper\ShipMapper();
	
	/* Collection containing all ships */
    $allShip = $mapper->findAll();
?>

	<!-- Table displaying all ships -->
	<table>
            <tr>
				<td>Ship id</td>
				<td>Ship name</td>
				<td>type</td>
			</tr>

			<?php 
				/* Iterate through all hsips */
				foreach($allShip as $ship) {
			?>
			<tr>
				<!-- Clickable Ship IDs -->
				<td><a href = 'update_ship.php?ship_id=<?php echo $ship->getShipId(); ?>&type=<?php echo $ship->getType(); ?>&name=<?php echo $ship->getShipName(); ?>'><?php echo $ship->getShipId(); ?></td>
				<td><?php echo $ship->getShipName(); ?></td>
				<td><?php echo $ship->getType(); ?></td>                
			</tr>     
			<?php        
				}
			?>
	</table>
	<!-- Table displaying all ships -->
	
<?php
	require("template/bottom.tpl.php");
?>