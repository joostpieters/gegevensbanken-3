<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();//
 ?>
 
  <?php
	$fullQuery = $mapper->getShipBrokerRevenues();
	?>

<table>
    <tr>
        <td>Ship broker name</td>
        <td>From port</td>
        <td>To port</td>
        <td>Revenue</td>
        <td>Date (mm/yyyy)</td>
    </tr>
	

<?php
	
    foreach($fullQuery as $subQuery) 
	{
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
<?php

	require("template/bottom.tpl.php");
?>



