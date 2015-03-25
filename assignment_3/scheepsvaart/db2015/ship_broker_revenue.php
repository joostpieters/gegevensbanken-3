<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();//
 ?>
 
  <?php
	include('configuration.php');
	$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
	$stmt = $PDO->prepare("SELECT SUM(PRICE) FROM SHIP_BROKER AS S, ORDERS AS O WHERE S.Name = O.Ship_broker_name GROUP BY S.Name");
	$stmt->execute(array());
	$allShipBrokers = $stmt->fetchAll( \PDO::FETCH_ASSOC);
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
    foreach($allShipBrokers as $shipBroker) {
 ?>
       <tr>
		<td><?php echo $shipBroker['ship_broker_name']; ?></td>
		<td><?php echo $shipBroker['from_port_code'] ?></td>
		<td><?php echo $shipBroker['to_port_code'] ?></td>
        <td><?php echo $shipBroker['price'] ?></td>
        <td><?php echo $shipBroker['date']		?></td>
	</tr>     
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>