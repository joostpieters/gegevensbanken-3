<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customers in city";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/controller/ListCustomerInCityController.php" );
    $filterController = new gb\controller\ListCustomerInCityController();
    $filterController->process();
?>
<form method="post">
    

<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">City</td>
        <td style="width: 40%">
            <select style="width: 100%">
                <option value="1">city 1</option>
                <option value="2">Please retrieve more cities from the database</option>
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="List customers in the city" name="list_customer"></td>
        <td style="width: 30%"></td>
    </tr>
</table>    
	<table>
            <tr>
                <td>Ssn</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Address</td>
                <td>City</td>
            </tr>
<?php
    require_once( "gb/mapper/CustomerMapper.php" );    
    $custMapper = new gb\mapper\CustomerMapper();//
 ?>
      
	

</table>
    
</form>    
<?php
	require("template/bottom.tpl.php");
?>