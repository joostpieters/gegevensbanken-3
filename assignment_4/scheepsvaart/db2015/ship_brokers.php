<?php
	$title = "List of ship brokers";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* ShipBrokerMapper handles all queries about ship brokers */
    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new be\kuleuven\cs\gb\mapper\ShipBrokerMapper();//
	
	/* Collection containing all ship brokers */
    $allShipBroker = $mapper->findAll();
?>
	
	<!-- Table displaying all ship brokers -->
	<table>
            <tr>
				<td>Name</td>
				<td>Street</td>
				<td>Number</td>
				<td>Bus</td>
				<td>City</td>
			</tr>
			
			<?php
				/* Iterate through all ship brokers */
				foreach($allShipBroker as $broker) {
			?>
			<tr>
				<td><?php echo $broker->getName(); ?></td>		
				<td><?php echo $broker->getStreet(); ?></td>
                <td><?php echo $broker->getNumber(); ?></td>
                <td><?php echo $broker->getBus(); ?></td>
                <td><?php echo $broker->getCity(); ?></td>
			</tr>     
			<?php        
				}
			?>
	</table>
	<!-- Table displaying all ship brokers -->
	
<?php
	require("template/bottom.tpl.php");
?>