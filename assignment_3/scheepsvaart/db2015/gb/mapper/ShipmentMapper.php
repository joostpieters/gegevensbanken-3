<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Shipment.php" );


class ShipmentMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIPMENT where Shipment_id = ?"; // TODO
        $this->selectAllStmt = "SELECT * FROM SHIPMENT ";
        
    } 
    
    function getCollection( array $raw ) {
        
        $shipmentCollection = array();
        foreach($raw as $row) {
            array_push($shipmentCollection, $this->doCreateObject($row));
        }
        
        return $shipmentCollection;
    }

    protected function doCreateObject( array $array ) {
		$obj = null;        
        if (count($array) > 0) 
		{
			$obj = new \gb\domain\Shipment( $array['shipment_id'] );
			
			$obj->setShipmentId($array['shipment_id']);
			$obj->setVolume($array['volume']);
			$obj->setWeight($array['weight']);
        }
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        $con = $this->getConnectionManager();
		$query = 'INSERT INTO SHIPMENT (shipment_id, volume, weight) 
					  VALUES (:shipment_id,:volume,:weight)';
		$con->executeUpdateStatement ($query, 
		array
		(
			'shipment_id' => $object->getShipmentId(),
			'volume' => $object->getVolume(),
			'weight' => $object->getWeight(),
		));
    }
    
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
