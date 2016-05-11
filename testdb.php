<?php
require 'connect.php';

$db = dbConnect();

echo "Host is: $db.host";
//	$db = new pDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

?>