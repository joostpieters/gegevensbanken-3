<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");

class ListCustomerInCityController extends PageController {
    function process() {
        if (isset($_POST['list_customer'])) {
            echo  $_POST['city'];
			echo $_POST['list_customer'];		
		}
    }
	   
}
?>