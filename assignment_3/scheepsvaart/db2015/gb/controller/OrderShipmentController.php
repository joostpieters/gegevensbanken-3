<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
require_once("gb/mapper/ShipmentMapper.php" );
require_once("gb/mapper/OrderMapper.php" );

class OrderShipmentController extends PageController {
    private $customer;
	private $shipmentMapper;
	private $orderMapper;
	
	public function __construct()
	{
		$this->shipmentMapper = new \gb\Mapper\ShipmentMapper();
		$this->orderMapper = new \gb\Mapper\OrderMapper();
	}
    
    function process() {
        
        if (!$this->isSsnNull()) {
            $this->customer = $this->lookupCustomer($_POST["ssn"]);

			
			if(!is_object($this->customer))
			{
			
				echo "This customer doesn't exist in the database. Please create a new customer "; ?><a href="./create_customer.php">here</a>.<br><br><?php
			}
        } 
        
        if (isset($_POST["order_shipment"])){

		
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
            
    function lookupCustomer ($ssn) {
        //$this->customer = null;
        $mapper = new \gb\mapper\CustomerMapper();//
        return $mapper->find($ssn);
    }
    
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
    
    function placeShipmentOrder() {
			$shipment_id = $_POST["shipment_id"];
		   $volume = $_POST["volume"];
		   $weight = $_POST["weight"];
		   
		   $array = array($shipment_id, $volume, $weight);
		   $array['shipment_id'] = $array[0];
		   $array['volume'] = $array[1];
		   $array['weight'] = $array[2];

			for ($x = 0; $x <= 2; $x++) unset($array[$x]);
			$object = $this->shipmentMapper->createObject($array);
			$this->shipmentMapper->insert($object);
			
			$ssn = $_POST["ssn"];
			$ship_broker_name = $_POST["ship_broker_name"];
			$price = $_POST["price"];
			$order_date = $_POST["order_date"];
		   
			$array2 = array($shipment_id, $ssn, $ship_broker_name, $price, $order_date);
			$array2['shipment_id'] = $array2[0];
			$array2['ssn'] = $array2[1];
			$array2['ship_broker_name'] = $array2[2];
			$array2['price'] = $array2[3];
			$array2['order_date'] = $array2[4];
		   
		   
		   	for ($x = 0; $x <= 4; $x++) unset($array2[$x]);
			$object = $this->orderMapper->createObject($array2);
			$this->orderMapper->insert($object);
    }
}

?>