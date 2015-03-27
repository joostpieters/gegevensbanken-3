<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

class ListCustomerInCityController extends PageController {

	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\CustomerMapper();
	}
	
    function process() {
        if (isset($_POST["list_customer"])) {
            
			//echo 'the city is ';
			//echo  $_POST["city"];
			
			$customers = $this->mapper->getCustomersInCity($_POST["city"]);
			return $customers;
			
		}
    }
	   
}
?>