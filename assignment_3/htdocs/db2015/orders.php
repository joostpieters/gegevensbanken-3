<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
?>
<table>
    <tr>
        <td>Shipment id</td>
        <td>Customer name</td>
        <td>Ship broker name</td>
        <td>Price</td>
        <td>Order date</td>
    </tr>
</table>  
<?php
	require("template/bottom.tpl.php");
?>