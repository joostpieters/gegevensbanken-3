<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customers in city";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* Controller handles drop-drown list for city selection */
    require_once( "gb/controller/ListCustomerInCityController.php" );
    $filterController = new gb\controller\ListCustomerInCityController();
	
	/* customersInCity contains all customers living in the selected city */
    $customersInCity = $filterController->process();
	
	/* CustomerMapper handles queries about customers */
	require_once( "gb/mapper/CustomerMapper.php" );
    $mapper = new gb\mapper\CustomerMapper();
	
	/* Collection of all different cities */
	$cities = $mapper->getCities();
?>

<!-- User form with drop-down list to select city -->
<form method="post">
    
	<table style="width: 100%">
		<tr>
			<td style="width: 10%"></td>
			<td style="width: 10%">City</td>
			<td style="width: 40%">
				<select style="width: 100%" name="city">
					<?php
						/* Iterate over all cities to display name in drop-down list */
						$index = 0;
						foreach ($cities as $city  ){
							$index++;
					?>
					<option value="<?php echo $city->getCity();?>"><?php echo $city->getCity(); ?></option>
					<?php
						} 
					?>
				</select>
			</td>
			<td style="width: 10%"><input type="submit" value="List customers in the city" name="list_customer"></td>
			<td style="width: 30%"></td>
		</tr>
	</table>    
	
<br>

	<!-- Table with customers living in the selected city -->
	<table>
        <tr>
            <td>Ssn</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Address</td>
			<td>City</td>
        </tr>
	
		<?php
			if (isset($_POST["list_customer"])) {
				/* Iterate over all customers living in the selected city */
				foreach($customersInCity as $customer) {
		?>
			<tr>
				<td><?php echo $customer->getSsn(); ?></td>
				<td><?php echo $customer->getFirstName(); ?></td>
				<td><?php echo $customer->getLastName(); ?></td>
				<td><?php echo $customer->getAddress(); ?></td>
				<td><?php echo $customer->getCity(); ?></td>
			</tr>     
		<?php        
				}
			}
		?>		
	</table>
	<!-- Table with customers living in the selected city -->
    
</form> 
<!-- User form with drop-down list to select city -->  

<?php
	require("template/bottom.tpl.php");
?>