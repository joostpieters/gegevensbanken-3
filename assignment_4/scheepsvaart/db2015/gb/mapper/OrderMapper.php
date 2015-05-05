<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Order.php" );

/* Class handling all queries about orders */
class OrderMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM ORDERS where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM ORDERS ";
    } 
    
	/* Creates a collection with all orders from the database
	/* @return collection with all orders */
    function getCollection( array $raw ) {
        $orderCollection = array();
        foreach($raw as $row) {
            array_push($orderCollection, $this->doCreateObject($row));
        }
        
        return $orderCollection;
    }

	/* Create a new order object with the given attributes 
	/* @return new order object	*/
    protected function doCreateObject( array $array ) {
        $obj = null;        
        
		/* Check if there are attributes */
		if (count($array) > 0) 
		{
			$obj = new \gb\domain\Order( $array['shipment_id'] );
			
			$obj->setShipmentId($array["shipment_id"]);
			$obj->setSsn($array["ssn"]);
			$obj->setShipBrokerName($array['ship_broker_name']);
			$obj->setPrice($array['price']);
			$obj->setOrderDate($array['order_date']);
        }
		
        return $obj;
    }

	/* Insert a given order into the database and update it's attributes */
    protected function doInsert( \gb\domain\DomainObject $object ) {
        $con = $this->getConnectionManager();
		$query = 'INSERT INTO ORDERS (shipment_id, ssn, ship_broker_name, price, order_date) 
					  VALUES (:shipment_id,:ssn,:ship_broker_name,:price,:order_date)';
		
		$con->executeUpdateStatement ($query, 
		array
		(
			'shipment_id' => $object->getShipmentId(),
			'ssn' => $object->getSsn(),
			'ship_broker_name' => $object->getShipBrokerName(),
			'price' => $object->getPrice(),
			'order_date' => $object->getOrderDate(),
		));
    }
    
	/* Not implemented: update the attributes of a given order object */
    function update( \gb\domain\DomainObject $object ) {
        
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
    
}


?>
