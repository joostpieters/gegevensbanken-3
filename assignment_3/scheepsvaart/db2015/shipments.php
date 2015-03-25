<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
?>

<table>
    <tr>
        <td>Shipment id</td>
        <td>Volume</td>
        <td>Weight</td>        
    </tr>
</table>            

<?php
	require("template/bottom.tpl.php");
?>