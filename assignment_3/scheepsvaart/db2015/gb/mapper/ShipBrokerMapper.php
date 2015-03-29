<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );

/* Class handling all queries about ship brokers */
class ShipBrokerMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIP_BROKER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP_BROKER ";       
    } 
    
	/* Creates a collection with all ship brokers from the database
	/* @return collection with all ship brokers */
    function getCollection( array $raw ) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

	/* Create a new ship broker object with the given attributes 
	/* @return new ship broker object	*/
    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBroker( $array['name'] );
        
        $obj->setName($array['name']);
        $obj->setNumber($array['number']);
        $obj->setStreet($array['street']);
        $obj->setBus($array['bus']);
        $obj->setPostalCode($array['postal_code']);
        $obj->setCity($array['city']);
        
        return $obj;
    }

	/* Not implemented: insert a given ship object in the database */
    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
	/* Not implemented: update the attributes of a given ship object */
    function update( \gb\domain\DomainObject $object ) {
       
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
	/* Query the revenues of ship brokers for routes from last month 
	/* @return query results */
    function getShipBrokerRevenues() {
       
        $con = $this->getConnectionManager();
		
		/* Get date for last month */
		$dateFormatted = $this->getPreviousMonthFormatted();	
		
		/* SQL query */
        $selectStmt = 	"SELECT 	SB.Name AS ship_broker_name, P1.Port_Name AS from_port_name, 
												P2.Port_Name AS to_port_name, SUM(O.Price) AS price, O.Order_date AS date
								FROM 		SHIP_BROKER AS SB, ORDERS AS O, SHIPMENT AS SM,
												SHIPS AS S, TRIP AS T, ROUTE AS R, PORT AS P1, PORT AS P2
								WHERE 	SB.Name = O.Ship_broker_name AND O.Shipment_id = SM.Shipment_id 
												AND SM.Shipment_id = S.Shipment_id AND S.Ship_id = T.Ship_id 
												AND T.Route_id = R.Route_id AND R.From_port_code = P1.Port_code 
												AND R.To_port_code = P2.Port_code
												AND O.Order_date LIKE '{$dateFormatted}%'
								GROUP BY R.Route_id, SB.Name";
					   
		$results = $con->executeSelectStatement($selectStmt, array());    
        return $results;    
    }
	
	/* Returns the date for the previous month in adjusted format */
	private function getPreviousMonthFormatted()
	{
		$formatPreviousDate = (string)date("m-Y", mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
		return substr($formatPreviousDate, 3, 7) . "-" . substr($formatPreviousDate, 0, 2);
	}
}


?>
