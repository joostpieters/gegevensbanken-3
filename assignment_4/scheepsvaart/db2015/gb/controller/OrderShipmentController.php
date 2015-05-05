<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
require_once("gb/mapper/ShipmentMapper.php" );
require_once("gb/mapper/OrderMapper.php" );

/* OrderShipmentController will handle new orders and shipments */
class OrderShipmentController extends PageController {

	/* Customer that commands a new order and shipment */
    private $customer;
	
	/* ShipmentMapper handles all queries about shipments */
	private $shipmentMapper;
	
	/* OrderMapper handles all queries about orders */
	private $orderMapper;
	
	public function __construct()
	{
		$this->shipmentMapper = new \gb\Mapper\ShipmentMapper();
		$this->orderMapper = new \gb\Mapper\OrderMapper();
	}
    
	/* Processes the lookup of a customer in the database and the placement of a new order */
    function process() {
        
		/* If ssn is filled in */
        if (!$this->isSsnNull()) {
		
			/* Check if the ssn is in the database */
            $this->customer = $this->lookupCustomer($_POST["ssn"]);
			if($this->customer == null)
			{
				echo "This customer doesn't exist in the database. Please create a new customer "; ?><a href="./create_customer.php">here</a>.<br><br><?php
			}
        } 
        
		/* If the user enters information about the shipment */
        if (isset($_POST["order_shipment"]))
		{
            $this->placeShipmentOrder();
        }
                
    }
    
    function isSsnNull() {
        return !(isset ($_POST['ssn']));
    }
    
    function isOrderShipmentDisabled() {
        return is_null($this->customer);
    }
    
    function isOrderShipmentEnabled() {
        return (isset($_POST["order_shipment"]));
    }
            
	/* Check if given ssn is in the database */		
    function lookupCustomer ($ssn) {
        $mapper = new \gb\mapper\CustomerMapper();//
        return $mapper->find($ssn);
    }
    
	/* Returns the ssn of $customer */
    function getCustomerSsn() {
        if (!is_null($this->customer)) {
            return $this->customer->getSsn();
        } else {
            return '';
        }
    }
    
    function getCustomerFirstName() {
        if (!is_null($this->customer)) {
            return $this->customer->getFirstName();
        } else {
            return '';
        }
    }
    
    function getCustomerLastName() {
        if (!is_null($this->customer)) {
            return $this->customer->getLastName();
        } else {
            return '';
        }
    }
    
    function getCustomerCity() {
        if (!is_null($this->customer)) {
            return $this->customer->getCity();
        } else {
            return '';
        }
    }
    
    function getCustomerStreet() {
        if (!is_null($this->customer)) {
            return $this->customer->getStreet();
        } else {
            return '';
        }
    }
    
    function getCustomerNumber() {
        if (!is_null($this->customer)) {
            return $this->customer->getNumber();
        } else {
            return '';
        }
    }
    
    function getCustomerBus() {
        if (!is_null($this->customer)) {
            return $this->customer->getBus();
        } else {
            return '';
        }
    }
    
    function getCustomerPostalCode () {
        if (!is_null($this->customer)) {
            return $this->customer->getPostalCode();
        } else {
            return '';
        }
    }
    
	/* Process placement of new shipment and order */
    function placeShipmentOrder() {

		if(!$this->integrityConstraintViolate($_POST['shipment_id']))
		{
		
			/******************************/
			/* New shipment							 */
			/******************************/
			
		   $shipment_id = $_POST["shipment_id"];
		   $volume = $_POST["volume"];
		   $weight = $_POST["weight"];
		   
		    /* Rename columns for compatibility */
		   $array = array($shipment_id, $volume, $weight);
		   $array['shipment_id'] = $array[0];
		   $array['volume'] = $array[1];
		   $array['weight'] = $array[2];

			for ($x = 0; $x <= 2; $x++) unset($array[$x]);
			
			/* Create a new shipment object with the attributes given by the user */
			$object = $this->shipmentMapper->createObject($array);
			
			/* Insert the new shipment into the database */
			$this->shipmentMapper->insert($object);
			
			/******************************/
			/* New order									 */
			/******************************/
			
			$ssn = $_POST["ssn"];
			$ship_broker_name = $_POST["ship_broker_name"];
			$price = $_POST["price"];
			$order_date = $_POST["order_date"];
		   
		    /* Rename columns for compatibility */
			$array2 = array($shipment_id, $ssn, $ship_broker_name, $price, $order_date);
			$array2['shipment_id'] = $array2[0];
			$array2['ssn'] = $array2[1];
			$array2['ship_broker_name'] = $array2[2];
			$array2['price'] = $array2[3];
			$array2['order_date'] = $array2[4];
		   
		   
		   	for ($x = 0; $x <= 4; $x++) unset($array2[$x]);
			
			/* Create a new order object with the attributes given by the user */
			$object = $this->orderMapper->createObject($array2);
			
			/* Insert the new shipment into the database */
			$this->orderMapper->insert($object);
		}
		else echo "This shipment already exists. Please create a shipment with a different ID.";
    }
	
	
	/* Check if the shipment id already exists in the database 
	/* @return	true if shipment_id exists
	/* 				false if the given shipment_id isn't in the database */
	function integrityConstraintViolate($shipment_id)
	{
		$object_ship = $this->shipmentMapper->find($shipment_id);
		$object_order = $this->orderMapper->find($shipment_id);
		if($object_ship != null && $object_order != null )return true;
		else return false;
	}
}

?>