<?php


namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

/* CreateCustomerController will handle the creation of a new customer */
class ProfileController extends PageController 
{
	
	/* CustomerMapper to query customers */
	private $mapper;
	private $username;
	
	public function __construct($user)
	{
		$this->mapper = new \gb\Mapper\CustomerMapper();
		$this->username = $user;
	}

	/* Processes the user form to create a new customer */
    function process() 
	{
        if (isset($_POST["disconnect"]) ) 
		{
			/* Only executed if the ssn is already in the database */
		
				$customer = $this->mapper->getCustomer($this->username);
				$customer[0]->setConnected("0");
				$count = $this->mapper->update($customer[0]);
		
				header("Location: login.php");
				die();
        }
    }
	

	
}

?>