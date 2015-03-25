<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );

class UpdateShipController extends PageController 
{
	private $mapper;
	
	public function __construct()
	{
		$this->mapper = new \gb\Mapper\ShipMapper();
		//print_r($this->mapper);
	}
	
        
    function process() 
	{
		//isset != empty
        if (isset($_POST["update_ship"])) 
		{
			$object_ship = $this->mapper->find($_POST["ship_id"]);
			$count = $this->mapper->update($object_ship);
			print $count;
		}
    }
}

?>