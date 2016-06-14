<?php
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

$username = $_POST['username'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$statement = $db->PREPARE('INSERT INTO users(username, password) VALUES (:user, :pass)');
$statement->bindValue(':pass', $hashedPassword, PDO::PARAM_INT);
$statement->bindValue(':user', $username, PDO::PARAM_INT);
$statement->execute();


if (password_verify($password,$hashedPassword))  {
	echo 'testing, here is the username: ' . $username .' and the password is: ' . $hashedPassword;
} else {
	echo 'wrong password';
}

//header('Location: log_in.html');

?>
