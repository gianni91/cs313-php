<?php 
require 'dbConnector.php';

try
{

echo "testing1";
   $db = loadDatabase("notes");
echo "testing 2";


echo "testing 3";
}
catch (PDOException $ex)
{
   echo 'Errors!: ' . $ex->getMessage();
   die();
}

foreach ($db->query('select username, password from user') as $row)
{
	echo 'user: ' . $row['username'];
	echo ' password: ' . $row['password'];
	echo '<br />';
}

/*
$stmt = $db->prepare('select * from table where id=:id and name=:name');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
*/
?>