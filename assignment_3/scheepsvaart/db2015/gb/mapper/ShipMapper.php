<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Ship.php" );

/* Class handling all queries about ships */
class ShipMapper extends Mapper {

    function __construct() 
	{
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIP where ship_id = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP "; 
    } 
    
	/* Creates a collection with all ships from the database
	/* @return collection with all ships */
    function getCollection( array $raw ) {
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
		
        return $shipCollection;
    }

	/* Create a new ship object with the given attributes 
	/* @return new ship object	*/
    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Ship( $array['ship_id'] );
        
        $obj->setShipId($array['ship_id']);
        $obj->setShipName($array['ship_name']);
        $obj->setType($array['type']);
        
        return $obj;
    }

	/* Not implemented: insert a given ship object in the database */
    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
	/* Update the attributes of a given ship object 
	/* @return 0 if no attributes were adjusted (update not completed) */
    function update( \gb\domain\DomainObject $object) {
		$query = "UPDATE SHIP SET ship_name = ?, type = ? WHERE ship_id = ?";
		$shipName = $object->getShipName();
		$shipType = $object->getType();
		$shipId = $object->getShipId();
		
		$rows = self::$con->executeUpdateStatement($query, array($shipName, $shipType, $shipId ));
        return $rows;
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
    
}


?>
