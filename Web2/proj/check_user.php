<?php
session_start();
require 'password.php';
require '../dbConnector.php';

try 
{
	$db = loadDatabase("fhe_ideas");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	 	// So stuff isn't parsed before sending it to mySQL - http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
}
catch (PDOException $theError)
{
	echo 'Error: ' . $theError->getMessage();
	die();		
}

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$statement = $db->PREPARE('SELECT password FROM users WHERE username = :user');
$statement->bindParam(':user', $username);
$statement->execute();

$hashedPassword = $statement->FETCH(PDO::FETCH_ASSOC);


if (password_verify($password,$hashedPassword['password']))  {
	$_SESSION["loggedIn"] = "true";
	header('Location: FHE_Ideas.php');
} else {
	header('Location: log_in.html');
}

?>
