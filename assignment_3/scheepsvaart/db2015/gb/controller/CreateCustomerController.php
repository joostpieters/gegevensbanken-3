<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

class CreateCustomerController extends PageController {
	
	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\CustomerMapper();
	}

    function process() {
        if (isset($_POST["create_customer"])) {
		   $ssn = $_POST["ssn"];
		   $first_name = $_POST["first_name"];
		   $last_name = $_POST["last_name"];
		   $street = $_POST["street"];
		   $number = $_POST["number"];
		   $bus = $_POST["bus"];
		   $mobiphone = $_POST["mobiphone"];
		   $city = $_POST["city"];
		   $postal_code = $_POST["postal_code"];
		   
		   $array = array($ssn, $first_name, $last_name, $street, $number, $bus, $mobiphone, $city, $postal_code);
		   $array['ssn'] = $array[0];
		   $array['first_name'] = $array[1];
		   $array['last_name'] = $array[2];
		   $array['street'] = $array[3];
		   $array['number'] = $array[4];
		   $array['bus'] = $array[5];
		   $array['mobiphone'] = $array[6];
		   $array['city'] = $array[7];
		   $array['postal_code'] = $array[8];
		   
			for ($x = 0; $x <= 8; $x++) unset($array[$x]);
		 
			$object = $this->mapper->createObject($array);
			$this->mapper->insert($object);
			
			

        }
    }
	

	
	
	
	
	
	
}

?>