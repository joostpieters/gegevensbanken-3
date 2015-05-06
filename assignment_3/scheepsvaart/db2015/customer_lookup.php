<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Order shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	/* Controller handles input for a new shipment */
    require_once( "gb/controller/OrderShipmentController.php" );
	$orderController = new gb\controller\OrderShipmentController();
    $orderController->process();
	
	/* ShipBrokerMapper handles queries about ship brokers */
    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();
	
	/* Collection with all ship brokers */
    $allShipBroker = $mapper->findAll();    
?>    

<!-- User form displaying all information about the customer and the new order and shipment -->
<form method="post">
	<table style="width: 100%">
		<tr>
			<td colspan="6">Customer information</td>
		</tr>
		<tr>

			<!-- Look up customers in the database -->
			<td colspan="6">
			<table style="width: 100%">
				<tr>
					<td>Customer ssn</td>
					<td><input type="text" value="<?php echo $orderController->getCustomerSsn(); ?>" name="ssn"></td>
					<td><input type ="submit" value = "Look up"></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
				<tr>
					<td>First name</td>
					<td><input type="text" name="first_name" readonly="true" value="<?php echo $orderController->getCustomerFirstName(); ?>"></td>
					<td><input type="submit" value = "Look up"></td>
					<td>Last name</td>
					<td><input type ="text" name = "last_name" readonly="true" value="<?php echo $orderController->getCustomerLastName(); ?>"></td>
					<td><input type="submit" value = "Look up"></td>
					<td>City</td>
					<td><input type ="text" name = "city" readonly="true" value="<?php echo $orderController->getCustomerCity(); ?>"></td>
				</tr>
				<tr>
					<td>Street</td>
					<td><input type="text" name="street" readonly="true" value="<?php echo $orderController->getCustomerStreet(); ?>"></td>
					<td>Number</td>
					<td><input type ="text" name = "number" readonly="true" value="<?php echo $orderController->getCustomerNumber(); ?>"></td>
					<td>Mobile phone</td>
					<td><input type ="text" name = "mobiphone" readonly="true" ></td>
				</tr>
			</table>
			</td>
			<!-- Look up customers in the database -->
		
		</tr>    
		<tr>
			<td colspan="6">Shipment information</td>
		</tr>
		<tr>
			
			<!-- Enter shipment and order information -->
			<td colspan="6">
			<table style="width: 100%">
				<tr>
					<td>Shipment id</td>
					<td><input type="text" name="shipment_id" value=""></td>
					<td>Volume</td>
					<td><input type="text" name="volume" value=""></td>
					<td>Weight</td>
					<td><input type ="text" name="weight" value = ""></td>            
				</tr>
				<tr>
					<td>Price</td>
					<td><input type ="text" name="price" value = ""></td>
					<td>Date</td>
					<td><input type="text" name="order_date" value=""></td>
					<td></td>
					<td></td>
					<td></td>            
				</tr>
			</table>
			</td>    
			<!-- Enter shipment and order information -->
			
		</tr>
		<tr>
			<td colspan="6">Ship broker information</td>
		</tr>
			<tr>
    
				<!-- Enter ship broker information -->
				<td colspan="6">
				<table style="width: 100%">
					<tr>
						<td style="width: 15%">Broker name</td>
						<td colspan="5" style="width: 85%">
							<select style="width: 50%" name="ship_broker_name">
							<?php
								/* Iterate through all ship brokers to display their name in drop-down list */
								foreach($allShipBroker as $broker) {
									echo "<option value=\"", $broker->getName(), "\">", $broker->getName(), "</option>" ;
								}
							?>      
							</select>
						</td>
					</tr>        
				</table>
				</td>    
				<!-- Enter ship broker information -->
				
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td >&nbsp;</td>
				<td >&nbsp;</td>
				<td><input type ="submit" name="order_shipment" value="Order shipment" <?php if($orderController->isOrderShipmentDisabled()) echo 'disabled'; ?>></td>
				<td >&nbsp;</td>
				<td >&nbsp;</td>
		</tr>
	</table>
</form>
<!-- User form displaying all information about the customer and the new order and shipment -->    

<?php
	require("template/bottom.tpl.php");
?>