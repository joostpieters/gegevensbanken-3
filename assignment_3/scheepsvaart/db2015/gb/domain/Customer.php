<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Customer extends DomainObject {    
      
    private $ssn;
	private $username;
	private $password;
    private $first_name;
    private $last_name;
    private $street;
    private $number;
    private $bus;
    private $postal_code;
    private $city;

	private $isConnected;
	
    function __construct( $id=null ) {
        parent::__construct( $id );
		$isConnected = false;
    }
    
    function setSsn( $ssn ) {
        $this->ssn = $ssn;        
    }

    function getSsn( ) {
        return $this->ssn;
    }
	
	function setUsername( $username ) {
		$this->username = $username;
	}
	
	function getUsername( ) {
		return $this->username;
	}
	
	function setPassword( $password ) {
		$this->password = $password;
	}
	
	function getPassword( ) {
		return $this->password;
    }
	
    function setFirstName ( $first_name ) {
        $this->first_name = $first_name;        
    }
    
    function getFirstName () {
        return $this->first_name;
    }
    
    function setLastName ($last_name ) {
        $this->last_name = $last_name;
    }
    
    function getLastName () {
        return $this->last_name;
    }
    
    function setStreet ($street) {
        $this->street = $street;
    }
    
    function getStreet () {
        return $this->street;
    }
    
    function getAddress() {
        return $this->getStreet() ." " .$this->getNumber()  ."/" .$this->getBus();
    }
    
    function setNumber ($number) {
        $this->number = $number;
    }
    function getNumber() {
        return $this->number;
    }
    
    function setBus ($bus) {
        $this->bus = $bus;
    }
    
    function getBus () {
        return $this->bus;
    }
    
    function setPostalCode ($postal_code) {
        $this->postal_code = $postal_code;
    }
    
    function getPostalCode () {
        return $this->postal_code;
    }
    
    function setCity ($city) {
        $this->city = $city;
    }
    
    function getCity () {
        return $this->city;
    }
	
	function isConnected () {
		return $this->isConnected;
	}
	
	function changeConnection () {
		$this->isConnected = !$this->isConnected;
	}

}

?>
