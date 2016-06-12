<?php

function loadDatabase($name)
{

    	$host = "";
	$port = "";		// Maybe not needed 
	$user = "";
	
	$pass = "";

	

	$tryOpenShift = getenv('OPENSHIFT_MYSQL_DB_HOST');

    	if ($tryOpenShift === null || $tryOpenShift == "") 
   	{
		// We are not in the openshift environment 
		require ("setLocalDatabaseCredentials.php");
   	}
   	else
   	{
     		$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
		$user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		
		$pass = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
   	}

   	

	$db = new PDO("mysql:host=$host; dbname=$name", $user, $pass);

   	return $db;
}
?>
