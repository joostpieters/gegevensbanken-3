
<?php

// create a PDO object
/*	
include('/db2015/configuration.php');

try
{

$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	die('Fuckin error' .$e->getMessage());
}
 
$stmt = $PDO->query('SELECT * FROM CUSTOMER');
$myssn = 1;
$stmt->execute(array($myssn));
$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC );


//foreach($rows as $value)
//{
//  echo $value['first_name'] .'<br />';
//}

$stmt = $PDO->prepare('UPDATE CUSTOMER SET first_name = ?, last_name = ? WHERE ssn = ?');
$newFirstName = 'FINALLY DONE ??';
$newLastName = 'B';
$ssn = 1;
$stmt->execute(array($newFirstName, $newLastName, $ssn));
$nAffectedRows = $stmt->rowCount();
echo $nAffectedRows;
*/
//echo getcwd();
//chdir('db2015/gb/connection');
require_once("/gb/connection/ConnectionManager.php");
// create a ConnectionManager object
$con = new ConnectionManager();
$ssn = 1;
// execute the query
$customers = $con->executeSelectStatement('SELECT * FROM CUSTOMER WHERE ssn = ?', array($ssn));

foreach($customers as $value)
{
  echo  $value['first_name'] .'<br />';
}
?>