<?php
try
{
	$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$dbName = "Students";


	echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";
   echo 'before <br />';
/*
	$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);  */
   echo 'after <br />';

}
catch (PDOException $ex)
{
	echo 'Error!: ' . $ex->getMesage();
	die();
}

foreach ($db->query('SELECT name, age FROM Students') as $row)
{
   echo 'name: ' . $row['name'];
   echo ' age: ' . $row['age'];
   echo '<br />';
}


?>