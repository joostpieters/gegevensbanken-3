
<?php
// create a PDO object
include('C:\xampp\php\pear\PHPUnit\Util\configuration.php');
try
{
//$PDO = new PDO('mysql:......;charset=utf8', 'username', 'password');
//$PDO = new PDO('mysql:host=localhost;dbname=shipping;charset=utf8', 'root', '');
$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
}
catch(Exception $e)
{
	die('Fuckin error' .$e->getMessage());
}
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
$stmt = $PDO->query('SELECT * FROM CUSTOMER');
$myssn = 1;
$stmt->execute(array($myssn));
$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC );
?>