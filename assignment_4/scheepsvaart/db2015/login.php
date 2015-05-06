<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Create a new customer";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	/* Process the customer creation form with controller */
    require_once( "gb/controller/LoginController.php" );
    $loginController = new gb\controller\LoginController();
    $loginController->process();
?>    

<!-- User form containing information about the customer -->




if notalreadytryconnected

	tentative connection
	
		md5 crypt
		
		connected
			
			query data
				
		not connected
		

else not connected post

	show form


<form method="post">
	<table style="width: 100%">

		<tr>
			<td colspan="6">
			<table style="width: 100%">
				<tr>
					<td>Username </td>
					<td><input type="text" value="" name="username"></td>
				</tr>
				<tr>
					<td>Password </td>
					<td><input type="password" value="" name="password"></td>
				</tr>
			</table>
			</td>
		</tr>    

		<tr>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td><input type ="submit" name="connect" value="connect" ></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		</tr>
		
	</table>
	
	
</form>    


<?php
	require("template/bottom.tpl.php");
?>