<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );

class UpdateShipController extends PageController 
{
	
	/* ShipMapper to query ships */
	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\ShipMapper();
	}
	 
	/* Processes the user form */
    function process() 
	{
        if (isset($_POST["update_ship"])) 
		{
			/* Find the selected ship in the database through the mapper */
			$object_ship = $this->mapper->find($_POST["ship_id"]);
			
			/* Update the information of the selected ship with setters */
			$object_ship->setType($_POST["ship_type"]);
			$object_ship->setShipName($_POST["ship_name"]);
			
			/* Check if the mapper updated the attributes */
			$count = $this->mapper->update($object_ship);
			
			if($count > 0)
			{
				$URL = 'update_ship.php?ship_id='.$object_ship->getShipId().'&type='.$object_ship->getType().'&name='.$object_ship->getShipName();
				header('Location: '.$URL);
				die();
			}				
			else echo "The database was not updated.";	
			
		}
    }
}

?>