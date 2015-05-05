<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

/* ListCustomerInCityController will handle the query to see all customers from a specific city */
class ListCustomerInCityController extends PageController {

	/* CustomerMapper will handle the query about the customers */
	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\CustomerMapper();
	}
	
	/* Processes the drop down list to see the customers from a specific city 
	/* @return	collection containing all customers from the selected city */
    function process() {
	
        if (isset($_POST["list_customer"])) { 
			/* Collection containing all customers from a specific city */
			$customers = $this->mapper->getCustomersInCity($_POST["city"]);
			return $customers;
		}
    }
}
?>