<?php

//TODO


namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

/* CreateCustomerController will handle the creation of a new customer */
class LoginController extends PageController {
	
	/* CustomerMapper to query customers */
	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\CustomerMapper();
	}

	/* Processes the user form to create a new customer */
    function process() {
        if (isset($_POST["connect"]) ) 
		{
				
			
			/* Only executed if the ssn is already in the database */
			if($this->integrityConstraintViolate($_POST['username']))
		   {
			   
			   $username = $_POST["username"];
			   $password = $_POST["password"];
			   $password_db = $this->mapper->getCredentials($username);
				$password_db = implode("", $password_db);
			   if(strcmp(md5($password), $password_db) == 0){
					
					
				$customer = $this->mapper->getCustomer($username);
				$ssn = $customer[0]->getSsn();
				$customer[0]->setConnected("1");
				$count = $this->mapper->update($customer[0]);
					
				header("Location: profile.php?&object=".$ssn);
				die();

			   } else echo "Access denied. Please enter the right username and/or password."; ?> <p></p> <?php
			   /* Rename columns for compatibility */
			   /*
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
				*/
				/* Create a new customer object with the attributes given by the user */
				//$object = $this->mapper->createObject($array);
				
				/* Insert the new customer into the database */
				//$this->mapper->insert($object);
				
				
				
		   }
		   else echo "That customer already exists. Please create a customer with a different ssn.";
	
        }
    }
	
	/* Check if the ssn already exists in the database 
	/* @return	true if ssn exists
	/* 				false if the ssn isn't in the database */
	protected function integrityConstraintViolate($ssn)
	{
		$object = $this->mapper->find($ssn);
		if($object != null )return true;
		else return false;
	}
	

	
	
	
	
	
	
}

?>