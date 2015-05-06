<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Shipping database";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	/* CustomerMapper handles queries about customers */
    require_once( "gb/mapper/CustomerMapper.php" );
    $mapper = new gb\mapper\CustomerMapper();
	
	
?>

Welcome to the shipping web application!<br /><br />Customer is logged in .

<?php

	
	
	if(isset($_GET["object"]))
	{
		
		$object = $_GET["object"];
		/* Collection containing all customers */
		$customer = $mapper->getCustomer($object);
		$customer[0]->changeConnection();
		?>
		<!-- Table with overview of all customers in the database -->
	<table>
        <tr>
            <td>Ssn</td>
			<td>First name</td>
            <td>Last name</td>
            <td>Address</td>
            <td>City</td>
        </tr>
	
       <tr>
			<td><?php echo $customer[0]->getSsn(); ?></td>
			<td><?php echo $customer[0]->getFirstName(); ?></td>
			<td><?php echo $customer[0]->getLastName(); ?></td>
            <td><?php echo $customer[0]->getAddress(); ?></td>
            <td><?php echo $customer[0]->getCity(); ?></td>
		</tr>     
	</table>
	<!-- Table with overview of all customers in the database -->
		
<?php		
	}
	
	?>

<br /> 